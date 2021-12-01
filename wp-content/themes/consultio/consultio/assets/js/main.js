;(function ($) {

    "use strict";

    /* ===================
     Page reload
     ===================== */
    var scroll_top;
    var window_height;
    var window_width;
    var scroll_status = '';
    var lastScrollTop = 0;
    $(window).on('load', function () {
        $(".ct-loader").fadeOut("slow");
        window_width = $(window).width();
        consultio_col_offset();
        consultio_header_sticky();
        consultio_scroll_to_top();
        consultio_quantity_icon();
        consultio_wow_init();
        consultio_mouse_move();
        consultio_header_offset();
        consultio_footer_fixed();
        consultio_portfolio_ex();
        setTimeout(function(){
            $('body:not(.elementor-editor-active) .ct-slick-slider').css('height', 'auto');
            $('body:not(.elementor-editor-active) .ct-slick-slider').css('overflow', 'visible');
            $('body:not(.elementor-editor-active) .ct-slick-slider').css('opacity', '1');
        }, 100);
    });
    $(window).on('resize', function () {
        window_width = $(window).width();
        consultio_col_offset();
        consultio_header_offset();
        consultio_footer_fixed();
        consultio_portfolio_ex();
    });

    $(window).on('scroll', function () {
        scroll_top = $(window).scrollTop();
        window_height = $(window).height();
        window_width = $(window).width();
        if (scroll_top < lastScrollTop) {
            scroll_status = 'up';
        } else {
            scroll_status = 'down';
        }
        lastScrollTop = scroll_top;
        consultio_header_sticky();
        consultio_scroll_to_top();
    });

    $(document).on('click', '.h-btn-search, .ct-search-popup', function () {
        $('.ct-modal-search').addClass('open');
        $('body').addClass('ov-hidden');
        setTimeout(function(){
            $('.ct-modal-search .search-field').focus();
        },1000);
    });

    $(document).ready(function () {

        /* =================
         Menu Dropdown
         =================== */
        var $menu = $('.ct-main-navigation');
        $menu.find('.ct-main-menu li').each(function () {
            var $submenu = $(this).find('> ul.sub-menu, > .children');
            if ($submenu.length == 1) {
                $(this).hover(function () {
                    if ($submenu.offset().left + $submenu.width() > $(window).width()) {
                        $submenu.addClass('back');
                    } else if ($submenu.offset().left < 0) {
                        $submenu.addClass('back');
                    }
                }, function () {
                    $submenu.removeClass('back');
                });
            }
        });
        
        $('.show-demos').on("click", function (e) {
            e.preventDefault();
            $( this ).parents('body').find('.ct-demo-bar').toggleClass('active');
        });

        /* Menu Click */
        $(".ct-main-menu.sub-click > li > a").on('click', function () {
            $(this).parent().toggleClass('opened');
        });

        $('body').on('click', '.ct-main-menu.sub-click > li > a', function () {
            return false;
        });

        /* Main Header */
        $('.ct-header-fixed-transparent').parents('.ct-header-elementor-main').addClass('ct-header-fixed-transparent-wrap');

        /* =================
         Menu Mobile
         =================== */
        $('.ct-main-navigation li.menu-item-has-children').append('<span class="ct-menu-toggle far fac-angle-right"></span>');
        $('.ct-menu-toggle').on('click', function () {
            $(this).toggleClass('toggle-open');
            $(this).parent().find('> .sub-menu, > .children').toggleClass('submenu-open');
            $(this).parent().find('> .sub-menu, > .children').slideToggle();
        });

        $(".ct-main-menu li a.is-one-page").on('click', function () {
           $(this).parents('.ct-header-navigation').removeClass('navigation-open');
           $(this).parents('.ct-header-main').find('.btn-nav-mobile').removeClass('opened');
        });

        if ($(window).width() < 1199) {
            $('.ct-main-menu li.menu-item-has-children > a').on("click", function (e) {
                e.preventDefault();
                $(this).parent().find('> .sub-menu, > .children').toggleClass('submenu-open');
                $(this).parent().find('> .sub-menu, > .children').slideToggle();
                $(this).parent().find('> .ct-menu-toggle').toggleClass('toggle-open');
            });
        }

        /* =================
         Menu Popup
         =================== */
        $('.ct-main-menu-popup li.menu-item-has-children > a').after('<span class="ct-menu-toggle"></span>');
        $('.ct-main-menu-popup .ct-menu-toggle').on('click', function () {
            $(this).toggleClass('toggle-open');
            $(this).parent().find('> .sub-menu, > .children').toggleClass('submenu-open');
            $(this).parent().find('> .sub-menu, > .children').slideToggle();
        });
        $('.ct-menu-popup').on('click', function () {
            $('body').addClass('ov-hidden');
            $(this).parents('body').find('.ct-header-popup-wrap').toggleClass('open');
        });
        $('.ct-menu-close').on('click', function () {
            $('body').removeClass('ov-hidden');
            $(this).parents('body').find('.ct-header-popup-wrap').toggleClass('open');
        });
        
        $("#ct-menu-mobile .open-menu").on('click', function () {
            $(this).toggleClass('opened');
            $('.ct-header-navigation').toggleClass('navigation-open');
        });

        $(".ct-menu-close").on('click', function () {
            $(this).parents('.header-navigation').removeClass('navigation-open');
            $('.ct-menu-overlay').removeClass('active');
            $('#ct-menu-mobile .open-menu').removeClass('opened');
            $('body').removeClass('ov-hidden');
        });

        $(".ct-menu-overlay").on('click', function () {
            $(this).parents('#header-main').find('.header-navigation').removeClass('navigation-open');
            $(this).removeClass('active');
            $('#ct-menu-mobile .open-menu').removeClass('opened');
            $('.header-navigation').removeClass('navigation-open');
            $('body').removeClass('ov-hidden');
        });

        $('.ct-header-menu-popup').on('click', function () {
            $(this).parents('body').find('.ct-header-elementor-popup').toggleClass('open');
        });

        /* ===================
         Search Toggle
         ===================== */
        $('.h-btn-form').click(function (e) {
            e.preventDefault();
            $('.ct-modal-contact-form').removeClass('remove').toggleClass('open');
        });
        $('.ct-close').click(function (e) {
            e.preventDefault();
            $(this).parents('.ct-header-elementor-popup').removeClass('open');
            $(this).parents('.ct-widget-cart-wrap').removeClass('open');
            $(this).parents('.ct-modal').addClass('remove').removeClass('open');
            $(this).parents('#page').find('.site-overlay').removeClass('open');
            $(this).parents('body').removeClass('ov-hidden');
        });

        $('.ct-hidden-sidebar-overlay, .ct-widget-cart-overlay').click(function (e) {
            e.preventDefault();
            $(this).parent().toggleClass('open');
            $(this).parents('body').removeClass('ov-hidden');
        });

        /* Video 16:9 */
        $('.entry-video iframe').each(function () {
            var v_width = $(this).width();

            v_width = v_width / (16 / 9);
            $(this).attr('height', v_width + 35);
        });

        /* Video Light Box */
        $('.ct-video-button, .btn-video, .slider-video').magnificPopup({
            type: 'iframe',
            mainClass: 'mfp-fade',
            removalDelay: 160,
            preloader: false,
            fixedContentPos: false
        });

        $('.ct-service-grid1').magnificPopup({
            delegate: 'a.z-view', 
            type: 'inline',
            gallery: {
             enabled: false
            },
            mainClass: 'mfp-fade mfp-menu',
        });
        
        /* ====================
         Scroll To Top
         ====================== */
        $('.scroll-top, .scroll-top i, .ct-wg-backtotop-inner').click(function () {
            $('html, body').animate({scrollTop: 0}, 800);
            return false;
        });
        $('.ct-wg-backtotop-inner').parents('body').find('.scroll-top').hide();

        /* =================
        Add Class
        =================== */
        $('.wpcf7-select').parent().addClass('wpcf7-menu');
        

        /* =================
         The clicked item should be in center in owl carousel
         =================== */
        var $owl_item = $('.owl-active-click');
        $owl_item.children().each(function (index) {
            $(this).attr('data-position', index);
        });
        $(document).on('click', '.owl-active-click .owl-item > div', function () {
            $owl_item.trigger('to.owl.carousel', $(this).data('position'));
        });

        /* Select */
        $('select:not([id*="ui-id-"])').each(function () {
            $(this).niceSelect();
        });

        setTimeout(function(){
            $('.nice-select').on('click', function () {
                $(this).find('.list').toggleClass('open');
            });
        }, 300);

        /* Newsletter */
        $('.widget_newsletterwidget, form.newsletter, form.tnp-subscription').each(function () {
            var email_text = $(this).find('.tnp-field-email label').text();
            $(this).find('.tnp-field-email label').remove();
            $(this).find(".tnp-email").each(function (ev) {
                if (!$(this).val()) {
                    $(this).attr("placeholder", email_text);
                }
            });
            var firstname_text = $(this).find('.tnp-field-firstname label').text();
            $(this).find('.tnp-field-firstname label').remove();
            $(this).find(".tnp-firstname").each(function (ev) {
                if (!$(this).val()) {
                    $(this).attr("placeholder", firstname_text);
                }
            });
            var lastname_text = $(this).find('.tnp-field-lastname label').text();
            $(this).find('.tnp-field-lastname label').remove();
            $(this).find(".tnp-lastname").each(function (ev) {
                if (!$(this).val()) {
                    $(this).attr("placeholder", lastname_text);
                }
            });
        });

        /* bbPress */
        $('.bbp-search-form').each(function () {
            var search_text = 'Search...';
            $(this).find("#bbp_search").each(function (ev) {
                if (!$(this).val()) {
                    $(this).attr("placeholder", search_text);
                }
            });
        });

        /* Search */
        $('.ct-modal-close').on('click', function () {
            $(this).parent().removeClass('open');
            $(this).parents('body').removeClass('ov-hidden');
        });
        $(document).on('click', function (e) {
            if (e.target.className == 'ct-modal ct-modal-search open')
                $('.ct-modal-search').removeClass('open');
            if (e.target.className == 'ct-hidden-sidebar open')
                $('.ct-hidden-sidebar').removeClass('open');
        });

        /* Hidden Sidebar */
        $(".h-btn-sidebar").on('click', function (e) {
            e.preventDefault();
            $('.ct-hidden-sidebar-wrap').toggleClass('open');
            $(this).parents('body').addClass('ov-hidden');
        });

        $(".ct-hidden-close").on('click', function (e) {
            e.preventDefault();
            $(this).parents('.ct-hidden-sidebar-wrap').removeClass('open');
            $(this).parents('body').removeClass('ov-hidden');
        });

        /* Cart Sidebar */
        $(".h-btn-cart, .btn-nav-cart, .ct-cart-bar").on('click', function (e) {
            e.preventDefault();
            $('.ct-widget-cart-wrap').toggleClass('open');
            $('.ct-header-navigation').removeClass('navigation-open');
            $('#ct-menu-mobile .open-menu').removeClass('opened');
            $(this).parents('body').addClass('ov-hidden');
        });

        /* Year Copyright */
        var _year_footer = $(".ct-footer-year"),
            _year_clone = _year_footer.parents(".site").find('.ct-year');
        _year_clone.after(_year_footer.clone());
        _year_footer.remove();
        _year_clone.remove();

        /* Comment Reply */
        $('.comment-reply a').append( '<i class="fa fa-angle-right"></i>' );

        /* Widget Menu */
        $('.ct-navigation-menu1.default a').append( '<i class="fac fac-angle-right"></i>' );

        /* Nav Slider */
        setTimeout(function () {
            $('.revslider-initialised').each(function () {
                $(this).find('.ct-slider-nav .slider-nav-right').on('click', function () {
                    $(this).parents('.revslider-initialised').find('.tp-rightarrow').trigger('click');
                });
                $(this).find('.ct-slider-nav .slider-nav-left').on('click', function () {
                    $(this).parents('.revslider-initialised').find('.tp-leftarrow').trigger('click');
                });
            });
            $('.ct-slider-nav').parents('.revslider-initialised').find('.tparrows').addClass('arrow-hidden');
        }, 300);

        /* Icon Form */
        setTimeout(function () {
            $('.input-filled').each(function () {
                var icon_input = $(this).find(".input-icon"),
                    control_wrap = $(this).find('.wpcf7-form-control');
                control_wrap.before(icon_input.clone());
                icon_input.remove();

            });
        }, 200);

        /* Image Pointer */
        $('.ct-pointer-item').each(function () {
            $(this).find('.ct-pointer-btn').on('click', function () {
                $(this).toggleClass('open');
                $(this).parents('.elementor-widget-wrap').find('.ct-pointer-item .ct-pointer-btn').removeClass('open');
                $(this).addClass('open');
            });
        });

        /* Blog */
        $( ".ct-blog-grid-layout1 .grid-item-inner, .ct-blog-carousel-layout1 .grid-item-inner" ).hover(
          function() {
            $( this ).find('.entry-readmore').slideToggle(300);
            $( this ).find('.entry-meta').slideToggle(300);
          }, function() {
            $( this ).find('.entry-readmore').slideToggle(300);
            $( this ).find('.entry-meta').slideToggle(300);
          }
        );

        /* FancyBox */
        $( ".ct-fancy-box-layout18" ).hover(
          function() {
            $( this ).find('.item--button').slideToggle(300);
            $( this ).find('.item--description').slideToggle(300);
          }, function() {
            $( this ).find('.item--button').slideToggle(300);
            $( this ).find('.item--description').slideToggle(300);
          }
        );

        /* Team */
        $( ".ct-team-carousel1 .item--inner, .ct-team-carousel2 .item--inner, .ct-team-grid4 .item--inner" ).hover(
          function() {
            $( this ).find('.item--social').slideToggle(300);
          }, function() {
            $( this ).find('.item--social').slideToggle(300);
          }
        );

        $( ".ct-team-carousel6 .item--inner, .ct-team-grid6 .item--inner" ).hover(
          function() {
            $( this ).find('.item--meta').slideToggle(200);
          }, function() {
            $( this ).find('.item--meta').slideToggle(200);
          }
        );

        $(".social-button").on('click', function () {
            $(this).parent().toggleClass('active');
        });

        /* Service */
        $( ".ct-service-grid6 .grid-item-inner" ).hover(
          function() {
            $( this ).find('.item-readmore').slideToggle(300);
          }, function() {
            $( this ).find('.item-readmore').slideToggle(300);
          }
        );

        $( ".ct-service-grid7 .grid-item-inner" ).hover(
          function() {
            $( this ).find('.item--desc').slideToggle(300);
          }, function() {
            $( this ).find('.item--desc').slideToggle(300);
          }
        );

        $( ".ct-service-grid10 .grid-item-inner" ).hover(
          function() {
            $( this ).find('.item--readmore').slideToggle(300);
          }, function() {
            $( this ).find('.item--readmore').slideToggle(300);
          }
        );

        /* Fancy Box Grid */
        $('.ct-fancy-box-grid1').each(function () {
            $(this).find('.item--inner').hover(function () {
                $(this).parents('.elementor-element').find('.item--inner').removeClass('active');
                $(this).addClass('active');
            });
        });

        $('.ct-fancy-box-layout9').each(function () {
            $(this).hover(function () {
                $(this).parents('.elementor-row').find('.ct-fancy-box-layout9').removeClass('active');
                $(this).parents('.elementor-container').find('.ct-fancy-box-layout9').removeClass('active');
                $(this).addClass('active');
            });
        });

        /* Same Height */
        $('.ct-fancy-box-grid1 .item--inner').matchHeight();
        $('.ct-feature-layout1').matchHeight();
        $('.ct-fancy-box-layout4').matchHeight();
        $('.ct-fancy-box-layout5 .ct-fancy-box-inner').matchHeight();
        $('.ct-fancy-box-layout1.style4').matchHeight();
        $('.ct-testimonial-carousel3 .item--description').matchHeight();

        $('.same-height').matchHeight();
        $('.ct-fancy-box-layout14').matchHeight();
        $('.ct-service-grid3 .grid-item-holder').matchHeight();
        $('.ct-service-grid5 .grid-item-inner').matchHeight();

        /* Demo Bar */
        $(".choose-demo, .ct-demo-bar-close").on('click', function () {
            $(this).parents('.ct-demo-bar').toggleClass('active');
        });

        /* Animate Time */
        $('.animate-time').each(function () {
            var eltime = 100;
            var elt_inner = $(this).children().length;
            var _elt = elt_inner - 1;
            $(this).find('> .grid-item > .wow').each(function (index, obj) {
                $(this).css('animation-delay', eltime + 'ms');
                if (_elt === index) {
                    eltime = 100;
                    _elt = _elt + elt_inner;
                } else {
                    eltime = eltime + 80;
                }
            });
        });

        /* Overlay particle */
        setTimeout(function(){
            $('.elementor-section-wrap > .elementor-element').each(function () {                
                var _el_bg_animate = $(this).find(".ct-background-animate"),
                    _row_bg_animate = _el_bg_animate.parents(".elementor-container");
                _row_bg_animate.before(_el_bg_animate.clone());
                _el_bg_animate.remove();

                var _el_text = $(this).find(".ct-text"),
                    _row_text = _el_text.parents(".elementor-container");
                _row_text.before(_el_text.clone());
                _el_text.remove();
            });
        }, 200);

        $('.h9-section-01 > .elementor-container').after('<div class="h9-section-gradient"></div>');
        $('.h9-section-02 > .elementor-container').after('<div class="h9-section-overlay"></div>');

        /* Team */
        $('.item--social-btn').on('click', function () {
            $(this).toggleClass('active');
            $(this).parent().toggleClass('active');
        });

        /* Range Slider */
        $('.wpcf7-form').each(function () {
            var range = $(this).find('.ct-range-slider');
            var range_value = $(this).find('.ct-range-slider').attr('data-value');
            var range_maxvalue = $(this).find('.ct-range-slider').attr('data-maxvalue');
            var range_currency = $(this).find('.ct-range-slider').attr('data-currency');
            $(this).find( ".ct-range-slider" ).slider({
                range: "min",
                value: range_value,
                min: 1,
                max: range_maxvalue,
                slide: function( event, ui ) {
                    $(this).parent().find( ".ct-range-result" ).val( range_currency + ui.value );
                }
            });
            $(this).find( ".ct-range-result" ).val( range_currency + $(this).find( ".ct-range-slider" ).slider( "value" ) );
        });

        /* Slider Revolution */
        $('.ct-slider-arrow').parents('.elementor-widget-slider_revolution').addClass('hide-arrow');

        /* Cover Boxes */
        $('body:not(.elementor-editor-active) .ct-cover-boxes1 .ct-cover-item').each(function () {
            $(this).hover(function () {
                $(this).parents('.ct-cover-boxes1').find('.ct-cover-item').removeClass('active');
                $(this).addClass('active');
            });
        });

        /* Counter Column */
        $('.counter-col-line1').append('<span class="counter-line"></span>');

        /* Pricing */
        $(".ct-pricing-tab-active .ct-pricing-tab-item").on('click', function () {
            $(this).parent().find('.ct-pricing-tab-item').removeClass('active');
            $(this).addClass('active');
        });
        $(".ct-pricing-tab-active .title-tab-monthly").on('click', function () {
            $(this).parents('.ct-pricing-multi').find('.ct-pricing-monthly').removeClass('ct-pricing-hide');
            $(this).parents('.ct-pricing-multi').find('.ct-pricing-year').addClass('ct-pricing-hide');
        });
        $(".ct-pricing-tab-active .title-tab-year").on('click', function () {
            $(this).parents('.ct-pricing-multi').find('.ct-pricing-year').removeClass('ct-pricing-hide');
            $(this).parents('.ct-pricing-multi').find('.ct-pricing-monthly').addClass('ct-pricing-hide');
        });

        $('.case-animate-time > span').each(function () {
            var eltime = 0;
            var elt_inner = $(this).children().length;
            var _elt = elt_inner - 1;
            $(this).find('> .slide-in-container > .wow').each(function (index, obj) {
                $(this).css('transition-delay', eltime + 'ms');
                if (_elt === index) {
                    eltime = 0;
                    _elt = _elt + elt_inner;
                } else {
                    eltime = eltime + 100;
                }
            });
        });

        /* Header Elementor */
        $('.ct-header-elementor-sticky').parents('body').addClass('header-sticky');

    });

    function consultio_header_offset() {
        if($('#ct-header-wrap').html() != "") {
            var space_branding = $('.ct-header-branding').offset().left;
            var width_branding = $('.ct-header-branding').outerWidth();
            var offset_branding = space_branding + width_branding;
            $('.ct-header-layout10 .ct-header-branding-bg').css('width', offset_branding + 'px');
            $('.site-h10 .ct-header-offset').css('width', offset_branding + 'px');
            $('.h9-section-overlay').css('left', offset_branding + 'px');
            $('.h9-section-03 > .elementor-container.elementor-column-gap-no > .elementor-row > .elementor-element:nth-child(1)').css('max-width', offset_branding + 'px');
            $('.h9-section-03 > .elementor-container.elementor-column-gap-no > .elementor-row > .elementor-element:nth-child(1)').css('min-width', offset_branding + 'px');

            $('.h9-section-03 > .elementor-container.elementor-column-gap-no > .elementor-element:nth-child(1)').css('max-width', offset_branding + 'px');
            $('.h9-section-03 > .elementor-container.elementor-column-gap-no > .elementor-element:nth-child(1)').css('min-width', offset_branding + 'px');

            $('.h9-section-gradient').css('width', offset_branding + 'px');
        }
    }

    function consultio_header_sticky() {
        var offsetTop = $('#ct-header-wrap').outerHeight();
        var h_header = $('.fixed-height').outerHeight();
        var offsetTopAnimation = offsetTop + 200;
        if($('#ct-header-wrap').hasClass('is-sticky')) {
            if (scroll_top > offsetTopAnimation) {
                $('#ct-header').addClass('h-fixed');
                
            } else {
                $('#ct-header').removeClass('h-fixed');
                
            }
        }

        var h_header_slider = $('.ct-header-slider').outerHeight();
        if($('#ct-header-wrap').hasClass('is-sticky-offset')) {
            if (scroll_top > h_header_slider) {
                $('#ct-header').addClass('h-fixed');
                $('#ct-header-wrap').addClass('is-sticky-active');
            } else {
                $('#ct-header').removeClass('h-fixed'); 
                $('#ct-header-wrap').removeClass('is-sticky-active');  
            }
            if (scroll_top > 200) {
                $('#ct-header-wrap').removeClass('sub-show-top');
            }
            if (scroll_top == 0) {
                $('#ct-header-wrap').addClass('sub-show-top');
            }
        }

        if (window_width > 1200) {
            $('.fixed-height').css({
                'height': h_header
            });
        }

        /* Header Elementor */
        var e_offsetTop = $('#ct-header-elementor').outerHeight();
        if($('#ct-header-elementor').hasClass('is-sticky')) {
            if (scroll_top > e_offsetTop) {
                $('.ct-header-elementor-sticky').addClass('h-fixed');
            } else {
                $('.ct-header-elementor-sticky').removeClass('h-fixed');   
            }
        }
    }

    /* =================
     Column Offset
     =================== */
    function consultio_col_offset() {
        setTimeout(function(){
            var w_vc_row_lg_medium = ($('#content').width() - 1200) / 2;
            var w_vc_row_lg_full_medium = ($('#content section.elementor-element section.elementor-element').width() - 1200) / 2;
            if (window_width > 1200) {
                $('body:not(.rtl) .col-offset-left').parents('.elementor-container').css('padding-left', w_vc_row_lg_medium + 'px');
                $('body:not(.rtl) .col-offset-right').parents('.elementor-container').css('padding-right', w_vc_row_lg_medium + 'px');

                $('.rtl .col-offset-left').parents('.elementor-container').css('padding-right', w_vc_row_lg_medium + 'px');
                $('.rtl .col-offset-right').parents('.elementor-container').css('padding-left', w_vc_row_lg_medium + 'px');

                $('body:not(.rtl) .ct-row-full-width .col-offset-left').parents('.elementor-container').css('padding-left', w_vc_row_lg_full_medium + 'px');
                $('body:not(.rtl) .ct-row-full-width .col-offset-right').parents('.elementor-container').css('padding-right', w_vc_row_lg_full_medium + 'px');

                $('.rtl .ct-row-full-width .col-offset-left').parents('.elementor-container').css('padding-right', w_vc_row_lg_full_medium + 'px');
                $('.rtl .ct-row-full-width .col-offset-right').parents('.elementor-container').css('padding-left', w_vc_row_lg_full_medium + 'px');

                /* Fixed somes section - demo markerting */
                $('body:not(.rtl) .h9-section-03 .col-offset-right > .elementor-column-wrap > .elementor-widget-wrap').css('padding-right', w_vc_row_lg_medium + 'px');

                /* Custom Settings */
                if (window_width > 1200) {
                    $('body:not(.rtl) .ct-column-offset-left > .elementor-column-wrap > .elementor-widget-wrap').css('padding-left', w_vc_row_lg_medium + 'px');
                    $('body:not(.rtl) .ct-column-offset-right > .elementor-column-wrap > .elementor-widget-wrap').css('padding-right', w_vc_row_lg_medium + 'px');

                    $('.rtl .ct-column-offset-left > .elementor-column-wrap > .elementor-widget-wrap').css('padding-right', w_vc_row_lg_medium + 'px');
                    $('.rtl .ct-column-offset-right > .elementor-column-wrap > .elementor-widget-wrap').css('padding-left', w_vc_row_lg_medium + 'px');
                }
            }
        }, 10 );
    }

    /* ====================
     Scroll To Top
     ====================== */
    function consultio_scroll_to_top() {
        if (scroll_top < window_height) {
            $('.scroll-top').addClass('off').removeClass('on');
        }
        if (scroll_top > window_height) {
            $('.scroll-top').addClass('on').removeClass('off');
        }
    }

    /* ====================
     WOW Animate
     ====================== */
    function consultio_wow_init() {
        var wow = new WOW(
            {
                boxClass:     'wow',      // animated element css class (default is wow)
                animateClass: 'animated', // animation css class (default is animated)
                offset:       0,          // distance to the element when triggering the animation (default is 0)
                mobile:       true,       // trigger animations on mobile devices (default is true)
                live:         true,       // act on asynchronously loaded content (default is true)
                callback:     function(box) {
                    // the callback is fired every time an animation is started
                    // the argument that is passed in is the DOM node being animated
                },
                scrollContainer: null,    // optional scroll container selector, otherwise use window,
                resetAnimation: true,     // reset animation on end (default is true)
            }
        );
        wow.init();
    }

    /* ====================
     Mouse Move
     ====================== */
    function consultio_mouse_move() {
        var follower, init, mouseX, mouseY, positionElement, timer;

        follower = document.getElementById('ct-mouse-move');

        mouseX = (event) => {
            return event.clientX;
        };

        mouseY = (event) => {
            return event.clientY;
        };

        positionElement = (event) => {
            var mouse;
            mouse = {
                x: mouseX(event),
                y: mouseY(event)
            };

            follower.style.top = mouse.y + 'px';
            return follower.style.left = mouse.x + 'px';
        };

        timer = false;

        window.onmousemove = init = (event) => {
            var _event;
            _event = event;
                return timer = setTimeout(() => {
                return positionElement(_event);
            }, 0);
        };
    }

    /* ====================
     WooComerce Quantity
     ====================== */
    function consultio_quantity_icon() {
        $('#content .quantity').append('<span class="quantity-icon"><i class="quantity-down fa fa-sort-desc"></i><i class="quantity-up fa fa-sort-asc"></i></span>');
        $('.quantity-up').on('click', function () {
            $(this).parents('.quantity').find('input[type="number"]').get(0).stepUp();
            $(this).parents('.woocommerce-cart-form').find('.actions .button').removeAttr('disabled');
        });
        $('.quantity-down').on('click', function () {
            $(this).parents('.quantity').find('input[type="number"]').get(0).stepDown();
            $(this).parents('.woocommerce-cart-form').find('.actions .button').removeAttr('disabled');
        });
        $('.woocommerce-cart-form .actions .button').removeAttr('disabled');
    }

    $( document ).ajaxComplete(function() {
       consultio_quantity_icon();
    });

    /* =================
     Footer Fixed
     =================== */
    function consultio_footer_fixed() {
        setTimeout(function(){
            var h_footer = $('.fixed-footer .site-footer-custom').outerHeight() - 1;
            $('.fixed-footer .site-content').css('margin-bottom', h_footer + 'px');
        }, 600);
    }

    /* =================
    Portfolio
     =================== */
    function consultio_portfolio_ex() {
        window_width = $(window).width();
        var w_container = (window_width - 1170) / 2;
        var w_image_box = (window_width - w_container) - 415;
        if (window_width > 1199) {
            $('.ct-portfolio-external1 .ct-carousel-inner').css('max-width', w_image_box + 'px');
        }
    }

})(jQuery);