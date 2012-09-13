<?php
class FamilyDataObject extends CoreDataObject
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

    public function AddFamily($oFamily)
    {
        $strQuery = "insert into FAMILY (" .
            "familyName)" .
            "values (" .
            $oFamily->strFamilyName . ");";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }

    public function UpdateFamily($oFamily)
    {
        $strQuery = "update FAMILY " .
            "set familyName=" . $oRegistration->oFamily->strFamilyName . " " .
            "where familyId ="  . $oRegistration->iFamilyId . ";";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }

    public function GetFamilyList($iPage, $iPageSize)
    {
        $strQuery = "select * from FAMILY " .
            "limit " . $iPage . ", " . $iPageSize  .";";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }

    public function GetFamiliesById($aIds)
    {
        $strQuery = "select * from FAMILY " .
            "where familyId in (";
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