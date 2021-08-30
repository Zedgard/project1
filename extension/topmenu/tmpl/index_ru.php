<!-- Верхнее меню -->
<!-- Mobile Metas -->	

<!-- Theme CSS -->
<link rel="stylesheet" href="/assets/css/porto/css/theme.css<?= $_SESSION['rand'] ?>">
<link rel="stylesheet" href="/assets/css/porto/css/theme-elements.css<?= $_SESSION['rand'] ?>">

<!-- Skin CSS -->
<link rel="stylesheet" href="/assets/css/porto/css/skins/skin-corporate-4.css<?= $_SESSION['rand'] ?>">	

<!-- Theme Base, Components and Settings background-cover -->
<script src="/assets/css/porto/js/theme.js<?= $_SESSION['rand'] ?>"></script>
<header id="header" class="header-body-bg background-cover">
    <div class="border-top-none" style="display: none;"></div>
    <div style="height: 121px;">
        <div class="header-body border-top-0 background-cover" style="">

            <div class="container"> <!-- header-container --> 

                <div class="row  mt-3">
                    <div class="col-lg mb-2 mobile_contxt_center d-none d-md-block">
                        <div class="header_mobile_app_block mobile_contxt_center">
                            <i class="app_block_text">Мобильное приложение</i>
                        </div>
                        <a href="https://play.google.com/store/apps/details?id=ru.dvfx.edgardzaitsev" target="_blank"><img src="/assets/img/google_play.png" class="mobile_apk_img1" /></a>
                        <a href="https://apps.apple.com/us/app/эдгард-зайцев/id1468250750" target="_blank"><img src="/assets/img/app_store.svg" class="mobile_apk_img2" /></a>
                    </div>
                    <div class="col-lg mb-2 mobile_contxt_center" style="display: none;">
                        <span <?= ($_SESSION['config']['language_enable'] == '1') ? '' : 'style="display: none;"' ?>>
                            <a href="#"><img src="/assets/img/lang_ru.svg" class="flag" /></a>
                            <a href="#"><img src="/assets/img/lang_us.svg" class="flag" /></a>
                            <a href="#"><img src="/assets/img/lang_ch.svg" class="flag" /></a>
                        </span>
                    </div>
                    <!--
                    <div class="col-lg-2 mb-2 mobile_contxt_center" style="text-align: center;">
                        
                    </div>
                    
                    <div class="col-lg-2 mb-2 mobile_contxt_center" style="text-align: center;">

                        <a href="#" class="header_close_club" style="color: #519a80;">Закрытый клуб</a>
                    </div>
                    -->
                    <div class="col-lg contxt_right">

                        <div style="float: right;margin-top: 4px;">
                            <!--<a href="/auth/" class="header_close_club" style="color: #519a80;">Закрытый клуб</a> | -->
                            <?
                            if (strlen(trim($_SESSION['user']['info']['first_name'])) > 0) {
                                $show_user_name = $_SESSION['user']['info']['first_name'];
                            } else {
                                $show_user_name = $_SESSION['user']['info']['email'];
                            }
                            ?>
                            <a href="/auth/" class="header_close_club">Мой кабинет<?= (isset($_SESSION['user']['info']['id'])) ? ': <span>' . $show_user_name : '</span>' ?> </a>  
                            <? if (isset($_SESSION['user']['info']['id'])): ?>
                                <a href="javascript:void(0)" class="btn_logout header_user_auth btn_logout" title="Выйти из личного кабинета"><i class="fas fa-sign-out-alt"></i></a>
                            <? endif; ?>
                        </div>
                        <div style="float: left;" class="soc_links d-block d-lg-none">
                            <a href="https://t.me/edgardzaitsev_channel" target="_blank"><i class="fab fa-telegram-plane mr-3" style="font-size: 24px;color: #519a80;"></i></a>
                            <a href="https://www.youtube.com/user/zaiaz67" target="_blank"><i class="fab fa-youtube mr-3" style="font-size: 24px;color: #519a80;"></i></a>
                            <a href="https://instagram.com/edgard_zaycev" target="_blank"><i class="fab fa-instagram" style="font-size: 24px;color: #519a80;"></i></a>
                        </div>
                        <div style="float: right;margin-right: 1rem;" class="soc_links d-none d-lg-block">
                            <a href="https://t.me/edgardzaitsev_channel" target="_blank"><i class="fab fa-telegram-plane mr-3" style="font-size: 24px;color: #519a80;"></i></a>
                            <a href="https://www.youtube.com/user/zaiaz67" target="_blank"><i class="fab fa-youtube mr-3" style="font-size: 24px;color: #519a80;"></i></a>
                            <a href="https://instagram.com/edgard_zaycev" target="_blank"><i class="fab fa-instagram" style="font-size: 24px;color: #519a80;"></i></a>
                        </div>

