<div class="under-video-block">    
    <?php //$nb_videos_related = get_theme_mod('wpsevst_nb_videos_related', '10');
    //get the taxonomy terms of custom post type
    $customTaxonomyTerms = wp_get_object_terms( $post->ID, 'photos_category', array('fields' => 'ids') );

    //query arguments
    $args = array(
        'post_type' => 'photos',
        'post_status' => 'publish',
        'posts_per_page' => 10,
        'orderby' => 'rand',
        'tax_query' => array(
            array(
                'taxonomy' => 'photos_category',
                'field' => 'id',
                'terms' => $customTaxonomyTerms
            )
        ),
        'post__not_in' => array ($post->ID),
    );

    //the query
    $relatedPosts = new WP_Query( $args );

    if($relatedPosts->have_posts()) : ?>
        <h2 class="widget-title"><?php esc_html_e( 'Related photos', 'wpst' ); ?></h2>
        <div class="videos-list">
        <?php while($relatedPosts->have_posts()){ 
            $relatedPosts->the_post();
            get_template_part( 'template-parts/loop', get_post_format() ? : 'photo' );
        } ?>
        </div>
    <?php endif;

    //restore original post data
    wp_reset_postdata(); ?>
    
<div class="clear"></div> 