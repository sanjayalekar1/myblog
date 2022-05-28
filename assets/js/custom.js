var baseurl = "/";
var email_val =
  /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
var phone_val = /\(?([0-9]{3})\)?([ .-]?)([0-9]{3})\2([0-9]{4})/;
var numeric_val = /^\d+$/;
var alphanumeric_val = /^(?=.*[0-9])(?=.*[a-zA-Z])([a-zA-Z0-9]+)$/;
var alphanumericspace_val = /^[a-z\d\-_\s]+$/i;
var date_val = /^(0?[1-9]|[12][0-9]|3[01])[\/\-](0?[1-9]|1[012])[\/\-]\d{4}$/;
var regExp = /[A-Za-z0-9_~\-!@#\$%\^&\*\(\)]+$/i;
var regExpnumbers = "/[0-9]/g;";
var whitespaces_val = /^\s+$/;
var website_val =
  /https?:\/\/(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/;

$(".page_loader").fadeOut("fast");

$("form").attr("autocomplete", "off");

$("input, select, textarea").on("keydown change", function () {
  $(".error span").fadeOut();
});

$(".project__amenities__text__inner p").addClass("paragraph");

$("input, select, textarea").each(function () {
  var placeholder = $(this).attr("placeholder");

  if (validateblanktext(placeholder)) {
    $(this).attr("title", placeholder);
  }
});

$(document).ready(function () {
  function setCookie(key, value, expiry) {
    var expires = new Date();
    expires.setTime(expires.getTime() + expiry * 24 * 60 * 60 * 1000);
    document.cookie = key + "=" + value + ";expires=" + expires.toUTCString();
  }

  function getCookie(key) {
    var keyValue = document.cookie.match("(^|;) ?" + key + "=([^;]*)(;|$)");
    return keyValue ? keyValue[2] : null;
  }

  function eraseCookie(key) {
    var keyValue = getCookie(key);
    setCookie(key, keyValue, "-1");
  }

  if (!getCookie("showDisclaimer")) {
    $(".disclaimer").removeClass("disable");
    $(".backdrop").addClass("active");
    $("body").css("overflow", "hidden");
    $(".disclaimer").addClass("show");
  } else {
    $(".disclaimer").addClass("disable").removeClass("active,show");
    $("body").css("overflow-y", "auto");
  }

  $(".disclaimer__inner__content span").on("click", function () {
    $(".disclaimer").addClass("active");
  });

  $(".disclaimer__inner__link").on("click", function () {
    $(".disclaimer").addClass("disable").removeClass("active");
    $(".backdrop").removeClass("active");
    $("body").css("overflow-y", "auto");
    setCookie("showDisclaimer", "1", "1");
  });

  Splitting();

  var banner_slider = $(".banner__slider,.project__banner__slider");
  banner_slider.owlCarousel({
    items: 1,
    loop: true,
    autoplay: true,
    autoplayTimeout: 5000,
    margin: 0,
    animateIn: "fadeIn",
    animateOut: "fadeOut",
    autoplayHoverPause: false,
    smartSpeed: 150,
    dots: true,
    nav: false,
    mouseDrag: false,
  });

  $(".nav__hamburger").on("click", function () {
    $(".sidemenu").addClass("active");
  });
  $(".sidemenu__hamburger").on("click", function () {
    $(".sidemenu").removeClass("active");
  });

  var $owlHistory = $(".history__slider");

  $owlHistory.children().each(function (index) {
    $(this).attr("data-index", index); // NB: .attr() instead of .data()
  });

  $owlHistory.owlCarousel({
    items: 1,
    loop: true,
    autoplay: false,
    autoplayTimeout: 5000,
    center: true,
    margin: 0,
    animateIn: "fadeIn",
    animateOut: "fadeOut",
    autoplayHoverPause: false,
    smartSpeed: 300,
    dots: true,
    nav: false,
  });

  var $owl = $(".year__slider");

  $owl.children().each(function (index) {
    $(this).attr("data-position", index); // NB: .attr() instead of .data()
  });

  $owl.owlCarousel({
    items: 6,
    loop: true,
    autoplay: false,
    autoplayTimeout: 5000,
    margin: 0,
    center: true,
    // animateIn: 'fadeIn',
    // animateOut: 'fadeOut',
    autoplayHoverPause: false,
    smartSpeed: 300,
    dots: true,
    nav: false,
    mouseDrag: true,
    responsive: {
      991: {
        items: 5,
      },
      768: {
        items: 3,
      },
    },
  });

  $(document).on("click", ".year__slider  .owl-item>div", function () {
    setTimeout(() => {
      $owl.trigger("to.owl.carousel", $(this).data("position"));
      $owlHistory.trigger("to.owl.carousel", $(this).data("position"));
    }, 200);
  });

  $owl.on("changed.owl.carousel", function (e) {
    setTimeout(() => {
      var position = $(".year__slider .owl-item.active.center>div").attr(
        "data-position"
      );
      $owlHistory.trigger("to.owl.carousel", position);
    }, 200);
  });

  $owlHistory.on("changed.owl.carousel", function (e) {
    setTimeout(() => {
      var position = $(".history__slider .owl-item.active.center>div").attr(
        "data-index"
      );
      $owl.trigger("to.owl.carousel", position);
    }, 200);
  });

  $(".history__slider .arrows .left").on("click", function () {
    $(".history__slider .owl-prev").trigger("click");
  });

  $(".history__slider .arrows .right").on("click", function () {
    $(".history__slider .owl-next").trigger("click");
  });

  $(".social_projects__block__info").not(".active").slideUp();
  $(".social_projects__block__title").on("click", function () {
    if (!$(this).parent().hasClass("active")) {
      $(".social_projects__block__info").slideUp();
      $(".social_projects__block").removeClass("active");
      $(this).parent(".social_projects__block").addClass("active");
      $(this).next(".social_projects__block__info").slideDown();
    }
    setTimeout(() => {
      scroller.update();
    }, 1000);
  });

  press_jquery_update();

  function press_jquery_update() {
    $(".press__listing__block__info").not(".active").slideUp();
    $(".press__listing__block__title").on("click", function () {
      if (!$(this).parent().hasClass("active")) {
        $(".press__listing__block__info").slideUp();
        $(".press__listing__block").removeClass("active");
        $(this).parent(".press__listing__block").addClass("active");
        $(this).next(".press__listing__block__info").slideDown();
      }
      setTimeout(() => {
        scroller.update();
      }, 1000);
    });
  }

  setTimeout(function () {
    $(".is-checked").trigger("click");
  }, 50);
  var $grid = $(".grid").isotope({
    itemSelector:
      ".projects__lists__section__item, .project__gallery__lists__section__item, .testimonial__lists__section__item",
    stagger: 30,
    gutter: 10,
    transitionDuration: "1.5s",
    transitionDuration: 800,
  });

  $("#filters").on("click", "li", function () {
    var filterValue = $(this).attr("data-filter");
    filterValue = filterFns[filterValue] || filterValue;
    $grid.isotope({ filter: filterValue });
  });

  $(".button-group").each(function (i, buttonGroup) {
    var $buttonGroup = $(buttonGroup);
    $buttonGroup.on("click", "li", function () {
      $buttonGroup.find(".is-checked").removeClass("is-checked");
      $(this).addClass("is-checked");
    });
  });

  // filter functions
  var filterFns = {
    numberGreaterThan50: function () {
      var number = $(this).find(".number").text();
      return parseInt(number, 10) > 50;
    },
  };

  // if (window.innerWidth > 991) {

  gsap.registerPlugin(ScrollTrigger);

  const scroller = new LocomotiveScroll({
    el: document.querySelector(".scroller"),
    smooth: true,
  });

  scroller.on("scroll", ScrollTrigger.update);

  ScrollTrigger.scrollerProxy(".scroller", {
    scrollTop(value) {
      return arguments.length
        ? scroller.scrollTo(value, 0, 0)
        : scroller.scroll.instance.scroll.y;
    },
    getBoundingClientRect() {
      return {
        left: 0,
        top: 0,
        width: window.innerWidth,
        height: window.innerHeight,
      };
    },
  });

  ScrollTrigger.addEventListener("refresh", () => scroller.update());

  ScrollTrigger.refresh();

  setTimeout(() => {
    scroller.update();
  }, 5000);

  scroller.on("scroll", (position) => {
    if (position.scroll.y >= 10) {
      $("header").addClass("sticky");
    } else {
      $("header").removeClass("sticky");
    }
  });

  // $("body,html").on("click", ".social_projects__block__title", function () {
  //     scroller.update();
  // })
  $("body,html").on(
    "click",
    "#filters li",
    ".filter_projects_submit",
    function () {
      scroller.update();
    }
  );

  $(".banner__slider__item__caption__scroll").on("click", function () {
    const about = document.querySelector("#about");
    scroller.scrollTo(about);
  });

  	$(".scrollTo").on("click", function () {
			const listing = document.querySelector("#projectListing");
			scroller.scrollTo(listing);
		});

  // }

  $(".directors__listing__block__info .link").on("click", function (e) {
    e.preventDefault();

    let profile_description = $(this)
      .siblings(".profile__data")
      .children("#data-profile-description")
      .attr("data-profile-description");
    let profile_twitter = $(this)
      .siblings(".profile__data")
      .children("#data-profile-description")
      .attr("data-profile-twitter");
    let profile_linkedin = $(this)
      .siblings(".profile__data")
      .children("#data-profile-linkedin")
      .attr("data-profile-linkedin");
    let profile_position = $(this)
      .siblings(".profile__data")
      .children("#data-profile-position")
      .attr("data-profile-position");
    let profile_name = $(this)
      .siblings(".profile__data")
      .children("#data-profile-name")
      .attr("data-profile-name");
    let profile_image = $(this)
      .siblings(".profile__data")
      .children("#data-profile-image")
      .attr("data-profile-image");

    $(".profile_name").html(profile_name);
    $(".profile_position").html(profile_position);
    $(".profile_description").html(profile_description);
    $(".profile_linkedin").attr("href", profile_linkedin);
    $(".profile_twitter").attr("href", profile_twitter);
    $(".profile_image").attr("src", profile_image);
    $("#profile").modal("show");
  });

  $(".management__block").on("click", function (e) {
    e.preventDefault();
    let profile_description = $(this)
      .children(".profile__data")
      .children("#data-profile-description")
      .attr("data-profile-description");
    let profile_twitter = $(this)
      .children(".profile__data")
      .children("#data-profile-description")
      .attr("data-profile-twitter");
    let profile_linkedin = $(this)
      .children(".profile__data")
      .children("#data-profile-linkedin")
      .attr("data-profile-linkedin");
    let profile_position = $(this)
      .children(".profile__data")
      .children("#data-profile-position")
      .attr("data-profile-position");
    let profile_name = $(this)
      .children(".profile__data")
      .children("#data-profile-name")
      .attr("data-profile-name");
    let profile_image = $(this)
      .children(".profile__data")
      .children("#data-profile-image")
      .attr("data-profile-image");

    $(".profile_name").html(profile_name);
    $(".profile_position").html(profile_position);
    $(".profile_description").html(profile_description);
    $(".profile_linkedin").attr("href", profile_linkedin);
    $(".profile_twitter").attr("href", profile_twitter);
    $(".profile_image").attr("src", profile_image);
    $("#profile").modal("show");
  });

  var project__videos__slider = $(".project__videos__slider");
  project__videos__slider.owlCarousel({
    items: 3,
    loop: false,
    margin: 20,
    autoplay: false,
    dots: true,
    nav: true,
    mouseDrag: true,
    responsiveClass: true,
    smartSpeed: 1500,
    lazyLoad: true,
    responsive: {
      0: {
        items: 1,
      },
      767: {
        items: 2,
      },
      991: {
        items: 3,
      },
      1300: {
        items: 3,
      },
      1301: {
        items: 3,
      },
    },
  });

  $(".project__videos__slider .owl-prev").html(
    '<img src="' +
      baseurl +
      'assets/images/project-details/arrow.png" class="img-fluid left__arrow" width="33" height="25">'
  );
  $(".project__videos__slider .owl-next").html(
    '<img src="' +
      baseurl +
      'assets/images/project-details/arrow.png" class="img-fluid right__arrow" width="33" height="25">'
  );

  function toggle_video_modal() {
    $(".play__icon").on("click", function (e) {
      e.preventDefault();
      var data_id = $(this).attr("data-id");
      var id = $(this).attr("data-youtube-id");
      var autoplay = "?autoplay=1";
      var related_no = "&rel=0";
      if (data_id == 1) {
        var src = "//www.youtube.com/embed/" + id + autoplay + related_no;
      } else if (data_id == 2) {
        var src = "//rtsp.me/embed/" + id;
      } else {
        var src = "//www.youtube.com/embed/" + id + autoplay + related_no;
      }
      $("#youtube").attr("src", src);
      $("#video__modal").modal("show");
    });

    function close_video_modal() {
      event.preventDefault();
      $("#youtube").attr("src", "");
      $("#video__modal").modal("hide");
    }

    $("body").on("click", ".close-video-modal,#video__modal", function (event) {
      close_video_modal();
    });

    $("body").keyup(function (e) {
      if (e.keyCode == 27) {
        close_video_modal();
      }
    });
  }

  toggle_video_modal();

  $(".banner__scroll").on("click", function () {
    const projectIntro = document.querySelector(".project__intro");
    scroller.scrollTo(projectIntro);
  });

  $("#enquiry_form_pop").on("submit", function (e) {
    e.preventDefault();

    $(".error span, .error label").fadeOut();

    var data = $(this).serialize();

    $.ajax({
      url: baseurl + "enquiry-form-pop-details",
      data: data,
      dataType: "JSON",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $("#configurationModal").modal("hide");

        /*
        if (validateblanktext(result.pdf_file_download)) {
          window.location.href = baseurl + "download-pdf-file";
        } */

        $(".wait_loader").fadeOut();

        $("#otp_modal").modal("show");

        $(".resend_otp_trigger").addClass("d-none");
        $(".resend_button_timer").removeClass("d-none");

        var total_seconds = 30;

        var set_resend_timer = setInterval(function () {
          if (total_seconds <= 0) {
            $(".resend_button_timer").html("");
            $(".resend_button_timer").addClass("d-none");
            $(".resend_otp_trigger").removeClass("d-none");
            clearInterval(set_resend_timer);
          } else {
            $(".resend_button_timer").html(
              total_seconds + " seconds before you can resend OTP"
            );
            total_seconds--;
          }
        }, 1000);

        setTimeout(function () {
          $("#otp_digit_one").focus();
        }, 1500);
      },
      error: function (result) {
        $(".wait_loader").fadeOut();
        validation_error(result);
      },
    });
  });

  $("#media_kit_form_pop").on("submit", function (e) {
    e.preventDefault();

    $(".error span, .error label").fadeOut();

    var data = $(this).serialize();

    $.ajax({
      url: baseurl + "media-kit-enquiry-form-pop-details",
      data: data,
      dataType: "JSON",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $("#mediaKitModal").modal("hide");

        /*
        if (validateblanktext(result.pdf_file_download)) {
          window.location.href = baseurl + "download-pdf-file";
        } */

        $(".wait_loader").fadeOut();

        $("#otp_modal").modal("show");

        $(".resend_otp_trigger").addClass("d-none");
        $(".resend_button_timer").removeClass("d-none");

        var total_seconds = 30;

        var set_resend_timer = setInterval(function () {
          if (total_seconds <= 0) {
            $(".resend_button_timer").html("");
            $(".resend_button_timer").addClass("d-none");
            $(".resend_otp_trigger").removeClass("d-none");
            clearInterval(set_resend_timer);
          } else {
            $(".resend_button_timer").html(
              total_seconds + " seconds before you can resend OTP"
            );
            total_seconds--;
          }
        }, 1000);

        setTimeout(function () {
          $("#otp_digit_one").focus();
        }, 1500);
      },
      error: function (result) {
        $(".wait_loader").fadeOut();
        validation_error(result);
      },
    });
  });

  $(".trigger_enquire_now").on("click", function () {
    $("#enquire_now_Modal").modal("show");
  });

  $(".enquiry_form").on("submit", function (e) {
    e.preventDefault();

    $(".error span").fadeOut();

    var data = $(this).serialize();
    var target_element = $(this);

    $.ajax({
      url: baseurl + "enquiry-form-details",
      data: data,
      dataType: "JSON",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $("#enquire_now_Modal").modal("hide");

        $(".wait_loader").fadeOut();

        $("#otp_modal").modal("show");

        $(".resend_otp_trigger").addClass("d-none");
        $(".resend_button_timer").removeClass("d-none");

        var total_seconds = 30;

        var set_resend_timer = setInterval(function () {
          if (total_seconds <= 0) {
            $(".resend_button_timer").html("");
            $(".resend_button_timer").addClass("d-none");
            $(".resend_otp_trigger").removeClass("d-none");
            clearInterval(set_resend_timer);
          } else {
            $(".resend_button_timer").html(
              total_seconds + " seconds before you can resend OTP"
            );
            total_seconds--;
          }
        }, 1000);

        setTimeout(function () {
          $("#otp_digit_one").focus();
        }, 1500);
      },
      error: function (result) {
        $(".wait_loader").fadeOut();

        $.each(result.responseJSON.errors, function (k, v) {
          $(target_element)
            .find("." + k + "_err")
            .fadeIn();
          $(target_element)
            .find("." + k + "_err")
            .html(v);
          $(target_element)
            .find("." + k)
            .focus();
          return false;
        });
      },
    });
  });

  $("#contact_enquiry_form").on("submit", function (e) {
    e.preventDefault();

    $(".error span").fadeOut();

    var data = $(this).serialize();
    var target_element = $(this);

    $.ajax({
      url: baseurl + "contact-enquiry-form-details",
      data: data,
      dataType: "JSON",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $(".wait_loader").fadeOut();

        $("#otp_modal").modal("show");

        $(".resend_otp_trigger").addClass("d-none");
        $(".resend_button_timer").removeClass("d-none");

        var total_seconds = 30;

        var set_resend_timer = setInterval(function () {
          if (total_seconds <= 0) {
            $(".resend_button_timer").html("");
            $(".resend_button_timer").addClass("d-none");
            $(".resend_otp_trigger").removeClass("d-none");
            clearInterval(set_resend_timer);
          } else {
            $(".resend_button_timer").html(
              total_seconds + " seconds before you can resend OTP"
            );
            total_seconds--;
          }
        }, 1000);

        setTimeout(function () {
          $("#otp_digit_one").focus();
        }, 1500);
      },
      error: function (result) {
        $(".wait_loader").fadeOut();

        validation_error(result);
      },
    });
  });

  $("#otp_digit_one").on("keyup", function (e) {
    var current_value = $(this).val();

    if (!numeric_val.test(current_value)) {
      $(this).val("");
    } else if (current_value.length > 1) {
      $(this).val("");
    } else if (current_value.length == 1) {
      var otp_digit_one = $("#otp_digit_one").val();
      var otp_digit_two = $("#otp_digit_two").val();
      var otp_digit_three = $("#otp_digit_three").val();
      var otp_digit_four = $("#otp_digit_four").val();

      if (
        validateblanktext(otp_digit_one) &&
        validateblanktext(otp_digit_two) &&
        validateblanktext(otp_digit_three) &&
        validateblanktext(otp_digit_four)
      ) {
        $(".submit_otp_verification").trigger("click");
      } else {
        $("#otp_digit_two").focus();
      }
    }
  });

  $("#otp_digit_two").on("keyup", function (e) {
    var key_code = e.keyCode;

    if (key_code == 8) {
      $("#otp_digit_one").focus();
    }

    var current_value = $(this).val();

    if (!numeric_val.test(current_value)) {
      $(this).val("");
    } else if (current_value.length > 1) {
      $(this).val("");
    } else if (current_value.length == 1) {
      var otp_digit_one = $("#otp_digit_one").val();
      var otp_digit_two = $("#otp_digit_two").val();
      var otp_digit_three = $("#otp_digit_three").val();
      var otp_digit_four = $("#otp_digit_four").val();

      if (
        validateblanktext(otp_digit_one) &&
        validateblanktext(otp_digit_two) &&
        validateblanktext(otp_digit_three) &&
        validateblanktext(otp_digit_four)
      ) {
        $(".submit_otp_verification").trigger("click");
      } else {
        $("#otp_digit_three").focus();
      }
    }
  });

  $("#otp_digit_three").on("keyup", function (e) {
    var key_code = e.keyCode;

    if (key_code == 8) {
      $("#otp_digit_two").focus();
    }

    var current_value = $(this).val();

    if (!numeric_val.test(current_value)) {
      $(this).val("");
    } else if (current_value.length > 1) {
      $(this).val("");
    } else if (current_value.length == 1) {
      var otp_digit_one = $("#otp_digit_one").val();
      var otp_digit_two = $("#otp_digit_two").val();
      var otp_digit_three = $("#otp_digit_three").val();
      var otp_digit_four = $("#otp_digit_four").val();

      if (
        validateblanktext(otp_digit_one) &&
        validateblanktext(otp_digit_two) &&
        validateblanktext(otp_digit_three) &&
        validateblanktext(otp_digit_four)
      ) {
        $(".submit_otp_verification").trigger("click");
      } else {
        $("#otp_digit_four").focus();
      }
    }
  });

  $("#otp_digit_four").on("keyup", function (e) {
    var key_code = e.keyCode;

    if (key_code == 8) {
      $("#otp_digit_three").focus();
    }

    var current_value = $(this).val();

    if (!numeric_val.test(current_value)) {
      $(this).val("");
    } else if (current_value.length > 1) {
      $(this).val("");
    } else if (current_value.length == 1) {
      var otp_digit_one = $("#otp_digit_one").val();
      var otp_digit_two = $("#otp_digit_two").val();
      var otp_digit_three = $("#otp_digit_three").val();
      var otp_digit_four = $("#otp_digit_four").val();

      if (
        validateblanktext(otp_digit_one) &&
        validateblanktext(otp_digit_two) &&
        validateblanktext(otp_digit_three) &&
        validateblanktext(otp_digit_four)
      ) {
        $(".submit_otp_verification").trigger("click");
      }
    }
  });

  $("#otp_verification_form").on("submit", function (e) {
    e.preventDefault();

    $(".error span").fadeOut();

    var data = $(this).serialize();

    $.ajax({
      url: baseurl + "verify-otp-details",
      data: data,
      dataType: "JSON",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        if (validateblanktext(result.display_message) && validateblanktext(result.project_url_slug)) {
          window.location.href = baseurl + "projects/" + result.project_url_slug + "/thank-you";
        } else if (result.pdf_file_download == 1) {
          window.location.href = baseurl + "download-pdf-file";
        } else if (result.pdf_file_download == 2) {
          window.location.href = baseurl + "download-media-kit-file";
        } else {
          alert(result.display_message);
        }

        $(".wait_loader").fadeOut();
        $("#otp_modal, #enquire_now_Modal").modal("hide");
        $("#contact_enquiry_form")[0].reset();
        $("#otp_verification_form")[0].reset();
        $(".enquiry_form")[0].reset();
        $("#enquiry_form_pop")[0].reset();
      },
      error: function (result) {
        $(".wait_loader").fadeOut();
        validation_error(result);
      },
    });
  });

  $(".resend_otp_trigger").on("click", function () {
    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: baseurl + "resend-otp-details",
      dataType: "JSON",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $(".wait_loader").fadeOut();

        $(".resend_otp_trigger").addClass("d-none");
        $(".resend_button_timer").removeClass("d-none");

        var total_seconds = 30;

        var set_resend_timer = setInterval(function () {
          if (total_seconds <= 0) {
            $(".resend_button_timer").html("");
            $(".resend_button_timer").addClass("d-none");
            $(".resend_otp_trigger").removeClass("d-none");
            clearInterval(set_resend_timer);
          } else {
            $(".resend_button_timer").html(
              total_seconds + " seconds before you can resend OTP"
            );
            total_seconds--;
          }
        }, 1000);
      },
      error: function (result) {
        window.location.reload();
      },
    });
  });

  $(".download_brochure_config").on("click", function () {
    var download_type = $(this).attr("data-type");
    var project_id = $(this).attr("data-id");

    if (!validateblanktext(download_type)) {
      return false;
    } else if (!numeric_val.test(download_type)) {
      return false;
    }

    if (!validateblanktext(project_id)) {
      return false;
    } else if (!numeric_val.test(project_id)) {
      return false;
    }

    var data = { download_type: download_type, project_id: project_id };

    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: baseurl + "configure-download-type-details",
      data: data,
      dataType: "HTML",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $(".wait_loader").fadeOut();
      },
      error: function (result) {
        $(".wait_loader").fadeOut();
      },
    });
  });

  $(".project_type_filter li").on("click", function () {
    $(".project_status_filter li").removeClass("is-checked");
  });

  $(".project_status_filter li").on("click", function () {
    $(".project_type_filter li").removeClass("is-checked");
  });

  $("#zoneOptions").on("change", function () {
    var project_zone_id = $(this).val();

    $(".project_type_filter li").removeClass("is-checked");

    $("#locationOptions").html('<option value="">Location</option>');
    $("#categoryOptions").html('<option value="">Type</option>');

    var data = { project_zone_id: project_zone_id };

    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: baseurl + "filter-zone-details",
      data: data,
      dataType: "JSON",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $(".wait_loader").fadeOut();

        $.each(result.project_locations, function (k, single_project_location) {
          $("#locationOptions").append(
            '<option value="' +
              single_project_location.id +
              '">' +
              single_project_location.project_location_title +
              "</option>"
          );
        });

        $.each(
          result.project_categories,
          function (k, single_project_category) {
            $("#categoryOptions").append(
              '<option value="' +
                single_project_category.id +
                '">' +
                single_project_category.project_category_title +
                "</option>"
            );
          }
        );
      },
      error: function (result) {
        $(".wait_loader").fadeOut();
      },
    });
  });

  $("#locationOptions").on("change", function () {
    var project_zone_id = $("#zoneOptions").val();
    var project_location_id = $(this).val();

    $(".project_type_filter li").removeClass("is-checked");

    $("#categoryOptions").html('<option value="">Type</option>');

    var data = {
      project_zone_id: project_zone_id,
      project_location_id: project_location_id,
    };

    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: baseurl + "filter-location-details",
      data: data,
      dataType: "JSON",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $(".wait_loader").fadeOut();

        $.each(
          result.project_categories,
          function (k, single_project_category) {
            $("#categoryOptions").append(
              '<option value="' +
                single_project_category.id +
                '">' +
                single_project_category.project_category_title +
                "</option>"
            );
          }
        );
      },
      error: function (result) {
        $(".wait_loader").fadeOut();
      },
    });
  });

  $("#categoryOptions").on("change", function () {
    $(".project_type_filter li").removeClass("is-checked");
  });

  $(".filter_projects_submit").on("click", function () {
    var project_zone_id = $("#zoneOptions").val();
    var project_location_id = $("#locationOptions").val();
    var project_category_id = $("#categoryOptions").val();

    var data = {
      project_zone_id: project_zone_id,
      project_location_id: project_location_id,
      project_category_id: project_category_id,
    };

    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: baseurl + "filter-project-details",
      data: data,
      dataType: "HTML",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $(".projects__lists").html(result);

        $(".grid").isotope({
          itemSelector: ".projects__lists__section__item",
          stagger: 30,
          gutter: 10,
          transitionDuration: "1.5s",
          transitionDuration: 800,
        });
        $(".wait_loader").fadeOut();

        scroller.update();
      },
      error: function (result) {
        $(".wait_loader").fadeOut();
      },
    });
  });

  $(".project_type_filter li").on("click", function () {
    var project_type_id = $(this).attr("data-filter");

    if (
      !validateblanktext(project_type_id) ||
      !numeric_val.test(project_type_id)
    ) {
      return false;
    }

    $("#zoneOptions, #locationOptions, #categoryOptions").val("");

    var data = { project_type_id: project_type_id };

    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: baseurl + "filter-project-details",
      data: data,
      dataType: "HTML",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $(".projects__lists").html(result);

        $(".grid").isotope({
          itemSelector: ".projects__lists__section__item",
          stagger: 30,
          gutter: 10,
          transitionDuration: "1.5s",
          transitionDuration: 800,
        });
        $(".wait_loader").fadeOut();

        scroller.update();
      },
      error: function (result) {
        $(".wait_loader").fadeOut();
      },
    });
  });

  $(".project_status_filter li").on("click", function () {
    var project_status_id = $(this).attr("data-filter");

    if (
      !validateblanktext(project_status_id) ||
      !numeric_val.test(project_status_id)
    ) {
      return false;
    }

    var data = { project_status_id: project_status_id };

    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: baseurl + "filter-project-details",
      data: data,
      dataType: "HTML",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $(".projects__lists").html(result);

        $(".grid").isotope({
          itemSelector: ".projects__lists__section__item",
          stagger: 30,
          gutter: 10,
          transitionDuration: "1.5s",
          transitionDuration: 800,
        });
        $(".wait_loader").fadeOut();

        scroller.update();
      },
      error: function (result) {
        $(".wait_loader").fadeOut();
      },
    });
  });

  $(".trigger_media_kit_form").on("click", function () {
    $("#mediaKitModal").modal("show");
  });

  $(".filter_press_year").on("change", function () {
    var selected_year = $(this).val();

    if (!validateblanktext(selected_year)) {
      return false;
    } else if (!numeric_val.test(selected_year)) {
      return false;
    }

    var data = { selected_year: selected_year };

    filter_press(data);
  });

  $(".filter_award_year").on("change", function () {
    var selected_year = $(this).val();

    var data = { selected_year: selected_year };

    filter_awards(data);
  });

  $(".filter_video_year").on("change", function () {
    var selected_year = $(this).val();

    if (!validateblanktext(selected_year)) {
      return false;
    } else if (!numeric_val.test(selected_year)) {
      return false;
    }

    var data = { selected_year: selected_year };

    filter_videos(data);
  });

  $(".filter_media_year, .filter_media_type_id").on("change", function () {
    var selected_year = $(".filter_media_year").val();

    var data = { selected_year: selected_year };

    var filter_media_type_id = $(".filter_media_type_id").val();

    if (filter_media_type_id == 1) {
      filter_media(data);
    } else if (filter_media_type_id == 2) {
      filter_press(data);
    } else if (filter_media_type_id == 3) {
      filter_videos(data);
    }
  });

  function filter_media(data) {
    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: baseurl + "filter-media-details",
      data: data,
      dataType: "HTML",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $(".media__listing").html(result);

        $(".wait_loader").fadeOut();

        setTimeout(function () {
          scroller.update();
        }, 1500);
      },
      error: function (result) {
        $(".wait_loader").fadeOut();
      },
    });
  }

  function filter_awards(data) {
    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: baseurl + "filter-award-details",
      data: data,
      dataType: "HTML",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $(".awards__listing").html(result);

        $(".wait_loader").fadeOut();
      },
      error: function (result) {
        $(".wait_loader").fadeOut();
      },
    });
  }

  function filter_press(data) {
    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: baseurl + "filter-press-details",
      data: data,
      dataType: "HTML",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $(".press__listing").html(result);

        $(".wait_loader").fadeOut();

        press_jquery_update();
      },
      error: function (result) {
        $(".wait_loader").fadeOut();
      },
    });
  }

  function filter_videos(data) {
    $.ajax({
      headers: { "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content") },
      url: baseurl + "filter-video-details",
      data: data,
      dataType: "HTML",
      type: "POST",
      beforeSend: function () {
        $(".wait_loader").fadeIn();
      },
      success: function (result) {
        $(".video__listing").html(result);

        $(".wait_loader").fadeOut();

        toggle_video_modal();

        setTimeout(function () {
          scroller.update();
        }, 1500);
      },
      error: function (result) {
        $(".wait_loader").fadeOut();
      },
    });
  }

  var intervalId = window.setInterval(function () {
    var $grid = $(".grid").isotope({
      itemSelector:
        ".projects__lists__section__item, .project__gallery__lists__section__item, .testimonial__lists__section__item",
      stagger: 30,
      gutter: 10,
      transitionDuration: "1.5s",
      transitionDuration: 800,
    });
  }, 1000);

  $(".walkthrough .link").on("click", function () {
    let iframeAddress = $(this).attr("data-iframe");
    console.log(iframeAddress);
    $("#walkthrough__modal").find("#walkthrough").attr("src", iframeAddress);
    $("#walkthrough__modal").modal("show");
  });

  $(window).on("load", () => {
    scroller.update();
  });
});

