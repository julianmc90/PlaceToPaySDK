<?php

namespace PlaceToPay\Classes;

/**
 * Class CreditConcept
 *
 * @package PlaceToPay
 */

class CreditConcept
{

/**
 * CreditConcept entityCode
 * Código de la entidad del tercero para dispersión
 */
    private $entityCode;

/**
 * CreditConcept serviceCode
 * Código del servicio del tercero
 */
    private $serviceCode;

/**
 * CreditConcept amountValue
 * Valor total a recaudar a favor de la entidad
 */
    private $amountValue;

/**
 * CreditConcept taxValue
 * Discriminación del impuesto aplicado a favor de la entidad
 */
    private $taxValue;

/**
 * CreditConcept description
 * Descripción el concepto cobrado
 */
    private $description;

/**
 * Instantiates a new CreditConcept Object
 */
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

        $skipProperties = Array();

        foreach ($attrs as $key) {
            
            /**
             * if a key is not set into data
             */
           if(!array_key_exists($key, $data)){


                if(!in_array($key, $skipProperties)){

                    throw new PlaceToPaySDKException($key.' is required for creating a new CreditConcept Object');                    
                }    

           
           }else{


                $setMethod = 'set'.ucfirst($key);

                $this->$setMethod($data[$key]);
           }
       
        }



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
 *Function getEntityCode
 */
    public function getEntityCode()
    {
        return $this->entityCode;
    }

/**
 *Function setEntityCode
 */
    public function setEntityCode($entityCode)
    {
        $this->entityCode = $entityCode;
    }

/**
 *Function getServiceCode
 */
    public function getServiceCode()
    {
        return $this->serviceCode;
    }

/**
 *Function setServiceCode
 */
    public function setServiceCode($serviceCode)
    {
        $this->serviceCode = $serviceCode;
    }

/**
 *Function getAmountValue
 */
    public function getAmountValue()
    {
        return $this->amountValue;
    }

/**
 *Function setAmountValue
 */
    public function setAmountValue($amountValue)
    {
        $this->amountValue = $amountValue;
    }

/**
 *Function getTaxValue
 */
    public function getTaxValue()
    {
        return $this->taxValue;
    }

/**
 *Function setTaxValue
 */
    public function setTaxValue($taxValue)
    {
        $this->taxValue = $taxValue;
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

}
