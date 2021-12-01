<?php
if ( ! class_exists( 'ReduxFrameworkInstances' ) ) {
	return;
}
class CSS_Generator {
	/**
     * scssc class instance
     *
     * @access protected
     * @var scssc
     */
    protected $scssc = null;

    /**
     * ReduxFramework class instance
     *
     * @access protected
     * @var ReduxFramework
     */
    protected $redux = null;

    /**
     * Debug mode is turn on or not
     *
     * @access protected
     * @var boolean
     */
    protected $dev_mode = true;

    /**
     * opt_name of ReduxFramework
     *
     * @access protected
     * @var string
     */
    protected $opt_name = '';

	/**
	 * Constructor
	 */
	function __construct() {
		$this->opt_name = consultio_get_opt_name();
		if ( empty( $this->opt_name ) ) {
			return;
		}
		$this->dev_mode = consultio_get_opt( 'dev_mode', '0' ) === '1' ? true : false;
		add_filter( 'ct_scssc_on', '__return_true' );
		add_action( 'init', array( $this, 'init' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue' ), 20 );
	}

	/**
	 * init hook - 10
	 */
	function init() {
		if ( ! class_exists( 'scssc' ) ) {
			return;
		}

		$this->redux = ReduxFrameworkInstances::get_instance( $this->opt_name );

		if ( empty( $this->redux ) || ! $this->redux instanceof ReduxFramework ) {
			return;
		}
		add_action( 'wp', array( $this, 'generate_with_dev_mode' ) );
		add_action( "redux/options/{$this->opt_name}/saved", function () {
			$this->generate_file();
		} );
	}

	function generate_with_dev_mode() {
		if ( $this->dev_mode === true ) {
			$this->generate_file();
		}
	}

	/**
	 * Generate options and css files
	 */
	function generate_file() {
		$scss_dir = get_template_directory() . '/assets/scss/';
		$css_dir  = get_template_directory() . '/assets/css/';

		$this->scssc = new scssc();
		$this->scssc->setImportPaths( $scss_dir );

		$_options = $scss_dir . 'variables.scss';

		$this->redux->filesystem->execute( 'put_contents', $_options, array(
			'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->options_output() )
		) );
		$css_file = $css_dir . 'theme.css';

		$this->scssc->setFormatter( 'scss_formatter' );
		$this->redux->filesystem->execute( 'put_contents', $css_file, array(
			'content' => preg_replace( "/(?<=[^\r]|^)\n/", "\r\n", $this->scssc->compile( '@import "theme.scss"' ) )
		) );
	}

	/**
	 * Output options to _variables.scss
	 *
	 * @access protected
	 * @return string
	 */
	protected function options_output() {
		ob_start();

		$primary_color = consultio_get_opt( 'primary_color', '#c1282a' );
		if ( ! consultio_is_valid_color( $primary_color ) ) {
			$primary_color = '#c1282a';
		}
		printf( '$primary_color: %s;', esc_attr( $primary_color ) );

		$secondary_color = consultio_get_opt( 'secondary_color', '#000000' );
		if ( ! consultio_is_valid_color( $secondary_color ) ) {
			$secondary_color = '#000000';
		}
		printf( '$secondary_color: %s;', esc_attr( $secondary_color ) );

		$third_color = consultio_get_opt( 'third_color', '#ff8a8b' );
        if ( !consultio_is_valid_color( $third_color ) )
        {
            $third_color = '#ff8a8b';
        }
        printf( '$third_color: %s;', esc_attr( $third_color ) );

        $four_color = consultio_get_opt( 'four_color', '#ffd200' );
        if ( !consultio_is_valid_color( $four_color ) )
        {
            $four_color = '#ffd200';
        }
        printf( '$four_color: %s;', esc_attr( $four_color ) );

		$link_color = consultio_get_opt( 'link_color', '#c1282a' );
		if ( !empty( $link_color['regular'] ) && isset( $link_color['regular'] ) ) {
			printf( '$link_color: %s;', esc_attr( $link_color['regular'] ) );
		} else {
			echo '$link_color: #c1282a;';
		}

		$link_color_hover = consultio_get_opt( 'link_color', '#c1282a' );
		if ( !empty( $link_color['hover'] ) && isset( $link_color['hover'] ) ) {
			printf( '$link_color_hover: %s;', esc_attr( $link_color['hover'] ) );
		} else {
			echo '$link_color_hover: #c1282a;';
		}

		$link_color_active = consultio_get_opt( 'link_color', '#c1282a' );
		if ( !empty( $link_color['active'] ) && isset( $link_color['active'] ) ) {
			printf( '$link_color_active: %s;', esc_attr( $link_color['active'] ) );
		} else {
			echo '$link_color_active: #c1282a;';
		}

		/* Gradient Color 1 */
        $gradient_color = consultio_get_opt( 'gradient_color' );
        if ( !empty($gradient_color['from']) && isset($gradient_color['from']) )
        {
            printf( '$gradient_color_from: %s;', esc_attr( $gradient_color['from'] ) );
        } else {
            echo '$gradient_color_from: '.$primary_color.';';
        }
        if ( !empty($gradient_color['to']) && isset($gradient_color['to']) )
        {
            printf( '$gradient_color_to: %s;', esc_attr( $gradient_color['to'] ) );
        } else {
            echo '$gradient_color_to: '.$primary_color.';';
        }

		/* Font */
		$body_default_font = consultio_get_opt( 'body_default_font', 'Roboto' );
		if ( isset( $body_default_font ) ) {
			echo '
                $body_default_font: ' . esc_attr( $body_default_font ) . ';
            ';
		}

		$heading_default_font = consultio_get_opt( 'heading_default_font', 'Poppins' );
		if ( isset( $heading_default_font ) ) {
			echo '
                $heading_default_font: ' . esc_attr( $heading_default_font ) . ';
            ';
		}

		return ob_get_clean();
	}

	/**
	 * Hooked wp_enqueue_scripts - 20
	 * Make sure that the handle is enqueued from earlier wp_enqueue_scripts hook.
	 */
	function enqueue() {
		$css = $this->inline_css();
		if ( !empty( $css ) ) {
			wp_add_inline_style( 'consultio-theme', $css );
		}
	}

	/**
	 * Generate inline css based on theme options
	 */
	protected function inline_css() {
		ob_start();

		/* Header */ ?>
		@media screen and (min-width: 1200px) {
			<?php
			$header_bg_color = consultio_get_opt( 'header_bg_color' );
			$header_bg_color_sticky = consultio_get_opt( 'header_bg_color_sticky' );
			$topbar_bg_color = consultio_get_opt( 'topbar_bg_color' );

			if ( !empty( $header_bg_color ) ) {
				printf( '#ct-header-wrap #ct-header:not(.h-fixed) { background-color: %s !important; }', esc_attr( $header_bg_color ) );
				printf( '#ct-header-wrap.ct-header-layout1 #ct-header:not(.h-fixed) { background-color: transparent !important; }', esc_attr( $header_bg_color ) );
				printf( '#ct-header-wrap.ct-header-layout1 #ct-header:not(.h-fixed) .ct-header-navigation-bg { background-color: %s !important; }', esc_attr( $header_bg_color ) );
			}

			if ( !empty( $header_bg_color_sticky ) ) {
				printf( '#ct-header-wrap #ct-header.h-fixed { background-color: %s !important; }', esc_attr( $header_bg_color_sticky ) );
			}

			if ( !empty( $topbar_bg_color ) ) {
				printf( '#ct-header-wrap #ct-header-top { background-color: %s !important; }', esc_attr( $topbar_bg_color ) );
			}

		/* Logo */
		
			$logo_maxh = consultio_get_opt( 'logo_maxh' );
			if ( !empty( $logo_maxh['height'] ) && $logo_maxh['height'] != 'px' ) {
				printf( '#ct-header-wrap .ct-header-branding a img { max-height: %s !important; }', esc_attr( $logo_maxh['height'] ) );
			} 
			$logo_maxh_sticky = consultio_get_opt( 'logo_maxh_sticky' );
			if ( !empty( $logo_maxh_sticky['height'] ) && $logo_maxh_sticky['height'] != 'px' ) {
				printf( '#ct-header-wrap .ct-header-main.h-fixed .ct-header-branding a img { max-height: %s !important; }', esc_attr( $logo_maxh_sticky['height'] ) );
			} 
			?>
		}
        @media screen and (max-width: 1199px) {
		<?php
			$logo_maxh_sm = consultio_get_opt( 'logo_maxh_sm' );
			if ( !empty( $logo_maxh_sm['height'] ) && $logo_maxh_sm['height'] != 'px' ) {
				printf( '#ct-header-wrap .ct-header-branding a img, #ct-header-wrap .ct-logo-mobile img { max-height: %s !important; }', esc_attr( $logo_maxh_sm['height'] ) );
			} 
			$pagetitle = consultio_get_opt( 'pagetitle', false );
			$page_title_padding_sm = consultio_get_opt( 'page_title_padding_sm' );
			if( $pagetitle && !empty($page_title_padding_sm['padding-top']) ) {
				printf( 'body #pagetitle { padding-top: %s !important; }', esc_attr( $page_title_padding_sm['padding-top'] ) );
			}
			if( $pagetitle && !empty($page_title_padding_sm['padding-bottom']) ) {
				printf( 'body #pagetitle { padding-bottom: %s !important; }', esc_attr( $page_title_padding_sm['padding-bottom'] ) );
			}

			$hamburger_btn_color = consultio_get_opt( 'hamburger_btn_color' );
			if ( !empty( $hamburger_btn_color ) ) {
				echo 'body #ct-menu-mobile .btn-nav-mobile::before, body #ct-menu-mobile .btn-nav-mobile::after, body #ct-menu-mobile .btn-nav-mobile span {
	                background-color: '. esc_attr( $hamburger_btn_color ) .';
	            }';
			}
			?>
        }
        <?php /* End Logo */

		/* Menu */ ?>
		@media screen and (min-width: 1200px) {
		<?php  $main_menu_color = consultio_get_opt( 'main_menu_color' );
			if ( !empty( $main_menu_color['regular'] ) ) {
				printf( '.header-right-item.h-btn-sidebar::before, .header-right-item.h-btn-sidebar::after, .header-right-item.h-btn-sidebar span { background-color: %s !important; }', esc_attr( $main_menu_color['regular'] ) );
			}
			if ( !empty( $main_menu_color['regular'] ) ) {
				printf( '.ct-main-menu > li > a, #ct-header-wrap .ct-header-meta .header-right-item { color: %s !important; }', esc_attr( $main_menu_color['regular'] ) );
			}
			if ( !empty( $main_menu_color['active'] ) ) {
				printf( '.ct-main-menu > li.current_page_item:not(.menu-item-type-custom) > a, .ct-main-menu > li.current-menu-item:not(.menu-item-type-custom) > a, .ct-main-menu > li.current_page_ancestor:not(.menu-item-type-custom) > a, .ct-main-menu > li.current-menu-ancestor:not(.menu-item-type-custom) > a { color: %s !important; }', esc_attr( $main_menu_color['active'] ) );
			}
			if ( !empty( $main_menu_color['hover'] ) ) {
				printf( '.ct-main-menu > li > a:hover, #ct-header-wrap .ct-header-meta .header-right-item:hover { color: %s !important; }', esc_attr( $main_menu_color['hover'] ) );
			}

			$sticky_menu_color = consultio_get_opt( 'sticky_menu_color' );
			if ( !empty( $sticky_menu_color['regular'] ) ) {
				printf( '#ct-header.h-fixed .header-right-item.h-btn-sidebar::before, #ct-header.h-fixed .header-right-item.h-btn-sidebar::after, #ct-header.h-fixed .header-right-item.h-btn-sidebar span { background-color: %s !important; }', esc_attr( $sticky_menu_color['regular'] ) );
			}
			if ( !empty( $sticky_menu_color['regular'] ) ) {
				printf( '#ct-header.h-fixed .ct-main-menu > li > a, #ct-header-wrap #ct-header.h-fixed .ct-header-meta .header-right-item { color: %s !important; }', esc_attr( $sticky_menu_color['regular'] ) );
			}
			if ( !empty( $sticky_menu_color['hover'] ) ) {
				printf( '#ct-header.h-fixed .ct-main-menu > li > a:hover, #ct-header-wrap #ct-header.h-fixed .ct-header-meta .header-right-item:hover { color: %s !important; }', esc_attr( $sticky_menu_color['hover'] ) );
			}
			if ( !empty( $sticky_menu_color['active'] ) ) {
				printf( '#ct-header.h-fixed .ct-main-menu > li.current_page_item:not(.menu-item-type-custom) > a, #ct-header.h-fixed .ct-main-menu > li.current-menu-item:not(.menu-item-type-custom) > a, #ct-header.h-fixed .ct-main-menu > li.current_page_ancestor:not(.menu-item-type-custom) > a, #ct-header.h-fixed .ct-main-menu > li.current-menu-ancestor:not(.menu-item-type-custom) > a { color: %s !important; }', esc_attr( $sticky_menu_color['active'] ) );
			} 

			$sub_menu_bgcolor = consultio_get_opt( 'sub_menu_bgcolor' );
			if ( !empty( $sub_menu_bgcolor ) ) {
				printf( '.ct-main-menu .sub-menu, .ct-main-menu .children { background-color: %s !important; }', esc_attr( $sub_menu_bgcolor ) );
			}

			$sub_menu_color = consultio_get_opt( 'sub_menu_color' );
			if ( !empty( $sub_menu_color['regular'] ) ) {
				printf( '.ct-main-menu .sub-menu li a, .ct-main-menu .children li a { color: %s !important; }', esc_attr( $sub_menu_color['regular'] ) );
			}
			if ( !empty( $sub_menu_color['hover'] ) ) {
				printf( '.ct-main-menu .sub-menu li a:hover, .ct-main-menu .children li a:hover { color: %s !important; }', esc_attr( $sub_menu_color['hover'] ) );
			}
			if ( !empty( $sub_menu_color['active'] ) ) {
				printf( '.ct-main-menu .children li > a:hover, .ct-main-menu .sub-menu li.current_page_item > a, .ct-main-menu .children li.current_page_item > a, .ct-main-menu .sub-menu li.current-menu-item > a, .ct-main-menu .children li.current-menu-item > a, .ct-main-menu .sub-menu li.current_page_ancestor > a, .ct-main-menu .children li.current_page_ancestor > a, .ct-main-menu .sub-menu li.current-menu-ancestor > a, .ct-main-menu .children li.current-menu-ancestor > a { color: %s !important; }', esc_attr( $sub_menu_color['active'] ) );
			}

			$menu_fs = consultio_get_opt( 'menu_fs' );
			$sub_menu_fs = consultio_get_opt( 'sub_menu_fs' );
			if ( !empty( $menu_fs ) ) {
				printf( '.ct-main-menu > li > a, .ct-header-popup-wrap .ct-main-menu-popup a, .ct-header-popup-wrap .ct-main-menu-popup .ct-menu-toggle { font-size: %spx !important; }', esc_attr( $menu_fs  ) );
			}
			if ( !empty( $sub_menu_fs ) ) {
				printf( '.ct-main-menu .sub-menu li a, .ct-main-menu .children li a, .ct-header-popup-wrap .ct-main-menu-popup .sub-menu a { font-size: %spx !important; }', esc_attr( $sub_menu_fs  ) );
			}
			?>
		}
		<?php /* End Menu */

		/* Page Title */
		$ptitle_bg = consultio_get_page_opt( 'ptitle_bg' );
		$custom_pagetitle = consultio_get_page_opt( 'custom_pagetitle', 'themeoption' );
		if ( $custom_pagetitle == 'show' && !empty( $ptitle_bg['background-image'] ) ) {
			echo 'body .site #pagetitle.page-title {
                background-image: url(' . esc_attr( $ptitle_bg['background-image'] ) . ');
            }';
		}

		$s_custom_pagetitle = consultio_get_opt( 's_custom_pagetitle', 'default' );
		$s_ptitle_bg = consultio_get_opt( 's_ptitle_bg' );
		if ( $s_custom_pagetitle == 'show' && !empty( $s_ptitle_bg['background-image'] ) ) {
			echo 'body.search .site #pagetitle.page-title {
                background-image: url(' . esc_attr( $s_ptitle_bg['background-image'] ) . ');
            }';
		}

		/* Custom Css */
		$custom_css = consultio_get_opt( 'site_css' );
		if ( !empty( $custom_css ) ) {
			echo esc_attr( $custom_css );
		}

		return ob_get_clean();
	}
}

new CSS_Generator();