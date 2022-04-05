<!-- Карточка товара  style="background-color: #FFFFFF;border: 1px solid #DEDEDE;" -->
<script>
    var products_id = "<?= $productData['id'] ?>";
</script>
<div class="container-fluid">
    <div product_id="<?= $productData['id'] ?>" class="row mb-3 productElm product_info">
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
//                    foreach ($productData['products_wares_info'] as $value):
//                        //$array = $value['images'];
//                        <li data-target="#carouselExampleIndicators" data-slide-to="<= $i >" class="<= $first >"></li>
//                        $first = '';
//                    endforeach;
                    ?>
                </ol>
                <div class="carousel-inner">
                    <div style="position: absolute;margin-top: 20px;display: none;"><?= $title_category_bg ?></div>
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
                        if (isset($productData['products_wares_info']) && count($productData['products_wares_info']) > 0) {
                            foreach ($productData['products_wares_info'] as $value) {
                                if (strlen($value['images']) > 0) {
                                    ?>
                                    <div class="carousel-item text-center <?= $first ?>">
                                        <a href="<?= $value['images'] ?>" class="fancybox"><img class="d-block w-100" style="background-color: #CCCCCC;" src="<?= $value['images'] ?>" ></a>
                                    </div>
                                    <?
                                    $first = '';
                                }
                            }
                        }
                    }
                    ?>
                </div>
                <!--
                <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Предыдущая</span>
                </a>
                <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Следующая</span>
                </a>
                -->
            </div>

        </div>
        <div class="col-md-7 mb-4">
            <!-- Title -->
            <h1 class="product_info_title_card mb-3"><?= $title_category_str ?> <?= $productData['title'] ?></h1>

            <?
            if ($p_user->isEditor()) {
                ?>
                <div class="text-end"><a href="/admin/catalog/?product_edit=<?= $productData['id'] ?>" target="_blank" class="btn btn-link">Редактировать товар</a></div>
                <?
            }
            ?>
            <div class="mb-3">
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
                <div class="col-md-6 text-left">
                    <span class="product_wares_hover">
                        <span class="product_wares product_wares_border">Содержание товара</span> <i class="fas fa-question-circle product_wares" style="padding-top: 0.5rem;padding-left: 10px;"></i>
                    </span>
                    <div class="box_shadow product_wares_show" opacity="0">
                        <?
                        if (strlen($productData['product_content']) > 0) {
                            echo $productData['product_content'];
                        } else {
                            if (isset($productData['products_wares_info']) && count($productData['products_wares_info']) > 0) {
                                foreach ($productData['products_wares_info'] as $value) {
                                    ?>
                                    <div class="mb-2 ml-3">
                                        <i class="psmark"></i><?= $value['title'] ?>
                                    </div>
                                    <?
                                }
                            }
                        }
                        ?>
                    </div>
                </div>
                <div class="col-md-6 text-end">
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
            <div class="row ">
                <div class="col-md-12 text-end">
                    <a href="javascript:void(0)" class="btn button btngreen textcenter cart_product_add pl-5 pr-5" onclick="sendGoal(this)" product_id="<?= $productData['id'] ?>">В корзину</a>
                    <div class="btn-group">
                        <a href="/shop/cart/" class="btn btngreen-outline button btngreen textcenter cart_product_go_card" product_id="<?= $productData['id'] ?>" style="display: none;padding: 0.8rem;border-right: none;">Перейти в корзину</a>
                        <a href="javascript:void(0)" class="btn btn-danger btn-sm cart_product_remove cart_product_go_card" product_id="<?= $productData['id'] ?>" style="display: none;padding: 0.4rem;" title="Удалить из корзины"><i class="fa fa-trash"></i></a>
                    </div>
                </div>
            </div>
            <!-- cart button end -->


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



        </div>
    </div>
    <div class="row mb-5">
        <div class="col-md-12">
            <h2 class="mb-3" style="font-size: 2.3rem;font-weight: 700;color: #000000;">Описание:</h2>
            <div class="product_descr ulli"><?= $productData['desc'] ?></div>
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
    if ($productData['block_feedback'] == '1') {
        include 'index_block_feedback.php';
    }
    ?>

    <!-- Блоки "Трейлер условия" --> 
    <?
    if ($productData['block_conditions'] == '1') {
        include 'index_block_conditions.php';
    }
    ?>

    <!-- Блоки "Трейлер продукта" --> 
    <?
    if ($productData['block_feedback'] == '1') {
        include 'index_block_feedback.php';
    }
    ?>

    <!-- cart button -->
    <div class="row ">
        <div class="col-md-12 text-center">
            <a href="javascript:void(0)" class="btn btn-lg button btngreen textcenter cart_product_add pl-5 pr-5" onclick="sendGoal(this)" style="font-size: 2rem;padding: 1.2rem 2.2rem;" product_id="<?= $productData['id'] ?>">В корзину</a>
            <div class="btn-group">
                <a href="/shop/cart/" class="btn btngreen-outline button btngreen textcenter cart_product_go_card" product_id="<?= $productData['id'] ?>" style="display: none;font-size: 2rem;padding: 1rem;border-right: none;">Перейти в корзину</a>
                <a href="javascript:void(0)" class="btn btn-danger btn-sm cart_product_remove cart_product_go_card" product_id="<?= $productData['id'] ?>" style="display: none;padding: 0.6rem;" title="Удалить из корзины"><i class="fa fa-trash"></i></a>
            </div>
        </div>
    </div>
    <!-- cart button end -->

    <div style="height: 1rem;"></div>
    <?
    include 'recommend.php';
    ?>
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