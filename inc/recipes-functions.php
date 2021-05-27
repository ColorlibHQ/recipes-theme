<?php 
/**
 * @Packge     : Recipes
 * @Version    : 1.0
 * @Author     : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
    // Block direct access
    if( !defined( 'ABSPATH' ) ){
        exit( 'Direct script access denied.' );
    }

 // theme option callback
function recipes_opt( $id = null ){
	
	$opt = get_theme_mod( $id );
	
	$data = '';
	
	if( $opt ){
		$data = $opt;
	}
	
	return $data;
}

// Rating function
function recipes_rating_function( $rating = 5 ) {
	$html = '';
	for( $i = 0; $i < $rating; $i++ ) {
		$html .= '<i class="fa fa-star"></i>';
	}

	return $html;
}

// Tags function
function recipes_get_tax_function( $taxonomy = 'recipes-tag' ) {
	$tax_items = get_the_terms(get_the_ID(), $taxonomy);
	$html = '';

	foreach( $tax_items as $item ) {
		$html .= $item->name . ', ';
	}

	$html = substr($html, 0, '-2');

	return $html;
}

// custom meta id callback
function recipes_meta( $id = '', $value_type = true ){
    
    $value = get_post_meta( get_the_ID(), '_recipes_'.$id, $value_type );
    
    return $value;
}

// recipes
function recipes_get_styles_from_meta( $footer_bg_opt ) {
	$bg_styles = '';
	foreach( $footer_bg_opt as $key => $value ) {
		if ( $value != '' ) {
			if ( $key == 'image' ) {
				$bg_styles .= 'background-'. $key . ': url('. $value . ');';
			} else {
				$bg_styles .= 'background-'. $key . ':'. $value . ';';
			}
		}
	}
	return $bg_styles;
}

// Blog Date Permalink
function recipes_blog_date_permalink(){
	
	$year  = get_the_time('Y'); 
    $month_link = get_the_time('m');
    $day   = get_the_time('d');

    $link = get_day_link( $year, $month_link, $day);
    
    return $link; 
}
// Blog Excerpt Length
if ( ! function_exists( 'recipes_excerpt_length' ) ) {
	function recipes_excerpt_length( $limit = 30 ) {

		$excerpt = explode( ' ', get_the_excerpt() );
		
		// $limit null check
		if( !null == $limit ){
			$limit = $limit;
		}else{
			$limit = 30;
		}
		
		
		if ( count( $excerpt ) >= $limit ) {
			array_pop( $excerpt );
			$exc_slice = array_slice( $excerpt, 0, $limit );
			$excerpt = implode( " ", $exc_slice ).' ...';
		} else {
			$exc_slice = array_slice( $excerpt, 0, $limit );
			$excerpt = implode( " ", $exc_slice );
		}
		
		$excerpt = '<p>'.preg_replace('`\[[^\]]*\]`','',$excerpt).'</p>';
		return $excerpt;

	}
}


// Body support function
if ( ! function_exists( 'wp_body_open' ) ) {
    /**
     * Fire the wp_body_open action.
     *
     * Added for backwards compatibility to support WordPress versions prior to 5.2.0.
     */
    function wp_body_open() {
        /**
         * Triggered after the opening <body> tag.
         */
        do_action( 'wp_body_open' );
    }
}

// Comment number and Link
if ( ! function_exists( 'recipes_posted_comments' ) ) :
    function recipes_posted_comments(){
        
        $comments_num = get_comments_number();
        if( comments_open() ){
            if( $comments_num == 0 ){
                $comments = esc_html__('No Comments','recipes');
            } elseif ( $comments_num > 1 ){
                $comments= $comments_num . esc_html__(' Comments','recipes');
            } else {
                $comments = esc_html__( '1 Comment','recipes' );
            }
            $comments = '<a href="' . esc_url( get_comments_link() ) . '">'. $comments .'</a>';
        } else {
            $comments = esc_html__( 'Comments are closed', 'recipes' );
        }
        
        return $comments;
    }
endif;

