<?php

namespace PlaceToPay;

use PlaceToPay\Auth\Authentication;
use PlaceToPay\Exceptions\PlaceToPaySDKException;
use PlaceToPay\Classes\Bank;
use PlaceToPay\Classes\Attribute;
use PlaceToPay\Classes\Person;
use PlaceToPay\Classes\PSETransactionRequest;
use PlaceToPay\Classes\PSETransactionMultiCreditRequest; 
use PlaceToPay\Classes\PSETransactionResponse; 
use PlaceToPay\Classes\TransactionInformation;
use PlaceToPay\Classes\CreditConcept;



/**
 * class PlaceToPay
 */
class PlaceToPay{

    /**
     * Confuguration Array
     * @var Array
     */
    private $config;

    /**
     * Authentication Object
     */
    private $auth;

    /**
     * SoapClient Object
     */
    private $webService;

    /**
     * PSETransactionRequest Object
     * @var [type]
     */
    private $pseTransactionRequest;


    /**
     * PSETransactionMultiCreditRequest Object
     * @var [type]
     */
    private $pseTransactionMultiCreditRequest;


    /**
     * PSETransactionResponse Object
     * @var [type]
     */
    private $pseTransactionResponse;


    /**
     * TransactionInformation Object
     * @var [type]
     */
    private $transactionInformation;

    /**
     * Person payer
     * @var Person
     */
    private $payer;

    /**
     * Person buyer
     * @var Person
     */
    private $buyer;

    /**
     * Person shipping
     * @var Person
     */
    private $shipping;
    


    /**
     * Instantiates a new Autentication Object
     *
     * @param array $config
     *
     * @throws PlaceToPaySDKException
     */
    public function __construct($config = []){
        
        /**
         * config values, they could be defined here but this is not recommend
         */
        $config = array_merge(
            array(
                /**
                 * wsdl service url
                 */
                'wsdl'      => '',
                
                /**
                 * Api login
                 */
                'login'     => '',
                
                /**
                 *Transactional Key
                 */
                'tranKey'   => '',

                /**
                 * Default Timezone
                 */

                'timeZone' => 'America/Bogota'

        ), $config);

        /**
         * validating configuration
         */
        $this->validateConfig($config);
    

        /**
         * Seting config
         * @var Array
         */
        $this->config = $config;


        /**
         * Set Default TimeZone
         */
        $this->setDefaultTimeZone();

        /**
         *Creating new Authentication object, required for all operations
         */
        $this->setAuth(new Authentication($config['login'], $config['tranKey']));



    }




    /**
     * Function getBankList
     * this connects to memchache to store the bankList each day and get it from cache
     * @return Banks[] [ArrayList of banks]
     */
    public function getBankList(){

        /**
         * connecting to memcache server 
         * @var Memcache
         */
        $memcache = new \Memcache;
        $memcache->connect('localhost', 11211) or die ("Could not connect");

        $storedDate = $memcache->get('storedDate');

 
        /**
         * if there is no stored date
         * @var String
         */
        if($storedDate == null){

            $storedDate = Date('Y-m-d');

            $memcache->set('storedDate', $date, false) or die ("Failed to save data at the server");
       
        }

        /**
         * logic to know the change of day to store the banks in cache 
         */
        $storedDate = new \DateTime($storedDate);

        $actualDate = new \DateTime();

        $difference = $storedDate->diff($actualDate);



        /**
         * If the difference is greater or equal to 1
         */
        if($difference->d >= 1){


            /**
             * setting up the Soap Web Service
             */
            $this->setWebService($this->config['wsdl']);

            /**
             * setting up parameters
             * @var array
             */
            $params = array(
                'auth' => $this->getAuth()
            );

            /**
             * getting the bankList from webservice
             * @var BankListResult
             */
            $bankListResult = $this->getWebService()->getBankList($params)->getBankListResult;

            /**
             * Creating Array of banks from response
             */

            $banks =  Array();

            foreach ($bankListResult->item as $bank) {

                $banks[] = new Bank($bank->bankName, $bank->bankCode);
            }


            /**
             * Storing data in cache
             */
            
            /**
             * Dctual date
             * @var String
             */
            $date = Date('Y-m-d');

            /**
             * storing actual Date
             */
            $memcache->set('storedDate', $date, false) or die ("Failed to save storedDate at the server");

            /**
             * Storing banks object
             */
            $memcache->set('banks', $banks, false) or die ("Failed to save banks at the server");

            /**
             * returning banks 
             */
            return $banks;

        }

        /**
         * returning bankilist from cache
         */
        if($difference->d == 0){

            return $memcache->get('banks');
            
        }



    }
    
