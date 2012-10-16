<?php
require_once (dirname(__FILE__) . "/CoreDataObject.php");
require_once (dirname(__FILE__) . "/FamilyDataObject.php");
require_once (dirname(__FILE__) . "/CoreDataObject.php");
require_once (dirname(__FILE__) . "/CouponDataObject.php");

class RegistrationDataObject extends CoreDataObject
{
    public function __construct(
        $strHost = null,
        $strDatabaseName = null,
        $strUsername = null,
        $strPassword = null
        )
    {
        parent::__construct(
            $strHost,
            $strDatabaseName,
            $strUsername,
            $strPassword
            );
    }
    
    public function AddRegistrationWithDeps($oRegistration)
    {
        $aQueries = array();
        
    }

    public function AddRegistration(Registration $oRegistration)
    {
        // Setup the dependencies - it will auto set their IDs
        // Make a family
        $aFamilyDC = new FamilyDataObject(
            $this->m_dbHost,
            $this->m_dbName,
            $this->m_dbUser,
            $this->m_dbPass
            );
        // Now we have a payment id, let's use it.
        $aFamilyDC->AddFamily($oRegistration->oFamily);
        $oRegistration->oPayment->oFamily->iFamilyId = $oRegistration->oFamily->iFamilyId;
        
        $aPaymentDC = new PaymentDataObject(
            $this->m_dbHost,
            $this->m_dbName,
            $this->m_dbUser,
            $this->m_dbPass
            );
        $aPaymentDC->AddPayment($oRegistration->oPayment);
        
        // Coupond will have already been created
        
        $strQuery = $this->GetAddRegistrationSQL($oRegistration);
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }
    
    public function GetAddRegistrationSQL(Registration $oRegistration)
    {
        // Let's cat the days attending sql
        $strDaysAttending = "";
        if ($oRegistration->bAttendingWednesday);
        $strDaysAttending .= "wednesday|";
        if ($oRegistration->bAttendingThursday)
            $strDaysAttending .= "thursday|";
        if ($oRegistration->bAttendingFriday)
            $strDaysAttending .= "friday|";
        if ($oRegistration->bAttendingSaturday)
            $strDaysAttending .= "saturday|";
        
        $strRetval = "insert into REGISTRATION (" .
                "family_id, payment_id, coupon_id, registration_type, attendee_number,
                    days_attending, contact_address_1, contact_address_2, contact_city,
                    contact_state, contact_zip, contact_phone, contact_alt_phone, contact_email,
                    billing_address_1, billing_address_2, billing_city, billing_state,
                    billing_zip, billing_phone, billing_alt_phone, billing_email,
                    referral, is_complete
                    )" .
                "values ('" .
                $oRegistration->oFamily->iFamilyId . "', '" .
                $oRegistration->oPayment->iPaymentId . "', '" .
                $oRegistration->oCoupon->iCouponId . "', '" .
                $this->CleanUpParameter($oRegistration->strRegistrationType) . "', '" .
                $this->CleanUpParameter($oRegistration->iAttendeeNumber) . "', '" .
                $this->CleanUpParameter($strDaysAttending) . "', '" .
                $this->CleanUpParameter($oRegistration->strContactAddress1) . "', '" .
                $this->CleanUpParameter($oRegistration->strContactAddress2) . "', '" .
                $this->CleanUpParameter($oRegistration->strContactCity) . "', '" .
                $this->CleanUpParameter($oRegistration->strContactState) . "', '" .
                $this->CleanUpParameter($oRegistration->strContactZip) . "', '" .
                $this->CleanUpParameter($oRegistration->strContactPhone) . "', '" .
                $this->CleanUpParameter($oRegistration->strContactAltPhone) . "', '" .
                $this->CleanUpParameter($oRegistration->strContactEmail) . "', '" .
                $this->CleanUpParameter($oRegistration->strBillingAddress1) . "', '" .
                $this->CleanUpParameter($oRegistration->strBillingAddress2) . "', '" .
                $this->CleanUpParameter($oRegistration->strBillingCity) . "', '" .
                $this->CleanUpParameter($oRegistration->strBillingState) . "', '" .
                $this->CleanUpParameter($oRegistration->strBillingZip) . "', '" .
                $this->CleanUpParameter($oRegistration->strBillingPhone) . "', '" .
                $this->CleanUpParameter($oRegistration->strBillingAltPhone) . "', '" .
                $this->CleanUpParameter($oRegistration->strBillingEmail) . "', '" .
                $this->CleanUpParameter($oRegistration->strReferral) . "', '" .
                $this->CleanUpParameter($oRegistration->bIsComplete) . "');";
        unset($strDaysAttending);
        return $strRetval;
    }

    public function UpdateRegistration($oRegistration)
    {
        $strQuery = "update REGISTRATION " .
            "set family_id=" . $oRegistration->oFamily->iFamilyId . ", " .
            "payment_id=" . $oRegistration->oPayment->iPaymentId . ", " .
            "coupon_id=" . $oRegistration->oCoupon->iCouponId . ", " .
            "referral=" . $oRegistration->strReferrer . " " .
            "where registrationId ="  . $oRegistration->iRegistrationId . ";";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }

    public function GetRegistrationList($iPage, $iPageSize)
    {
        $strQuery = "select * from REGISTRATION " .
            "limit " . $iPage . ", " . $iPageSize  .";";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }

    public function GetRegistrationsById($aIds)
    {
        $strQuery = "select * from REGISTRATION " .
            "where registration_id in (";
        foreach ($aIds as $iId)
        {
            $strQuery .= $iId . ", ";
        }
        $strQuery = substr_replace(
                        $strQuery,
                        "",
                        -2);
        $strQuery .= ")";
        $oRetval = parent::DoQueries(array($strQuery));
        return $oRetval;
    }
}