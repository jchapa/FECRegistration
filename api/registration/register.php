<?php
require_once (dirname(__FILE__) . "/../BaseAPIPage.php");

class RegisterRegistrationAPIPage extends BaseAPIPage
{
    public function __construct()
    {
        // We construct the parent first to get our args
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
            $aRegistrationIds = split(",", $this->aArgs["ids"]);

            $oRegistration = new Registration();
            $oRegistration->LoadRegistration($aRegistrationIds[0]);
            $strRetval = json_encode($oRegistration->GetValuesArray());
            // Output the response
            $this->SendResponse($strRetval);
            unset ($aRegistrationIds, $aRegistrations, $oRegistration);
            exit;
        }
    }
}

$oPage = new SelectRegistrationAPIPage();
$oPage->run();