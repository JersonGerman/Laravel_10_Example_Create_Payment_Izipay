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

    <!-- theme and plugins. should be loaded after the javascript library  : Theme Classic -->
    <!-- not mandatory but helps to have a nice payment form out of the box -->
    {{-- <link rel="stylesheet" href="{{ env('IZIPAY_CLIENT_ENDPOINT') }}/static/js/krypton-client/V4.0/ext/classic-reset.css"> --}}
    {{-- <script src="{{ env('IZIPAY_CLIENT_ENDPOINT') }}/static/js/krypton-client/V4.0/ext/classic.js"></script> --}}

     <!-- 3 : theme néon should be loaded in the HEAD section  : Theme Neon -->
    <link rel="stylesheet" href="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/neon-reset.min.css"> 
    <script type="text/javascript" src="https://static.micuentaweb.pe/static/js/krypton-client/V4.0/ext/neon.js"> </script> 
    <style>
        div.kr-popin-modal-header-image > img{
            border-radius: 50%;
            overflow: hidden;
        }
        div.kr-popin-modal-header-image{
            transform: scale(1.1) ;
        }
        
        div.kr-popin-modal-header-background-image{
            background: #fff !important;   
        }
        div.kr-popin-modal-header{
            border-bottom: 0 !important;
        }
    </style>
</head>

<body>

    <!-- payment form -->
    <div 
    class="kr-smart-form" 
    {{-- class="kr-embedded"  --}}
    kr-form-token="{{ $formToken }}">
        @csrf
        <!-- payment form fields -->
        {{-- <div class="kr-pan"></div>
        <div class="kr-expiry"></div>
        <div class="kr-security-code"></div>  --}}

        <!-- payment form submit button -->
        {{-- <button class="kr-payment-button">this will cost %amount-and-currency% !!</button> --}}

        <!-- error zone -->
        {{-- <div class="kr-form-error"></div> --}}

        {{-- <div class="kr-embedded">
            <div class="kr-security-code"></div>
            <div class="kr-pan"></div>
            <div class="kr-expiry"></div>
          </div> --}}
        
    </div>  
    <script>
        KR_CONFIGURATION.merchant.header.image.src = "https://raw.githubusercontent.com/izipay-pe/Popin-PaymentForm-Php/main/images/logo.png";
    </script>


</body>
</html>
