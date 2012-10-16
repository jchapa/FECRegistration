<?php
require_once (dirname(__FILE__) . "/../BaseAPIPage.php");

/**
 * This service registers users from the web interface. You have to be a sessioned
 * user for it to work - posting the payment data
 * @author jchapa
 *
 */
class RegisterRegistrationAPIPage extends BaseAPIPage
{
    public function __construct()
    {
        // We construct the parent first to get our args
        parent::__construct();

        // Check that we have the correct parameters
        if (empty($this->aArgs["ids"]) && 1==2)
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
        /* We have a couple steps in this workflow
         * 0) Submit registration with pending flag (stop if this fails - don't charge card)
         * 1) Attempt to process payment
         * 1.1) If Payment Fails: Send validation message - don't persist
         * 1.2) If Payment Succeeds: Update pending flag, tell user you love him
        */ 
        if (!$this->bIsError)
        {
            // Get our registration object all put together
            $oRegistration = new Registration();
            $oRegistration->oFamily = new Family();
            $oRegistration->oPayment = new Payment();
            $oRegistration->oCoupon = new Coupon();
            
            $dPrice = '0.00';

            // First get the session data (from the first page)
            LoadSession();
            // Now let's populate that session
            $strPersonalFormKey = "PERSONAL";
            $aPersonalSession = GetFormSessionData($strPersonalFormKey);

            // Registration Type and qty of attendees
            if ($aPersonalSession["registration-type"] === "family")
            {
                $oRegistration->strRegistrationType = "family";
                $oRegistration->iAttendeeNumber = 
                    $aPersonalSession["number-of-attendees"];
            }
            else
            {
                $oRegistration->strRegistrationType = "individual";
                $oRegistration->iAttendeeNumber = 1;
            }
            
            // What's it cost?
            if ($oRegistration->strRegistrationType === "individual")
            {
                $dPrice = '79.00';
            }
            else
            {
                $dPrice = '199.00';
            }

            // Who's Attending?

            $aAttendees = array();
            $strFirstNameKey= "FIRST";
            $strLastNameKey = "LAST";
            $strAgeKey = "AGE";
            foreach ($aPersonalSession as $strPKey => $strPVal)
            {
                if (false !== strpos($strPKey, "person-name-first-"))
                {
                    // Grab the last two chars for the id ('tis zero padded)
                    $strAttendeeId = substr($strPKey, strlen($strPKey) - 2, 2);
                    $aAttendees[$strAttendeeId][$strFirstNameKey] = $strPVal;
                }
                if (false !== strpos($strPKey, "person-name-last-"))
                {
                    // Grab the last two chars for the id ('tis zero padded)
                    $strAttendeeId = substr($strPKey, strlen($strPKey) - 2, 2);
                    $aAttendees[$strAttendeeId][$strLastNameKey] = $strPVal;
                    // Will end up getting the LAST last name in the list, which
                    // in 99% of cases will be correct. Easily fixed if needed. . .
                    $oRegistration->oFamily->strFamilyName = $strPVal;
                }
                if (false !== strpos($strPKey, "person-age-"))
                {
                    // Grab the last two chars for the id ('tis zero padded)
                    $strAttendeeId = substr($strPKey, strlen($strPKey) - 2, 2);
                    $aAttendees[$strAttendeeId][$strAgeKey] = $strPVal;
                }
            }
            
            foreach ($aAttendees as $aAttendee)
            {
                $oFamilyMember = new FamilyMember();
                $oFamilyMember->strFirstName = $aAttendee[$strFirstNameKey];
                $oFamilyMember->strLastName = $aAttendee[$strLastNameKey];
                $oFamilyMember->strAge = $aAttendee[$strAgeKey];
                $oFamilyMember->oFamily = $oRegistration->oFamily;
                $oRegistration->oFamily->AddFamilyMember($oFamilyMember);
                unset($oFamilyMember);
            }

            // Days Attending

            // Still waiting for this to be implemented. Cheeze for now
            $oRegistration->bAttendingSaturday = true;
            $oRegistration->bAttendingFriday = true;
            $oRegistration->bAttendingThursday = true;
            $oRegistration->bAttendingWednesday = true;
            
            // Address time!
            $oRegistration->strContactAddress1 = $aPersonalSession["street-1"];
            $oRegistration->strContactAddress2 = $aPersonalSession["street-2"];
            $oRegistration->strContactCity = $aPersonalSession["city"];
            $oRegistration->strContactState = $aPersonalSession["state"];
            $oRegistration->strContactZip = $aPersonalSession["zip"];
            $oRegistration->strContactPhone = $aPersonalSession["phone"];
            $oRegistration->strContactAltPhone = $aPersonalSession["alt-phone"];
            $oRegistration->strContactEmail = $aPersonalSession["email"];
            
            // Referrals
            $strReferrals = "";
            if (isset($aPersonalSession["radio"]))
                $strReferrals .= "generations radio, ";
            if (isset($aPersonalSession["website"]))
                $strReferrals .= "generations website/email, ";
            if (isset($aPersonalSession["chef"]))
                $strReferrals .= "chef, ";
            if (isset($aPersonalSession["friend"]))
                $strReferrals .= "friend/word of mouth, ";
            if (isset($aPersonalSession["chec"]))
                $strReferrals .= "chec magazine, ";
            // Still include a comma terminator to keep it consistant
            if (isset($aPersonalSession["other"]))
                $strReferrals .= "other, ";
            
            $oRegistration->strReferral = $strReferrals;
            unset($strReferrals);
            
            // Now let's look at the payment post (which is what's happening here)
            $aPaymentValues = $_REQUEST;
            
            // Don't waste their time, is there a coupon? Is it valid?
            $this->GetConnectionString();
            
            if (isset($aPaymentValues["referral"]) && !empty($aPaymentValues["referral"]))
            {
                $oCouponDataObject = new CouponDataObject(
                    $this->m_dbHost,
                    $this->m_dbName,
                    $this->m_dbUser,
                    $this->m_dbPass
                );
                $aCoupons = $oCouponDataObject->GetCouponList(0, 500);
                $iDiscount = 0;
                foreach ($aCoupons as $aCoupon)
                {
                    if ($aCoupon['code'] == $aPaymentValues["referral"])
                    {
                        if ($oRegistration->strRegistrationType == "family")
                        {
                            $iDiscount = $aCoupon["family_discount"];
                        }
                        else
                        {
                            $iDiscount = $aCoupon["individual_discount"];
                        }
                        // Hack our way to having a coupon object
                        $oRegistration->oCoupon->iCouponId = $aCoupon["coupon_id"];
                        $oRegistration->oCoupon->iStartDate = $aCoupon["start_date"];
                        $oRegistration->oCoupon->iEndDate = $aCoupon["end_date"];
                        $oRegistration->oCoupon->strName = $aCoupon["name"];
                        $oRegistration->oCoupon->strCode = $aCoupon["code"];
                    }
                }
                // If there is a coupon and it's invalid. . .
                if (!isset($oRegistration->oCoupon->iCouponId))
                {
                    // This'll teach them to send us a bad coupon
                    $strRetval = json_encode(array("result" => "4"));
                    $this->SendResponse($strRetval);
                    exit;
                }
            }
            // Else there's no coupon. Keep calm and carry on.
            
            /*
             * I should have data for
             * 1) Card Information (Name, number, etc)
             * 2) Billing Address (which just might be the same as contact info,
             *     but honeybadger don't care!)
             */
            
            // First, the billing information, because it's easier
            if (!isset($aPaymentValues["street-1"]))
            {
                // Inactive fields aren't posted!
                $oRegistration->strBillingAddress1 = $oRegistration->strContactAddress1;
                $oRegistration->strBillingAddress2 = $oRegistration->strContactAddress2;
                $oRegistration->strBillingCity = $oRegistration->strContactCity;
                $oRegistration->strBillingState = $oRegistration->strContactState;
                $oRegistration->strBillingZip = $oRegistration->strContactZip;
                $oRegistration->strBillingPhone = $oRegistration->strContactPhone;
                $oRegistration->strBillingAltPhone = $oRegistration->strContactAltPhone;
                $oRegistration->strBillingEmail = $oRegistration->strContactEmail;
            }
            else 
            {
                $oRegistration->strBillingAddress1 = $aPaymentValues["street-1"];
                $oRegistration->strBillingAddress2 = $aPaymentValues["street-2"];
                $oRegistration->strBillingCity = $aPaymentValues["city"];
                $oRegistration->strBillingState = $aPaymentValues["state"];
                $oRegistration->strBillingZip = $aPaymentValues["zip"];
                $oRegistration->strBillingPhone = $aPaymentValues["phone"];
                $oRegistration->strBillingAltPhone = $aPaymentValues["alt-phone"];
                $oRegistration->strBillingEmail = $aPaymentValues["email"];
            }
            
            
            // Get the payment info from the request.
            
            // Payment Info
            $oRegistration->oPayment->dAmount = 1.00;
            // UNCOMMENT THE TWO FOLLOWING LINES WHEN RELEASING
            //$oRegistration->oPayment->dAmount = $dPrice;
            //$oRegistration->oPayment->dAmount = $dPrice - $iDiscount;
            $strAuthNetTransKey = file_get_contents(dirname(__FILE__) . '/../../../config/auth_net_transaction_key.config');
            $strAuthNetTransId = file_get_contents(dirname(__FILE__) . '/../../../config/auth_net_transaction_id.config');
            
            $strCCExp = $aPaymentValues["month"] . "/" . $aPaymentValues["year"];
            
            // Time for payment information
            if (1==2)
            {
            $iPaymentFlag = $oRegistration->oPayment->ProcessTransaction(
                $oRegistration,
                $strAuthNetTransKey,
                $strAuthNetTransId,
                $aPaymentValues["card-name"],
                $aPaymentValues["card-number"],
                $strCCExp,
                $aPaymentValues["csc"]
                );
            }
            else
            {
                $iPaymentFlag = 1;
            }
            // Here we determine what happened, and output it.
            $strRetval = json_encode(array("result" => $iPaymentFlag));
            
            if ($iPaymentFlag == "1")
            {
                $oRegistration->oPayment->iPaymentStatus = 1;
            }
            else
            {
                $oRegistration->oPayment->iPaymentStatus = 0;
            }
            
            // Time to save the info in the database
            $oRegistrationDataContext = new RegistrationDataObject(
                $this->m_dbHost,
                $this->m_dbName,
                $this->m_dbUser,
                $this->m_dbPass
                );
            $oRegistrationDataContext->AddRegistration($oRegistration);
            
            if ($iPaymentFlag == "1")
            {
                $this->SendEmailConfirmations($oRegistration);
            }
            
            // Output the response
            $this->SendResponse($strRetval);
            //unset($stuff, $andThings);
            exit;
        }
    }
    protected function SendEmailConfirmations(Registration $oRegistration)
    {
        // time to send an email!
        
        /*
         * We send three confirmations
         * 1) to the registrant (with their contact email address)
         * 2) to the guy was paid for it (if different from registrant - yes, we're that cool)
         * 3) To the cool FEC people (jack, megan, chad at this point)
         */
        
        // First let's send the registration email(s)
        $bIncludePayment = true;
        if ($oRegistration->strBillingAddress1 != $oRegistration->strContactAddress1)
        {
            // Send diff conf email to biller
            $bIncludePayment = false;
        }
        $bRegEmail = $this->SendRegistrantEmail($oRegistration, $bIncludePayment);
    }
    
