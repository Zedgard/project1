<link rel="stylesheet" href="/extension/products/product.css<?= $_SESSION['rand'] ?>">

<div class="row">
    <div class="col-lg-12" style="background-color: #DEDEDE;height: 66px;"></div>
</div>
<div class="container">
    <div class="row" style="margin-top: -70px;">
        <div class="col-lg-2"></div>
        <div class="col-lg-10 p-3">
            <div class="input-group">
                <input type="text" value="<?= $_SESSION['product']['filter']['productSearchString'] ?>" class="form-control productSearchString" placeholder="Я ищу..." aria-label="Я ищу..." aria-describedby="basic-addon2"
                       style="height: 38px;border-radius: 0px;border: 0px solid #FFF;">
                <div class="input-group-append">
                    <button class="btn btn-light " type="button"><i class="fa fa-search"></i></button>
                </div>
            </div>
            <!-- <input type="text" name="searchProductStr" value="" class="form-control searchProductStr" placeholder="Я ищу..." /> -->
        </div>
    </div>

    <!-- мобильный вид -->
    <div class="row mt-2 mb-1 bread d-block d-xl-none">
        <div class="col-12">
            <?= $page->bread_get() ?>
        </div>
    </div>
    <!-- десктоп вид  style="margin-left: -2.8rem;" -->
    <div class="row mt-2 mb-2 bread d-none d-xl-block" >
        <div class="col-12">
            <?= $page->bread_get() ?>
        </div>
    </div>

    <div class="row">
        <?
        /*
         * Список продуктов
         */
        if (!isset($_GET['product'])) {
            /*
             * Отображаем фильтры
             */
            include_once 'index_filter.php';
            ?>
            <div class="col-lg-10">
                <!-- Sorted block -->    
                <div class="row mt-4 mb-4">
                    <div class="col-12">
                        <div class="row controls fast_control_btn">
                            <div class="col-lg-3">
                                <button type="button" elm='0' data-filter="all" class="btn_category_controll btn_category_controll_active border_radius3 mb-2">Все</button>
                            </div>
                            <?
                            foreach ($categoryArray as $value) {
                                ?>
                                <div class="col-lg-3">
                                    <button type="button" elm="<?= $value['id'] ?>" data-filter=".category-<?= $value['id'] ?>" class="btn_category_controll border_radius3 mb-2"><?= $value['title'] ?></button>
                                </div>
                                <?
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <script>
                    $(document).ready(function () {
                        setTimeout(function () {
                            var containerEl = document.querySelector('[data-ref~="mixitup-container"]');
                            if (!!containerEl) {
                                //console.log('containerEl');
                                var mixer = mixitup(containerEl, {
                                    selectors: {
                                        target: '[data-ref~="mixitup-target"]'
                                    }
                                });
                            }
                        }, 1000);
                    });
                </script>
                <!-- Sorted block end -->    


                <!-- product list -->
                <div class="row container_mix row-cols-1 row-cols-md-3" data-ref="mixitup-container">
                    <?
                    if ($productsFilterCount > 0) {
                        for ($i = 0; $i < $productsFilterCount; $i++) {
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
                                }
                            }

                            $display = '';
                            if ($i > 6) {
                                $display = 'display: none;';
                            }
                            ?>
                            <div class="col mb-4 mixitup-container <?= $class_category ?>" i='<?= $i ?>' data-ref="mixitup-target" style="<?= $display ?>">
                                <div class="card p-4 item"> 
                                    <div class="row h-100 d-inline-block pl-3 pr-3">
                                        <div class="col-12 h-100 d-flex flex-column product_info">
                                            <?= $title_category ?>
                                            <div class="row waresListImages">
                                                <?
                                                /*  Блок рекомендованные товары ссылка */
                                                $recomend_links = array();
                                                if (isset($_GET['productTopic']) && $_GET['productTopic'] > 0) {
                                                    $recomend_links[] = "productTopic={$_GET['productTopic']}"; //urlRequestAddLinkArray($_GET['productTopic']);
                                                }
                                                $recomend_links[] = "product={$productsFilterArray[$i]['id']}";

                                                /*
                                                 * Product Images
                                                 */
                                                $image = $productsFilterArray[$i]['images_str'];
                                                if (strlen($image) == 0) {
                                                    $image = '/assets/img/no_tovar_bg.jpg';
                                                }
                                                ?>
                                                <div class="<?= $sclass_boot ?> align-self-center text-center w-100 <?= ($ii > 0) ? $scaleN : $scale ?>">
                                                    <a href="/shop/<?= urlRequestAddLinkArray($recomend_links) ?>">
                                                        <img data-src="<?= $image ?>" src="/assets/img/no_tovar_bg.jpg" class="lazyload waresImg waresListImagesStyle1" title="<?= $productsFilterArray[$i]['title'] ?>" />
                                                    </a>
                                                </div>    
                                            </div>
                                            <div class="row mt-2">
                                                <div class="col-mb-12">
                                                    <?
                                                    $product_price = 0;
                                                    if ($productsFilterArray[$i]['price_promo'] > 0) {
                                                        $product_price = $productsFilterArray[$i]['price_promo'];
                                                        ?>
                                                        <div style="clear: both;">
                                                            <span class="init_price_val product_info_price" style="color:#FF0000;"><?= $product_price ?></span>
                                                            <span class="wares_old_price" style="margin-left: 16px;"><span class="init_price_val"><?= $productsFilterArray[$i]['price'] ?></span> <i class="fa fa-ruble"></i></span>
                                                        </div>
                                                        <?
                                                    } else {
                                                        $product_price = $productsFilterArray[$i]['price'];
                                                        ?>
                                                        <div style="clear: both;">
                                                            <span class="init_price_val product_info_price"><?= $product_price ?></span> <i class="fa fa-ruble"></i>
                                                        </div>
                                                        <?
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <div class="row mt-1">
                                                <div class="col-mb-12">
                                                    <div class="cart_product_title_block">
                                                        <a href="/shop/<?= urlRequestAddLinkArray($recomend_links) ?>" class="product_links product_info_title">
                                                            <?= $category_title ?>&nbsp;&nbsp;<span class="cart_product_title"><?= mb_strimwidth($productsFilterArray[$i]['title'], 0, 100, "...") ?></span>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <?
                                            /*
                                              <div class="row" style="display: none;">
                                              <div class="col-mb-12">
                                              <div class="rating-mini mt-3">
                                              <span class="active"></span>
                                              <span class="active"></span>
                                              <span class="active"></span>
                                              <span></span>
                                              <span></span>
                                              </div>
                                              <span class="rating_number">(2348)</span>
                                              </div>
                                              </div>
                                             */
                                            ?> 
                                            <div class="row bd-highlight cart_product_button_bg">
                                                <div class="col-12">
                                                    <? if ($productsFilterArray[$i]['product_new'] == '1'): ?>
                                                        <div class="float-start" style="margin: 0.5rem 0;">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" viewBox="0 0 35 35">
                                                            <image id="new" width="35" height="35" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC8AAAAwCAYAAACBpyPiAAADwklEQVRogd2ab2hPURjHP7bf5t/YykLRJKZYRFLkz4u9JLXSWl7RRCSLtyYUySvtFZYymrzRamhT8waTFyRipjbEXghta5QM4+j8PFfH3e+ec+/P3X6/n2893XvPfc55vvfc55z7POdcFMQtExTsUnBbwWs57pTyWG3FTbxQQYsClUJa5H5Wkp+ioCOAuCcdojfu5PMVzFVQlOJesYI7DuKeaL3iFG0USfv5YTkl/dCBQuAosAcoEdV+4CXQC7wHNgOL3E39QQ9wHZgFlAMLgFK5OQScEZvfrK2EeMIgHx5raflXt6nMEHFPKm388hyvd2MEVxgLWO27yC/PMHmrfRf5pfFyiQyrfRt5PRPMzCz3pP1ZQTdt5DeMDZ/IWB9YIeATv1fBQIZnGk8GhM+o0MK8SCjYruBNlpD2yxvhl/CTX6mgO0tJ+6Vb+CbDg4XAQ2B6lvh4GHwCVuoBW59jxBG+9Zr8upAVTgKrgXtG2SCwCagBvgL3gVXA/BSySu5rvRqpN2i0pdtdI3bCYK32964QfjasIE/GxxIFI1LeaAz4dgVbHbFSrYI247rRsFFthN7DITh1JYAOoMLxpMPATznvBi4B24Avhs4337X+OuYb11OB3cBbo8zU/y7HH2JvooNTh3abBqNiWBwXIzZ0Ao8MuSuuEwc03wZNvg84H7HyC6A5JiLpQPPt88KDE2n0/hFHpnMZuChyFRgJ0OuUzCosvgvfvwZTs2VwDAUMwMXGeauCKstgrZO2tJ5XtkyOkxVUGLpDFi7NYZORVNCDOyHlz9Oob+KJHPXAfRa1skeiTObqMCiXgXfBoXsamCLnJTKvx4Ea+bD2ea/prGNONd2mSlbC/FGe322CXr3pNkFicxslfJNuo3u9NmKPzEujThB28Du+igJtu0yT3w8UpGH0oKzpBEEnESsM0WHIA59uocxahyLaLkjyjhAeeCtZ1Ub5PuO1t6URHngz0Igxc+VFCQ9svedBf6qPAdfkTXk4LB+sIqBSVr16ZUXNj1IJD3TYUA18lvpIGHEOOABsCREakNRR0JQjSYhfmnI6GcnpNPC/SMBzfunDL9VZQFwZGdYosW0u6GW2d+M2BIMxWzYwRsEWVeoKHzJIGrGfkjghQuKn8fOJBKt9F/nHmeEczr6LfHu8XCLjhrVCFm+oXXFxyz/q7otWybh0QDVJyvrFH28BNyXomhGhW3skE3slKeAkI+v6CJwC6pzLKyF63pOx3kSepmBOlE3kKORdktXb92EkZ3+c8CTVLyv6Ot5fVoBf2x3bkjyBzSEAAAAASUVORK5CYII="/>
                                                            </svg>
                                                        </div>
                                                    <? endif; ?>
                                                    <div class="float-end btn_product_list">
                                                        <input type="hidden" name="product_title" class="info_product_title" value="<?= $productsFilterArray[$i]['title'] ?>" />
                                                        <input type="hidden" name="product_title" class="info_product_price" value="<?= $product_price ?>" />
                                                        <input type="hidden" name="product_title" class="info_product_img" value="<?= $image ?>" />
                                                        <a href="javascript:void(0)" class="btn btngreen cart_product_add" product_id="<?= $productsFilterArray[$i]['id'] ?>">В корзину</a>
                                                        <div class="btn-group">
                                                            <a href="/shop/cart/" class="btn btngreen-outline align-self-center cart_product_go_card" product_id="<?= $productsFilterArray[$i]['id'] ?>" style="display: none;padding: 0.8rem;border-right: none;">В корзине</a>
                                                            <a href="javascript:void(0)" class="btn btn-danger cart_product_remove cart_product_go_card" product_id="<?= $productsFilterArray[$i]['id'] ?>" style="display: none;padding: 0.4rem;" title="Удалить из корзины"><i class="fa fa-trash"></i></a>
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
                    } else {
                        ?>
                        <div class="w-100 text-center">
                            Нет товаров
                        </div>
                        <?
                    }
                    ?>
                </div>
                <div class="product_load_next"></div>
            </div>
            <hr class="d-block d-md-none pb-3 pt-3 mb-3 mt-3" />

            <?
            /*
             * Карточка товара
             */
        } else {
            // Если товар деактивировали
            if (intval($productData['active']) > 0) {
                include_once 'index_cart.php';
            } else {
                include_once 'index_cart_not_active.php';
                include 'recommend.php';
            }
        }
        ?>
    </div>

</div>

<div class="row">
    <div class="col-lg-12" style="height: 100px;"></div>
</div>


<script>
    var category_controll = '<?= $_SESSION['product']['filter']['category_controll'] ?>';
</script>