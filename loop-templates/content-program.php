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
	
		<?php the_content(); ?>
		
		<?php 

		$exclude = get_term_by('name', '404', 'post_tag');
		$exclude = [$exclude->term_id];

		$theTags = get_the_tags();
		$argTags = [];
		if ($theTags) {
		  foreach($theTags as $tag) {
		    array_push($argTags,$tag->term_id); 
		  }
		}
				
		$args = array(
			//'tag_slug__and' => array( $argTags ), //(array) - use tag slugs.
			//'tag_slug__in' => array( 'red', 'blue'),  //(array) - use tag slugs.
			'tag__in' => $argTags,
			'tag__not_in' => $exclude,
			'post_type' => 'site',
			'post_status' => 'publish',
			'posts_per_page' => 30,
			'paged' => get_query_var('paged'), 
		);
		$the_query = new WP_Query( $args );
		// The Loop
		if ( $the_query->have_posts() ) :
		while ( $the_query->have_posts() ) : $the_query->the_post();
		  
		  echo '<a href="' . get_permalink() . '">';
		  echo '<h3 class="site-title">';  		  
		  the_title();	
		  echo '</h3></a>';	  
		endwhile;
		endif;
		// Reset Post Data
		wp_reset_postdata();


		?>

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
