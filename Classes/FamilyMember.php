<?php
class FamilyMember extends BaseClass
{
    // Pull in our objects
    protected $oFamily;

    // Define our scalars
    protected $iFamilyMemberId;
    protected $strFirstName;
    protected $strLastName;

    public function __construct()
    {
        
    }

    public function getDisplayName()
    {
        $strRetval = $this->strFirstName . " " . $this->strLastName;
    }
}