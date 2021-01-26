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
                            <input class="form-control event_summary" name="event_summary" id="event_summary" value="" placeholder="Название мероприятия..."  type="text" required>
                        </div>

                        <div class="form-group">
                            <label>Описание</label>
                            <textarea class="form-control event_description w-100 h-5" name="event_description" id="event_description" placeholder="Описание мероприятия..." required></textarea>
                        </div>
                        <div class="row p-2 mt-2 mb-2 border border-gray-300">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label>Дата начала</label>
                                    <div class="mb-1"><input type="text" name="date_start" value="" class="date_start" /></div>
                                    <div class="timepicker_start"></div>
                                    <input type="text" name="date_time_start" value="" class="date_time_start" style="display: none;" />
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