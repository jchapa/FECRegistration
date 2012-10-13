<?php
require_once (dirname(__FILE__) . "/../Web/inc/authnet/AuthorizeNetAIM.php");

class Payment extends BaseClass
{
    // Pull in our objects
    protected $oFamily;

    // Pull in our scalars
    protected $iPaymentId;
    public $dAmount;
    public $iPaymentStatus;

    // These values are part of the object, but are never, ever, ever, ever, ever,
    // ever persisted - to session or mysql, or anywhere because some of them are 
    // illegal to store, and it's just not cool. We have these properties in here
    // to give us an object container to process CC transactions
    private $strCardName;
    private $strCardNumber;
    private $strCardExp;
    private $strCardCVV;

    const PAYMENT_STATUS_DECLINED = -1;
    const PAYMENT_STATUS_PENDING = 0;
    const PAYMENT_STATUS_SUCCESS = 1;
    
    const AUTH_NET_TRANSACTION_ID = "";
    const AUTH_NET_TRANSACTION_KEY = "";

    public function __construct()
    {

    }

    private function CreateTransaction(
        $strCardName,
        $strCardNumber,
        $strCardExp,
        $strCardCVV
    )
    {
        $this->strCardName = $strCardName;
        $this->strCardNumber = $strCardNumber;
        $this->strCardExp = $strCardExp;
        $this->strCardCVV = $strCardCVV;
    }
    
    public function ProcessTransaction(
        Registration $oRegistration,
            $strCardName,
            $strCardNumber,
            $strCardExp,
            $strCardCVV
        )
    {
        $this->CreateTransaction($strCardName, $strCardNumber, $strCardExp, $strCardCVV);
        
        $iRetval = $this->iPaymentStatus = self::PAYMENT_STATUS_PENDING;
        
        $oAuthNetAPI = new AuthorizeNetAIM();
        $aCardName = explode(' ', $this->strCardName);
        $strLastName = array_pop($aCardName);
        $strFirstName = implode(" ", $aCardName);
        $oAuthNetAPI->setFields(
            array(
            'amount' => '1', // Hard coded for now
            'card_num' => $this->strCardNumber,
            'exp_date' => $this->strCardExp,
            'first_name' => $strFirstName,
            'last_name' => $strLastName,
            'address' => $oRegistration->strBillingAddress1 . ' ' .
                $oRegistration->strBillingAddress2,
            'city' => $oRegistration->strBillingCity,
            'state' => $oRegistration->strBillingState,
            'zip' => $oRegistration->strBillingZip,
            'phone' => $oRegistration->strBillingPhone,
            'email' => $oRegistration->strBillingEmail,
            'invoice_num' => 'FEC2013-01', // We really need config. . .
            'tran_key' => self::AUTH_NET_TRANSACTION_KEY,
            'trans_id' => self::AUTH_NET_TRANSACTION_ID
            )
        );
        
        $oResponse= $oAuthNetAPI->authorizeAndCapture();
        if ($oResponse->approved)
        {
            $iRetval = $this->iPaymentStatus = self::PAYMENT_STATUS_SUCCESS;
        }
        else
        {
            // Something broke - we could add more statuses for reasons, though. . .
            $iRetval = $this->iPaymentStatus = self::PAYMENT_STATUS_DECLINED;
        }

        // Clean up the data
        unset($oAuthNetAPI, $aCardName, $strLastName, $strFirstName, $oResponse);
        $this->DestroyTransaction();
        return $iRetval;
    }

    /**
     * Because we're paranoid
     */
    private function DestroyTransaction()
    {
        $this->strCardName = null;
        $this->strCardNumber = null;
        $this->strCardExp = null;
        $this->strCardCVV = null;
    }
    
    public function GetValuesArray()
    {
    
    }
}