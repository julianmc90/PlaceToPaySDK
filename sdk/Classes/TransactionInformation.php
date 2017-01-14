<?php

namespace PlaceToPay\Classes;

/**
 * Class TransactionInformation
 *
 * @package PlaceToPay
 */

class TransactionInformation
{

/**
 * TransactionInformation transactionID
 * Identificador único de la transacción en PlacetoPay
 */
    private $transactionID;

/**
 * TransactionInformation sessionID
 * Identificador único de la sesión en PlacetoPay
 */
    private $sessionID;

/**
 * TransactionInformation reference
 * Referencia única de pago
 */
    private $reference;

/**
 * TransactionInformation requestDate
 * Fecha de solicitud o creación de la transacción acorde a ISO 8601
 */
    private $requestDate;

/**
 * TransactionInformation bankProcessDate
 * Fecha de procesamiento de la transacción acorde a ISO 8601
 */
    private $bankProcessDate;

/**
 * TransactionInformation onTest
 * Indicador de si la transacción es en modo de pruebas o no
 */
    private $onTest;

/**
 * TransactionInformation returnCode
 * Código de respuesta de la transacción, uno de los siguientes: SUCCESS FAIL_INVALIDTRAZABILITYCODE FAIL_ACCESSDENIED FAIL_INVALIDSTATE FAIL_INVALIDBANKPROCESSINGDATE FAIL_INVALIDAUTHORIZEDAMOUNT FAIL_INCONSISTENTDATA FAIL_TIMEOUT FAIL_INVALIDVATVALUE FAIL_INVALIDTICKETID FAIL_INVALIDSOLICITEDATE FAIL_INVALIDAUTHORIZATIONID FAIL_TRANSACTIONNOTALLOWED FAIL_ERRORINCREDITS FAIL_EXCEEDEDLIMIT
 */
    private $returnCode;

/**
 * TransactionInformation trazabilityCode
 * Código único de seguimiento para la operación dado por la red ACH
 */
    private $trazabilityCode;

/**
 * TransactionInformation transactionCycle
 * Ciclo de compensación de la red
 */
    private $transactionCycle;

/**
 * TransactionInformation transactionState
 * Información del estado de la transacción [ OK, NOT_AUTHORIZED, PENDING, FAILED ]
 */
    private $transactionState;

/**
 * TransactionInformation responseCode
 * Estado de la operación en PlacetoPay
 */
    private $responseCode;

/**
 * TransactionInformation responseReasonCode
 * Código interno de respuesta de la operación en PlacetoPay
 */
    private $responseReasonCode;

/**
 * TransactionInformation responseReasonText
 * Mensaje asociado con el código de respuesta de la operación en PlacetoPay
 */
    private $responseReasonText;

/**
 * Instantiates a new TransactionInformation Object
 */
    public function __construct($transactionID, $sessionID, $reference, $requestDate, $bankProcessDate, $onTest, $returnCode, $trazabilityCode, $transactionCycle, $transactionState, $responseCode, $responseReasonCode, $responseReasonText)
    {

        $this->setTransactionID($transactionID);
        $this->setSessionID($sessionID);
        $this->setReference($reference);
        $this->setRequestDate($requestDate);
        $this->setBankProcessDate($bankProcessDate);
        $this->setOnTest($onTest);
        $this->setReturnCode($returnCode);
        $this->setTrazabilityCode($trazabilityCode);
        $this->setTransactionCycle($transactionCycle);
        $this->setTransactionState($transactionState);
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
 *Function getRequestDate
 */
    public function getRequestDate()
    {
        return $this->requestDate;
    }

/**
 *Function setRequestDate
 */
    public function setRequestDate($requestDate)
    {
        $this->requestDate = $requestDate;
    }

/**
 *Function getBankProcessDate
 */
    public function getBankProcessDate()
    {
        return $this->bankProcessDate;
    }

/**
 *Function setBankProcessDate
 */
    public function setBankProcessDate($bankProcessDate)
    {
        $this->bankProcessDate = $bankProcessDate;
    }

/**
 *Function getOnTest
 */
    public function getOnTest()
    {
        return $this->onTest;
    }

/**
 *Function setOnTest
 */
    public function setOnTest($onTest)
    {
        $this->onTest = $onTest;
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
 *Function getTransactionState
 */
    public function getTransactionState()
    {
        return $this->transactionState;
    }

/**
 *Function setTransactionState
 */
    public function setTransactionState($transactionState)
    {
        $this->transactionState = $transactionState;
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
