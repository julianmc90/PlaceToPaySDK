<?php 

namespace PlaceToPay\Classes;

/**
 * Class Attribute
 *
 * @package PlaceToPay
 */
	
Class Attribute {
 	
 	/**
 	 * Attribute name
 	 */
 	private $name;

 	/**
 	 * Attribute value
 	 */
 	private $value;	

 	 /**
     * Instantiates a new Attribute Object
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

                    throw new PlaceToPaySDKException($key.' is required for creating a new Attribute Object');                    
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
 	 * Function getValue
 	 */
 	public function getValue(){
 		return $this->value;
 	}

 	/**
 	 * Function setValue
 	 */
 	public function setValue($value){

 		$this->value = $value;
 	}

 	

}	
