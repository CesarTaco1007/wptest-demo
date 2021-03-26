<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class Widget_Lite_WPKoi_Darkmode extends Widget_Base {

	public function get_name() {
		return 'wpkoi-darkmode';
	}

	public function get_title() {
		return esc_html__( 'Darkmode', 'wpkoi-elements' );
	}

	public function get_icon() {
		return 'eicon-adjust';
	}

   public function get_categories() {
		return [ 'wpkoi-addons-for-elementor' ];
	}


	protected function _register_controls() {


  		$this->start_controls_section(
            'section_layout',
            [
                'label' => esc_html__('Dark Mode', 'wpkoi-elements'),
            ]
        );

        $this->add_responsive_control(
            'icon_margin_right',
            [
                'label' => __('Margin from right', 'wpkoi-elements'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 40,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '.elementor-default .darkmode-toggle, .elementor-default  .darkmode-layer' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'icon_margin_bottom',
            [
                'label' => __('Margin from bottom', 'wpkoi-elements'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 40,
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    ' .elementor-default .darkmode-toggle, .elementor-default  .darkmode-layer' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
		
		$this->add_control(
			'icon_for_button',
			[
				'label' => esc_html__( 'Icon', 'wpkoi-elements' ),
				'type' => Controls_Manager::ICONS,
				'default' => [
					'value' => 'fas fa-adjust',
					'library' => 'fa-solid',
				]
			]
		);

        $this->add_control(
            'time',
            [
                'label' => esc_html__('Animation Time', 'wpkoi-elements'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 100,
                        'max' => 5000,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 500,
                ],
                'selectors' => [
                    '{{WRAPPER}} .box' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'saveInCookies',
            [
                'label' => esc_html__('Save In Cookies', 'wpkoi-elements'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );

        $this->add_control(
            'autoMatchOsTheme',
            [
                'label' => esc_html__('Auto Match Os Theme', 'wpkoi-elements'),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'true',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => esc_html__('Dark Mode', 'wpkoi-elements'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'default_background',
            [
                'label' => esc_html__('Default Background Color', 'wpkoi-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '.darkmode-background' => 'background: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'mix_color',
            [
                'label' => esc_html__('Content Mix Color', 'wpkoi-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#fff',
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'day_mode_icon_background',
            [
                'label' => esc_html__('Icon Background Day Mode', 'wpkoi-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#111111',
                'selectors' => [
                    '.darkmode-toggle' => 'background: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'dark_mode_icon_background',
            [
                'label' => esc_html__('Icon Background Dark Mode', 'wpkoi-elements'),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '.darkmode-toggle.darkmode-toggle--white' => 'background: {{VALUE}} !important',
                ],
            ]
        );

        $this->add_control(
            'icon_size',
            [
                'label' => esc_html__('Icon Size', 'wpkoi-elements'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 50,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 18,
                ],
                'selectors' => [
                    '.darkmode-toggle i' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'icon_button_width',
            [
                'label' => __('Switcher Size', 'wpkoi-elements'),
                'type' => Controls_Manager::SLIDER,
                'range' => [
                    'px' => [
                        'min' => 20,
                        'max' => 100,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 54,
                ],
                'selectors' => [
                    '.darkmode-toggle, .darkmode-layer:not(.darkmode-layer--expanded)' => 'height: {{SIZE}}{{UNIT}} !important; width: {{SIZE}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'icon_border',
                'label' => __('Border', 'wpkoi-elements'),
                'selector' => '.darkmode-toggle, .darkmode-layer',
            ]
        );

        $this->add_control(
            'icon_border_radius',
            [
                'label' => __('Border Radius', 'wpkoi-elements'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '.darkmode-toggle, .darkmode-layer' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->end_controls_section();


	}


	public function render( ) {

        $settings = $this->get_settings();

        ?>

        <script>
            jQuery(document).ready(function($) {
                var options = {
                    left: 'unset', // default: 'unset'
                    time: '<?php echo $settings['time']['size'] / 1000; ?>s',
                    mixColor: '<?php echo $settings['mix_color']; ?>',
                    backgroundColor: '<?php echo $settings['default_background']; ?>',
                    saveInCookies: '<?php echo $settings['saveInCookies']; ?>',
                    label: '<?php Icons_Manager::render_icon( $settings['icon_for_button'], [ 'aria-hidden' => 'true' ] ); ?>',
                    autoMatchOsTheme: '<?php echo $settings['autoMatchOsTheme']; ?>'
                }

                const darkmode = new Darkmode(options);
                darkmode.showWidget();
            });
        </script>

    <?php
    }

	protected function content_template() {
	}
}


Plugin::instance()->widgets_manager->register_widget_type( new Widget_Lite_WPKoi_Darkmode() );