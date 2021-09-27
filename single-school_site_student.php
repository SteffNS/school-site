<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package School_Site
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		echo "<section class='student-profile'>";
		while ( have_posts() ) : 
			the_post();
			?>
			<h1><?php the_title();?></h1>

			<?php
			the_post_thumbnail('medium');
			the_content();

			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			?>
			<div class='taxonomy-list'>

				<?php
				$specialty = get_the_terms($post->ID, 'school-site-student-type');
				$specialty_list = join(',', wp_list_pluck($specialty, 'slug'));
				echo "Meet other " . $specialty_list . " students:";

				//found code snippet here, refactored to use my variables
				//https://wordpress.stackexchange.com/questions/66219/list-all-posts-in-custom-post-type-by-taxonomy
				$terms = get_the_terms($post->ID, 'school-site-student-type');
				foreach($terms as $term){
					wp_reset_query();
					$args = array(
						'post_type' => 'school_site_student',
						'tax_query' => array(
							array(
								'taxonomy' => 'school-site-student-type',
								'field' => 'slug',
								'terms' => $term->slug
							)
						)
					);
					$query = new WP_Query($args);
					if($query->have_posts()) :
						echo "<ul>";
						while($query->have_posts()) :
							$query->the_post(); ?>
							<li>
								<a href="<?php the_permalink();?>">
									<?php the_title();?>
								</a>
							</li>
							<?php
						endwhile;
						echo "</ul>";
					endif;
				}
				?>
			</div>
			<?php

		endwhile; // End of the loop.
		echo "</section>";
		?>

	</main><!-- #main -->

<?php
get_footer();
