<?php
/**
 * Template part for displaying default header layout
 */
$header_type_page = consultio_get_page_opt( 'header_type', 'themeoption' );

$e_header_layout = consultio_get_opt('e_header_layout');
$e_header_layout_sticky = consultio_get_opt('e_header_layout_sticky');

$e_header_layout_page = consultio_get_page_opt('e_header_layout');
if($header_type_page == 'custom' ) {
    $e_header_layout = $e_header_layout_page;
}

$e_header_layout_sticky_page = consultio_get_page_opt('e_header_layout_sticky');
if($header_type_page == 'custom' ) {
    $e_header_layout_sticky = $e_header_layout_sticky_page;
}

$logo_m = consultio_get_opt( 'logo_mobile', array( 'url' => get_template_directory_uri().'/assets/images/logo-dark.png', 'id' => '' ) );
$e_logo_mobile = consultio_get_page_opt( 'e_logo_mobile' );
if($header_type_page == 'custom' && !empty($e_logo_mobile['url']) ) {
    $logo_m = $e_logo_mobile;
}
?>
<header id="ct-header-elementor" class="is-sticky">
	<?php if(isset($e_header_layout) && !empty($e_header_layout)) : ?>
		<div class="ct-header-elementor-main">
		    <div class="container">
		        <div class="row">
		        	<div class="col-12">
			            <?php $post_main = get_post($e_header_layout);
	                    if (!is_wp_error($post_main) && $post_main->ID == $e_header_layout && class_exists('Case_Theme_Core') && function_exists('ct_print_html')){
	                        $content_main = \Elementor\Plugin::$instance->frontend->get_builder_content( $e_header_layout );
	                        ct_print_html($content_main);
	                    } ?>
	                </div>
		        </div>
		    </div>
		</div>
	<?php endif; ?>
	<?php if(isset($e_header_layout_sticky) && !empty($e_header_layout_sticky)) : ?>
		<div class="ct-header-elementor-sticky">
		    <div class="container">
		        <div class="row">
		            <?php $post_sticky = get_post($e_header_layout_sticky);
	                    if (!is_wp_error($post_sticky) && $post_sticky->ID == $e_header_layout_sticky && class_exists('Case_Theme_Core') && function_exists('ct_print_html')){
	                        $content_sticky = \Elementor\Plugin::$instance->frontend->get_builder_content( $e_header_layout_sticky );
	                        ct_print_html($content_sticky);
	                    } ?>
		        </div>
		    </div>
		</div>
	<?php endif; ?>
    <div class="ct-header-mobile">
        <div id="ct-header" class="ct-header-main">
            <div class="container">
                <div class="row">
                    <div class="ct-header-branding">
                        <?php get_template_part( 'template-parts/header-branding' ); ?>
                    </div>
                    <div class="ct-header-navigation">
                        <nav class="ct-main-navigation">
                            <div class="ct-main-navigation-inner">
                                <?php if ($logo_m['url']) { ?>
                                    <div class="ct-logo-mobile">
                                        <a href="<?php esc_url( esc_url( home_url( '/' ) ) ); ?>" title="<?php esc_attr( get_bloginfo( 'name' ) ); ?>" rel="home"><img src="<?php echo esc_url( $logo_m['url'] ); ?>" alt="<?php esc_attr( get_bloginfo( 'name' ) ); ?>"/></a>
                                    </div>
                                <?php } ?>
                                <?php consultio_header_mobile_search(); ?>
                                <?php get_template_part( 'template-parts/header-menu' ); ?>
                            </div>
                        </nav>
                    </div>
                    <div class="ct-menu-overlay"></div>
                </div>
            </div>
            <div id="ct-menu-mobile">
                <div class="ct-mobile-meta-item btn-nav-mobile open-menu">
                    <span></span>
                </div>
            </div>
        </div>
    </div>
</header>