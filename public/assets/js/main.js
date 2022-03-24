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



$('.single-product-page .info .settings .item.two .counter .plus').on('click', function() {

    var num_text = parseInt($(this).next().find('span').text());
    num_text++;
    $(this).next().find('span').text(num_text)
})

$('.single-product-page .info .settings .item.two .counter .minus').on('click', function() {
    var num_text = parseInt($(this).prev().find('span').text());
    if (num_text > 0) {
        num_text--;
        $(this).prev().find('span').text(num_text)
    }
})

$('.single-product-page .info .settings .item.two .fav-icon').on('click', function(e) {
    e.preventDefault();
    $(this).toggleClass('fav');
    if ($(this).hasClass('fav')) {
        $(this).addClass('alerttt');
    } else {
        $(this).addClass('alertt');
    }
    setTimeout(function() {
        $('.single-product-page .info .settings .item.two .fav-icon').removeClass('alertt alerttt');
    }, 1000);

})

$('.single-product-page .info .settings .item .size ul li').on('click', function() {
    $(this).addClass('active').siblings().removeClass('active');
})

/********************** owl carousel thumb ***********************/

var bigimage = $("#big_image");
var thumbs = $("#thumbs_gallary");
var syncedSecondary = true;

bigimage
    .owlCarousel({
        items: 1,
        slideSpeed: 2000,
        nav: false,
        autoplay: false,
        dots: false,
        loop: true,
        responsiveRefreshRate: 200,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
    })
    .on("changed.owl.carousel", syncPosition);

thumbs
    .on("initialized.owl.carousel", function() {
        thumbs
            .find(".owl-item")
            .eq(0)
            .addClass("current");
    })
    .owlCarousel({
        items: 4,
        dots: false,
        nav: false,
        navText: ['<i class="fa fa-angle-left" aria-hidden="true"></i>', '<i class="fa fa-angle-right" aria-hidden="true"></i>'],
        smartSpeed: 200,
        slideSpeed: 500,
        slideBy: 4,
        responsiveRefreshRate: 100
    })
    .on("changed.owl.carousel", syncPosition2);

function syncPosition(el) {
    //if loop is set to false, then you have to uncomment the next line
    //var current = el.item.index;

    //to disable loop, comment this block
    var count = el.item.count - 1;
    var current = Math.round(el.item.index - el.item.count / 2 - 0.5);

    if (current < 0) {
        current = count;
    }
    if (current > count) {
        current = 0;
    }
    //to this
    thumbs
        .find(".owl-item")
        .removeClass("current")
        .eq(current)
        .addClass("current");
    var onscreen = thumbs.find(".owl-item.active").length - 1;
    var start = thumbs
        .find(".owl-item.active")
        .first()
        .index();
    var end = thumbs
        .find(".owl-item.active")
        .last()
        .index();

    if (current > end) {
        thumbs.data("owl.carousel").to(current, 100, true);
    }
    if (current < start) {
        thumbs.data("owl.carousel").to(current - onscreen, 100, true);
    }
}

function syncPosition2(el) {
    if (syncedSecondary) {
        var number = el.item.index;
        bigimage.data("owl.carousel").to(number, 100, true);
    }
}

thumbs.on("click", ".owl-item", function(e) {
    e.preventDefault();
    var number = $(this).index();
    bigimage.data("owl.carousel").to(number, 300, true);
});

$(".toggle-password").click(function() {
    $(this).toggleClass("fa-eye fa-eye-slash");
    var input = $($(this).attr("toggle"));
    if (input.attr("type") == "password") {
        input.attr("type", "text");
    } else {
        input.attr("type", "password");
    }
});