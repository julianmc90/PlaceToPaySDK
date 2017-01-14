<?php

namespace PlaceToPay\Classes;

/**
 * Class PSETransactionResponse
 *
 * @package PlaceToPay
 */

class PSETransactionResponse
{

    /**
     * PSETransactionResponse transactionID
     * Identificador único de la transacción en PlacetoPay
     */
    private $transactionID;

    /**
     * PSETransactionResponse sessionID
     * Identificador único de la sesión en PlacetoPay
     */
    private $sessionID;

    /**
     * PSETransactionResponse returnCode
     * Código de respuesta de la transacción, uno de los siguientes valores: SUCCESS FAIL_ENTITYNOTEXISTSORDISABLED FAIL_BANKNOTEXISTSORDISABLED FAIL_SERVICENOTEXISTS FAIL_INVALIDAMOUNT FAIL_INVALIDSOLICITDATE FAIL_BANKUNREACHEABLE FAIL_NOTCONFIRMEDBYBANK FAIL_CANNOTGETCURRENTCYCLE FAIL_ACCESSDENIED FAIL_TIMEOUT FAIL_DESCRIPTIONNOTFOUND FAIL_EXCEEDEDLIMIT FAIL_TRANSACTIONNOTALLOWED FAIL_RISK FAIL_NOHOST FAIL_NOTALLOWEDBYTIME FAIL_ERRORINCREDITS
     */
    private $returnCode;

    /**
     * PSETransactionResponse trazabilityCode
     * Código único de seguimiento para la operación dado por la red ACH
     */
    private $trazabilityCode;

    /**
     * PSETransactionResponse transactionCycle
     * Ciclo de compensación de la red
     */
    private $transactionCycle;

    /**
     * PSETransactionResponse bankCurrency
     * Moneda aceptada por el banco acorde a ISO 4217
     */
    private $bankCurrency;

    /**
     * PSETransactionResponse bankFactor
     * Factor de conversión de la moneda
     */
    private $bankFactor;

    /**
     * PSETransactionResponse bankURL
     * URL a la cualremitirla solicitud para iniciarla interfaz del banco, sólo disponible cuando returnCode = SUCCESS
     */
    private $bankURL;

    /**
     * PSETransactionResponse responseCode
     * Estado de la operación en PlacetoPay [ 0 = FAILED, 1 = APPROVED, 2 = DECLINED, 3 = PENDING ]
     */
    private $responseCode;

    /**
     * PSETransactionResponse responseReasonCode
     * Código interno de respuesta de la operación en PlacetoPay
     */
    private $responseReasonCode;

    /**
     * PSETransactionResponse responseReasonText
     * Mensaje asociado con el código de respuesta de la operación en PlacetoPay
     */
    private $responseReasonText;

    /**
     * Instantiates a new PSETransactionResponse Object
     */
    public function __construct(
            $transactionID, 
            $sessionID, 
            $returnCode, 
            $trazabilityCode, 
            $transactionCycle, 
            $bankCurrency, 
            $bankFactor, 
            $bankURL, 
            $responseCode, 
            $responseReasonCode, 
            $responseReasonText
        )
    {

        $this->setTransactionID($transactionID);
        $this->setSessionID($sessionID);
        $this->setReturnCode($returnCode);
        $this->setTrazabilityCode($trazabilityCode);
        $this->setTransactionCycle($transactionCycle);
        $this->setBankCurrency($bankCurrency);
        $this->setBankFactor($bankFactor);
        $this->setBankURL($bankURL);
        $this->setResponseCode($responseCode);
        $this->setResponseReasonCode($responseReasonCode);
        $this->setResponseReasonText($responseReasonText);
    }
    /**
     *Function getTransactionID
     */
    public function getTransactionID()
    {
        return $this->transactionID;
    }

    /**
     *Function setTransactionID
     */
    public function setTransactionID($transactionID)
    {
        $this->transactionID = $transactionID;
    }

    /**
     *Function getSessionID
     */
    public function getSessionID()
    {
        return $this->sessionID;
    }

    /**
     *Function setSessionID
     */
    public function setSessionID($sessionID)
    {
        $this->sessionID = $sessionID;
    }

    /**
     *Function getReturnCode
     */
    public function getReturnCode()
    {
        return $this->returnCode;
    }

    /**
     *Function setReturnCode
     */
    public function setReturnCode($returnCode)
    {
        $this->returnCode = $returnCode;
    }

    /**
     *Function getTrazabilityCode
     */
    public function getTrazabilityCode()
    {
        return $this->trazabilityCode;
    }

    /**
     *Function setTrazabilityCode
     */
    public function setTrazabilityCode($trazabilityCode)
    {
        $this->trazabilityCode = $trazabilityCode;
    }

    /**
     *Function getTransactionCycle
     */
    public function getTransactionCycle()
    {
        return $this->transactionCycle;
    }

    /**
     *Function setTransactionCycle
     */
    public function setTransactionCycle($transactionCycle)
    {
        $this->transactionCycle = $transactionCycle;
    }

    /**
     *Function getBankCurrency
     */
    public function getBankCurrency()
    {
        return $this->bankCurrency;
    }

    /**
     *Function setBankCurrency
     */
    public function setBankCurrency($bankCurrency)
    {
        $this->bankCurrency = $bankCurrency;
    }

    /**
     *Function getBankFactor
     */
    public function getBankFactor()
    {
        return $this->bankFactor;
    }

    /**
     *Function setBankFactor
     */
    public function setBankFactor($bankFactor)
    {
        $this->bankFactor = $bankFactor;
    }

    /**
     *Function getBankURL
     */
    public function getBankURL()
    {
        return $this->bankURL;
    }

    /**
     *Function setBankURL
     */
    public function setBankURL($bankURL)
    {
        $this->bankURL = $bankURL;
    }

    /**
     *Function getResponseCode
     */
    public function getResponseCode()
    {
        return $this->responseCode;
    }

    /**
     *Function setResponseCode
     */
    public function setResponseCode($responseCode)
    {
        $this->responseCode = $responseCode;
    }

    /**
     *Function getResponseReasonCode
     */
    public function getResponseReasonCode()
    {
        return $this->responseReasonCode;
    }

    /**
     *Function setResponseReasonCode
     */
    public function setResponseReasonCode($responseReasonCode)
    {
        $this->responseReasonCode = $responseReasonCode;
    }

    /**
     *Function getResponseReasonText
     */
    public function getResponseReasonText()
    {
        return $this->responseReasonText;
    }

    /**
     *Function setResponseReasonText
     */
    public function setResponseReasonText($responseReasonText)
    {
        $this->responseReasonText = $responseReasonText;
    }

}
