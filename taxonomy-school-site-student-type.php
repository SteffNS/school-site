<?php
/**
 * The template for displaying Student Type archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Site
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1><?php single_term_title();?></h1>
				<?php
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->
			<?php
			/* Start the Loop */
			echo "<section class='student-single-wrapper'>";
			while ( have_posts() ) :
				echo "<section class='student-single'>";
					the_post();
					?>
					<a href='<?php the_permalink();?>'>
						<h2><?php the_title();?></h2>
					</a>
					<?php
					the_post_thumbnail('portrait-person');
					the_content();

				/*
				 * Include the Post-Type-specific template for the content.
				 * If you want to override this in a child theme, then include a file
				 * called content-___.php (where ___ is the Post Type name) and that will be used instead.
				 */
				echo "</section>";
			endwhile;
			echo "</section>";

			the_posts_navigation();
		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
