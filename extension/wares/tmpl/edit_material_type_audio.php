<div>Редактировать данные</div>
<div>
    <?
    $union_elm_id = mt_rand(100000, 999999) . $value['id'];
    ?>
    <input type="text" 
           name="audio_file" 
           value="<?= $value['audio_file'] ?>" 
           id="material_<?= $union_elm_id ?>" 
           class="form-control form-control-material w-50 h-5" 
           init_href="audio_file"
           init_audio="audio_file_play"
           row_db="audio_file" obj_id="<?= $value['id'] ?>" 
           placeholder="Ссылка на фаил..." />
</div>    