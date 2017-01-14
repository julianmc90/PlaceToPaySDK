<?php 

namespace PlaceToPay\Auth;

/**
 * Class Authentication
 *
 * @package PlaceToPay
 */

Class Authentication {
 		
	/**
	 * Api login String
	 */
	private $login;

	/**
	 * seed
	 */
	private $seed;

	/**
	 * Transactional Key
	 */
	private $tranKey; 

	/**
	 * Array of Atributes
	 */
	private $arrayOfAttribute;


 	 /**
     * Instantiates a new Autentication Object
     *
     * @throws PlaceToPaySDKException
     */
    public function __construct($login, $tranKey, $arrayOfAttribute = null){
			
 			$this->setLogin($login);
			$this->setSeed(); 
 			$this->setTranKey($tranKey);
 			$this->setArrayOfAttribute($arrayOfAttribute);
 	}

 	/**
 	 * Function setLogin 
 	 */
 	public function setLogin($login){

 		$this->login = $login;

 	}


 	/**
 	 * Function getLogin 
 	 */
 	public function getLogin(){

 		return $this->login;
 	}

 	/**
 	 * Function setSeed 
 	 */
 	public function setSeed(){

 		$this->seed = date('c');

 	}

 	/**
 	 * Function getSeed 
 	 */
 	public function getSeed(){

 		return $this->seed;
 	}

 	/**
 	 * Function setTranKey 
 	 */
 	public function setTranKey($tranKey){

 		$this->tranKey = sha1($this->getSeed() . $tranKey, false);

 	}

 	/**
 	 * Function getTranKey 
 	 */
 	public function getTranKey(){

 		return $this->tranKey;
 	}

 	/**
 	 * Function setArrayOfAttribute 
 	 */
  	public function setArrayOfAttribute($arrayOfAttribute){

 		$this->arrayOfAttribute = $arrayOfAttribute;

 	}

 	/**
 	 * Function getArrayOfAttribute 
 	 */
 	public function getArrayOfAttribute(){

 		return $this->arrayOfAttribute;
 	}
}


