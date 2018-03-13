<div class="each-colunista">
	<a href="<?php the_permalink();?>" class="coluna-link">
		<div class="col-md-2 thumbnail-colunista">
			<?php the_post_thumbnail( 'thumbnail' );?>
		</div><!-- .col-md-2 thumbnail-colunista -->
		<h4 class="col-md-10 colunista-name">
			<?php the_title();?>
		</h4><!-- .col-md-10-colunista-name -->
	</a>
</div><!-- .each-colunista -->
