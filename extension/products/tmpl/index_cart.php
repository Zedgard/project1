<!-- Карточка товара  style="background-color: #FFFFFF;border: 1px solid #DEDEDE;" -->
<script>
    var products_id = "<?= $productData['id'] ?>";
</script>
<div class="container-fluid">
    <div product_id="<?= $productData['id'] ?>" class="row productElm product_info">
        <div class="col-md-5 mb-4">

            <!-- carousel -->
            <?
            /*
              <div class="carousel-item active">
              <img class="d-block w-100" src="..." alt="First slide">
              </div>
              <div class="carousel-item">
              <img class="d-block w-100" src="..." alt="Second slide">
              </div>
              <div class="carousel-item">
              <img class="d-block w-100" src="..." alt="Third slide">
              </div>
             */
            //print_r($productData);
            ?>
            <div id="carouselExampleIndicators" class="carousel slide m-auto w-100" data-ride="carousel">
                <ol class="carousel-indicators">
                    <?
                    $first = 'active';
                    $i = 0;
                    foreach ($productData['products_wares_info'] as $value):
                        //$array = $value['images'];
                        ?>
                        <li data-target="#carouselExampleIndicators" data-slide-to="<?= $i ?>" class="<?= $first ?>"></li>
                        <?
                        $first = '';
                    endforeach;
                    ?>
                </ol>
                <div class="carousel-inner">
                    <div style="position: absolute;margin-top: 20px;"><?= $title_category_bg ?></div>
                    <?
                    if (strlen($productData['images_str']) > 0) {
                        ?>
                        <div class="carousel-item text-center active">
                            <a href="<?= $productData['images_str'] ?>" class="fancybox"><img class="d-block w-100" style="background-color: #CCCCCC;" src="<?= $productData['images_str'] ?>" ></a>
                        </div>
                        <?
                        $first = '';
                    } else {
                        $first = 'active';
                        foreach ($productData['products_wares_info'] as $value):
                            if (strlen($value['images']) > 0) {
                                ?>
                                <div class="carousel-item text-center <?= $first ?>">
                                    <a href="<?= $value['images'] ?>" class="fancybox"><img class="d-block w-100" style="background-color: #CCCCCC;" src="<?= $value['images'] ?>" ></a>
                                </div>
                                <?
                                $first = '';
                            }
                        endforeach;
                    }
                    ?>
                </div>
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Предыдущая</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Следующая</span>
                </a>
            </div>

        </div>
        <div class="col-md-7 mb-4">
            <!-- Title -->
            <h1 class="product_info_title_card mb-3"><?= $title_category_str ?> <?= $productData['title'] ?></h1>

            <?
            if ($p_user->isEditor()) {
                ?>
                <div class="text-right"><a href="/admin/products/?product_edit=<?= $productData['id'] ?>" target="_blank" class="btn btn-link">Редактировать товар</a></div>
                <?
            }
            ?>
            <div class="mb-5">
                <div class="mb-1">Поделиться в соцсетях</div>
                <?
                // Использовал сервис
                // https://yandex.ru/dev/share/
                ?>
                <script src="https://yastatic.net/share2/share.js"></script>
                <div class="ya-share2" data-curtain data-shape="round" data-services="vkontakte,facebook,odnoklassniki,telegram,viber,whatsapp"></div>
            </div>


            <!-- Price  -->
            <div class="row mb-3">
                <div class="col-md-4 text-left">

                </div>
                <div class="col-md-8 text-right">
                    <? if ($productData['price_promo'] > 0): ?>
                        <div style="clear: both;">
                            <div class="product_old_price float-right"><?= $productData['price'] ?></div>
                            <div class="product_price_promo product_info_price float-right"><?= $productData['price_promo'] ?> <i class="fa fa-ruble faruble_product_price" style="color: #FF0000;"></i></div>

                        </div>
                    <? else: ?>
                        <div style="clear: both;">
                            <span class="product_price product_info_price"><?= $productData['price'] ?></span> <i class="fa fa-ruble faruble_product_price"></i>
                        </div>
                    <? endif; ?>
                    <!-- Price end  --> 
                </div>
            </div>
            <!-- cart button -->
            <div class="row mb-3">
                <div class="col-md-12 text-right">
                    <a href="javascript:void(0)" class="btn button btngreen textcenter cart_product_add pl-5 pr-5" product_id="<?= $productData['id'] ?>">В корзину</a>
                    <div class="btn-group">
                        <a href="/shop/cart/" class="btn button btngreen textcenter cart_product_go_card" product_id="<?= $productData['id'] ?>" style="display: none;">Перейти в корзину</a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm cart_product_remove cart_product_go_card" product_id="<?= $productData['id'] ?>" style="display: none;" title="Удалить из корзины"><i class="fa fa-trash" style="font-size: 1.2rem;padding-top: 6px;"></i></a>
                    </div>
                </div>
            </div>
            <!-- cart button end -->

            <!-- wares titles -->
            <div class="row mb-3">
                <div class="col-md-12">
                    <h3>Товары</h3>
                    <?
                    foreach ($productData['products_wares_info'] as $value):
                        ?>
                        <div class="mb-2 ml-3">
                            <i class="psmark"></i><?= $value['title'] ?>
                        </div>
                        <?
                    endforeach;
                    ?>
                </div>
            </div>
            <!-- wares titles end  -->

            <div class="row mt-3" style="display: none;">
                <div class="col-md-12">
                    <h4>Категория</h4>
                    <div><?= $title_category_str ?></div>
                </div>
            </div> 

            <!-- rating -->
            <div class="row mt-3" style="display: none;">
                <div class="col-md-12 rating">
                    <!-- <p>Средний рейтинг <span class="rating_val"></span></p> -->
                    <div class="rating-mini">
                        <span class="rating_itm_1"></span>	
                        <span class="rating_itm_2"></span>    
                        <span class="rating_itm_3"></span>  
                        <span class="rating_itm_4"></span>    
                        <span class="rating_itm_5"></span>
                    </div>
                    <p>На основе <span class="rating_count"></span> оценок</p>
                </div>
            </div> 

            <!-- Articul -->
            <div>Артикул: 
                <?
                $articul = array();
                foreach ($productData['products_wares_info'] as $value):
                    $articul[] = $value['articul'];
                endforeach;
                $articul_str = implode(', ', $articul);
                echo $articul_str;
                ?>
            </div>

        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <h2 class="mb-3" style="font-size: 2.3rem;font-weight: 700;color: #000000;">Описание:</h2>
            <div class="product_descr"><?= $productData['desc'] ?></div>


        </div>
    </div>


    <!-- Блоки "Кому подходит и Вы получите" --> 
    <?
    if ($productData['block_profit'] == '1') {
        include 'index_block_profit.php';
    }
    ?>

    <!-- Блоки "Трейлер продукта" --> 
    <?
    if ($productData['block_trailer'] == '1') {
        include 'index_block_trailer.php';
    }
    ?>

    <!-- Блоки "Трейлер продукта" --> 
    <?
    if ($productData['block_feedback'] == '1') {
        include 'index_block_feedback.php';
    }
    ?>

    <div style="height: 1rem;"></div>
    <div class="row">
        <div class="col-md-12">
            <h2 class="mb-5 block_trailer_title" style="text-align: left;">Рекомендуем вам:</h2>
            <div class="row container_mix row-cols-1 row-cols-md-3" data-ref="mixitup-container">
                <?
                //$obj_product['products_wares'] = $this->getProducts_wares($obj_product['id']);
                //$obj_product['products_category'] = $this->getProducts_category($obj_product['id']);
                //$obj_product['products_topic'] = $this->getProducts_topic($obj_product['id']);
                //$i_col = 3; // колличество отображаемых
                //$a_col = 0; // итерация
                //echo "p_count: {$productsFilterCount} p1: {$rand_product1} p2: {$rand_product2} p3: {$rand_product3} <br/>\n";
                for ($i = 0; $i < $productsFilterCount; $i++) {
                    // echo "{$i} <br/>\n";
                    if ($i == $rand_product1 || $i == $rand_product2 || $i == $rand_product3) {
                        //  echo " - {$i} <br/>\n";
//                        $a_col++;
//                        $iter_css = 'margin-left: 4.433%;';
//                        if($a_col == 1){
//                            $iter_css = '';
//                        }
//                        if($i_col == $a_col){
//                            $a_col = 0;
//                        }
                        // Найдем товары
                        //$waresInfo = $c_product->getWaresInfo($productsFilterArray[$i]['wares_ids']);
                        // Определим категорию
                        $title_category = '';
                        $exp_category_ids = explode(',', $productsFilterArray[$i]['category_ids']);
                        $category_count = count($exp_category_ids);
//
                        $class_category = '';
                        $color_category = '';
                        $title_category = '';
                        $category_title = '';
                        $item_category_id = '0';
                        if ($category_count > 0) {
                            for ($c = 0; $c < $category_count; $c++) {
                                for ($c2 = 0; $c2 < count($categoryArray); $c2++) {
                                    if ($categoryArray[$c2]['id'] == $exp_category_ids[$c]) {
                                        $positio_z = $c * 2.8;
                                        $position = "margin-top: {$positio_z}rem;";
                                        $bg_category = 'background-color: ' . $categoryArray[$c2]['color'] . ';';
                                        $color_category = 'color: ' . $categoryArray[$c2]['color'] . ';';
                                        $title_category .= "<span class=\"class_category_lbl opacity50\" style=\"{$bg_category}{$position}\">{$categoryArray[$c2]['title']}</span>";
                                        $class_category .= 'category-' . $categoryArray[$c2]['id'] . ' ';
                                        $category_title .= "<span class=\"class_category\" style=\"{$color_category}\">{$categoryArray[$c2]['title']}</span> ";
                                        $item_category_id = $categoryArray[$c2]['id'];
                                    }
                                }
                                //$category_title = $category_title . "<span class=\"class_category\" style=\"{$color_category}\">:</span>";
                            }
//                            if(strlen($category_title)>0){
//                                $category_title = $category_title . ' ';
//                            }
                        }

                        // border: 1px solid #CCC;
                        // category_name=" $categoryArray[$item_category_id] " data-ref="mixitup-target"
                        // $class_category
                        ?>
                        <div class="col mb-4 mixitup-container <?= $class_category ?>" i='<?= $i ?>' data-ref="mixitup-target" style="<?= $display ?>">
                            <div class="card p-4 item" style="height: 420px;"> 
                                <div class="row h-100 d-inline-block pl-3 pr-3">
                                    <div class="col-12 h-100 d-flex flex-column product_info">
                                        <?= $title_category ?>
                                        <div class="row waresListImages">
                                            <?
                                            /*
                                             * Product Images
                                             */
                                            $image = $c_product->checkImageFile($productsFilterArray[$i]['images_str']);
                                            if (strlen($image) > 0) {
                                                ?>
                                                <div class="<?= $sclass_boot ?> align-self-center text-center w-100 <?= ($ii > 0) ? $scaleN : $scale ?>">
                                                    <a href="<?= urlRequestAddLink('product=' . $productsFilterArray[$i]['id']) ?>">
                                                        <img data-src="<?= $productsFilterArray[$i]['images_str'] ?>" src="/assets/img/no_tovar_bg.jpg" class="lazyload waresImg waresListImagesStyle1" title="<?= $productsFilterArray[$i]['title'] ?>" />
                                                    </a>
                                                </div>    
                                                <?
                                            } else {
                                                ?>
                                                <div class="<?= $sclass_boot ?> align-self-center  text-center w-100 <?= ($ii > 0) ? $scaleN : $scale ?>">
                                                    <a href="<?= urlRequestAddLink('product=' . $productsFilterArray[$i]['id']) ?>">
                                                        <img data-src="/assets/img/no_tovar_bg.jpg" src="/assets/img/no_tovar_bg.jpg" class="lazyload waresListImagesStyle1" title="<?= $productsFilterArray[$i]['title'] ?>" />
                                                    </a>
                                                </div>
                                                <?
                                            }
                                            ?>
                                        </div>
                                        <div class="row mt-2">
                                            <div class="col-mb-12">
                                                <? if ($productsFilterArray[$i]['price_promo'] > 0): ?>
                                                    <div style="clear: both;">
                                                        <span class="init_price_val product_info_price" style="color:#FF0000;"><?= $productsFilterArray[$i]['price_promo'] ?></span>
                                                        <span class="wares_old_price" style="margin-left: 16px;"><span class="init_price_val"><?= $productsFilterArray[$i]['price'] ?></span> <i class="fa fa-ruble"></i></span>
                                                    </div>
                                                <? else: ?>
                                                    <div style="clear: both;">
                                                        <span class="init_price_val product_info_price"><?= $productsFilterArray[$i]['price'] ?></span> <i class="fa fa-ruble"></i>
                                                    </div>
                                                <? endif; ?>
                                            </div>
                                        </div>
                                        <div class="row mt-1">
                                            <div class="col-mb-12">
                                                <div style="clear: both;"> 
                                                    <a href="<?= urlRequestAddLink('product=' . $productsFilterArray[$i]['id']) ?>" class="product_links product_info_title_card">
                                                        <?= $category_title ?>&nbsp;&nbsp;<span class="cart_product_title"><?= mb_strimwidth($productsFilterArray[$i]['title'], 0, 100, "...") ?></span>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row mt-3 mt-auto bd-highlight">
                                            <div class="col-12 p-0 m-0">
                                                <? if ($productsFilterArray[$i]['product_new'] == '1'): ?>
                                                    <div class="float-left">
                                                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" viewBox="0 0 35 35">
                                                        <image id="new" width="35" height="35" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC8AAAAwCAYAAACBpyPiAAADwklEQVRogd2ab2hPURjHP7bf5t/YykLRJKZYRFLkz4u9JLXSWl7RRCSLtyYUySvtFZYymrzRamhT8waTFyRipjbEXghta5QM4+j8PFfH3e+ec+/P3X6/n2893XvPfc55vvfc55z7POdcFMQtExTsUnBbwWs57pTyWG3FTbxQQYsClUJa5H5Wkp+ioCOAuCcdojfu5PMVzFVQlOJesYI7DuKeaL3iFG0USfv5YTkl/dCBQuAosAcoEdV+4CXQC7wHNgOL3E39QQ9wHZgFlAMLgFK5OQScEZvfrK2EeMIgHx5raflXt6nMEHFPKm388hyvd2MEVxgLWO27yC/PMHmrfRf5pfFyiQyrfRt5PRPMzCz3pP1ZQTdt5DeMDZ/IWB9YIeATv1fBQIZnGk8GhM+o0MK8SCjYruBNlpD2yxvhl/CTX6mgO0tJ+6Vb+CbDg4XAQ2B6lvh4GHwCVuoBW59jxBG+9Zr8upAVTgKrgXtG2SCwCagBvgL3gVXA/BSySu5rvRqpN2i0pdtdI3bCYK32964QfjasIE/GxxIFI1LeaAz4dgVbHbFSrYI247rRsFFthN7DITh1JYAOoMLxpMPATznvBi4B24Avhs4337X+OuYb11OB3cBbo8zU/y7HH2JvooNTh3abBqNiWBwXIzZ0Ao8MuSuuEwc03wZNvg84H7HyC6A5JiLpQPPt88KDE2n0/hFHpnMZuChyFRgJ0OuUzCosvgvfvwZTs2VwDAUMwMXGeauCKstgrZO2tJ5XtkyOkxVUGLpDFi7NYZORVNCDOyHlz9Oob+KJHPXAfRa1skeiTObqMCiXgXfBoXsamCLnJTKvx4Ea+bD2ea/prGNONd2mSlbC/FGe322CXr3pNkFicxslfJNuo3u9NmKPzEujThB28Du+igJtu0yT3w8UpGH0oKzpBEEnESsM0WHIA59uocxahyLaLkjyjhAeeCtZ1Ub5PuO1t6URHngz0Igxc+VFCQ9svedBf6qPAdfkTXk4LB+sIqBSVr16ZUXNj1IJD3TYUA18lvpIGHEOOABsCREakNRR0JQjSYhfmnI6GcnpNPC/SMBzfunDL9VZQFwZGdYosW0u6GW2d+M2BIMxWzYwRsEWVeoKHzJIGrGfkjghQuKn8fOJBKt9F/nHmeEczr6LfHu8XCLjhrVCFm+oXXFxyz/q7otWybh0QDVJyvrFH28BNyXomhGhW3skE3slKeAkI+v6CJwC6pzLKyF63pOx3kSepmBOlE3kKORdktXb92EkZ3+c8CTVLyv6Ot5fVoBf2x3bkjyBzSEAAAAASUVORK5CYII="/>
                                                        </svg>
                                                    </div>
                                                <? endif; ?>
                                                <div class="float-right">
                                                    <a href="javascript:void(0)" class="btn btngreen cart_product_add" product_id="<?= $productsFilterArray[$i]['id'] ?>">В корзину</a>
                                                    <div class="btn-group">
                                                        <a href="/shop/cart/" class="btn btngreen align-self-center cart_product_go_card" product_id="<?= $productsFilterArray[$i]['id'] ?>" style="display: none;">Продолжить</a>
                                                        <a href="javascript:void(0)" class="btn btn-danger cart_product_remove cart_product_go_card" product_id="<?= $productsFilterArray[$i]['id'] ?>" style="display: none;" title="Удалить из корзины"><i class="fa fa-trash"></i></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?
                        unset($waresInfo);
                    }
                }
                ?>
            </div>
        </div>
    </div>
