<?php
require_once (dirname(__FILE__) . "/FamilyMemberDataObject.php");

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

    // Gets a family and returns its ID
    public function AddFamily(Family &$oFamily)
    {
        
        $strQuery = $this->GetAddFamilySQL($oFamily);
        $oResponse = parent::DoQueries(array($strQuery));
        unset($strQuery, $oResponse);
        
        $strRetval = parent::GetLastInsertID();
        $oFamily->iFamilyId = $strRetval;
        
        // Do we have any family members?
        foreach ($oFamily->aFamilyMembers as &$oFamilyMember)
        {
            $oFamilyMemberData = new FamilyMemberDataObject(
                    $this->m_dbHost,
                    $this->m_dbName,
                    $this->m_dbUser,
                    $this->m_dbPass
                );
            $oFamilyMember->oFamily = $oFamily;
            $oFamilyMemberData->AddFamilyMember($oFamilyMember);
            $oFamilyMember->iFamilyMemberId = parent::GetLastInsertID();
            unset ($oFamilyMember);
        }
        
        return $strRetval;
    }
    
    public function GetAddFamilySQL(Family $oFamily)
    {
        $strRetval = "insert into FAMILY (`name`)" .
            "values ('" . $this->CleanUpParameter($oFamily->strFamilyName) . "');";
        return $strRetval;
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