<?php
/**
 * The template for displaying archive pages
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
				<h1><?php post_type_archive_title(); ?></h1>
				<?php
				the_archive_description( '<div class="archive-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<?php

			// get_template_part( 'template-parts/content', 'page' );

			if ( comments_open() || get_comments_number() ) :
				comments_template();
			endif;

			$taxonomy = 'school-site-faculty-category';
			$terms = get_terms(
				array(
					'taxonomy'=> 'school-site-faculty-category',
				),
			);
			if($terms && !is_wp_error($terms)){
				foreach($terms as $term){
					$args = array(
						'post_type'      => 'school_site_staff',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC',
						'tax_query' => array(
							array(
								'taxonomy'=> $taxonomy,
								'field' => 'slug',
								'terms' => $term->slug,
							),
						),
					);
					$query = new WP_Query($args);
					echo "<h2 class='staff-category'>".$term->name."</h2>";
					echo "<section class='staff-section'>";
					while($query->have_posts()){
						$query->the_post();
						echo "<article>";
							?>
								<h3 id='<?php the_ID();?>'><?php the_title();?></h3>
							<?php
							if(function_exists('get_field')){
								if(get_field('biography')){
									echo "<p>";
									the_field('biography');
									echo "</p>";
								}
							}
							if(function_exists('get_field')){
								if(get_field('courses')){
									echo "<p class='courses'>";
									the_field('courses');
									echo "</p>";
								}
							}
							if(function_exists('get_field')){
								if(get_field('link')){
									?>
									<a href="<?php the_field('link'); ?>">
										Instructor Website
									</a>
									<?php
								}
							}
						echo "</article>";
					}
				}
				wp_reset_postdata();
				echo "</section>";
			}

			$taxonomy = 'school-site-admin-category';
			$terms = get_terms(
				array(
					'taxonomy'=> 'school-site-admin-category',
				),
			);
			if($terms && !is_wp_error($terms)){
				foreach($terms as $term){
					$args = array(
						'post_type'      => 'school_site_staff',
						'posts_per_page' => -1,
						'orderby' => 'title',
						'order' => 'ASC',
						'tax_query' => array(
							array(
								'taxonomy'=> $taxonomy,
								'field' => 'slug',
								'terms' => $term->slug,
							),
						),
					);
					$query = new WP_Query($args);
					echo "<h2 class='staff-category'>".$term->name."</h2>";
					echo "<section class='staff-section'>";
					while($query->have_posts()){
						$query->the_post();
						echo "<article>";
							?>
								<h3 id='<?php the_ID();?>'><?php the_title();?></h3>
							<?php
							if(function_exists('get_field')){
								if(get_field('biography')){
									echo "<p>";
										the_field('biography');
									echo "</p>";
								}
							}
						echo "</article>";
					}
				}
				wp_reset_postdata();
				echo "</section>";
			}


		endif;
		?>

	</main><!-- #main -->

<?php
get_footer();
