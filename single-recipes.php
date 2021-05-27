<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package recipes
 */

get_header();
$short_text  = ! empty( recipes_meta( 'short_text') ) ? recipes_meta( 'short_text') : 'N/A';
$rating      = ! empty( recipes_meta( 'rating') ) ? recipes_meta( 'rating') : 'N/A';
$making_time = ! empty( recipes_meta( 'time') ) ? recipes_meta( 'time') : 'N/A';

if( have_posts() ) {
    while( have_posts() ) : the_post();
    ?>

    <div class="recepie_details_area">
        <div class="container">
            <div class="row align-items-center">
                <?php
                    if ( has_post_thumbnail() ) {
                        $recipe_img = get_the_post_thumbnail( get_the_ID(), 'recipes_details_thumb_555x471', '', array( 'alt' => get_the_title() ) );
                        echo '
                        <div class="col-xl-6 col-md-6">
                            <div class="recepies_thumb">
                                '.$recipe_img.'
                            </div>
                        </div>
                        ';
                    }
                ?>
                <div class="col-xl-6 col-md-6">
                    <div class="recepies_info">
                        <h3><?php the_title()?></h3>
                        <p><?php echo wp_kses_post($short_text)?></p>

                        <div class="resepies_details">
                            <ul>
                                <li><p><strong><?php _e('Rating', 'recipes')?></strong> : <?php echo recipes_rating_function( $rating )?></p></li>
                                <li><p><strong><?php _e('Time', 'recipes')?></strong> : <?php echo esc_html($making_time)?> </p></li>
                                <li><p><strong><?php _e('Category', 'recipes')?></strong> : <?php echo recipes_get_tax_function('recipes-cat')?> </p></li>
                                <li><p><strong><?php _e('Tags', 'recipes')?></strong> :  <?php echo recipes_get_tax_function()?> </p></li>
                            </ul>
                        </div>
                        <div class="links">
                            <?php echo recipes_social_sharing_buttons()?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="recepies_text">
                        <?php the_content()?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php 

    recipes_related_items( get_the_ID() );
    endwhile;
}

// Footer============
get_footer();