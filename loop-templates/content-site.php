<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

 
?>

<?php 
	//check on screenshot if > -7 days then run it ******consider making a function w days and meta field options
	$now = new DateTime("now");
	$checkScreenshot = get_post_meta($post->ID, 'screenshot-date', true);
	$screenshotDate = new DateTime($checkScreenshot);
	$diff = $screenshotDate->diff($now);
	$daysDiff = $diff->format('%R%a');
	if ($checkScreenshot === "" || $daysDiff > 7) {	
		$url = realpath(__DIR__ . '/..'); //set explicit paths to bin etc.
		require $url . '/inc/screenshot.php';
		makeFeatured($post->ID);
		//screenshotThumb($post->ID); //create 300x300 thumbnail --NO LONGER NEEDED W FEATURED INTEGRATION
	}
?>


<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->
	<?php //echo showScreenshot( $post->ID); CAN DELETE ?>
	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
	<div class="entry-content">	
	<?php //GET WP JSON DATA FROM SOURCE URL AND UPDATE TITLE IF IT DOESN'T MATCH
		getAggData(get_the_ID());
	?>	
	<?php the_tags( 'Tags: ', ', ', '<br />' ); //output tags for site?> 
	<?php echo get_the_category_list(); ?>
		<?php the_content(); ?>
		<?php aggSiteCategories($post->ID);?>
		<div class="row"><!--show site content via api-->
			<div id="posts" class="col-md-6">
				<h2>Posts</h2>
				<?php  echo 'Total Posts: ' .get_post_meta($post->ID, 'total-posts', true);?>
			</div>

			<div id="pages" class="col-md-6">
				<h2>Pages</h2>
				<?php  echo 'Total Pages: ' .get_post_meta($post->ID, 'total-pages', true);?>
			</div>
		</div>	
		<script>
		var posts = <?php echo '"' . verifySlash(get_post_meta( get_the_ID(), 'site-url', true )) . 'wp-json/wp/v2/posts?_embed&per_page=10";';?>
		var pages = <?php echo '"' . verifySlash(get_post_meta( get_the_ID(), 'site-url', true )) . 'wp-json/wp/v2/pages?_embed&per_page=10";';?>
		
		getContent(posts, 'posts');
		getContent(pages, 'pages');

		function getContent(url, destination){
		    jQuery(document).ready(function() {
		      var def = new jQuery.Deferred();
		      jQuery.ajax({
		        url: url,
		        jsonp: "cb",
		        dataType: 'json',
		        success: function(data) {
		            console.log(data); //dumps the data to the console to check if the callback is made successfully.
		            	jQuery.each(data, function(index, item) {
			            	try {
					            jQuery('#'+destination).append('<div class="synd-post"><h4 class="synd-post-title"><a href="'+item.link+'">'+item.title.rendered+'</a></h4><div class="synd-post-content">' + item.content.rendered + '</div></div>');//adds an h4 element with the title to the div with id posts}
					             jQuery('.synd-post').fadeIn(3000);//animating

					            } catch (err) {
				        		console.log(err);
				        	}
			            }); //each          
		        	
		          } //success
		      }); //ajax  
		    }); //ready
		}

		//does background image for posts based on 
		function backgroundImg (item) {
		      if(item._embedded['wp:featuredmedia']){
		        var imgUrl = item._embedded['wp:featuredmedia'][0].media_details.sizes.thumbnail.source_url;
		        return 'style="background-image:url('+imgUrl+');"';
		      }
		    else {
		        //return 'style="background-image:url(https://c1.staticflickr.com/5/4165/34235788350_ce2563a421_q.jpg);"';
		        return 'style="background-color: #ecf0f1; padding: 5px;"';
		      }

		    }
		</script>	
		<?php
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'understrap' ),
			'after'  => '</div>',
		) );
		?>
	
	</div><!-- .entry-content -->

	<footer class="entry-footer">

		<?php edit_post_link( __( 'Edit', 'understrap' ), '<span class="edit-link">', '</span>' ); ?>

	</footer><!-- .entry-footer -->

</article><!-- #post-## -->
