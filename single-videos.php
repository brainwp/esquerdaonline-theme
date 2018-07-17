<?php get_header( 'large' ); ?>
 <main id="content" class="<?php echo odin_classes_page_full(); ?>" tabindex="-1" role="main">
   <div class="col-md-12 no-padding">
     <?php
     while ( have_posts() ) : the_post();

       $url = get_field('link', $post->ID);
       $embed = wp_oembed_get( $url , array( 'autoplay' => 1 ));
       if ( $embed ) {
       	echo $embed;
       }
     endwhile;
   ?>
   </div><!-- .col-md-12 -->
 </main><!-- #main -->
<?php
get_footer();

 ?>
