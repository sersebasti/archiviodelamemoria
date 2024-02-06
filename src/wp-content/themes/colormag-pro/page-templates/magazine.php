<?php
/**
 * Template Name: Magazine Template
 *
 * Displays the Content in widgetized magazine layout like front page
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 1.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

get_header();
?>

	<div class="front-page-top-section clearfix">
		<div class="widget_slider_area">
			<?php
			if ( is_active_sidebar( 'colormag_front_page_slider_area' ) ) {
				dynamic_sidebar( 'colormag_front_page_slider_area' );
			}
			?>
		</div>

		<div class="widget_beside_slider">
			<?php
			if ( is_active_sidebar( 'colormag_front_page_area_beside_slider' ) ) {
				dynamic_sidebar( 'colormag_front_page_area_beside_slider' );
			}
			?>
		</div>
	</div>

	<div class="main-content-section clearfix">
		<?php
		/**
		 * Hook: colormag_before_body_content.
		 */
		do_action( 'colormag_before_body_content' );
		?>

	<?php colormag_two_sidebar_select(); ?>

		<div id="primary">
			<div id="content" class="clearfix">

				<?php
				if ( is_active_sidebar( 'colormag_front_page_content_top_section' ) ) {
					dynamic_sidebar( 'colormag_front_page_content_top_section' );
				}

				if ( is_active_sidebar( 'colormag_front_page_content_middle_left_section' ) || is_active_sidebar( 'colormag_front_page_content_middle_right_section' ) ) {
					?>
					<div class="tg-one-half">
						<?php
						dynamic_sidebar( 'colormag_front_page_content_middle_left_section' );
						?>
					</div>

					<div class="tg-one-half tg-one-half-last">
						<?php
						dynamic_sidebar( 'colormag_front_page_content_middle_right_section' );
						?>
					</div>

					<div class="clearfix"></div>
					<?php
				}

				if ( is_active_sidebar( 'colormag_front_page_content_bottom_section' ) ) {
					dynamic_sidebar( 'colormag_front_page_content_bottom_section' );
				}
				?>
			</div>
		</div>

		<?php
		colormag_sidebar_select();

		/**
		 * Hook: colormag_after_body_content.
		 */
		do_action( 'colormag_after_body_content' );
		?>
	</div>

<?php
get_footer();
