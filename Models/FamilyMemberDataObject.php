<?php
class FamilyMemberDataObject extends CoreDataObject
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

    public function AddFamilyMember($oFamilyMember)
    {
        $strQuery = "insert into FAMILY_MEMBER (" .
            "firstName, lastName)" .
            "values (" .
            $oFamilyMember->strFirstName . ", " .
            $oFamilyMember->strLastName . ");";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }

    public function UpdateFamilyMember($oFamilyMember)
    {
        $strQuery = "update FAMILY_MEMBER " .
            "set firstName=" . 
            $oFamilyMember->strFirstName . ", " .
            "lastName=" . $oFamilyMember->strLastName . " " .
            "where familyMemberId=" . $oRegistration->iFamilyMemberId . ";";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }

    public function GetFamilyMemberList($iPage, $iPageSize)
    {
        $strQuery = "select * from FAMILY_MEMBER " .
            "limit " . $iPage . ", " . $iPageSize  .";";
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }

    public function GetFamilyMembersById($aIds)
    {
        $strQuery = "select * from FAMILY_MEMBER " .
            "where familyMemberId in (";
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