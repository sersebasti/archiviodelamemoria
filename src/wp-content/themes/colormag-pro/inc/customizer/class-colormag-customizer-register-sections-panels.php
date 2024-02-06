<?php
/**
 * Class to register panels and sections for customize options.
 *
 * Class ColorMag_Customize_Register_Section_Panels
 *
 * @package    ThemeGrill
 * @subpackage ColorMag
 * @since      ColorMag 3.0.0
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class to register panels and sections for customize options.
 *
 * Class ColorMag_Customize_Register_Section_Panels
 */
class ColorMag_Customize_Register_Section_Panels extends ColorMag_Customize_Base_Option {

	/**
	 * Include customize options.
	 *
	 * @param array                 $options      Customize options provided via the theme.
	 * @param \WP_Customize_Manager $wp_customize Theme Customizer object.
	 *
	 * @return mixed|void Customizer options for registering panels, sections as well as controls.
	 */
	public function register_options( $options, $wp_customize ) {

		$configs = array(

			/**
			 * Panels.
			 */
			array(
				'name'     => 'colormag_global_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Global', 'colormag' ),
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_front_page_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Front Page', 'colormag' ),
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_header_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Header', 'colormag' ),
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_content_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Content', 'colormag' ),
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_footer_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Footer', 'colormag' ),
				'priority' => 50,
			),

			array(
				'name'     => 'colormag_additional_panel',
				'type'     => 'panel',
				'title'    => esc_html__( 'Additional', 'colormag' ),
				'priority' => 60,
			),

			// Separator.
			array(
				'name'             => 'separator',
				'type'             => 'section',
				'priority'         => 80,
				'section_callback' => 'ColorMag_WP_Customize_Separator',
			),

			/**
			 * Global.
			 */
			// Colors.
			array(
				'name'     => 'colormag_global_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Colors', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_primary_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Colors', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_colors_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_heading_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Heading Colors', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_colors_section',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_link_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Link Colors', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_colors_section',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_skin_color_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Skin Color', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_colors_section',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_category_colors_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Category Colors', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_colors_section',
				'priority' => 50,
			),

			// Background.
			array(
				'name'     => 'colormag_global_background_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Background', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 20,
			),

			// Layout.
			array(
				'name'     => 'colormag_global_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Layout', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_site_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Site Layout', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_layout_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_sidebar_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar Layout', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_layout_section',
				'priority' => 20,
			),

			// Typography.
			array(
				'name'     => 'colormag_global_typography_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Typography', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_base_typography_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Base', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_typography_section',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_headings_typography_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Headings', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'section'  => 'colormag_global_typography_section',
				'priority' => 20,
			),

			// Button.
			array(
				'name'     => 'colormag_button_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Button', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 50,
			),

			// Widget.
			array(
				'name'     => 'colormag_widget_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Widget', 'colormag' ),
				'panel'    => 'colormag_global_panel',
				'priority' => 60,
			),

			/**
			 * Front Page.
			 */
			array(
				'name'     => 'colormag_front_page_general_section',
				'type'     => 'section',
				'title'    => esc_html__( 'General', 'colormag' ),
				'panel'    => 'colormag_front_page_panel',
				'priority' => 0,
			),

			array(
				'name'     => 'colormag_front_page_layout_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Layout', 'colormag' ),
				'panel'    => 'colormag_front_page_panel',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_front_page_widget_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Widget', 'colormag' ),
				'panel'    => 'colormag_front_page_panel',
				'priority' => 20,
			),

			/**
			 * Header.
			 */
			array(
				'name'     => 'title_tagline',
				'type'     => 'section',
				'title'    => esc_html__( 'Site Identity', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 5,
			),

			array(
				'name'     => 'colormag_top_bar_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Top Bar', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_primary_header_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Header', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_primary_menu_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Primary Menu', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_sticky_header_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sticky Header', 'colormag' ),
				'panel'    => 'colormag_header_panel',
				'priority' => 50,
			),

			/**
			 * Content.
			 */
			array(
				'name'     => 'colormag_blog_archive_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Blog / Archive', 'colormag' ),
				'panel'    => 'colormag_content_panel',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_single_post_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Single Post', 'colormag' ),
				'panel'    => 'colormag_content_panel',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_post_meta_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Post Meta', 'colormag' ),
				'panel'    => 'colormag_content_panel',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_page_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Page', 'colormag' ),
				'panel'    => 'colormag_content_panel',
				'priority' => 40,
			),

			array(
				'name'     => 'colormag_sidebar_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar', 'colormag' ),
				'panel'    => 'colormag_content_panel',
				'priority' => 50,
			),

			/**
			 * Footer.
			 */
			array(
				'name'     => 'colormag_footer_general_section',
				'type'     => 'section',
				'title'    => esc_html__( 'General', 'colormag' ),
				'panel'    => 'colormag_footer_panel',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_footer_widgets_area_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Footer Widgets Area', 'colormag' ),
				'panel'    => 'colormag_footer_panel',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_footer_bottom_bar_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Footer Bottom Bar', 'colormag' ),
				'panel'    => 'colormag_footer_panel',
				'priority' => 30,
			),

			/**
			 * Additional.
			 */
			array(
				'name'     => 'colormag_additional_general_section',
				'type'     => 'section',
				'title'    => esc_html__( 'General', 'colormag' ),
				'panel'    => 'colormag_additional_panel',
				'priority' => 10,
			),

			array(
				'name'     => 'colormag_social_icons_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Social Icons', 'colormag' ),
				'panel'    => 'colormag_additional_panel',
				'priority' => 20,
			),

			array(
				'name'     => 'colormag_integrations_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Integrations', 'colormag' ),
				'panel'    => 'colormag_additional_panel',
				'priority' => 30,
			),

			array(
				'name'     => 'colormag_optimization_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Optimization', 'colormag' ),
				'panel'    => 'colormag_additional_panel',
				'priority' => 40,
			),

			/**
			 * WooCommerce.
			 */
			array(
				'name'     => 'colormag_woocommerce_sidebar_section',
				'type'     => 'section',
				'title'    => esc_html__( 'Sidebar', 'colormag' ),
				'panel'    => 'woocommerce',
				'priority' => 30,
			),
		);

		$options = array_merge( $options, $configs );

		return $options;
	}

}

return new ColorMag_Customize_Register_Section_Panels();
