<div>Редактировать данные</div>
<div>
    <textarea name="material_descr" class="form-control form-control-material" 
              id="material_<?= $value['id'] ?>" 
              init_html="material_descr"
              row_db="material_descr" obj_id="<?= $value['id'] ?>" 
              placeholder="Текст..."
              style="width: 100%;min-height: 200px;"><?= $value['material_descr'] ?></textarea>

</div>    