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
                        	<a href="https://vk.com/edgarzaicev" target="_blank">
                        	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="mdi-vk" height="38.4" viewBox="0 0 30 30" fill="#519a80"><path d="M15.07 2H8.93C3.33 2 2 3.33 2 8.93V15.07C2 20.67 3.33 22 8.93 22H15.07C20.67 22 22 20.67 22 15.07V8.93C22 3.33 20.67 2 15.07 2M18.15 16.27H16.69C16.14 16.27 15.97 15.82 15 14.83C14.12 14 13.74 13.88 13.53 13.88C13.24 13.88 13.15 13.96 13.15 14.38V15.69C13.15 16.04 13.04 16.26 12.11 16.26C10.57 16.26 8.86 15.32 7.66 13.59C5.85 11.05 5.36 9.13 5.36 8.75C5.36 8.54 5.43 8.34 5.85 8.34H7.32C7.69 8.34 7.83 8.5 7.97 8.9C8.69 11 9.89 12.8 10.38 12.8C10.57 12.8 10.65 12.71 10.65 12.25V10.1C10.6 9.12 10.07 9.03 10.07 8.68C10.07 8.5 10.21 8.34 10.44 8.34H12.73C13.04 8.34 13.15 8.5 13.15 8.88V11.77C13.15 12.08 13.28 12.19 13.38 12.19C13.56 12.19 13.72 12.08 14.05 11.74C15.1 10.57 15.85 8.76 15.85 8.76C15.95 8.55 16.11 8.35 16.5 8.35H17.93C18.37 8.35 18.47 8.58 18.37 8.89C18.19 9.74 16.41 12.25 16.43 12.25C16.27 12.5 16.21 12.61 16.43 12.9C16.58 13.11 17.09 13.55 17.43 13.94C18.05 14.65 18.53 15.24 18.66 15.65C18.77 16.06 18.57 16.27 18.15 16.27Z" /></svg>
                        	</a>
                        	<a href="https://ok.ru/edgardzaitsev" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 38.4 38.4" height=38.4 fill="#519a80">
    <path d="M120.001,753.38c10.372,0,18.807-8.435,18.807-18.807c0-10.362-8.435-18.799-18.807-18.799 c-10.362,0-18.807,8.437-18.807,18.799C101.194,744.945,109.639,753.38,120.001,753.38z M120.001,689.164 c25.055,0,45.422,20.367,45.422,45.409c0,25.052-20.367,45.427-45.422,45.427c-25.049,0-45.422-20.375-45.422-45.427 C74.579,709.532,94.952,689.164,120.001,689.164z M138.378,652.109c9.247,2.107,18.165,5.765,26.377,10.925 c6.215,3.917,8.089,12.134,4.172,18.35c-3.912,6.23-12.124,8.103-18.35,4.186c-18.605-11.703-42.561-11.698-61.156,0 c-6.227,3.917-14.438,2.043-18.346-4.186c-3.917-6.221-2.049-14.433,4.168-18.35c8.211-5.154,17.129-8.818,26.376-10.925 l-25.395-25.394c-5.192-5.197-5.192-13.621,0.005-18.817c2.601-2.596,6.004-3.897,9.406-3.897c3.408,0,6.816,1.3,9.417,3.897 l24.943,24.954l24.965-24.954c5.192-5.197,13.616-5.197,18.812,0c5.202,5.196,5.202,13.626,0,18.817 C163.773,626.715,138.378,652.109,138.378,652.109z" transform="matrix(.125 0 0 -.125 0 102.5)"/>
