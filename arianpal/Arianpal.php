<?php

namespace IranPayment\Arianpal;


class Arianpal
{
    private $arianpal_gateway = 'http://merchant.arianpal.com/WebService.asmx?wsdl';

    private $merchantID, $password;

    public function __construct($merchantID, $password)
    {
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
        $client = new \SoapClient($this->arianpal_gateway, ['encoding' => 'UTF-8']);

        $res = $client->RequestPayment(
            [
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
        $client = new \SoapClient($this->arianpal_gateway, ['encoding' => 'UTF-8']);
        $result = $client->VerifyPayment(
            [
                "MerchantID" => $this->merchantID,
                "Password" => $this->password,
                "Price" => $Amount,
                "RefNum" => $refNumber
            ]
        );
        return new ArianpalVerify($result, $refNumber, $resNumber);
    }
}