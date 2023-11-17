
  (function ($) {

  "use strict";

    // COUNTER NUMBERS
    jQuery('.counter-thumb').appear(function() {
      jQuery('.counter-number').countTo();
    });

    // REVIEWS CAROUSEL
    $('.reviews-carousel').owlCarousel({
    items:2,
    loop:true,
    autoplay: true,
    margin:30,
      responsive:{
        0:{
          items:1
        },
        600:{
          items:1
        },
        1000:{
          items:2
        }
      }
    })
      $('.reviews-carousel2').owlCarousel({
          items:5,
          loop:false,
          autoplay: false,
          margin:10,
          responsive:{
              0:{
                  items:2
              },
              600:{
                  items:2
              },
              767:{
                  items:3
              },
              1000:{
                  items:5
              }
          }
      })

    // CUSTOM LINK
    $('.smoothscroll').click(function(){
    var el = $(this).attr('href');
    var elWrapped = $(el);
    var header_height = $('.navbar').height();

    scrollToDiv(elWrapped,header_height);
    return false;

    function scrollToDiv(element,navheight){
      var offset = element.offset();
      var offsetTop = offset.top;
      var totalScroll = offsetTop-navheight;

      $('body,html').animate({
      scrollTop: totalScroll
      }, 300);
    }
  });

})(window.jQuery);


