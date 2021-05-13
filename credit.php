<!doctype html>
<html>
    <head>
        <meta charset="UTF-8">
        <script src="https://forma.tinkoff.ru/static/onlineScript.js"></script>
    </head>
    <body>
        <button
            type="button"
            class="TINKOFF_BTN_YELLOW"
            onclick="tinkoff.createDemo({
                        shopId: 'db9d1536-707b-4697-aae0-e661be297bb1',
                        showcaseId: 'ca489979-d661-4070-9f93-fb7b98ca3856',
                        demoFlow: 'sms',
                        items: [
                            {name: 'iPhone 11', price: 10000, quantity: 1},
                            {name: 'Чехол', price: 5000, quantity: 1}
                        ],
                        sum: 15000,
                        orderNumber: '20',
                        webhookURL: 'https://dev.edgardzaycev.com/credit_post.php?constants=HUK&orderId='
                    })"
            ></button>

        <button
            type="button"
            class="TINKOFF_BTN_YELLOW TINKOFF_SIZE_L"
            onclick="tinkoff.createDemo(
                            {
                                orderNumber: '1',
                                sum: 15000,
                                items: [{name: 'iphone 11', price: 10000, quantity: 1}, {name: 'Чехол', price: 5000, quantity: 1}],
                                demoFlow: 'sms',
                                promoCode: 'installment_0_0_6_5',
                                shopId: 'db9d1536-707b-4697-aae0-e661be297bb1',
                                showcaseId: 'ca489979-d661-4070-9f93-fb7b98ca3856',
                            },
                            {view: 'newTab'}
                    )"
            >Оплатить частями</button>
    </body>
    <script>
    tinkoff.methods.on(function() {
    console.log('ggggg');
});
        tinkoff.methods.on(tinkoff.constants.SUCCESS, onMessage);
        tinkoff.methods.on(tinkoff.constants.REJECT, onMessage);
        tinkoff.methods.on(tinkoff.constants.CANCEL, onMessage);
        function onMessage(data) {
            switch (data.type) {
                case tinkoff.constants.SUCCESS:
                    console.log('SUCCESS', data.meta.iframe.url);
                    break;
                case tinkoff.constants.REJECT:
                    console.log('REJECT', data.meta.iframe.url);
                    break;
                case tinkoff.constants.CANCEL:
                    console.log('CANCEL', data.meta.iframe.url);
                    break;
                default:
                    return;
            }
            tinkoff.methods.off(tinkoff.constants.SUCCESS, onMessage);
            tinkoff.methods.off(tinkoff.constants.REJECT, onMessage);
            tinkoff.methods.off(tinkoff.constants.CANCEL, onMessage);
            data.meta.iframe.destroy();
        }
    </script>
</html>