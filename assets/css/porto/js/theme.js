// Theme
window.theme = {};

// Theme Common Functions
window.theme.fn = {

    getOptions: function (opts) {

        if (typeof (opts) == 'object') {

            return opts;

        } else if (typeof (opts) == 'string') {

            try {
                return JSON.parse(opts.replace(/'/g, '"').replace(';', ''));
            } catch (e) {
                return {};
            }

        } else {

            return {};

        }

    }

};


// Nav 
(function (theme, $) {

    theme = theme || {};

    var initialized = false;

    $.extend(theme, {

        Nav: {
            defaults: {
                wrapper: $('#mainNav'),
                scrollDelay: 600,
                scrollAnimation: 'easeOutQuad'
            },

            initialize: function ($wrapper, opts) {
                if (initialized) {
                    return this;
                }

                initialized = true;
                this.$wrapper = ($wrapper || this.defaults.wrapper);

                this
                        .setOptions(opts)
                        .build()
                        .events();

                return this;
            },

            setOptions: function (opts) {
                this.options = $.extend(true, {}, this.defaults, opts, theme.fn.getOptions(this.$wrapper.data('plugin-options')));

                return this;
            },

            build: function () {
                var self = this,
                        $html = $('html'),
                        $header = $('#header'),
                        $headerNavMain = $('#header .header-nav-main'),
                        thumbInfoPreview;

                // Preview Thumbs
                self.$wrapper.find('a[data-thumb-preview]').each(function () {
                    thumbInfoPreview = $('<span />').addClass('thumb-info thumb-info-preview')
                            .append($('<span />').addClass('thumb-info-wrapper')
                                    .append($('<span />').addClass('thumb-info-image').css('background-image', 'url(' + $(this).data('thumb-preview') + ')')
                                            )
                                    );

                    $(this).append(thumbInfoPreview);
                });

                // Side Header / Side Header Hamburguer Sidebar (Reverse Dropdown)
                if ($html.hasClass('side-header') || $html.hasClass('side-header-hamburguer-sidebar')) {

                    // Side Header Right / Side Header Hamburguer Sidebar Right
                    if ($html.hasClass('side-header-right') || $html.hasClass('side-header-hamburguer-sidebar-right')) {
                        if (!$html.hasClass('side-header-right-no-reverse')) {
                            $header.find('.dropdown-submenu').addClass('dropdown-reverse');
                        }
                    }

                } else {

                    // Reverse
                    self.checkReverse = function () {
                        self.$wrapper.find('.dropdown, .dropdown-submenu').removeClass('dropdown-reverse');

                        self.$wrapper.find('.dropdown:not(.manual):not(.dropdown-mega), .dropdown-submenu:not(.manual)').each(function () {
                            if (!$(this).find('.dropdown-menu').visible(false, true, 'horizontal')) {
                                $(this).addClass('dropdown-reverse');
                            }
                        });
                    }

                    self.checkReverse();

                    $(window).on('resize', function () {
                        self.checkReverse();
                    });

                }

                // Clone Items
                if ($headerNavMain.hasClass('header-nav-main-clone-items')) {

                    $headerNavMain.find('nav > ul > li > a').each(function () {
                        var parent = $(this).parent(),
                                clone = $(this).clone(),
                                clone2 = $(this).clone(),
                                wrapper = $('<span class="wrapper-items-cloned"></span>');

                        // Config Classes
                        $(this).addClass('item-original');
                        clone2.addClass('item-two');

                        // Insert on DOM
                        parent.prepend(wrapper);
                        wrapper.append(clone).append(clone2);
                    });

                }

                // Floating
                if ($('#header.header-floating-icons').get(0) && $(window).width() > 991) {

                    var menuFloatingAnim = {
                        $menuFloating: $('#header.header-floating-icons .header-container > .header-row'),

                        build: function () {
                            var self = this;

                            self.init();
                        },
                        init: function () {
                            var self = this,
                                    divisor = 0;

                            $(window).scroll(function () {
                                var scrollPercent = 100 * $(window).scrollTop() / ($(document).height() - $(window).height()),
                                        st = $(this).scrollTop();

                                divisor = $(document).height() / $(window).height();

                                self.$menuFloating.find('.header-column > .header-row').css({
                                    transform: 'translateY( calc(' + scrollPercent + 'vh - ' + st / divisor + 'px) )'
                                });
                            });
                        }
                    }

                    menuFloatingAnim.build();

                }

                // Slide
                if ($('.header-nav-links-vertical-slide').get(0)) {
                    var slideNavigation = {
                        $mainNav: $('#mainNav'),
                        $mainNavItem: $('#mainNav li'),

                        build: function () {
                            var self = this;

                            self.menuNav();
                        },
                        menuNav: function () {
                            var self = this;

                            self.$mainNavItem.on('click', function (e) {
                                var currentMenuItem = $(this),
                                        currentMenu = $(this).parent(),
                                        nextMenu = $(this).find('ul').first(),
                                        prevMenu = $(this).closest('.next-menu'),
                                        isSubMenu = currentMenuItem.hasClass('dropdown') || currentMenuItem.hasClass('dropdown-submenu'),
                                        isBack = currentMenuItem.hasClass('back-button'),
                                        nextMenuHeightDiff = ((nextMenu.find('> li').length * nextMenu.find('> li').outerHeight()) - nextMenu.outerHeight()),
                                        prevMenuHeightDiff = ((prevMenu.find('> li').length * prevMenu.find('> li').outerHeight()) - prevMenu.outerHeight());

                                if (isSubMenu) {
                                    currentMenu.addClass('next-menu');
                                    nextMenu.addClass('visible');
                                    currentMenu.css({
                                        overflow: 'visible',
                                        'overflow-y': 'visible'
                                    });

                                    if (nextMenuHeightDiff > 0) {
                                        nextMenu.css({
                                            overflow: 'hidden',
                                            'overflow-y': 'scroll'
                                        });
                                    }

                                    for (i = 0; i < nextMenu.find('> li').length; i++) {
                                        if (nextMenu.outerHeight() < ($('.header-row-side-header').outerHeight() - 100)) {
                                            nextMenu.css({
                                                height: nextMenu.outerHeight() + nextMenu.find('> li').outerHeight()
                                            });
                                        }
                                    }

                                    nextMenu.css({
                                        'padding-top': nextMenuHeightDiff + 'px'
                                    });
                                }

                                if (isBack) {
                                    currentMenu.parent().parent().removeClass('next-menu');
                                    currentMenu.removeClass('visible');

                                    if (prevMenuHeightDiff > 0) {
                                        prevMenu.css({
                                            overflow: 'hidden',
                                            'overflow-y': 'scroll'
                                        });
                                    }
                                }

                                e.stopPropagation();
                            });
                        }
                    }

                    $(window).trigger('resize');

                    if ($(window).width() > 991) {
                        slideNavigation.build();
                    }

                    $(document).ready(function () {
                        $(window).afterResize(function () {
                            if ($(window).width() > 991) {
                                slideNavigation.build();
                            }
                        });
                    });
                }

                // Header Nav Main Mobile Dark
                if ($('.header-nav-main-mobile-dark').get(0)) {
                    $('#header:not(.header-transparent-dark-bottom-border):not(.header-transparent-light-bottom-border)').addClass('header-no-border-bottom');
                }

                return this;
            },

            events: function () {
                var self = this,
                        $html = $('html'),
                        $header = $('#header'),
                        $window = $(window),
                        headerBodyHeight = $('.header-body').outerHeight();

                $header.find('a[href="#"]').on('click', function (e) {
                    e.preventDefault();
                });

                // Mobile Arrows
                $header.find('.dropdown-toggle, .dropdown-submenu > a')
                        .append('<i class="fas fa-chevron-down"></i>');

                $header.find('.dropdown-toggle[href="#"], .dropdown-submenu a[href="#"], .dropdown-toggle[href!="#"] .fa-chevron-down, .dropdown-submenu a[href!="#"] .fa-chevron-down').on('click', function (e) {
                    e.preventDefault();
                    if ($window.width() < 992) {
                        $(this).closest('li').toggleClass('open');

                        // Adjust Header Body Height
                        var height = ($header.hasClass('header-effect-shrink') && $html.hasClass('sticky-header-active')) ? theme.StickyHeader.options.stickyHeaderContainerHeight : headerBodyHeight;
                        $('.header-body').animate({
                            height: ($('.header-nav-main nav').outerHeight(true) + height) + 10
                        }, 0);
                    }
                });

                $header.find('li a.active').addClass('current-page-active');

                // Add Open Class
                $header.find('.header-nav-click-to-open .dropdown-toggle[href="#"], .header-nav-click-to-open .dropdown-submenu a[href="#"], .header-nav-click-to-open .dropdown-toggle > i').on('click', function (e) {
                    e.preventDefault();
                    e.stopPropagation();
                    if ($window.width() > 991) {

                        $header.find('li a.active').removeClass('active');

                        if ($(this).prop('tagName') == 'I') {
                            $(this).parent().addClass('active');
                        } else {
                            $(this).addClass('active');
                        }

                        if (!$(this).closest('li').hasClass('open')) {

                            var $li = $(this).closest('li'),
                                    isSub = false;

                            if ($(this).parent().hasClass('dropdown-submenu')) {
                                isSub = true;
                            }

                            $(this).closest('.dropdown-menu').find('.dropdown-submenu.open').removeClass('open');
                            $(this).parent('.dropdown').parent().find('.dropdown.open').removeClass('open');

                            if (!isSub) {
                                $(this).parent().find('.dropdown-submenu.open').removeClass('open');
                            }

                            $li.addClass('open');

                            $(document).off('click.nav-click-to-open').on('click.nav-click-to-open', function (e) {
                                if (!$li.is(e.target) && $li.has(e.target).length === 0) {
                                    $li.removeClass('open');
                                    $li.parents('.open').removeClass('open');
                                    $header.find('li a.active').removeClass('active');
                                    $header.find('li a.current-page-active').addClass('active');
                                }
                            });

                        } else {
                            $(this).closest('li').removeClass('open');
                            $header.find('li a.active').removeClass('active');
                            $header.find('li a.current-page-active').addClass('active');
                        }

                        $window.trigger({
                            type: 'resize',
                            from: 'header-nav-click-to-open'
                        });
                    }
                });

                // Collapse Nav
                $header.find('[data-collapse-nav]').on('click', function (e) {
                    $(this).parents('.collapse').removeClass('show');
                });

                // Top Features
                $header.find('.header-nav-features-toggle').on('click', function (e) {
                    e.preventDefault();

                    var $toggleParent = $(this).parent();

                    if (!$(this).siblings('.header-nav-features-dropdown').hasClass('show')) {

                        var $dropdown = $(this).siblings('.header-nav-features-dropdown');

                        $('.header-nav-features-dropdown.show').removeClass('show');

                        $dropdown.addClass('show');

                        $(document).off('click.header-nav-features-toggle').on('click.header-nav-features-toggle', function (e) {
                            if (!$toggleParent.is(e.target) && $toggleParent.has(e.target).length === 0) {
                                $('.header-nav-features-dropdown.show').removeClass('show');
                            }
                        });

                        if ($(this).attr('data-focus')) {
                            $('#' + $(this).attr('data-focus')).focus();
                        }

                    } else {
                        $(this).siblings('.header-nav-features-dropdown').removeClass('show');
                    }
                });

                // Hamburguer Menu
                var $hamburguerMenuBtn = $('.hamburguer-btn:not(.side-panel-toggle)'),
                        $hamburguerSideHeader = $('#header.side-header, #header.side-header-overlay-full-screen');

                $hamburguerMenuBtn.on('click', function () {
                    if ($(this).attr('data-set-active') != 'false') {
                        $(this).toggleClass('active');
                    }
                    $hamburguerSideHeader.toggleClass('side-header-hide');
                    $html.toggleClass('side-header-hide');

                    $window.trigger('resize');
                });

                $('.hamburguer-close:not(.side-panel-toggle)').on('click', function () {
                    $('.hamburguer-btn:not(.hamburguer-btn-side-header-mobile-show)').trigger('click');
                });

                // Set Header Body Height when open mobile menu
                $('.header-nav-main nav').on('show.bs.collapse', function () {
                    $(this).removeClass('closed');

                    // Add Mobile Menu Opened Class
                    $('html').addClass('mobile-menu-opened');

                    $('.header-body').animate({
                        height: ($('.header-body').outerHeight() + $('.header-nav-main nav').outerHeight(true)) + 10
                    });

                    // Header Below Slider / Header Bottom Slider - Scroll to menu position
                    if ($('#header').is('.header-bottom-slider, .header-below-slider') && !$('html').hasClass('sticky-header-active')) {
                        self.scrollToTarget($('#header'), 0);
                    }
                });

                // Set Header Body Height when collapse mobile menu
                $('.header-nav-main nav').on('hide.bs.collapse', function () {
                    $(this).addClass('closed');

                    // Remove Mobile Menu Opened Class
                    $('html').removeClass('mobile-menu-opened');

                    $('.header-body').animate({
                        height: ($('.header-body').outerHeight() - $('.header-nav-main nav').outerHeight(true))
                    }, function () {
                        $(this).height('auto');
                    });
                });

                // Header Effect Shrink - Adjust header body height on mobile
                $window.on('stickyHeader.activate', function () {
                    if ($window.width() < 992 && $header.hasClass('header-effect-shrink')) {
                        if ($('.header-btn-collapse-nav').attr('aria-expanded') == 'true') {
                            $('.header-body').animate({
                                height: ($('.header-nav-main nav').outerHeight(true) + theme.StickyHeader.options.stickyHeaderContainerHeight) + (($('.header-nav-bar').get(0)) ? $('.header-nav-bar').outerHeight() : 0)
                            });
                        }
                    }
                });

                $window.on('stickyHeader.deactivate', function () {
                    if ($window.width() < 992 && $header.hasClass('header-effect-shrink')) {
                        if ($('.header-btn-collapse-nav').attr('aria-expanded') == 'true') {
                            $('.header-body').animate({
                                height: headerBodyHeight + $('.header-nav-main nav').outerHeight(true) + 10
                            });
                        }
                    }
                });

                // Remove Open Class on Resize		
                $window.on('resize.removeOpen', function (e) {
                    if (e.from == 'header-nav-click-to-open') {
                        return;
                    }

                    setTimeout(function () {
                        if ($window.width() > 991) {
                            $header.find('.dropdown.open').removeClass('open');
                        }
                    }, 100);
                });

                // Side Header - Change value of initial header body height
                $(document).ready(function () {
                    if ($window.width() > 991) {
                        var flag = false;

                        $window.on('resize', function (e) {
                            if (e.from == 'header-nav-click-to-open') {
                                return;
                            }

                            $header.find('.dropdown.open').removeClass('open');

                            if ($window.width() < 992 && flag == false) {
                                headerBodyHeight = $('.header-body').outerHeight();
                                flag = true;

                                setTimeout(function () {
                                    flag = false;
                                }, 500);
                            }
                        });
                    }
                });

                // Side Header - Set header height on mobile
                if ($html.hasClass('side-header')) {
                    if ($window.width() < 992) {
                        $header.css({
                            height: $('.header-body .header-container').outerHeight() + (parseInt($('.header-body').css('border-top-width')) + parseInt($('.header-body').css('border-bottom-width')))
                        });
                    }

                    $(document).ready(function () {
                        $window.afterResize(function () {
                            if ($window.width() < 992) {
                                $header.css({
                                    height: $('.header-body .header-container').outerHeight() + (parseInt($('.header-body').css('border-top-width')) + parseInt($('.header-body').css('border-bottom-width')))
                                });
                            } else {
                                $header.css({
                                    height: ''
                                });
                            }
                        });
                    });
                }

                // Anchors Position
                $('[data-hash]').each(function () {

                    var target = $(this).attr('href'),
                            offset = ($(this).is("[data-hash-offset]") ? $(this).data('hash-offset') : 0);

                    if ($(target).get(0)) {
                        $(this).on('click', function (e) {
                            e.preventDefault();

                            if (!$(e.target).is('i')) {

                                // Close Collapse if open
                                $(this).parents('.collapse.show').collapse('hide');

                                // Close Side Header
                                $hamburguerSideHeader.addClass('side-header-hide');
                                $html.addClass('side-header-hide');

                                $window.trigger('resize');

                                self.scrollToTarget(target, offset);

                            }

                            return;
                        });
                    }

                });

                // Floating
                if ($('#header.header-floating-icons').get(0)) {

                    $('#header.header-floating-icons [data-hash]').off().each(function () {

                        var target = $(this).attr('href'),
                                offset = ($(this).is("[data-hash-offset]") ? $(this).data('hash-offset') : 0);

                        if ($(target).get(0)) {
                            $(this).on('click', function (e) {
                                e.preventDefault();

                                $('html, body').animate({
                                    scrollTop: $(target).offset().top - offset
                                }, 600, 'easeOutQuad', function () {

                                });

                                return;
                            });
                        }

                    });

                }

                // Side Panel Toggle
                if ($('.side-panel-toggle').get(0)) {
                    var init_html_class = $('html').attr('class');

                    $('.side-panel-toggle').on('click', function (e) {
                        var extra_class = $(this).data('extra-class'),
                                delay = (extra_class) ? 100 : 0;

                        e.preventDefault();

                        if ($(this).hasClass('active')) {
                            $('html').removeClass('side-panel-open');
                            $('.hamburguer-btn.side-panel-toggle:not(.side-panel-close)').removeClass('active');
                            return false;
                        }

                        if (extra_class) {
                            $('.side-panel-wrapper').css('transition', 'none');
                            $('html')
                                    .removeClass()
                                    .addClass(init_html_class)
                                    .addClass(extra_class);
                        }

                        setTimeout(function () {
                            $('.side-panel-wrapper').css('transition', '');
                            $('html').toggleClass('side-panel-open');
                        }, delay);
                    });

                    $(document).on('click', function (e) {
                        if (!$(e.target).closest('.side-panel-wrapper').get(0) && !$(e.target).hasClass('side-panel-toggle')) {
                            $('.hamburguer-btn.side-panel-toggle:not(.side-panel-close)').removeClass('active');
                            $('html').removeClass('side-panel-open');
                        }
                    });
                }

                return this;
            },

            scrollToTarget: function (target, offset) {
                var self = this;

                $('body').addClass('scrolling');

                $('html, body').animate({
                    scrollTop: $(target).offset().top - offset
                }, self.options.scrollDelay, self.options.scrollAnimation, function () {
                    $('body').removeClass('scrolling');
                });

                return this;

            }

        }

    });

}).apply(this, [window.theme, jQuery]);

// Search
(function (theme, $) {

    theme = theme || {};

    var initialized = false;

    $.extend(theme, {

        Search: {

            defaults: {
                wrapper: $('#searchForm')
            },

            initialize: function ($wrapper, opts) {
                if (initialized) {
                    return this;
                }

                initialized = true;
                this.$wrapper = ($wrapper || this.defaults.wrapper);

                this
                        .setOptions(opts)
                        .build();

                return this;
            },

            setOptions: function (opts) {
                this.options = $.extend(true, {}, this.defaults, opts, theme.fn.getOptions(this.$wrapper.data('plugin-options')));

                return this;
            },

            build: function () {
                if (!($.isFunction($.fn.validate))) {
                    return this;
                }

                this.$wrapper.validate({
                    errorPlacement: function (error, element) {}
                });

                // Search Reveal
                $('.header-nav-features-search-reveal').each(function () {

                    var $el = $(this)
                    $header = $('#header'),
                            $html = $('htmnl');

                    $el.find('.header-nav-features-search-show-icon').on('click', function () {
                        $el.addClass('show');
                        $header.addClass('search-show');
                        $html.addClass('search-show');
                        $('#headerSearch').focus();
                    });

                    $el.find('.header-nav-features-search-hide-icon').on('click', function () {
                        $el.removeClass('show');
                        $header.removeClass('search-show');
                        $html.removeClass('search-show');
                    });

                });

                return this;
            }

        }

    });

}).apply(this, [window.theme, jQuery]);

