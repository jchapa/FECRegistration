<?php
class FamilyMember extends BaseClass
{
    // Pull in our objects
    public $oFamily;

    // Define our scalars
    public $iFamilyMemberId;
    public $strFirstName;
    public $strLastName;
    public $strAge;

    public function __construct()
    {
        
    }

    public function getDisplayName()
    {
        $strRetval = $this->strFirstName . " " . $this->strLastName;
    }
    
    public function GetValuesArray()
    {
    
    }
}