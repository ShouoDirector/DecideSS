$(document).ready(function () {
  // Tooltip initialization
  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Popover initialization
  var popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
  var popoverList = popoverTriggerList.map(function (popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
  });

  // Increment & Decrement functionality
  $(".minus, .add").on("click", function () {
    var $qty = $(this).closest("div").find(".qty"),
      currentVal = parseInt($qty.val()),
      isAdd = $(this).hasClass("add");
    !isNaN(currentVal) &&
      $qty.val(
        isAdd ? ++currentVal : currentVal > 0 ? --currentVal : currentVal
      );
  });

  // Collapsable cards functionality
  $('a[data-action="collapse"]').on("click", function (e) {
    e.preventDefault();
    $(this)
      .closest(".card")
      .find('[data-action="collapse"] i')
      .toggleClass("ti-minus ti-plus");
    $(this).closest(".card").children(".card-body").collapse("toggle");
  });

  // Toggle fullscreen functionality
  $('a[data-action="expand"]').on("click", function (e) {
    e.preventDefault();
    $(this)
      .closest(".card")
      .find('[data-action="expand"] i')
      .toggleClass("ti-arrows-maximize ti-arrows-maximize");
    $(this).closest(".card").toggleClass("card-fullscreen");
  });

  // Close Card functionality
  $('a[data-action="close"]').on("click", function () {
    $(this).closest(".card").removeClass().slideUp("fast");
  });

  // Fixed header on scroll
  $(window).scroll(function () {
    if ($(window).scrollTop() >= 60) {
      $(".app-header").addClass("fixed-header");
    } else {
      $(".app-header").removeClass("fixed-header");
    }
  });

  // Checkout functionality
  $(function () {
    $(".billing-address").click(function () {
      $(".billing-address-content").hide();
    });
    $(".billing-address").click(function () {
      $(".payment-method-list").show();
    });
  });

  // Change layout functionality (boxed/full-width)
  $(".full-width").click(function () {
    $(".container-fluid").addClass("mw-100");
    $(".full-width i").addClass("text-primary");
    $(".boxed-width i").removeClass("text-primary");
  });
  $(".boxed-width").click(function () {
    $(".container-fluid").removeClass("mw-100");
    $(".full-width i").removeClass("text-primary");
    $(".boxed-width i").addClass("text-primary");
  });

  // Dark/Light theme functionality
  $(".light-logo").hide();
  $(".dark-theme").click(function () {
    $("nav.navbar-light").addClass("navbar-dark");
    $(".dark-theme i").addClass("text-primary");
    $(".light-theme i").removeClass("text-primary");
    $(".light-logo").show();
    $(".dark-logo").hide();
  });
  $(".light-theme").click(function () {
    $("nav.navbar-light").removeClass("navbar-dark");
    $(".dark-theme i").removeClass("text-primary");
    $(".light-theme i").addClass("text-primary");
    $(".light-logo").hide();
    $(".dark-logo").show();
  });

  // Card border/shadow functionality
  $(".cardborder").click(function () {
    $("body").addClass("cardwithborder");
    $(".cardshadow i").addClass("text-dark");
    $(".cardborder i").addClass("text-primary");
  });
  $(".cardshadow").click(function () {
    $("body").removeClass("cardwithborder");
    $(".cardborder i").removeClass("text-primary");
    $(".cardshadow i").removeClass("text-dark");
  });

  // Change color theme functionality
  $(".change-colors li a").click(function () {
    $(".change-colors li a").removeClass("active-theme");
    $(this).addClass("active-theme");
  });

  // Delay the fading out of the preloader by 1 second (1000 milliseconds)
  $(".preloader").delay(0).fadeOut();
});


$(function () {

    // =================================
    // Tooltip
    // =================================
    var tooltipTriggerList = [].slice.call(
        document.querySelectorAll('[data-bs-toggle="tooltip"]')
    );
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });

    // scroll

    $(".scroll-link").on("click", function (t) {
        var o = $(this);
        $("html, body").stop().animate({
            scrollTop: $(o.attr("href")).offset().top - 160
        }, 1e3), t.preventDefault()
    })

    // fixed header

    $(window).scroll(function () {
        if ($(window).scrollTop() >= 60) {
            $('header').addClass('fixed-header');
        } else {
            $('header').removeClass('fixed-header');
        }
    });

    // Aos

    AOS.init({
        once: true,
    });

    // Production Slider

    $('.production-slider .owl-carousel').owlCarousel({
        nav: false,
        dots: true,
        loop: true,
        items: 1,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true
    })


    // Review Slider

    $('.review-slider .owl-carousel').owlCarousel({
        loop: true,
        margin: 0,
        dots: true,
        autoplay: true,
        autoplayTimeout: 5000,
        autoplayHoverPause: true,
        responsive: {
            0: {
                items: 1
            },
            768: {
                items: 2
            },
            1200: {
                items: 3
            }
        }
    })

});
