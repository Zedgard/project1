<!-- Modal -->
<div class="modal bd-example-modal-lg fade" id="edit_event_form" tabindex="-1" role="dialog" aria-labelledby="edit_event_form" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Управление событием</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-12">
                        <input type="hidden" name="event_id" value="" class="event_publicId" style="display: none;" />
                        <div class="row mb-2">
                            <div class="col-md-6 float-left">
                                <a href="" class="event_url" target="_blank" style="display: none;">Ссылка на событие в календаре</a>
                            </div>
                            <div class="col-md-6 float-right text-right">
                                <a href="" class="event_url_conferens" target="_blank" style="display: none;">Ссылка на конференцию</a>
                            </div>
                        </div>
                        <div class="form-group">
                            <label>Название</label>
                            <input class="form-control event_summary" name="event_summary" id="event_summary" value="" placeholder="Название мероприятия..."  type="text" readonly="readonly">
                        </div>
                        <div class="form-group">
                            <label>Имя</label>
                            <input class="form-control first_name" name="first_name" id="first_name" value="" placeholder="Имя..."  type="text" required>
                        </div>
                        <div class="form-group">
                            <label>Телефон</label>
                            <input class="form-control user_phone" name="user_phone" id="user_phone" value="" placeholder="Телефон..."  type="text" required>
                        </div>

                        <div class="form-group">
                            <label>Консультант</label>
                            <div class="mb-1">
                                <select name="consultation_master_id" class="consultation_master_id">
                                    <?
                                    foreach ($consultation_masters as $value) {
                                        ?>
                                    <option value="<?= $value['id'] ?>"><?= $value['master_name'] ?></option>
                                        <?
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>


                        <div class="form-group">
                            <label>Описание</label>
                            <textarea class="form-control event_description w-100" style="min-height: 100px;" name="event_description" id="event_description" placeholder="Описание мероприятия..." required></textarea>
                        </div>

                        <div class="form-group">
                            <label>Дата</label>
                            <div class="mb-1"><input type="text" name="consultation_date" value="" class="consultation_date" /></div>
                        </div>
                        <div class="form-group">
                            <label>Время продолжительности консультации</label>
                            <div class="mb-1"><input type="text" name="consultation_time" value="" class="consultation_time" /></div>
                        </div>

                        <div class="form-group">
                            <label>Отменить консультацию</label>
                            <div class="mb-1">
                                <select name="consultation_cancel" class="consultation_cancel">
                                    <option value="0" selected="selected">Активная</option>
                                    <option value="1">Отменить</option>
                                </select>
                            </div>
                        </div>

                        <div class="row p-2 mt-2 mb-2 border border-gray-300 event_start_and_block">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Дата начала</label>
                                    <div class="mb-1"><input type="text" name="date_start" value="" class="date_start" /></div>
                                    <div class="timepicker_start"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group timepicker_end_form">
                                    <label>Дата окончания</label>
                                    <div class="mb-1"><input type="text" name="date_end" value="" class="date_end" /></div>
                                    <div class="timepicker_end"></div>
                                    <input type="text" name="date_time_end" value="" class="date_time_end" style="display: none;" />
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <label>Оповестить</label>
                            <input class="form-control attendees_email" name="attendees_email" id="attendees_email" value="" placeholder="Email человека..."  type="text">
                        </div>

                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Закрыть</button>
                <button type="button" class="btn btn-primary btn_event_save">Применить</button>
            </div>
        </div>

    </div>
</div>