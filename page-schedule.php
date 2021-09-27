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
		if(have_rows('schedule_repeater')) : ?>
			<table class='schedule'>
				<tbody>
				<?php
				while(have_rows('schedule_repeater')) : 
					the_row();
					?>
						<tr>
							<th>
							<?php
								$sub_value= get_sub_field('date');
								echo $sub_value; 
							?>
							</th>
							<td>
							<?php
								$sub_value = get_sub_field('instructor');
								echo $sub_value; 
							?>
							</td>
							<td>
							<?php
								$sub_value = 'Course: '. get_sub_field('course');
								echo $sub_value;
							?>
							</td>
						</tr>
					<?php
				endwhile;
				?>
				</tbody>
			</table>
			<?php
		endif;



		?>

	</main><!-- #main -->

<?php
get_footer();
