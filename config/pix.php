<?php

$curl = curl_init();

curl_setopt_array($curl, array(
    CURLOPT_URL => 'https://api.mercadopago.com/v1/payments',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS => '{
  "description": "Payment for product",
  "external_reference": "MP0001",
  "notification_url":"http://www.google.com.br/",
  "payer": {
    "entity_type": "individual",
    "type": "customer",
    "email": "test_user_123@testuser.com",
    "identification": {
      "type": "CPF",
      "number": "95749019047"
    }
  },
  "payment_method_id": "pix",
  "transaction_amount": 58.8
}',
    CURLOPT_HTTPHEADER => array(
        'Content-Type: application/json',
        'Bearer APP_USR-740760995891975-020913-61a08e0601ebcc2b1bfdecc10512a72e-444600657'
    ),
));

$response = curl_exec($curl);
curl_close($curl);
$obj = json_decode($response);

if(isset($obj->id)){
    if($obj->id  != null){
        $copia_cola = $obj->point_of_interaction->transaction_data->qrcode;
        $img_qrcode = $obj->point_of_interaction->transaction_data->qrcode_base64;
        $link_externo = $obj->point_of_interaction->transaction_data->ticket_url;

        echo "<img src='data:image/base64, {$img_qrcode}' width='200'  /><br/>";
        echo "<textarea>{$copia_cola}</textarea>";
        echo "<a href '' target='_blank'>{$link_externo}</a>";

    }
}