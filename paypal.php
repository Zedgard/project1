<?php

/*
 * 
 * sb-2kc43y7327660@business.example.com
 * System Generated Password:
 * l$TZ5&aR
 */

session_start();

include_once $_SERVER['DOCUMENT_ROOT'] . '/class/functions.php';
require $_SERVER['DOCUMENT_ROOT'] . '/system/paypal-sdk/autoload.php';

use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;
use PayPalCheckoutSdk\Orders\OrdersCreateRequest;
use PayPalCheckoutSdk\Orders\OrdersCaptureRequest;
use PayPalCheckoutSdk\Orders\OrdersGetRequest;

// Creating an environment
$clientId = 'AacakBi9Vo0do5ykQNirPqUogCJq6oq3ztLgs5kn9snq3XcElp_Lt8H1cVy8kMQ6agvql2FJB3bfXjR_';
$clientSecret = 'EMGQLzHe5NbFIaUhJ2NKbpip-Uegij4uAbjeWQIaiftFnBt2hTr8LiDwVCFzGGxKtx8ZgYMsypWLq5D3';

$environment = new SandboxEnvironment($clientId, $clientSecret);
$client = new PayPalHttpClient($environment);

//echo "SERVER_NAME: {$_SERVER['REQUEST_SCHEME']}://{$_SERVER['SERVER_NAME']} <br/>\n";
//exit();
if (isset($_GET['c'])) {
    /*
     * Обработка ответа платежа
     */
    $paypal_status = '';
    //print_r($_GET);
    // Here, OrdersCaptureRequest() creates a POST request to /v2/checkout/orders
// $response->result->id gives the orderId of the order created above
    $request = new OrdersCaptureRequest($_GET['token']);
    $request->prefer('return=representation');
    try {
        // Call API with your client and get a response for your call
        $response = $client->execute($request);
        // If call returns body in response, you can get the deserialized version from the result attribute of the response
//        print_r($response);
//        echo "<br/>\n";
//        echo "<b>code: </b>{$_SESSION['code']}<br/>\n";
//        echo "<br/>\n";
//        echo "response: {$response->statusCode} | {$response->result->id} | {$response->result->status}<br/>\n";
//        
        // Завершаем оплату успешным результатом
        if ($response->result->status == 'COMPLETED') {
            
        }
    } catch (HttpException $ex) {
        echo $ex->statusCode;
        print_r($ex->getMessage());
    }
} elseif (isset($_GET['orderId'])) {
    $orderId = $_GET['orderId'];
    $response = $client->execute(new OrdersGetRequest($orderId));
    /**
     * Enable the following line to print complete response as JSON.
     */
    print_r($response);
    echo "<br/>\n";
    //print json_encode($response->result);
    print "Status Code: {$response->statusCode}<br/>\n";
    print "Status: {$response->result->status}<br/>\n";
    print "Order ID: {$response->result->id}<br/>\n";
    print "Intent: {$response->result->intent}<br/>\n";
    echo "reference_id: {$response->result->purchase_units[0]->reference_id} <br/>\n";
    print "Links:<br/>\n<br/>\n";

    foreach ($response->result->links as $link) {
        print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}<br/>\n";
    }
    // 4. Save the transaction in your database. Implement logic to save transaction to your database for future reference.
    print "Gross Amount: {$response->result->purchase_units[0]->amount->currency_code} {$response->result->purchase_units[0]->amount->value}\n";
} else {
    $account = 'sb-pdnne3202163@business.example.com';

    $amount_val = floatval(10);
    $request = new OrdersCreateRequest();
    $request->prefer('return=representation');
    $request->body = [
        "id" => 1706,
        "intent" => "CAPTURE",
        "purchase_units" => [[
        "reference_id" => "1707",
        "amount" => [
            "value" => $amount_val,
            "currency_code" => "RUB"
        ]
            ]],
        "application_context" => [
            "cancel_url" => "https://dev.edgardzaycev.com/paypal.php?c=cancel",
            "return_url" => "https://dev.edgardzaycev.com/paypal.php?c=return"
        ]
    ];

    try {
        // Call API with your client and get a response for your call
        $response = $client->execute($request);

        // If call returns body in response, you can get the deserialized version from the result attribute of the response
        //echo "response: {$response->statusCode} | {$response->result->id} | {$response->result->status}<br/>\n";
        //echo "links: {$response->links} | {$response->result->id} | {$response->result->status}<br/>\n";
        print_r($response);
        echo "<br/>\n";
        echo "<br/>\n";
        print "Status Code: {$response->statusCode}<br/>\n";
        print "Status: {$response->result->status}<br/>\n";
        print "Order ID: {$response->result->id}<br/>\n";
        print "Intent: {$response->result->intent}<br/>\n";
        print "Links:\n";
        foreach ($response->result->links as $link) {
            print "\t{$link->rel}: {$link->href}\tCall Type: {$link->method}<br/>\n";
        }
        echo "<br/>\n";
        echo "<br/>\n";
        //print_r($response->result->links);
        $_SESSION['code'] = $response->result->id;
        $href = '';
        $i = 0;
        foreach ($response->result->links as $value) {
            $i++;
            $pos = strpos($value->href, 'checkoutnow');
            if ($pos > 0) {
                //location_href($value->href);
                //exit();
            }
            echo "{$i}: {$value->href}<br/>\n";
        }
    } catch (HttpException $ex) {
        echo $ex->statusCode;
        print_r($ex->getMessage());
    }
}



