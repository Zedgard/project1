<?
include_once $_SERVER['DOCUMENT_ROOT'] . '/extension/products/inc.php';
if (!isset($c_product)) {
    $c_product = new \project\products();
}
$trailers = $c_product->blockDataArray($productId, 'block_trailer', 'trailer');
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
    .block_trailer_title{
        font-family: 'MontserratBold', "Open Sans", sans-serif;
        font-size: 2.3rem;
        font-weight: 700;
        color: #000000;
        text-align: center;
    }
</style>    

<div class="row mb-4">
    <div class="col-lg-12">
        <div class="block_trailer_title mb-5">Трейлер продукта:</div>
        <?
        if (count($trailers) > 0) {
            foreach ($trailers as $trailer_value) {
                ?>
                <div class="row">
                    <div class="col-lg-2">
                    </div>
                    <div class="col-lg-8">
                        <div class="mb-3 text-center">
                            <div class="video_u_block_left"></div>
                            <div class="video_u_block_right"></div>
                            <iframe style="width: 100%;height: 40vh;background-color: #E0E0E0;" allowfullscreen
                                    src="<?= $trailer_value['val'] ?>?autoplay=0&mute=0&loop=1&iv_load_policy=0&rel=0&modestbranding=1&disablekb=1&showinfo=0&iv_load_policy=3&allowfullscreen=0">
                            </iframe>
                        </div>
                    </div>
                    <div class="col-lg-2">
                    </div>
                </div>
                <?
            }
        }
        ?>
    </div>
</div>
<div style="height: 2rem;"></div>