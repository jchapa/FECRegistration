<?php
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
    
    public function LoadRegistration($aRegistrationId)
    {
        
    }
}