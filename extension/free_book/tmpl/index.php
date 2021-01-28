<link id="sleek-css" rel="stylesheet" href="/extension/free_book/free_book.css<?= $_SESSION['rand'] ?>" />
<div class="free_book_container">
    <div class="container pb-4">
        <div class="mt-4 mb-4 free_book_title">Мои безоплатные книги для тебя</div>
        <div class="row pt-2 pb-2">
            <div class="col-lg-6">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="free_book_product_title"><?= $free_books[$elm_1]['title'] ?></div>
                        <div class="free_book_product_desc"><?= mb_strimwidth(strip_tags($free_books[$elm_1]['desc']), 0, 250, "...") ?></div>
                        <div><a href="/shop/?product=<?= $free_books[$elm_2]['id'] ?>" target="_blank" class="btn free_book_btn">Получить</a></div>
                    </div>
                    <div class="col-lg-6">
                        <img src="<?= $free_books[$elm_1]['images_str'] ?>" class="free_book_img" />
                    </div>
                </div>
            </div>
            <div class="col-lg-6" style="margin-top: 0.5rem;margin-bottom: 0.4rem;">
                <div class="row">
                    <div class="col-lg-6">
                        <img src="<?= $free_books[$elm_2]['images_str'] ?>" class="free_book_img" />
                    </div>
                    <div class="col-lg-6">
                        <div class="free_book_product_title"><?= $free_books[$elm_2]['title']; ?></div>
                        <div class="free_book_product_desc"><?= mb_strimwidth(strip_tags($free_books[$elm_2]['desc']), 0, 250, "...") ?></div>
                        <div><a href="/shop/?product=<?= $free_books[$elm_2]['id'] ?>" target="_blank" class="btn free_book_btn">Получить</a></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>