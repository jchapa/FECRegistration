<?php
require_once (dirname(__FILE__) . "/BaseClass.php");

class Registration extends BaseClass
{
    // Pull in our objects
    protected $oFamily;
    protected $oPayment;
    protected $oCoupon;

    // Pull in our scalars
    protected $strRegistrationId;
    protected $strReferral;
    protected $bAttendingWednesday;
    protected $bAttendingThursday;
    protected $bAttendingFriday;
    protected $bAttendingSaturday;

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
            "referrer" => $this->strReferral
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