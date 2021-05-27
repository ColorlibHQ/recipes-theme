<?php 		
	// Copyright text
	$url = 'https://colorlib.com/';
	$copyText = sprintf( __( 'Theme by %s colorlib %s Copyright &copy; %s  |  All rights reserved.', 'recipes' ), '<a target="_blank" href="' . esc_url( $url ) . '">', '</a>', date( 'Y' ) );
	$copyRight = !empty( recipes_opt( 'recipes_footer_copyright_text' ) ) ? recipes_opt( 'recipes_footer_copyright_text' ) : $copyText;
	?>

	<div class="copy-right_text">
        <div class="container">
            <div class="footer_border"></div>
			<div class="row align-items-center">
				<div class="col-xl-8 col-md-8">
                    <p class="copy_right">
						<?php echo wp_kses_post( $copyRight ); ?>
					</p>
				</div>
				<div class="col-xl-4 col-md-4">
					<?php
						// Social profiles
						$social_opt = recipes_opt('recipes_social_profile_toggle');
						if ( $social_opt == true ) {
							$social_items = recipes_opt('recipes_social_profiles');
							if( is_array( $social_items ) && count( $social_items ) > 0 ){
								echo '<div class="socail_links"><ul>';
									foreach ($social_items as $value) {
										echo '<li><a href="'. esc_url($value['social_url']) .'"> <i class="'. esc_attr($value['social_icon']) .'"></i> </a></li>';
									}
								echo '</ul></div>';
							}          
						}  
					?>
					<!-- <li>
						<a href="#">
							<i class="ti-facebook"></i>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="ti-twitter-alt"></i>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-dribbble"></i>
						</a>
					</li>
					<li>
						<a href="#">
							<i class="fa fa-behance"></i>
						</a>
					</li> -->
				</div>
			</div>
		</div>
	</div>