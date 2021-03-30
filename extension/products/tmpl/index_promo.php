<link rel="stylesheet" href="/extension/products/product.css<?= $_SESSION['rand'] ?>">
<script type="text/javascript" src="/assets/plugins/lazyload/lazyload.min.js<?= $_SESSION['rand'] ?>"></script>
<style>
    .index_promo_list_btn_text{
        text-transform: uppercase;
    } 
    .index_promo_list_btn:hover{
        cursor: pointer;
    }
</style>
<div style="height: 2rem;"></div>
<div class="container">
    <div>Популярные товары</div>
    <!-- product list -->
    <div class="row mt-3 container_mix row-cols-1 row-cols-md-4" data-ref="mixitup-container">
        <?
        //$obj_product['products_wares'] = $this->getProducts_wares($obj_product['id']);
        //$obj_product['products_category'] = $this->getProducts_category($obj_product['id']);
        //$obj_product['products_topic'] = $this->getProducts_topic($obj_product['id']);
        //$i_col = 3; // колличество отображаемых
        //$a_col = 0; // итерация
        for ($i = 0; $i < $productsFilterCount; $i++) {
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
                }
//                            if(strlen($category_title)>0){
//                                $category_title = $category_title . ' ';
//                            }
            }

            // border: 1px solid #CCC;
            // category_name=" $categoryArray[$item_category_id] " data-ref="mixitup-target"
            // $class_category
            $display = '';
            if ($i > 3) {
                $display = 'display: none;';
            }
            ?>
            <div class="col mb-4 mixitup-container index_promo_list <?= $class_category ?>" i='<?= $i ?>' data-ref="mixitup-target" style="<?= $display ?>">
                <div class="card p-4 item"> 
                    <div class="row h-100 d-inline-block pl-3 pr-3">
                        <div class="col-12 h-100 d-flex flex-column product_info">
                            <?= $title_category ?>
                            <div class="row waresListImages">
                                <?
                                /*
                                 * Product Images
                                 */
                                $image = $productsFilterArray[$i]['images_str']; //$c_product->checkImageFile($productsFilterArray[$i]['images_str']);
                                if (strlen($image) > 0) {
                                    ?>
                                    <div class="<?= $sclass_boot ?> align-self-center text-center w-100 <?= ($ii > 0) ? $scaleN : $scale ?>">
                                        <a href="/shop/?product=<?= $productsFilterArray[$i]['id'] ?>">
                                            <img data-src="<?= $productsFilterArray[$i]['images_str'] ?>" src="/assets/img/no_tovar_bg.jpg" class="lazyload waresImg waresListImagesStyle1" title="<?= $productsFilterArray[$i]['title'] ?>" />
                                        </a>
                                    </div>    
                                    <?
                                } else {
                                    ?>
                                    <div class="<?= $sclass_boot ?> align-self-center  text-center w-100 <?= ($ii > 0) ? $scaleN : $scale ?>">
                                        <a href="/shop/?product=<?= $productsFilterArray[$i]['id'] ?>">
                                            <img data-src="/assets/img/no_tovar_bg.jpg" src="/assets/img/no_tovar_bg.jpg" class="lazyload waresListImagesStyle1" title="<?= $productsFilterArray[$i]['title'] ?>" />
                                        </a>
                                    </div>
                                    <?
                                }
                                ?>
                            </div>
                            <div class="row mt-2">
                                <div class="col-mb-12">
                                    <?
                                    if ($productsFilterArray[$i]['price_promo'] > 0) {
                                        $product_price = $productsFilterArray[$i]['price_promo'];
                                        ?>?>
                                        <div style="clear: both;">
                                            <span class="init_price_val product_info_price" style="color:#FF0000;"><?= $productsFilterArray[$i]['price_promo'] ?></span>
                                            <span class="wares_old_price" style="margin-left: 16px;"><span class="init_price_val"><?= $productsFilterArray[$i]['price'] ?></span> <i class="fa fa-ruble"></i></span>
                                        </div>
                                        <?
                                    } else {
                                        $product_price = $productsFilterArray[$i]['price'];
                                        ?>
                                        <div style="clear: both;">
                                            <span class="init_price_val product_info_price"><?= $productsFilterArray[$i]['price'] ?></span> <i class="fa fa-ruble"></i>
                                        </div>
                                        <?
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="row mt-1">
                                <div class="col-mb-12">
                                    <div class="cart_product_title_block">
                                        <a href="/shop/?product=<?= $productsFilterArray[$i]['id'] ?>" class="product_links product_info_title">
                                            <?= $category_title ?>&nbsp;&nbsp;<span class="cart_product_title"><?= mb_strimwidth($productsFilterArray[$i]['title'], 0, 100, "...") ?></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="row bd-highlight cart_product_button_bg">
                                <div class="col-12">
                                    <!--
                                    <? if ($productsFilterArray[$i]['product_new'] == '1'): ?>
                                                <div class="float-left">
                                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="35" height="35" viewBox="0 0 35 35">
                                                    <image id="new" width="35" height="35" xlink:href="data:img/png;base64,iVBORw0KGgoAAAANSUhEUgAAAC8AAAAwCAYAAACBpyPiAAADwklEQVRogd2ab2hPURjHP7bf5t/YykLRJKZYRFLkz4u9JLXSWl7RRCSLtyYUySvtFZYymrzRamhT8waTFyRipjbEXghta5QM4+j8PFfH3e+ec+/P3X6/n2893XvPfc55vvfc55z7POdcFMQtExTsUnBbwWs57pTyWG3FTbxQQYsClUJa5H5Wkp+ioCOAuCcdojfu5PMVzFVQlOJesYI7DuKeaL3iFG0USfv5YTkl/dCBQuAosAcoEdV+4CXQC7wHNgOL3E39QQ9wHZgFlAMLgFK5OQScEZvfrK2EeMIgHx5raflXt6nMEHFPKm388hyvd2MEVxgLWO27yC/PMHmrfRf5pfFyiQyrfRt5PRPMzCz3pP1ZQTdt5DeMDZ/IWB9YIeATv1fBQIZnGk8GhM+o0MK8SCjYruBNlpD2yxvhl/CTX6mgO0tJ+6Vb+CbDg4XAQ2B6lvh4GHwCVuoBW59jxBG+9Zr8upAVTgKrgXtG2SCwCagBvgL3gVXA/BSySu5rvRqpN2i0pdtdI3bCYK32964QfjasIE/GxxIFI1LeaAz4dgVbHbFSrYI247rRsFFthN7DITh1JYAOoMLxpMPATznvBi4B24Avhs4337X+OuYb11OB3cBbo8zU/y7HH2JvooNTh3abBqNiWBwXIzZ0Ao8MuSuuEwc03wZNvg84H7HyC6A5JiLpQPPt88KDE2n0/hFHpnMZuChyFRgJ0OuUzCosvgvfvwZTs2VwDAUMwMXGeauCKstgrZO2tJ5XtkyOkxVUGLpDFi7NYZORVNCDOyHlz9Oob+KJHPXAfRa1skeiTObqMCiXgXfBoXsamCLnJTKvx4Ea+bD2ea/prGNONd2mSlbC/FGe322CXr3pNkFicxslfJNuo3u9NmKPzEujThB28Du+igJtu0yT3w8UpGH0oKzpBEEnESsM0WHIA59uocxahyLaLkjyjhAeeCtZ1Ub5PuO1t6URHngz0Igxc+VFCQ9svedBf6qPAdfkTXk4LB+sIqBSVr16ZUXNj1IJD3TYUA18lvpIGHEOOABsCREakNRR0JQjSYhfmnI6GcnpNPC/SMBzfunDL9VZQFwZGdYosW0u6GW2d+M2BIMxWzYwRsEWVeoKHzJIGrGfkjghQuKn8fOJBKt9F/nHmeEczr6LfHu8XCLjhrVCFm+oXXFxyz/q7otWybh0QDVJyvrFH28BNyXomhGhW3skE3slKeAkI+v6CJwC6pzLKyF63pOx3kSepmBOlE3kKORdktXb92EkZ3+c8CTVLyv6Ot5fVoBf2x3bkjyBzSEAAAAASUVORK5CYII="/>
                                                    </svg>
                                                </div>
                                    <? endif; ?>
                                    --> 
                                    <div class="float-right btn_product_list">
                                        <input type="hidden" name="product_title" class="info_product_title" value="<?= $productsFilterArray[$i]['title'] ?>" />
                                        <input type="hidden" name="product_title" class="info_product_price" value="<?= $product_price ?>" />
                                        <input type="hidden" name="product_title" class="info_product_img" value="<?= $image ?>" />
                                        <a href="javascript:void(0)" class="btn btngreen cart_product_add" product_id="<?= $productsFilterArray[$i]['id'] ?>">В корзину</a>
                                        <div class="btn-group">
                                            <a href="/shop/cart/" class="btn btngreen align-self-center cart_product_go_card" product_id="<?= $productsFilterArray[$i]['id'] ?>" style="display: none;">В корзине</a>
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
        ?>
    </div>
    <div class="mt-3 mb-3">
        <div class="index_promo_list_btn text-center">
            <div class="index_promo_list_btn_text">Показать больше</div>
            <div class="mt-3"><i class="fas fa-chevron-down" style="font-size: 1.3rem;"></i></div>
        </div>
    </div>
</div>
<div style="height: 1rem;"></div>
<script>
    var index_promo_list_btn_click = 0;
    $(document).ready(function () {
        $("img.lazyload").lazyload();

        $(".index_promo_list_btn").unbind('click').click(function () {
            if (index_promo_list_btn_click == 0) {
                $(".index_promo_list").show(200);
                $(".index_promo_list_btn_text").html("Скрыть");
                $(".index_promo_list_btn").find(".fas").removeClass("fa-chevron-down");
                $(".index_promo_list_btn").find(".fas").addClass("fa-chevron-up");
                index_promo_list_btn_click = 1;
            } else {
                index_promo_list_btn_click = 0;
                for (var i = 0; i < $(".index_promo_list").length; i++) {
                    if (i > 3) {
                        $($(".index_promo_list")[i]).hide(200);
                    }
                }
                $(".index_promo_list_btn_text").html("Показать больше");
                $(".index_promo_list_btn").find(".fas").removeClass("fa-chevron-up");
                $(".index_promo_list_btn").find(".fas").addClass("fa-chevron-down");
            }
        });


    });
</script>