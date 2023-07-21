<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Incrustado</title>

    <!-- Javascript library. Should be loaded in head section -->
    <script 
        src="{{ env('IZIPAY_CLIENT_ENDPOINT') }}/static/js/krypton-client/V4.0/stable/kr-payment-form.min.js"
        kr-public-key="{{ env('IZIPAY_PUBLIC_KEY') }}" 
        kr-post-url-success="paid">
    </script>

    <!-- theme and plugins. should be loaded after the javascript library -->
    <!-- not mandatory but helps to have a nice payment form out of the box -->
    <link rel="stylesheet" href="{{ env('IZIPAY_CLIENT_ENDPOINT') }}/static/js/krypton-client/V4.0/ext/classic-reset.css">
    <script src="{{ env('IZIPAY_CLIENT_ENDPOINT') }}/static/js/krypton-client/V4.0/ext/classic.js"></script>
</head>

<body>

    <!-- payment form -->
    <div 
    class="kr-embedded"
    kr-form-token="{{ $formToken }}">
        @csrf
        <!-- payment form fields -->
        <div class="kr-pan"></div>
        <div class="kr-expiry"></div>
        <div class="kr-security-code"></div>  

        <!-- payment form submit button -->
        <button class="kr-payment-button"></button>

        <!-- error zone -->
        <div class="kr-form-error"></div>
    </div>  


</body>
</html>
