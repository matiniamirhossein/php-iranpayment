<?php
namespace IranPayment\Zarinpal\Types;
use IranPayment\Zarinpal\Zarinpal;
use function json_encode;

class Authority
{
    private $dataArray;

    public function __construct($dataArray)
    {
        $this->dataArray = $dataArray;
    }

    /**
     * @return mixed
     */
    public function getAuthority()
    {
        return $this->dataArray['Authority'];
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->dataArray['Amount'];
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        $channel = $this->dataArray['Channel'];
        if($channel == 'UssdGate'){
            $channel = Zarinpal::USSD_GATE;
        } else if($channel == 'WebGate'){
            $channel = Zarinpal::WEB_GATE;
        } else if($channel == 'MobileGate'){
            $channel = Zarinpal::MOBILE_GATE;
        } else if($channel == 'ZarinGate'){
            $channel = Zarinpal::ZARIN_GATE;
        }
        return $channel;
    }

    /**
     * @return mixed
     */
    public function getCallbackURL()
    {
        return $this->dataArray['CallbackURL'];
    }

    /**
     * @return mixed
     */
    public function getReferer()
    {
        return $this->dataArray['Referer'];
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->dataArray['Email'];
    }

    /**
     * @return mixed
     */
    public function getCellPhone()
    {
        return $this->dataArray['CellPhone'];
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->dataArray['Date'];
    }

    public function __toString()
    {
        return json_encode($this->dataArray);
    }
}