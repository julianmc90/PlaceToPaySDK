<?php 

namespace PlaceToPay\Classes;

/**
 * Class Bank
 *
 * @package PlaceToPay
 */
	
Class Bank {
 	
 	/**
 	 * Bank code
 	 */
 	private $bankCode;

 	/**
 	 * Bank name
 	 */
 	private $bankName;	

 	 /**
      * Instantiates a new Bank Object
      */
    public function __construct($name, $code){
		
		$this->setName($name);
		$this->setCode($code);

 	}

 	/**
 	 * Function getName
 	 */
 	public function getName(){
 		return $this->name;
 	}

 	/**
 	 * Function setName
 	 */
 	public function setName($name){

 		$this->name = $name;
 	}

 	/**
 	 * Function getCode
 	 */
 	public function getCode(){
 		return $this->code;
 	}

 	/**
 	 * Function setCode
 	 */
 	public function setCode($code){

 		$this->code = $code;
 	}


}	
