<?php
require_once (dirname(__FILE__) . "/BaseClass.php");

class Registration extends BaseClass
{
    // Pull in our objects
    public $oFamily;
    public $oPayment;
    public $oCoupon;

    // Pull in our properties
    protected $strRegistrationId;
    // Just cat these guys together
    public $strReferral;
    public $strRegistrationType;
    public $iAttendeeNumber;
    public $bAttendingWednesday;
    public $bAttendingThursday;
    public $bAttendingFriday;
    public $bAttendingSaturday;
    
    public $bIsComplete;

    // This really should be normalized, but I don't have time this 1 AM. . .
    public $strContactAddress1;
    public $strContactAddress2;
    public $strContactCity;
    public $strContactState;
    public $strContactZip;
    public $strContactPhone;
    public $strContactAltPhone;
    public $strContactEmail;
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
        // TODO: Get the family/payment object up in here
        $aRetval = array(
            "registration_id" => $this->strRegistrationId,
            "referrer" => $this->strReferral,
            "days_attending" => array(
                "wednesday" => $this->bAttendingWednesday,
                "thursday" => $this->bAttendingThursday,
                "friday" => $this->bAttendingFriday,
                "saturday" => $this->bAttendingSaturday
                ),
            "family" => $this->oFamily->GetValuesArray(),
            "payment" => $this->oPayment->GetValuesArray(),
            "coupon" => $this->oPayment->GetValuesArray(),
            "contact_address_1" => $this->strContactAddress1,
            "contact_address_2" => $this->strContactAddress2,
            "contact_city" => $this->strContactCity,
            "contact_state" => $this->strContactState,
            "contact_zip" => $this->strContactZip,
            "contact_phone" => $this->strContactPhone,
            "contact_alt_phone" => $this->strContactAltPhone,
            "contact_email" => $this->strContactEmail,
            "billing_address_1" => $this->strBillingAddress1,
            "billing_address_2" => $this->strBillingAddress2,
            "billing_city" => $this->strBillingCity,
            "billing_state" => $this->strBillingState,
            "billing_zip" => $this->strBillingZip,
            "billing_phone" => $this->strBillingPhone,
            "billing_alt_phone" => $this->strBillingAltPhone,
            "billing_email" => $this->strBillingEmail,
            );
        return $aRetval;
    }
    
    private function PopulateRegistration($oRegistration)
    {
        // Let's loop through the array we got back for the registration
        $this->strRegistrationId = $oRegistration["registration_id"];
        $this->strReferral = $oRegistration["referral"];
        // TODO: Load up the family object
    }
}