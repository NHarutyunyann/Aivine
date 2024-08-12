/* ================================================
---------------------- Main.js ----------------- */
(function ($) {
	'use strict';
	var Porto = {
		initialised: false,
		mobile: false,
		init: function () {

			if (!this.initialised) {
				this.initialised = true;
			} else {
				return;
			}

			// Call Porto Functions
			this.checkMobile();
			this.headerSearchToggle();
			this.mMenuIcons();
			this.mMenuToggle();
			this.mobileMenu();
			this.scrollToTop();

			/* Call function if Owl Carousel plugin is included */
			if ($.fn.owlCarousel) {
				this.owlCarousels();
			}

			/* Call function if Light Gallery plugin is included */
			if ($.fn.magnificPopup) {
				this.lightBox();
			}
		},

		checkMobile: function () {
			/* Mobile Detect*/
			if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
				this.mobile = true;
			} else {
				this.mobile = false;
			}
		},
		headerSearchToggle: function () {
			$('.header-search').length &&
			$('body')
				// Stop Propagation
				.on('click', '.header-search', function (e) {
					e.stopPropagation();
				})

				// Search Toggle
				.on('click', '.search-toggle', function (e) {
					var $headerSearch = $(this).closest('.header-search');

					$headerSearch.toggleClass('show');
					$('.header-search-wrapper').toggleClass('show'); // Will be deprecated.

					$headerSearch.hasClass('show') && $headerSearch.find('input.form-control').focus();
					e.preventDefault();
				})

				// Search Deactive
				.on('click', function (e) {
					$('.header-search').removeClass('show');
					$('.header-search-wrapper').removeClass('show'); // Will be deprecated.
					$('body').removeClass('is-search-active');
				});

			var calcHeaderSearchPosition = function() {
				$('.header-search').each(function() {
					var $this = $(this);
					$this.find('.header-search-wrapper').css(
						$(window).width() < 576 ?
						{
							left: 15 - $this.offset().left + 'px',
							right: 15 + $this.offset().left + $this.width() - $(window).width() + 'px'
						} :
						{
							left: '',
							right: ''
						}
					);
				});
			};

			calcHeaderSearchPosition();

			$.fn.smartresize ?
				$(window).smartresize( calcHeaderSearchPosition ) :
				$(window).on( 'resize', calcHeaderSearchPosition );
		},
		mMenuToggle: function () {
			// Mobile Menu Show/Hide
			$('.mobile-menu-toggler').on('click', function (e) {
				$('body').toggleClass('mmenu-active');
				$(this).toggleClass('active');
				e.preventDefault();
			});

			// Menu Show/Hide // Used in Demo 12
			$('.menu-toggler').on('click', function (e) {
				if ($(window).width() >= 992) {
					$('.main-dropdown-menu').toggleClass('show');
				} else {
					$('body').toggleClass('mmenu-active');
				}
				e.preventDefault();
			});

	  		// Hide Menu
			$('.mobile-menu-overlay, .mobile-menu-close').on('click', function (e) {
				$('body').removeClass('mmenu-active');
				$('.menu-toggler').removeClass('active');
				e.preventDefault();
			});
		},
		mMenuIcons: function () {
			// Add Mobile menu icon arrows or plus/minus to items with children
			$('.mobile-menu').find('li').each(function () {
				var $this = $(this);

				if ($this.find('ul').length) {
					$('<span/>', {
						'class': 'mmenu-btn'
					}).appendTo($this.children('a'));
				}
			});
		},
		mobileMenu: function () {
			// Mobile Menu Toggle
			$('.mmenu-btn').on('click', function (e) {
				var $parent = $(this).closest('li'),
					$targetUl = $parent.find('ul').eq(0);

				if (!$parent.hasClass('open')) {
					$targetUl.slideDown(300, function () {
						$parent.addClass('open');
					});
				} else {
					$targetUl.slideUp(300, function () {
						$parent.removeClass('open');
					});
				}

				e.stopPropagation();
				e.preventDefault();
			});
		},
		owlCarousels: function () {
            let oneImage = $('.product-single-carousel').hasClass('one-image');
			var sliderDefaultOptions = {
				loop: !oneImage,
				margin: 0,
				responsiveClass: true,
				nav: false,
				navText: ['<i class="icon-angle-left">', '<i class="icon-angle-right">'],
				dots: true,
				autoplay: true,
				autoplayTimeout: 15000,
				items: 1,
			};

			var sliderInit = function($slider, sliderCustomOptions) {

				var newSliderOptions;

				if (sliderCustomOptions) {
					newSliderOptions = $.extend(true, {}, sliderDefaultOptions, sliderCustomOptions);
				} else {
					newSliderOptions = sliderDefaultOptions;
				}

				$slider.hasClass('nav-thin') &&
				( newSliderOptions.navText = ['<i class="icon-left-open-big">', '<i class="icon-right-open-big">'] );

				var userOptions = $slider.data('owl-options');
				if (typeof userOptions == 'string') {
					userOptions = JSON.parse(userOptions.replace(/'/g,'"').replace(';',''));
					newSliderOptions = $.extend(true, {}, newSliderOptions, userOptions);
				}

				$slider.owlCarousel(newSliderOptions);
			}


			let sliderCustomOptionsArray = {
				'.home-slider': {
					lazyLoad: true,
					autoplay: false,
					dots: false,
					nav: true,
					autoplayTimeout: 12000,
					animateOut: 'fadeOut',
					navText: ['<i class="icon-angle-left">', '<i class="icon-angle-right">'],
					loop: true
				},

				// Product single carousel - Default layout
				'.product-single-default .product-single-carousel': {
					nav: true,
					dotsContainer: '#carousel-custom-dots',
					autoplay: false,
					onInitialized: function () {
						var $source = this.$element;

						if ($.fn.elevateZoom && !(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent))) {
							$source.find('img').each(function () {
								var $this = $(this),
									zoomConfig = {
										responsive: true,
										zoomWindowFadeIn: 350,
										zoomWindowFadeOut: 200,
										borderSize: 0,
										zoomContainer: $this.parent(),
										zoomType: 'inner',
										cursor: 'grab'
									};
								$this.elevateZoom(zoomConfig);
							});
						}
					},
				},
			};

			// Init custom carousels
			var selectors = Object.keys(sliderCustomOptionsArray);
			selectors.forEach(function(selector) {
				$(selector).each(function() {
					sliderInit($(this), sliderCustomOptionsArray[selector]);
				});
			});

			// Init all carousels except custom carousels.
			$('.owl-carousel').each(function() {
				if ( ! $(this).data('owl.carousel') )
					sliderInit($(this), sliderInit);
			});

			// Add loaded class on lazy load
			$('.home-slider').on('loaded.owl.lazy', function (event) {
				$(event.element).closest('.home-slide').addClass('loaded');
				$(event.element).closest('.home-slider').addClass('loaded'); // For Demo 12
			});

			// Product Page Dot Thumbnails Carousel
			$('#carousel-custom-dots .owl-dot').click(function () {
				$('.product-single-carousel').trigger('to.owl.carousel', [$(this).index(), 300]);
			});
		},
		scrollBtnAppear: function () {
			if ($(window).scrollTop() >= 400) {
				$('#scroll-top').addClass('fixed');
			} else {
				$('#scroll-top').removeClass('fixed');
			}
		},
        headerAppear: function () {
            if ($(window).scrollTop() > 64) {
                $('.header').addClass('fixed');
            } else  {
                $('.header').removeClass('fixed');
            }
        },
		scrollToTop: function () {
			$('#scroll-top').on('click', function (e) {
				$('html, body').animate({
					'scrollTop': 0
				}, 1200);
				e.preventDefault();
			});
		},
		lightBox: function () {

            $(".prod-full-screen").click(function (e) {
                var links = [];
                var $productSliderImages = $('body').find('.product-single-carousel .owl-item:not(.cloned) img').length === 0 ? $('.product-single-gallery img') : $('.product-single-carousel .owl-item:not(.cloned) img');
                $productSliderImages.each(function () {
                    links.push({ 'src': $(this).attr('data-force-image') || $(this).attr('data-zoom-image') });
                });
                var currentIndex;
                if (e.currentTarget.closest(".product-slider-container")) {
                    currentIndex = $('.product-single-carousel .owl-item:not(.cloned)').index(document.querySelector('.product-single-carousel .owl-item.active'));
                }
                else {
                    currentIndex = $(e.currentTarget).closest(".product-item").index();
                }

                $.magnificPopup.open({
                    items: links,
                    navigateByImgClick: true,
                    type: 'image',
                    gallery: {
                        enabled: true
                    },
                }, currentIndex);
            });
		},
	};

	$('body').prepend('<div class="loading-overlay"><div class="bounce-loader"></div></div>');

	// Ready Event
	jQuery(document).ready(function () {
		// Init our app
		Porto.init();
	});

	!// Load Event
	$(window).on('load', function () {
		$('body').addClass("loaded");
		Porto.scrollBtnAppear();
		Porto.headerAppear();
	});

	// Scroll Event
	$(window).on('scroll', function () {
		Porto.scrollBtnAppear();
		Porto.headerAppear();
	});
})(jQuery);

