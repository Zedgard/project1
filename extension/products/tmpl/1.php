<div class="row">
    <div class="col-12">
        <div class="mb-3"><h3><?= $material_val['video_title'] ?></h3></div>
        <div class="mb-3"><?= $material_val['video_descr'] ?></div>
        <div class="">
            <?
            if (strlen($material_val['video_youtube']) > 0) {
                ?>
                <object width="100%" class="d-block w-100 video">
                    <param name="movie" value="<?= $material_val['video_youtube'] ?>?controls=1&disablekb=0&iv_load_policy=0&mute=0&loop=1&enablejsapi=0&autoplay=0&modestbranding=0&rel=0&showinfo=0"/>
                    <param name="allowFullScreen" value="true"/>
                    <param name="allowscriptaccess" value="always"/>
                    <embed width="100%" height="360" src="<?= $material_val['video_youtube'] ?>?controls=1&disablekb=0&iv_load_policy=0&mute=0&loop=1&enablejsapi=0&&autoplay=0&modestbranding=0&rel=0&showinfo=0" class="youtube-player" type="text/html" allowscriptaccess="always" allowfullscreen="true"/>
                </object>
                <?
            } else {
                ?>
                <video class="d-block w-100" data-holder-rendered="true" preload="auto" controlsList="nodownload" controls loop>
                    <source src="<?= $material_val['video_mp4'] ?>" type="video/mp4">
                    <source src="<?= $material_val['video_ogv'] ?>" type="video/webm"> 
                    <source src="<?= $material_val['video_webm'] ?>" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
                <?
            }
            ?>
        </div>
    </div>
</div>
<hr/>

<object width="100%" class="d-block w-100 video">
    <param name="movie" 
           value="<?= $material_val['video_youtube'] ?>"
           />
    <param name="allowFullScreen" value="true"/>
    <param name="allowscriptaccess" value="always"/>
    <embed width="100%" height="360" 
           src="<?= $material_val['video_youtube'] ?>" 
           class="youtube-player" type="text/html" allowscriptaccess="always" allowfullscreen="true"
           />
</object>



<!-- Отзывы -->
<div>
    <div class="mt-4">

        <!-- Grid Modal -->
        <div class="modal fade" id="productReviewsModal" tabindex="-1" role="dialog" aria-labelledby="productReviewsModal" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalGridTitle">Оставьте отзыв о товаре</h5>
                        <button type="button" class="close" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="container-fluid product_reviews_block">
                                <div class="rating-area">
                                    <input type="radio" id="star-5" name="rating" class="rating" value="5">
                                    <label for="star-5" title="Оценка «5»"></label>	
                                    <input type="radio" id="star-4" name="rating" class="rating" value="4">
                                    <label for="star-4" title="Оценка «4»"></label>    
                                    <input type="radio" id="star-3" name="rating" class="rating" value="3">
                                    <label for="star-3" title="Оценка «3»"></label>  
                                    <input type="radio" id="star-2" name="rating" class="rating" value="2">
                                    <label for="star-2" title="Оценка «2»"></label>    
                                    <input type="radio" id="star-1" name="rating" class="rating" value="1">
                                    <label for="star-1" title="Оценка «1»"></label>
                                </div>

                                <label class="font-weight-bold">Ваше имя:</label>
                                <input type="text" name="first_name" value="<?= $_SESSION['user']['info']['first_name'] ?>" disabled="disabled" class="form-control first_name w-100 mt-1">
                                <input type="hidden" name="product_id" value="<?= $productData['id'] ?>" class="form-control product_id w-100 mt-1">


                                <label class="font-weight-bold mt-3">Отзыв</label>
                                <textarea name="reviews_text" class="form-control reviews_text w-100 h-25 mt-1"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal" data-bs-dismiss="modal">Закрыть</button>
                        <button type="button" class="btn btn-success btn_product_reviews">Отправить отзыв</button>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <h2>Отзывы</h2>
    <? if ($_SESSION['user']['info']['id'] > 0): ?>
        <div class="btn btn-primary mt-2" data-toggle="modal" data-target="#productReviewsModal">
            Оставить отзыв
        </div>
    <? else: ?>
        <div>Чтобы оставить отзыв нужно <a href="/auth/" class="header_close_club" >Авторизироваться</a></div>
    <? endif; ?>
    <div class="reviews mt-4">

    </div>
</div>