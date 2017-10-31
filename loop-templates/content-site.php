<?php
/**
 * Partial template for content in page.php
 *
 * @package understrap
 */

?>
<article <?php post_class(); ?> id="post-<?php the_ID(); ?>">

	<header class="entry-header">

		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>

	</header><!-- .entry-header -->

	<?php echo get_the_post_thumbnail( $post->ID, 'large' ); ?>
	<div class="entry-content">
	
	<?php //GET WP JSON DATA FROM SOURCE URL AND UPDATE TITLE IF IT DOESN'T MATCH
		getAggData(get_the_ID());
	?>	
	<?php the_tags( 'Tags: ', ', ', '<br />' ); //output tags for site?> 
	<?php echo get_the_category_list(); ?>
		<?php the_content(); ?>
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
		var posts = <?php echo '"' . verifySlash(get_post_meta( get_the_ID(), 'site-url', true )) . 'wp-json/wp/v2/posts?_embed";';?>
		var pages = <?php echo '"' . verifySlash(get_post_meta( get_the_ID(), 'site-url', true )) . 'wp-json/wp/v2/pages?_embed";';?>
		
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
		              jQuery('#'+destination).append('<h4><a href="'+item.link+'">'+item.title.rendered+'</a></h4><div class="post-content">' + item.content.rendered + '</div>');//adds an h4 element with the title to the div with id posts
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
