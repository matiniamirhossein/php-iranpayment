<?php

namespace IranPayment\Arianpal;


use IranPayment\Client;

class Arianpal
{
    private $arianpal_gateway = 'http://merchant.arianpal.com/WebService.asmx?wsdl';

    private $merchantID, $password;

    private $client;

    public function __construct($merchantID, $password)
    {
        $this->client = new Client($this->arianpal_gateway);
        $this->merchantID = $merchantID;
        $this->password = $password;
    }

    /**
     * @param ArianpalRequest $request
     * @return mixed
     * @throws ArianpalException
     */
    public function requestForPayment(ArianpalRequest $request)
    {
        $res = $this->client->call('RequestPayment', [
            "MerchantID" => $this->merchantID,
            "Password" => $this->password,
            "Price" => $request->getAmount(),
            "ReturnPath" => $request->getCallbackURL(),
            "ResNumber" => $request->getResNumber(),
            "Description" => $request->getDescription(),
            "Paymenter" => $request->getPaymenter(),
            "Email" => $request->getEmail(),
            "Mobile" => $request->getMobile()
        ]);
        $Status = $res->RequestPaymentResult->ResultStatus;
        $PayPath = $res->RequestPaymentResult->PaymentPath;
        if ($Status == 'Succeed') {
            return $PayPath;
        }
        throw new ArianpalException("An error occurred in payment gateway. status: $Status");
    }

    public function verifyPayment($status, $refNumber, $resNumber, $Amount)
    {
        if ($status <> 100) {
            return false;
        }
        $result = $this->client->call('VerifyPayment', [
                "MerchantID" => $this->merchantID,
                "Password" => $this->password,
                "Price" => $Amount,
                "RefNum" => $refNumber
            ]
        );
        return new ArianpalVerify($result, $refNumber, $resNumber);
    }
}