    /**
     * Function that creates a transaction and returns its response
     * @return PSETransactionResponse 
     */
    public function createTransaction()
    {

        /**
         * setting up the Soap Web Service
         */
        $this->setWebService($this->config['wsdl']);        

        /**
         * setting up parameters
         * @var array
         */
        $params = array(
            'auth'          => $this->getAuth(),
            'transaction'   => $this->getPseTransactionRequest()
        );

        /**
         * Calling createTransaction from webservice
         * @var [type]
         */
        $transactionResult = $this->getWebService()->createTransaction($params)->createTransactionResult;

        /**
         * setting pseTransactionResponse
         */
        $this->setPseTransactionResponse($transactionResult);

        return $this->getPseTransactionResponse();
    }

    /**
     * Function that creates a transaction multicredit 
     * @return PSETransactionInformation   object with the transacion information
     */
    public function createTransactionMultiCredit()
    {

        /**
         * setting up the Soap Web Service
         */
        $this->setWebService($this->config['wsdl']);        

        /**
         * setting up parameters
         * @var array
         */
        $params = array(
            'auth'          => $this->getAuth(),
            'transaction'   => $this->getPseTransactionMultiCreditRequest()
        );

        /**
         * calling the getTransactionInfromation function from webservice
         * @var TransacionInformationResult
         */
        $transactionResult = $this->getWebService()->createTransactionMultiCredit($params)->createTransactionResult;

        /**
         * setting the TransactionResponseObject
         */
        $this->setPseTransactionResponse($transactionResult);

        return $this->getPseTransactionResponse();
    }


    /**
     * Funcion that gets transaction information from webservice
     * @param  Int $transactionID transaction identifier
     * @return PSETransactionInformation   object with the transacion information
     */
    public function getTransactionInformation($transactionID = null){

        /**
         * if transactionId is null will return transactionInformation, if it is null too, will
         * return the null variable value, otherwise the transaction informacion created object
         */
        if($transactionID == null){

            return $this->transactionInformation;

        }else{

            /**
             * setting up the Soap Web Service
             */
            $this->setWebService($this->config['wsdl']);        

            /**
             * setting up parameters
             * @var array
             */
            $params = array(
                'auth'          => $this->getAuth(),
                'transactionID'   => $transactionID
            );

            /**
             * calling the getTransactionInfromation function from webservice
             * @var TransacionInformationResult
             */
            $transactionInformationResult = $this->getWebService()->getTransactionInformation($params)->getTransactionInformationResult;

            /**
             * setting the TransactionResponseObject
             */
            $this->setTransactionInformation($transactionInformationResult);

            return $this->transactionInformation;
        }

    }

    /**
     * Function that gets the webservice 
     * @return SoapClient webservice
     */
    public function getWebService(){

        return $this->webService;
    }


    /**
     * Function setWebService
     * @param String $wsdl service url
     */
    public function setWebService($wsdl){
        
        try {
            
            $this->webService = new \SoapClient($wsdl,['trace'=>true]);

        } catch (SoapFault $e) {
            
            echo "There is an error with the webservice connection, check first if existe soap support on your webserver.";

            var_dump($e);
            
        }
        

    }

    /**
     * function to get webservice functions
     * @return Array description of functions
     */
    public function getServiceFunctions(){

        /**
         * setting up the Soap Web Service
         */
        $this->setWebService($this->config['wsdl']);        

        return $this->getWebService()->__getFunctions();

    }

    /**
     * function that get the service types fromwebservice
     * @return Array types used by function of the webservice
     */
    public function getServiceTypes(){

        /**
         * setting up the Soap Web Service
         */
        $this->setWebService($this->config['wsdl']);        


        return $this->getWebService()->__getTypes();
    }



    /**
     * Function that validates the configuration input information
     * @throws PlaceToPaySDKException exception with error information
     */
    public function validateConfig($config){

        /**
         * is exists and is not empty wsld
         */
        if (empty($config['wsdl'])) {
            throw new PlaceToPaySDKException('Wsdl is required');
        }
        /**
         * is exists and is not empty login
         */
        if (empty($config['login'])) {
            throw new PlaceToPaySDKException('Login is required');
        }

        /**
         * is exists and is not empty transactional key
         */
        if (empty($config['tranKey'])) {
            throw new PlaceToPaySDKException('tranKey is required');
        }



    }

    /**
     * Function getAuth
     */
    public function getAuth(){
      return $this->auth;
    }

    /**
     * Function setAuth
     */
    public function setAuth($auth){
        $this->auth = $auth;
    }

