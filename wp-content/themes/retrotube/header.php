<!DOCTYPE html>

<?php require get_template_directory() . '/inc/init.php';?>

<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="icon" href="<?php echo xbox_get_field_value( 'wpst-options', 'favicon' ); ?>">

<!-- Meta social networks -->
<?php if(is_single()){
	require get_template_directory() . '/inc/meta-social.php';
} ?>

<!-- Temp Style -->
<?php require get_template_directory() . '/temp-style.php'; ?>

<!-- Google Analytics -->
<?php if(xbox_get_field_value( 'wpst-options', 'google-analytics' ) != '') { echo xbox_get_field_value( 'wpst-options', 'google-analytics' ); } ?>

<!-- Meta Verification -->
<?php if(xbox_get_field_value( 'wpst-options', 'meta-verification' ) != '') { echo xbox_get_field_value( 'wpst-options', 'meta-verification' ); } ?>

<?php wp_head(); ?>
</head>

<body <?php if(xbox_get_field_value( 'wpst-options', 'custom-background' ) == 'on') { body_class('custom-background'); }else{ body_class(''); } ?>>

<div id="page">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'wpst' ); ?></a>

	<header id="masthead" class="site-header" role="banner">
		
		<?php get_template_part( 'template-parts/content', 'top-bar' ); ?>
		
		<div class="site-branding row">
			<div class="logo">
				<?php if ( xbox_get_field_value( 'wpst-options', 'use-logo-image' ) == 'off' ) : ?>
					<?php if ( is_front_page() && is_home() ) : ?>
						<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php if(xbox_get_field_value( 'wpst-options', 'icon-logo' ) != '') : ?><i class="fa fa-<?php echo xbox_get_field_value( 'wpst-options', 'icon-logo' ); ?>"></i><?php endif; ?> <?php if(xbox_get_field_value( 'wpst-options', 'text-logo' ) != '') : ?><?php echo xbox_get_field_value( 'wpst-options', 'text-logo' ); ?><?php else : ?><?php bloginfo( 'name' ); ?><?php endif; ?></a></h1>
					<?php else : ?>
						<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php if(xbox_get_field_value( 'wpst-options', 'icon-logo' ) != '') : ?><i class="fa fa-<?php echo xbox_get_field_value( 'wpst-options', 'icon-logo' ); ?>"></i><?php endif; ?> <?php if(xbox_get_field_value( 'wpst-options', 'text-logo' ) != '') : ?><?php echo xbox_get_field_value( 'wpst-options', 'text-logo' ); ?><?php else : ?><?php bloginfo( 'name' ); ?><?php endif; ?></a></p>
					<?php endif; ?>					
				<?php else : ?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home" title="<?php echo get_bloginfo( 'name' ); ?>"><img src="<?php echo xbox_get_field_value( 'wpst-options', 'image-logo-file' ); ?>" alt="<?php echo get_bloginfo( 'name' ); ?>"></a>
				<?php endif; ?>

				<?php if ( xbox_get_field_value( 'wpst-options', 'show-text-slogan' ) == 'on' ) : ?>
					<p class="site-description"><?php if(xbox_get_field_value( 'wpst-options', 'text-slogan' ) != '') : ?><?php echo xbox_get_field_value( 'wpst-options', 'text-slogan' ); ?><?php else : ?><?php bloginfo( 'description', 'display' ); ?><?php endif; ?></p>
				<?php endif; ?>						
			</div>
			<?php if(xbox_get_field_value( 'wpst-options', 'show-search-bar' ) == 'on') : ?>
				<?php get_template_part( 'template-parts/content', 'header-search' ); ?>
			<?php endif; ?>
			
			<?php if(!wp_is_mobile() && xbox_get_field_value( 'wpst-options', 'header-ad-desktop' ) != '') : ?>
				<div class="happy-header">
					<?php echo wpst_render_shortcodes( xbox_get_field_value( 'wpst-options', 'header-ad-desktop' ) ); ?>
				</div>
			<?php endif; ?>

		</div><!-- .site-branding -->

		<nav id="site-navigation" class="main-navigation" role="navigation">
			<div id="head-mobile"></div>
			<div class="button-nav"></div>			
			<?php wp_nav_menu( array( 'theme_location' => 'wpst-main-menu', 'container' => false ) ); ?>
		</nav><!-- #site-navigation -->
		<div class="clear"></div>

		
		<?php if(wp_is_mobile() && xbox_get_field_value( 'wpst-options', 'header-ad-mobile' ) != '') : ?>
			<div class="happy-header-mobile">
				<?php echo wpst_render_shortcodes( xbox_get_field_value( 'wpst-options', 'header-ad-mobile' ) ); ?>
			</div>
		<?php endif; ?>
	</header><!-- #masthead -->

	<?php wpst_breadcrumbs(); ?>

	<?php get_template_part( 'template-parts/content', 'featured-carousel' ); ?>

	<div id="content" class="site-content row">		
