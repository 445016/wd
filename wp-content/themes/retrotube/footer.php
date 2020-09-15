	</div><!-- #content -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="row">			
			<?php if(wp_is_mobile() && xbox_get_field_value( 'wpst-options', 'footer-ad-mobile' ) != '') : ?>
				<div class="happy-footer">
					<?php echo wpst_render_shortcodes( xbox_get_field_value( 'wpst-options', 'footer-ad-mobile' ) ); ?>
				</div>
			<?php elseif(xbox_get_field_value( 'wpst-options', 'footer-ad-desktop' ) != '') : ?>
				<div class="happy-footer">
					<?php echo wpst_render_shortcodes( xbox_get_field_value( 'wpst-options', 'footer-ad-desktop' ) ); ?>
				</div>
			<?php endif; ?>
			<?php if ( function_exists('dynamic_sidebar') && is_active_sidebar('footer') ) : ?>
				<div class="<?php echo xbox_get_field_value( 'wpst-options', 'footer-columns' ); ?>">
					<?php dynamic_sidebar('footer'); ?>
				</div>
			<?php endif; ?>

			<div class="clear"></div>			

			<?php if ( xbox_get_field_value( 'wpst-options', 'use-logo-image' ) == 'on' ) : ?>
				<div class="logo-footer">
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><img class="grayscale" src="<?php echo xbox_get_field_value( 'wpst-options', 'image-logo-file' ); ?>"></a>
				</div>
			<?php endif; ?>

			<?php if ( has_nav_menu( 'wpst-footer-menu' ) ) : ?>
				<div class="footer-menu-container">				
					<?php wp_nav_menu( array( 'theme_location' => 'wpst-footer-menu' ) ); ?>
				</div>			
			<?php endif; ?>

			<?php if( xbox_get_field_value( 'wpst-options', 'copyright-bar' ) == 'on' ) : ?>
				<div class="site-info">
					<?php echo xbox_get_field_value( 'wpst-options', 'copyright-text' ); ?>
				</div><!-- .site-info -->
			<?php endif; ?>
		
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<a class="button" href="#" id="back-to-top" title="Back to top"><i class="fa fa-chevron-up"></i></a>

<?php wp_footer(); ?>

<!-- Other scripts -->
<?php if(xbox_get_field_value( 'wpst-options', 'other-scripts' ) != '') { echo xbox_get_field_value( 'wpst-options', 'other-scripts' ); } ?>

<?php if(is_single()) : ?>
	<!-- <script>
		var myFP = fluidPlayer(
			'my-video',
			{
				layoutControls: {
					fillToContainer: true,
					responsive: true,
					primaryColor: "<?php echo xbox_get_field_value( 'wpst-options', 'main-color' ); ?>",
					posterImage: '',
					autoPlay: false,
					playButtonShowing: true,
					playPauseAnimation: false,
					mute: false,
					logo: {
						imageUrl: null,
						position: 'top left',
						clickUrl: null,
						opacity: 1,
						mouseOverImageUrl: null,
						imageMargin: '2px',
						hideWithControls: false,
						showOverAds: false
					},
					htmlOnPauseBlock: {
						html: '<a href="https://www.fluidplayer.com"><img src="https://www.fluidplayer.com/images/sample-banner.png" /></a>',
						height: 250,
						width: 300
					},
					allowDownload: true,
					allowTheatre: false,
					playbackRateEnabled: false,
					controlBar: {
						autoHide: false,
						autoHideTimeout: 3,
						animated: true
					},
				},				
				vastOptions: {
					"adList" : [
						{
						"roll" : "preRoll",
						"vastTag" : "https://syndication.exoclick.com/splash.php?idzone=2366423"
						},
						{
						"roll" : "midRoll",
						"vastTag" : "https://syndication.exoclick.com/splash.php?idzone=2366423",
						"timer" : '50%'
						},
						{
						"roll" : "postRoll",
						"vastTag" : "https://syndication.exoclick.com/splash.php?idzone=2366423"
						}

					]
				}
			}
		);
	</script> -->
<?php endif; ?>

</body>
</html>