    /**
     * setting the trasnaction information object
     * @param [transactionInformationResult] $transactionInformationResult 
     */
    public function setTransactionInformation($transactionInformationResult){

        $this->transactionInformation = new TransactionInformation(
                $transactionInformationResult->transactionID, 
                $transactionInformationResult->sessionID, 
                $transactionInformationResult->reference, 
                $transactionInformationResult->requestDate, 
                $transactionInformationResult->bankProcessDate, 
                $transactionInformationResult->onTest, 
                $transactionInformationResult->returnCode, 
                $transactionInformationResult->trazabilityCode, 
                $transactionInformationResult->transactionCycle, 
                $transactionInformationResult->transactionState, 
                $transactionInformationResult->responseCode, 
                $transactionInformationResult->responseReasonCode, 
                $transactionInformationResult->responseReasonText
           );
    }


   /**
     * Function getPseTransactionResponse
     */
    public function getPseTransactionResponse(){
        return $this->pseTransactionResponse;
    }

   /**
     * Function that sets the PseTransactionResponse
     * @param TransactionResult $[transactionResult] [TrasactionResult object]
     */
    public function setPseTransactionResponse($transactionResult){

         $this->pseTransactionResponse  = new PSETransactionResponse(
                $transactionResult->transactionID, 
                $transactionResult->sessionID, 
                $transactionResult->returnCode, 
                $transactionResult->trazabilityCode, 
                $transactionResult->transactionCycle, 
                $transactionResult->bankCurrency, 
                $transactionResult->bankFactor, 
                $transactionResult->bankURL, 
                $transactionResult->responseCode, 
                $transactionResult->responseReasonCode, 
                $transactionResult->responseReasonText
            );
    }


    /**
     * Function getPseTransactionRequest
     */
    public function getPseTransactionRequest(){
        return $this->pseTransactionRequest;
    }

    /**
     * Function setPseTransactionRequest
     * validates all the related information and if something is missing throws an exception
     * @param Array $[name] array of attributes nedded
     * @throws PlaceToPaySDKException [exception]
     */
    public function setPseTransactionRequest($attrs){

        /**
         * Validating additional informatión
         */

        $additionalDataArray = $this->getAdditionalDataArrayObjects($attrs['additionalData']);


        /**
         * Validating and setting up the payer Person Object
         */
        $this->setPayer($attrs['payer']); 
        
        /**
         * Validating and setting up the buyer Person Object
         */ 
         $this->setBuyer($attrs['buyer']);    

        /**
         * Validating and setting Shipping Person Object
         */
        $this->setShipping($attrs['shipping']);    

        /**
         * setting additional Data
         */
        $attrs['additionalData'] = $additionalDataArray;

        /**
         * setting payer
         */
        $attrs['payer'] = $this->getPayer();

        /**
         * setting buyer
         */
        $attrs['buyer'] = $this->getBuyer();

        /**
         * setting shipping
         */
        $attrs['shipping'] = $this->getShipping();


        /**
         * setting ip address
         */
        $attrs['ipAddress'] = $this->getClientIp();

        /**
         * calidating and setting the reansaction RequestS
         */
        $this->validateSetTransactionRequest($attrs);

    
    }


    /**
     * validating and setting the trasnsaction request
     * @throws PlaceToPaySDKException throws exception if there is a validation error
     * @param  Array $attrs [attributes needed]
     */
    public function validateSetTransactionRequest($attrs){

         $this->pseTransactionRequest = new PSETransactionRequest();

         $this->pseTransactionRequest->validateAndLoad($attrs);

    }




    /**
     * Function getTransactionMultiCreditRequest
     */
    public function getPseTransactionMultiCreditRequest(){
        return $this->pseTransactionMultiCreditRequest;
    }

    /**
     * Function setPseTransactionMultiCreditRequest
     */
    public function setPseTransactionMultiCreditRequest($attrs){

       /**
         * Validating additional informatión
         */

        $additionalDataArray = $this->getAdditionalDataArrayObjects($attrs['additionalData']);


        /**
         * Validating and setting up the payer Person Object
         */
        $this->setPayer($attrs['payer']); 
        
        /**
         * Validating and setting up the buyer Person Object
         */ 
         $this->setBuyer($attrs['buyer']);    

        /**
         * Validating and setting Shipping Person Object
         */
        $this->setShipping($attrs['shipping']);    


        /**
         * setting additional Data
         */
        $attrs['additionalData'] = $additionalDataArray;

        /**
         * setting payer
         */
        $attrs['payer'] = $this->getPayer();

        /**
         * setting buyer
         */
        $attrs['buyer'] = $this->getBuyer();

        /**
         * setting shipping
         */
        $attrs['shipping'] = $this->getShipping();


        /**
         * setting ip address
         */
        $attrs['ipAddress'] = $this->getClientIp();


        /**
         * validating and setting credits
         */
        $attrs['credits'] = $this->validateSetCreditConcepts($attrs['credits']);

        $this->validateGetTransactionMultiCreditRequest($attrs);


    }

