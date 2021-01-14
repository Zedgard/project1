$(document).ready(function () {
    setInterval(function () {
        init_super_elm_edit();
        init_super_delete();
    }, 1000);
});

/**
 * Инициализирует редактирование
 * @returns {undefined}
 */
function init_super_elm_edit() {
    if (!!$(".init_elm_edit")) {
        $(".init_elm_edit").unbind('change').change(function () {
            console.log('init_elm_edit');
            var elm_id = $(this).attr("elm_id");
            var elm_table = $(this).attr("elm_table");
            var elm_row = $(this).attr("elm_row");
            var value = $(this).val();
            init_super_post(elm_id, value, elm_table, elm_row);
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
function init_super_post(elm_id, value, elm_table, elm_row) {
    sendPostLigth('/jpost.php?super=1',
            {
                "elm_edit": 1,
                "elm_id": elm_id,
                "value": value,
                "elm_table": elm_table,
                "elm_row": elm_row
            },
            function (e) {

            });

}

/**
 * Удаление
 * @returns {undefined}
 */
function init_super_delete() {
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