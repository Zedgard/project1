<div class="player-block calamansi-player-block float-left">
    <?
    if (strlen($value['material_title']) > 0) {
        ?>
        <div class="mb-2"><?= $value['material_title'] ?></div>
        <?
    }
    ?>
    <audio id="player_<?= $union_elm_id ?>" class="player_<?= $union_elm_id ?> audio_player" controls style="--plyr-color-main: #1ac266;"> 
        <source id="mp3_<?= $union_elm_id ?>" src="<?= $value['audio_file'] ?>" type="audio/mp3" />
    </audio>
    <div class="clmns--track-links" style="display: none;">
        <a href="<?= $value['audio_file'] ?>"
           target="_blank"
           class="fas fa-file-upload" style="font-size: 1.5rem;color: #48cf3a;">&nbsp;
        </a>
    </div>
    <script>
        if ('<?= $value['audio_file_download_true'] ?>' === '1') {
            controls.push('download');
        }
        const player<?= $union_elm_id ?> = new Plyr('#player_<?= $union_elm_id ?>', {controls, 'autopause': true});
        controls.remove('download');

        /*
         * Оповещение если ссылка на фаил не верная 
         */
        $("#mp3_<?= $union_elm_id ?>").on("error", function (e) {

            const player<?= $union_elm_id ?> = new Plyr('#player_<?= $union_elm_id ?>', {controls, 'autopause': true});
            controls.remove('download');
            $("#mp3_<?= $union_elm_id ?>").on("error", function (e) {
                sendPostLigth('/jpost.php?extension=wares',
                        {
                            'error_message_material_file_source': 1,
                            'material_id': '<?= $value['id'] ?>',
                            'material_file': '<?= $value['audio_file'] ?>',
                            'type': 'audio'
                        },
                        function (e) {
                        });
            });
        });

        player<?= $union_elm_id ?>.on('playing', event => {
            if (!!eplayer && eplayer != player<?= $union_elm_id ?>) {
                eplayer.pause();
            }
            eplayer = player<?= $union_elm_id ?>;
            const instance = event.detail.plyr;
            const players = Plyr.setup('.js-player');

        });
<?php
//            $.each(players, function (i) {
//                console.log('players: ' + i);
//                players[i].on('play', event => {
//                    for (let a = 0; a < players.length; a++) {
//                        if (a != i) {
//                            players[a].pause();
//                        }
//                    }
//                });
//            });
//            
//        $('.plyr').mouseover(function () {
//            console.log('mouseover');
//            
//            Plyr.setup($(this).find('.audio_player'));
//            console.log('Plyr');
//        });
//        player.on('playing', event => {
//            player.pause();
//            setTimeout(function () {
//                const instance = event.detail.plyr;
//                instance.play();
//            }, 100);
//
//
////            controls.remove('download');
////            var elements = document.getElementsByClassName("plyr__controls");
////            for (var i = 0; i < elements.length; i++) {
////                elements[i].addEventListener("mousedown", function () {
////                    player.pause();
////                });
////            }
//
////            $(".plyr__controls").keypress(function () {
////                console.log('plyr__controls');
////                if (!!player) {
////                    player.pause();
////                }
////            });
//        });
?>
    </script>
</div>
<div style="clear: both;height: 1rem;"></div>