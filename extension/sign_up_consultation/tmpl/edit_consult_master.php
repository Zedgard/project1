<!-- Modal -->
<div class="modal bd-example-modal-lg fade" id="edit_consult_master_form" tabindex="-1" role="dialog" aria-labelledby="edit_consult_master_form" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Настройка</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" name="master_id" value="" class="master_id" />
                        <div class="form-group">
                            <label>ФИО</label>
                            <input class="form-control master_name" name="master_name" id="master_name" value="" placeholder="ФИО отображается..."  type="text" required>
                        </div>

                        <div class="form-group edit_periods">
                            <label>Периоды </label>
                            <div class="row">
                                <div class="col-12">
                                    <?
                                    include 'edit_master_consultation_periods.php';
                                    ?>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Фаил token <span style="font-size: 0.6rem;">(настраивает разработчик, для работы с календарем)</span></label>
                            <input class="form-control token_file_name" name="token_file_name" id="token_file_name" value="" placeholder="Фаил токена для работы с календарем..."  type="text">
                        </div>
                        <div class="form-group">
                            <label>Фаил credentials <span style="font-size: 0.6rem;">(настраивает разработчик, для работы с календарем)</span></label>
                            <input class="form-control credentials_file_name" name="credentials_file_name" id="credentials_file_name" value="" placeholder="Фаил токена для работы с календарем..."  type="text">
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary btn_master_save">Применить</button>
            </div>
        </div>

    </div>
</div>
