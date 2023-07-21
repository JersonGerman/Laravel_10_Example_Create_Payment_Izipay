<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Lyra\Client;
use Lyra\Exceptions\LyraException;

class IzipayController extends Controller
{
    private $client;

    public function __construct() {
        Client::setDefaultUsername( env('IZIPAY_USERNAME') );
        Client::setDefaultPassword( env('IZIPAY_PASSWORD') );
        Client::setDefaultEndpoint( env('IZIPAY_ENDPOINT') );
        Client::setDefaultPublicKey( env('IZIPAY_PUBLIC_KEY') );
        Client::setDefaultSHA256Key( env('IZIPAY_SHA256_KEY') );
        Client::setDefaultClientEndpoint( env('IZIPAY_CLIENT_ENDPOINT') );

        $this->client = new Client();
    }
    
    public function getFormToken()
    {
        $store = array(
            "amount" => 250,
            "currency" => "PEN",
            "orderId" => uniqid("MyOrderId"),
            "customer" => array(
                "email" => "sample@example.com"
            )
        );

        $response = $this->client->post("V4/Charge/CreatePayment", $store);

        /* I check if there are some errors */
        if ($response['status'] != 'SUCCESS') {
            /* an error occurs, I throw an exception */
            echo($response);
            $error = $response['answer'];
            throw new LyraException("error " . $error['errorCode'] . ": " . $error['errorMessage'] );
        }
        /* everything is fine, I extract the formToken */
        $formToken = $response["answer"]["formToken"];

        return view('izipay.incrustado', compact('formToken'));

    }

    public function success(Request $request){

        /* No POST data ? paid page in not called after a payment form */
        if (empty($_POST)) throw new LyraException("no post data received!");

        /* Use client SDK helper to retrieve POST parameters */
        $formAnswer = $this->client->getParsedFormAnswer();
        
        /* Check the signature */
        if (!$this->client->checkHash()) {
            //something wrong, probably a fraud ....
            throw new LyraException('invalid signature');
        }
        
        /* I check if it's really paid */
        if ($formAnswer['kr-answer']['orderStatus'] != 'PAID') {
            return 'Transaction not paid !';
        } else {
            $dataPost = json_encode($_POST, JSON_PRETTY_PRINT);
            $formAnswer = json_encode($formAnswer, JSON_PRETTY_PRINT);
            $title = 'Transaction paid !';

            return view('izipay.paid', compact('formAnswer', 'dataPost', 'title'));
        }

    }

    public function notificationIpn(Request $request){
        /* No POST data ? paid page in not called after a payment form */
        if (empty($_POST)) {
            throw new LyraException('no post data received!');
        }
        /* Check the signature using password */
        if (!$this->client->checkHash()) {
            //something wrong, probably a fraud ....
            throw new LyraException('invalid signature');
        }

        /* Retrieve the IPN content */
        $rawAnswer = $this->client->getParsedFormAnswer();
        $formAnswer = $rawAnswer['kr-answer'];

        /* Retrieve the transaction id from the IPN data */
        $transaction = $formAnswer['transactions'][0];

        /* get some parameters from the answer */
        $orderStatus = $formAnswer['orderStatus'];
        $orderId = $formAnswer['orderDetails']['orderId'];
        $transactionUuid = $transaction['uuid'];

        /* I update my database if needed */
        /* Add here your custom code */ 

        /**
         * Message returned to the IPN caller
         * You can return want you want but
         * HTTP response code should be 200
         */
        print 'OK! OrderStatus is ' . $orderStatus;

    }
}