$(window).on("scroll", (position) => {
  var scroll = $(window).scrollTop();
  if (scroll >= 10) {
    $("header").addClass("sticky");
  } else {
    $("header").removeClass("sticky");
  }
});

setTimeout(function() {
  $.ajax({
    url: baseurl + "fetch-country-list",
    dataType: "JSON",
    success: function(result) {
      var country_html;
      $.each(result.countries, function(k, v) {
        var isd_code = v.isd_code;

        isd_code = isd_code.replace('+', '');

        if(v.country_name == "India") {
          country_html += "<option value='" + isd_code + "' selected>" + v.country_name + " (" + isd_code + ")</option>";
        } else {
          country_html += "<option value='" + isd_code + "'>" + v.country_name + " (" + isd_code + ")</option>";
        }
      });

      $(".country_dropdown").append(country_html);
    }
  });
}, 2500);

function validation_error(result) {
  $.each(result.responseJSON.errors, function (k, v) {
    $("#" + k + "_err").fadeIn();
    $("#" + k + "_err").html(v);
    $("#" + k).focus();
    return false;
  });
}

function scrolltodiv(element_to_scroll) {
  $("html,body").animate(
    { scrollTop: $(element_to_scroll).offset().top },
    "slow"
  );
}

function validatestring(stringtext) {
  if (
    stringtext == "" ||
    whitespaces_val.test(stringtext) ||
    numeric_val.test(stringtext) ||
    alphanumeric_val.test(stringtext)
  ) {
    return false;
  } else {
    return true;
  }
}

