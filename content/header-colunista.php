<?php
if ($term_list = wp_get_post_terms($post->ID, 'colunistas', array("fields" => "slugs"))) {
	$the_slug = $term_list[0];
	$args = array(
	  'name'        => $the_slug,
	  'post_type'   => 'colunistas',
	  'numberposts' => 1
	);
	$my_posts = get_posts($args);
	if( $my_posts ) :
	  $post_id = $my_posts[0]->ID;
		$content = $my_posts[0]->post_content;

	endif;
} else{
	$post_id = $post->ID;
	$content = $post->post_content;
}
$content = apply_filters('the_content', $content);
	?>
<header id="header-colunista" class="no-padding">
	<div class="container">
		<div class="col-md-1 no-padding ">
			<section class="post-thumb">
				<div class="thumbnail-colunista">
					<a href="<?php echo get_the_permalink( $post_id) ?>">
						<?php echo get_the_post_thumbnail( $post_id, 'thumbnail' );?>
					</a>
				</div>
			</section>
		</div><!-- .col-md-4 center-container -->

		<div class="col-md-11 center-container no-padding">
			<div class="entry-title-container col-md-12 ">
				<a href="<?php echo get_the_permalink($post_id) ?>">
					<h4 class="colunista-name"><?php echo get_the_title( $post_id);?></h4>
				</a>
			</div><!-- .col-md-12 entry-title-container -->
			<div class="entry-title-container col-md-12 text-left">
				<section class="content-it-self">
					<?php
						echo $content;

					?>
				</section>
			</div><!-- .col-md-12 entry-title-container -->
			<div class="col-md-12 text-left social-icons-colunist">
				<div class="icon-itself">
					<a href="#">
						<i class="fab fa-facebook-f"></i>
					</a>
				</div>
				<div class="icon-itself">
					<a href="#">
						<i class="fab fa-twitter"></i>
					</a>
				</div>
				<div class="icon-itself">
					<a href="#">
						<i class="fab fa-google-plus"></i>
					</a>
				</div>
			</div><!-- .col-md-6 social-icons-post -->
		</div><!-- .col-md-8 center-container -->
	</div>

</header><!-- .entry-header -->
