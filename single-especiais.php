<?php
/**
 * The Template for displaying all single posts.
 *
 * @package Odin
 * @since 2.2.0
 */
 get_header( 'large' ); ?>
 	<main id="content" class="home <?php echo odin_classes_page_full(); ?>" tabindex="-1" role="main">
 		<div class="col-md-12 no-padding">
 			<?php
      while ( have_posts() ) : the_post();
      ?>
      <div id="destaques" class="widget-eol-posts widget-container ">
        <?php
        $query_args = array(
          'posts_per_page'      => 3,
          'no_found_rows'       => true,
          'post_status'         => 'publish',
          'tax_query' => array(
            'relation' => 'AND',
            array(
              'taxonomy' => 'especiais',
              'field'    => 'slug',
              'terms'    => $post->post_name,
            ),
          ),

        );
        $r = new WP_Query($query_args);
        if (  $r->have_posts() ) {
          $ids = array();
          foreach ( $r->posts as $especial_destaque ) :
            // print_r($especial_destaque);

            array_push($ids, $especial_destaque->ID);
            ?>
            <article class="each-post-widget tamanho-total-100  thumb-alternativa exibicao-titulo tamanho-33 foto-fundo">
                <div class="flex">
                  <figure class=" post-thumbnail">
                    <i class="fas fa-share-alt"></i>
                    <div class="col-md-12 social-icons-post">
                      <?php eol_share_overlay();?>
                    </div>
                    <?php
                    echo '<a class="post-thumbnail-link" href="' .  get_permalink($especial_destaque->ID) . '">';
                    eol_single_thumbnail('quadrada-p', $especial_destaque->ID);
                    echo '</a>';
                    ?>
                  </figure>
                  <div class="overlay-post-link-widget-text">
                    <div class="post-link-widget-text" >

                      <h3 class="tax-widget-titulo">
                        <a href="<?php echo get_permalink($especial_destaque->ID); ?>" >
                          <?php echo $especial_destaque->post_title;?>
                        </a>
                      </h3>
                    </div>
                  </div>
                </div><!--flex-->
              </article>
            <?php
          endforeach;
         ?>
        <?php
        }?>
        </div>
        <?php
        eol_single_thumbnail('full', get_the_ID() );
				dynamic_sidebar( eol_get_widget_object_id() );
			endwhile;

    ?>
 		</div><!-- .col-md-12 -->
 	</main><!-- #main -->
 <?php
 get_footer();
