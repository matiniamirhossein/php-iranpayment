<?php
namespace Zarinpal;
class ZarinpalResponse
{
    private $success;
    private $status;
    private $refId;
    public function __construct($zarinpalResult)
    {
        $this->success = $zarinpalResult->Status == 100;
        $this->status = $zarinpalResult->Status;
        if(isset($zarinpalResult->RefID)){
            $this->refId = $zarinpalResult->RefID;
        }
    }
    public function success(){
        return $this->success == true;
    }
    public function getStatus(){
        return $this->status;
    }
    public function getRefId(){
        return $this->refId;
    }
}