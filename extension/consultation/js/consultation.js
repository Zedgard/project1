$(".calendar_day_active").unbind("click").click(function () {
    $(".calendar_day_active").removeClass("active");
    $(this).addClass("active");
    $(".new_tr").remove();
    $(this).closest("tr").after('<tr class="new_tr"><td colspan="7">1111</td></tr>');
});

