<?
$youtube_id = array_reverse(explode('/', $value['video_youtube']))[0];
// Ссылка:  $youtube_id 
?>
<div id="player_<?= $union_elm_id ?>" class="player" data-plyr-provider="youtube" data-plyr-embed-id="<?= $value['video_youtube'] ?>" 
     disableContextMenu="false"
     hideControls="false"
     resetOnEnd="true"
     showinfo="0"
     controls="0"
     enablejsapi="1"
     noCookie="false"
     disablekb="1"
     rel="0"
     autoplay="0"
     style="--plyr-color-main: #1ac266;"></div>
<script>
    var videoId = '<?= $youtube_id ?>';
    sendPostLigth('/jpost.php?extension=wares',
            {
                'youtube_video_data': 1,
                'video_id': videoId
            },
            function (e) {
                if (e['success'] == '1') {
                    const player = new Plyr('#player_<?= $union_elm_id ?>', {controls});
                    controls.remove('download');
                } else {
                    $('#player_<?= $union_elm_id ?>').html('<div style="text-align: center;color: #000;"><strong>Видео не доступно!</strong></div>');
                    console.log("Error with youtube file! material_id: " + '<?= $value['id'] ?>');
                    sendPostLigth('/jpost.php?extension=wares',
                            {
                                'error_message_material_file_source': 1,
                                'material_id': '<?= $value['id'] ?>',
                                'material_file': '<?= $value['video_youtube'] ?>',
                                'type': 'video_youtube'
                            },
                            function (e) {
                            });
                }
            });


    //console.log("Error with youtube file! material_id: " + '<?= $value['id'] ?>');



</script>
<?
/*
 * <iframe class="material_video_youtube" width="100%" height="415" allowfullscreen
            src="<?= $value['video_youtube'] ?>?autoplay=0&mute=0&loop=1&iv_load_policy=0&enablejsapi=1&controls=0&rel=0&modestbranding=1&disablekb=1&showinfo=0&iv_load_policy=3&allowfullscreen=0">
    </iframe>
 */