function validateblanktext(stringtext) {
  if (
    stringtext == "" ||
    whitespaces_val.test(stringtext) ||
    stringtext === null
  ) {
    return false;
  } else {
    return true;
  }
}

document.addEventListener("DOMContentLoaded", function () {
  var lazyloadImages;

  if ("IntersectionObserver" in window) {
    lazyloadImages = document.querySelectorAll(".lazy");
    var imageObserver = new IntersectionObserver(function (entries, observer) {
      entries.forEach(function (entry) {
        if (entry.isIntersecting) {
          var image = entry.target;
          image.classList.remove("lazy");
          imageObserver.unobserve(image);
        }
      });
    });

    lazyloadImages.forEach(function (image) {
      imageObserver.observe(image);
    });
  } else {
    var lazyloadThrottleTimeout;
    lazyloadImages = document.querySelectorAll(".lazy");

    function lazyload() {
      if (lazyloadThrottleTimeout) {
        clearTimeout(lazyloadThrottleTimeout);
      }

      lazyloadThrottleTimeout = setTimeout(function () {
        var scrollTop = window.pageYOffset;
        lazyloadImages.forEach(function (img) {
          if (img.offsetTop < window.innerHeight + scrollTop) {
            img.src = img.dataset.src;
            img.classList.remove("lazy");
          }
        });
        if (lazyloadImages.length == 0) {
          document.removeEventListener("scroll", lazyload);
          window.removeEventListener("resize", lazyload);
          window.removeEventListener("orientationChange", lazyload);
        }
      }, 2500);
    }

    document.addEventListener("scroll", lazyload);
    window.addEventListener("resize", lazyload);
    window.addEventListener("orientationChange", lazyload);
  }
});
