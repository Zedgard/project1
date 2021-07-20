<link rel="stylesheet" href="/extension/products/office.css<?= $_SESSION['rand'] ?>">
<link rel="stylesheet" href="/assets/plugins/calamansi/calamansi.min.css">
<script src="/assets/plugins/calamansi/calamansi.min.js"></script>
<link href="/assets/plugins/video/css/videojs.css<?= $_SESSION['rand'] ?>" rel="stylesheet">
<script src="/assets/plugins/video/videojs.js<?= $_SESSION['rand'] ?>"></script>
<script src="/assets/plugins/video/Youtube.js<?= $_SESSION['rand'] ?>"></script>

<div class="row webinar_head_bg mt-3 pt-3 pb-3">
    <div class="col-md-3 mb-3">
        <div class="webinar_head_logo2 mb-2 text-center">
            <img src="<?= $wares_info['images'] ?>" class="webinar_head_logo_img mt-2"/>    
        </div>
        <div class="webinar_head_articul text-right mb-2">
            Артикул: <span><?= $wares_info['articul'] ?></span>
        </div>
    </div>
    <div class="col-md-9 mb-3">
        <div class="webinar_head_file2 mb-2">
            <div>
                <?
                if (strlen($wares['url_file']) > 0) {
                    $file_type = array_reverse(explode('.', $wares['url_file']))[0];
                    if ($file_type == 'mp3') {
                        ?>

                        <div class="player-block float-left">
                            <div id="calamansi-player-<?= $wares['id'] ?>">
                                Загрузка плеера... 
                            </div>
                        </div>
                        <script>
                            Calamansi.autoload();
                            // document.getElementById('full-demo-player')
                            //document.querySelector('#calamansi-player-<?= $wares['id'] ?>')
                            new Calamansi(document.querySelector('#calamansi-player-<?= $wares['id'] ?>'), {
                                skin: '/assets/plugins/calamansi/skins/basic_download2',
                                playlists: {
                                    'Classics': [
                                        {
                                            source: '<?= $wares['url_file'] ?>',
                                        }
                                    ],
                                },
                                defaultAlbumCover: '/assets/plugins/calamansi/skins/default-album-cover.png',
                            });
                            //player.destroy();
                        </script>
                        <div style="clear: both;height: 1rem;"></div>
                        <?
                    } else {
                        ?>
                        <a href="<?= $wares['url_file'] ?>" target="_blank" class="btn btn-primary">Скачать файлы</a>
                        <?
                    }
                }
                ?>
            </div>
        </div>

        <div class="wares_info_descr ulli">
            <?= $wares_info['descr'] ?>
        </div>
    </div>
</div>
<?
if (strlen($wares_info['images']) > 0):
    ?>
    <div class="webinar_head_logo" style="display: none;">
        <img src="<?= $wares_info['images'] ?>" class="webinar_head_logo_img"/>    
    </div>
    <div class="webinar_head_title" style="display: none;">
        <?= $wares_info['title'] ?>
    </div>
    <div class="webinar_head_articul" style="display: none;">
        Артикул: <span><?= $wares_info['articul'] ?></span>
    </div>
    <div class="webinar_head_file" style="display: none;">
        <div class="mt-2">
            <?
            if (strlen($wares['url_file']) > 0) {
                $file_type = array_reverse(explode('.', $wares['url_file']))[0];
                if ($file_type == 'mp3') {
                    ?>
                    <div class="player-block float-left">
                        <div id="calamansi-player-<?= $wares['id'] ?>2">
                            Загрузка плеера... 
                        </div>
                    </div>
                    <script>
                        Calamansi.autoload();
                        new Calamansi(document.querySelector('#calamansi-player-<?= $wares['id'] ?>2'), {
                            skin: '/assets/plugins/calamansi/skins/basic_download2',
                            playlists: {
                                'Classics': [
                                    {
                                        source: '<?= $wares['url_file'] ?>',
                                    }
                                ],
                            },
                            defaultAlbumCover: '/assets/plugins/calamansi/skins/default-album-cover.png',
                        });
                        //player.destroy();
                    </script>
                    <div style="clear: both;height: 1rem;"></div>
                    <?
                } else {
                    ?>
                    <a href="<?= $wares['url_file'] ?>" target="_blank" class="btn btn-primary">Скачать файлы</a>
                    <?
                }
            }
            ?>
        </div>
    </div>
    <?
endif;
?>
     
