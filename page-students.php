<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package School_Site
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		get_template_part( 'template-parts/content', 'page' );

		// If comments are open or we have at least one comment, load up the comment template.
		if ( comments_open() || get_comments_number() ) :
			comments_template();
		endif;

		$args = array(
			'post_type' => 'school_site_student',
			'posts_per_page' => -1,
			'orderby' => 'title',
			'order' => 'ASC',
		);

		$query = new WP_Query($args);
		echo "<section class='students-section'>";
		while($query->have_posts()) :
			?> 
			<article> 
				<?php
				$query->the_post();
				?>
				<h2><?php the_title();?></h2>
				<?php
				the_post_thumbnail('small');
				the_excerpt();

				//found a code snippet on wp docs to get this working
				//https://developer.wordpress.org/reference/functions/get_the_terms/#comment-2587
				$specialty = get_the_terms($query->ID, 'school-site-student-type');
				$specialty_list = join(',', wp_list_pluck($specialty, 'name'));
				echo "Specialty: " . $specialty_list;
				?>
			</article>
			<?php
		endwhile;
		echo "</section>";

		?>

	</main><!-- #main -->

<?php
get_footer();
