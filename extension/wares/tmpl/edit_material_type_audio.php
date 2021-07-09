<div>Редактировать данные</div>
<div>
    <div class="mb-3">
        <input type="text" 
               name="audio_file" 
               value="<?= $value['audio_file'] ?>" 
               id="<?= $union_elm_id ?>" 
               class="form-control form-control-material w-50 h-5" 
               init_href="audio_file"
               init_audio="audio_file_play"
               row_db="audio_file" obj_id="<?= $value['id'] ?>" 
               placeholder="Ссылка на фаил..." />    
    </div>

    <div class="mb-3">
        <label class="switch switch-text switch-primary form-control-label">
            <input type="checkbox" 
                   class="switch-input form-check-input form-control-material audio_file_download_true" 
                   value="1" 
                   id="<?= $union_elm_id ?>"
                   init_checked="audio_file_download_true"
                   row_db="audio_file_download_true" obj_id="<?= $value['id'] ?>" 
                   <?= ($value['audio_file_download_true'] == '1') ? 'checked="checked"' : '' ?>>
            <span class="switch-label" data-on="On" data-off="Off"></span>
            <span class="switch-handle"></span> 
        </label>
        Скачивание файла
    </div>    
</div>  