<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package Consultio
 */
$page_404 = consultio_get_opt( 'page_404', 'default' );
$page_custom_404 = consultio_get_opt( 'page_custom_404' );
get_header(); ?>

    <div id="primary" class="content-area">
        <main id="main" class="site-main">
            <div class="row">
                <div class="col-12">
                    <?php if($page_404 == 'default') { ?>
                        <section class="error-404">
                            <div class="error-404-content">
                                <div class="error-404-holder">
                                    <h3 class="error-404-title"><?php echo esc_html__('Error 404', 'consultio'); ?></h3>
                                    <div class="error-404-sub">
                                        <span><?php echo esc_html__('Page not found', 'consultio'); ?></span>
                                    </div>
                                    <a class="btn" href="<?php echo esc_url(home_url('/')); ?>">
                                        <i class="fac fac-cog space-right"></i>
                                        <?php echo esc_html__('Go Home now', 'consultio'); ?>   
                                    </a>
                                </div>
                            </div>
                        </section>
                    <?php } else { ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                            <div class="entry-content clearfix">
                                <?php $post = get_post($page_custom_404);
                                if (!is_wp_error($post) && $post->ID == $page_custom_404 && class_exists('Case_Theme_Core') && function_exists('ct_print_html')){
                                    $content = \Elementor\Plugin::$instance->frontend->get_builder_content( $page_custom_404 );
                                    ct_print_html($content);
                                } ?>
                            </div>
                        </article>
                    <?php } ?>
                </div>
            </div>
        </main><!-- #main -->
    </div><!-- #primary -->

<?php
get_footer();
