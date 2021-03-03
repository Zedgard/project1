<div>Редактировать данные</div>
<div>
    <input type="text" 
           name="video_youtube_<?= $value['video_youtube'] ?>" 
           value="<?= $value['material_file'] ?>" 
           id="video_youtube_<?= $value['id'] ?>" 
           class="form-control form-control-material w-50 h-5" 
           init_href="material_file"
           row_db="material_file" obj_id="<?= $value['id'] ?>" 
           placeholder="Ссылка на фаил..." />
</div>    
<div>    
    <input type="text" 
           name="video_youtube_<?= $value['video_youtube'] ?>" 
           value="<?= $value['material_title'] ?>" 
           id="video_youtube_<?= $value['id'] ?>" 
           class="form-control form-control-material w-50 h-5" 
           row_db="material_title" obj_id="<?= $value['id'] ?>"
           init_html="material_title"
           placeholder="Текст заголовка..." />
</div>