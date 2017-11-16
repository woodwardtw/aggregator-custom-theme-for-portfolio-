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
		'singular_name' => __( 'Site', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => __( 'Sites', 'textdomain' ),
		'name_admin_bar' => __( 'Site', 'textdomain' ),
		'archives' => __( 'Site Archives', 'textdomain' ),
		'attributes' => __( 'Site Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Site:', 'textdomain' ),
		'all_items' => __( 'All Sites', 'textdomain' ),
		'add_new_item' => __( 'Add New Site', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New Site', 'textdomain' ),
		'edit_item' => __( 'Edit Site', 'textdomain' ),
		'update_item' => __( 'Update Site', 'textdomain' ),
		'view_item' => __( 'View Site', 'textdomain' ),
		'view_items' => __( 'View Sites', 'textdomain' ),
		'search_items' => __( 'Search Sites', 'textdomain' ),
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
		'description' => __( 'Student Sites', 'textdomain' ),
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
		'menu_icon' => 'dashicons-admin-users',
	);
	register_post_type( 'site', $args );

}
add_action( 'init', 'create_site_cpt', 0 );

//CUSTOM POST TYPE FOR PROGRAMS
function create_program_cpt() {

	$labels = array(
		'name' => __( 'Programs', 'Post Type General Name', 'textdomain' ),
		'singular_name' => __( 'Program', 'Post Type Singular Name', 'textdomain' ),
		'menu_name' => __( 'Programs', 'textdomain' ),
		'name_admin_bar' => __( 'Program', 'textdomain' ),
		'archives' => __( 'Program Archives', 'textdomain' ),
		'attributes' => __( 'Program Attributes', 'textdomain' ),
		'parent_item_colon' => __( 'Parent Program:', 'textdomain' ),
		'all_items' => __( 'All Programs', 'textdomain' ),
		'add_new_item' => __( 'Add New Program', 'textdomain' ),
		'add_new' => __( 'Add New', 'textdomain' ),
		'new_item' => __( 'New Program', 'textdomain' ),
		'edit_item' => __( 'Edit Program', 'textdomain' ),
		'update_item' => __( 'Update Program', 'textdomain' ),
		'view_item' => __( 'View Program', 'textdomain' ),
		'view_items' => __( 'View Programs', 'textdomain' ),
		'search_items' => __( 'Search Programs', 'textdomain' ),
		'not_found' => __( 'Your program was not found', 'textdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'textdomain' ),
		'featured_image' => __( 'Featured Image', 'textdomain' ),
		'set_featured_image' => __( 'Set featured image', 'textdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'textdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'textdomain' ),
		'insert_into_item' => __( 'Insert into program', 'textdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this program', 'textdomain' ),
		'items_list' => __( 'Programs list', 'textdomain' ),
		'items_list_navigation' => __( 'programs list navigation', 'textdomain' ),
		'filter_items_list' => __( 'Filter programs list', 'textdomain' ),
	);
	$args = array(
		'label' => __( 'program', 'textdomain' ),
		'description' => __( 'Program', 'textdomain' ),
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
		'menu_icon' => 'dashicons-admin-multisite',
	);
	register_post_type( 'program', $args );

}
add_action( 'init', 'create_program_cpt', 0 );

//END CUSTOM POST TYPE FOR PROGRAMS



//add custom meta box for site URL for SITES POSTS

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
		missingResponse($id, 'not-modern-wordpress');
	} else {
	$data = json_decode( wp_remote_retrieve_body( $response ) ); //on success update post
		$syndicatedDescription = $data->description;			
		updateTags($id,$data);
	}
	try {
		totalPosts($id);
	} catch (Exception $e) {
    	echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
	try {
		totalPages($id);
	} catch (Exception $e) {
     	echo 'Caught exception: ',  $e->getMessage(), "\n";
	} try {
		updateTitle($id,$data,$siteURL);	  		  	
	} catch (Exception $e) {
     	echo 'Caught exception: ',  $e->getMessage(), "\n";
	}
}

function updateTitle($id,$data,$url){
	if ($data->name !=""){
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
	} else {
        $syndicatedTitle = wptexturize(get_title($url));
        $currentTitle = get_the_title();      
		if ($currentTitle != $syndicatedTitle){
			$the_post = array(
			    'ID'           => $id,
			    'post_title'   => $syndicatedTitle,
			    'post_name' => '', //passes empty string to force regeneration of permalink based on title change
			  		);				
			wp_update_post( $the_post );// Update the post in the database
			refreshPage();
		}
	}
}


//from https://stackoverflow.com/questions/4348912/get-title-of-website-via-link
function get_title($url){
  $str = file_get_contents($url);
  if(strlen($str)>0){
    $str = trim(preg_replace('/\s+/', ' ', $str)); // supports line breaks inside <title>
    preg_match("/\<title\>(.*)\<\/title\>/i",$str,$title); // ignore case
    return $title[1];
  }
}


function updateTags($id,$data){
	if ($data->ddm_tag){
		$extra = $data->ddm_tag;
		$postTags = wp_get_post_tags($id);	  
		$postTagsArray = [];
		for ($i = 0; $i < count($postTags); $i++){
		  	array_push($postTagsArray, $postTags[$i]->name);
		}
		if (count(array_diff($extra,$postTagsArray))>0) {
				$tags = implode(",",$extra); //stringify it 
		  		wp_set_post_tags($id, $tags, true );
		  	}	
		 } else {
	 	missingResponse($id, 'no-base-tags');
	 }

}

