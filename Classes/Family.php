<?php
class Family extends BaseClass
{
    // Pull in our objects
    protected $aFamilyMembers = array();

    // Define our scalars
    protected $iFamilyId;
    protected $strFamilyName;

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