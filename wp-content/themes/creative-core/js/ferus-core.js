/**
 * Main JS file for ferus-core
 * Author: Kael Steinert
 */
jQuery(document).ready(function ($) {

    /**
     * Header Search
     * @type {*}
     */
    var search_holder = $('.header-search');
    if (search_holder) {
        var searchTrigger = search_holder.find('label[for="search_text"]');
        $(searchTrigger).click(function(){
            if (search_holder.hasClass('active')) {
                search_holder.removeClass('active');
            } else {
                search_holder.addClass('active');
            }
        });
    }
    /**
     * Cart Dropdown Toggle
     * @type {*}
     */
    $('#toolbar .header-cart-wrap').click(function () {
        if ($(this).hasClass('active')) {
            $(this).data('open', 'false');
            $(this).removeClass('active');
        } else {
            $(this).data('open', 'true');
            $(this).addClass('active');
        }
    });
    $('body').bind('click', function(e){
        var cart_wrap = $('#toolbar .header-cart-wrap');
        if( cart_wrap.data('open') === 'true' && !$(e.target).is('#toolbar .header-cart-wrap') && !$(e.target).closest('.header-cart-wrap').length ){
            cart_wrap.data('open', 'false');
            cart_wrap.removeClass('active');
        }
    });
    /**
     * Homepage Slider
     */
    $('.home_slider').slick({
        infinite: true,
        dots: true,
        arrows: false,
    });
    /**
     * Testimonials Slider
     */
    $('.testimonial_slider').slick({
        infinite: true,
        dots: false,
        arrows: true,
    });
    /**
     * Slideset Products
     */
    $('.slideset-products').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    /**
     * Homepage Content Slider
     */
    $('.content_slider').slick({
        infinite: true,
        dots: false,
        arrows: true
    });
    /**
     * Homepage Content Slider
     */
    $('.content_slider_lr').slick({
        infinite: true,
        dots: false,
        arrows: true,
        fade: true,
        cssEase: 'linear'
    });
    /**
     * Slick Tab Slider
     * Usage: <button data-slide=3>GoTo Slide 3<button>
     */
    $('.tab-slider').slick({
        dots: false,
        arrows: false,
        speed: 800,
        infinite: true
    });
    $('.tab-slider').on('afterChange', function(event, slick, currentSlide){
        var holder = $(this).closest('section');
        var slideNumber = currentSlide;
        $(holder).find('.tab-slider-nav [data-slide]').removeClass('active');
        $(holder).find('.tab-slider-nav [data-slide="' + slideNumber + '"]').addClass('active');
    });
    $('.tab-slider-nav [data-slide]').click(function () {
        var holder = $(this).closest('section');
        var currentSlider = $(holder).find('.tab-slider');
        var slideNumber = $(this).attr("data-slide");
        var currentSlide = $(currentSlider).slick('slickCurrentSlide');
        $(currentSlider).slick('slickGoTo', slideNumber);
        if (slideNumber != currentSlide) {
            $(holder).find('.tab-slider-nav [data-slide]').removeClass('active');
        }
        $(this).addClass('active');
    });
    /**
     * Accordion
     */
    var allPanels = $('.accordion > [data-accordion=content]').hide();
    var activePanel = $('.accordion > [data-accordion=content].active').show();
    $('.accordion > [data-accordion=title]').click(function () {
        var target = $(this).next();
        var holder = $(this).closest('.accordion');
        var allPanelTitles = holder.find('> [data-accordion=title]');
        var allPanels = holder.find('[data-accordion=content]');

        if (!$(this).hasClass('active')) {
            allPanelTitles.removeClass('active');
            $(this).addClass('active');
        } else if ($(this).hasClass('active')) {
            $(this).removeClass('active');
        }
        if (!target.hasClass('active')) {
            allPanels.removeClass('active').slideUp();
            target.addClass('active').slideDown();
        } else if (target.hasClass('active')) {
            target.removeClass('active').slideUp();
        }
        return false;
    });

    /**
     * Tabs
     */
    $(".tabs-menu a").click(function(event) {
        event.preventDefault();
        $(this).parent().addClass("current");
        $(this).parent().siblings().removeClass("current");
        var tab = $(this).attr("href");
        $(".tab-content > div").not(tab).css("display", "none");
        $(tab).fadeIn();
    });
    // URL changing for tabs
    $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
        var origTarget = $(e.target).attr("href"); // activated tab
        var target = origTarget.replace("#", "");
        var newurl = window.location.protocol + "//" + window.location.host + window.location.pathname + '?tab_content=' + target;
        if (history.pushState) {
            window.history.pushState({path:newurl},'',newurl);
        } else {
            window.history.replaceState({path:newurl},'',newurl);
        }
    });
    window.addEventListener('popstate', function (event) {
        if (history.state) {
            customTabToggle();
        }
    }, false);
    /**
     * Get the value of a querystring
     * @param  {String} field The field to get the value of
     * @param  {String} url   The URL to get the value from (optional)
     * @return {String}       The field value
     */
    var getQueryString = function ( field, url ) {
        var href = url ? url : window.location.href;
        var reg = new RegExp( '[?&]' + field + '=([^&#]*)', 'i' );
        var string = reg.exec(href);
        return string ? string[1] : null;
    };
    // Activate tab and tab content from query string
    function customTabToggle() {
        var set_tab = getQueryString('tab_content');
        if(set_tab) {
            var tabs = $('.tabs-menu > li');
            $('.tabs-wrap .tab-content > div').removeClass('current active');
            $('.tabs-wrap .tab-content > div').hide();
            tabs.removeClass('current active');
            for (i=0;i<tabs.length;i++) {
                var link = $(tabs[i]).find('a[data-toggle="tab"]').attr('href');
                if (link === '#' + set_tab){
                    $(tabs[i]).addClass('current active');
                    $('.tab-content #' + set_tab).addClass('current active');
                    $('.tab-content #' + set_tab).show();
                }
            }
        }
    }
    customTabToggle();
    
    /**
     * Default Slideset
     */
    $('.slideset').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 800,
        autoplay: true,
        autoplaySpeed: 6000,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    /**
     * Slideset Products
     */
    $('.slideset-products').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 1024,
                settings: {
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    infinite: true,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
            // You can unslick at a given breakpoint now by adding:
            // settings: "unslick"
            // instead of a settings object
        ]
    });
    /**
     * Gallery Slideset 3-columns
     */
    $('.gallery-slideset.col3').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 800,
        autoplay: true,
        autoplaySpeed: 6000,
        slidesToShow: 3,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 600,
                settings: {
                    slidesToShow: 2,
                    slidesToScroll: 1
                }
            },
            {
                breakpoint: 480,
                settings: {
                    slidesToShow: 1,
                    slidesToScroll: 1
                }
            }
        ]
    });
    /**
     * Gallery Slideset 4-columns
     */
    $('.gallery-slideset.col4').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 800,
        autoplay: true,
        autoplaySpeed: 6000,
        slidesToShow: 4,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 600,
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
        ]
    });
    /**
     * Gallery Slideset 5-columns
     */
    $('.gallery-slideset.col5').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 800,
        autoplay: true,
        autoplaySpeed: 6000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 600,
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
        ]
    });
    /**
     * Default Slideset
     */
    $('.slideset-5col').slick({
        dots: false,
        arrows: true,
        infinite: true,
        speed: 800,
        autoplay: true,
        autoplaySpeed: 6000,
        slidesToShow: 5,
        slidesToScroll: 1,
        responsive: [
            {
                breakpoint: 600,
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
        ]
    });
    /**
     * Listing Gallery
     * @type {*}
     */
    var listingGallery = $('#listing-gallery');
    if (listingGallery) {
        var galleryView = listingGallery.find('#gallery-view');
        var galleryNavItems = listingGallery.find('#gallery-nav .thumb-item');
        listingGallery.find('#gallery-nav .thumb-item:first-of-type').addClass('active');
        $('#gallery-nav .thumb-item').click(function () {
            var image = $(this).attr('data-image');
            galleryNavItems.removeClass('active');
            $(this).addClass('active');
            galleryView.css('background-image', 'url(' + image + ')');
        });
    }
    /**
     * Video modal
     */
    $('.video-modal').on('shown.bs.modal', function () {
        EQCSS.apply();
    });

    /**
     * Gallery Lightbox
     */
    if (typeof jQuery().featherlightGallery === "function") {
        $('.lb-gallery').featherlightGallery({
            previousIcon: '<i class="fas fa-angle-left"></i>',
            nextIcon: '<i class="fas fa-angle-right"></i>',
            galleryFadeIn: 100,
            galleryFadeOut: 300
        });
    }
    
    /**
     * Masonry Gallery
     */
    if (typeof jQuery().masonry === "function") { 
        $('.masonry-gallery').masonry({
            itemSelector: '.gallery-item',
            columnWidth: '.gallery-grid-sizer',
            percentPosition: true
        });
    }

    // Set Cookie
    function setCookie(cname, cvalue, exdays, path) {
        var d = new Date();
        if (path){
            var path = path;
        } else {
            var path = "";
        }
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + "; " + expires + "; path=/" + path;
    }
    // Get Cookie
    function getCookie(cname) {
        var name = cname + "=";
        var ca = document.cookie.split(';');
        for (var i = 0; i < ca.length; i++) {
            var c = ca[i];
            while (c.charAt(0) == ' ') {
                c = c.substring(1);
            }
            if (c.indexOf(name) == 0) {
                return c.substring(name.length, c.length);
            }
        }
        return "";
    }
    // Cookie Enabled Modal
    function cookiePop(){
        var modalSession = getCookie("news_modal");
        var url = window.location.href;
        if(url.indexOf('?welcome=1') != -1) {
            // query string activation
            $('#news-modal').modal('show');
        } else {
            if (modalSession != "") {
                // Cookie Found, Don't Trigger Modal
                return false;
            } else {
                // Cookie NOT Found
                //Trigger Modal
                $('#news-modal').modal('show');
            }
        }
    }cookiePop();
    // Set cookie after modal closes
    $('#news-modal').on('hidden.bs.modal', function (e) {
        setCookie("news_modal", "value", 2, "");
    });

});// END document.ready

