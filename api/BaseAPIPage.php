<?php
require_once (dirname(__FILE__) . "/../Classes/Registration.php");
require_once (dirname(__FILE__) . "/../Classes/Coupon.php");
require_once (dirname(__FILE__) . "/../Classes/Family.php");
require_once (dirname(__FILE__) . "/../Classes/FamilyMember.php");
require_once (dirname(__FILE__) . "/../Classes/Payment.php");

abstract class BaseAPIPage
{
    protected $aArgs = array();
    protected $bIsError = false;
    
    public function __construct()
    {
        $this->aArgs = $this->GetArgs();
    }
    
    private function GetArgs()
    {
        $aRetval = array();
        foreach ($_REQUEST as $strKey => $strVal)
        {
            $aRetval[$strKey] = $strVal;
            unset ($strKey, $strVal);
        }
        return $aRetval;
    }
    
    protected function SendResponse($strRepsonse)
    {
        header('Content-Type: application/json');
        echo $strRepsonse;
    }

    public abstract function run();
}