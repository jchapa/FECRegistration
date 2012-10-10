<?php
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

    public function AddRegistration($oRegistration)
    {
        $strQuery = "insert into REGISTRATION (" .
            "family_id, payment_id, coupon_id, referral)" .
            "values (" .
            $oRegistration->oFamily->iFamilyId . ", " .
            $oRegistration->oPayment->iPaymentId . ", " .
            $oRegistration->oCoupon->iCouponId . ", " .
            $oRegistration->strReferrer . ");";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
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