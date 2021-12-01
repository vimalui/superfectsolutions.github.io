<?php
ct_add_custom_widget(
    array(
        'name' => 'ct_countdown',
        'title' => esc_html__('Case Countdown', 'consultio' ),
        'icon' => 'eicon-countdown',
        'categories' => array( Case_Theme_Core::CT_CATEGORY_NAME ),
        'scripts' => array(

        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'countdown_section',
                    'label' => esc_html__('Content', 'consultio' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'date',
                            'label' => esc_html__('Date', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                            'description' => esc_html__('Set date count down (Date format: yy/mm/dd)', 'consultio'),
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);