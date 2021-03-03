<!DOCTYPE html>
<html lang="ru" dir="ltr">
    <head>
        <!-- GOOGLE FONTS -->
        <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
        <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css?v=<?= rand() ?>" rel="stylesheet" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.14.0/css/all.css?v=<?= rand() ?>" 
              integrity="sha384-HzLeBuhoNPvSl5KYnjx0BT+WB0QEEqLprO+NBkkk5gbc67FTaL7XIGa2w1L0Xbgc" 
              crossorigin="anonymous">
        <!-- FAVICON -->
        <link href="/favicon.ico" rel="shortcut icon" />
        <script src="/assets/plugins/jquery/jquery.js?v=?v=<?= rand() ?>"></script>
        <link href="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.min.css?v=?v=<?= rand() ?>" rel="stylesheet" />
        <script src="/assets/plugins/jquery/jquery-ui-1.12.1/jquery-ui.js?v=?v=<?= rand() ?>"></script>
        <link href="/assets/css/sleek.css?v=?v=<?= rand() ?>" rel="stylesheet">
        <script src="/assets/js/ajax.js?v=<?= rand() ?>"></script>   

        <link href="/assets/css/sleek.css?v=?v=<?= rand() ?>" rel="stylesheet">
        <script src="/assets/js/sleek.bundle.js?v=?v=<?= rand() ?>"></script>
        <script src="/assets/js/sleek.js?v=?v=<?= rand() ?>"></script>
        <style>

        </style>
    </head>
    <body class="m-4">
        <form method="POST">
            <div>
                <div style="font-size: 2rem;font-weight: bold;margin-bottom: 10px;">Добавление нового материала</div>
                <div>Тип материала:</div>
                <div style="margin-bottom: 10px;">
                    <select name="material_type" class="form-control" >
                        <option value="">Выберите тип материала...</option>
                        <option value="material_type_text">Текст</option>
                        <option value="material_type_video">Видео</option>
                        <option value="material_type_audio">Аудио фаил</option>
                        <option value="material_type_file">Фаил</option>
                    </select>
                </div>
                <div>
                    <?
                    if (count($errors) > 0) {
                        foreach ($errors as $value) {
                            ?>
                            <div class="alert alert-danger"><?= $value ?></div>
                            <?
                        }
                    }
                    ?>
                </div>
                <div>
                    <input type="submit" value="Сохранить" class="btn btn-primary" />
                </div>
                <div></div>
            </div>
        </form>
    </body>
</html>