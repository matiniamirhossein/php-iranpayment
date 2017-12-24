<?php
namespace IranPayment\Arianpal;
class ArianpalVerify
{
    private $status, $payPrice;
    private $refNumber, $resNumber;

    public function __construct($result, $refNumber, $resNumber)
    {
        $this->status = $result->verifyPaymentResult->ResultStatus;
        $this->payPrice = $result->verifyPaymentResult->PayementedPrice;
        $this->refNumber = $refNumber;
        $this->resNumber = $resNumber;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getPayPrice()
    {
        return $this->payPrice;
    }

    /**
     * @return mixed
     */
    public function getRefNumber()
    {
        return $this->refNumber;
    }

    /**
     * @return mixed
     */
    public function getResNumber()
    {
        return $this->resNumber;
    }


    public function success()
    {
        return $this->status == 'Success';
    }
}