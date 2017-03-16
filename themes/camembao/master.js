  $(document).ready(function () {
      $("select").chosen({
          disable_search_threshold: 10,
          width: "100%"
      });

      $('.corporato.dropdown').dropdown();
      $('body [data-content]').popover({trigger: 'hover', placement: 'auto'});

      $("table.sortable").tablesort();

      $('.filefield').filestyle({
          buttonText: 'Choose file...'
      });

      /* == Lightbox == */
      $('.lightbox').swipebox();
	  
	  /* == AudioPlayer == */
	  $('audio').audioPlayer();

     /* == Carousel == */
     $(".corporato-carousel").owlCarousel();

     /* == Smooth Scroll == */
    $(".scroller").click(function(e) {
        e.preventDefault(); 
        var defaultAnchorOffset = 0;
        var a = $(this).attr('data-scroller');
        var anchorOffset = $('#'+a).attr('data-scroller-offset');
        if (!anchorOffset)
            anchorOffset = defaultAnchorOffset; 
        $('html,body').animate({ 
            scrollTop: $('#'+a).offset().top - anchorOffset
        }, 500);        
    });
	
     /* == Date/Time Picker == */
	$('body [data-datepicker]').pickadate({});
	$('body [data-timepicker]').pickatime({
		formatSubmit: 'HH:i:00'
	});
			
      /* == Close Message == */
      $('body').on('click', '.message i.close.icon', function () {
          var $msgbox = $(this).closest('.message')
          $msgbox.slideUp(500, function () {
              $(this).remove()
          });
      });

    $('body').on('click', '.toggle', function () {
        $('.toggle.active').not(this).removeClass('active');
        $(this).toggleClass("active");
    });

      /* == Language Switcher == */
      $('#langmenu').on('click', 'a', function () {
          var target = $(this).attr('href');
          $.cookie("LANG_DDP", $(this).data('lang'), {
              expires: 120,
              path: '/'
          });
          $('body').fadeOut(1000, function () {
              window.location.href = SITEURL + "/";
          });
          return false
      });
			
      /* == Navigation Menu == */
      $('#menu').smartmenus({
          subIndicatorsText: "<i class=\"down angle icon\"></i>",
          subMenusMaxWidth: "auto",
          subMenusMinWidth: "14em",
		  hideDuration:500
      });

      $('#menu li a[href="#"]').click(function (e) {
          e.preventDefault();
      });

      $('.menu-trigger a').click(function (e) {
          $('nav').slideToggle();
      });


     /* == Scroll To Top == */
	  $.scrollUp();
	  
      /* == Tabs == */
	  $(".wtabs .corporato.tab.content").hide();
	  $(".corporato.tabs").find('a:first').addClass("active").show();
	  $('.wtabs').each(function(){
		  $(this).find('.corporato.tab.content:first').show();
	  });
      $(".corporato.tabs a").on('click', function () {
		  id = $(this).closest(".wtabs").attr("id");
          $("#" + id + " .corporato.tabs a").removeClass("active");
          $(this).addClass("active");
		  $("#" + id + " .corporato.tab.content").hide();
          var activeTab = $(this).data("tab");
          $(activeTab).show();
      });

      /* == Accordion == */
	  $('.accordion .header').toggleClass('inactive');
	  $('.accordion .header').first().toggleClass('active').toggleClass('inactive');
	  $('.accordion .content').first().slideDown().toggleClass('open');
		  $('.accordion .header').click(function () {
		  if($(this).is('.inactive')) {
			  $('.accordion .active').toggleClass('active').toggleClass('inactive').next().slideToggle().toggleClass('open');
			  $(this).toggleClass('active').toggleClass('inactive');
			  $(this).next().slideToggle().toggleClass('open');
		  }
		  
		  else {
			  $(this).toggleClass('active').toggleClass('inactive');
			  $(this).next().slideToggle().toggleClass('open');
		  }
	  });
	
    /* == Live Search == */
    $("#searchfield").on('keyup', function () {
        var srch_string = $(this).val();
        var data_string = 'liveSearch=' + srch_string;
        if (srch_string.length > 4) {
            $.ajax({
                type: "post",
                url: SITEURL + "/ajax/search.php",
                data: data_string,
                beforeSend: function () {

                },
                success: function (res) {
                    $('#suggestions').html(res).show();
                    $("input").blur(function () {
                        $('#suggestions').fadeOut();
                    });
                }
            });
        }
        return false;
    });
	$("#livesearch").on('click', 'i.search', function () {
		keywords = $("#searchfield").val();
		window.location.href = SITEURL + "/search.php?keywords=" + keywords;
		
    });

	$("#searchfield").on('keydown',  function (e) {
		keywords = $("#searchfield").val();
		if(e.keyCode == 13){
			window.location.href = SITEURL + "/search.php?keywords=" + keywords;
		}
    });
	
	/* == Remove Item == */
	$('body').on('click', 'a.delcart', function() {
		id = $(this).attr("data-id");
		var parent = $(this).closest(".item")
		$.ajax({
			type: 'post',
			dataType: 'json',
			url: SITEURL + "/ajax/cart.php",
			data: {
				'delcart': 1,
				'id': id
			},
			beforeSend: function() {
				parent.slideUp(600);
			},
			success: function(json) {
				setTimeout(function() {
					$("span#cart-status").html(json.message).fadeIn("slow");
					$("span#csub").html(json.total).fadeIn("slow");
					$("#cartList").html(json.cart).fadeIn("slow");
				}, 1500);
			}
		});
	});
	/* == Cart Functions == */
	$('body').on('click', 'a[data-cart-item]', function() {
		id = $(this).attr("data-id");
		var $item = $(this).closest("section");
		var $check = $(this).closest(".footer").find('span');
		$.ajax({
			type: "post",
			dataType: 'json',
			url: SITEURL + "/ajax/cart.php",
			data: {
				'addtocart': 1,
				'id': id
			},
			beforeSend: function() {
				$item.addClass('loader');
			},
			success: function(json) {
				if (json.type == "success") {
					$($check).html('<i class="icon circular inverted info check"></i>');
					setTimeout(function() {
						$("span#cart-status").html(json.message).fadeIn("slow");
						$("span#csub").html(json.total).fadeIn("slow");
						$("#cartList").html(json.cart).fadeIn("slow");
					}, 1500);
				}
				setTimeout(function() {
					$item.removeClass('loader');
				}, 800);

			}

		});
	});

	$('body').on('click', 'a.del-cart-full', function() {
	    id = $(this).data("id");
	    var parent = $(this).parent().parent();
	    $.ajax({
	        type: "post",
	        dataType: 'json',
	        url: SITEURL + "/ajax/cart.php",
	        data: {
	            'delfulcart': 1,
	            'id': id
	        },
	        beforeSend: function() {
	            parent.animate({
	                'backgroundColor': '#FFBFBF'
	            }, 400);
	        },
	        success: function(json) {
	            parent.fadeOut(400, function() {
	                parent.remove();
	            });
	            setTimeout(function() {
	                $("span#cart-status").html(json.message).fadeIn("slow");
	                $("span#cptotal").html("0.00").fadeIn("slow");
	                $("span#gtotal").html(json.total).fadeIn("slow");
	                $("span#stotal").html(json.subt).fadeIn("slow");
					$("span#taxtotal").html(json.tax).fadeIn("slow");
	            }, 1500);
	        }

	    });
	});
	
	/* Load Gateways */
	$("a.load-gateway").on("click", function () {
		var id = $(this).data('id')
		$.ajax({
			type: "post",
			url: SITEURL + "/ajax/controller.php",
			data: {
				'loadgateway': 1,
				 'id': id
				 },
			success: function (msg) {
				$("#show-result").html(msg);

			}
		});
		return false;
	});
	
	/* Verify Coupon Code */
	$("#verify-code").on("click", function() {
		if($('#discount').val() != ''){
			$.ajax({
				type: "post",
				url: SITEURL + "/ajax/coupon.php",
				dataType: 'json',
				data: 'coupon=' + $('#discount').val(),
				success: function(json) {
					$("#totaldiscount").html(json.coupon);
					if (json.type == "success") {
						setTimeout(function() {
							//$("span#gtotal").html(json.gtotal).fadeIn("slow");
							//$("span#cptotal").html(json.cdata).fadeIn("slow");
							
							$("span#cptotal").html(json.ctotal).fadeIn("slow");
							$("span#gtotal").html(json.gtotal).fadeIn("slow");
							$("span#stotal").html(json.subt).fadeIn("slow");
							$("span#taxtotal").html(json.tax).fadeIn("slow");
							
						}, 800);
					}
				}
			});
		}
	});
	
     /* == Animate Progress Bars == */
     function progress(percent, element) {
         var progressBarWidth = percent * element.width() / 100;
         $(element).find('div').animate({
             width: progressBarWidth
         }, 500);
     }
     animateProgress();

     function animateProgress() {
         $('.progress').each(function () {
             var bar = $(this);
             var size = $(this).data('percent');
             progress(size, bar);
         });
     }
     $(window).resize(function () {
         animateProgress();
     });
	 
      /* == Master Form == */
      $('body').on('click', 'button[name=dosubmit]', function () {
		 posturl = $(this).data('url')

		  function showResponse(json) {
			  if (json.status == "success") {
				  $(".corporato.form").removeClass("loading").slideUp();
				  $("#msgholder").html(json.message);
			  } else {
				  $(".corporato.form").removeClass("loading");
				  $("#msgholder").html(json.message);
			  }
		  }

          function showLoader() {
              $(".corporato.form").addClass("loading");
          }
          var options = {
              target: "#msgholder",
              beforeSubmit: showLoader,
              success: showResponse,
              type: "post",
              url: SITEURL + posturl,
              dataType: 'json'
          };

          $('#corporato_form').ajaxForm(options).submit();
      });

      /* == Sticky Footer == */
      doFooter();
      $(window).scroll(doFooter);
      $(window).resize(doFooter);
      $(window).load(doFooter);
	  
      $.browser = {};
      $.browser.version = 0;
      if (navigator.userAgent.match(/MSIE ([0-9]+)\./)) {
          $.browser.version = RegExp.$1;
          if ($.browser.version < 10) {
              new Messi("<p class=\"corporato red segment\" style=\"width:300px\">It appears that you are using a <em>very</em> old version of MS Internet Explorer (MSIE) v." + $.browser.version + ".<br />If you seriously want to continue to use MSIE, at least <a href=\"http://www.microsoft.com/windows/internet-explorer/\">upgrade</a></p>", {
                  title: "Old Browser Detected",
                  modal: true,
                  closeButton: true
              });
          }
      }
  });
  $(window).on('resize', function () {
      $(".slrange").ionRangeSlider('update');
  });

  function doFooter() {
      var footer = $("footer");
      if ((($(document.body).height() + footer.outerHeight()) < $(window).height() && footer.css("position") == "fixed") || ($(document.body).height() < $(window).height() && footer.css("position") != "fixed")) {
          footer.css({
              position: "fixed",
              bottom: 0,
              width: "100%"
          });
      } else {
          footer.css({
              position: "static"
          });
      }
  }