/*
 * <div id="smart-button-container">
      <div style="text-align: center;">
        <div style="margin-bottom: 1.25rem;">
          <p>gggg</p>
          <select id="item-options"><option value="t1" price="200">t1 - 200 RUB</option></select>
          <select style="visibility: hidden" id="quantitySelect"></select>
        </div>
      <div id="paypal-button-container"></div>
      </div>
    </div>
    <script src="https://www.paypal.com/sdk/js?client-id=sb&enable-funding=venmo&currency=RUB" data-sdk-integration-source="button-factory"></script>
    <script>
      function initPayPalButton() {
        var shipping = 0;
        var itemOptions = document.querySelector("#smart-button-container #item-options");
    var quantity = parseInt();
    var quantitySelect = document.querySelector("#smart-button-container #quantitySelect");
    if (!isNaN(quantity)) {
      quantitySelect.style.visibility = "visible";
    }
    var orderDescription = 'gggg';
    if(orderDescription === '') {
      orderDescription = 'Item';
    }
    paypal.Buttons({
      style: {
        shape: 'rect',
        color: 'gold',
        layout: 'vertical',
        label: 'paypal',
        
      },
      createOrder: function(data, actions) {
        var selectedItemDescription = itemOptions.options[itemOptions.selectedIndex].value;
        var selectedItemPrice = parseFloat(itemOptions.options[itemOptions.selectedIndex].getAttribute("price"));
        var tax = (0 === 0 || false) ? 0 : (selectedItemPrice * (parseFloat(0)/100));
        if(quantitySelect.options.length > 0) {
          quantity = parseInt(quantitySelect.options[quantitySelect.selectedIndex].value);
        } else {
          quantity = 1;
        }

        tax *= quantity;
        tax = Math.round(tax * 100) / 100;
        var priceTotal = quantity * selectedItemPrice + parseFloat(shipping) + tax;
        priceTotal = Math.round(priceTotal * 100) / 100;
        var itemTotalValue = Math.round((selectedItemPrice * quantity) * 100) / 100;

        return actions.order.create({
          purchase_units: [{
            description: orderDescription,
            amount: {
              currency_code: 'RUB',
              value: priceTotal,
              breakdown: {
                item_total: {
                  currency_code: 'RUB',
                  value: itemTotalValue,
                },
                shipping: {
                  currency_code: 'RUB',
                  value: shipping,
                },
                tax_total: {
                  currency_code: 'RUB',
                  value: tax,
                }
              }
            },
            items: [{
              name: selectedItemDescription,
              unit_amount: {
                currency_code: 'RUB',
                value: selectedItemPrice,
              },
              quantity: quantity
            }]
          }]
        });
      },
      onApprove: function(data, actions) {
        return actions.order.capture().then(function(orderData) {
          
          // Full available details
          console.log('Capture result', orderData, JSON.stringify(orderData, null, 2));

          // Show a success message within this page, e.g.
          const element = document.getElementById('paypal-button-container');
          element.innerHTML = '';
          element.innerHTML = '<h3>Thank you for your payment!</h3>';

          // Or go to another URL:  actions.redirect('thank_you.html');

        });
      },
      onError: function(err) {
        console.log(err);
      },
    }).render('#paypal-button-container');
  }
  initPayPalButton();
    </script>
 */