<?php

namespace MCSDK\Authentication;


use MCSDK\Discovery\DiscoveryResponse;
use MCSDK\Discovery\OperatorUrls;

class FakeDiscoveryOptions
{
    private $_operatorUrls;
    private $_clientId;
    private $_clientSecret;
    private $_clientName;
    private $_subId;
    private $_providerMetadata;

    public function __construct()
    {
    }

    /**
     * @return OperatorUrls
     */
    public function getOperatorUrls()
    {
        return $this->_operatorUrls;
    }

    /**
     * @param OperatorUrls $operatorUrls
     */
    public function setOperatorUrls($operatorUrls)
    {
        $this->_operatorUrls = $operatorUrls;
    }

    /**
     * @return mixed
     */
    public function getClientId()
    {
        return $this->_clientId;
    }

    /**
     * @param mixed $clientId
     */
    public function setClientId($clientId)
    {
        $this->_clientId = $clientId;
    }

    /**
     * @return mixed
     */
    public function getClientSecret()
    {
        return $this->_clientSecret;
    }

    /**
     * @param mixed $clientSecret
     */
    public function setClientSecret($clientSecret)
    {
        $this->_clientSecret = $clientSecret;
    }

    /**
     * @return mixed
     */
    public function getClientName()
    {
        return $this->_clientName;
    }

    /**
     * @param mixed $clientName
     */
    public function setClientName($clientName)
    {
        $this->_clientName = $clientName;
    }

    /**
     * @param mixed $subId
     */
    public function setSubId($subId)
    {
        $this->_subId = $subId;
    }

    /**
     * @return mixed
     */
    public function getProviderMetadata()
    {
        return $this->_providerMetadata;
    }

    /**
     * @param mixed $providerMetadata
     */
    public function setProviderMetadata($providerMetadata): void
    {
        $this->_providerMetadata = $providerMetadata;
    }


    public function fromDiscoveryResponse(DiscoveryResponse $discoveryResponse){
        $this->setProviderMetadata($discoveryResponse->getProviderMetadata());
        $this->_operatorUrls = $discoveryResponse->getOperatorUrls();
        $this->setSubId($discoveryResponse->getResponseData()['subscriber_id']);
        $this->setClientId($discoveryResponse->getResponseData()['response']['client_id']);
        $this->setClientSecret($discoveryResponse->getResponseData()['response']['client_secret']);
        return $this;
    }

    public function getJson(){
        $json = "{
	        \"response\": {
		    \"apis\": {
			    \"operatorid\": {
				    %s
			    }
		    },
		    \"client_secret\": \"%s\",
		    \"client_id\": \"%s\",
		    \"provider_metadata\": %s
	        },
	    \"subscriber_id\": \"%s\"
        }";

        return sprintf($json, $this->_operatorUrls->getJson(), $this->_clientSecret, $this->_clientId, json_encode($this->_providerMetadata), $this->_subId);
    }


}