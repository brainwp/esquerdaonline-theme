<?php
/**
 * The template for displaying Archive pages for especiais.
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each specific one. For example, Twenty Thirteen
 * already has tag.php for Tag archives, category.php for Category archives,
 * and author.php for Author archives.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Odin
 * @since 2.2.0
 */

get_header('large'); ?>

	<main id="content" class="<?php echo odin_classes_page_sidebar(); ?>" tabindex="-1" role="main">

			<?php if ( have_posts() ) :?>

				<div class="clearfix">

				</div>
				<h2 class="page-title widget-title">Dossiês</h2>
				<section class="social-area">
					<div class="main-post-social continue-reading">
						<?php
							// Start the Loop.
							while ( have_posts() ) : the_post();

								/*
								 * Include the post format-specific template for the content. If you want to
								 * use this in a child theme, then include a file called called content-___.php
								 * (where ___ is the post format) and that will be used instead.
								 */
								 get_template_part( '/content/especiais-dossies' );

								// para sidebar:
								$colunistas_array[get_the_title()] = get_the_permalink();
							endwhile;
							// Page navigation.
							$term = get_term_by( 'slug', 'dossies', 'tipo', $output = OBJECT, $filter = 'raw' );
							$link = get_term_link( $term, $taxonomy = 'tipo')

							?>
							<a class="especiais-link" href="<?php echo $link; ?>">Veja Mais</a>
							<?php
						else :
							// If no content, include the "No posts found" template.
							get_template_part( 'content', 'none' );
							echo 'qqqq';

						endif;
					?>

					</div>
					<div class="clearfix">

					</div>
				</section>

	</main><!-- #main -->
	<aside id="sidebar" class="<?php echo odin_classes_page_sidebar_aside(); ?>" role="complementary">
		<h2 class="widget-title">Coberturas especiais</h2>
		<?php
		$args = array(
			'post_type' => 'especiais',
			'tax_query' =>array(
				array(
					'taxonomy' => 'tipo',
					'field' => 'slug',
					'terms' => array('cobertura'),
					'operator'=> 'IN'
				)
			)
		);
		$custom_query = new WP_Query($args); // exclude category 9
		while($custom_query->have_posts()) : $custom_query->the_post(); ?>

			<div <?php post_class(); ?> id="post-<?php the_ID(); ?>">
				<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
				<?php printf( __( '%1$s de %2$s de %3$s', 'eol' ), get_the_date( 'd' ), get_the_date( 'F' ), get_the_date( 'Y' ) );?>
			</div>

		<?php endwhile; ?>
		<?php wp_reset_postdata(); // reset the query
		$term_cobertura = get_term_by( 'slug', 'cobertura', 'tipo', $output = OBJECT, $filter = 'raw' );
		$link = get_term_link( $term_cobertura, $taxonomy = 'tipo')
		?>
		<a class="especiais-link" href="<?php echo $link; ?>">Veja Mais</a>
	</aside><!-- #sidebar -->

<?php
get_footer();
