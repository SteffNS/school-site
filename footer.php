<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package School_Site
 */

?>

	<footer id="colophon" class="site-footer">
		<div class="site-info">
			<p>Educational Purposes</p>
		</div><!-- .site-info -->
		<div>
		<?php
			/* translators: 1: Theme name, 2: Theme author. */
			printf( esc_html__( 'Theme: %1$s by %2$s.', 'school-site' ), 'school-site', '<a href="http://steffenns.com">Steffen Neves-Silva</a>' );
		?>
		</div>
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
