<?php
namespace IranPayment\Zarinpal\Types;
use IranPayment\Zarinpal\Zarinpal;

class Authority
{
    private $Authority;
    private $Amount;
    private $Channel;
    private $CallbackURL;
    private $Referer;
    private $Email;
    private $CellPhone;
    private $Date;

    public function __construct($dataArray)
    {
        $this->Authority = (int) $dataArray['Authority'];
        $this->Amount = (int) $dataArray['Amount'];
        $this->Channel = $dataArray['Channel'];
        if($this->Channel == 'UssdGate'){
            $this->Channel = Zarinpal::USSD_GATE;
        } else if($this->Channel == 'WebGate'){
            $this->Channel = Zarinpal::WEB_GATE;
        } else if($this->Channel == 'MobileGate'){
            $this->Channel = Zarinpal::MOBILE_GATE;
        } else if($this->Channel == 'ZarinGate'){
            $this->Channel = Zarinpal::ZARIN_GATE;
        }
        $this->CallbackURL = $dataArray['CallbackURL'];
        $this->Referer = $dataArray['Referer'];
        $this->Email = $dataArray['Email'];
        $this->CellPhone = $dataArray['CellPhone'];
        $this->Date = $dataArray['Date'];
    }

    /**
     * @return mixed
     */
    public function getAuthority()
    {
        return $this->Authority;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->Amount;
    }

    /**
     * @return mixed
     */
    public function getChannel()
    {
        return $this->Channel;
    }

    /**
     * @return mixed
     */
    public function getCallbackURL()
    {
        return $this->CallbackURL;
    }

    /**
     * @return mixed
     */
    public function getReferer()
    {
        return $this->Referer;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @return mixed
     */
    public function getCellPhone()
    {
        return $this->CellPhone;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->Date;
    }
}