<?php

class CouponDataObject extends CoreDataObject
{
    public function __construct(
        $strHost,
        $strDatabaseName,
        $strUsername,
        $strPassword
        )
    {
        parent::__construct(
            $strHost,
            $strDatabaseName,
            $strUsername,
            $strPassword
            );
    }

    public function AddCoupon($oCoupon)
    {
        $strQuery = "insert into COUPON (" .
            "startDate, endDate, name, code)" .
            "values (" .
            $oCoupon->iStartDate. ", " .
            $oCoupon->iEndDate . ", " .
            $oCoupon->strName . ", " .
            $oCoupon->strCode .  ");";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }

    public function UpdateCoupon($oCoupon)
    {
        $strQuery = "update COUPON " .
            "set startDate=" . $oCoupon->iStartDate . ", " .
            "endDate=" . $oCoupon->iEndDate . ", " .
            "name=" . $oCoupon->strName . ", " .
            "code=" . $oCoupon->strCode.  " " .
            "where couponId ="  . $oPayment->iCouponId . ";";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }

    public function GetCouponList($iPage, $iPageSize)
    {
        $strQuery = "select * from COUPON " .
            "limit " . $iPage . ", " . $iPageSize  .";";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }

    public function GetCouponsById($aIds)
    {
        $strQuery = "select * from COUPON " .
            "where couponId in (";
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