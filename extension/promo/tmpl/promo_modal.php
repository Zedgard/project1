<link rel="stylesheet" href="/extension/promo/css/pup.css<?= $_SESSION['rand'] ?>">
<!-- Large Modal -->
<div class="modal pup fade" id="promo_modal_<?= $modal_data[0]['id'] ?>" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content" style="border: none;background-color: transparent;">

            <div class="modal-body m-0 p-0">
                <button type="button" class="close float-end modal_close_btn" data-bs-dismiss="modal" data-dismiss="modal" data-bs-dismiss="modal" aria-label="Close" elm_id="<?= $modal_data[0]['id'] ?>">
                    <span aria-hidden="true">&times;</span>
                </button>
                <div class="container-fluid m-0 p-0">

                    <div class="row m-0 p-0" style="background-color: #fff;">
                        <div class="col-lg m-0 pt-2 m-lg-0 modal_green_bg">

                            <img src="/assets/files/image/modal/pup_Edgard.jpg.png"/>
                        </div>
                        <div class="col-lg p-0 pup_promo_bg">

                            <div class="d-flex h-100 pt-2 pb-4 justify-content-center align-items-center bd-highlight">
                                <div>
                                    <?= $modal_data[0]['descr'] ?>
                                    <div class="text-center mt-3">
                                        <a href="javascript:void(0)" 
                                           href_data="/shop/cart/?go_cart=<?= $modal_data[0]['product_id'] ?>" 
                                           class="btn btn-warning promo_product_go p-lg-2" 
                                           elm_id="<?= $modal_data[0]['id'] ?>" 
                                           style="padding: 1rem;font-weight: bold;font-size: 1.6rem;color: #000000;">ПОЛУЧИТЬ</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