//audio format iframe match 
function recipes_iframe_match(){   
    $audio_content = recipes_embedded_media( array('audio', 'iframe') );
    $iframe_match = preg_match("/\iframe\b/i",$audio_content, $match);
    return $iframe_match;
}

//Post embedded media
function recipes_embedded_media( $type = array() ){
    
    $content = do_shortcode( apply_filters( 'the_content', get_the_content() ) );
    $embed   = get_media_embedded_in_content( $content, $type );
        
    if( in_array( 'audio' , $type) ){
    
        if( count( $embed ) > 0 ){
            $output = str_replace( '?visual=true', '?visual=false', $embed[0] );
        }else{
           $output = '';
        }
        
    }else{
        
        if( count( $embed ) > 0 ){

            $output = $embed[0];
        }else{
           $output = ''; 
        }
        
    }
    
    return $output;
   
}
// WP post link pages
function recipes_link_pages(){
    
    wp_link_pages( array(
    'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'recipes' ) . '</span>',
    'after'       => '</div>',
    'link_before' => '<span>',
    'link_after'  => '</span>',
    'pagelink'    => '<span class="screen-reader-text">' . esc_html__( 'Page', 'recipes' ) . ' </span>%',
    'separator'   => '<span class="screen-reader-text">, </span>',
    ) );
}

// Blog social sharing buttons
function recipes_social_sharing_buttons( $ulClass = '', $tagLine = '', $show_label = false ) {

	// Get page URL
	$URL = get_permalink();
	$Sitetitle = get_bloginfo('name');

	// Get page title
	$Title = str_replace( ' ', '%20', get_the_title());

	// Construct sharing URL without using any script
	$twitterURL = 'https://twitter.com/intent/tweet?text='.esc_html( $Title ).'&amp;url='.esc_url( $URL ).'&amp;via='.esc_html( $Sitetitle );
	$facebookURL= 'https://www.facebook.com/sharer/sharer.php?u='.esc_url( $URL );
	$linkedin   = 'https://www.linkedin.com/shareArticle?mini=true&url='.esc_url( $URL ).'&title='.esc_html( $Title );
	$pinterest  = 'http://pinterest.com/pin/create/button/?url='.esc_url( $URL ).'&description='.esc_html( $Title );;

	// Add sharing button at the end of page/page content
	$content = '';
	$content  .= '<ul class="'.esc_attr( $ulClass ).'">';
	$content .= $tagLine;
	$content .= '<li><a href="' . esc_url( $facebookURL ) . '" target="_blank"><i class="ti-facebook"></i>'.($show_label == true ? " Facebook " : ""). '</a></li>';
	$content .= '<li><a href="' . esc_url( $twitterURL ) . '" target="_blank"><i class="ti-twitter-alt"></i>'.($show_label == true ? " Twitter " : ""). '</a></li>';
	$content .= '<li><a href="' . esc_url( $pinterest ) . '" target="_blank"><i class="ti-pinterest"></i>'.($show_label == true ? " Pinterest " : ""). '</a></li>';
	$content .= '<li><a href="' . esc_url( $linkedin ) . '" target="_blank"><i class="ti-linkedin"></i>'.($show_label == true ? " Linkedin " : ""). '</a></li>';
	$content .= '</ul>';

	return $content;

}

