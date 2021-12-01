<?php
// Post term options
$post_term_options = ct_get_grid_term_options('service');
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );
// Register Post Carousel Widget
ct_add_custom_widget(
    array(
        'name' => 'ct_service_carousel',
        'title' => esc_html__('Case Services Carousel', 'consultio' ),
        'icon' => 'eicon-tools',
        'categories' => array( Case_Theme_Core::CT_CATEGORY_NAME ),
        'scripts' => array(
            'jquery-slick',
            'ct-post-carousel-widget-js',
        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'layout_section',
                    'label' => esc_html__('Layout', 'consultio' ),
                    'tab' => \Elementor\Controls_Manager::TAB_LAYOUT,
                    'controls' => array(
                        array(
                            'name' => 'layout',
                            'label' => esc_html__('Templates', 'consultio' ),
                            'type' => Case_Theme_Core::LAYOUT_CONTROL,
                            'default' => '1',
                            'options' => [
                                '1' => [
                                    'label' => esc_html__('Layout 1', 'consultio' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/ct_service_carousel/layout-image/layout1.jpg'
                                ],
                                '2' => [
                                    'label' => esc_html__('Layout 2', 'consultio' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/ct_service_carousel/layout-image/layout2.jpg'
                                ],
                                '3' => [
                                    'label' => esc_html__('Layout 3', 'consultio' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/ct_service_carousel/layout-image/layout3.jpg'
                                ],
                                '4' => [
                                    'label' => esc_html__('Layout 4', 'consultio' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/ct_service_carousel/layout-image/layout4.jpg'
                                ],
                                '5' => [
                                    'label' => esc_html__('Layout 5', 'consultio' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/ct_service_carousel/layout-image/layout5.jpg'
                                ],
                                '6' => [
                                    'label' => esc_html__('Layout 6', 'consultio' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/ct_service_carousel/layout-image/layout6.jpg'
                                ],
                                '7' => [
                                    'label' => esc_html__('Layout 7', 'consultio' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/ct_service_carousel/layout-image/layout7.jpg'
                                ],
                                '8' => [
                                    'label' => esc_html__('Layout 8', 'consultio' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/ct_service_carousel/layout-image/layout8.jpg'
                                ],
                                '9' => [
                                    'label' => esc_html__('Layout 9', 'consultio' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/ct_service_carousel/layout-image/layout9.jpg'
                                ],
                                '10' => [
                                    'label' => esc_html__('Layout 10', 'consultio' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/ct_service_carousel/layout-image/layout10.jpg'
                                ],
                                '11' => [
                                    'label' => esc_html__('Layout 11', 'consultio' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/ct_service_carousel/layout-image/layout11.jpg'
                                ],
                                '12' => [
                                    'label' => esc_html__('Layout 12', 'consultio' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/ct_service_carousel/layout-image/layout12.jpg'
                                ],
                                '13' => [
                                    'label' => esc_html__('Layout 13', 'consultio' ),
                                    'image' => get_template_directory_uri() . '/elementor/templates/widgets/ct_service_carousel/layout-image/layout13.jpg'
                                ],
                            ],
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                                'style2' => 'Style 2',
                            ],
                            'default' => 'style1',
                            'condition' => [
                                'layout' => '2',
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'source_section',
                    'label' => esc_html__('Source', 'consultio' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'thumbnail',
                            'type' => \Elementor\Group_Control_Image_Size::get_type(),
                            'control_type' => 'group',
                            'default' => 'custom',
                            'condition' => [
                                'layout' => ['1', '4'],
                            ],
                        ),
                        array(
                            'name' => 'source',
                            'label' => esc_html__('Select Categories', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT2,
                            'multiple' => true,
                            'options' => $post_term_options,
                        ),
                        array(
                            'name' => 'orderby',
                            'label' => esc_html__('Order By', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'date',
                            'options' => [
                                'date' => esc_html__('Date', 'consultio' ),
                                'ID' => esc_html__('ID', 'consultio' ),
                                'author' => esc_html__('Author', 'consultio' ),
                                'title' => esc_html__('Case Title', 'consultio' ),
                                'rand' => esc_html__('Random', 'consultio' ),
                            ],
                        ),
                        array(
                            'name' => 'order',
                            'label' => esc_html__('Sort Order', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => 'desc',
                            'options' => [
                                'desc' => esc_html__('Descending', 'consultio' ),
                                'asc' => esc_html__('Ascending', 'consultio' ),
                            ],
                        ),
                        array(
                            'name' => 'limit',
                            'label' => esc_html__('Total items', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => '6',
                        ),
                        array(
                            'name' => 'icon_item',
                            'label' => esc_html__('Icon image for each item', 'consultio'),
                            'type' => \Elementor\Controls_Manager::REPEATER,
                            'controls' => array(
                                array(
                                    'name' => 'icon_image',
                                    'label' => esc_html__( 'Icon image', 'consultio' ),
                                    'type' => \Elementor\Controls_Manager::MEDIA,
                                ),
                            ),
                            'condition' => [
                                'layout' => ['6'],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'display_section',
                    'label' => esc_html__('Display Options', 'consultio' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'show_title',
                            'label' => esc_html__('Show Title', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                        ),
                        array(
                            'name' => 'show_excerpt',
                            'label' => esc_html__('Show Excerpt', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                            'condition' => [
                                'layout' => ["1","3","4","5","6","7","8","9","11","13"],
                            ],
                        ),
                        array(
                            'name' => 'num_words',
                            'label' => esc_html__('Number of Words', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 25,
                            'condition' => [
                                'show_excerpt' => 'true',
                                'layout' => ["1","3","4","5","6","7","8","9","11","13"],
                            ],
                            'separator' => 'after',
                        ),
                        array(
                            'name' => 'show_button',
                            'label' => esc_html__('Show Read More', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'true',
                            'condition' => [
                                'layout' => ["1","3","4","5","6","7","8","9","10","11","13"],
                            ],
                        ),
                        array(
                            'name' => 'button_text',
                            'label' => esc_html__('Read More Text', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'condition' => [
                                'show_button' => 'true',
                                'layout' => ["3","4","5","6","7","8","9","10"],
                            ],
                        ),
                    ),
                ),
                array(
                    'name' => 'section_carousel_settings',
                    'label' => esc_html__('Carousel', 'consultio'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'ct_animate',
                            'label' => esc_html__('Case Animate', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => consultio_animate(),
                            'default' => '',
                        ),
                        array(
                            'name' => 'col_xs',
                            'label' => esc_html__('Columns XS Devices', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '1',
                            'options' => [
                                '1' => esc_html__('1', 'consultio' ),
                                '2' => esc_html__('2', 'consultio' ),
                                '3' => esc_html__('3', 'consultio' ),
                                '4' => esc_html__('4', 'consultio' ),
                                '6' => esc_html__('6', 'consultio' ),
                            ],
                        ),
                        array(
                            'name' => 'col_sm',
                            'label' => esc_html__('Columns SM Devices', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '2',
                            'options' => [
                                '1' => esc_html__('1', 'consultio' ),
                                '2' => esc_html__('2', 'consultio' ),
                                '3' => esc_html__('3', 'consultio' ),
                                '4' => esc_html__('4', 'consultio' ),
                                '6' => esc_html__('6', 'consultio' ),
                            ],
                        ),
                        array(
                            'name' => 'col_md',
                            'label' => esc_html__('Columns MD Devices', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '3',
                            'options' => [
                                '1' => esc_html__('1', 'consultio' ),
                                '2' => esc_html__('2', 'consultio' ),
                                '3' => esc_html__('3', 'consultio' ),
                                '4' => esc_html__('4', 'consultio' ),
                                '6' => esc_html__('6', 'consultio' ),
                            ],
                        ),
                        array(
                            'name' => 'col_lg',
                            'label' => esc_html__('Columns LG Devices', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '3',
                            'options' => [
                                '1' => esc_html__('1', 'consultio' ),
                                '2' => esc_html__('2', 'consultio' ),
                                '3' => esc_html__('3', 'consultio' ),
                                '4' => esc_html__('4', 'consultio' ),
                                '6' => esc_html__('6', 'consultio' ),
                            ],
                        ),
                        array(
                            'name' => 'col_xl',
                            'label' => esc_html__('Columns XL Devices', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '3',
                            'options' => [
                                '1' => esc_html__('1', 'consultio' ),
                                '2' => esc_html__('2', 'consultio' ),
                                '3' => esc_html__('3', 'consultio' ),
                                '4' => esc_html__('4', 'consultio' ),
                                '6' => esc_html__('6', 'consultio' ),
                            ],
                        ),

                        array(
                            'name' => 'slides_to_scroll',
                            'label' => esc_html__('Slides to scroll', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'default' => '1',
                            'options' => [
                                '1' => esc_html__('1', 'consultio' ),
                                '2' => esc_html__('2', 'consultio' ),
                                '3' => esc_html__('3', 'consultio' ),
                                '4' => esc_html__('4', 'consultio' ),
                                '6' => esc_html__('6', 'consultio' ),
                            ],
                        ),
                        array(
                            'name' => 'arrows',
                            'label' => esc_html__('Show Arrows', 'consultio'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'dots',
                            'label' => esc_html__('Show Dots', 'consultio'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'pause_on_hover',
                            'label' => esc_html__('Pause on Hover', 'consultio'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'autoplay',
                            'label' => esc_html__('Autoplay', 'consultio'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'autoplay_speed',
                            'label' => esc_html__('Autoplay Speed', 'consultio'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 5000,
                            'condition' => [
                                'autoplay' => 'true'
                            ]
                        ),
                        array(
                            'name' => 'infinite',
                            'label' => esc_html__('Infinite Loop', 'consultio'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                            'default' => 'false',
                        ),
                        array(
                            'name' => 'speed',
                            'label' => esc_html__('Animation Speed', 'consultio'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 500,
                        ),
                    ),
                ),
                array(
                    'name' => 'style_section',
                    'label' => esc_html__('Style', 'consultio' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'layout' => ["1"],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'box_bg',
                            'label' => esc_html__('Box Background Color', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-service-carousel1 .item--holder' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-service-carousel1 .item--holder .item--title' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'desc_color',
                            'label' => esc_html__('Description Color', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-service-carousel1 .item--holder .item--content' => 'color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'line_color',
                            'label' => esc_html__('Line Space Color', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .item--gap::before, {{WRAPPER}} .item--gap::after' => 'background: {{VALUE}};',
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);