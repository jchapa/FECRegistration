<?php
require_once (dirname(__FILE__) . "../Classes/Registration.php");
require_once (dirname(__FILE__) . "../Classes/Coupon.php");
require_once (dirname(__FILE__) . "../Classes/Family.php");
require_once (dirname(__FILE__) . "../Classes/FamilyMember.php");
require_once (dirname(__FILE__) . "../Classes/Payment.php");

class BaseAPIPage
{
    protected $aArgs = array();
    protected $bIsError = false;
    
    public function __construct()
    {
        $this->aArgs = getArgs();
    }
    
    private function getArgs()
    {
        $aRetval = array();
        foreach ($_REQUEST as $strKey => $strVal)
        {
            $aParameter = array(
                $strKey => $strVal
                );
            array_push($aRetval, $aParameter);
            unset ($aParameter);
        }
        return $aRetval;
    }

    public abstract function run();
}