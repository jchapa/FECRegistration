<?php
class PaymentDataObject extends CoreDataObject
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

    public function AddPayment($oPayment)
    {
        $strQuery = "insert into PAYMENT (" .
            "familyId, amount, status)" .
            "values (" .
            $oPayment->oFamily->iFamilyId . ", " .
            $oPayment->dAmount . ", " .
            $oPayment->iPaymentStatus .  ");";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }

    public function UpdatePayment($oPayment)
    {
        $strQuery = "update PAYMENT " .
            "set familyId=" . $oPayment->oFamily->iFamilyId . ", " .
            "amount=" . $oPayment->dAmount . ", " .
            "status=" . $oPayment->iPaymentStatus.  " " .
            "where paymentId ="  . $oPayment->iPaymentId . ";";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }

    public function GetPaymentList($iPage, $iPageSize)
    {
        $strQuery = "select * from PAYMENT " .
            "limit " . $iPage . ", " . $iPageSize  .";";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }

    public function GetPaymentsById($aIds)
    {
        $strQuery = "select * from PAYMENT " .
            "where paymentId in (";
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