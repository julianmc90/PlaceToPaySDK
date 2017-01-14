# PlaceToPaySDK
PlaceToPaySDK For PHP


## Requirements

* ext-soap
* memcached

## Installation


Require this autoload

```php
require_once __DIR__ . '/place-to-pay-sdk/vendor/autoload.php';

use PlaceToPay\PlaceToPay;
```

```php
/**
 * Setting PlaceToPay Object 
 * @var PlaceToPay
 */
$placeToPay =  new PlaceToPay([
        /**
         * Web service Url
         */
		'wsdl'   => 'https://test.placetopay.com/soap/pse/?wsdl',
		
        /**
         * Login 
         */
        'login'  => '6dd490faf9cb87a9862245da41170ff2',
		
        /**
         * Transactional Key
         */
        'tranKey'=> '024h1IlD',

        /**
         * Timezone (Optional) defaults to America/Bogota
         */
        //'timeZone'
	]);

```


## Getting Bank List

To get the bank list use 

```php
$placeToPay->getBankList();
```

## Setting up a PSE Transaction Request

```php
/**
 * payer, buyer and shipping follows the next format
 * @var Array
 */
$payer = Array(
        'document'     => '',
        'documentType' => '',
        'firstName'    => '',
        'lastName'     => '',
        'company'      => '',
        'emailAddress' => '',
        'address'      => '',
        'city'         => '',
        'province'     => '',
        'country'      => '',
        'phone'        => '',
        'mobile'       => ''
);
```

Additional data

```php
/**
 * Additional data follows the next format
 * @var array
 */
$additionalData = Array();

/**
 * could be added more indexes to fit your needs
 */
$additionalData[] = ['name'=>'', 'value'=>''];
```

The transaction request need the following information

```php
/**
 * To set the Transaction request
 * follow this format 
 */
$placeToPay->setPseTransactionRequest([
	        'bankCode'		=> '', 
	        'bankInterface'	=> '', 
	        'returnURL'		=> '', 
	        'reference'		=> '', 
	        'description'	=> '', 
	        'language'		=> '', 
	        'currency'		=> '', 
	        'totalAmount'	=> 0, 
	        'taxAmount'		=> 0,  
	        'devolutionBase'=> 0, 
	        'tipAmount'		=> 0, 
	        'payer'			=> $payer,
	        'buyer'			=> $buyer,
	        'shipping'		=> $shipping,
	        'additionalData'=> $additionalData
        ]);

```

Create and send the transaction
```php
$placeToPay->createTransaction();

// Get transaction information

/**
 * needs a transaction identifier
 * @type {Number}
 */
$identifier = 1234;

$placeToPay->getTransactionInformation($identifier);
``` 

## Setting up a PSE Transaction MultiCredit Request

Needs Credits to be setup
```php
/**
 * Credits follows the next format
 * @var array
 */
$credits = [];

/**
 * could be added more indexes to fit your needs
 */
$credits[] = [
    'entityCode' 	=>'',
    'serviceCode' 	=>'',
    'amountValue' 	=>0,
    'taxValue' 		=> 0,
    'description' 	=>''
];

``` 
The transaction multicredit request needs the following information

```php 
$placeToPay->setPseTransactionMultiCreditRequest([
         'bankCode'      => '', 
         'bankInterface' => '', 
         'returnURL'     => '', 
         'reference'     => '', 
         'description'   => '', 
         'language'      => '', 
         'currency'      => '', 
         'totalAmount'   => 0, 
         'taxAmount'     => 0,  
         'devolutionBase'=> 0, 
         'tipAmount'     => 0, 
         'payer'         => $payer,
         'buyer'         => $buyer,
         'shipping'      => $shipping,
         'additionalData'=> $additionalData,
         'credits' => $credits
    ]);
``` 

Creates and gets the transaction response
```php 
$placeToPay->createTransactionMultiCredit();

``` 

















