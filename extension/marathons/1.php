<?php
foreach ($materials as $key => $value) {
    if ($value['series_id'] == $series_value['id']) {
        $video_i++;
        $union_elm_id = mt_rand(100000, 999999) . $value['id'];
        ?>
        <div class="material_info series_<?= $value['series_id'] ?>" series_id="<?= $value['series_id'] ?>" material_id="<?= $value['id'] ?>" style="display: none;">
            <div class="row mt-2 mb-2">
                <div class="col-12 material_content_block">
                    <?
//                                                if ($value['material_type'] == 'material_type_text') {
//                                                    include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_text.php';
//                                                }
//                                                if ($value['material_type'] == 'material_type_audio') {
//                                                    include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_audio.php';
//                                                }
//                                                if ($value['material_type'] == 'material_type_file') {
//                                                    include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_file.php';
//                                                }
//                                                if ($value['material_type'] == 'material_type_video') {
//                                                    include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_video.php';
//                                                    $video_id = $value['id'];
//                                                    //echo "video_id: {$video_id}<br/>\n";
//                                                    
                    ?>
                    <script>
                        /*
                         var see_video_id_<?= $video_id ?> = '<?= $video_id ?>';
                         $(document).ready(function () {
                         $(".series_<?= $value['series_id'] ?>").mouseenter(function () {
                         //console.log("material_video_youtube mouseenter");
                         sendPostLigth('/jpost.php?extension=wares',
                         {"waresVideoSee": see_video_id_<?= $video_id ?>},
                         function (e) {
                         });
                         });
                         });
                         */
                    </script>
                    <?
//                                                }
                    ?>
                </div>
            </div>
        </div>
        <?
    }
}