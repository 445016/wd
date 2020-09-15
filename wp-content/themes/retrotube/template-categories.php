<?php
/**
 * Template Name: Categories 
 **/
get_header(); ?>

<?php if( xbox_get_field_value( 'wpst-options', 'show-sidebar' ) == 'on') {
	if( xbox_get_field_value( 'wpst-options', 'sidebar-position' ) == 'sidebar-right' ) { $sidebar_pos = 'with-sidebar-right'; } else { $sidebar_pos = 'with-sidebar-left'; }
}else{
	$sidebar_pos = '';
} ?>

	<div id="primary" class="content-area <?php echo $sidebar_pos; ?> categories-list">
        <main id="main" class="site-main <?php echo $sidebar_pos; ?>" role="main">

        <header class="entry-header">
            <?php the_title( '<h1 class="widget-title"><i class="fa fa-folder"></i>', '</h1>' ); ?>
        </header>

        <?php the_content(); ?>

        <div class="videos-list">
            <?php
            $terms = get_terms( array(
                'taxonomy' => 'category',
                'hide_empty' => true,
                ) );
            $count = count($terms);
            $categories = array();

            if ($count > 0) :
            
                foreach ($terms as $term) {

                    $args = array(
                        'post_type'        => 'post',
                        'posts_per_page'   => 1,
                        'show_count'       => 1,
                        'orderby'          => 'rand',
                        'post_status'      => 'publish',
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'category',
                                'field' => 'slug',
                                'terms' => $term->slug
                                )
                            )
                        );

                    $video_from_category = new WP_Query( $args );

                    if( $video_from_category->have_posts() ){

                        $video_from_category->the_post();

                    }else{}

                    $term->slug;
                    $term->name; ?>               

                    <article id="post-<?php the_ID(); ?>" <?php post_class('thumb-block'); ?>>
                        <a href="<?php echo get_category_link( get_cat_ID($term->name) ); ?>" title="<?php echo $term->name; ?>">
                            <!-- Thumbnail -->
                            <div class="post-thumbnail">
                                <?php $thumb_url = get_post_meta($post->ID, 'thumb', true);
                                $image_id = get_term_meta( $term->term_id, 'category-image-id', true );
                                $cat_image = wp_get_attachment_image( $image_id, 'wpst_thumb_medium' );
                                if ( $cat_image ){
                                    echo $cat_image;
                                }elseif ( has_post_thumbnail() ){                                  
                                    the_post_thumbnail('wpst_thumb_medium', array( 'alt' => get_the_title() ));
                                }elseif( $thumb_url != '' ){
                                    echo '<img src="' . $thumb_url . '" alt="' . get_the_title() . '">';
                                }else{
                                    echo '<div class="no-thumb"><span><i class="fa fa-image"></i> ' . esc_html__('No image', 'wpst') . '</span></div>';
                                } ?>		
                                <?php if( !wp_is_mobile() ) : ?><div class="play-icon-hover"><i class="fa fa-folder-open-o"></i></div><?php endif; ?>
                            </div>

                            <header class="entry-header">		
                                <span class="cat-title"><?php echo $term->name; ?></span>
                            </header><!-- .entry-header -->
                        </a>
                    </article><!-- #post-## -->

                <?php }

            endif; ?>
            </div>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_sidebar();
get_footer();