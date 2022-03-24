/*global $, alert, console */

$(document).ready(function() {


    /* ===============================  banner_section carousel  =============================== */
    $(".banner_section .owl-carousel").owlCarousel({
        autoplay: true,
        nav: false,
        dots: true,
        loop: true,
        items: 1,
    });

    /* ===============================  our_picks carousel  =============================== */
    $(".our_picks .owl-carousel").owlCarousel({
        autoplay: true,
        nav: true,
        dots: true,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        loop: true,
        responsive: {
            0: { items: 1 },
            576: { items: 2 },
            992: { items: 3 },
            1201: { items: 4 }
        }
    });




    /* ===============================  click on navbar toggler  =============================== */

    $('.navbar-toggler >div').on('click', function() {
        $(this).parent('.navbar-toggler').toggleClass('open');
        $('.sidebar').toggleClass("opened");
        $('.overlay_gen').fadeToggle().on('click', function() {
            $(this).fadeOut();
            $('.navbar-toggler').removeClass('open')
            $('.sidebar').removeClass("opened");
        });
    })

    /* ===============================  Button Up  =============================== */

    $(window).scroll(function() {
        if ($(window).scrollTop() >= 1000) {

            $('.up').addClass('fade')
        } else {

            $('.up').removeClass('fade')
        }
    })

    $('.up').on('click', function() {

        $('html, body').animate({
            scrollTop: 0
        }, 1000, 'easeInOutExpo')
    })


    /* ===============================  Smooth scroll into second section  =============================== */

    $('.smoothscroll').on('click', function() {

        $('html, body').animate({

            scrollTop: $($(this).attr('href')).offset().top
        }, 1000, 'easeInOutExpo')
    })


    $('.more_categories').on('click', function() {
        $('.more_slide_open').slideToggle().toggleClass('show');
        var txt = $(".more_slide_open").hasClass('show') ? 'أقسام أقل' : 'أقسام أكثر';
        $(".more_categories").text(txt);

    })

    $('.bottom_header .categories_btn').on('click', function() {
        $('.bottom_header #navCatContent').toggleClass('show');
        $('.overlay_gen').fadeToggle().on('click', function() {
            $(this).fadeOut();
            $('.bottom_header #navCatContent').removeClass('show')
        });
    })

    $('.navbar-toggler.side_navbar_toggler').on('click', function() {
        $('.overlay_gen').fadeToggle().on('click', function() {
            $(this).fadeOut();
            $('.navbar-collapse.mobile_side_menu').removeClass('show')
        });
    })


    //Show Hide dropdown-menu Main navigation 
    $('.dropdown-menu a.dropdown-toggler').on('click', function() {
        if (!$(this).next().hasClass('show')) {
            $(this).parents('.dropdown-menu').first().find('.show').removeClass("show");
        }
        var $subMenu = $(this).next(".dropdown-menu");
        $subMenu.toggleClass('show');

        $(this).parent("li").toggleClass('show');

        $(this).parents('li.nav-item.dropdown.show').on('hidden.bs.dropdown', function() {
            $('.dropdown-menu .show').removeClass("show");
        });

        return false;
    });

});


var settings = {
    visible: 0,
    theme: {
        backgroud: "rgba(0,0,0,.9)",
    },
    CSSVarTarget: document.querySelector('.range-slider'),
    knobs: [
        "Thumb",
        {
            cssVar: ['thumb-size', 'px'],
            label: 'thumb-size',
            type: 'range',
            min: 6,
            max: 33 //  value: 16,
        },
        "Value",
        {
            cssVar: ['value-active-color'], // alias for the CSS variable
            label: 'value active color',
            type: 'color',
            value: 'white'
        },
        {
            cssVar: ['value-background'], // alias for the CSS variable
            label: 'value-background',
            type: 'color',
        },
        {
            cssVar: ['value-background-hover'], // alias for the CSS variable
            label: 'value-background-hover',
            type: 'color',
        },
        {
            cssVar: ['primary-color'], // alias for the CSS variable
            label: 'primary-color',
            type: 'color',
        },
        {
            cssVar: ['value-offset-y', 'px'],
            label: 'value-offset-y',
            type: 'range',
            value: 5,
            min: -10,
            max: 20
        },
        "Track",
        {
            cssVar: ['track-height', 'px'],
            label: 'track-height',
            type: 'range',
            value: 8,
            min: 6,
            max: 33
        },
        {
            cssVar: ['progress-radius', 'px'],
            label: 'progress-radius',
            type: 'range',
            value: 20,
            min: 0,
            max: 33
        },
        {
            cssVar: ['progress-color'], // alias for the CSS variable
            label: 'progress-color',
            type: 'color',
            value: '#EEEEEE'
        },
        {
            cssVar: ['fill-color'], // alias for the CSS variable
            label: 'fill-color',
            type: 'color',
            value: '#0366D6'
        },
        "Ticks",
        {
            cssVar: ['show-min-max'],
            label: 'hide min/max',
            type: 'checkbox',
            value: 'none'
        },
        {
            cssVar: ['ticks-thickness', 'px'],
            label: 'ticks-thickness',
            type: 'range',
            value: 1,
            min: 0,
            max: 10
        },
        {
            cssVar: ['ticks-height', 'px'],
            label: 'ticks-height',
            type: 'range',
            value: 5,
            min: 0,
            max: 15
        },
        {
            cssVar: ['ticks-gap', 'px'],
            label: 'ticks-gap',
            type: 'range',
            value: 5,
            min: 0,
            max: 15
        },
        {
            cssVar: ['min-max-x-offset', '%'],
            label: 'min-max-x-offset',
            type: 'range',
            value: 10,
            step: 1,
            min: 0,
            max: 100
        },
        {
            cssVar: ['min-max-opacity'],
            label: 'min-max-opacity',
            type: 'range',
            value: .5,
            step: .1,
            min: 0,
            max: 1
        },
        {
            cssVar: ['ticks-color'], // alias for the CSS variable
            label: 'ticks-color',
            type: 'color',
            value: '#AAAAAA'
        },
    ]
}

new Knobs(settings)