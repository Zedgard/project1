<div>Редактировать данные</div>
<div>
    <input type="text" 
           name="file_<?= $value['video_youtube'] ?>" 
           value="<?= $value['material_file'] ?>" 
           id="material_file_<?= $value['id'] ?>" 
           class="form-control form-control-material material_file w-50 h-5" 
           init_href="material_file_<?= $value['id'] ?>"
           row_db="material_file" obj_id="<?= $value['id'] ?>" 
           placeholder="Ссылка на фаил..." />
</div>    
<div>    
    <input type="text" 
           name="material_title<?= $value['material_title'] ?>" 
           value="<?= $value['material_title'] ?>" 
           id="material_title_<?= $value['id'] ?>" 
           class="form-control form-control-material material_title w-50 h-5" 
           row_db="material_title" obj_id="<?= $value['id'] ?>"
           init_html="material_file_title_<?= $value['id'] ?>"
           placeholder="Текст заголовка..." />
</div>