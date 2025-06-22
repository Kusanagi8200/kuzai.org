

function cyber_security_services_gb_Menu_open() {
	jQuery(".side_gb_nav").addClass('show');
}
function cyber_security_services_gb_Menu_close() {
	jQuery(".side_gb_nav").removeClass('show');
}

jQuery(function($){
	$('.gb_toggle').click(function () {
        cyber_security_services_Keyboard_loop($('.side_gb_nav'));
    });
});

jQuery('document').ready(function(){
    var owl = jQuery('#slider .owl-carousel');
        owl.owlCarousel({
        loop:true,
        margin:10,
        autoplay : true,
        lazyLoad: true,
        autoplayTimeout: 5000,
        loop: true,
        dots:false,
        navText : ['<i class="fas fa-arrow-left"></i>','<i class="fas fa-arrow-right"></i>'],
        nav:true,
        items:1,
        lazyLoad: true,
        nav:true,
        rtl:true,
      	responsive:{
            0:{
                items:1,
            },
            600:{
                items:1,
            },
            1000:{
                items:1,
            },
            1200:{
                items:1,
            },
        }
    });
});

jQuery(window).scroll(function(){
	if (jQuery(this).scrollTop() > 50) {
		jQuery('.scrollup').addClass('is-active');
	} else {
  		jQuery('.scrollup').removeClass('is-active');
	}
});

jQuery(window).scroll(function(){
    if (jQuery(this).scrollTop() > 120) {
      jQuery('.menu_header').addClass('fixed');
    } else {
        jQuery('.menu_header').removeClass('fixed');
    }
  });

jQuery( document ).ready(function() {
	jQuery('#cyber-security-services-scroll-to-top').click(function (argument) {
		jQuery("html, body").animate({
		       scrollTop: 0
		   }, 600);
	})
})

/* Custom Cursor
 **-----------------------------------------------------*/
// Add this in custom-cursor.js
jQuery(document).ready(function($) {
  var cursor = $(".custom-cursor");
  var follower = $(".custom-cursor-follower");
  var offsetX = 15; // Set your desired horizontal offset
  var offsetY = 15; // Set your desired vertical offset

  $(document).mousemove(function(e) {
    cursor.css({
      top: e.clientY - offsetY + "px",
      left: e.clientX - offsetX + "px"
    });
    follower.css({
      top: e.clientY + "px",
      left: e.clientX + "px"
    });
  });

  $("a, button").hover(
    function() {
      cursor.addClass("active");
      follower.addClass("active");
    },
    function() {
      cursor.removeClass("active");
      follower.removeClass("active");
    }
  );
});

/*preloader*/
jQuery(document).ready(function($) {

  // Function to hide preloader
  function hidePreloader() {
    $("#preloader ").delay(2000).fadeOut("slow");
  }

  // Check if all resources have been loaded
  if (document.readyState === "complete") {
    hidePreloader();
  } else {
    window.onload = hidePreloader;
  }
});


// SEARCH POPUP

jQuery(document).ready(function($) {
    $('.header-search-wrapper .search-main').click(function() {
        $('.search-form-main').toggleClass('active-search');
        $('.search-form-main .search-field').focus();
        $('.header-search-wrapper').toggleClass('icon-toggle');
    });

    $('.search-close-icon').click(function() {
        $('.search-form-main').removeClass('active-search');
        $('.header-search-wrapper').removeClass('icon-toggle');
    });
});