/*************************************************************************/
/* Window.load  */
/*************************************************************************/
jQuery(window).load(function () {

    /**
     * Auto Page Height for small pages
     */
    window.addEventListener("resize", autoPageHeight);
    function autoPageHeight() {
        var footer = document.getElementsByClassName("site-footer")[0];
        var pageBody = document.getElementsByClassName("page-body")[0];
        if (footer && pageBody) {
            var footerHeight = footer.clientHeight;
            var pageHeight = window.innerHeight - footerHeight;
            pageBody.style.minHeight = pageHeight + "px";
        }
    }//autoPageHeight();

    /**
     * Smooth Scroll
     */
    jQuery('a.smooth[href^="#"]:not([href="#"])').on('click', function (e) {
        e.preventDefault();
        var target = this.hash;
        var $target = jQuery(target);
        if (jQuery(window).width() > 767 && jQuery(window).width() < 991) {
            var $offset = $target.offset().top - 225;
        }
        else {
            var $offset = $target.offset().top - 180;
        }
        jQuery('html, body').stop().animate({
            'scrollTop': $offset
        }, 900, 'swing', function () {
            window.location.hash = target;
        });
    });

});/* END window.load */

/**
 * Match Height Columns
 * USAGE: data-col=a
 */
function colMatchHeight() {
    var cols = document.querySelectorAll('[data-col]'),
        encountered = [];
    for (i = 0; i < cols.length; i++) {
        var attr = cols[i].getAttribute('data-col');
        if (encountered.indexOf(attr) == -1) {
            encountered.push(attr);
        }
    }
    for (set = 0; set < encountered.length; set++) {
        var col = document.querySelectorAll('[data-col="' + encountered[set] + '"]'),
            group = [];
        for (i = 0; i < col.length; i++) {
            col[i].style.height = 'auto';
            group.push(col[i].scrollHeight);
        }
        for (i = 0; i < col.length; i++) {
            col[i].style.height = Math.max.apply(Math, group) + 'px';
        }
    }
}
window.addEventListener("load", colMatchHeight);
window.addEventListener("resize", colMatchHeight);

