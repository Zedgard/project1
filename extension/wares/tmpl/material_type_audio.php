<div class="player-block float-left">
    <div id="calamansi-player-1">
        Загрузка плеера...
    </div>
</div>
<script>
    // Calamansi.autoload();
    new Calamansi(document.querySelector('#calamansi-player-1'), {
        skin: '/assets/plugins/calamansi/skins/basic',
        playlists: {
            'Classics': [
                {
                    source: '<?= $value['audio_file'] ?>',
                }
            ],
        },
        defaultAlbumCover: '/assets/plugins/calamansi/skins/default-album-cover.png',
    });
</script>
<a href="<?= $value['audio_file'] ?>" target="_blank" class="btn btn-light float-left ml-3 audio_file" title="Скачать"><i class="fas fa-upload"></i></a>
<div style="clear: both;height: 1rem;"></div>