    private function SendRegistrantEmail(Registration $oRegistration, $bIncludePayment)
    {
        $strTo = $oRegistration->strContactEmail . ", registration@familyeconomics.com";
        $strHeaders = "From: Family Economics Registration <registration@familyeconomics.com> . \r\n";
        $strHeaders .= "Content-type: text/html\r\n";
        $strSubject = "Registration Confirmation - Family Economics 2013 - MO";
        $strRetval = $this->GetEmailHeader();
        $strRetval .= <<<EOF
        <h2 style="color:#00A9E9">Registration Confirmation</h2>
        <p>You are successfully registered for the 2013 Family Economics Conference!
        We look forward to having you join us in May as we cast a vision for 
        family economics.</p>
EOF;
        if ($bIncludePayment)
        {
            $strRetval .= $this->AddPaymentInfo($oRegistration);
        }
        else
        {
            $this->SendPaymentEmail($oRegistration);
        }
        
        if ($oRegistration->strRegistrationType == "individual")
        {
            $strRetval .= <<<EOF
        <p>We will have your name badge prepared. Here is how it will appear:</p>
EOF;
        }
        else 
        {
            $strRetval .= <<<EOF
        <p>We will have your name badges prepared for the following registrants:</p>
        <br />
EOF;
        }
        
        foreach ($oRegistration->oFamily->aFamilyMembers as $oFamilyM)
        {
            $strRetval .= <<<EOF
            <p>
            {$oFamilyM->strFirstName} {$oFamilyM->strLastName}
            </p>
EOF;
        }
        
        $strRetval .= <<<EOF
        <br />
        <p>Here is the contact information we have on file for you:</p>
        <p><strong>Email Address:</strong> {$oRegistration->strContactEmail}</p>
        <p><strong>Phone Number:</strong> {$oRegistration->strContactPhone}</p>
        <p><strong>Address:</strong> {$oRegistration->strContactAddress1}</p>
        <p><strong>Address+:</strong> {$oRegistration->strContactAddress2}</p>
        <p><strong>City:</strong> {$oRegistration->strContactCity}</p>
        <p><strong>State:</strong> {$oRegistration->strContactState}</p>
        <p><strong>Zip:</strong> {$oRegistration->strContactZip}</p>
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
    
    private function AddPaymentInfo(Registration $oRegistration)
    {
        return <<<EOF
        <p>Your card has been successfully charged &#36;{$oRegistration->oPayment->dAmount}</p>
EOF;
    }
    
    /**
     * We only send this if billing and shipping emails differ
     */
    private function SendPaymentEmail(Registration $oRegistration)
    {
        $strTo = $oRegistration->strBillingEmail . ", registration@familyeconomics.com";
        $strHeaders = "From: Family Economics Registration <registration@familyeconomics.com> . \r\n";
        $strHeaders .= "Content-type: text/html\r\n";
        $strSubject = "Registration Billing Confirmation - Family Economics 2013 - MO";
        $strRetval = $this->GetEmailHeader();
        $strRetval .= <<<EOF
        <h2 style="color:#00A9E9">Registration Billing Confirmation</h2>
        <p>Your registration payment for the 2013 Family Economics conference was successful</p>
        <p>This is not a registration confirmation - that will arrive in a separate email,
        as it was addressed on the first page of registration 
        (your billing email address may have been different)</p>
EOF;
        $strRetval .= $this->AddPaymentInfo($oRegistration);
        $strRetval .= $this->GetEmailFooter();
        // Mail it!
        mail ($strTo, $strSubject, $strRetval, $strHeaders);
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

$oPage = new RegisterRegistrationAPIPage();
$oPage->run();