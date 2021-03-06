<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">		
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="widget-title">', '</h1>' );
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif; ?>
	</header><!-- .entry-header -->

	<div class="entry-content photo-content">

		<?php if( get_post_gallery() ) : ?>
			<div class="loading-photos">Loading photos... (<span></span>)</div>
		<?php endif; ?>
		<?php
            // if ( has_post_thumbnail() ) { // check if the post has a Post Thumbnail assigned to it.
            // 	the_post_thumbnail( 'full' );
			// }
			
			the_content();
		?>
		<?php
			$prev_post = get_previous_post();
			if($prev_post) {
				$prev_title = strip_tags(str_replace('"', '', $prev_post->post_title));
				echo "\t" . '<a class="prev-photo" rel="prev" href="' . get_permalink($prev_post->ID) . '" title="' . $prev_title. '"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>' . "\n";
			}

			$next_post = get_next_post();
				if($next_post) {
				$next_title = strip_tags(str_replace('"', '', $next_post->post_title));
				echo "\t" . '<a class="next-photo" rel="next" href="' . get_permalink($next_post->ID) . '" title="' . $next_title. '"><i class="fa fa-chevron-right" aria-hidden="true"></i></a>' . "\n";
			}
		?>
	</div><!-- .entry-content -->

	<?php get_template_part( 'template-parts/content', 'related-photos' ); ?>

	<?php // If comments are open or we have at least one comment, load up the comment template.
	if( xbox_get_field_value( 'wpst-options', 'enable-comments' ) == 'on' ) {
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;
	} ?>
</article><!-- #post-## -->