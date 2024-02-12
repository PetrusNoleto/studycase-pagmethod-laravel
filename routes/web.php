<?php
use Illuminate\Support\Facades\Route;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\MercadoPagoConfig;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/pagamentos', function () {
    return view('pagamentos');
});
Route::get('/pagamentos/pix/', function () {
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
    return view('pix',['obj'=>$obj]);
});
Route::get('/pagamentos/mercadopago/', function () {
   
    return view('mercadopago');
});