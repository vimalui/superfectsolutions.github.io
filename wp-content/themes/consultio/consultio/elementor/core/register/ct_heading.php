<?php
ct_add_custom_widget(
    array(
        'name' => 'ct_heading',
        'title' => esc_html__('Case Heading', 'consultio' ),
        'icon' => 'eicon-heading',
        'categories' => array( Case_Theme_Core::CT_CATEGORY_NAME ),
        'scripts' => array(

        ),
        'params' => array(
            'sections' => array(
                array(
                    'name' => 'title_section',
                    'label' => esc_html__('Title', 'consultio' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'controls' => array(
                        array(
                            'name' => 'text_align',
                            'label' => esc_html__('Alignment', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::CHOOSE,
                            'control_type' => 'responsive',
                            'options' => [
                                'left' => [
                                    'title' => esc_html__('Case Left', 'consultio' ),
                                    'icon' => 'eicon-text-align-left',
                                ],
                                'center' => [
                                    'title' => esc_html__('Case Center', 'consultio' ),
                                    'icon' => 'eicon-text-align-center',
                                ],
                                'right' => [
                                    'title' => esc_html__('Case Right', 'consultio' ),
                                    'icon' => 'eicon-text-align-right',
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ct-heading' => 'text-align: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'title',
                            'label' => esc_html__('Title', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'title_tag',
                            'label' => esc_html__('Heading HTML Tag', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'h1' => 'H1',
                                'h2' => 'H2',
                                'h3' => 'H3',
                                'h4' => 'H4',
                                'h5' => 'H5',
                                'h6' => 'H6',
                                'div' => 'div',
                                'span' => 'span',
                                'p' => 'p',
                            ],
                            'default' => 'h3',
                        ),
                        array(
                            'name' => 'typingout',
                            'label' => esc_html__('Typing Out', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::TEXTAREA,
                            'description' => esc_html__('Example: "Business", "Consulting", "Corporate"', 'consultio' ),
                            'rows' => 10,
                            'show_label' => false,
                        ),
                        array(
                            'name' => 'title_color',
                            'label' => esc_html__('Title Color', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-heading .item--title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .ct-heading .item--title i' => 'color: {{VALUE}};',
                            ],
                            'control_type' => 'responsive',
                        ),
                        array(
                            'name' => 'title_typography',
                            'label' => esc_html__('Title Typography', 'consultio' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .ct-heading .item--title',
                        ),
                        array(
                            'name' => 'title_space_bottom',
                            'label' => esc_html__('Bottom Spacer', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 0,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ct-heading .item--title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                        ),
                        array(
                            'name' => 'style',
                            'label' => esc_html__('Style', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'st-default' => 'Default',
                                'st-line-left1' => 'Line Left Style 1',
                                'st-line-left2' => 'Line Left Style 2',
                                'st-line-left3' => 'Line Left Style 3',
                                'st-line-right1' => 'Line Right Style 1',
                                'st-line-top1' => 'Line Top Style 1',
                                'st-line-top2' => 'Line Top Style 2',
                                'st-line-bottom1' => 'Line Bottom Style 1',
                                'st-line-center' => 'Line Left/Right',
                            ],
                            'default' => 'st-default',
                        ),
                        array(
                            'name' => 'divider_width',
                            'label' => esc_html__('Divider Width', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ct-heading .item--title.st-line-bottom1 .ct-heading-divider span' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'style' => 'st-line-bottom1',
                            ],
                        ),
                        array(
                            'name' => 'st_line_dot_color1',
                            'label' => esc_html__('Line Color 1', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-heading .item--title.st-line-left3 span .dot-shape i:nth-child(1) ' => 'background-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .ct-heading .item--title.st-line-left3 span .dot-shape i:nth-child(3) ' => 'background-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .ct-heading .item--title.st-line-left3 span .dot-shape i:nth-child(4) ' => 'background-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .ct-heading .item--title.st-line-left3 span .dot-shape i:nth-child(5) ' => 'background-color: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'style' => 'st-line-left3',
                            ],
                        ),
                        array(
                            'name' => 'st_line_dot_color2',
                            'label' => esc_html__('Line Color 2', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-heading .item--title.st-line-left3 span .dot-shape i:nth-child(2) ' => 'background-color: {{VALUE}} !important;',
                                '{{WRAPPER}} .ct-heading .item--title.st-line-left3 span .dot-shape i:nth-child(6) ' => 'background-color: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'style' => 'st-line-left3',
                            ],
                        ),
                        array(
                            'name' => 'st_line_color',
                            'label' => esc_html__('Line Color', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-heading .item--title.st-line-left1 span i' => 'background: {{VALUE}} !important;',
                                '{{WRAPPER}} .ct-heading .item--title.st-line-left2 span i:after' => 'background: {{VALUE}} !important;',
                                '{{WRAPPER}} .ct-heading .item--title.st-line-left2 span i:before' => 'background: {{VALUE}} !important;',
                                '{{WRAPPER}} .ct-heading .item--title.st-line-top1 .ct-heading-divider span' => 'background: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'style' => ['st-line-left1', 'st-line-left2', 'st-line-top1'],
                            ],
                        ),
                        array(
                            'name' => 'ct_animate',
                            'label' => esc_html__('Case Animate', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => consultio_animate_case(),
                            'default' => '',
                        ),
                        array(
                            'name' => 'ct_animate_delay',
                            'label' => esc_html__('Animate Delay', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'default' => '0',
                            'description' => 'Enter number. Default 0ms',
                        ),
                    ),
                ),
                array(
                    'name' => 'sub_title_section',
                    'label' => esc_html__('Sub Title', 'consultio' ),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                    'condition' => [
                        'style' => ['st-default','st-line-left2', 'st-line-left3','st-line-bottom1','st-line-center'],
                    ],
                    'controls' => array(
                        array(
                            'name' => 'sub_title',
                            'label' => esc_html__('Sub Title', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::TEXT,
                            'label_block' => true,
                        ),
                        array(
                            'name' => 'sub_title_color',
                            'label' => esc_html__('Sub Title Color', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-heading .item--sub-title' => 'color: {{VALUE}};',
                                '{{WRAPPER}} .ct-heading .item--sub-title.style3:before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .ct-heading .item--sub-title.style7:before' => 'background-color: {{VALUE}};',
                                '{{WRAPPER}} .ct-heading .item--sub-title.style7:after' => 'background-color: {{VALUE}};',
                            ],
                        ),
                        array(
                            'name' => 'sub_title_typography',
                            'label' => esc_html__('Sub Title Typography', 'consultio' ),
                            'type' => \Elementor\Group_Control_Typography::get_type(),
                            'control_type' => 'group',
                            'selector' => '{{WRAPPER}} .ct-heading .item--sub-title',
                        ),
                        array(
                            'name' => 'sub_title_space_top',
                            'label' => esc_html__('Top Spacer', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 0,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ct-heading .item--sub-title' => 'margin-top: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'sub_title_style' => 'style2',
                            ],
                        ),
                        array(
                            'name' => 'sub_title_space_bottom',
                            'label' => esc_html__('Bottom Spacer', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SLIDER,
                            'control_type' => 'responsive',
                            'size_units' => [ 'px' ],
                            'default' => [
                                'size' => 9,
                            ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 300,
                                ],
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .ct-heading .item--sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                            ],
                            'condition' => [
                                'sub_title_style' => 'style1',
                            ],
                        ),
                        array(
                            'name' => 'sub_title_style',
                            'label' => esc_html__('Style', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'style1' => 'Style 1',
                                'style2' => 'Style 2',
                                'style3' => 'Style 3',
                                'style4' => 'Style 4',
                                'style5' => 'Style 5',
                                'style6' => 'Style 6',
                                'style7' => 'Style 7',
                                'style8' => 'Style 8',
                                'style9' => 'Style 9',
                                'style10' => 'Style 10 (Dots)',
                            ],
                            'default' => 'style1',
                        ),
                        array(
                            'name' => 'sub_title_line',
                            'label' => esc_html__('Line', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::SELECT,
                            'options' => [
                                'show' => 'Show',
                                'hide' => 'Hide',
                            ],
                            'default' => 'show',
                            'condition' => [
                                'style' => ['st-default', 'st-line-bottom1'],
                                'sub_title_style' => ['style1','style2','style3','style4','style5','style6','style7','style8','style9'],
                            ],
                        ),
                        array(
                            'name' => 'sub_line_color',
                            'label' => esc_html__('Sub Line Color', 'consultio' ),
                            'type' => \Elementor\Controls_Manager::COLOR,
                            'selectors' => [
                                '{{WRAPPER}} .ct-heading .item--sub-title.style1::before' => 'background: {{VALUE}} !important;',
                            ],
                            'condition' => [
                                'style' => ['st-default'],
                            ],
                        ),
                    ),
                ),
            ),
        ),
    ),
    get_template_directory() . '/elementor/core/widgets/'
);