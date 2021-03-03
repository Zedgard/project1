<div>Редактировать данные</div>
<div>
    <input type="text" 
           name="audio_file" 
           value="<?= $value['audio_file'] ?>" 
           id="material_<?= $value['id'] ?>" 
           class="form-control form-control-material w-50 h-5" 
           init_href="audio_file"
           init_audio="audio_file_play"
           row_db="audio_file" obj_id="<?= $value['id'] ?>" 
           placeholder="Ссылка на фаил..." />
</div>    