jQuery( document ).ready(function() {

    $('body .profileImage').each((index, el) => {
        let firstName = $(el).attr('data-text').split(' ')[0];
        $(el).text(firstName.charAt(0));
    })

    const body = $('body');
    body.on('click', '.qartez-page .select-box h3', function () {
        $(this).parent().toggleClass('active');
    });
////////add padding

    // const menuItemText = body.find('.menu-auto-padding > li > a');
    // const menuHeight = body.find('.home-slide .img-wrap').height()-63;
    const menuItemCount = body.find('.menu-auto-padding > li').length;
    const imageHeight = body.find('.home-slide .img-wrap').height();

    body.find('.menu-auto-padding > li > a').css('padding', `${((imageHeight - (menuItemCount * 30)) / menuItemCount) / 2}px 20px`)








    jQuery('.home .menu-item.dropdown').hover(
        function () {
            jQuery(this).find('.menu-dropdown-content').stop(true, false).fadeIn();
        },
        function () {
            jQuery(this).find('.menu-dropdown-content').stop(true, false).fadeOut();
        }
    );

    jQuery('.mobile-dropdown.dropdown').hover(
        function () {
            jQuery(this).find('.dropdown-menu').stop(true, false).css('display', 'block');
        },
        function () {
            jQuery(this).find('.dropdown-menu').stop(true, false).css('display', 'none');
        }
    );

    jQuery('.header-search-select > a').click(function () {
        jQuery('.header-search-select > ul').toggle();
        jQuery('body').addClass('selectedSearch');
    });

    jQuery('.header-search-select > ul a').click(function () {
        jQuery('.header-search-select > ul').hide();
        var selectedText = jQuery(this).text();
        jQuery('.header-search-select > a').text(selectedText);
        jQuery('body').removeClass('selectedSearch');
    });

    jQuery('body').click(function () {
        jQuery('.header-search-select > ul').hide();
        jQuery('body').removeClass('selectedSearch');
    });

    body.on('click', '.category-list .tree-arrow', function (e) {
        e.stopPropagation();
        e.preventDefault();
        $(this).parent().parent().toggleClass('active');
    });

    jQuery('.carousel-col').hover(
        function () {
            jQuery(this).find('.left-right-arrow-icon').animate({opacity: '100%'}, 400);
        },
        function () {
            jQuery(this).find('.left-right-arrow-icon').animate({opacity: '0'}, 400);
        }
    );

    $('body').on('click', '#menu-tab ul li.dropdown i', function(e) {
        e.preventDefault();
        let submenu = $(this).closest('li').children('ul');
        if (submenu.is(':hidden') ) {
            submenu.slideDown('slow').parent('.dropdown').children('a').addClass('open');
        } else {
            submenu.slideUp('slow').parent('.dropdown').children('a').removeClass('open');
        }
        $(this).closest('li').siblings().children('ul').slideUp('slow');
        $(this).closest('li').siblings('.dropdown').children('a').removeClass('open')
        $(this).closest('li').find('.dropdown').children('a').removeClass('open')
        $(this).closest('li').find('.dropdown').children('a').children('ul').slideUp('slow')
    }).on('click', '.dropdown ul', function (event) {
        event.stopPropagation();
    });

    if($('.close-admin-bar').length > 0 ) {
        $('.close-admin-bar').on('click', function () {
            let $this = $(this);
            $this.toggleClass('hide-admin-bar');
            if($this.hasClass('hide-admin-bar')){
                $this.text('[Show]');
                $('.admin-header--inner').hide();
            } else {
                $this.text('[Close]');
                $('.admin-header--inner').show();
            }
        })
    }
    $('.admin-account-box').click(function () {
        $('.logout-box').fadeToggle();
        $('.admin-account-box').toggleClass('active');
    })

    $('body .for-click').click(function (e){
        if($(window).width() <= 565){
            // e.stopPropagation()
            e.preventDefault()
            $('body .info-mobile-table').addClass('show');
        }

    })
    $('body .info-close-button').click(function (){
        $('body .info-mobile-table').removeClass('show')

    })

    $(document).mouseup(function(e) {
        var container = $('body .info-mobile-table');

        if (!container.is(e.target) && container.has(e.target).length === 0)
        {
            container.removeClass('show');
        }
    });

    $('body').on('click', '.see-more', function () {
        const parent = $(this).parents('.contact-info');
        const text = 'Տեսնել ավելին';
        const currentText = $(this).find('.list_more').text();

        parent.find('i').toggleClass('rotate', text === currentText)
        parent.find('.categories-li.hidden-list').toggle(text === currentText)
        $(this).find('.list_more').text(currentText === text ? 'Փակել' : text);
    })

    $('body').on('click', '.dropdown_footer', function () {
        const parentscroll = $(this).parents('.footer-dropdown').find('.address-widget-scroll');

        $(this).toggleClass('rotate');
        parentscroll.toggleClass('open')

    });

    $('body').on('click', '.eyeImg', function () {
        const newType = $(this).parent().find('input').attr('type') === 'password' ? 'text' : 'password';
        $(this).parent().find('input').attr('type', newType);

        const newImg= $(this).parent().find('img').attr('src') === '/images/icons/eye.svg' ? '/images/icons/eyeOpen.png' : '/images/icons/eye.svg';
        $(this).parent().find('img').attr('src', newImg);
    });

    if($(window).width() > 768){
        $('body .forKapImg').addClass('container');
        }

});


