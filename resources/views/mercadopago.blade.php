<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    </script>
</head>
<body>
       mercado pago
       <div id="wallet_container">
        <p>O ID da preferência é: {{ $preference->id }}</p>
        @foreach ( $preference->items as $item )
            <p>{{$item->title}}<p>
        @endforeach
       </div>
       <script src="https://sdk.mercadopago.com/js/v2">
                const mp = new MercadoPago('TEST-64f5e988-b96e-4a90-beac-30b2c8c30e5a');
                const bricksBuilder = mp.bricks();
                mp.bricks().create("wallet", "wallet_container", {
                initialization: {
                    preferenceId: {{ $preference->id }},  
                },
                customization: {
                texts: {
                valueProp: 'smart_option',
                },
                }});
                



        </script>
</body>
