<?php 
// Block direct access
if( !defined( 'ABSPATH' ) ){
	exit( 'Direct script access denied.' );
}
/**
 * @Packge 	   : Recipes
 * @Version    : 1.0
 * @Author 	   : Colorlib
 * @Author URI : http://colorlib.com/wp/
 *
 */

	$recipes_reservation_title     = !empty( recipes_opt( 'recipes_reservation_title' ) ) ? recipes_opt( 'recipes_reservation_title' ) : '';
	$recipes_reservation_sub_title = !empty( recipes_opt( 'recipes_reservation_sub_title' ) ) ? recipes_opt( 'recipes_reservation_sub_title' ) : '';
	$recipes_reservation_btn_text  = !empty( recipes_opt( 'recipes_reservation_btn_text' ) ) ? recipes_opt( 'recipes_reservation_btn_text' ) : '';
	$recipes_reservation_btn_url	  = !empty( recipes_opt( 'recipes_reservation_btn_url' ) ) ? recipes_opt( 'recipes_reservation_btn_url' ) : '';
	?>
	<div class="footer_header d-flex justify-content-between">
		<div class="footer_header_left">
			<h3><?php echo esc_html( $recipes_reservation_title )?></h3>
			<p><?php echo esc_html( $recipes_reservation_sub_title )?></p>
		</div>
		<div class="footer_btn">
			<a href="<?php echo esc_url( $recipes_reservation_btn_url )?>" class="boxed-btn2"><?php echo esc_html( $recipes_reservation_btn_text )?></a>
		</div>
	</div>