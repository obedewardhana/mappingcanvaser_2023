(function ($) {
  "use strict";

  /*--
        Header Sticky
    -----------------------------------*/
  $(window).on("scroll", function (event) {
    var scroll = $(window).scrollTop();
    if (scroll <= 200) {
      $(".header-main").removeClass("sticky");
    } else {
      $(".header-main").addClass("sticky");
    }
  });

  /*--
        Menu Active
    -----------------------------------*/
  $(function () {
    var url = window.location.pathname;
    var activePage = url.substring(url.lastIndexOf("/") + 1);
    $(".nav-menu li a").each(function () {
      var linkPage = this.href.substring(this.href.lastIndexOf("/") + 1);

      if (activePage == linkPage) {
        $(this).closest("li").addClass("active");
      }
    });
  });

  /*--
        Menu Script
    -----------------------------------*/

  /*Variables*/
  var $offCanvasNav = $(".mobile-menu-items"),
    $offCanvasNavSubMenu = $offCanvasNav.find(".sub-menu");

  /*Add Toggle Button With Off Canvas Sub Menu*/
  $offCanvasNavSubMenu
    .parent()
    .prepend('<span class="mobile-menu-expand"></span>');

  /*Close Off Canvas Sub Menu*/
  $offCanvasNavSubMenu.slideUp();

  /*Category Sub Menu Toggle*/
  $offCanvasNav.on(
    "click",
    "li a, li .mobile-menu-expand, li .menu-title",
    function (e) {
      var $this = $(this);
      if ($this.parent().attr("class")) {
        if (
          $this
            .parent()
            .attr("class")
            .match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/) &&
          ($this.attr("href") === "#" || $this.hasClass("mobile-menu-expand"))
        ) {
          e.preventDefault();
          if ($this.siblings("ul:visible").length) {
            $this.parent("li").removeClass("active-expand");
            $this.siblings("ul").slideUp();
          } else {
            $this.parent("li").addClass("active-expand");
            $this.closest("li").siblings("li").find("ul:visible").slideUp();
            $this.closest("li").siblings("li").removeClass("active-expand");
            $this.siblings("ul").slideDown();
          }
        }
      }
    }
  );

  $(".sub-menu").parent("li").addClass("menu-item-has-children");

  /*--
        Testimonial
    -----------------------------------*/

  var swiper = new Swiper(".testimonial-active .swiper-container", {
    speed: 600,
    pagination: {
      el: ".testimonial-active .swiper-pagination",
      clickable: true,
    },
    autoplay: {
      delay: 2000,
    },
    loop: true,
    slidesPerView: 1,
  });

  /*--
        Brand
    -----------------------------------*/
  var edule = new Swiper(".brand-active .swiper-container", {
    speed: 600,
    spaceBetween: 30,
    loop: true,
    autoplay: {
      delay: 2000,
    },
    loop: true,
    slidesPerView: 4,
    breakpoints: {
      0: {
        slidesPerView: 2,
        spaceBetween: 20,
      },
      576: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 3,
      },
      992: {
        slidesPerView: 4,
      },
      1200: {
        slidesPerView: 4,
        spaceBetween: 110,
      },
    },
    autoplay: {
      delay: 8000,
    },
  });

  /*--
        Product Details
    -----------------------------------*/

  var swiper = new Swiper(".product-details-active .swiper-container", {
    speed: 600,
    loop: true,
    navigation: {
      nextEl: ".product-details-active .swiper-button-next",
      prevEl: ".product-details-active .swiper-button-prev",
    },
  });

  /*--
        Product Quick View
    -----------------------------------*/

  var swiper = new Swiper(".product-quickview-active .swiper-container", {
    speed: 600,
    loop: true,
    navigation: {
      nextEl: ".product-quickview-active .swiper-button-next",
      prevEl: ".product-quickview-active .swiper-button-prev",
    },
  });

  /*--
        Back to top Script
    -----------------------------------*/
  // Show or hide the sticky footer button
  $(window).on("scroll", function (event) {
    if ($(this).scrollTop() > 600) {
      $(".back-to-top").fadeIn(200);
    } else {
      $(".back-to-top").fadeOut(200);
    }
  });

  //Animate the scroll to yop
  $(document).on('click','.back-to-top',function () {
    $("html, body").animate({ scrollTop: 0 });
    return false;
  });

  /*--
        tooltipList
    -----------------------------------*/
  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-bs-tooltip="tooltip"]')
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  /*--
        Price Range Activation
    -----------------------------------*/
  $("#slider-range").slider({
    range: true,
    min: 0,
    max: 700,
    values: [20, 500],
    slide: function (event, ui) {
      $("#amount").val("$" + ui.values[0] + "- $" + ui.values[1]);
    },
  });
  $("#amount").val(
    "$" +
      $("#slider-range").slider("values", 0) +
      "- $" +
      $("#slider-range").slider("values", 1)
  );

  /*--
        Product Quantity Activation
    -----------------------------------*/
  $(".add").on("click", function () {
    if ($(this).prev().val()) {
      $(this)
        .prev()
        .val(+$(this).prev().val() + 1);
    }
  });
  $(".sub").on("click", function () {
    if ($(this).next().val() > 1) {
      if ($(this).next().val() > 1)
        $(this)
          .next()
          .val(+$(this).next().val() - 1);
    }
  });

  /*--
        Rating Script
    -----------------------------------*/

  $("#rating li").on("mouseover", function () {
    var onStar = parseInt($(this).data("value"), 10);
    var siblings = $(this).parent().children("li.star");
    Array.from(siblings, function (item) {
      var value = item.dataset.value;
      var child = item.firstChild;
      if (value <= onStar) {
        child.classList.add("hover");
      } else {
        child.classList.remove("hover");
      }
    });
  });

  $("#rating").on("mouseleave", function () {
    var child = $(this).find("li.star i");
    Array.from(child, function (item) {
      item.classList.remove("hover");
    });
  });

  $("#rating li").on("click", function (e) {
    var onStar = parseInt($(this).data("value"), 10);
    var siblings = $(this).parent().children("li.star");
    Array.from(siblings, function (item) {
      var value = item.dataset.value;
      var child = item.firstChild;
      if (value <= onStar) {
        child.classList.remove("hover", "hover");
        child.classList.add("star");
      } else {
        child.classList.remove("star");
        child.classList.add("hover");
      }
    });
  });

  /*--
        select2
    -----------------------------------*/
  $(".select2").select2({
    tags: true,
  });

  /*--
        Checkout Account Active
    -----------------------------------*/
  $("#account").on("click", function () {
    if ($("#account:checked").length > 0) {
      $(".checkout-account").slideDown();
    } else {
      $(".checkout-account").slideUp();
    }
  });

  /*--
        Checkout Shipping Active
    -----------------------------------*/
  $("#shipping").on("click", function () {
    if ($("#shipping:checked").length > 0) {
      $(".checkout-shipping").slideDown();
    } else {
      $(".checkout-shipping").slideUp();
    }
  });

  /*--
        Checkout Payment Active
    -----------------------------------*/
  var checked = $(".payment-radio input:checked");
  if (checked) {
    $(checked).siblings(".payment-details").slideDown(500);
  }
  $(".payment-radio input").on("change", function () {
    $(".payment-details").slideUp(500);
    $(this).siblings(".payment-details").slideToggle(500);
  });

  /*--
        AOS Scroll Animation
    -----------------------------------*/
  AOS.init({
    once: true,
    duration: 1500,
  });

  /*--
    Validation
    -----------------------------------*/

  $("#form_register").validate({
    rules: {
      nmlgkp: {
        required: true,
      },
      almtlgkp: {
        required: true,
      },
      nohp: {
        required: true,
        digits: true,
      },
      email: {
        required: true,
      },
      password: {
        required: true,
        minlength: 6,
      },
      tmplhr: {
        required: true,
      },
      tgllhr: {
        required: true,
      },
    },
    messages: {
      nmlgkp: {
        required: "Masukkan Nama lengkap anda.",
      },
      almtlgkp: {
        required: "Masukkan Alamat lengkap anda.",
      },
      nohp: {
        required: "Masukkan No. HP anda.",
        digits: "No. HP tidak valid.",
      },
      email: {
        required: "Masukkan Alamat email anda.",
        email: "Email tidak valid.",
      },
      password: {
        required: "Masukkan Password anda.",
        minlength: "Minimal 6 karakter.",
      },
      tmplhr: {
        required: "Masukkan Tempat lahir anda.",
      },
      tgllhr: {
        required: "Masukkan Tanggal lahir anda.",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
    errorPlacement: function (label, element) {
      label.addClass("error");
      element.parent(".single-form").find("input").after(label);
    },
  });

  $("#form_login").validate({
    rules: {
      email: {
        required: true,
      },
      password: {
        required: true,
        minlength: 6,
      },
    },
    messages: {
      email: {
        required: "Masukkan Alamat email anda.",
        email: "Email tidak valid.",
      },
      password: {
        required: "Masukkan Password anda.",
        minlength: "Minimal 6 karakter.",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
    errorPlacement: function (label, element) {
      label.addClass("error");
      element.parent(".single-form").find("input").after(label);
    },
  });

  $("#form_forgot").validate({
    rules: {
      email: {
        required: true,
      },
    },
    messages: {
      email: {
        required: "Masukkan Alamat email anda.",
        email: "Email tidak valid.",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
    errorPlacement: function (label, element) {
      label.addClass("error");
      element.parent(".single-form").find("input").after(label);
    },
  });

  $("#form_reset_password").validate({
    rules: {
      password: {
        required: true,
        minlength: 6,
      },
    },
    messages: {
      password: {
        required: "Masukkan Password anda.",
        minlength: "Minimal 6 karakter.",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
    errorPlacement: function (label, element) {
      label.addClass("error");
      element.parent(".single-form").find(".form-control").after(label);
    },
  });

  $("#form_profile").validate({
    ignore: "",
    rules: {
      nmlgkp: {
        required: true,
      },
      almtlgkp: {
        required: true,
      },
      nohp: {
        required: true,
        digits: true,
      },
      email: {
        required: true,
      },
      password: {
        required: true,
        minlength: 6,
      },
      tmplhr: {
        required: true,
      },
      tgllhr: {
        required: true,
      },
    },
    messages: {
      nmlgkp: {
        required: "Masukkan Nama lengkap anda.",
      },
      almtlgkp: {
        required: "Masukkan Alamat lengkap anda.",
      },
      nohp: {
        required: "Masukkan No. HP anda.",
        digits: "No. HP tidak valid.",
      },
      email: {
        required: "Masukkan Alamat email anda.",
        email: "Email tidak valid.",
      },
      password: {
        required: "Masukkan Password anda.",
        minlength: "Minimal 6 karakter.",
      },
      tmplhr: {
        required: "Masukkan Tempat lahir anda.",
      },
      tgllhr: {
        required: "Masukkan Tanggal lahir anda.",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
    errorPlacement: function (label, element) {
      label.addClass("error");
      element.parent(".single-form").find(".form-validate").after(label);
    },
  });

  $("#form_checkout").validate({
    ignore: "",
    rules: {
      nmlgkp: {
        required: true,
      },
      almtlgkp: {
        required: true,
      },
      nohp: {
        required: true,
        digits: true,
      },
      email: {
        required: true,
      },
      notes: {
        required: true,
      },
    },
    messages: {
      nmlgkp: {
        required: "Masukkan Nama lengkap anda.",
      },
      almtlgkp: {
        required: "Masukkan Alamat lengkap anda.",
      },
      nohp: {
        required: "Masukkan No. HP anda.",
        digits: "No. HP tidak valid.",
      },
      email: {
        required: "Masukkan Alamat email anda.",
        email: "Email tidak valid.",
      },
      notes: {
        required: "Silahkan masukkan keterangan.",
      },
    },
    submitHandler: function (form) {
      form.submit();
    },
    errorPlacement: function (label, element) {
      label.addClass("error");
      element.parent(".single-form").find(".form-validate").after(label);
    },
  });

  jQuery.validator.addMethod("checksize", function (val, element) {
    var size = element.files[0].size;
    console.log(size);

    if (size > 2 * 1048576) {
      // checks the file more than 1 MB
      console.log("returning false");
      return false;
    } else {
      console.log("returning true");
      return true;
    }
  });

  $(".form-confirmation input[name=xfoto]").each(function () {
    $(".custom-file-input").on("change", function () {
      var fileName = this.files[0].name.split(".")[0];
      $(this).next(".form-control-file").addClass("selected").html(fileName);
    });
  });

  $(".modal form").each(function () {
    $(this).validate({
      rules: {
        xfoto: {
          required: true,
          checksize: true,
        },
        tgltransfer: {
          required: true,
        },
      },
      messages: {
        xfoto: {
          required: "Pilih gambar bukti transfer anda.",
          checksize: "File terlalu besar, maksimal 1 MB .",
        },
        tgltransfer: {
          required: "Masukkan tanggal transfer anda.",
        },
      },
      submitHandler: function (form) {
        form.submit();
      },
      errorPlacement: function (label, element) {
        label.addClass("error error-upload");
        element.parents(".over-hidden").before(label);
      },
    });
  });

  $(".product-quantity .add").on("click", function () {
    var val = $(this).closest(".product-quantity").find("input").val();
    var max = $(this).closest(".product-quantity").find("input").attr("max");

    if (val == max) {
      $(".product-quantity .add").css("pointer-events", "none");
      $(".product-quantity .add").addClass("disable");
    } else {
      $(".product-quantity .add").css("pointer-events", "auto");
      $(".product-quantity .add").removeClass("disable");
    }
  });

  $(".product-quantity .sub").on("click", function () {
    var val = $(this).closest(".product-quantity").find("input").val();
    var max = $(this).closest(".product-quantity").find("input").attr("max");

    if (val == max) {
      $(".product-quantity .add").css("pointer-events", "none");
      $(".product-quantity .add").addClass("disable");
    } else {
      $(".product-quantity .add").css("pointer-events", "auto");
      $(".product-quantity .add").removeClass("disable");
    }
  });

  $(document).on("show.bs.modal", ".modal", function () {
    var val = $(this).find("input").val();
    var max = $(this).find("input").attr("max");
    if (val == max) {
      $(".product-quantity .add").css("pointer-events", "none");
      $(".product-quantity .add").addClass("disable");
      $(".product-quantity .sub").css("pointer-events", "none");
      $(".product-quantity .sub").addClass("disable");
    } else {
      $(".product-quantity .add").css("pointer-events", "auto");
      $(".product-quantity .add").removeClass("disable");
      $(".product-quantity .sub").css("pointer-events", "auto");
      $(".product-quantity .sub").removeClass("disable");
    }
  });

  /*--
    Particle
    -----------------------------------*/

  var particles = document.getElementById("particles-js");

  if ($(particles).length > 0) {
    particlesJS("particles-js", {
      particles: {
        number: {
          value: 100,
          density: {
            enable: true,
            value_area: 800,
          },
        },
        color: {
          value: "#35185a",
        },
        shape: {
          type: "circle",
          stroke: {
            width: 0,
            color: "#000000",
          },
          polygon: {
            nb_sides: 5,
          },
          image: {
            src: "img/github.svg",
            width: 100,
            height: 100,
          },
        },
        opacity: {
          value: 0.5,
          random: false,
          anim: {
            enable: false,
            speed: 1,
            opacity_min: 0.1,
            sync: false,
          },
        },
        size: {
          value: 4,
          random: true,
          anim: {
            enable: false,
            speed: 40,
            size_min: 0.1,
            sync: false,
          },
        },
        line_linked: {
          enable: true,
          distance: 150,
          color: "#35185a",
          opacity: 0.4,
          width: 1,
        },
        move: {
          enable: true,
          speed: 6,
          direction: "none",
          random: false,
          straight: false,
          out_mode: "out",
          bounce: false,
          attract: {
            enable: false,
            rotateX: 600,
            rotateY: 1200,
          },
        },
      },
      interactivity: {
        detect_on: "canvas",
        events: {
          onhover: {
            enable: false,
            mode: "repulse",
          },
          onclick: {
            enable: false,
            mode: "push",
          },
          resize: true,
        },
        modes: {
          grab: {
            distance: 800,
            line_linked: {
              opacity: 1,
            },
          },
          bubble: {
            distance: 800,
            size: 80,
            duration: 2,
            opacity: 0.8,
            speed: 3,
          },
          repulse: {
            distance: 400,
            duration: 0.4,
          },
          push: {
            particles_nb: 4,
          },
          remove: {
            particles_nb: 2,
          },
        },
      },
      retina_detect: true,
    });
  } else {
    var particles = null;
  }
})(jQuery);
