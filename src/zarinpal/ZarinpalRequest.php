<?php
namespace IranPayment\Zarinpal;
class ZarinpalRequest
{
    private $Amount;
    private $Description;
    private $Email;
    private $Mobile;
    private $CallbackURL;

    public function getAmount()
    {
        return $this->Amount;
    }

    public function setAmount($amount)
    {
        $this->Amount = $amount;
        return $this;
    }

    public function getDescription()
    {
        return $this->Description;
    }

    public function setDescription($description)
    {
        $this->Description = $description;
        return $this;
    }

    public function getEmail()
    {
        return $this->Email;
    }

    public function setEmail($email)
    {
        $this->Email = $email;
        return $this;
    }

    public function getMobile()
    {
        return $this->Mobile;
    }

    public function setMobile($mobile)
    {
        $this->Mobile = $mobile;
        return $this;
    }

    public function getCallbackUrl()
    {
        return $this->CallbackURL;
    }

    public function setCallbackUrl($url)
    {
        $this->CallbackURL = $url;
        return $this;
    }
}