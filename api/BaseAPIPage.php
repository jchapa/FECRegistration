<?php
require_once (dirname(__FILE__) . "/../Classes/Registration.php");
require_once (dirname(__FILE__) . "/../Classes/Coupon.php");
require_once (dirname(__FILE__) . "/../Classes/Family.php");
require_once (dirname(__FILE__) . "/../Classes/FamilyMember.php");
require_once (dirname(__FILE__) . "/../Classes/Payment.php");
require_once (dirname(__FILE__) . "/../Web/inc/session.form.func.inc");

abstract class BaseAPIPage
{
    protected $aArgs = array();
    protected $bIsError = false;
    
    protected $m_dbHost;
    protected $m_dbName;
    protected $m_dbUser;
    protected $m_dbPass;
    
    
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
    
    // Let's only load this if we need it. . .
    protected function GetConnectionString()
    {
        // Slightly hackish, but it's secure
        $strConn = trim(file_get_contents(dirname(__FILE__) . "/../../config/dbconnection.config"));
        $aConn = explode(",", $strConn);
        $this->m_dbHost = $aConn[0];
        $this->m_dbName = $aConn[1];
        $this->m_dbUser = $aConn[2];
        $this->m_dbPass = $aConn[3];
    }
}