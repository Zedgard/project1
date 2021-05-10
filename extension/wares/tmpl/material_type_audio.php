<div class="player-block calamansi-player-block float-left">
    <div id="calamansi-player-<?= $union_elm_id ?>" class="calamansi_audio_file">
        Загрузка плеера... 
    </div>
    <script>
        Calamansi.autoload();
        player_<?= $union_elm_id ?> = new Calamansi(
                document.querySelector('#calamansi-player-<?= $union_elm_id ?>'), {
            skin: '/assets/plugins/calamansi/skins/basic_download2',
            playlists: {
                'Classics': [
                    {
                        source: '<?= $value['audio_file'] ?>'
                    }
                ]
            },

            defaultAlbumCover: '/assets/plugins/calamansi/skins/default-album-cover.png'
        });
        player_<?= $union_elm_id ?>.on('initialized', function (player) {
            if ('<?= $value['audio_file_download_true'] ?>' === '1') {
                $("#calamansi-player-<?= $union_elm_id ?>").find(".clmns--track-links").hide();
            } else {
                $("#calamansi-player-<?= $union_elm_id ?>").find(".clmns--track-links").show();
            }
        });
    </script>
</div>
<div style="clear: both;height: 1rem;"></div>