<?php

namespace IranPayment\Zarinpal;

use IranPayment\Zarinpal\Types\Authority;

class Zarinpal
{
    const WEB_GATE = 1;
    const ZARIN_GATE = 2;
    const MOBILE_GATE = 3;
    const USSD_GATE = 4;

    private $zarinpal_gateway = 'https://de.zarinpal.com/pg/services/WebGate/wsdl';
    private $pay_urls = [
        self::WEB_GATE => 'https://www.zarinpal.com/pg/StartPay/%s',
        self::ZARIN_GATE => 'https://www.zarinpal.com/pg/StartPay/%s/ZarinGate',
        self::MOBILE_GATE => 'https://www.zarinpal.com/pg/StartPay/%s/MobileGate',
        self::USSD_GATE => '*770*97*2*%s#',
    ];
    private $merchantID;
    /** @var \SoapClient */
    private $client;


    public function __construct($merchantID)
    {
        $this->merchantID = $merchantID;
        $this->client = new \SoapClient($this->zarinpal_gateway, ['encoding' => 'UTF-8']);
    }

    public function requestForPayment(ZarinpalRequest $request, $type = self::WEB_GATE)
    {
        $result = $this->client->PaymentRequest([
            'MerchantID' => $this->merchantID,
            'Amount' => $request->getAmount(),
            'Description' => $request->getDescription(),
            'Email' => $request->getEmail(),
            'Mobile' => $request->getMobile(),
            'CallbackURL' => $request->getCallbackUrl()
        ]);
        if ($result->Status == 100) {
            return sprintf($this->pay_urls[$type], $result->Authority);
        }
        throw new ZarinpalException("An error occurred in payment gateway. status: $result->Status");
    }

    public function verifyPayment($Authority, $Amount)
    {
        $result = $this->client->PaymentVerification([
            'MerchantID' => $this->merchantID,
            'Authority' => $Authority,
            'Amount' => $Amount,
        ]);
        return new ZarinpalResponse($result);
    }

    public function getUnverifiedTransactions()
    {
        $result = $this->client->GetUnverifiedTransactions([
            'MerchantID' => $this->merchantID,
        ]);
        if ($result->status != 100) {
            throw new ZarinpalException("An error occurred in getUnverifiedTransactions. status: $result->Status");
        }
        $Authorities = [];
        foreach (json_encode($result->Authorities, true) as $authority) {
            $Authorities[] = new Authority($authority);
        }
        return ['status' => $result->status, 'Authorities' => $Authorities];
    }

    public function refreshAuthority($authority, $expireIn)
    {
        $result = $this->client->RefreshAuthority([
            'MerchantID' => $this->merchantID,
            'Authority' => $authority,
            'ExpireIn' => $expireIn,
        ]);
        if ($result->status != 100) {
            throw new ZarinpalException("An error occurred in refreshAuthority. status: $result->Status");
        }
        return $result->status;
    }


    public function __destruct()
    {
        $this->client = null;
    }
}