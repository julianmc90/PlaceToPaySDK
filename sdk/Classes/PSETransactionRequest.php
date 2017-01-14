<?php

namespace PlaceToPay\Classes;

use PlaceToPay\Exceptions\PlaceToPaySDKException;
/**
 * Class PSETransaction
 *
 * @package PlaceToPay
 */

class PSETransactionRequest
{

/**
 * PSETransaction bankCode
 * Código de la entidad financiera con la cual realizar la transacción
 */
    private $bankCode;

/**
 * PSETransaction bankInterface
 * Tipo de interfaz del banco a desplegar [0 = PERSONAS, 1 = EMPRESAS]
 */
    private $bankInterface;

/**
 * PSETransaction returnURL
 * URL de retorno especificada para la entidad financiera
 */
    private $returnURL;

/**
 * PSETransaction reference
 * Referencia única de pago
 */
    private $reference;

/**
 * PSETransaction description
 * Descripción del pago
 */
    private $description;

/**
 * PSETransaction language
 * Idioma esperado para las transacciones acorde a ISO 631-1, mayúscula sostenida
 */
    private $language;

/**
 * PSETransaction currency
 * Moneda a usar para el recaudo acorde a ISO 4217
 */
    private $currency;

/**
 * PSETransaction totalAmount
 * Valor total a recaudar
 */
    private $totalAmount;

/**
 * PSETransaction taxAmount
 * Discriminación del impuesto aplicado
 */
    private $taxAmount;

/**
 * PSETransaction devolutionBase
 * Base de devolución para el impuesto
 */
    private $devolutionBase;

/**
 * PSETransaction tipAmount
 * Propina u otros valores exentos de impuesto (tasa aeroportuaria) y que deben agregarse al valor total a pagar
 */
    private $tipAmount;

/**
 * PSETransaction payer
 * Información del pagador
 */
    private $payer;

/**
 * PSETransaction buyer
 * Información del comprador
 */
    private $buyer;

/**
 * PSETransaction shipping
 * Información del receptor
 */
    private $shipping;

/**
 * PSETransaction ipAddress
 * Dirección IP desde la cual realiza la transacción el pagador
 */
    private $ipAddress;

/**
 * PSETransaction userAgent
 * Agente de navegación utilizado por el pagador
 */
    private $userAgent;

/**
 * PSETransaction additionalData
 * Datos adicionales para ser almacenados con la transacción
 */
    private $additionalData;

/**
 * Instantiates a new PSETransaction Object
 */
    public function validateAndLoad($data)
    {



        /**
         * necessary atributes
         * @var Array
         */
        
        $attrs = $this->getProperties();

        $skipProperties = Array('additionalData','userAgent');

        foreach ($attrs as $key) {
            
            /**
             * if a key is not set into data
             */
           if(!array_key_exists($key, $data)){


                if(!in_array($key, $skipProperties)){

                    throw new PlaceToPaySDKException($key.' is required for creating a new  PSETransactionRequest Object');                    
                }    

           
           }else{


                $setMethod = 'set'.ucfirst($key);

                $this->$setMethod($data[$key]);
           }
       
        }

        /**
         * Setting user agent
         */
        $this->setUserAgent();


    }


    private function getProperties(){

       $reflect = new \ReflectionClass(__CLASS__);
       
       $vars   = $reflect->getProperties();

       $properties = Array();

       foreach ($vars as $privateVar) {
            
            $properties[] = $privateVar->getName();
       }    
    
       return $properties;

    }
    
   /**
    *Function getBankCode
    */
    public function getBankCode()
    {
        return $this->bankCode;
    }

/**
 *Function setBankCode
 */
    public function setBankCode($bankCode)
    {
        $this->bankCode = $bankCode;
    }

/**
 *Function getBankInterface
 */
    public function getBankInterface()
    {
        return $this->bankInterface;
    }

/**
 *Function setBankInterface
 */
    public function setBankInterface($bankInterface)
    {
        $this->bankInterface = $bankInterface;
    }

/**
 *Function getReturnURL
 */
    public function getReturnURL()
    {
        return $this->returnURL;
    }

/**
 *Function setReturnURL
 */
    public function setReturnURL($returnURL)
    {
        $this->returnURL = $returnURL;
    }

/**
 *Function getReference
 */
    public function getReference()
    {
        return $this->reference;
    }

/**
 *Function setReference
 */
    public function setReference($reference)
    {
        $this->reference = $reference;
    }

/**
 *Function getDescription
 */
    public function getDescription()
    {
        return $this->description;
    }

/**
 *Function setDescription
 */
    public function setDescription($description)
    {
        $this->description = $description;
    }

/**
 *Function getLanguage
 */
    public function getLanguage()
    {
        return $this->language;
    }

/**
 *Function setLanguage
 */
    public function setLanguage($language)
    {
        $this->language = $language;
    }

/**
 *Function getCurrency
 */
    public function getCurrency()
    {
        return $this->currency;
    }

/**
 *Function setCurrency
 */
    public function setCurrency($currency)
    {
        $this->currency = $currency;
    }

/**
 *Function getTotalAmount
 */
    public function getTotalAmount()
    {
        return $this->totalAmount;
    }

/**
 *Function setTotalAmount
 */
    public function setTotalAmount($totalAmount)
    {
        $this->totalAmount = $totalAmount;
    }

/**
 *Function getTaxAmount
 */
    public function getTaxAmount()
    {
        return $this->taxAmount;
    }

/**
 *Function setTaxAmount
 */
    public function setTaxAmount($taxAmount)
    {
        $this->taxAmount = $taxAmount;
    }

/**
 *Function getDevolutionBase
 */
    public function getDevolutionBase()
    {
        return $this->devolutionBase;
    }

/**
 *Function setDevolutionBase
 */
    public function setDevolutionBase($devolutionBase)
    {
        $this->devolutionBase = $devolutionBase;
    }

/**
 *Function getTipAmount
 */
    public function getTipAmount()
    {
        return $this->tipAmount;
    }

/**
 *Function setTipAmount
 */
    public function setTipAmount($tipAmount)
    {
        $this->tipAmount = $tipAmount;
    }

/**
 *Function getPayer
 */
    public function getPayer()
    {
        return $this->payer;
    }

/**
 *Function setPayer
 */
    public function setPayer($payer)
    {
        $this->payer = $payer;
    }

/**
 *Function getBuyer
 */
    public function getBuyer()
    {
        return $this->buyer;
    }

/**
 *Function setBuyer
 */
    public function setBuyer($buyer)
    {
        $this->buyer = $buyer;
    }

/**
 *Function getShipping
 */
    public function getShipping()
    {
        return $this->shipping;
    }

/**
 *Function setShipping
 */
    public function setShipping($shipping)
    {
        $this->shipping = $shipping;
    }

/**
 *Function getIpAddress
 */
    public function getIpAddress()
    {
        return $this->ipAddress;
    }

/**
 *Function setIpAddress
 */
    public function setIpAddress($ipAddress)
    {
        $this->ipAddress = $ipAddress;
    }

/**
 *Function getUserAgent
 */
    public function getUserAgent()
    {
        return $this->userAgent;
    }

/**
 *Function setUserAgent
 */
    public function setUserAgent()
    {
        $this->userAgent = $_SERVER['HTTP_USER_AGENT'];
    }

/**
 *Function getAdditionalData
 */
    public function getAdditionalData()
    {
        return $this->additionalData;
    }

/**
 *Function setAdditionalData
 */
    public function setAdditionalData($additionalData)
    {
        $this->additionalData = $additionalData;
    }

}
