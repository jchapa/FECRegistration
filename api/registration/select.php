<?php
require_once (dirname(__FILE__) . "../BaseAPIPath.php");

class SelectRegistrationAPIPage extends BaseAPIPage
{
    public function __construct()
    {
        parent::__construct();

        // Check that we have the correct parameters
        if (empty($this->aArgs["id"]))
        {
            $bIsError = true;
            // Oh snap. We need a registration id.
            $aResponse = array(
                "result" => "error",
                "message" => "Oh Snap! I need a registration Id"
                );
            echo json_encode($aResponse);
            unset ($aResponse);
        }
    }
    
    public function run()
    {
        if (!$this->bIsError)
        {
            $aRegistrations = array();
            $aRegistrationId = $this->aArgs["id"];

            $oRegistration = new Registration();
        }
    }
}

$oPage = new SelectRegistrationAPIPage();
$oPage->run();