<?php

$html_id = ct_get_element_id($settings);
$source = $widget->get_setting('source', '');
$orderby = $widget->get_setting('orderby', 'date');
$order = $widget->get_setting('order', 'desc');
$limit = $widget->get_setting('limit', 6);
$post_ids = $widget->get_setting('post_ids', '');
extract(ct_get_posts_of_grid('service', [
    'source' => $source,
    'orderby' => $orderby,
    'order' => $order,
    'limit' => $limit,
    'post_ids' => $post_ids,
]));

$widget->add_render_attribute( 'inner', [
    'class' => 'ct-carousel-inner',
] );

$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = $widget->get_setting('col_md', '');
$col_lg = $widget->get_setting('col_lg', '');
$col_xl = $widget->get_setting('col_xl', '');
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');

$ct_animate = $widget->get_setting('ct_animate');
$style = $widget->get_setting('style');
$show_title = $widget->get_setting('show_title');
$show_excerpt = $widget->get_setting('show_excerpt');
$num_words = $widget->get_setting('num_words');
$show_button = $widget->get_setting('show_button');
$arrows = $widget->get_setting('arrows');
$dots = $widget->get_setting('dots');
$pause_on_hover = $widget->get_setting('pause_on_hover');
$autoplay = $widget->get_setting('autoplay');
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
<?php if (is_array($posts)): ?>

<div id="<?php echo esc_attr($html_id) ?>" class="ct-service-carousel2 ct-slick-slider <?php echo esc_attr($style); ?>">
    <div <?php ct_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
        <div <?php ct_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
        <?php
            foreach ($posts as $post):
            $icon_type = get_post_meta($post->ID, 'icon_type', true);
            $service_icon = get_post_meta($post->ID, 'service_icon', true);
            $service_icon_img = get_post_meta($post->ID, 'service_icon_img', true);
            if(!empty($service_icon_img['id'])) {
                $icon_img = ct_get_image_by_size( array(
                    'attach_id'  => $service_icon_img['id'],
                    'thumb_size' => 'full',
                ));
                $icon_thumbnail = $icon_img['thumbnail'];
            }
            $service_except = get_post_meta($post->ID, 'service_except', true);
            ?>
            <div class="carousel-item slick-slide">
                <div class="grid-item-inner <?php echo esc_attr($ct_animate); ?>">
                    <div class="grid-item-holder">
                        <div class="item--overlay"></div>
                        <?php if($icon_type == 'icon' && !empty($service_icon)) : ?>
                            <div class="item--icon"><i class="text-gradient <?php echo esc_attr($service_icon); ?>"></i></div>
                        <?php endif; ?>

                        <?php if($icon_type == 'image' && !empty($service_icon_img['id'])) : ?>
                            <div class="item--icon">
                                <?php echo wp_kses_post($icon_thumbnail); ?>
                            </div>
                        <?php endif; ?>

                        <?php if($show_title == 'true'): ?>
                            <h3 class="item--title"><a href="<?php echo esc_url(get_permalink( $post->ID )); ?>"><?php echo esc_attr(get_the_title($post->ID)); ?></a></h3>
                        <?php endif; ?>
                        <?php if($show_excerpt == 'true' && !empty($service_except)): ?>
                            <div class="item--content">
                                <?php echo wp_trim_words( $service_except, $num_words, $more = null ); ?>
                            </div>
                        <?php endif; ?>
                        <?php if($icon_type == 'icon' && !empty($service_icon)) : ?>
                            <div class="item--icon-abs"><i class="text-gradient <?php echo esc_attr($service_icon); ?>"></i></div>
                        <?php endif; ?>
                        <?php if($icon_type == 'image' && !empty($service_icon_img['id'])) : ?>
                            <div class="item--icon-abs">
                                <?php echo wp_kses_post($icon_thumbnail); ?>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
        </div>
    </div>
</div>
<?php endif; ?>