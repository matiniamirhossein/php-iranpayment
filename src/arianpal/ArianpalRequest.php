<?php

namespace IranPayment\Arianpal;
class ArianpalRequest
{
    private $Amount;
    private $Description;
    private $Email;
    private $Mobile;
    private $CallbackURL;
    private $ResNumber;
    private $Paymenter;

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->Amount;
    }

    /**
     * @param mixed $Amount
     * @return ArianpalRequest
     */
    public function setAmount($Amount)
    {
        $this->Amount = $Amount;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->Description;
    }

    /**
     * @param mixed $Description
     * @return ArianpalRequest
     */
    public function setDescription($Description)
    {
        $this->Description = $Description;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->Email;
    }

    /**
     * @param mixed $Email
     * @return ArianpalRequest
     */
    public function setEmail($Email)
    {
        $this->Email = $Email;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getMobile()
    {
        return $this->Mobile;
    }

    /**
     * @param mixed $Mobile
     * @return ArianpalRequest
     */
    public function setMobile($Mobile)
    {
        $this->Mobile = $Mobile;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getCallbackURL()
    {
        return $this->CallbackURL;
    }

    /**
     * @param mixed $CallbackURL
     * @return ArianpalRequest
     */
    public function setCallbackURL($CallbackURL)
    {
        $this->CallbackURL = $CallbackURL;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getResNumber()
    {
        return $this->ResNumber;
    }

    /**
     * @param mixed $ResNumber
     * @return ArianpalRequest
     */
    public function setResNumber($ResNumber)
    {
        $this->ResNumber = $ResNumber;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPaymenter()
    {
        return $this->Paymenter;
    }

    /**
     * @param mixed $Paymenter
     * @return ArianpalRequest
     */
    public function setPaymenter($Paymenter)
    {
        $this->Paymenter = $Paymenter;
        return $this;
    }
}