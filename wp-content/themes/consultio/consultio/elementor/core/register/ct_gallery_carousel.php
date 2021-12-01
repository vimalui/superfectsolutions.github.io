<?php
$slides_to_show = range( 1, 10 );
$slides_to_show = array_combine( $slides_to_show, $slides_to_show );

// Register Gallery List Widget
ct_add_custom_widget(
    array(
        'name' => 'ct_gallery_carousel',
        'title' => esc_html__('Case Gallery Carousel', 'consultio'),
        'icon' => 'eicon-image-before-after',
        'categories' => array(Case_Theme_Core::CT_CATEGORY_NAME),
        'scripts' => array(
            'jquery-slick',
            'ct-post-carousel-widget-js',
        ),
        'params' => array(
            'sections' => array(        
                array(
                    'name' => 'section_gallery',
                    'label' => esc_html__('Gallery', 'consultio'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'image',
                            'label' => esc_html__('Image', 'consultio'),
                            'type' => \Elementor\Controls_Manager::GALLERY,
                            'label_block' => true,
                        ),
                    ),
                ),
                array(
                    'name' => 'section_carousel_settings',
                    'label' => esc_html__('Carousel Settings', 'consultio'),
                    'tab' => \Elementor\Controls_Manager::TAB_SETTINGS,
                    'controls' => array(
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
                        ),
                        array(
                            'name' => 'dots',
                            'label' => esc_html__('Show Dots', 'consultio'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'pause_on_hover',
                            'label' => esc_html__('Pause on Hover', 'consultio'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
                        ),
                        array(
                            'name' => 'autoplay',
                            'label' => esc_html__('Autoplay', 'consultio'),
                            'type' => \Elementor\Controls_Manager::SWITCHER,
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
                        ),
                        array(
                            'name' => 'speed',
                            'label' => esc_html__('Animation Speed', 'consultio'),
                            'type' => \Elementor\Controls_Manager::NUMBER,
                            'default' => 500,
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);