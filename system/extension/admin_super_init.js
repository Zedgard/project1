$(document).ready(function () {
    super_init();
});

function super_init() {
    setInterval(function () {
        init_super_insert();
        init_super_elm_edit();
        init_super_delete();
    }, 1000);
}

/**
 * Добавление новой записи
 * @returns {undefined}
 */
function init_super_insert() {
    console.log('init_super_insert');
    if ($(".init_super_insert").length > 0) {
        $(".init_super_insert").unbind('click').click(function () {
            console.log('init_super_insert click ' + jpost_url);
            var jpost_url = $(this).attr("jpost_url");
            var func = $(this).attr("func");
            sendPostLigth(jpost_url,
                    {},
                    function (e) {
                        eval(func);
                    });
        });
    }
}

/**
 * Инициализирует редактирование
 * @returns {undefined}
 */
function init_super_elm_edit() {
    if ($(".init_elm_edit").length > 0) {
        $(".init_elm_edit").unbind('keyup').keyup(function () {

            var elm_id = $(this).attr("elm_id");
            var elm_table = $(this).attr("elm_table");
            var elm_row = $(this).attr("elm_row");
            var func = $(this).attr("func");
            var tagName = $(this)[0].tagName;
            var value = '';
            if (tagName == 'INPUT' || tagName == 'TEXTAREA') {
                value = $(this).val();
            }
//            if (tagName == 'TEXTAREA') {
//                value = $(this).html();
//            }
            console.log('super_elm_edit: ' + value);
            init_super_post(elm_id, value, elm_table, elm_row, func);
        });
    }
}

/**
 * Удаление
 * @returns {undefined}
 */
function init_super_delete() {
    if ($(".init_elm_delete").length > 0) {
        $(".init_elm_delete").unbind('click').click(function () {
            var elm_id = $(this).attr("elm_id");
            var elm_table = $(this).attr("elm_table");
            var func = $(this).attr("func");
            sendPostLigth('/jpost.php?super=1',
                    {
                        "elm_delete": 1,
                        "elm_id": elm_id,
                        "elm_table": elm_table
                    },
                    function (e) {
                        eval(func);
                    });
        });
    }
}


/**
 * Отправляет запрос
 * @param {type} elm_id
 * @param {type} value
 * @param {type} elm_table
 * @param {type} elm_row
 * @returns {undefined}
 */
function init_super_post(elm_id, value, elm_table, elm_row, func) {
    sendPostLigth('/jpost.php?super=1',
            {
                "elm_edit": 1,
                "elm_id": elm_id,
                "value": value,
                "elm_table": elm_table,
                "elm_row": elm_row
            },
            function (e) {
                if (func.length > 0) {
                    eval(func);
                }
            });

}