</div>

<script>

    $(document).ready(function () {
        $(".btn_product_reviews").click(function () {
            var first_name = $(".product_reviews_block").find(".first_name").val();
            var reviews_text = $(".product_reviews_block").find(".reviews_text").val();
            var product_id = $(".product_reviews_block").find(".product_id").val();
            var rating = $(".product_reviews_block").find(".rating:checked").val();
            if (!!rating) {
                sendPostLigth('/jpost.php?extension=products',
                        {"product_reviews": 1, "product_id": product_id, "first_name": first_name, "reviews_text": reviews_text, "rating": rating},
                        function (e) {
                            if (e['success'] == '1') {
                                $(".product_reviews_block").html("<h1>Спасибо за Ваш отзыв!</h1>");
                                $(".btn_product_reviews").remove();
                                //document.location.reload();
                            }
                        });
            } else {
                alert("Оцените товар!");
            }

        });

        listReviews();
    });

    function listReviews() {
        var productElmId = $(".productElm").attr('product_id');
        sendPostLigth('/jpost.php?extension=products',
                {"get_reviews": productElmId},
                function (e) {
                    //console.log('data: ' + e['data'].length);
                    if (e['data'].length > 0) {
                        var rating = 0;
                        var count = e['data'].length;

                        for (var i = 0; i < e['data'].length; i++) {
                            rating += Number(e['data'][i]['rating']);
                            // alert alert-light
                            $('.reviews').append('<div class=" mt-3">\n\
                                            <div><span class="reviews_user_name">' + e['data'][i]['user_name'] + '</span> <span class="reviews_user_date">' + e['data'][i]['creat_date_format'] + '</span></div>\n\
                                            <div class="reviews_text mt-1">' + e['data'][i]['reviews_text'] + '</div>\n\
                                            </div><hr/>')

                        }
                        var rating_val = rating / count;
                        var rating_ceil = Math.ceil(rating_val);
                        for (var i = 1; i < 6; i++) {
                            if (rating_ceil >= i) {
                                $(".rating_itm_" + i).addClass('active');
                            }
                        }
                        $(".rating_count").html(count);
                        $(".rating_val").html(rating_ceil);
                    }
                });
    }

    // Клики по товарам -------------
    window.dataLayer = window.dataLayer || [];
    $(".product_info").each(function () {
        var product_info_title = $.trim($(this).find(".product_info_title").html());
        var product_info_price = $.trim($(this).find(".product_info_price").html());
        dataLayer.push({
            "ecommerce": {
                "click": {
                    "products": [{
                            "name": product_info_title, // Например, https://prnt.sc/un3f6x 
                            "price": product_info_price, // Например, https://prnt.sc/un3hf7 
                        },
                        {
                            "name": product_info_title, // Например, https://prnt.sc/un3f6x 
                            "price": product_info_price, // Например, https://prnt.sc/un3hf7 
                        }]
                }
            },
            'event': 'gtm-ee-event',
            'gtm-ee-event-category': 'Enhanced Ecommerce',
            'gtm-ee-event-action': 'Product Click',
            'gtm-ee-event-non-interaction': 'False',
        });
    });
</script>