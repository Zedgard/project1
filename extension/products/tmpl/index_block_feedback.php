<?
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
if (!isset($c_product)) {
    $c_product = new \project\products();
}
$feedbacks = $c_product->blockDataArray($productId, 'block_feedback', 'feedback');
?>
<style>
    .video_u_block_left{
        width: 300px;
        height: 100px;
        position: absolute;
        z-index: 9;
    }
    .video_u_block_right{
        float: right;
        width: 300px;
        height: 100px;
        margin-bottom: -100px;
        position: relative;
        z-index: 9;
    }
</style>    

<div class="row mb-4">
    <div class="col-lg-12">
        <h3 class="TestimonialsTitle mb-5 text-center">Отзывы счастливых людей</h3>
        <?
        if (count($feedbacks) > 0) {
            foreach ($feedbacks as $feedback_value) {
                ?>
                <div class="mb-3 w-25 float-left" style="margin-left: 6%;">
                    <a href="<?= $feedback_value['val'] ?>" class="fancybox">
                        <img src="<?= $feedback_value['val'] ?>" class="w-100" />
                    </a>
                </div>
                <?
            }
        }
        ?>
    </div>
</div>
