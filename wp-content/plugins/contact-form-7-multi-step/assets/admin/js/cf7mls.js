(function($) {
  jQuery(document).ready(function($) {
    jQuery(".cf7mls-color-field").wpColorPicker();

    jQuery('#cf7mls-progress-bar .cf7mls_progress_bar_filter').wpColorPicker(
      { 
        change: function(event, ui){
          // Change background color progress bar
          let color = ui.color.toString();
          cf7mls_change_color_bar(color);
        }
      }
    );

    jQuery('#cf7mls-progress-bar .cf7mls_progress_bar_percent_filter').wpColorPicker(
      { 
        change: function(event, ui){
          // Change background color progress bar
          let color = ui.color.toString();
          // $('.cf7mls_progress_bar_percent_wrap .cf7mls_progress_barinner').css('background', color);
          $('.cf7mls_progress_bar_per_mobie_wrap .cf7mls_progress_barinner').css('background', color);
        }
      }
    );

    var title_steps = [];
    if(cf7mls.steps.length >= 2 && Array.isArray(cf7mls.steps)) {
      title_steps = cf7mls.steps;
    }

    //Vuejs
    cf7mls_app = new Vue({
      el: '#cf7mls-app',
      data: {
        steps: [],
        selectedStep: '',
        updatedTimes: 0
      },
      methods: {
        newStep() {
          this.steps.push({
            name: 'Step ' + (parseInt(this.steps.length) + 1).toString(),
            content: 'Step ' + (parseInt(this.steps.length) + 1).toString(),
            back: "Back",
            next: "Next",
            title: 'Step ' + (parseInt(this.steps.length) + 1).toString(),
          });

          this.selectedStep = this.steps[this.steps.length - 1];
        },
        removeStep(step) {
          if (confirm("Are you sure?")) {
            var index = this.steps.indexOf(step);
            this.steps.splice(index, 1);
            let name_steps = jQuery('#cf7mls-app .cf7mls-app-steps .cf7mls-name-step');

            let number_step = 1;
            for(let m = 0; m < name_steps.length; m++) {
              jQuery(name_steps[m]).text('Step ' + number_step);
              number_step++
            }
          }
        },
        initSteps: function(str) {
          if(str) {
            var contents = str.split(/\[cf7mls_step.*?\]/);
            contents = contents.filter(function(el, index) {
              return (contents.length != index && el != '');
            })
            var new_steps = contents.map(function(el, index){
              var back = typeof cf7mls.steps[index] != "undefined" ? cf7mls.steps[index]['back'] : "";
              var next = typeof cf7mls.steps[index] != "undefined" ? cf7mls.steps[index]['next'] : "";
              var title = typeof cf7mls.steps[index] != "undefined" ? cf7mls.steps[index]['title'] : "";
              return {
                name: 'Step ' + (index + 1).toString(),
                content: el,
                back: back,
                next: next,
                title: title,
              };
            });
            this.steps = new_steps;
            if(this.steps.length > 0) {
              this.selectedStep = this.steps[0];
            }
          }
        },
        stepsToStr: function(steps) {
          var newStr = '';
          let number_step = 1;
          title_steps = steps;

          steps.forEach(function(step, index){
            if(step.content != '') {
              newStr += step.content;

              if(steps.length == 1) {
                newStr += '';
              }else if(
                  (steps.length > 1) && 
                  (typeof steps[index] != 'undefined') &&
                  (steps[index]['content'] != '')) 
                {

                  newStr += '[cf7mls_step cf7mls_step-'+ number_step.toString()+' ';

                  if(index == 0) {
                    newStr += '"' + step.next + '" "' + step.title + '"]';
                  } else {
                      if((steps.length - 1) == index) {
                        newStr += '"' + step.back + '" "' + step.title + '"]';
                      }else {
                        newStr += '"' + step.back + '" "' + step.next + '" "' + step.title + '"]';
                      }
                  }
              }
            }
            number_step++;
          });
          $('textarea#wpcf7-form, textarea#wpcf7-form-bak').val(newStr);
        },
        editWithMoana: function(step){
          var $this = this
          if(typeof njtMoanaVc == 'function') {
            njtMoanaVc({
              init_val: $this.steps[step]['content'],
              on_done: function(res){
                $this.steps[step]['content'] = res
              }
            })
          }
          console.log(this.steps[step])
        }
      },
      created(){
        this.initSteps($('textarea#wpcf7-form').val());
        $('textarea#wpcf7-form').hide();
      },
      watch: {
        steps: {
          deep: true,
          handler(oldVal, newVal) {
            this.updatedTimes++;
            if(this.updatedTimes > 1) {
              this.stepsToStr(newVal);
            }
          }
        },
        selectedStep: {
          handler(oldVal, newVal) {
            $('.cf7mls-app-step-content .active textarea').focus();
          }
        }
      }
    });
    $('#tag-generator-list a.thickbox').click(function(){
      $( 'textarea#wpcf7-form' ).attr('id', 'wpcf7-form-bak');
    });
    var tb_unload_count = 1;
    $(window).bind('tb_unload', function () {
      if (tb_unload_count > 1) {
        tb_unload_count = 1;
      } else {
        $( 'textarea#wpcf7-form-bak' ).attr('id', 'wpcf7-form');
        tb_unload_count = tb_unload_count + 1;
      }
    });
    $( 'input.insert-tag' ).click( function() {
      var $form = $( this ).closest( 'form.tag-generator-panel' );
      var tag = $form.find( 'input.tag' ).val();
      //insert shortcode
      $( '.cf7mls-app-step-content .active textarea' ).each( function() {
        var $this = jQuery(this);
        this.focus();
        if ( document.selection ) { // IE
          var selection = document.selection.createRange();
          selection.text = tag;
          cf7mls_app.steps[$this.data('key')].content = tag;
        } else if ( this.selectionEnd || 0 === this.selectionEnd ) {
          var val = $( this ).val();
          var end = this.selectionEnd;
          cf7mls_app.steps[$this.data('key')].content = val.substring( 0, end ) + tag + val.substring( end, val.length );
          this.selectionStart = end + tag.length;
          this.selectionEnd = end + tag.length;
        } else {
          var old = $( this ).val();
          cf7mls_app.steps[$this.data('key')].content = old + tag;
        }
  
        this.focus();
      } );
      //end inserting
      tb_remove(); // close thickbox
      return false;
    });

    //cf7mls_load_step_name(jQuery('#wpcf7-form').val());
    // $("[data-config-field]").change(function() {
    //   var val = $(this).val();
    //   cf7mls_load_step_name(val);
    //đây là đoạn code tớ xử lý, khi cái textarea kia change, thì load mấy cái input nhập name, mà có lúc dc lúc ko, có gì cậu coi giùm tớ nhé :d
    // });

    jQuery("#contact-form-editor").on("tabsactivate", function(event, ui) {
      if ((ui.newTab.context.hash === "#cf7mls-progress-bar") && Array.isArray(title_steps)) {
        cf7mls_load_step_name(title_steps);
      }
    });

    // Transition effects
    if($('#cf7mls_multi_step_wrap input.cf7mls_toggle_transition_effects').is(":checked") === false){ 
      $('#cf7mls_multi_step_wrap .cf7mls-stype-transition-wrap').css('display', 'none');
    }

    $('#cf7mls_multi_step_wrap .cf7mls_switch').click(function(){
      if($('#cf7mls_multi_step_wrap input.cf7mls_toggle_transition_effects').is(":checked")){
        $('#cf7mls_multi_step_wrap input.cf7mls_toggle_transition_effects').attr('checked', true);
        $('#cf7mls_multi_step_wrap .cf7mls-stype-transition-wrap').css('display', '');
      }else {
        $('#cf7mls_multi_step_wrap input.cf7mls_toggle_transition_effects').attr('checked', false);
        $('#cf7mls_multi_step_wrap .cf7mls-stype-transition-wrap').css('display', 'none');
      }
    });

    if($('.cf7mls_progress_bars_witch input.cf7mls_enable_progress_bar').is(":checked")  === false){
      $('#cf7mls_progress_bar').addClass('hide');
      $('.cf7mls_number_step_wrap').addClass('hide');
      $('.cf7mls_form_demo_one').css('margin-top', '28px');
    }else {
      $('#cf7mls_progress_bar').removeClass('hide');
      $('.cf7mls_number_step_wrap').removeClass('hide');
      $('.cf7mls_form_demo_one').css('margin-top', '');
    }

    $('.cf7mls-pogress-bar .cf7mls_progress_bars_witch').click(function() {
      if($('.cf7mls_progress_bars_witch input.cf7mls_enable_progress_bar').is(":checked")){
        $('.cf7mls_progress_bars_witch input.cf7mls_enable_progress_bar').attr('checked', true);
        $('#cf7mls_progress_bar').removeClass('hide');
        $('.cf7mls_number_step_wrap').removeClass('hide');
        $('.cf7mls_form_demo_one').css('margin-top', '');
      }else {
        $('.cf7mls_progress_bars_witch input.cf7mls_enable_progress_bar').attr('checked', false);
        $('#cf7mls_progress_bar').addClass('hide');
        $('.cf7mls_number_step_wrap').addClass('hide');
        $('.cf7mls_form_demo_one').css('margin-top', '28px');
      }
    });

    $('.cf7mls-select-style-text .cf7mls-style-text-wrap').click(function() {
      let enable_progress_bar = '';
      if($('.cf7mls_progress_bars_witch input.cf7mls_enable_progress_bar').is(":checked") === false){
        enable_progress_bar = 'hide';
      }
      $('.cf7mls-select-style-text .cf7mls-style-text-wrap').removeClass('active');
      $('ul#cf7mls_progress_bar').attr('class', '');

      let style_text = $(this).attr('data-style-text');
      $('.cf7mls-select-style-text input.cf7mls-style-text').val(style_text);
      let style_bar = $('#cf7mls_progress_bar_style').val();
      $('#cf7mls_progress_bar').addClass('cf7mls_progress_bar');
      $('#cf7mls_progress_bar').addClass('cf7mls_bar_style_' + style_bar);
      $('#cf7mls_progress_bar').addClass('cf7mls_bar_style_text_' + style_text);
      $('#cf7mls_progress_bar').addClass(enable_progress_bar);
      
      if(style_text == 'no') {
        let width = $('#cf7mls_progress_bar').attr('data-width-progress-bar');
        if(width) {
          $('#cf7mls_progress_bar').css('width', width);
        }
      }else {
        $('#cf7mls_progress_bar').css('width', '');
      }
      $(this).addClass('active');

      let stype_step_bar = $('#cf7mls_progress_bar_style').val();
      cf7mls_change_width_item(stype_step_bar, style_text);

      let color_bar = $('.cf7mls_progress_bar_filter').val();
      if(color_bar) {
        cf7mls_change_color_bar(color_bar);
      }
    });

    $(document).on('change', 'select#cf7mls_progress_bar_style', function(e) {
      //e.preventDefault();
      let enable_progress_bar = '';
      if($('.cf7mls_progress_bars_witch input.cf7mls_enable_progress_bar').is(":checked") === false){
        enable_progress_bar = 'hide';
      }

      var val = $(this).children("option:selected").val();
      $('ul#cf7mls_progress_bar').attr('class', '');
      $('ul#cf7mls_progress_bar').addClass('cf7mls_progress_bar');
      $('ul#cf7mls_progress_bar').addClass('cf7mls_bar_style_' + val);
      $('ul#cf7mls_progress_bar').addClass(enable_progress_bar);
  
      let style_text = $('.cf7mls-select-style-text .active').attr('data-style-text');
      $('ul#cf7mls_progress_bar').addClass('cf7mls_bar_style_text_' + style_text);
      cf7mls_change_width_item(val, style_text);

      let color_bar = $('.cf7mls_progress_bar_filter').val();
      if(color_bar) {
        cf7mls_change_color_bar(color_bar);
      }
      
    });

    // Background Color Progress Bar
    var progress_bar_bg_color = $('.cf7mls_progress_bar_filter').val();
    $('head').append('<style id="cf7mls_style_progress_bar" type="text/css"></style>');
    if(progress_bar_bg_color) {
      cf7mls_change_color_bar(progress_bar_bg_color);
    }

    if(title_steps.length > 1) {
      var title = title_steps[1].title;
      $('#cf7mls-progress-bar').find('.cf7mls_number_step_wrap .cf7mls_step_current').text(title);
    }

    // Progress bar percent
    if($('.cf7mls_progress_bars_witch input.cf7mls_enable_progress_bar_percent').is(":checked") === false){
      // $('.cf7mls_progress_bar_percent_wrap').addClass('hide');
      $('.cf7mls_progress_bar_per_mobie_wrap').addClass('hide');
    }else {
      $('.cf7mls_progress_bar_per_mobie_wrap').removeClass('hide');
    }

    $('.cf7mls-pogress-bar-percent .cf7mls_progress_bars_witch').click(function() {
      if($('.cf7mls_progress_bars_witch input.cf7mls_enable_progress_bar_percent').is(":checked")){
        $('.cf7mls_progress_bars_witch input.cf7mls_enable_progress_bar_percent').attr('checked', true);
        // $('.cf7mls_progress_bar_percent_wrap').removeClass('hide');
        $('.cf7mls_progress_bar_per_mobie_wrap').removeClass('hide');
      }else {
        $('.cf7mls_progress_bars_witch input.cf7mls_enable_progress_bar_percent').attr('checked', false);
        // $('.cf7mls_progress_bar_percent_wrap').addClass('hide');
        $('.cf7mls_progress_bar_per_mobie_wrap').addClass('hide');
      }
    });

    // Background Color Progress Bar Percent
    var progress_bar_per_color = $('.cf7mls_progress_bar_percent_filter').val();
    if(progress_bar_per_color) {
      // $('.cf7mls_progress_bar_percent_wrap .cf7mls_progress_barinner').css('background', progress_bar_per_color);
      $('.cf7mls_progress_bar_per_mobie_wrap .cf7mls_progress_barinner').css('background', progress_bar_per_color);
    }

    // Allow Choose Step
    $('#cf7mls-allow-choose-step-wrap').change(function() {
      if(this.is(":checked") === false){
        this.attr('checked', true);
      }else {
        this.attr('checked', false);
      }
    });

    function cf7mls_load_step_name(val) {
      if (val.length <= 1) {
        $("#cf7mls_progress_bar").html("");
        $("#cf7mls-progress-bar .cf7mls_number_step_wrap").empty();
      } else {
        // progress bar on computer
        $('#cf7mls_progress_bar').empty();
        let number_step_current = 1;

        let style_text = $('.cf7mls-select-style-text .active').attr('data-style-text');
        let selected_style = $('#cf7mls_progress_bar_style').val();
        let pro_bar_step_item = 'auto';
        
        if(
          ((selected_style == 'horizontal_squaren') || 
          (selected_style == 'horizontal_round') || 
          (selected_style == 'box_vertical_squaren') ||
          (selected_style == 'box_larerSign_squaren')) &&
          ((style_text == 'horizontal') ||
          (style_text == 'no'))
        ) {
          if(title_steps.length >= 3) {
            pro_bar_step_item = (100/3) + '%';
          }else {
            pro_bar_step_item = (100/2) + '%';
          } 
        }

        if(style_text == 'vertical') {
          if(title_steps.length >= 3) {
            pro_bar_step_item = (100/3) + '%';
          }else {
            pro_bar_step_item = (100/2) + '%';
          }
        }

        val.forEach(function(item, index) {
          if(index < 3) {
            var title = item.title.trim();
            if(title.length > 7) {
              title = item.title.substr(0, 7) + '...';
            }

            let format_step = '';
            format_step += '<li class="cf7_mls_steps_item" style="width :' + pro_bar_step_item + '">';
            format_step += '<div class="cf7_mls_steps_item_container">';
            format_step += '<div class="cf7_mls_steps_item_icon">';
            format_step += '<span class="cf7_mls_count_step">' + number_step_current + '</span>';
            format_step += '<span class="cf7_mls_check">';
            format_step += '<i>';
            format_step += '<svg viewBox="64 64 896 896" data-icon="check" width="1em" height="1em" fill="currentColor" aria-hidden="true" focusable="false" class="">';
            format_step += '<path d="M912 190h-69.9c-9.8 0-19.1 4.5-25.1 12.2L404.7 724.5 207 474a32 32 0 0 0-25.1-12.2H112c-6.7 0-10.4 7.7-6.3 12.9l273.9 347c12.8 16.2 37.4 16.2 50.3 0l488.4-618.9c4.1-5.1.4-12.8-6.3-12.8z"></path>';
            format_step += '</svg>';
            format_step += '</i>';
            format_step += '</span>';
            format_step += '</div>';
            format_step += '<div class="cf7_mls_steps_item_content">';
            format_step += '<p class="cf7mls_progress_bar_title">' + title + '</p>';
            format_step += '<span class="cf7_mls_arrow_point_to_righ">';
            format_step += '<i>';
            format_step += '<svg x="0px" y="0px" width="8px" height="14px" viewBox="0 0 451.846 451.847" style="enable-background:new 0 0 451.846 451.847; xml:space="preserve">';
            format_step += '<g>';
            format_step += '<path d="M345.441,248.292L151.154,442.573c-12.359,12.365-32.397,12.365-44.75,0c-12.354-12.354-12.354-32.391,0-44.744 L278.318,225.92L106.409,54.017c-12.354-12.359-12.354-32.394,0-44.748c12.354-12.359,32.391-12.359,44.75,0l194.287,194.284 c6.177,6.18,9.262,14.271,9.262,22.366C354.708,234.018,351.617,242.115,345.441,248.292z"/>';
            format_step += '</g>';
            format_step += '</svg>';
            format_step += '</i>';
            format_step +=	'</span>';			
            format_step += '</div>';
            format_step += '</div>';
            format_step += '</li>';
            $('#cf7mls_progress_bar').append(format_step);
            number_step_current++;
          }
        });

        let width_step_item = 14;
        let width = width_step_item * Number(val.length);
        if(width && val.length <= 3) {
          $('#cf7mls_progress_bar').attr('data-width-progress-bar', width + '%');
        }else {
          // max 3 step in Preview 
          $('#cf7mls_progress_bar').attr('data-width-progress-bar', 14*3 + '%');
        }
        $('#cf7mls_progress_bar').css('width', '');
        if(width <= 100 && width > 0 && style_text == 'no') {
          $('#cf7mls_progress_bar').css('width', width + '%');
        }else if(style_text == 'no') {
          // max 3 step in Preview
          $('#cf7mls_progress_bar').css('width', 14*3 + '%');
        }

        // progress bar on ipad, mobile
        $('#cf7mls-progress-bar .cf7mls_number_step_wrap').empty();
        let title_step = title_steps[1].title;
        let count_step_curent = title_steps.length;
        let html = '';
        html += '<p class="cf7mls_number">';
        html += ((count_step_curent > 3)? "2/3" : "2/" + count_step_curent);
        html += '</p><p class="cf7mls_step_current">';
        html += title_step +'</p>';
        html += '<div class="cf7mls_progress_percent">';
        html += '<div class="cf7mls_progress_bar_percent"><div class="cf7mls_progress_barinner"></div></div>';
        $('#cf7mls-progress-bar .cf7mls_number_step_wrap').append(html);

        if(val.length == 2) {
          $('#cf7mls-progress-bar .cf7mls_progress_barinner').css('width', '100%');
          // $('.cf7mls_progress_bar_percent_wrap p').text('100%');
          $('.cf7mls_progress_bar_per_mobie_wrap p').text('100%');
        }else if(val.length > 2) {
          $('#cf7mls-progress-bar .cf7mls_progress_barinner').css('width', '50%');
          // $('.cf7mls_progress_bar_percent_wrap p').text('50%');
          $('.cf7mls_progress_bar_per_mobie_wrap p').text('50%');
        }

      }
    }

    function cf7mls_change_width_item (style_step_bar, style_text) {
      let pro_bar_step_item = '';

      if(
        ((style_text == 'horizontal') ||
        (style_text == 'no')) &&
        ((style_step_bar == 'horizontal_squaren') ||
        (style_step_bar == 'horizontal_round')||
        (style_step_bar == 'box_vertical_squaren')||
        (style_step_bar == 'box_larerSign_squaren')) 
      ) {
        pro_bar_step_item = 'auto';
        if(title_steps.length >= 3) {
          pro_bar_step_item = (100/3) + '%';
        }else {
          pro_bar_step_item = (100/2) + '%';
        }
      }

      if(style_text == 'vertical') {
        pro_bar_step_item = 'auto';
        if(title_steps.length >= 3) {
          pro_bar_step_item = (100/3) + '%';
        }else {
          pro_bar_step_item = (100/2) + '%';
        }
      }
      
      $('#cf7mls_progress_bar .cf7_mls_steps_item').css('width', pro_bar_step_item);
    }
    
    function cf7mls_change_color_bar(color) {
      let style_bar = 'cf7mls_bar_style_' + $('#cf7mls_progress_bar_style').val();
      let style_text = 'cf7mls_bar_style_text_' + $('.cf7mls-select-style-text .active').attr('data-style-text');

      let css_item_icon = '.' + style_bar + '.' + style_text + ' li .cf7_mls_steps_item_icon { background: '+ color + ';}';
      let css_item_icon_befor = '.' + style_bar + '.' + style_text + ' li:before { background: '+ color + ';}';

      let css_bg_li = '.' + style_bar + '.' + style_text + ' li{ background: '+ color + ';}';
      let css_step = '.' + style_bar + '.' + style_text + ' li .cf7_mls_count_step{ color: '+ color + ';}'
      let css_check = '.' + style_bar + '.' + style_text + ' li .cf7_mls_check{ color: '+ color + ';}';
      let css_li_after = '.' + style_bar + '.' + style_text + ' li:after{ background: '+ color + ';}';

      //
      let css_li = '.' + style_bar + '.' + style_text + ' li:nth-child';
      let css_title_after = '.cf7mls_progress_bar_title:after{ background: '+ color + ';}';
      let css_title_border = '.cf7mls_progress_bar_title:after{ border-color: '+ color + ';}'

      let css_progress_bar = '';
      // progress bar on ipad, mobile
      css_progress_bar += '.cf7mls_number_step_wrap .cf7mls_progress_barinner { background:' + color + ';}';

      // progress bar on computer
      if((style_bar == 'cf7mls_bar_style_navigation_horizontal_squaren') ||
      (style_bar == 'cf7mls_bar_style_largerSign_squaren') ||
      (style_bar == 'cf7mls_bar_style_navigation_horizontal_round') ||
      (style_bar == 'cf7mls_bar_style_largerSign_round')
      ) {
        switch (style_text) {
          case 'cf7mls_bar_style_text_horizontal': 
            css_progress_bar += css_item_icon;

            if((style_bar == 'cf7mls_bar_style_navigation_horizontal_squaren') || 
              (style_bar == 'cf7mls_bar_style_navigation_horizontal_round')
            ) {
              css_progress_bar += css_li + '(1) ' + css_title_after; 
            }

            if((style_bar == 'cf7mls_bar_style_largerSign_squaren') || 
              (style_bar == 'cf7mls_bar_style_largerSign_round')
            ) {
              css_progress_bar += css_li + '(1) .cf7_mls_arrow_point_to_righ svg {fill: '+ color + ';}';
            }

            break; 

          case 'cf7mls_bar_style_text_vertical': 
            css_progress_bar += css_item_icon_befor;

            if((style_bar == 'cf7mls_bar_style_navigation_horizontal_squaren') ||
              (style_bar == 'cf7mls_bar_style_navigation_horizontal_round')
            ) {
              css_progress_bar += css_li + '(2):after{ background: '+ color + ';}'; 
            }

            if((style_bar == 'cf7mls_bar_style_largerSign_squaren') ||
              (style_bar == 'cf7mls_bar_style_largerSign_round')
            ) {
              css_progress_bar += css_li + '(2):after{ border-color: '+ color + ';}';
            }
           
            break; 
          case 'cf7mls_bar_style_text_no': 
            css_progress_bar += css_item_icon;

            if((style_bar == 'cf7mls_bar_style_navigation_horizontal_squaren') ||
              (style_bar == 'cf7mls_bar_style_navigation_horizontal_round')
            ) {
              css_progress_bar += css_li + '(1) ' + css_title_after; 
            }

            if((style_bar == 'cf7mls_bar_style_largerSign_squaren') ||
              (style_bar == 'cf7mls_bar_style_largerSign_round')
            ) {
              css_progress_bar += css_li + '(1) ' + css_title_border; 
            }
            break; 
        }
      }
      
      if((style_bar == 'cf7mls_bar_style_horizontal_squaren') ||
          (style_bar == 'cf7mls_bar_style_horizontal_round')  
      ) {
        if(style_text == 'cf7mls_bar_style_text_horizontal') {
          css_progress_bar += css_item_icon;
          css_progress_bar += css_li + '(2):before {background-color:' + color + '!important}';
        }

        if((style_text == 'cf7mls_bar_style_text_vertical') || 
          (style_text == 'cf7mls_bar_style_text_no')) {
          css_progress_bar += css_item_icon_befor;
          css_progress_bar += css_li + '(2):after {background-color:' + color + '!important}';
        }
      }
      
      if(((style_bar == 'cf7mls_bar_style_box_vertical_squaren') || 
        (style_bar == 'cf7mls_bar_style_box_larerSign_squaren')) &&
        ((style_text == 'cf7mls_bar_style_text_horizontal') ||
        (style_text == 'cf7mls_bar_style_text_vertical') ||
        (style_text == 'cf7mls_bar_style_text_no'))
      ) {
        css_progress_bar += css_bg_li;
        css_progress_bar += css_step;
        css_progress_bar += css_check;
        css_progress_bar += css_li_after;  
      }
    
      jQuery('style#cf7mls_style_progress_bar').text(css_progress_bar);
    }

  });

  /*$(document).on('change', '.cf7mls-tag-value', function(event) {
        //event.preventDefault();
        var back_btn_title = $('input[name="cf7mls-back-btn-button"]').val();
        var next_btn_title = $('input[name="cf7mls-next-btn-button"]').val();
        
        var cf7mls_value = back_btn_title + "\n" + next_btn_title;
        //console.log(cf7mls_value);
        $('textarea.cf7mls-values').val(cf7mls_value);
    });*/
})(jQuery);