</svg></a>
                            <a href="https://t.me/edgardzaitsev_channel" target="_blank"><i class="fab fa-telegram-plane mr-3" style="font-size: 24px;color: #519a80;"></i></a>
                            <a href="https://www.youtube.com/user/zaiaz67" target="_blank"><i class="fab fa-youtube mr-3" style="font-size: 24px;color: #519a80;"></i></a>
                            <a href="https://instagram.com/edgard_zaycev" target="_blank"><i class="fab fa-instagram" style="font-size: 24px;color: #519a80;"></i></a>
                        </div>
                        <div style="float: right;margin-right: 1rem;" class="soc_links d-none d-lg-block">
                        	<a href="https://vk.com/edgarzaicev" target="_blank">
                        	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="mdi-vk" height="38.4" viewBox="0 0 30 30" fill="#519a80"><path d="M15.07 2H8.93C3.33 2 2 3.33 2 8.93V15.07C2 20.67 3.33 22 8.93 22H15.07C20.67 22 22 20.67 22 15.07V8.93C22 3.33 20.67 2 15.07 2M18.15 16.27H16.69C16.14 16.27 15.97 15.82 15 14.83C14.12 14 13.74 13.88 13.53 13.88C13.24 13.88 13.15 13.96 13.15 14.38V15.69C13.15 16.04 13.04 16.26 12.11 16.26C10.57 16.26 8.86 15.32 7.66 13.59C5.85 11.05 5.36 9.13 5.36 8.75C5.36 8.54 5.43 8.34 5.85 8.34H7.32C7.69 8.34 7.83 8.5 7.97 8.9C8.69 11 9.89 12.8 10.38 12.8C10.57 12.8 10.65 12.71 10.65 12.25V10.1C10.6 9.12 10.07 9.03 10.07 8.68C10.07 8.5 10.21 8.34 10.44 8.34H12.73C13.04 8.34 13.15 8.5 13.15 8.88V11.77C13.15 12.08 13.28 12.19 13.38 12.19C13.56 12.19 13.72 12.08 14.05 11.74C15.1 10.57 15.85 8.76 15.85 8.76C15.95 8.55 16.11 8.35 16.5 8.35H17.93C18.37 8.35 18.47 8.58 18.37 8.89C18.19 9.74 16.41 12.25 16.43 12.25C16.27 12.5 16.21 12.61 16.43 12.9C16.58 13.11 17.09 13.55 17.43 13.94C18.05 14.65 18.53 15.24 18.66 15.65C18.77 16.06 18.57 16.27 18.15 16.27Z" /></svg>
                        	</a>
                        	<a href="https://ok.ru/edgardzaitsev" target="_blank"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 38.4 38.4" height=38.4 fill="#519a80">
    <path d="M120.001,753.38c10.372,0,18.807-8.435,18.807-18.807c0-10.362-8.435-18.799-18.807-18.799 c-10.362,0-18.807,8.437-18.807,18.799C101.194,744.945,109.639,753.38,120.001,753.38z M120.001,689.164 c25.055,0,45.422,20.367,45.422,45.409c0,25.052-20.367,45.427-45.422,45.427c-25.049,0-45.422-20.375-45.422-45.427 C74.579,709.532,94.952,689.164,120.001,689.164z M138.378,652.109c9.247,2.107,18.165,5.765,26.377,10.925 c6.215,3.917,8.089,12.134,4.172,18.35c-3.912,6.23-12.124,8.103-18.35,4.186c-18.605-11.703-42.561-11.698-61.156,0 c-6.227,3.917-14.438,2.043-18.346-4.186c-3.917-6.221-2.049-14.433,4.168-18.35c8.211-5.154,17.129-8.818,26.376-10.925 l-25.395-25.394c-5.192-5.197-5.192-13.621,0.005-18.817c2.601-2.596,6.004-3.897,9.406-3.897c3.408,0,6.816,1.3,9.417,3.897 l24.943,24.954l24.965-24.954c5.192-5.197,13.616-5.197,18.812,0c5.202,5.196,5.202,13.626,0,18.817 C163.773,626.715,138.378,652.109,138.378,652.109z" transform="matrix(.125 0 0 -.125 0 102.5)"/>
</svg></a>
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
