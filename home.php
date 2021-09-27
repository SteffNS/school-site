<?php
/**
 * The news template file
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Site
 */

get_header();
?>

	<main id="primary" class="site">

		<?php
		if ( have_posts() ) :

			if ( is_home() && ! is_front_page() ) :
				?>
				<header class="page-header">
					<h1><?php single_term_title(); ?>News</h1>
				</header><!-- .page-header -->
				<?php
			endif;

			/* Start the Loop */
			// while ( have_posts() ) :
			// 	the_post();
			// 	get_template_part( 'template-parts/content', get_post_type() );

			// endwhile;

			the_posts_navigation();

			$args = array(
                'post_type'      => 'post',
                'posts_per_page' => -1,
            );
            $query = new WP_Query($args);
            if($query->have_posts() ){
                while($query->have_posts()){
                    $query->the_post();
                    echo "<article>";
                        echo "<a href='".get_permalink()."'>";
                            echo "<h3>".get_the_title()."</h3>";
                            the_post_thumbnail('large');
                        echo "</a>";
                        the_excerpt('excerpt_more');
                    echo "</article>";
                }
                wp_reset_postdata();
                echo "</section>";
            };

		else :

			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

	</main><!-- #main -->

<?php
get_sidebar();
get_footer();