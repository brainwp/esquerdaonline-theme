<?php
/**
 * The template for displaying Archive pages for Colunistas.
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

get_header(); ?>

	<main id="content" class="<?php echo odin_classes_page_sidebar(); ?>" tabindex="-1" role="main">

			<?php if ( have_posts() ) :?>

				<header class="page-header">
					<?php
						the_archive_title( '<h1 class="page-title">', '</h1>' );
					?>
				</header><!-- .page-header -->

				<?php
					// Start the Loop.
					$colunistas_array=array();
					while ( have_posts() ) : the_post();

						/*
						 * Include the post format-specific template for the content. If you want to
						 * use this in a child theme, then include a file called called content-___.php
						 * (where ___ is the post format) and that will be used instead.
						 */
						get_template_part( '/content/content', 'archive-colunistas' );
						$colunistas_array[get_the_title()] = get_the_permalink();
					endwhile;

					// Page navigation.
					odin_paging_nav();

				else :
					// If no content, include the "No posts found" template.
					get_template_part( 'content', 'none' );

				endif;
			?>

	</main><!-- #main -->
	<aside id="sidebar-colunistas" class="<?php echo odin_classes_page_sidebar_aside(); ?>" role="complementary">
		<h3 class="widgettitle widget-title" >Colunistas</h3>
		<?php
		foreach ($colunistas_array as $nome => $link) { ?>
			<a href=" <?php echo $link; ?>"><?php echo $nome ?></a><br>
			<?php
		}
		?>
	</aside><!-- #sidebar -->
<?php
get_sidebar('colunistas');
get_sidebar();
get_footer();
