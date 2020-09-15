<?php
    $videos_per_row = xbox_get_field_value( 'wpst-options', 'videos-per-row' );
    if( $videos_per_row == '2' ){
        $videos_per_row = '50';
    }elseif( $videos_per_row == '3' ){
        $videos_per_row = '33.33';
    }elseif( $videos_per_row == '4' ){
        $videos_per_row = '25';
    }elseif( $videos_per_row == '5' ){
        $videos_per_row = '20';
    }elseif( $videos_per_row == '6' ){
        $videos_per_row = '16.66';
    }
?>

<style>

    @import url(https://fonts.googleapis.com/css?family=<?php echo xbox_get_field_value( 'wpst-options', 'logo-font-family' ); ?>);    
    body.custom-background {
        background-image: url(<?php echo xbox_get_field_value( 'wpst-options', 'background-image' ); ?>);
        background-color: <?php echo xbox_get_field_value( 'wpst-options', 'background-color' ); ?>!important;
        background-repeat: <?php echo xbox_get_field_value( 'wpst-options', 'background-repeat' ); ?>;
        background-attachment: <?php echo xbox_get_field_value( 'wpst-options', 'background-attachment' ); ?>;
    }
    .site-title a {        
        font-family: <?php echo xbox_get_field_value( 'wpst-options', 'logo-font-family' ); ?>;
        font-size: <?php echo xbox_get_field_value( 'wpst-options', 'logo-font-size' ); ?>px;
    }
    .site-branding .logo img {
        max-width: <?php echo xbox_get_field_value( 'wpst-options', 'logo-max-width' ); ?>px;
        max-height: <?php echo xbox_get_field_value( 'wpst-options', 'logo-max-height' ); ?>px;
        margin-top: <?php echo xbox_get_field_value( 'wpst-options', 'logo-margin-top' ); ?>px;
        margin-left: <?php echo xbox_get_field_value( 'wpst-options', 'logo-margin-left' ); ?>px;
    }
    a,
    .site-title a i,
    .thumb-block:hover .rating-bar i,
    .categories-list .thumb-block:hover .entry-header .cat-title:before,
    .required,
    .like #more:hover i,
    .dislike #less:hover i,
    .top-bar i:hover,
    .main-navigation .menu-item-has-children > a:after,
    .menu-toggle i,
    .main-navigation.toggled li:hover > a,
    .main-navigation.toggled li.focus > a,
    .main-navigation.toggled li.current_page_item > a,
    .main-navigation.toggled li.current-menu-item > a,
    #filters .filters-select:after,
    .morelink i,
    .top-bar .membership a i,
    .thumb-block:hover .photos-count i {
        color: <?php echo xbox_get_field_value( 'wpst-options', 'main-color' ); ?>;
    }
    button,
    .button,
    input[type="button"],
    input[type="reset"],
    input[type="submit"],
    .label,
    .pagination ul li a.current,
    .pagination ul li a:hover,
    body #filters .label.secondary.active,
    .label.secondary:hover,
    .main-navigation li:hover > a,
    .main-navigation li.focus > a,
    .main-navigation li.current_page_item > a,
    .main-navigation li.current-menu-item > a,
    .widget_categories ul li a:hover,
    .comment-reply-link,
    a.tag-cloud-link:hover,
    .template-actors li a:hover {
        border-color: <?php echo xbox_get_field_value( 'wpst-options', 'main-color' ); ?>!important;
        background-color: <?php echo xbox_get_field_value( 'wpst-options', 'main-color' ); ?>!important;
    }
    .rating-bar-meter,
    .vjs-play-progress,
    #filters .filters-options span:hover,
    .bx-wrapper .bx-controls-direction a,
    .top-bar .social-share a:hover,
    .thumb-block:hover span.hd-video,
    .featured-carousel .slide a:hover span.hd-video {
        background-color: <?php echo xbox_get_field_value( 'wpst-options', 'main-color' ); ?>!important;
    }
    #video-tabs button.tab-link.active,
    .title-block,
    .widget-title,
    .page-title,
    .page .entry-title,
    .comments-title,
    .comment-reply-title,
    .morelink:hover {
        border-color: <?php echo xbox_get_field_value( 'wpst-options', 'main-color' ); ?>!important;
    }    
    .logo-watermark-img {
        max-width: <?php echo xbox_get_field_value( 'wpst-options', 'logo-watermark-max-width' ); ?>px;
    }

    <?php if( xbox_get_field_value( 'wpst-options', 'logo-watermark-grayscale' ) == 'on' ) : ?>
        .logo_maintain_display img {
            -webkit-filter: saturate(0);
	        filter: saturate(0);
        }
    <?php endif; ?>

    /* Small desktops ----------- */
    @media only screen  and (min-width : 64.001em) and (max-width : 84em) {
        #main .thumb-block {
            width: <?php echo $videos_per_row; ?>%!important;
        }
    }

    /* Desktops and laptops ----------- */
    @media only screen  and (min-width : 84.001em) {
        #main .thumb-block {
            width: <?php echo $videos_per_row; ?>%!important;
        }
    }

</style>