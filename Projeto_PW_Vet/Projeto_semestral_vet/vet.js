$(document).ready(function () {

    'use strict';

    const OFFSET_ADJUST = 96;
    let sections = $('section');
    let navItems = $('#nav_list .nav-item');
    let mobileNavItems = $('#mobile_nav_list .nav-item');

    function updateActiveNav() {
        const scrollPosition = $(window).scrollTop();
        let activeSectionIndex = -1;

        sections.each(function (i) {
            const section = $(this);
            const sectionTop = section.offset().top - OFFSET_ADJUST;
            const sectionBottom = sectionTop + section.outerHeight();

            if (scrollPosition >= sectionTop && scrollPosition < sectionBottom) {
                activeSectionIndex = i;
                return false;
            }
        });

        navItems.removeClass('active');
        mobileNavItems.removeClass('active');

        if (activeSectionIndex !== -1) {
            navItems.eq(activeSectionIndex).addClass('active');
            mobileNavItems.eq(activeSectionIndex).addClass('active');
        }
    }

    $(window).on('scroll', updateActiveNav);
    updateActiveNav();

    $('#mobile_btn').on('click', function () {
        $('#mobile_menu').toggleClass('active');
        $(this).find('i').toggleClass('fa-x');
    });

    $('a[href^="#"]').on('click', function (e) {
        const target = $($(this).attr('href'));
        if (target.length) {
            e.preventDefault();
            const scrollTo = target.offset().top - OFFSET_ADJUST;
            $('html, body').animate({ scrollTop: scrollTo }, 400);
            $('#mobile_menu').removeClass('active');
            $('#mobile_btn').find('i').removeClass('fa-x');
        }
    });
    ScrollReveal().reveal('#cta', {
        origin: 'left',
        duration: 2000,
        distance: '20%'
    });

    ScrollReveal().reveal('.serve', {
        origin: 'left',
        duration: 2000,
        distance: '20%'
    });
    ScrollReveal().reveal('#testimonial_vet', {
        origin: 'left',
        duration: 1000,
        distance: '20%'
    });

    ScrollReveal().reveal('#feedback', {
        origin: 'right',
        duration: 1000,
        distance: '20%'
    });

});
