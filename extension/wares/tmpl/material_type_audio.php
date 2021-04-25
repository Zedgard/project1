<div class="player-block float-left">
    <div id="calamansi-player-<?= $union_elm_id ?>">
        Загрузка плеера... 
    </div>
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
</script>

<div style="clear: both;height: 1rem;"></div>