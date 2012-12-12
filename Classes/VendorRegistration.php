<?php
require_once (dirname(__FILE__) . "/BaseClass.php");

class VendorRegistration extends BaseClass
{
    // Class very much a hack. Not designed flexibly - just bare-bones
    // Pull in our objects
    public $oPayment;

    // Pull in our properties
    protected $strVendorRegistrationId;
    // Just cat these guys together
    public $strVendorName;
    public $strBusinessType;
    public $strSalesTaxId;
    public $strMailingAddress;
    public $strMailingCity;
    public $strMailingState;
    public $strMailingZip;

    public $strRep;
    public $strRepEmail;
    public $strRepPhone;
    public $strRepCell;
    public $strAlt;
    public $strAltEmail;
    public $strAltPhone;
    public $strAltCell;
    
    public $strTotal;
    
    public $iBigBooths;
    public $iSmallBooths;
    public $iAdditionalBadges;
    public $iConferencePassType;
    public $iConferencePassQty;
    
    public $strBillingAddress1;
    public $strBillingAddress2;
    public $strBillingCity;
    public $strBillingState;
    public $strBillingZip;
    public $strBillingPhone;
    public $strBillingAltPhone;
    public $strBillingEmail;

    public function __construct()
    {
        
    }
    
    public function LoadRegistration($iRegistrationId)
    {
        $oRegistrationContext = new RegistrationDataObject();
        $oRegistration = $oRegistrationContext->GetRegistrationsById(array($iRegistrationId));
        $this->PopulateRegistration($oRegistration);
    }
    
    public function GetValuesArray()
    {
        return false;
    }
    
    private function PopulateRegistration($oRegistration)
    {
        // Let's loop through the array we got back for the registration
        $this->strRegistrationId = $oRegistration["registration_id"];
        $this->strReferral = $oRegistration["referral"];
        // TODO: Load up the family object
    }
}