// Blog single post navigation
if( ! function_exists('recipes_blog_single_post_navigation') ) {
	function recipes_blog_single_post_navigation() {

		// Start nav Area
		if( get_next_post_link() || get_previous_post_link()   ):
			?>
			<div class="navigation-area">
				<div class="row">
					<div class="col-lg-6 col-md-6 col-12 nav-left flex-row d-flex justify-content-start align-items-center">
						<?php
						if( get_next_post_link() ){
							$nextPost = get_next_post();

							if( has_post_thumbnail() ){
								?>
								<div class="thumb">
									<a href="<?php the_permalink(  absint( $nextPost->ID )  ) ?>">
										<?php echo get_the_post_thumbnail( absint( $nextPost->ID ), 'recipes_np_thumb', array( 'class' => 'img-fluid' ) ) ?>
									</a>
								</div>
								<?php
							} ?>
							<div class="arrow">
								<a href="<?php the_permalink(  absint( $nextPost->ID )  ) ?>">
									<span class="ti-arrow-left text-white"></span>
								</a>
							</div>
							<div class="detials">
								<p><?php echo esc_html__( 'Prev Post', 'recipes' ); ?></p>
								<a href="<?php the_permalink(  absint( $nextPost->ID )  ) ?>">
									<h4><?php echo wp_trim_words( get_the_title( $nextPost->ID ), 4, ' ...' ); ?></h4>
								</a>
							</div>
							<?php
						} ?>
					</div>
					<div class="col-lg-6 col-md-6 col-12 nav-right flex-row d-flex justify-content-end align-items-center">
						<?php
						if( get_previous_post_link() ){
							$prevPost = get_previous_post();
							?>
							<div class="detials">
								<p><?php echo esc_html__( 'Next Post', 'recipes' ); ?></p>
								<a href="<?php the_permalink(  absint( $prevPost->ID )  ) ?>">
									<h4><?php echo wp_trim_words( get_the_title( $prevPost->ID ), 4, ' ...' ); ?></h4>
								</a>
							</div>
							<div class="arrow">
								<a href="<?php the_permalink(  absint( $prevPost->ID )  ) ?>">
									<span class="ti-arrow-right text-white"></span>
								</a>
							</div>
							<div class="thumb">
								<a href="<?php the_permalink(  absint( $prevPost->ID )  ) ?>">
									<?php echo get_the_post_thumbnail( absint( $prevPost->ID ), 'recipes_np_thumb', array( 'class' => 'img-fluid' ) ) ?>
								</a>
							</div>
							<?php
						} ?>
					</div>
				</div>
			</div>
		<?php
		endif;

	}
}

// Recipes Comment Template Callback
function recipes_comment_callback( $comment, $args, $depth ) {

	if ( 'div' === $args['style'] ) {
		$tag       = 'div';
		$add_below = 'comment';
	} else {
		$tag       = 'li';
		$add_below = 'div-comment';
	}
	?>
	<<?php echo esc_attr( $tag ); ?> <?php comment_class( ( empty( $args['has_children'] ) ? '' : 'parent').' comment-list' ) ?> id="comment-<?php comment_ID() ?>">
	<?php if ( 'div' != $args['style'] ) : ?>
		<div id="div-comment-<?php comment_ID() ?>" class="comment-list">
	<?php endif; ?>
		<div class="single-comment">
			<div class="user d-flex">
				<div class="thumb">
					<?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
				</div>
				<div class="desc">
					<div class="comment">
						<?php comment_text(); ?>
					</div>

					<div class="d-flex justify-content-between">
						<div class="d-flex align-items-center">
							<h5 class="comment_author"><?php printf( __( '<span class="comment-author-name">%s</span> ', 'recipes' ), get_comment_author_link() ); ?></h5>
							<p class="date"><?php printf( __('%1$s at %2$s', 'recipes'), get_comment_date(),  get_comment_time() ); ?><?php edit_comment_link( esc_html__( '(Edit)', 'recipes' ), '  ', '' ); ?> </p>
							<?php if ( $comment->comment_approved == '0' ) : ?>
								<em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'recipes' ); ?></em>
								<br>
							<?php endif; ?>
						</div>

						<div class="reply-btn">
							<?php comment_reply_link(array_merge( $args, array( 'add_below' => $add_below, 'depth' => 1, 'max_depth' => 5, 'reply_text' => 'Reply' ) ) ); ?>
						</div>
					</div>

				</div>
			</div>
		</div>
	<?php if ( 'div' != $args['style'] ) : ?>
		</div>
	<?php endif; ?>
	<?php
}
// add class comment reply link
add_filter('comment_reply_link', 'recipes_replace_reply_link_class');
function recipes_replace_reply_link_class( $class ) {
	$class = str_replace("class='comment-reply-link", "class='btn-reply comment-reply-link text-uppercase", $class);
	return $class;
}


