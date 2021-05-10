<?php
$wares_id = $obj['wares_id'];
$series_id = $obj['series_id'];
foreach ($obj['materials'] as $key => $value) {
    $video_i++;
    //$union_elm_id = mt_rand(100000, 999999) . $value['id'];
    $union_elm_id = $series_id . mt_rand(100000, 999999). $value['id'];
    ?>
    <div class="material_info series_<?= $value['series_id'] ?>" series_id="<?= $value['series_id'] ?>" material_id="<?= $value['id'] ?>">
        <div class="row mt-2 mb-2">
            <div class="col-12">
                <?
                if ($value['material_type'] == 'material_type_text') {
                    include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_text.php';
                }
                if ($value['material_type'] == 'material_type_audio') {
                    include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_audio.php';
                }
                if ($value['material_type'] == 'material_type_file') {
                    include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_file.php';
                }
                if ($value['material_type'] == 'material_type_video') {
                    include $_SERVER['DOCUMENT_ROOT'] . '/extension/wares/tmpl/material_type_video.php';
                    $video_id = $value['id'];
                    ?>
                    <script>
                        var see_video_id_<?= $video_id ?> = '<?= $video_id ?>';
                        $(".series_<?= $value['series_id'] ?>").mouseenter(function () {
                            //console.log("material_video_youtube mouseenter");
                            sendPostLigth('/jpost.php?extension=wares',
                                    {"waresVideoSee": see_video_id_<?= $video_id ?>},
                                    function (e) {
                                    });
                        });
                    </script>
                    <?
                }
                ?>
            </div>
        </div>
    </div>
    <?
}