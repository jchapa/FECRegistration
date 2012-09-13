<?php
require_once (dirname(__FILE__) . "../BaseAPIPath.php");

class SelectRegistrationAPIPage extends BaseAPIPage
{
    public function __construct()
    {
        parent::__construct();

        // Check that we have the correct parameters
        if (empty($this->aArgs["ids"]))
        {
            $bIsError = true;
            // Oh snap. We need a registration id (or comma delimited set).
            $aResponse = array(
                "result" => "error",
                "message" => "Oh Snap! I need a registration Id"
                );
            $this->SendResponse(json_encode($aResponse));
            unset ($aResponse);
            exit;
        }
    }

    public function run()
    {
        if (!$this->bIsError)
        {
            $aRegistrations = array();
            $aRegistrationIds = split(",", $this->aArgs["id"]);

            $oRegistration = new Registration();
            $oRegistration->LoadRegistration($aRegistrationIds);
            $strRetval = json_encode($oRegistration);
            // Output the response
            $this->SendResponse($strRetval);
            unset ($aRegistrationIds, $aRegistrations, $oRegistration);
            exit;
        }
    }
}

$oPage = new SelectRegistrationAPIPage();
$oPage->run();