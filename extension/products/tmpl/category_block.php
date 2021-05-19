<div class="row mt-3 mr-2 pt-4 pb-4 border-radius025 product_topics">
    <div class="col-12">
        <div class="category_list">Категории:</div>
        <div class="topics mt-2">
            <?
            $topicCountAll = 0;
            foreach ($topicArray as $value) {
                $topicCountAll += $value['product_col'];
            }
            ?>
            <!--
            <div class=" mt-1">
                <a href="./" class="itm_topic">Все товары <span>(<?= $topicCountAll ?>)</span></a>
            </div>
            -->
            <?
            //$colorArray = array(); $categoryArray
            if (!is_array($_SESSION['product']['filter']['check_categorys'])) {
                $_SESSION['product']['filter']['check_categorys'] = array();
            }
            foreach ($topicArray as $value) {
                //$colorArray[$value['id']] = randomColor();
                ?>
                <div class=" mt-3">
                    <!--
                    <a href="?productTopic=<?= $value['id'] ?>" class="itm_topic"><?= $value['title'] ?> <span>(<?= $value['product_col'] ?>)</span></a>
                    -->
                    <label class="control outlined control-checkbox">
                        <input type="checkbox" value="<?= $value['id'] ?>" name="check_categorys" class="check_categorys" 
                               <?= (in_array($value['id'], $_SESSION['product']['filter']['check_categorys'])) ? 'checked="checked"' : '' ?>>
                               <?= $value['title'] ?>
                        <div class="control-indicator"></div>
                    </label>
                </div>
                <?
            }
            ?>
        </div>
    </div>
</div>

<!-- Для мобильной версии -->
<div class="product-menu-top-category-list">Категории:</div>
<div class="topics mt-2">
    <?
    $topicCountAll = 0;
    foreach ($topicArray as $value) {
        $topicCountAll += $value['product_col'];
    }
    ?>
    <!--
    <div class=" mt-1">
        <a href="./" class="itm_topic">Все товары <span>(<?= $topicCountAll ?>)</span></a>
    </div>
    -->
    <?
    //$colorArray = array(); $categoryArray
    if (!is_array($_SESSION['product']['filter']['check_categorys'])) {
        $_SESSION['product']['filter']['check_categorys'] = array();
    }
    foreach ($topicArray as $value) {
        //$colorArray[$value['id']] = randomColor();
        ?>
        <div class=" mt-3">
            <!--
            <a href="?productTopic=<?= $value['id'] ?>" class="itm_topic"><?= $value['title'] ?> <span>(<?= $value['product_col'] ?>)</span></a>
            -->
            <label class="control outlined control-checkbox" style="font-size: 1.2rem;">
                <input type="checkbox" value="<?= $value['id'] ?>" name="check_categorys" class="check_categorys" 
                       <?= (in_array($value['id'], $_SESSION['product']['filter']['check_categorys'])) ? 'checked="checked"' : '' ?>>
                       <?= $value['title'] ?>
                <div class="control-indicator" style="margin-top: -0.1rem;"></div>
            </label>
        </div>
        <?
    }
    ?>
</div>