// theme logo
function recipes_theme_logo( $class = '' ) {

    $siteUrl = home_url('/');
    // site logo
		
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$imageUrl = wp_get_attachment_image_src( $custom_logo_id , 'recipes_site_logo_80x80' );
	
	if( !empty( $imageUrl[0] ) ){
		$siteLogo = '<a class="'.esc_attr( $class ).'" href="'.esc_url( $siteUrl ).'"><img src="'.esc_url( $imageUrl[0] ).'" alt="'.esc_attr( recipes_image_alt( $imageUrl[0] ) ).'"></a>';
	}else{
		$siteLogo = '<a class="'.esc_attr( $class ).'" href="'.esc_url( $siteUrl ).'"><img src="'.esc_url( RECIPES_DIR_IMGS_URI . 'logo.png' ).'" alt="'.esc_attr( get_bloginfo('name') ).'"></a>';
	}
	
	return wp_kses_post( $siteLogo );
	
}

// Blog pull right class callback
function recipes_pull_right( $id = '', $condation ){
    
    if( $id == $condation ){
        return ' '.'order-last';
    }else{
        return;
    }
    
}

// image alt tag
function recipes_image_alt( $url = '' ){

    if( $url != '' ){
        // attachment id by url 
        $attachmentid = attachment_url_to_postid( esc_url( $url ) );
       // attachment alt tag 
        $image_alt = get_post_meta( esc_html( $attachmentid ) , '_wp_attachment_image_alt', true );
        
        if( $image_alt ){
            return $image_alt ;
        }else{
            $filename = pathinfo( esc_url( $url ) );
    
            $alt = str_replace( '-', ' ', $filename['filename'] );
            
            return $alt;
        }
   
    }else{
       return; 
    }

}

// Flat Content wysiwyg output with meta key and post id
function recipes_get_textareahtml_output( $content ) {
    
	global $wp_embed;

	$content = $wp_embed->autoembed( $content );
	$content = $wp_embed->run_shortcode( $content );
	$content = wpautop( $content );
	$content = do_shortcode( $content );

	return $content;
}

// 

// Slider list ( Shortcode ) select Options
function recipes_get_slider_shortcode_options( $field ) {
    $args = $field->args( 'get_post_type' );
	
	
    $args = is_array( $args ) ? $args : array();

    $args = wp_parse_args( $args, array( 'post_type' => 'post' ) );

    $postType = $args['post_type'];

	//

	$args = array(
		'post_type'        => $postType,
		'post_status'      => 'publish',
	);

	$posts_array = get_posts( $args );	

	// Initate an empty array
	$term_options = array();
		
		foreach( $posts_array as $post ){
			
			$term_options[ $post->post_name ] = $post->post_title;
			
		}
	
    return $term_options;

}
// Get pages
function recipes_get_pages(){
	//post_title
	//ID
	
	$pages = get_pages();
	
	$getPages = array();
	
	foreach( $pages as $page ){
		$getPages[$page->ID] = $page->post_title;
	}
	
	
	return $getPages;
	
}

// html Style tag
function recipes_inline_bg_img( $bgUrl ){
    $bg = '';

    if( $bgUrl ){
        $bg = 'style="background-image:url('.esc_url( $bgUrl ).')"'; 
    }

    return $bg;
}
//  customize sidebar option value return
function recipes_sidebar_opt(){

    $sidebarOpt = recipes_opt( 'recipes-blog-sidebar-settings' );
    $sidebar = '1';
    // Blog Sidebar layout  opt
    if( is_array( $sidebarOpt ) ){
        $sidebarOpt =  $sidebarOpt;
    }else{
        $sidebarOpt =  json_decode( $sidebarOpt, true );
    }
    
    
    if( !empty( $sidebarOpt['columnsCount'] ) ){
        $sidebar = $sidebarOpt['columnsCount'];
    }


    return $sidebar;
}

function recipes_blog_pagination(){
	echo '<nav class="blog-pagination justify-content-center d-flex">';
        the_posts_pagination(
            array(
                'mid_size'  => 2,
                'prev_text' => __( '<span class="ti-angle-left"></span>', 'recipes' ),
                'next_text' => __( '<span class="ti-angle-right"></span>', 'recipes' ),
                'screen_reader_text' => ' '
            )
        );
	echo '</nav>';
}


