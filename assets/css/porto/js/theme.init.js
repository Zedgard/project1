// Commom Partials
(function ($) {

    // Nav Menu
    if (typeof theme.Nav !== 'undefined') {
        theme.Nav.initialize();
    }

    // Search
    if (typeof theme.Search !== 'undefined') {
        theme.Search.initialize();
    }

    $(".header-btn-collapse-nav").click(function () {
        var s = $(".header-nav-main").find("nav").hasClass("show");
        console.log("s: " + s);
        if ($(".header-nav-main").find("nav").hasClass("show")) {
            $(".header-nav-main").find("nav").addClass("hide");
            if ($(".header-nav-main").find("nav").hasClass("show")) {
                $(".header-nav-main").find("nav").removeClass("show");
            }
            //$(".header-nav-main").find("nav").addClass("show");
            //$(".header-nav-main").find("nav").removeClass()("hide");
        } else {
            $(".header-nav-main").find("nav").addClass("show");
            if ($(".header-nav-main").find("nav").hasClass("hide")) {
                $(".header-nav-main").find("nav").removeClass("hide");
            }
        }

    });
    
    if(!!$('.dropdown-item')){
        $('.dropdown-item[href="#"]').unbind('click').click(function () {
            $(this).closest('.dropdown').find('ul.dropdown-menu').toggle(200);
            //console.log(111);
        });
    }



}).apply(this, [jQuery]);
