(function ($) {
	"use strict";
    jQuery(document).ready(function($){

        //header-slider
        var $headerSlider = $('.header -slider-carousel');
        $headerSlider.owlCarousel({
            loop: true,
            dots: false,
            nav: true,
            autoplay:true,
            autoPlayTimeout: 1000,
            navText: ['<i class="fas fa-angle-left"></i>', '<i class="fas fa-angle-right"></i>'],
            responsive: {
                0: {
                    items: 1
                },
                768: {
                    items: 1
                },
                960: {
                    items: 1
                },
                1200: {
                    items: 1
                },
                1920: {
                    items: 1
                }
            }
        });
        $headerSlider.on("translate.owl.carousel", function () {
            $(".single-header-slide-item h1, .single-header-slide-item p").removeClass(" fadeInUp").css("opacity", "0");
            $(".header-btn-group a").removeClass("animated fadeInDown").css("opacity", "0");
        });

        $headerSlider.on("translated.owl.carousel", function () {
            $(".single-header-slide-item h1, .single-header-slide-item p").addClass("animated fadeInUp").css("opacity", "1");
            $(".header-btn-group a").addClass("animated fadeInDown").css("opacity", "1");
        });

        //responsive menu
        var $slickNav = $('#main-menu');
        $slickNav.slicknav({
            prependTo: '.responsive-menu',
            label: ''
        });
          /* counter section activation  */
        var counternumber = $('.counter-number');
          counternumber.counterUp({
              delay: 20,
              time: 3000
          });
        //magnific popup activation 
        $('.video-play-btn').magnificPopup({
            type: 'video'
        });
        //back to top 
        $(document).on('click', '.back-to-top', function () {
            $("html,body").animate({
                scrollTop: 0
            }, 2000);
        });

        //screenshort carousel
            var $screenshort = $('.screenshort-carousel');
            $screenshort.owlCarousel({
                loop: true,
                autoplay:true,
                autoPlayTimeout: 1000,
                margin:30,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    960: {
                        items: 2
                    },
                    1200: {
                        items: 4
                    },
                    1920: {
                        items: 4
                    }
                }
            });
        //reviewer carousel
            var $reviewerCarousel = $('.clients-review-carousel');
            $reviewerCarousel.owlCarousel({
                loop: true,
                autoplay:true,
                dots:true,
                autoPlayTimeout: 1000,
                margin:30,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    960: {
                        items: 2
                    },
                    1200: {
                        items: 3
                    },
                    1920: {
                        items: 3
                    }
                }
            });
        //reviewer carousel
            var $logoCarousel = $('.logo-carousel');
            $logoCarousel.owlCarousel({
                loop: true,
                autoplay:true,
                dots:true,
                autoPlayTimeout: 1000,
                margin:30,
                responsive: {
                    0: {
                        items: 1
                    },
                    768: {
                        items: 2
                    },
                    960: {
                        items: 2
                    },
                    1200: {
                        items: 4
                    },
                    1920: {
                        items: 4
                    }
                }
            });
        /*--magnific popup Image Activation--*/
            var imgPopUp = $('.image-popup')
            imgPopUp.magnificPopup({

                gallery: {
                    enabled: true
                },
                image: {
                    titleSrc: 'title'
                },
                type: 'image'

            });
            /*--- portfolio isotope activation ---*/
        var portfolioISotope = $('.portfolio-masonary-wrapper').isotope({
            itemSelector: '.single-portfolio-item', // use a separate class for itemSelector, other than .col-
            percentPosition: true,
            masonry: {
                columnWidth: '.grid-sizer'
            }
        });

        $(document).on('click', '.portfolio-filter-menu li', function () {
            var filterValue = $(this).attr('data-filter');
            portfolioISotope.isotope({
                filter: filterValue
            });
        });
        /*---- portfolio filter menu active  ------*/
        var portfolioMenu = '.portfolio-filter-menu li';
        $(document).on('click', portfolioMenu, function () {
            $(this).siblings().removeClass('active');
            $(this).addClass('active');
        });
        // /*------- progressbar activation ----------*/
        // progressbar('#html', 90 );
        // progressbar('#css',85);
        // progressbar('#bootstrap',96);
        //
        // function progressbar(selector,percentage){
        //     $(selector).LineProgressbar({
        //         percentage: percentage,
        //         fillBackgroundColor:'#ed1c24',
        //         backgroundColor:'#f4f4f4'
        //     });
        // }
        
    });
    $(window).on('scroll', function () {
        //back to top show/hide
       var ScrollTop = $('.back-to-top');
       if ($(window).scrollTop() > 1000) {
           ScrollTop.fadeIn(1000);
       } else {
           ScrollTop.fadeOut(1000);
       }
       /*--sticky menu activation--*/
       var mainMenuTop = $('.navbar-area');
       if ($(window).scrollTop() > 1000) {
           mainMenuTop.addClass('nav-fixed');
       } else {
           mainMenuTop.removeClass('nav-fixed');
       }
       
    });
           
    $(window).on('load',function(){
        //preloader
        var preLoder = $(".preloader");
        preLoder.fadeOut(500);
    });

}(jQuery));	
