// =================select kg===============

 document.addEventListener("DOMContentLoaded", function() {
  // Loop through each dropdown
  var dropdownToggles = document.querySelectorAll(".dropdown-toggle");
  dropdownToggles.forEach(function(dropdownToggle) {
    var dropdownMenu = dropdownToggle.nextElementSibling; // Assuming dropdown menu follows immediately after the toggle

    dropdownToggle.addEventListener("click", function() {
      var expanded = dropdownToggle.getAttribute("aria-expanded") === "true" || false;
      dropdownToggle.setAttribute("aria-expanded", !expanded);
      dropdownMenu.style.display = expanded ? "none" : "block";
    });

    // Handle click on options
    dropdownMenu.addEventListener("click", function(event) {
      var target = event.target;
      if (target.nodeName === "DIV" && target.classList.contains("kg_name")) {
        dropdownToggle.innerText = target.innerText;
        dropdownMenu.style.display = "none";
        dropdownToggle.setAttribute("aria-expanded", "false");
      }
    });
  });

  // Hide dropdown when clicking outside
  document.addEventListener("click", function(event) {
    dropdownToggles.forEach(function(dropdownToggle) {
      var dropdownMenu = dropdownToggle.nextElementSibling;
      var isClickInsideDropdown = dropdownToggle.contains(event.target) || dropdownMenu.contains(event.target);
      if (!isClickInsideDropdown) {
        dropdownMenu.style.display = "none";
        dropdownToggle.setAttribute("aria-expanded", "false");
      }
    });
  });
});
// =================select kg end===============


// =========grid product ad=============
        function ad_btn(product_id){
            const gridProductGroup = document.querySelector('#grid_product_group'+product_id);
            gridProductGroup.style.transform = 'translateY(-700px)';
        }

        function ad_closed(product_id){
            const gridProductGroup = document.querySelector('#grid_product_group'+product_id);
            gridProductGroup.style.transform = 'translateY(0px)';
        }

    // const adBtn = document.querySelector('.ad_btn');
    // const adClosed = document.querySelector('.ad_closed');
    // const gridProductGroup = document.querySelector('.grid_product_group');

    // adBtn.addEventListener('click', () => {
        
    //     gridProductGroup.style.transform = 'translateY(-700px)';
    // });

    // adClosed.addEventListener('click', () => {
    //     gridProductGroup.style.transform = 'translateY(0px)';
    // });


