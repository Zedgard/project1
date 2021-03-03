<div>Редактировать данные</div>
<div>
    <input type="text" 
           name="video_material_<?= $value['video_youtube'] ?>" 
           value="<?= $value['video_youtube'] ?>" 
           id="video_material_<?= $value['id'] ?>" 
           class="form-control form-control-material h-5" 
           row_db="video_youtube" obj_id="<?= $value['id'] ?>" 
           init_youtube_src="material_video_youtube"
           placeholder="Ссылка на youtube фаил..." />
</div>    
<div>    
    <input type="text" 
           name="video_time_material_<?= $value['video_youtube'] ?>" 
           value="<?= $value['video_time'] ?>" 
           id="video_time_material_<?= $value['id'] ?>" 
           class="form-control form-control-material h-5" 
           row_db="video_time" obj_id="<?= $value['id'] ?>"
           title="Время продолжительсти видео..." />
</div>