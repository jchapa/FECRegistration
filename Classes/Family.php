<?php
class Family extends BaseClass
{
    // Pull in our objects
    public $aFamilyMembers = array();

    // Define our scalars
    public $iFamilyId;
    public $strFamilyName;

    public function __construct()
    {
        
    }
    
    public function AddFamilyMember(FamilyMember $oFamilyMember)
    {
        array_push($this->aFamilyMembers, $oFamilyMember);
    }
    
    public function GetValuesArray()
    {
    
    }
}