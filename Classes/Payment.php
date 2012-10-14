<?php
require_once (dirname(__FILE__) . "/../Web/inc/authnet/AuthorizeNetAIM.php");

class Payment extends BaseClass
{
    // Pull in our objects
    protected $oFamily;

    // Pull in our scalars
    protected $iPaymentId;
    public $dAmount;
    public $iPaymentStatus;

    // These values are part of the object, but are never, ever, ever, ever, ever,
    // ever persisted - to session or mysql, or anywhere because some of them are 
    // illegal to store, and it's just not cool. We have these properties in here
    // to give us an object container to process CC transactions
    private $strCardName;
    private $strCardNumber;
    private $strCardExp;
    private $strCardCVV;

    const PAYMENT_STATUS_DECLINED = 2;
    const PAYMENT_STATUS_ERROR = 3;
    const PAYMENT_STATUS_SUCCESS = 1;
    const PAYMENT_STATUS_PENDING = 0;

    const AUTH_NET_TRANSACTION_ID = "";
    const AUTH_NET_TRANSACTION_KEY = "";
    
    // Auth net keys are defined in secure file (no push to public source control)

    public function __construct()
    {

    }

    private function CreateTransaction(
        $strCardName,
        $strCardNumber,
        $strCardExp,
        $strCardCVV
    )
    {
        $this->strCardName = $strCardName;
        $this->strCardNumber = $strCardNumber;
        $this->strCardExp = $strCardExp;
        $this->strCardCVV = $strCardCVV;
    }
    
    public function ProcessTransaction(
        Registration $oRegistration,
        $strAuthNetTransKey,
        $strAuthNetTransId,
        $strCardName,
        $strCardNumber,
        $strCardExp,
        $strCardCVV
        )
    {
        $this->CreateTransaction($strCardName, $strCardNumber, $strCardExp, $strCardCVV);
        
        $iRetval = $this->iPaymentStatus = self::PAYMENT_STATUS_PENDING;
        
        /*$oAuthNetAPI = new AuthorizeNetAIM($strAuthNetTransId, $strAuthNetTransKey);
        $aCardName = explode(' ', $this->strCardName);
        $strLastName = array_pop($aCardName);
        $strFirstName = implode(" ", $aCardName);
        $oAuthNetAPI->setFields(
            array(
            'amount' => '1', // Hard coded for now
            'card_num' => $this->strCardNumber,
            'exp_date' => $this->strCardExp,
            'first_name' => $strFirstName,
            'last_name' => $strLastName,
            'address' => $oRegistration->strBillingAddress1 . ' ' .
                $oRegistration->strBillingAddress2,
            'city' => $oRegistration->strBillingCity,
            'state' => $oRegistration->strBillingState,
            'zip' => $oRegistration->strBillingZip,
            'phone' => $oRegistration->strBillingPhone,
            'email' => $oRegistration->strBillingEmail,
            'invoice_num' => 'FEC2013-01', // We really need config. . .
            'tran_key' => $strAuthNetTransKey,
            'trans_id' => $strAuthNetTransId
            )
        );
        
        $oResponse= $oAuthNetAPI->authorizeAndCapture();
        if ($oResponse->approved)
        {
            $iRetval = $this->iPaymentStatus = self::PAYMENT_STATUS_SUCCESS;
        }
        else
        {
            // Something broke - we could add more statuses for reasons, though. . .
            $iRetval = $this->iPaymentStatus = self::PAYMENT_STATUS_DECLINED;
        }

        */
        $post_url = "https://secure.authorize.net/gateway/transact.dll";
        $strAuthNetTransId = trim($strAuthNetTransId);
        $strAuthNetTransKey = trim($strAuthNetTransKey);
        $aCardName = explode(' ', $this->strCardName);
        $strLastName = array_pop($aCardName);
        $strFirstName = implode(" ", $aCardName);
        $post_values = array(
        
                // the API Login ID and Transaction Key must be replaced with valid values
                "x_login"			=> $strAuthNetTransId,
                "x_tran_key"		=> $strAuthNetTransKey,
        
                "x_version"			=> "3.1",
                "x_delim_data"		=> "TRUE",
                "x_delim_char"		=> "|",
                "x_relay_response"	=> "FALSE",
        
                "x_type"			=> "AUTH_CAPTURE",
                "x_method"			=> "CC",
                "x_card_num"		=> $this->strCardNumber,
                "x_exp_date"		=> $this->strCardExp,
        
                "x_amount"			=> $this->dAmount,
                "x_invoice_num"		=> "FEC2012-01",
        
                "x_first_name"		=> $strFirstName,
                "x_last_name"		=> $strLastName,
                "x_address"			=> $oRegistration->strBillingAddress1 . " " . $oRegistration->strBillingAddress2,
                "x_city"            => $oRegistration->strBillingCity,
                "x_state"			=> $oRegistration->strBillingState,
                "x_zip"				=> $oRegistration->strBillingZip,
                "x_phone"           => $oRegistration->strBillingPhone,
                "x_email"           => $oRegistration->strBillingEmail
                // Additional fields can be added here as outlined in the AIM integration
                // guide at: http://developer.authorize.net
        );
        
        // This section takes the input fields and converts them to the proper format
        // for an http post.  For example: "x_login=username&x_tran_key=a1B2c3D4"
        $post_string = "";
        foreach( $post_values as $key => $value )
        {
            $post_string .= "$key=" . urlencode( $value ) . "&";
        }
        $post_string = rtrim( $post_string, "& " );
        
        // The following section provides an example of how to add line item details to
        // the post string.  Because line items may consist of multiple values with the
        // same key/name, they cannot be simply added into the above array.
        //
        // This section is commented out by default.
        /*
         $line_items = array(
                 "item1<|>golf balls<|><|>2<|>18.95<|>Y",
                 "item2<|>golf bag<|>Wilson golf carry bag, red<|>1<|>39.99<|>Y",
                 "item3<|>book<|>Golf for Dummies<|>1<|>21.99<|>Y");
        
        foreach( $line_items as $value )
        { $post_string .= "&x_line_item=" . urlencode( $value ); }
        */
        
        // This sample code uses the CURL library for php to establish a connection,
        // submit the post, and record the response.
        // If you receive an error, you may want to ensure that you have the curl
        // library enabled in your php configuration
        $request = curl_init(); // initiate curl object
        curl_setopt($request, CURLOPT_URL, $post_url);
        curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
        curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
        curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
        curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
        $post_response = curl_exec($request); // execute curl post and store results in $post_response
        // additional options may be required depending upon your server configuration
        // you can find documentation on curl options at http://www.php.net/curl_setopt
        curl_close ($request); // close curl object
        
        // This line takes the response and breaks it into an array using the specified delimiting character
        $response_array = explode($post_values["x_delim_char"],$post_response);
        $this->DestroyTransaction();
        //return $iRetval;
        return $post_response[0];
    }

    /**
     * Because we're paranoid
     */
    private function DestroyTransaction()
    {
        $this->strCardName = null;
        $this->strCardNumber = null;
        $this->strCardExp = null;
        $this->strCardCVV = null;
    }
    
    public function GetValuesArray()
    {
    
    }
}
