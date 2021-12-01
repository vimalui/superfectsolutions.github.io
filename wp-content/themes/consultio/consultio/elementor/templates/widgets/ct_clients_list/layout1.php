<?php
$widget->add_render_attribute( 'inner', [
    'class' => 'ct-clients-list-inner',
] );

$col_xs = $widget->get_setting('col_xs', '');
$col_sm = $widget->get_setting('col_sm', '');
$col_md = $widget->get_setting('col_md', '');
$col_lg = $widget->get_setting('col_lg', '');
$col_xl = $widget->get_setting('col_xl', '');
$slides_to_scroll = $widget->get_setting('slides_to_scroll', '');

if (is_rtl()) {
    $carousel_dir = 'true';
} else {
    $carousel_dir = 'false';
}

$widget->add_render_attribute( 'carousel', [
    'class' => 'ct-slick-carousel',
    'data-arrows' => $settings['arrows'],
    'data-dots' => $settings['dots'],
    'data-pauseOnHover' => $settings['pause_on_hover'],
    'data-autoplay' => $settings['autoplay'],
    'data-autoplaySpeed' => $settings['autoplay_speed'],
    'data-infinite' => $settings['infinite'],
    'data-speed' => $settings['speed'],
    'data-colxs' => $col_xs,
    'data-colsm' => $col_sm,
    'data-colmd' => $col_md,
    'data-collg' => $col_lg,
    'data-colxl' => $col_xl,
    'data-dir' => $carousel_dir,
    'data-slidesToScroll' => $slides_to_scroll,
] );
?>
<?php if(isset($settings['clients']) && !empty($settings['clients']) && count($settings['clients'])): ?>
    <div class="ct-client1 ct-slick-slider <?php echo esc_attr($settings['style']); ?>">
        <div <?php ct_print_html($widget->get_render_attribute_string( 'inner' )); ?>>
            <div <?php ct_print_html($widget->get_render_attribute_string( 'carousel' )); ?>>
                <?php foreach ($settings['clients'] as $key => $client): 
                    $link_key = $widget->get_repeater_setting_key( 'title', 'value', $key );
                    if ( ! empty( $client['client_link']['url'] ) ) {
                        $widget->add_render_attribute( $link_key, 'href', $client['client_link']['url'] );

                        if ( $client['client_link']['is_external'] ) {
                            $widget->add_render_attribute( $link_key, 'target', '_blank' );
                        }

                        if ( $client['client_link']['nofollow'] ) {
                            $widget->add_render_attribute( $link_key, 'rel', 'nofollow' );
                        }
                    }
                    $link_attributes = $widget->get_render_attribute_string( $link_key );
                    if(!empty($client['client_image']['id'])) {
                        $img          = consultio_get_image_by_size( array(
                            'attach_id'  => $client['client_image']['id'],
                            'thumb_size' => 'full',
                            'class' => 'ct-thumb-1',
                        ) );
                        $thumbnail    = $img['thumbnail'];

                        $img_2          = consultio_get_image_by_size( array(
                            'attach_id'  => $client['client_image']['id'],
                            'thumb_size' => 'full',
                            'class' => 'ct-thumb-2',
                        ) );
                        $thumbnail_2    = $img_2['thumbnail'];
                        ?>
                        <div class="slick-slide">
                            <div class="client-image <?php echo esc_attr($settings['ct_animate']); ?>">
                                <a <?php echo implode( ' ', [ $link_attributes ] ); ?>>
                                    <?php echo wp_kses_post($thumbnail); ?>
                                    <?php if($settings['style'] == 'style3' || $settings['style'] == 'style4' || $settings['style'] == 'style5') : ?>
                                        <?php echo wp_kses_post($thumbnail_2); ?>
                                    <?php endif; ?>
                                </a>
                            </div>
                        </div>
                    <?php } ?>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif; ?>
