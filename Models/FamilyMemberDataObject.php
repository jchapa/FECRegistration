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

    public function AddFamilyMember(FamilyMember $oFamilyMember)
    {
        $strQuery = $this->GetAddFamilyMemberSQL($oFamilyMember);
        $oRetval = parent::DoQueries(array($strQuery));
        unset($strQuery);
        return $oRetval;
    }
    
    public function GetAddFamilyMemberSQL(FamilyMember $oFamilyMember)
    {
        $strRetval = "insert into FAMILY_MEMBER (" . 
            "family_id, first_name, last_name, age) values ('" .
            $oFamilyMember->oFamily->iFamilyId . "', '" . 
            $this->CleanUpParameter($oFamilyMember->strFirstName) . "', '" .
            $this->CleanUpParameter($oFamilyMember->strLastName) . "', '" .
            $this->CleanUpParameter($oFamilyMember->strAge) . "');";
        return $strRetval;
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