/**
 * Proper Parallax
 */
function parallaxImages() {
    // Set the scroll for each parallax individually
    var plx = document.getElementsByClassName('parallax');
    for(i=0;i<plx.length;i++){
        var height = plx[i].height;
        var img = plx[i].getAttribute('data-plx-img');
        var vid = plx[i].getAttribute('data-plx-video');
        if(vid) {
            var plxVid = plx[i].getElementsByClassName("plx-vid")[0];
            plxVid.style.height = (height+50)+'px';
        } else {
            var plxImg = document.createElement("div");
            plxImg.className += " plx-img";
            plxImg.style.height = (height+50)+'px';
            plxImg.style.backgroundImage = 'url('+ img +')';
            plx[i].insertBefore(plxImg, plx[i].firstChild);
        }
    }
} parallaxImages();
function plxScroll(){
    var scrolled = window.scrollY;
    var win_height_padded = window.innerHeight * 1.25;
    // Set the scroll for each parallax individually
    var plx = document.getElementsByClassName('parallax');
    for(i=0;i<plx.length;i++){
        var offsetTop = plx[i].getBoundingClientRect().top + scrolled;
        var singleScroll = (scrolled - offsetTop) - 50;
        if (scrolled + win_height_padded >= offsetTop) {
            var plxImg = plx[i].getElementsByClassName('plx-img')[0];
            var plxVid = plx[i].getElementsByClassName('plx-vid')[0];
            if (plxVid) {
                plxVid.style.bottom = (singleScroll / -5) - 50 + "px";
            } else {
                plxImg.style.top = (singleScroll / 5) + "px";
            }
        }
    }
}
window.addEventListener('load', plxScroll);
window.addEventListener('resize', plxScroll);
window.addEventListener('scroll', plxScroll);

