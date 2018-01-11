<?php
namespace IranPayment;
use nusoap_client;
use SoapClient;

class Client
{
    private $client;

    public function __construct($url)
    {
        if (class_exists("SoapClient")) {
            $this->client = new \SoapClient($url, ['encoding' => 'UTF-8']);
        } else {
            $this->client = new nusoap_client($url, 'wsdl');
            $this->client->soap_defencoding = 'UTF-8';
            $this->client->decode_utf8 = FALSE;
        }
    }

    public function call($method, $args)
    {
        if ($this->client instanceof SoapClient) {
            return $this->client->$method($args);
        } else if ($this->client instanceof nusoap_client) {
            return (object) $this->client->call($method, $args);
        }
        return false;
    }
}