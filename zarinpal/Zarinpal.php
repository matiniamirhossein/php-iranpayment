<?php
namespace IranPayment\Zarinpal;
class Zarinpal
{
    private $zarinpal_gateway = 'https://de.zarinpal.com/pg/services/WebGate/wsdl';
    private $zarinpal_pay_url = 'https://www.zarinpal.com/pg/StartPay/';
    private $merchantID;

    public function __construct($merchantID)
    {
        $this->merchantID = $merchantID;
    }

    public function requestForPayment(ZarinpalRequest $request)
    {
        $client = new \SoapClient($this->zarinpal_gateway, ['encoding' => 'UTF-8']);
        $result = $client->PaymentRequest([
            'MerchantID' => $this->merchantID,
            'Amount' => $request->getAmount(),
            'Description' => $request->getDescription(),
            'Email' => $request->getEmail(),
            'Mobile' => $request->getMobile(),
            'CallbackURL' => $request->getCallbackUrl()
        ]);
        if ($result->Status == 100) {
            return $this->zarinpal_pay_url . $result->Authority;
        }
        throw new ZarinpalException("An error occurred in payment gateway. status: $result->Status");
    }

    public function verifyPayment($Authority, $Amount)
    {
        $client = new \SoapClient('https://www.zarinpal.com/pg/services/WebGate/wsdl', ['encoding' => 'UTF-8']);
        $result = $client->PaymentVerification([
            'MerchantID' => $this->merchantID,
            'Authority' => $Authority,
            'Amount' => $Amount,
        ]);
        return new ZarinpalResponse($result);
    }
}