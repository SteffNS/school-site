<?php
/**
 * Template for home page
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package FWD_Starter_Theme
 */

get_header();
?>

	<main id="primary" class="site-main">

		<?php
		while ( have_posts() ) :
			the_post();

			get_template_part( 'template-parts/content', 'page' ); 
			?>
			
			<section class='home-blog'>
				<h2>Latest Blog Posts</h2>
				<?php 
				
				$args = array(
					'post_type' => 'post',
					'posts_per_page' => 3,
				);
				$blog_query = new WP_Query($args);
				if($blog_query->have_posts() ){
					while($blog_query->have_posts() ){
						$blog_query->the_post();
						?>
						<article>
							<a href="<?php the_permalink(); ?>">
								<h3><?php the_title(); ?></h3>
							</a>
							<a class="post-thumbnail alignleft" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
								<?php
									the_post_thumbnail(
										'landscape-blog',
										array(
											'alt' => the_title_attribute(
												array(
													'echo' => false,
												)
											),
										)
									);
								?>
							</a>
						</article>
						<?php
					}
					wp_reset_postdata();
				}
				?>
			</section>

		<?php endwhile; // End of the loop. ?>

	</main><!-- #primary -->

<?php
get_footer();
