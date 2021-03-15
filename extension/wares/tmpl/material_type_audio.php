<?
$union_elm_id = mt_rand(100000, 999999) . $value['id'];
?>
<div class="player-block float-left">
    <div id="calamansi-player-<?= $union_elm_id ?>">
        Загрузка плеера... 
    </div>
</div>
<script>
    Calamansi.autoload();
   // document.getElementById('full-demo-player')
    //document.querySelector('#calamansi-player-<?= $union_elm_id ?>')
    new Calamansi( 
            document.querySelector('#calamansi-player-<?= $union_elm_id ?>'), {
        skin: '/assets/plugins/calamansi/skins/basic_download2',
        playlists: {
            'Classics': [
                {
                    source: '<?= $value['audio_file'] ?>',
                }
            ],
        },
        defaultAlbumCover: '/assets/plugins/calamansi/skins/default-album-cover.png',
    });

    //player.destroy();
</script>
<!--
<a href="<?= $value['audio_file'] ?>" target="_blank" class="btn btn-light float-right audio_file" title="Скачать"><i class="fas fa-upload"></i></a>
-->
<div style="clear: both;height: 1rem;"></div>