<?php
$default_settings = [
    'title' => '',
    'typingout' => '',
    'title_tag' => 'h3',
    'style' => 'st-default',
    'sub_title' => '',
    'sub_title_line' => 'show',
    'sub_title_style' => 'style1',
    'content_alignment_section' => 'left',
    'text_align' => '',
    'ct_animate' => '',
    'ct_animate_delay' => '',
];
$settings = array_merge($default_settings, $settings);
extract($settings); 
if(!empty($typingout)) {
    wp_enqueue_script('typingout', get_template_directory_uri() . '/assets/js/typingout.js', array( 'jquery' ), '1.0.0', true);
}
?>
<div class="ct-heading h-align-<?php echo esc_attr($text_align); ?> <?php echo esc_attr($ct_animate); ?> sub-<?php echo esc_attr($sub_title_style); ?> ct-heading-<?php echo esc_attr($content_alignment_section); ?> item-<?php echo esc_attr($style); ?>">
	<?php if(!empty($sub_title)) : ?>
		<div class="item--sub-title <?php echo esc_attr($sub_title_style); ?> <?php echo esc_attr($sub_title_line); ?>-line">
            <?php if($sub_title_style == 'style10') : ?>
                <span class="sub-dots"><span></span></span>
            <?php endif; ?>
            <?php echo esc_attr($sub_title); ?>
            <?php if($sub_title_style == 'style8') : ?>
                <span></span>
            <?php endif; ?>
            <?php if($sub_title_style == 'style9') : ?>
                <span class="line-left"></span>
                <span class="line-right"></span>
            <?php endif; ?>
        </div>
	<?php endif; ?>
    <<?php echo esc_attr($title_tag); ?> class="item--title <?php echo esc_attr($style); ?> <?php if($ct_animate != 'case-fade-in-up') { echo esc_attr($ct_animate); } else { echo 'case-animate-time'; } ?>" data-wow-delay="<?php echo esc_attr($ct_animate_delay); ?>ms">
        <?php if($style == 'st-line-top1' || $style == 'st-line-top2') : ?>
            <div class="ct-heading-divider"><span></span></div>
        <?php endif; ?>
        <span class="sp-main">
            <?php if($style == 'st-line-left1' || $style == 'st-line-right1' || $style == 'st-line-left2') : ?>
                <i></i>
            <?php endif; ?>

            <?php if($ct_animate == 'case-fade-in-up') {
                $arr_str = explode(' ', $title);
                foreach ($arr_str as $index => $value) {
                    $arr_str[$index] = '<span class="slide-in-container"><span class="d-inline-block wow '.$ct_animate.'">' . $value . '</span></span>';
                }
                $str = implode(' ', $arr_str);
                echo ct_print_html($str);
            } else {
                echo wp_kses_post($title);
            } ?>

            <?php if(!empty($typingout)) { ?>
                <span class="ct-typingout-typed" data-period="600" data-type='[ <?php echo esc_attr($typingout); ?> ]'>
                    <span class="ct-typingout-animation"></span>
                </span>
            <?php } ?>

            <?php if($style == 'st-line-left3') : ?>
                <i class="dot-shape">
                    <i></i>
                    <i></i>
                    <i></i>
                    <i></i>
                    <i></i>
                    <i></i>
                </i>
            <?php endif; ?>
        </span>
        <?php if($style == 'st-line-bottom1') : ?>
            <div class="ct-heading-divider"><span></span></div>
        <?php endif; ?>
    </<?php echo esc_attr($title_tag); ?>>
</div>