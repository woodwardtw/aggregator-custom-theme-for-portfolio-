<?php
/**
 * georgetown site functions and definitions
 *
 * 
 *
 * @package understrap
 */

//CUSTOM POST TYPES

// Register Custom Post Type project
// Post Type Key: sites
function create_site_cpt() {

	$labels = array(
		'name' => __( 'sites', 'Post Type General Name', 'textdomain' ),
		'singular_name' => __( 'site', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => __( 'sites', 'textdomain' ),
		'name_admin_bar' => __( 'site', 'textdomain' ),
		'archives' => __( 'Site Archives', 'textdomain' ),
		'attributes' => __( 'Site Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent site:', 'textdomain' ),
		'all_items' => __( 'All sites', 'textdomain' ),
		'add_new_item' => __( 'Add New site', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New site', 'textdomain' ),
		'edit_item' => __( 'Edit site', 'textdomain' ),
		'update_item' => __( 'Update site', 'textdomain' ),
		'view_item' => __( 'View site', 'textdomain' ),
		'view_items' => __( 'View sites', 'textdomain' ),
		'search_items' => __( 'Search sites', 'textdomain' ),
		'not_found' => __( 'Your site was not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into site', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this site', 'textdomain' ),
		'items_list' => __( 'sites list', 'textdomain' ),
		'items_list_navigation' => __( 'sites list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter sites list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'site', 'textdomain' ),
		'description' => __( 'Georgetown Sites', 'textdomain' ),
		'labels' => $labels,
		'menu_icon' => '',
		'supports' => array('title', 'editor', 'excerpt', 'thumbnail', 'revisions', 'author', 'trackbacks', 'page-attributes', 'custom-fields', ),
        'taxonomies' => array('category','post_tag'),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 5,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => true,
		'hierarchical' => false,
		'exclude_from_search' => false,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'post',
		'menu_icon' => 'dashicons-hammer',
	);
	register_post_type( 'site', $args );

}
add_action( 'init', 'create_site_cpt', 0 );


//add custom meta box for site URL 

function custom_meta_box_markup($object)
{
    wp_nonce_field(basename(__FILE__), "meta-box-nonce");

    ?>
        <div>
            <label for="site-url">Site URL</label>
            <input name="site-url" type="text" value="<?php echo get_post_meta($object->ID, "site-url", true); ?>">          
        </div>
    <?php  
}

function add_custom_meta_box()
{
    add_meta_box("demo-meta-box", "Site URL", "custom_meta_box_markup", "site", "side", "high", null);
}

add_action("add_meta_boxes", "add_custom_meta_box");

function save_custom_meta_box($post_id, $post, $update)
{
    if (!isset($_POST["meta-box-nonce"]) || !wp_verify_nonce($_POST["meta-box-nonce"], basename(__FILE__)))
        return $post_id;

    if(!current_user_can("edit_post", $post_id))
        return $post_id;

    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE)
        return $post_id;

    $slug = "site";
    if($slug != $post->post_type)
        return $post_id;

    $meta_box_text_value = "";
    
    if(isset($_POST["site-url"]))
    {
        $meta_box_text_value = $_POST["site-url"];
    }   
    update_post_meta($post_id, "site-url", $meta_box_text_value);
}

add_action("save_post", "save_custom_meta_box", 10, 3);



//add site custom post type to search results
function wpa_cpt_tags( $query ) {
    if ( $query->is_tag() && $query->is_main_query() ) {
        $query->set( 'post_type', array( 'post', 'site' ) );
    }
}
add_action( 'pre_get_posts', 'wpa_cpt_tags' );


/*
**
**
THINGS THAT INVOLVE GETTING THE DATA FROM AFAR ---SINGLE SITES
**
**
*/

//get the site data from afar

function getAggData($id){
	$siteURL = verifySlash(get_post_meta( $id, 'site-url', true ));	
	$response = wp_remote_get($siteURL . 'wp-json/' );	
	if(is_wp_error( $response ) || $response['response']['code'] != 200){ //on failure add tag 404
		missingResponse($id, '404');
	} else {
	$data = json_decode( wp_remote_retrieve_body( $response ) ); //on success update post
		$syndicatedDescription = $data->description;			
		updateTitle($id,$data);	  		  	
		updateTags($id,$data);
		missingResponse($id, '');
	}
	totalPosts($id);
	totalPages($id);
}

function updateTitle($id,$data){
	$syndicatedTitle = $data->name;
	$currentTitle = get_the_title();
	if ($currentTitle != $syndicatedTitle){
		$the_post = array(
		    'ID'           => $id,
		    'post_title'   => $data->name,
		    'post_name' => '', //passes empty string to force regeneration of permalink based on title change
		  		);				
		wp_update_post( $the_post );// Update the post in the database
		refreshPage();
	}
}

function updateTags($id,$data){
	if ($data->ddm_tag){
		$extra = $data->ddm_tag;
		$tags = implode(",",$extra); //stringify it 
		$postTags = wp_get_post_tags($id);	  	
		$postTagsArray = [];
		for ($i = 0; $i < count($postTags); $i++){
		  	array_push($postTagsArray, $postTags[$i]->name);
		}
		if (array_diff($extra,$postTagsArray)>0) {
		  		wp_set_post_tags($id, $tags, false );
		  	}	
	 }
}

//adds 404 tag to sites that don't respond for filtering purposes (keep the post for archival purposes but remove from active listings via wp query)
function missingResponse($id, $status){
	  	update_post_meta( $id, 'site-status', $status);
}


//makes sure that the agg site URL has a trailing slash
function verifySlash($url){
	if(substr($url,-1) != '/'){
		$url = $url.'/';
		return $url;
	} else {
		return $url;
	}
}


//gets total posts and allows wp query vs value or a sort to show more posts up front
function totalPosts($id){
	$siteURL = verifySlash(get_post_meta( $id, 'site-url', true ));	
	$response = wp_remote_get($siteURL . 'wp-json/wp/v2/posts?per_page=1' );	
	if(is_wp_error( $response ) || $response == 404){ //on failure add tag 404
		missingResponse($id, '404');
	} else {
		$total = $response['headers']['x-wp-total'];
		update_post_meta( $id, 'total-posts', $total);
	}
}


//gets total pages and allows wp query vs value or a sort to show more posts up front
function totalPages($id){
	$siteURL = verifySlash(get_post_meta( $id, 'site-url', true ));	
	$response = wp_remote_get($siteURL . 'wp-json/wp/v2/pages?per_page=1' );	
	if(is_wp_error( $response ) || $response == 404){ //on failure add tag 404
		missingResponse($id, '404');
	} else {
		$total = $response['headers']['x-wp-total'];
		update_post_meta( $id, 'total-pages', $total);
	}
}


//gets list of ten most common categories and links to them
function aggSiteCategories($id){
	$siteURL = verifySlash(get_post_meta( $id, 'site-url', true ));	
	$response = wp_remote_get($siteURL . 'wp-json/wp/v2/categories?orderby=count&per_page=10&order=desc' );
	if(is_wp_error( $response ) || $response == 404){ //on failure add tag 404
		//missingResponse($id, '404');
	} else {
		$categories = '';
		$data = json_decode( wp_remote_retrieve_body( $response ) );
		for ($i = 0; $i < sizeof($data); $i++ ){
			$categories .= '<li><a href="'.$data[$i]->link.'">'.$data[$i]->name.' ('. $data[$i]->count .')</a></li>';
		}
		echo '<ul id="agg-categories">'.$categories.'</ul>';
	}	
}

//refreshes page 
function refreshPage(){
   echo '<script>location.reload();</script>';
}