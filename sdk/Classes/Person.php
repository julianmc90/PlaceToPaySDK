<?php

namespace PlaceToPay\Classes;
use PlaceToPay\Exceptions\PlaceToPaySDKException;

/**
 * Class Person
 *
 * @package PlaceToPay
 */

class Person
{

/**
 * Person document
 * Número de identificación de la persona
 */
    private $document;

/**
 * Person documentType
 * Tipo de documento de identificación de la persona [CC, CE, TI, PPN]. CC = Cédula de ciudanía colombiana CE = Cédula de extranjería TI = Tarjeta de identidad PPN = Pasaport NIT = Número de identificación tributaria SSN = Social Security Number
 */
    private $documentType;

/**
 * Person firstName
 * Nombres
 */
    private $firstName;

/**
 * Person lastName
 * Apellidos
 */
    private $lastName;

/**
 * Person company
 * Nombre de la compañía en la cual labora o representa
 */
    private $company;

/**
 * Person emailAddress
 * Correo electrónico
 */
    private $emailAddress;

/**
 * Person address
 * Dirección postal completa
 */
    private $address;

/**
 * Person city
 * Nombre de la ciudad coincidente con la dirección
 */
    private $city;

/**
 * Person province
 * Nombre de la provincia o departamento coincidente con la dirección
 */
    private $province;

/**
 * Person country
 * Código internacional del país que aplica a la dirección física acorde a ISO 3166-1, mayúscula sostenida.
 */
    private $country;

/**
 * Person phone
 * Número de telefonía fija
 */
    private $phone;

/**
 * Person mobile
 * Número de telefonía móvil o celular
 */
    private $mobile;

    /**
     * Instantiates a new Person Object, validates person data, if all is set returns true, instead throws an exception
     * @throws PlaceToPaySDKException Exception
     * @param  Array $data array of person data with key value format 
     * @return Boolean false
     */
    public function validateAndLoad($data, $type)
    {

        /**
         * necessary atributes
         * @var Array
         */
        
        $attrs = $this->getProperties();

        foreach ($attrs as $key) {
           
           if(!array_key_exists($key, $data)){

             throw new PlaceToPaySDKException($key.' is required for creating a new '.$type.' Person Object');
           
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
 *Function getDocument
 */
    public function getDocument()
    {
        return $this->document;
    }

/**
 *Function setDocument
 */
    public function setDocument($document)
    {
        $this->document = $document;
    }

/**
 *Function getDocumentType
 */
    public function getDocumentType()
    {
        return $this->documentType;
    }

/**
 *Function setDocumentType
 */
    public function setDocumentType($documentType)
    {
        $this->documentType = $documentType;
    }

/**
 *Function getFirstName
 */
    public function getFirstName()
    {
        return $this->firstName;
    }

/**
 *Function setFirstName
 */
    public function setFirstName($firstName)
    {
        $this->firstName = $firstName;
    }

/**
 *Function getLastName
 */
    public function getLastName()
    {
        return $this->lastName;
    }

/**
 *Function setLastName
 */
    public function setLastName($lastName)
    {
        $this->lastName = $lastName;
    }

/**
 *Function getCompany
 */
    public function getCompany()
    {
        return $this->company;
    }

/**
 *Function setCompany
 */
    public function setCompany($company)
    {
        $this->company = $company;
    }

/**
 *Function getEmailAddress
 */
    public function getEmailAddress()
    {
        return $this->emailAddress;
    }

/**
 *Function setEmailAddress
 */
    public function setEmailAddress($emailAddress)
    {
        $this->emailAddress = $emailAddress;
    }

/**
 *Function getAddress
 */
    public function getAddress()
    {
        return $this->address;
    }

/**
 *Function setAddress
 */
    public function setAddress($address)
    {
        $this->address = $address;
    }

/**
 *Function getCity
 */
    public function getCity()
    {
        return $this->city;
    }

/**
 *Function setCity
 */
    public function setCity($city)
    {
        $this->city = $city;
    }

/**
 *Function getProvince
 */
    public function getProvince()
    {
        return $this->province;
    }

/**
 *Function setProvince
 */
    public function setProvince($province)
    {
        $this->province = $province;
    }

/**
 *Function getCountry
 */
    public function getCountry()
    {
        return $this->country;
    }

/**
 *Function setCountry
 */
    public function setCountry($country)
    {
        $this->country = $country;
    }

/**
 *Function getPhone
 */
    public function getPhone()
    {
        return $this->phone;
    }

/**
 *Function setPhone
 */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

/**
 *Function getMobile
 */
    public function getMobile()
    {
        return $this->mobile;
    }

/**
 *Function setMobile
 */
    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
    }

}