(function ($) {
    ("use strict");
    // Page loading
    $(window).on("load", function () {
        $("#preloader-active").delay(450).fadeOut("slow");
        $("body").delay(450).css({
            overflow: "visible"
        });
        $("#onloadModal").modal("show");
    });
    /*-----------------
        Menu Stick
    -----------------*/
    // var header = $(".sticky-bar");
    // var win = $(window);
    // win.on("scroll", function () {
    //     var scroll = win.scrollTop();
    //     if (scroll < 200) {
    //         header.removeClass("stick");
    //         $(".header-style-2 .categories-dropdown-active-large").removeClass("open");
    //         $(".header-style-2 .categories-button-active").removeClass("open");
    //     } else {
    //         header.addClass("stick");
    //     }
    // });


var header = $(".sticky-bar");
var win = $(window);
var catElement = $(".cat");
 
// Default styles for .cat
var defaultCatStyles = {
    position: "absolute",
    bottom: "10px",
    zIndex: "1",
    width: "280px"
};
 
// Apply default styles for .cat on page load
catElement.css(defaultCatStyles);
 
win.on("scroll", function () {
    var scroll = win.scrollTop();
    if (scroll < 200) {
        header.removeClass("stick");
        $(".header-style-2 .categories-dropdown-active-large").removeClass("open");
        $(".header-style-2 .categories-button-active").removeClass("open");
 
        // Show desk_logo and location when not sticky
        $(".desk_logo").show();
        $(".location").show();
 
        // Reset styles for .cat when not sticky
        catElement.css(defaultCatStyles);
    } else {
        header.addClass("stick");
 
        // Hide desk_logo and location when sticky
        $(".desk_logo").hide();
        $(".location").hide();
 
        // Apply different styles for .cat when sticky
        catElement.css({
            position: "relative",
            bottom: "0px",
            zIndex: "1",
            width: "280px"
        });
    }
});






    /*------ ScrollUp -------- */
    $.scrollUp({
        scrollText: '<i class="fi-rs-arrow-small-up"></i>',
        easingType: "linear",
        scrollSpeed: 900,
        animation: "fade"
    });

    /*------ Wow Active ----*/
    new WOW().init();

    //sidebar sticky
    // if ($(".sticky-sidebar").length) {
    //     $(".sticky-sidebar").theiaStickySidebar();
    // }

    // Slider Range JS
    if ($("#slider-range").length) {
        $(".noUi-handle").on("click", function () {
            $(this).width(50);
        });
        var rangeSlider = document.getElementById("slider-range");
        var moneyFormat = wNumb({
            decimals: 0,
            thousand: ",",
            prefix: "$"
        });
        noUiSlider.create(rangeSlider, {
            start: [500, 1000],
            step: 1,
            range: {
                min: [0],
                max: [2000]
            },
            format: moneyFormat,
            connect: true
        });

        // Set visual min and max values and also update value hidden form inputs
        rangeSlider.noUiSlider.on("update", function (values, handle) {
            document.getElementById("slider-range-value1").innerHTML = values[0];
            document.getElementById("slider-range-value2").innerHTML = values[1];
            document.getElementsByName("min-value").value = moneyFormat.from(values[0]);
            document.getElementsByName("max-value").value = moneyFormat.from(values[1]);
        });
    }

    /*------ Hero slider 1 ----*/
    $(".hero-slider-1").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        fade: true,
        loop: true,
        dots: true,
        arrows: true,
        prevArrow: '<span class="slider-btn slider-prev"><span class="material-symbols-outlined">chevron_left</span></span>',
        nextArrow: '<span class="slider-btn slider-next"><span class="material-symbols-outlined">chevron_right</span></span>',
        appendArrows: ".hero-slider-1-arrow",
        autoplay: true
    });

    /*Carausel 8 columns*/
    $(".carausel-8-columns").each(function (key, item) {
        var id = $(this).attr("id");
        var sliderID = "#" + id;
        var appendArrowsClassName = "#" + id + "-arrows";

        $(sliderID).slick({
            dots: false,
            infinite: true,
            speed: 1000,
            arrows: true,
            autoplay: true,
            slidesToShow: 8,
            slidesToScroll: 1,
            loop: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-small-left"></i></span>',
            nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-arrow-small-right"></i></span>',
            appendArrows: appendArrowsClassName
        });
    });


   $(".carausel-707-columns").each(function (key, item) {
        var id = $(this).attr("id");
        var sliderID = "#" + id;
        var appendArrowsClassName = "#" + id + "-arrows";

        $(sliderID).slick({
            dots: false,
            infinite: true,
            speed: 1000,
            arrows: true,
            autoplay: true,
            slidesToShow: 4,
            slidesToScroll: 1,
            loop: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-small-left"></i></span>',
            nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-arrow-small-right"></i></span>',
            appendArrows: appendArrowsClassName
        });
    });


  $(".carausel-708-columns").each(function (key, item) {
        var id = $(this).attr("id");
        var sliderID = "#" + id;
        var appendArrowsClassName = "#" + id + "-arrows";

        $(sliderID).slick({
            dots: false,
            infinite: true,
            speed: 1000,
            arrows: true,
            autoplay: false,
            slidesToShow: 4,
            slidesToScroll: 1,
            loop: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-small-left"></i></span>',
            nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-arrow-small-right"></i></span>',
            appendArrows: appendArrowsClassName
        });
    });

    /*Carausel 10 columns*/
    $(".carausel-10-columns").each(function (key, item) {
        var id = $(this).attr("id");
        var sliderID = "#" + id;
        var appendArrowsClassName = "#" + id + "-arrows";

        $(sliderID).slick({
            dots: false,
            infinite: true,
            speed: 1000,
            arrows: true,
            autoplay: false,
            slidesToShow: 10,
            slidesToScroll: 1,
            loop: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-small-left"></i></span>',
            nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-arrow-small-right"></i></span>',
            appendArrows: appendArrowsClassName
        });
    });


 


    /*Carausel 4 columns*/
    $(".carausel-4-columns").each(function (key, item) {
        var id = $(this).attr("id");
        var sliderID = "#" + id;
        var appendArrowsClassName = "#" + id + "-arrows";

        $(sliderID).slick({
            dots: false,
            infinite: false,
            speed: 1000,
            arrows: true,
            autoplay: false,
            slidesToShow: 5,
            slidesToScroll: 1,
            loop: true,
            adaptiveHeight: true,
             // wrap: false,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-small-left"></i></span>',
            nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-arrow-small-right"></i></span>',
            appendArrows: appendArrowsClassName
        });
    });
    /*Carausel 4 columns*/
    $(".carausel-3-columns").each(function (key, item) {
        var id = $(this).attr("id");
        var sliderID = "#" + id;
        var appendArrowsClassName = "#" + id + "-arrows";

        $(sliderID).slick({
            dots: false,
            infinite: true,
            speed: 1000,
            arrows: true,
            autoplay: true,
            slidesToShow: 3,
            slidesToScroll: 1,
            loop: true,
            adaptiveHeight: true,
            responsive: [
                {
                    breakpoint: 1025,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 3
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 1,
                        slidesToScroll: 1
                    }
                }
            ],
            prevArrow: '<span class="slider-btn slider-prev"><i class="fi-rs-arrow-small-left"></i></span>',
            nextArrow: '<span class="slider-btn slider-next"><i class="fi-rs-arrow-small-right"></i></span>',
            appendArrows: appendArrowsClassName
        });
    });

    /*Fix Bootstrap 5 tab & slick slider*/

    $('button[data-bs-toggle="tab"]').on("shown.bs.tab", function (e) {
        $(".carausel-4-columns").slick("setPosition");
    });

    /*------ Timer Countdown ----*/

    $("[data-countdown]").each(function () {
        var $this = $(this),
            finalDate = $(this).data("countdown");
        $this.countdown(finalDate, function (event) {
            $(this).html(event.strftime("" + '<span class="countdown-section"><span class="countdown-amount hover-up">%D</span><span class="countdown-period"> days </span></span>' + '<span class="countdown-section"><span class="countdown-amount hover-up">%H</span><span class="countdown-period"> hours </span></span>' + '<span class="countdown-section"><span class="countdown-amount hover-up">%M</span><span class="countdown-period"> mins </span></span>' + '<span class="countdown-section"><span class="countdown-amount hover-up">%S</span><span class="countdown-period"> sec </span></span>'));
        });
    });

    /*------ Product slider active 1 ----*/
    $(".product-slider-active-1").slick({
        slidesToShow: 5,
        slidesToScroll: 1,
        autoplay: true,
        fade: false,
        loop: true,
        dots: false,
        arrows: true,
        prevArrow: '<span class="pro-icon-1-prev"><i class="fi-rs-angle-small-left"></i></span>',
        nextArrow: '<span class="pro-icon-1-next"><i class="fi-rs-angle-small-right"></i></span>',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    /*------ Testimonial active 1 ----*/
    $(".testimonial-active-1").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        fade: false,
        loop: true,
        dots: false,
        arrows: true,
        prevArrow: '<span class="pro-icon-1-prev"><i class="fi-rs-angle-small-left"></i></span>',
        nextArrow: '<span class="pro-icon-1-next"><i class="fi-rs-angle-small-right"></i></span>',
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    /*------ Testimonial active 3 ----*/
    $(".testimonial-active-3").slick({
        slidesToShow: 3,
        slidesToScroll: 1,
        fade: false,
        loop: true,
        dots: true,
        arrows: false,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 1
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    /*------ Categories slider 1 ----*/
    $(".categories-slider-1").slick({
        slidesToShow: 6,
        slidesToScroll: 1,
        fade: false,
        loop: true,
        dots: false,
        arrows: false,
        responsive: [
            {
                breakpoint: 1199,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 2
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 1
                }
            }
        ]
    });

    /*----------------------------
        Category toggle function
    ------------------------------*/
    // var searchToggle = $(".categories-button-active");
    // searchToggle.on("click", function (e) {
    //     e.preventDefault();
    //     if ($(this).hasClass("open")) {
    //         $(this).removeClass("open");
    //         $(this).siblings(".categories-dropdown-active-large").removeClass("open");
    //     } else {
    //         $(this).addClass("open");
    //         $(this).siblings(".categories-dropdown-active-large").addClass("open");
    //     }
    // });



 var searchToggle = $(".categories-button-active");
    // Click event for the searchToggle
    searchToggle.on("click", function (e) {
        e.preventDefault();
        e.stopPropagation(); // Stop the click event from propagating to the body
 
        if ($(this).hasClass("open")) {
            $(this).removeClass("open");
            $(this).siblings(".categories-dropdown-active-large").removeClass("open");
        } else {
            $(this).addClass("open");
            $(this).siblings(".categories-dropdown-active-large").addClass("open");
        }
    });
 
    // Click event for the body to remove the class
    $('body').on("click", function (e) {
        if (!$(e.target).closest('.categories-button-active').length) {
            // Clicked outside the searchToggle, remove the class
            searchToggle.removeClass("open");
            searchToggle.siblings(".categories-dropdown-active-large").removeClass("open");
        }
    });

    /*-------------------------------
        Sort by active
    -----------------------------------*/
    if ($(".sort-by-product-area").length) {
        var $body = $("body"),
            $cartWrap = $(".sort-by-product-area"),
            $cartContent = $cartWrap.find(".sort-by-dropdown");
        $cartWrap.on("click", ".sort-by-product-wrap", function (e) {
            e.preventDefault();
            var $this = $(this);
            if (!$this.parent().hasClass("show")) {
                $this.siblings(".sort-by-dropdown").addClass("show").parent().addClass("show");
            } else {
                $this.siblings(".sort-by-dropdown").removeClass("show").parent().removeClass("show");
            }
        });
        /*Close When Click Outside*/
        $body.on("click", function (e) {
            var $target = e.target;
            if (!$($target).is(".sort-by-product-area") && !$($target).parents().is(".sort-by-product-area") && $cartWrap.hasClass("show")) {
                $cartWrap.removeClass("show");
                $cartContent.removeClass("show");
            }
        });
    }

    /*-----------------------
        Shop filter active
    ------------------------- */
    $(".shop-filter-toogle").on("click", function (e) {
    e.preventDefault();
    $(this).next(".shop-product-fillter-header").slideToggle();
    $(this).toggleClass("active");
    });


    /*-------------------------------------
        Product details big image slider
    ---------------------------------------*/
    $(".pro-dec-big-img-slider").slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: false,
        draggable: false,
        fade: false,
        asNavFor: ".product-dec-slider-small , .product-dec-slider-small-2"
    });

    /*---------------------------------------
        Product details small image slider
    -----------------------------------------*/
    $(".product-dec-slider-small").slick({
        slidesToShow: 4,
        slidesToScroll: 1,
        asNavFor: ".pro-dec-big-img-slider",
        dots: false,
        focusOnSelect: true,
        fade: false,
        arrows: false,
        responsive: [
            {
                breakpoint: 991,
                settings: {
                    slidesToShow: 3
                }
            },
            {
                breakpoint: 767,
                settings: {
                    slidesToShow: 4
                }
            },
            {
                breakpoint: 575,
                settings: {
                    slidesToShow: 2
                }
            }
        ]
    });

    /*-----------------------
        Magnific Popup
    ------------------------*/
    $(".img-popup").magnificPopup({
        type: "image",
        gallery: {
            enabled: true
        }
    });

    $('.btn-close').on('click', function(e) {
        $('.zoomContainer').remove();
    });

    $('#quickViewModal').on('show.bs.modal', function (e) {
        $(document).click(function (e) {
            var modalDialog = $('.modal-dialog');
            if (!modalDialog.is(e.target) && modalDialog.has(e.target).length === 0) {
                $('.zoomContainer').remove();
            }
        });
    });



    /*---------------------
        Select active
    --------------------- */
    $(".select-active").select2();

    /*--- Checkout toggle function ----*/
    $(".checkout-click1").on("click", function (e) {
        e.preventDefault();
        $(".checkout-login-info").slideToggle(900);
    });

    /*--- Checkout toggle function ----*/
    $(".checkout-click3").on("click", function (e) {
        e.preventDefault();
        $(".checkout-login-info3").slideToggle(1000);
    });

    /*-------------------------
        Create an account toggle
    --------------------------*/
    $(".checkout-toggle2").on("click", function () {
        $(".open-toggle2").slideToggle(1000);
    });

    $(".checkout-toggle").on("click", function () {
        $(".open-toggle").slideToggle(1000);
    });

    /*-------------------------------------
        Checkout paymentMethod function
    ---------------------------------------*/
    paymentMethodChanged();
    function paymentMethodChanged() {
        var $order_review = $(".payment-method");

        $order_review.on("click", 'input[name="payment_method"]', function () {
            var selectedClass = "payment-selected";
            var parent = $(this).parents(".sin-payment").first();
            parent.addClass(selectedClass).siblings().removeClass(selectedClass);
        });
    }

    /*---- CounterUp ----*/
    $(".count").counterUp({
        delay: 10,
        time: 2000
    });

    // Isotope active
    $(".grid").imagesLoaded(function () {
        // init Isotope
        var $grid = $(".grid").isotope({
            itemSelector: ".grid-item",
            percentPosition: true,
            layoutMode: "masonry",
            masonry: {
                // use outer width of grid-sizer for columnWidth
                columnWidth: ".grid-item"
            }
        });
    });

    /*====== SidebarSearch ======*/
    function sidebarSearch() {
        var searchTrigger = $(".search-active"),
            endTriggersearch = $(".search-close"),
            container = $(".main-search-active");

        searchTrigger.on("click", function (e) {
            e.preventDefault();
            container.addClass("search-visible");
        });

        endTriggersearch.on("click", function () {
            container.removeClass("search-visible");
        });
    }
    sidebarSearch();

    /*====== Sidebar menu Active ======*/
    function mobileHeaderActive() {
        var navbarTrigger = $(".burger-icon"),
            endTrigger = $(".mobile-menu-close"),
            container = $(".mobile-header-active"),
            wrapper4 = $("body");

        wrapper4.prepend('<div class="body-overlay-1"></div>');

        navbarTrigger.on("click", function (e) {
            e.preventDefault();
            container.addClass("sidebar-visible");
            wrapper4.addClass("mobile-menu-active");
        });

        endTrigger.on("click", function () {
            container.removeClass("sidebar-visible");
            wrapper4.removeClass("mobile-menu-active");
        });

        $(".body-overlay-1").on("click", function () {
            container.removeClass("sidebar-visible");
            wrapper4.removeClass("mobile-menu-active");
        });
    }
    mobileHeaderActive();

    /*---------------------
        Mobile menu active
    ------------------------ */
    var $offCanvasNav = $(".mobile-menu"),
        $offCanvasNavSubMenu = $offCanvasNav.find(".dropdown");

    /*Add Toggle Button With Off Canvas Sub Menu*/
    $offCanvasNavSubMenu.parent().prepend('<span class="menu-expand"><i class="fi-rs-angle-small-down"></i></span>');

    /*Close Off Canvas Sub Menu*/
    $offCanvasNavSubMenu.slideUp();

    /*Category Sub Menu Toggle*/
    $offCanvasNav.on("click", "li a, li .menu-expand", function (e) {
        var $this = $(this);
        if (
            $this
                .parent()
                .attr("class")
                .match(/\b(menu-item-has-children|has-children|has-sub-menu)\b/) &&
            ($this.attr("href") === "#" || $this.hasClass("menu-expand"))
        ) {
            e.preventDefault();
            if ($this.siblings("ul:visible").length) {
                $this.parent("li").removeClass("active");
                $this.siblings("ul").slideUp();
            } else {
                $this.parent("li").addClass("active");
                $this.closest("li").siblings("li").removeClass("active").find("li").removeClass("active");
                $this.closest("li").siblings("li").find("ul:visible").slideUp();
                $this.siblings("ul").slideDown();
            }
        }
    });

    /*--- language currency active ----*/
    $(".mobile-language-active").on("click", function (e) {
        e.preventDefault();
        $(".lang-dropdown-active").slideToggle(900);
    });

    /*--- categories-button-active-2 ----*/
    $(".categories-button-active-2").on("click", function (e) {
        e.preventDefault();
        $(".categori-dropdown-active-small").slideToggle(900);
    });

    /*--- Mobile demo active ----*/
    var demo = $(".tm-demo-options-wrapper");
    $(".view-demo-btn-active").on("click", function (e) {
        e.preventDefault();
        demo.toggleClass("demo-open");
    });

    /*-----More Menu Open----*/
    $(".more_slide_open").slideUp();
    $(".more_categories").on("click", function () {
        $(this).toggleClass("show");
        $(".more_slide_open").slideToggle();
    });

    /*-----Modal----*/

    $(".modal").on("shown.bs.modal", function (e) {
        $(".product-image-slider").slick("setPosition");
        $(".slider-nav-thumbnails").slick("setPosition");
        if ($(window).width() > 768) {
            $(".product-image-slider .slick-active img").elevateZoom({
                zoomType: "inner",
                cursor: "crosshair",
                zoomWindowFadeIn: 500,
                zoomWindowFadeOut: 750
            });
        }
    });

    /*--- VSticker ----*/
    $("#news-flash").vTicker({
        speed: 500,
        pause: 3000,
        animation: "fade",
        mousePause: false,
        showItems: 1
    });
})(jQuery);


    document.addEventListener('DOMContentLoaded', function () {
        // Daily Best Sells
        var dailyTabsContainer = document.getElementById('daily-myTab-3');
        var dailyScrollLeftBtn = document.getElementById('daily-scroll-left-btn');
        var dailyScrollRightBtn = document.getElementById('daily-scroll-right-btn');

        // Hide the initial left arrow
        dailyScrollLeftBtn.disabled = true;

        dailyScrollLeftBtn.addEventListener('click', function () {
            dailyTabsContainer.scrollBy({
                left: -200, // Adjust the scroll amount as needed
                behavior: 'smooth',
            });

            // Hide the left arrow if scrolled to the beginning
            dailyScrollLeftBtn.disabled = dailyTabsContainer.scrollLeft === 0;
            // Always enable the right arrow after clicking the left arrow
            dailyScrollRightBtn.disabled = false;
        });

        dailyScrollRightBtn.addEventListener('click', function () {
            dailyTabsContainer.scrollBy({
                left: 200, // Adjust the scroll amount as needed
                behavior: 'smooth',
            });

            // Always enable the left arrow after clicking the right arrow
            dailyScrollLeftBtn.disabled = false;
        });

        // Check if tabs are scrollable initially
        if (dailyTabsContainer.scrollWidth > dailyTabsContainer.clientWidth) {
            // If scrollable, enable the right arrow
            dailyScrollRightBtn.disabled = false;
        } else {
            // If not scrollable, disable both arrows
            dailyScrollRightBtn.disabled = true;
        }

        // Popular Products
        var popularTabsContainer = document.getElementById('popular-myTab-3');
        var popularScrollLeftBtn = document.getElementById('popular-scroll-left-btn');
        var popularScrollRightBtn = document.getElementById('popular-scroll-right-btn');

        // Hide the initial left arrow
        popularScrollLeftBtn.disabled = true;

        popularScrollLeftBtn.addEventListener('click', function () {
            popularTabsContainer.scrollBy({
                left: -200, // Adjust the scroll amount as needed
                behavior: 'smooth',
            });

            // Hide the left arrow if scrolled to the beginning
            popularScrollLeftBtn.disabled = popularTabsContainer.scrollLeft === 0;
            // Always enable the right arrow after clicking the left arrow
            popularScrollRightBtn.disabled = false;
        });

        popularScrollRightBtn.addEventListener('click', function () {
            popularTabsContainer.scrollBy({
                left: 200, // Adjust the scroll amount as needed
                behavior: 'smooth',
            });

            // Always enable the left arrow after clicking the right arrow
            popularScrollLeftBtn.disabled = false;
        });

        // Check if tabs are scrollable initially
        if (popularTabsContainer.scrollWidth > popularTabsContainer.clientWidth) {
            // If scrollable, enable the right arrow
            popularScrollRightBtn.disabled = false;
        } else {
            // If not scrollable, disable both arrows
            popularScrollRightBtn.disabled = true;
        }
        
         // Popular Products
        var FeaturedTabsContainer = document.getElementById('featured-myTab-3');
        var FeaturedScrollLeftBtn = document.getElementById('featured-scroll-left-btn');
        var FeaturedScrollRightBtn = document.getElementById('featured-scroll-right-btn');

        // Hide the initial left arrow
        FeaturedScrollLeftBtn.disabled = true;

        FeaturedScrollLeftBtn.addEventListener('click', function () {
            FeaturedTabsContainer.scrollBy({
                left: -200, // Adjust the scroll amount as needed
                behavior: 'smooth',
            });

            // Hide the left arrow if scrolled to the beginning
            FeaturedScrollLeftBtn.disabled = FeaturedTabsContainer.scrollLeft === 0;
            // Always enable the right arrow after clicking the left arrow
            FeaturedScrollRightBtn.disabled = false;
        });

        FeaturedScrollRightBtn.addEventListener('click', function () {
            FeaturedTabsContainer.scrollBy({
                left: 200, // Adjust the scroll amount as needed
                behavior: 'smooth',
            });

            // Always enable the left arrow after clicking the right arrow
            FeaturedScrollLeftBtn.disabled = false;
        });

        // Check if tabs are scrollable initially
        if (FeaturedTabsContainer.scrollWidth > FeaturedTabsContainer.clientWidth) {
            // If scrollable, enable the right arrow
            FeaturedScrollRightBtn.disabled = false;
        } else {
            // If not scrollable, disable both arrows
            FeaturedScrollRightBtn.disabled = true;
        }
    });

//
//Login input
//
const inputs = document.querySelectorAll(".otp-field input");

inputs.forEach((input, index) => {
    input.dataset.index = index;
    input.addEventListener("keyup", handleOtp);
    input.addEventListener("paste", handleOnPasteOtp);
});

function handleOtp(e) {
    /**
     * <input type="text" 👉 maxlength="1" />
     * 👉 NOTE: On mobile devices `maxlength` property isn't supported,
     * So we to write our own logic to make it work. 🙂
     */
    const input = e.target;
    let value = input.value;
    let isValidInput = value.match(/[0-9a-z]/gi);
    input.value = "";
    input.value = isValidInput ? value[0] : "";

    let fieldIndex = input.dataset.index;
    if (fieldIndex < inputs.length - 1 && isValidInput) {
        input.nextElementSibling.focus();
    }

    if (e.key === "Backspace" && fieldIndex > 0) {
        input.previousElementSibling.focus();
    }

    if (fieldIndex == inputs.length - 1 && isValidInput) {
       
    }
}

function handleOnPasteOtp(e) {
    const data = e.clipboardData.getData("text");
    const value = data.split("");
    if (value.length === inputs.length) {
        inputs.forEach((input, index) => (input.value = value[index]));
        
    }
}