<?php 
/**
 * @Packge 	   : Colorlib
 * @Version    : 1.0
 * @Author 	   : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */
 
	// Block direct access
	if( !defined( 'ABSPATH' ) ){
		exit( 'Direct script access denied.' );
	}

	/**
	 *
	 * Before Wrapper
	 *
	 * @Preloader
	 *
	 */
	add_action( 'recipes_preloader', 'recipes_site_preloader', 10 );

	/**
	 * Header
	 *
	 * @Header Menu
	 * @Header Bottom
	 * 
	 */

	add_action( 'recipes_header', 'recipes_header_cb', 10 );

	/**
	 * Hook for footer
	 *
	 */
	add_action( 'recipes_footer', 'recipes_footer_area', 10 );

	/**
	 * Hook for Blog, single, page, search, archive pages wrapper.
	 */
	add_action( 'recipes_wrp_start', 'recipes_wrp_start_cb', 10 );
	add_action( 'recipes_wrp_end', 'recipes_wrp_end_cb', 10 );
	
	/**
	 * Hook for Blog, single, search, archive pages column.
	 */
	add_action( 'recipes_blog_col_start', 'recipes_blog_col_start_cb', 10 );
	add_action( 'recipes_blog_col_end', 'recipes_blog_col_end_cb', 10 );
	
	/**
	 * Hook for blog posts thumbnail.
	 */
	add_action( 'recipes_blog_posts_thumb', 'recipes_blog_posts_thumb_cb', 10 );

	/**
	 * Hook for blog details wrapper.
	 */
	add_action( 'recipes_blog_details_wrap_start', 'recipes_blog_details_wrap_start_cb', 10 );
	add_action( 'recipes_blog_details_wrap_end', 'recipes_blog_details_wrap_end_cb', 10 );

	/**
	 * Hook for blog posts title.
	 */
	add_action( 'recipes_blog_posts_title', 'recipes_blog_posts_title_cb', 10 );

	/**
	 * Hook for blog posts meta.
	 */
	add_action( 'recipes_blog_posts_meta', 'recipes_blog_posts_meta_cb', 10 );

	/**
	 * Hook for blog posts excerpt.
	 */
	add_action( 'recipes_blog_posts_excerpt', 'recipes_blog_posts_excerpt_cb', 10 );
	// add_action( 'recipes_blog_posts_excerpt', 'recipes_blog_read_more_cb', 10 );

	/**
	 * Hook for blog posts info links.
	 */
	add_action( 'recipes_blog_posts_info_link', 'recipes_blog_posts_info_link_cb', 10 );

	/**
	 * Hook for blog posts content.
	 */
	add_action( 'recipes_blog_posts_content', 'recipes_blog_posts_content_cb', 10 );
	
	/**
	 * Hook for blog single post social share option.
	 */
	add_action( 'recipes_blog_posts_share', 'recipes_blog_posts_share_cb', 10 );

	/**
	 * Hook for blog sidebar.
	 */
	add_action( 'recipes_blog_sidebar', 'recipes_blog_sidebar_cb', 10 );
	
	/**
	 * Hook for blog single post meta category, tag, next - previous link and comments form.
	 */
	add_action( 'recipes_blog_single_meta', 'recipes_blog_single_meta_cb', 10 );
	
	/**
	 * Hook for page content.
	 */
	add_action( 'recipes_page_content', 'recipes_page_content_cb', 10 );
	
	
	/**
	 * Hook for 404 page.
	 */
	add_action( 'recipes_fof', 'recipes_fof_cb', 10 );

	

?>