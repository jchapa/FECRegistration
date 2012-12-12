<?php
require_once (dirname(__FILE__) . "/../BaseAPIPage.php");

/** This service processes vendor appliccations from the web interface **/

class ProcessVendorAPIPage extends BaseAPIPage
{
    public function __construct()
    {
        // We construct te parent first to get our args
        parent::__construct();
    }
    
    public function run()
    {
        // Setup billing info
        $oRegistration = new VendorRegistration();
        $oRegistration->oPayment = new Payment();
        
        $dPrice = 0.00;
        
        $aFormVals = $aPaymentValues = $_REQUEST;
        
        $oRegistration->strVendorName = $aFormVals["vendor-name"];
        $oRegistration->strBusinessType = $aFormVals["vendor-type"];
        $oRegistration->strSalesTaxId = $aFormVals["vendor-sales-tax"];
        $oRegistration->strMailingAddress = $aFormVals["vendor-address"];
        $oRegistration->strMailingCity = $aFormVals["vendor-city"];
        $oRegistration->strMailingState = $aFormVals["vendor-state"];
        $oRegistration->strMailingZip = $aFormVals["vendor-zip"];
        
        $oRegistration->strRep = $aFormVals["vendor-rep"];
        $oRegistration->strRepEmail = $aFormVals["vendor-rep-email"];
        $oRegistration->strRepPhone = $aFormVals["vendor-rep-phone"];
        $oRegistration->strRepCell = $aFormVals["vendor-rep-cell"];
        $oRegistration->strAlt = $aFormVals["vendor-alt"];
        $oRegistration->strAltEmail = $aFormVals["vendor-alt-email"];
        $oRegistration->strAltPhone = $aFormVals["vendor-alt-phone"];
        $oRegistration->strAltCell = $aFormVals["vendor-alt-cell"];
        
        $oRegistration->iBigBooths = $aFormVals["vendor-booth-big"] == "" ? 0 : $aFormVals["vendor-booth-big"];
        $oRegistration->iSmallBooths = $aFormVals["vendor-booth-small"] == "" ? 0 : $aFormVals["vendor-booth-small"];
        $oRegistration->iAdditionalBadges = $aFormVals["vendor-badges"] == "" ? 0 : $aFormVals["vendor-badges"];
        
        $strPasses = $aFormVals["vendor-speaker-pass"] == "" ? 0 : $aFormVals["vendor-speaker-pass"];
    
        if (0 !== strpos($strPasses, "individual"))
        {
            $oRegistration->iConferencePassType = "individual";
            $oRegistration->iConferencePassQty = substr($strPasses, strlen($strPasses));
        }
        else if (0 !== strpos($strPasses, "family"))
        {
            $oRegistration->iConferencePassType = "family";
            $oRegistration->iConferencePassQty = substr($strPasses, strlen($strPasses));
        }
        else if ($strPasses === 0)
        {
            $oRegistration->iConferencePassType = "none";
            $oRegistration->iConferencePassQty = 0;
        }
        else
        {
            // Something's Weird - don't do anything
        }
        
        $oRegistration->strBillingAddress1 = $aPaymentValues["street-1"];
        $oRegistration->strBillingAddress2 = $aPaymentValues["street-2"];
        $oRegistration->strBillingCity = $aPaymentValues["city"];
        $oRegistration->strBillingState = $aPaymentValues["state"];
        $oRegistration->strBillingZip = $aPaymentValues["zip"];
        $oRegistration->strBillingPhone = $aPaymentValues["phone"];
        $oRegistration->strBillingAltPhone = $aPaymentValues["alt-phone"];
        $oRegistration->strBillingEmail = $aPaymentValues["email"];
        
        $dPrice = 1.00;
        // UNCOMMENT NEXT TWO LNES WHEN RELEASING
        
        $strAuthNetTransKey = file_get_contents(dirname(__FILE__) . '/../../../config/auth_net_transaction_key.config');
        $strAuthNetTransId = file_get_contents(dirname(__FILE__) . '/../../../config/auth_net_transaction_id.config');
        
        $strCCExp = $aPaymentValues["month"] . "/" . $aPaymentValues["year"];
        
        // Time for payment information
        $iPaymentFlag = $oRegistration->oPayment->ProcessTransaction(
                $oRegistration,
                $strAuthNetTransKey,
                $strAuthNetTransId,
                $aPaymentValues["card-name"],
                $aPaymentValues["card-number"],
                $strCCExp,
                $aPaymentValues["csc"]
        );
        // Here we determine what happened, and output it.
        $strRetval = json_encode(array("result" => $iPaymentFlag));
        
        // Output the response
        $this->SendResponse($strRetval);
        //unset($stuff, $andThings);
        exit;
    }
}

$oPage = new ProcessVendorAPIPage();
$oPage->run();