/**
 * Scroll Revealing Items
 */
var isScrolling = false;
window.addEventListener("scroll", throttleScroll);
function throttleScroll(e) {
    if (isScrolling == false) {
        window.requestAnimationFrame(function() {
            scrolling(e);
            isScrolling = false;
        });
    }
    isScrolling = true;
}
document.addEventListener("DOMContentLoaded", scrolling, false);

function scrolling(e) {
    var scrollItems = document.querySelectorAll("[data-reveal]");
    for (var i = 0; i < scrollItems.length; i++) {
        var scrollItem = scrollItems[i];
        var animationType = scrollItems[i].getAttribute('data-reveal');

        if (isPartiallyVisible(scrollItem)) {
            scrollItem.classList.add('animated', animationType);
        } /*else {
            scrollItem.classList.remove('animated', animationType);
        }*/
    }
}
function isPartiallyVisible(el) {
    var elementBoundary = el.getBoundingClientRect();
    var top = elementBoundary.top;
    var bottom = elementBoundary.bottom;
    var height = elementBoundary.height;

    return ((top + height >= 0) && (height + window.innerHeight >= bottom));
}
function isFullyVisible(el) {
    var elementBoundary = el.getBoundingClientRect();
    var top = elementBoundary.top;
    var bottom = elementBoundary.bottom;

    return ((top >= 0) && (bottom <= window.innerHeight));
}