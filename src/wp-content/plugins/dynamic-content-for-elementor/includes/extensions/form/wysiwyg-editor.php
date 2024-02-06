<?php

namespace DynamicContentForElementor\Extensions;

use Elementor\Controls_Manager;
use Elementor\Controls_Stack;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Border;
use Elementor\Icons_Manager;
use DynamicContentForElementor\Helper;
if (!\defined('ABSPATH')) {
    exit;
    // Exit if accessed directly
}
class DCE_Extension_Form_WYSIWYG extends \DynamicContentForElementor\Extensions\DCE_Extension_Prototype
{
    private $is_common = \false;
    public $has_action = \false;
    /**
     * Get Name
     *
     * Return the action name
     *
     * @access public
     * @return string
     */
    public function get_name()
    {
        return 'dce_form_wysiwyg';
    }
    /**
     * Get Label
     *
     * Returns the action label
     *
     * @access public
     * @return string
     */
    public function get_label()
    {
        return __('WYSIWYG', 'dynamic-content-for-elementor');
    }
    /**
     * Add Actions
     *
     * @since 0.5.5
     *
     * @access private
     */
    protected function add_actions()
    {
        add_action('elementor/widget/render_content', array($this, '_render_form'), 10, 2);
        add_action('elementor/element/form/section_form_fields/before_section_end', [$this, 'update_fields_controls']);
        add_action('elementor/widget/print_template', function ($template, $widget) {
            if ('form' === $widget->get_name()) {
                $template = \false;
            }
            return $template;
        }, 10, 2);
    }
    public function _render_form($content, $widget)
    {
        if ($widget->get_name() == 'form') {
            $settings = $widget->get_settings_for_display();
            $has_wysiwyg = \false;
            $jkey = 'dce_' . $widget->get_type() . '_form_' . $widget->get_id() . '_wysiwyg';
            if (!\Elementor\Plugin::$instance->editor->is_edit_mode()) {
                \ob_start();
                ?>
				<script id="<?php 
                echo $jkey;
                ?>">
					(function ($) {
						var <?php 
                echo $jkey;
                ?> = function ($scope, $) {
						if ($scope.hasClass("elementor-element-<?php 
                echo $widget->get_id();
                ?>")) {
				<?php 
                foreach ($settings['form_fields'] as $key => $afield) {
                    if ($afield['field_type'] == 'textarea') {
                        if (!empty($afield['field_wysiwyg'])) {
                            $has_wysiwyg = \true;
                            ?>
							tinymce.init({
								selector: '.elementor-element-<?php 
                            echo $widget->get_id();
                            ?> #form-field-<?php 
                            echo $afield['custom_id'];
                            ?>',
								menubar: false,
								branding: false,
								plugins: "lists, link, paste",
								setup: function (editor) {
									editor.on('change', function () {
										tinymce.triggerSave();
									});
								},
							});
							<?php 
                        }
                    }
                }
                ?>
							}
						};
						$(window).on("elementor/frontend/init", function () {
							elementorFrontend.hooks.addAction("frontend/element_ready/form.default", <?php 
                echo $jkey;
                ?>);
						});
					})(jQuery, window);
				</script>
				<?php 
                $add_js = \ob_get_clean();
                if ($has_wysiwyg) {
                    $add_js = \DynamicContentForElementor\Assets::dce_enqueue_script($jkey, $add_js);
                    wp_enqueue_script('tinymce_js', includes_url('js/tinymce/') . 'wp-tinymce.php', array('jquery'), \false, \true);
                    return $content . $add_js;
                }
            }
        }
        return $content;
    }
    public function update_fields_controls($widget)
    {
        $elementor = \ElementorPro\Plugin::elementor();
        $control_data = $elementor->controls_manager->get_control_from_stack($widget->get_unique_name(), 'form_fields');
        if (is_wp_error($control_data)) {
            return;
        }
        $field_controls = ['field_wysiwyg' => ['name' => 'field_wysiwyg', 'label' => __('WYSIWYG Editor', 'dynamic-content-for-elementor'), 'type' => Controls_Manager::SWITCHER, 'return_value' => 'true', 'separator' => 'before', 'conditions' => ['terms' => [['name' => 'field_type', 'value' => 'textarea']]], 'tabs_wrapper' => 'form_fields_tabs', 'inner_tab' => 'form_fields_enchanted_tab', 'tab' => 'enchanted']];
        $control_data['fields'] = \array_merge($control_data['fields'], $field_controls);
        $widget->update_control('form_fields', $control_data);
    }
}
