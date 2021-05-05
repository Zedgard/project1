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

