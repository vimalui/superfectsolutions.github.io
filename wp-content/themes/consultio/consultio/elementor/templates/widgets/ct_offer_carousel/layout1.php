<?php
$widget->add_render_attribute( 'inner', [
    'class' => 'ct-carousel-inner',
] );

$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = $widget->get_setting('col_md', '');
$col_lg = $widget->get_setting('col_lg', '');
$col_xl = $widget->get_setting('col_xl', '');
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');

$arrows = $widget->get_setting('arrows');
$dots = $widget->get_setting('dots');
$pause_on_hover = $widget->get_setting('pause_on_hover');
$autoplay = $widget->get_setting('autoplay', '');
$autoplay_speed = $widget->get_setting('autoplay_speed', '5000');
$infinite = $widget->get_setting('infinite');
$speed = $widget->get_setting('speed', '500');
if (is_rtl()) {
    $carousel_dir = 'true';
} else {
    $carousel_dir = 'false';
}
$widget->add_render_attribute( 'carousel', [
    'class' => 'ct-slick-carousel',
    'data-arrows' => $arrows,
    'data-dots' => $dots,
    'data-pauseOnHover' => $pause_on_hover,
    'data-autoplay' => $autoplay,
    'data-autoplaySpeed' => $autoplay_speed,
    'data-infinite' => $infinite,
    'data-speed' => $speed,
    'data-colxs' => $col_xs,
    'data-colsm' => $col_sm,
    'data-colmd' => $col_md,
    'data-collg' => $col_lg,
    'data-colxl' => $col_xl,
    'data-dir' => $carousel_dir,
    'data-slidesToScroll' => $slides_to_scroll,
] );
?>
<?php if(isset($settings['testimonial']) && !empty($settings['testimonial']) && count($settings['testimonial'])): ?>
    <div class="ct-offer ct-offer-carousel1 ct-slick-slider">
        <div <?php ct_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
            <div <?php ct_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <?php foreach ($settings['testimonial'] as $value): 
                    $title = isset($value['title']) ? $value['title'] : '';
                    $description = isset($value['description']) ? $value['description'] : '';
                    $image = isset($value['image']) ? $value['image'] : '';
                    $btn_text = isset($value['btn_text']) ? $value['btn_text'] : '';
                    $btn_link = isset($value['btn_link']) ? $value['btn_link'] : '';
                    if ( ! empty( $btn_link['url'] ) ) {
                        $widget->add_render_attribute( 'button', 'href', $btn_link['url'] );

                        if ( $btn_link['is_external'] ) {
                            $widget->add_render_attribute( 'button', 'target', '_blank' );
                        }

                        if ( $btn_link['nofollow'] ) {
                            $widget->add_render_attribute( 'button', 'rel', 'nofollow' );
                        }
                    }
                    ?>
                        <div class="slick-slide">
                            <div class="item--inner <?php echo esc_attr($settings['ct_animate']); ?>">
                                <div class="item--holder">
                                    <h4 class="item--title">    
                                        <?php echo esc_attr($title); ?>
                                    </h4>
                                    <div class="item--description"><?php echo esc_html($description); ?></div>
                                    <?php if(!empty($btn_text)) : ?>
                                        <div class="item--button">
                                            <a <?php ct_print_html($widget->get_render_attribute_string( 'button' )); ?> class="btn"><i class="fac fa-file-alt space-right"></i><?php echo esc_attr($btn_text); ?></a>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <?php if(!empty($image)) { ?>
                                    <div class="item--image bg-image" style="background-image: url(<?php echo esc_url($image['url']); ?>);"></div>
                                <?php } ?>
                           </div>
                        </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