// Themify Icon
function recipes_themify_icon(){
    return [
        'seo_1' 	=> __('Search Icon', 'recipes'),
        'seo_2' 	=> __('Mike Icon', 'recipes'),
        'seo_3' 	=> __('Share Icon', 'recipes'),
    ];
}

// CTA section
function recipes_get_cta_area() {
	$cta_section_title      = !empty( recipes_opt( 'recipes_cta_section_title') ) ? recipes_opt( 'recipes_cta_section_title') : '';
	$cta_section_text       = !empty( recipes_opt( 'recipes_cta_section_text') ) ? recipes_opt( 'recipes_cta_section_text') : '';
	$cta_section_btn_label  = !empty( recipes_opt( 'recipes_cta_section_btn_label') ) ? recipes_opt( 'recipes_cta_section_btn_label') : '';
	$cta_section_btn_url    = !empty( recipes_opt( 'recipes_cta_section_btn_url') ) ? recipes_opt( 'recipes_cta_section_btn_url') : '';
	?>
    <!-- cta-area-start -->
    <div class="cta-area cta-bg-1">
        <div class="container">
            <div class="col-xl-6 col-lg-7">
                <div class="cta-content">
                    <?php 
                    if ( $cta_section_title ) {
                        echo '<h3>' . nl2br( wp_kses_post( $cta_section_title ) ) . '</h3>';
                    }
                    if ( $cta_section_text ) {
                        echo '<p>' . nl2br( wp_kses_post( $cta_section_text ) ) . '</p>';
                    }

                    if ( $cta_section_btn_label ) {
                        ?>
                        <div class="cta-btn">
                            <a class="boxed-btn2 black-bg" href="<?php echo esc_url( $cta_section_btn_url )?>"><?php echo esc_html( $cta_section_btn_label )?> <i class="Flaticon flaticon-right-arrow"></i></a>
                        </div>
                        <?php
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <!-- cta-area-end -->
	<?php
}


// Contact details section
function recipes_get_contact_details_area() {
	?>
    <!-- location-area-start -->
    <div class="addres-area black-bg section-padding">
        <div class="container">
            <div class="row">
                <?php
				// Contact items
				$contact_items = recipes_opt('recipes_contact_details_section_fields');
                if ( $contact_items == true ) {
                    $counter = 1;
                    if( is_array( $contact_items ) && count( $contact_items ) > 0 ){
                        foreach ($contact_items as $value) {
                            switch ($counter) {
                                case $counter == 2:
                                    $icon_img = RECIPES_DIR_ICON_IMG_URI . 'clock.png';
                                    break;
                                case $counter == 3:
                                    $icon_img = RECIPES_DIR_ICON_IMG_URI . 'envelope.png';
                                    break;
                                default:
                                    $icon_img = RECIPES_DIR_ICON_IMG_URI . 'globe.png';
                                    break;
                            }
                            $counter++;
                            $contact_item_title = $value['contact_item_title'];
                            $contact_item_txt   = $value['contact_item_txt'];
                            $anchor_text        = $value['anchor_text'];
                            $anchor_url         = $value['anchor_url'];
                            ?>
                            <div class="col-xl-4 col-md-4">
                                <div class="single-address text-center">
                                    <div class="addres-icon">
                                        <img src="<?php echo esc_url( $icon_img )?>" alt="<?php echo esc_html( $contact_item_title )?> image">
                                    </div>
                                    <h3><?php echo esc_html( $contact_item_title )?></h3>
                                    <p><?php echo nl2br( wp_kses_post( $contact_item_txt ) )?></p>
                                    <a class="underline-hover" href="<?php echo esc_url( $anchor_url )?>"><?php echo esc_html( $anchor_text )?></a>
                                </div>
                            </div>
                            <?php
                        }
                    }
                }  
                ?>
            </div>
        </div>
    </div>
    <!-- location-area-end -->
	<?php
}



?>