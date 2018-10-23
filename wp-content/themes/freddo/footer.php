<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package freddo
 */

?>

	</div><!-- #content -->
	<?php $showSearchButton = freddo_options('_search_button', '1');
	if ($showSearchButton) : ?>
	<!-- Start: Search Form -->
	<div class="opacityBoxSearch"></div>
	<div class="search-container">
		<?php get_search_form(); ?>
	</div>
	<!-- End: Search Form -->
	<?php endif; ?>

	<footer id="colophon" class="site-footer">
		<div class="mainFooter">
			<?php if ( is_active_sidebar( 'footer-1' ) || is_active_sidebar( 'footer-2' ) || is_active_sidebar( 'footer-3' ) ) : ?>
				<div class="footerArea">
					<div class="freddoFooterWidget">
						<?php if ( is_active_sidebar( 'footer-1' ) ) : ?>
							<aside id="footer-1" class="widget-area footer" role="complementary">
								<?php dynamic_sidebar( 'footer-1' ); ?>
							</aside><!-- #footer-1 -->
						<?php endif; ?>
						<?php if ( is_active_sidebar( 'footer-2' ) ) : ?>
							<aside id="footer-2" class="widget-area footer" role="complementary">
								<?php dynamic_sidebar( 'footer-2' ); ?>
							</aside><!-- #footer-2 -->
						<?php endif; ?>
						<aside id="footer-4" class="widget-area footer" role="complementary">
							<section id="custom_html-4" class="widget_text widget widget_custom_html">
								<div class="widget-title"><h3>Our product	</h3></div>
								<div class="textwidget custom-html-widget">
									<p>
										<a href="http://blockmeta.com/">Blockchain Explorer beta</a>
									</p>
									<p>
										<a href="/wallet" target="_blank">Wallet</a>
									</p>
									<p>
										<a href="javascript:;" style="opacity: 0.5">Testnet</a>
									</p>
								</div>
							</section>							
						</aside>
						<?php if ( is_active_sidebar( 'footer-3' ) ) : ?>
							<aside id="footer-3" class="widget-area footer" role="complementary">
								<?php dynamic_sidebar( 'footer-3' ); ?>
							</aside><!-- #footer-3 -->
						<?php endif; ?>
					</div>
				</div>
			<?php endif; ?>
			<div class="site-copy-down">
				<a>Copyright ©2018 bytom.io</a>
			</div><!-- .site-copy-down -->
			<nav id="footer-navigation" class="second-navigation">
				<?php wp_nav_menu( array( 'theme_location' => 'footer', 'menu_id' => 'footer-menu', 'depth' => 1, 'fallback_cb' => false ) ); ?>
			</nav>
		</div><!-- .mainFooter -->
	</footer><!-- #colophon -->
</div><!-- #page -->
<?php $scrollToTopMobile = freddo_options('_scroll_top', ''); ?>
<a href="#top" id="toTop" class="<?php echo $scrollToTopMobile ? 'scrolltop_on' : 'scrolltop_off' ?>"><i class="fa fa-angle-up fa-lg"></i></a>
<?php wp_footer(); ?>

</body>
<script>
var wow = new WOW(
  {
    boxClass:     'wow',      // animated element css class (default is wow)
    animateClass: 'animated', // animation css class (default is animated)
    offset:       0,          // distance to the element when triggering the animation (default is 0)
    mobile:       true,       // trigger animations on mobile devices (default is true)
    live:         true,       // act on asynchronously loaded content (default is true)
    callback:     function(box) {
      // the callback is fired every time an animation is started
      // the argument that is passed in is the DOM node being animated
    },
    scrollContainer: null // optional scroll container selector, otherwise use window
  }
);
wow.init();
</script>
</html>