<!--<span class="header_user_auth"> <a href="/auth/" class="header_close_club" style="color: #808080;"> </a></span> -->
                    </div>
                </div>

                <div class="header-row">
                    <div class="header-column">
                        <div class="header-row">
                            <div class="header-logo">
                                <a href="/">
                                    <img class="header_logo" data-sticky-width="82" data-sticky-height="40" src="/logo3.svg">
                                </a>
                            </div>
                        </div>
                    </div>

                    <div class="header-column justify-content-end">
                        <div class="header-row">
                            <div class="header-nav header-nav-line header-nav-top-line header-nav-top-line-with-border order-2 order-lg-1">
                                <div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
                                    <?= $_SESSION['site_menu']['top'] ?>
                                </div>
                                <button class="btn header-btn-collapse-nav" data-focus="headerSearch">
                                    <i class="fas fa-bars"></i>
                                </button>
                            </div>
                            <div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
                                <!--
                                <div class="header-nav-feature header-nav-features-search d-inline-flex"  style="float: left;margin-right: 14px;">
                                    <a href="#" class="header-nav-features-toggle" data-focus="headerSearch">
                                        <i class="fa fa-search fa-2x header-nav-top-icon"></i>
                                    </a>											
                                    <div class="header-nav-features-dropdown" id="headerTopSearchDropdown">
                                        <form role="search" action="page-search-results.html" method="get">
                                            <div class="simple-search input-group">		
                                                <!-- <div class="fa-search-block"><i class="fa fa-search"></i></div> ->
                                                <input class="form-control" name="search" type="search" value="" placeholder="Поиск..." style="width: 100%;">								
                                            </div>
                                        </form>
                                    </div>
                                </div> 
                                -->
                                <div class="header-nav-feature header-nav-features-cart d-inline-flex" style="float: right;">
                                    <a href="javascript:void(0)" class="header-nav-features-toggle">
                                        <i class="fa fa-shopping-basket fa-4x header-nav-top-icon-img d-none d-lg-block" style="font-size: 1.6rem;"></i>
                                        <i class="fa fa-shopping-basket fa-4x header-nav-top-icon-img d-lg-none" style="font-size: 2.4rem;margin-top: 10px;"></i>
                                        <!--<img src="/assets/img/shop/icon-cart.svg" width="18" alt="" class="header-nav-top-icon-img">-->	
                                        <span class="cart-info" style="display: none;">					
                                            <span class="cart-qty">0</span>	
                                        </span>							
                                    </a>											
                                    <div class="header-nav-features-dropdown" id="headerTopCartDropdown">
                                        <ol class="mini-products-list">



                                        </ol>
                                        <hr/>

                                        <div class="totals mb-1">	
                                            <span class="label">Итог:</span>													
                                            <span class="price-total"><span class="total_cart">0</span></span>												
                                        </div> 
                                        <div class="totals total_promo_cart mb-2">	
                                            <span class="label" style="font-size: 0.7rem;color: #808080;">Скидка:</span>													
                                            <span class="price-total"><span class="price_promo_total" style="font-size: 0.7rem;color: #808080;">0</span></span>												
                                        </div>

                                        <div class="actions">
                                            <?
                                            /*
                                              <a class="btn btn-outline-primary" href="/shop/cart/">В корзину</a>
                                              <a class="btn btn-outline-success" href="/shop/cart/?pay=1">Купить</a>
                                             */
                                            ?>
                                            <a href="/shop/cart/" class="btn button btngreen textcenter" product_id="20" style="font-size: 1rem;font-weight: bold;padding-top: 10px;padding-bottom: 10px;width: 100%">Перейти в корзину</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?
            // отобразим только на главной
            if ($_SESSION['page_url'] == 'index' && 1 == 2) {
                ?>
                <div class="container plastik_block" style="margin-top: 50px;display: none;">
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <a href="#" class="image hover-effect img-container">
                                <img src="/assets/img/EZsite_button_Centr.svg" class="plastik" />
                            </a>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <a href="#" class="image hover-effect img-container">
                                <img src="/assets/img/EZsite_button_Centr.svg" class="plastik" />
                            </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 mb-4">
                            <a href="#" class="image hover-effect img-container">
                                <img src="/assets/img/EZsite_button_Centr.svg" class="plastik" />
                            </a>
                        </div>
                        <div class="col-lg-6 mb-4">
                            <a href="#" class="image hover-effect img-container">
                                <img src="/assets/img/EZsite_button_Centr.svg" class="plastik" />
                            </a>
                        </div>
                    </div>
                </div>
                <?
            }
            ?>

        </div>
    </div>
</header>

<footer_menu class="d-block d-lg-none footer_mobile_menu">
    <div class="footer_mobile_menu_div">
        <span></span>
        <a href="/" class="footer_menu_link">
            <img src="/assets/img/footer_links/footer_link_home.svg"/>
        </a>
        <a href="/consultations/" class="footer_menu_link">
            <img src="/assets/img/footer_links/footer_link_monthly_calendar.svg"/>
        </a>
        <a href="/shop/" class="footer_menu_link">
            <img src="/assets/img/footer_links/footer_link_search.svg"/>
        </a>
        <a href="/shop/cart/" class="footer_menu_link">
            <img src="/assets/img/footer_links/footer_link_shopping_cart.svg"/>
        </a>
        <a href="/auth/" class="footer_menu_link">
            <img src="/assets/img/footer_links/footer_link_user.svg"/>
        </a>
    </div>
</footer_menu>

<? if ($_SESSION['cookie_access'] == 0): ?>
    <div class="bottom_cookie_block">
        <div class="bottom_cookie_text">
            Cайт <?= $_SERVER['SERVER_NAME'] ?> использует файлы cookie и другие технологии для вашего удобства пользования сайтом, анализа использования наших товаров и услуг и повышения качества рекомендаций. <a href="/cookie/" target="_blank">Подробнее</a>
        </div>
        <div class="bottom_cookie_block_btn">
            <button type="button" aria-label="" role="button" class="bottom_cookie_btn">Хорошо</button>
        </div>
        <div class="bottom_cookie_desktop_hide d-block d-lg-none"></div>
    </div>
<? endif; ?>

<!-- Theme Initialization Files -->
<script src="/assets/css/porto/js/theme.init.js<?= $_SESSION['rand'] ?>"></script>

<!-- Верхнее меню конец -->