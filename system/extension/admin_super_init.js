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
                        if (typeof func != "undefined") {
                            eval(func);
                        }
                    });
        });
    }
}

/**
 * Инициализирует редактирование
 * @returns {undefined}
 */
function init_super_elm_edit() {
    if ($(".init_elm_edit").length > 0) { // keyup, focusout, change
        $(".init_elm_edit").unbind('focusout').unbind('keyup').unbind('change').on('keyup, focusout, change', function (e) {
            var e = this;
            setTimeout(function () {
                var elm_id = $(e).attr("elm_id");
                var elm_table = $(e).attr("elm_table");
                var elm_row = $(e).attr("elm_row");
                var func = $(e).attr("func");
                var tagName = $(e)[0].tagName;
                var elm_type = $(e).attr("type");
                var value = '';
                if (tagName == 'INPUT' || tagName == 'TEXTAREA') {
                    value = $(e).val();
                }
                if (elm_type === 'checkbox') {
                    if ($(e).prop("checked")) {
                        value = 1;
                    } else {
                        value = 0;
                    }
                }
//            if (tagName == 'TEXTAREA') {
//                value = $(this).html();
//            }
                console.log('super_elm_edit: ' + value);
                init_super_post(elm_id, value, elm_table, elm_row, func);
            }, 200);

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
                        if (typeof func != "undefined") {
                            eval(func);
                        }
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
                if (typeof func != "undefined") {
                    eval(func);
                }
            });

}

