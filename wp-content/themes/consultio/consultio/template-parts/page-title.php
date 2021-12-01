<?php
$titles = consultio_get_page_titles();
$custom_pagetitle = consultio_get_page_opt( 'custom_pagetitle', 'themeoption');
$pagetitle = consultio_get_opt( 'pagetitle', 'show' );
$ptitle_display = consultio_get_page_opt( 'ptitle_display', 'show' );
$ptitle_overlay = consultio_get_opt( 'ptitle_overlay', 'show' );
$page_ptitle_overlay = consultio_get_page_opt( 'ptitle_overlay', 'themeoption' );
if($custom_pagetitle != 'themeoption' && $custom_pagetitle != '' && isset($page_ptitle_overlay) && $page_ptitle_overlay != 'themeoption' && $page_ptitle_overlay != '') {
    $ptitle_overlay = $page_ptitle_overlay;
}
$ptitle_breadcrumb_page = consultio_get_page_opt( 'ptitle_breadcrumb_page', 'themeoption');
$ptitle_breadcrumb_on = consultio_get_opt( 'ptitle_breadcrumb_on', 'show' );
if($custom_pagetitle != 'themeoption' && $custom_pagetitle != '') {
    $pagetitle = $custom_pagetitle;
}
if($custom_pagetitle != 'themeoption' && $custom_pagetitle != '' && !empty($ptitle_breadcrumb_page) && $ptitle_breadcrumb_page != 'themeoption') {
    $ptitle_breadcrumb_on = $ptitle_breadcrumb_page;
}

$sub_title = consultio_get_page_opt( 'sub_title' );
$sub_title_position = consultio_get_page_opt( 'sub_title_position', 'bottom-title' );
ob_start();
if ( $titles['title'] )
{
    printf( '<h1 class="page-title">%s</h1>', wp_kses_post($titles['title']) );
}
$titles_html = ob_get_clean();
if($pagetitle == 'show') : ?>
    <div id="pagetitle" class="page-title bg-image <?php if($custom_pagetitle && !empty($ptitle_display) && $ptitle_display == 'hidden') { echo 'ptitle-hidden'; } if($ptitle_overlay == 'hidden') { echo 'overlay-hide'; } ?>">
        <div class="container">
            <div class="page-title-inner">
                
                <div class="page-title-holder">
                    <?php if(!empty($sub_title)) : ?>
                        <h6 class="page-sub-title"><?php echo esc_attr($sub_title); ?></h6>
                    <?php endif; ?>
                    <?php printf( '%s', wp_kses_post($titles_html)); ?>
                </div>

                <?php if($ptitle_breadcrumb_on == 'show') : ?>
                    <?php consultio_breadcrumb(); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endif; ?>