//adds 404 tag to sites that don't respond for filtering purposes (keep the post for archival purposes but remove from active listings via wp query)
function missingResponse($id, $status){
	  	//update_post_meta( $id, 'site-status', $status);
	  	wp_set_post_tags( $id, $status, false ); //opted not to reset tags to null but might change back to true . . . 
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


//gets total posts and allows wp query vs value or a sort to show more posts up front & adds to REST API
function totalPosts($id){
	$siteURL = verifySlash(get_post_meta( $id, 'site-url', true ));	
	$response = wp_remote_get($siteURL . 'wp-json/wp/v2/posts?per_page=1' );	
	if(is_wp_error( $response ) || $response == 404){ //on failure add tag 404
		missingResponse($id, 'no-posts');
	} else {
		$total = $response['headers']['x-wp-total'];	
		if ($total){
			update_post_meta( $id, 'total-posts', $total);
		}
		//recent update date for posts
		$data = json_decode( wp_remote_retrieve_body( $response ) );
		if ($data != ""){ //make sure it's WP
			if ($data->code === false || $data->code != 'rest_no_route'){//make sure it's not an old version of WP
				update_post_meta( $id, 'recent-update-posts', $data[0]->date );
			}
		}
	}
}


//gets total pages and allows wp query vs value or a sort to show more posts up front
function totalPages($id){
	$siteURL = verifySlash(get_post_meta( $id, 'site-url', true ));	
	$response = wp_remote_get($siteURL . 'wp-json/wp/v2/pages?per_page=1' );	
	if(is_wp_error( $response ) || $response == 404){ //on failure add tag 404
		missingResponse($id, 'no-pages');
	} else {
		$total = $response['headers']['x-wp-total'];
		update_post_meta( $id, 'total-pages', $total);
		$data = json_decode( wp_remote_retrieve_body( $response ) );
		if($data != ""){//make sure it's WP
			if ($data->code != 'rest_no_route'){ //make sure it's not an old version of WP
				update_post_meta( $id, 'recent-update-pages', $data[0]->date );
			}
		}
	}
}


//gets list of ten most common categories and links to them
function aggSiteCategories($id){
	$siteURL = verifySlash(get_post_meta( $id, 'site-url', true ));	
	$response = wp_remote_get($siteURL . 'wp-json/wp/v2/categories?orderby=count&per_page=10&order=desc' );
	if(is_wp_error( $response ) || $response == 404){ //on failure add tag 404
		missingResponse($id, 'no-categories');
	} else {
		$categories = '';
		$data = json_decode( wp_remote_retrieve_body( $response ) );
		if ($data === true) {
			for ($i = 0; $i < sizeof($data); $i++ ){
				if ($data[$i]->count>0){//make sure the category is actually in use
					$categories .= '<li><a href="'.$data[$i]->link.'">'.$data[$i]->name.' ('. $data[$i]->count .')</a></li>';
				}
			}
		}
		echo '<ul id="agg-categories">'.$categories.'</ul>';
	}	
}

//refreshes page 
function refreshPage(){
   echo '<script>location.reload();</script>';
}


//do the screenshot to featured image gymnastics

function makeFeatured($id){
	$remoteSite = get_post_meta( $id, 'site-url', true ); //the URL referenced in the post
	$cleanUrl = preg_replace("(^https?://)", "", $remoteSite ); //remove http or https
	$cleanUrl = str_replace('/', "_", $cleanUrl); //replace / with _
	$img_url = get_template_directory()  . '/screenshots/' . $cleanUrl . '.jpg';


    $upload_dir = wp_upload_dir();
    if (file_exists($img_url)) {
    	$image_data = file_get_contents($img_url); 
	    $filename = basename($img_url);
	    if(wp_mkdir_p($upload_dir['path'])){
	    	$file = $upload_dir['path'] . '/' . $filename;
	    }
	    else{
	    	$file = $upload_dir['basedir'] . '/' . $filename;
		}
	    file_put_contents($file, $image_data);

	    $wp_filetype = wp_check_filetype($filename, null );
	    $attachment = array(
	        'post_mime_type' => $wp_filetype['type'],
	        'post_title' => sanitize_file_name($filename),
	        'post_content' => '',
	        'post_status' => 'inherit'
	    );
	    $attach_id = wp_insert_attachment( $attachment, $file, $id );
	    require_once(ABSPATH . 'wp-admin/includes/image.php');
	    $attach_data = wp_generate_attachment_metadata( $attach_id, $file );
	    $res1= wp_update_attachment_metadata( $attach_id, $attach_data );
	    $res2= set_post_thumbnail( $id, $attach_id );
	   
	   	unlink($img_url); //deletes screenshot
    }
}

//PUT CUSTOM FIELDS into the REST API
add_action( 'rest_api_init', 'create_api_posts_meta_field' );
 
function create_api_posts_meta_field() {
    register_rest_field( 'site', 'synd-site-data', array(
           'get_callback'    => 'get_post_meta_for_api',
           'schema'          => null,
        )
    );
}
 
function get_post_meta_for_api( $object ) {
    //get the id of the post object array
    $post_id = $object['id'];
 	$page_update = get_post_meta( $post_id, 'recent-update-pages', true );
 	$post_update = get_post_meta( $post_id, 'recent-update-posts', true );
 	$total_pages = get_post_meta( $post_id, 'total-pages', true );
 	$total_posts = get_post_meta( $post_id, 'total-posts', true );
    //return the post meta data
    $meta = array(
    	'page-update' => $page_update,
    	'post-update' => $post_update,
    	'total-pages' => $total_pages,
    	'total-posts' => $total_posts
    );
    return $meta;
}



/*
**
**
THINGS THAT INVOLVE GETTING THE DATA FROM AFAR --- PROGRAM LEVEL
**
**
*/

//hook into tags from sites custom post type and display under two headings include and exclude


