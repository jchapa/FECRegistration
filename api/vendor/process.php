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
            $oRegistration->iConferencePassQty = substr($strPasses, strlen($strPasses) - 1);
        }
        else if (0 !== strpos($strPasses, "family"))
        {
            $oRegistration->iConferencePassType = "family";
            $oRegistration->iConferencePassQty = substr($strPasses, strlen($strPasses) - 1);
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
        

        $dPrice = 0.00;
        $dPrice = $dPrice + ($oRegistration->iBigBooths * 340); // Big booths cost $340.00
        $dPrice = $dPrice + ($oRegistration->iSmallBooths * 265); // Small booths cost $265.00
        if ($oRegistration->iConferencePassType === "family")
        {
            $dPrice = $dPrice + 79;
        }
        else if ($oRegistration->iConferencePassType === "individual")
        {
            $dPrice = $dPrice + ($oRegistration->iConferencePassQty * 19);
        }
        
        $strAuthNetTransKey = file_get_contents(dirname(__FILE__) . '/../../../config/auth_net_transaction_key.config');
        $strAuthNetTransId = file_get_contents(dirname(__FILE__) . '/../../../config/auth_net_transaction_id.config');
        
        $strCCExp = $aPaymentValues["month"] . "/" . $aPaymentValues["year"];
        
        $oPayment = new Payment();
        
        // THIS NEEDS TO BE COMMENTED FOR RELEASE
        $dPrice = 1.00;
        
        $oPayment->dAmount = $dPrice;
        $oRegistration->strTotal = $dPrice;
        
        // Time for payment information
        $iPaymentFlag = $oPayment->ProcessTransaction(
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
        
        if ($iPaymentFlag === "1")
        {
            $this->SendEmailConfirmations($oRegistration);
        }
        
        // Output the response
        $this->SendResponse($strRetval);
        //unset($stuff, $andThings);
        exit;
    }
    
    protected function SendEmailConfirmations(VendorRegistration $oRegistration)
    {
        // time to send an email!
    
        /*
         * We send three confirmations
        * 1) to the registrant (with their billing! email address)
        * 3) To the cool FEC people (jack, megan, chad at this point)
        */
    
        // First let's send the registration email(s)
        $bRegEmail = $this->SendRegistrantEmail($oRegistration);
    }
    
    private function SendRegistrantEmail(VendorRegistration $oRegistration)
    {
        $strTo = $oRegistration->strRepEmail . ", " . $oRegistration->strAltEmail . ", registration@familyeconomics.com";
        $strHeaders = "From: Family Economics Registration <registration@familyeconomics.com> . \r\n";
        $strHeaders .= "Content-type: text/html\r\n";
        $strSubject = "Registration Confirmation - Family Economics 2013 - MO";
        $strRetval = $this->GetEmailHeader();
        $strRetval .= <<<EOF
        <h2 style="color:#00A9E9">Vendor Registration Confirmation</h2>
        <p>You are successfully registered as a vendor for the 2013 Family Economics Conference!
        We look forward to having you join us in May as we cast a vision for
        family economics.</p>
EOF;
        $strRetval .= <<<EOF
        <br />
        <p>Here is the contact information we have on file for you:</p>
        <p><strong>Vendor Name:</strong> {$oRegistration->strVendorName}</p>
        <p><strong>Business Type:</strong> {$oRegistration->strBusinessType}</p>
        <p><strong>Sales Tax ID:</strong> {$oRegistration->strSalesTaxId}</p>
        <p><strong>Email Address:</strong> {$oRegistration->strContactEmail}</p>
        <p><strong>Alt Email Address:</strong> {$oRegistration->strAltEmail}</p>
        <p><strong>Phone Number:</strong> {$oRegistration->strContactPhone}</p>
        <p><strong>Address:</strong> {$oRegistration->strMailingAddress}</p>
        <p><strong>City:</strong> {$oRegistration->strMailingCity}</p>
        <p><strong>State:</strong> {$oRegistration->strMailingState}</p>
        <p><strong>Zip:</strong> {$oRegistration->strMailingZip}</p>
        <p><strong>Representative:</strong> {$oRegistration->strRep} ({$oRegistration->strRepPhone}/{$oRegistration->strRepCell})</p>
        <p><strong>Alt Representative:</strong> {$oRegistration->strAlt} ({$oRegistration->strAltPhone}/{$oRegistration->strAltCell})</p>
        <h3 style="color:#00A9E9">Booth Reservations</h3>
        <p><strong>Large Booths (10x10)</strong> x {$oRegistration->iBigBooths}</p>
        <p><strong>Small Booths (8x10)</strong> x {$oRegistration->iSmallBooths}</p>
        <p><strong>Conference Pass</strong> {$oRegistration->iConferencePassType} x {$oRegistration->iConferencePassQty}</p>
        <p><strong>Additional Badges</strong> x {$oRegistration->iAdditionalBadges}</p>
        <p><strong>Grand Total:</strong> \${$oRegistration->strTotal}</p>
        <br />
        <p>
            If you need to change anything or have any questions, just send us
            an email to let us know. You can reach us at
            <a href="mailto:registration@familyeconomics.com">registration@familyeconomics.com</a>.
        </p>
EOF;
        $strRetval .= $this->GetEmailFooter();
        mail($strTo, $strSubject, $strRetval, $strHeaders);
        return $strRetval;
    }
    
    private function AddPaymentInfo(VendorRegistration $oRegistration)
    {
        return <<<EOF
        <p>Your card has been successfully charged &#36;{$oRegistration->oPayment->dAmount}</p>
EOF;
    }
    
    private function GetEmailHeader()
    {
        return <<<EOF
<html>
    <body>
        <div style="background:#E4D30B">
        <img src="http://www.familyeconomics.com/wp-content/themes/family-economics/images/logo.png" />
        </div>
EOF;
    }
    
    private function GetEmailFooter()
    {
        return <<<EOF
        <p>
            See you in May!
        </p>
        <p>
            The Generations with Vision Team
        </p>
    </body>
</html>
EOF;
    }
}

$oPage = new ProcessVendorAPIPage();
$oPage->run();