    /**
     * Function thata validates and set the credit concepts array
     * @param  Array  $creditConcepts credit concepts
     * @param  boolean $arrayOrObjects if need to be returned and array ob objects or an array of key values
     * @return Array  credit concepts
     */
    public function validateSetCreditConcepts($creditConcepts, $arrayOrObjects = false){


        $creditConceptsResult = Array();

        foreach ($creditConcepts as $credit) {
                
            $creditConcept = new CreditConcept();    
           
            $creditConcept->validateAndLoad($credit);    
           
            $creditConceptsResult[]  = $creditConcept; 

        }
        
        /**
         * if is needed array of objects, else : array of values
         */
        if($arrayOrObjects){

            return $creditConceptsResult;
           

        }else{

            return $creditConcepts;

        }    

    }

    /**
     * validating and setting the trasnsaction multicredit request
     * @throws PlaceToPaySDKException throws exception if there is a validation error
     * @param  Array $attrs [attributes needed]
     */
    public function validateGetTransactionMultiCreditRequest($attrs){

         $this->pseTransactionMultiCreditRequest = new pseTransactionMultiCreditRequest();

         $this->pseTransactionMultiCreditRequest->validateAndLoad($attrs);


    }


    /**
     * Function getPayer
     * @return Person payer
     */
    public function getPayer(){

        return $this->payer;

    }

    /**
     * Function that validates and sets the payer person object
     * @param Array $payerData attributes needed
     */
    public function setPayer($payerData){

        $this->payer = $this->validateGetPerson($payerData,'Payer');

    }

    /**
     * Function getBuyer
     * @return Person buyer
     */
    public function getBuyer(){

        return $this->buyer;

    }

    /**
     * Function that validates and sets the buyer person object
     * @param Array $buyerData attributes needed
     */
    public function setBuyer($buyerData){

        $this->buyer = $this->validateGetPerson($buyerData,'Buyer');

    }

    /**
     * Function getShipping
     * @return Person shipping
     */
    public function getShipping(){
        
        return $this->shipping;

    }

    /**
     * Function that validates and sets the shipping person object
     * @param Array $buyerData attributes needed
     */
    public function setShipping($shippingData){

        $this->shipping = $this->validateGetPerson($shippingData,'Shipping');

    }

    /**
     * Validate and get a person object needed
     * @param  Array $personData attributes needed
     * @return Person             person object
     */
    public function validateGetPerson($personData,$type){

        $person = new Person();
        $person->validateAndLoad($personData, $type);
        return $person;

    }

    /**
     * Function that validates the additional informatión
     * @throws PlaceToPaySDKException when a key of the additional information is missing]
     * @param  Array  $additionalDataArray array of additiona information
     * @param  boolean $arrayOrObjects      true to return an array of key values or an array ob objects, usefull for more develpment needs
     * @return Array                       additional information array of objects or array of key values
     */
    public function getAdditionalDataArrayObjects($additionalDataArray, $arrayOrObjects = false){
        

        /**
         * Creating the aditional information array objects
         */

         $additionalArrayDataResult = Array();

        foreach ($additionalDataArray as $additionalData) {
                
            $attribute = new Attribute();    
           
            $attribute->validateAndLoad($additionalData);    
           
            $additionalArrayDataResult[]  = $attribute; 

        }
        
        /**
         * If an Array of key values is needed
         */
        if($arrayOrObjects){

            return $additionalArrayDataResult;

        }else{

            return $additionalDataArray;

        }    

    }

    /**
     * Function That sets the default time zone
     */
    public function setDefaultTimeZone(){

        date_default_timezone_set($this->config['timeZone']);
    }


    /**
     * Function to get the client IP address
     * @return String ip address from client
     */
    public function getClientIp() {
        
        $ipaddress = '';
        if (isset($_SERVER['HTTP_CLIENT_IP']))
            $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
        else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_X_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
        else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
            $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
        else if(isset($_SERVER['HTTP_FORWARDED']))
            $ipaddress = $_SERVER['HTTP_FORWARDED'];
        else if(isset($_SERVER['REMOTE_ADDR']))
            $ipaddress = $_SERVER['REMOTE_ADDR'];
        else
            $ipaddress = 'UNKNOWN';
        return $ipaddress;
    }

}

