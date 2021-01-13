/* Промо время */
function promoTimeInit(e, startTime) {
    if (startTime == undefined) {
        startTime = 'Oct 30, 2020 00:00:00';
    }
    let obj = $(e);
    const second = 1000,
            minute = second * 60,
            hour = minute * 60,
            day = hour * 24;

    var countDown = new Date(startTime).getTime();
    var x = setInterval(function () {
        let now = new Date().getTime();
        let distance = countDown - now;

        //console.log('distance: ' + distance + ' countDown - now: ' + countDown + ' - ' + now);
        //console.log('days: ' + Math.floor(distance / (day)));
        $(e).find(".promoTime_days").html(String(Math.floor(distance / (day))));
        $(e).find(".promoTime_hours").html(String(Math.floor((distance % (day)) / (hour))));
        $(e).find(".promoTime_minutes").html(String(Math.floor((distance % (hour)) / (minute))));
        $(e).find(".promoTime_seconds").html(String(Math.floor((distance % (minute)) / second)));

        //do something later when date is reached
        if (distance < 0) {
            clearInterval(x);
            $(e).closest(".promo_block").find(".promoTime").html("<h3>Промо звершено!</h3>");
            //  Акция закончилась
        }
    }, second);
}

$(document).ready(function () {
    promoTimeInit(".promoTime1", 'Oct 31, 2020 00:00:00');
    promoTimeInit(".promoTime2", 'Oct 31, 2020 00:00:00');
    promoTimeInit(".promoTime3", 'Oct 31, 2020 00:00:00');
});