<?php
// Includes
require_once (dirname(__FILE__) . "/inc/session.form.func.inc");
require_once (dirname(__FILE__) . "/inc/form.personal.func.inc");

$strPersonalFormKey = "PERSONAL";
$strPaymentFormKey = "PAYMENT";
$strPaymentStatusDeclined = 2;
$strPaymentStatusError = 3;
$strPaymentStatusSuccess = 1;
$strPaymentStatusPending = 0;

// Pickup our session
$bSessionStarted = LoadSession();

if (!$bSessionStarted)
{
    // We shouldn't be here! We don't have a session yet
    header("location:index.php");
}

// We need to create the session from the info that was posted to us
ProcessPersonalForm($strPersonalFormKey);

$aPersonalFormSessionData = GetFormSessionData($strPersonalFormKey);

?>

<?php

//Header Include
require_once (dirname(__FILE__) . "/inc/header.inc");

//Begin Body

?>

<script type="text/javascript" src="scripts/payment-functions.js"></script>

<?php 
//echo var_dump($_SESSION);
?>
<div id="header">
	<div id="header-container">
	   <a href="http://www.familyeconomics.com/"><div id="logo"></div></a><!--End #logo-->
	
	<div id="nav">
	 <div class="menu"><ul><li ><a href="http://www.familyeconomics.com/" title="Home">Home</a></li><li class="page_item page-item-4"><a href="http://www.familyeconomics.com/vision/">Vision</a></li><li class="page_item page-item-8"><a href="http://www.familyeconomics.com/history/">History</a></li><li class="page_item page-item-63"><a href="http://www.familyeconomics.com/conference/">Conference</a></li><li class="page_item page-item-22"><a href="http://www.familyeconomics.com/meet-the-families/">Meet the Families</a></li><li class="page_item page-item-257"><a href="http://www.familyeconomics.com/sponsors/">Sponsors</a></li></ul></div>
    </div><!--End #nav-->	

	</div><!--End #header-container-->
</div><!--End #header-->


<div id="container">

  <h2 class="entrytitle">2013 Family Economics Registration</h2>
  <!-- Attendees -->
  <div id="content" class="column">
  
		
    <form id="billing-info" action="/api/registration/register.php" class="fec-form">
       <fieldset id="contact-info">
         <h2>Billing Information</h2>
         <ul>
            <li>
              <label for="card-name">Name on Card:</label>
              <input type="text" id="card-name" name="card-name" />
            </li>
            
            </li>
            
            <li id="same-as-contact-li">
            <!-- If this button works, go hug the nearest developer -->
             <input type="checkbox" name="same-as-contact" id="same-as-contact" value="weds"/> <span id="same-as-contact-label">Same as Contact Information <br /></span>
						</li>
            
            <li>
              <label for="street-1">Address 1</label>
              <input type="text" class="contact-duplicate" id="street-1" name="street-1" 
              <?php
                  if (isset($aPersonalFormSessionData["street-1"]))
                  {
                      echo "value=\"" . $aPersonalFormSessionData["street-1"] . "\"";
                  }
              ?>
               />
            </li>
            <li>
              <label for="street-2">Address 2</label>
              <input type="text" class="contact-duplicate" id="street-2" name="street-2" 
              <?php
                  if (isset($aPersonalFormSessionData["street-2"]))
                  {
                      echo "value=\"" . $aPersonalFormSessionData["street-2"] . "\"";
                  }
              ?>
              />
            </li>
            <li class="city">
              <label for="city">City</label>
              <input type="text" class="contact-duplicate" id="city" name="city" 
              <?php
                  if (isset($aPersonalFormSessionData["city"]))
                  {
                      echo "value=\"" . $aPersonalFormSessionData["city"] . "\"";
                  }
              ?>
              />
            </li>
            <li class="state">
              <label for="state">State</label>
              <input type="text" class="contact-duplicate" id="state" name="state" 
              <?php
                  if (isset($aPersonalFormSessionData["state"]))
                  {
                      echo "value=\"" . $aPersonalFormSessionData["state"] . "\"";
                  }
              ?>
              />
            </li>
            <li class="zip">
              <label for="zip">Zip</label>
              <input type="text" class="contact-duplicate" id="zip" name="zip" 
              <?php
                  if (isset($aPersonalFormSessionData["zip"]))
                  {
                      echo "value=\"" . $aPersonalFormSessionData["zip"] . "\"";
                  }
              ?>
              />
            </li>
            <li>
              <label for="phone">Phone</label>
              <input type="text" class="contact-duplicate" id="phone" name="phone" 
              <?php
                  if (isset($aPersonalFormSessionData["phone"]))
                  {
                      echo "value=\"" . $aPersonalFormSessionData["phone"] . "\"";
                  }
              ?>
              />
            </li>
            <li>
              <label for="alt-phone">Alternate Phone</label>
              <input type="text" class="contact-duplicate" id="alt-phone" name="alt-phone" 
              <?php
                  if (isset($aPersonalFormSessionData["alt-phone"]))
                  {
                      echo "value=\"" . $aPersonalFormSessionData["alt-phone"] . "\"";
                  }
              ?>
              />
            </li>
            <li>
              <label for="email">Email Address</label>
              <input type="text" class="contact-duplicate" id="email" name="email" 
              <?php
                  if (isset($aPersonalFormSessionData["email"]))
                  {
                      echo "value=\"" . $aPersonalFormSessionData["email"] . "\"";
                  }
              ?>
              />
            </li>
         </ul>

       </fieldset>

       <fieldset id="payment-info">
         <h2>Payment Information</h2>

          <ul> 
            <li>
              <label for="card-type">Card Type</label>
              <select id="card-type" name="card-type">
                <option value="amex">American Express</option>
                <option value="discover">Discover</option>
                <option value="mastercard">MasterCard</option>
                <option value="visa">Visa</option>
              </select>
            </li>

            <li>
              <label for="card-number">Card Number</label>
              <input type="text" id="card-number" name="card-number" />
            </li>

            <li class="year">
              <label for="month">Expiration:</label>
              <select id="month" name="month">
                <option value="01">01 - Jan</option>
                <option value="02">02 - Feb</option>
                <option value="03">03 - Mar</option>
                <option value="04">04 - Apr</option>
                <option value="05">05 - May</option>
                <option value="06">06 - Jun</option>
                <option value="07">07 - Jul</option>
                <option value="08">08 - Aug</option>
                <option value="09">09 - Sep</option>
                <option value="10">10 - Oct</option>
                <option value="11">11 - Nov</option>
                <option value="12">12 - Dec</option>
              </select>
              <input type="text" id="name" name="year" /> (YY) <!-- that's right - only 2 numbers -->
            </li>
            <li class="zip">
              <label for="csc">Security Code</label>
              <input type="text" id="csc" name="csc" />
            </li>
            
            <li>
              <label for="coupon">Referral Code (will be automatically applied after clicking "Process Registration" button below)</label>
              <input type="text" id="referral" name="referral" />
            </li>
            
         </ul>
       </fieldset>
               <fieldset id="contact-info">
            <h2>Registration Summary</h2>
            <p><strong>Registration Type: </strong>
            <?php 
                if (isset($aPersonalFormSessionData["registration-type"]))
                {
                    if ($aPersonalFormSessionData["registration-type"] === "family")
                    {
                        echo "Family";
                    }
                    else
                    {
                        echo "Individual";
                    }
                }
            ?>
            </p>
            <p><strong>Number of Attendees: </strong>
            <?php 
                if (isset($aPersonalFormSessionData["number-of-attendees"]) && !empty($aPersonalFormSessionData["number-of-attendees"]))
                {
                    echo $aPersonalFormSessionData["number-of-attendees"];
                }
                else
                {
                    echo "1";
                }
            ?>
            </p>
            <p><strong>Registration Cost (any referral codes are not reflected in this total): </strong>
            <?php 
                if (isset($aPersonalFormSessionData["registration-type"]))
                {
                    if ($aPersonalFormSessionData["registration-type"] === "family")
                    {
                        echo "$299";
                    }
                    else
                    {
                        echo "$109";
                    }
                }
            ?>
            </p>
        </fieldset>
       <fieldset id="submit">
         <input type="submit" id="btnSubmit" style="cursor:pointer;" value="Process Registration" /> (We will try to charge your card)
       </fieldset>
    </form>
  </div>

<div id="sidebar" class="column">

<ul class="widgets">

<li id="pages-2" class="widget-container widget_pages"><h5 class="widget-title"> </h5>		<ul>
<li><a href="index.php">Information</a></li>
<li class="current_page_item"><a href="payment.php">Payment</a></li>
		</ul>
		</li>
</ul><!--End .widgets-->

</div><!--End #sidebar-->

  <div id="error-container">
           <div id="error-label-container"></div>
  </div>
     
<br class="clearit">


</div><!--End #container-->

 
<div class="signup-slide">
<a class="trigger" href="#"><h5>Newsletter Signup</h5></a>
</div><!--End .signup-slide-->  

<div id="footer">
<div id="footer-container">



					
					<ul class="widgets column">
						<li id="text-2" class="widget-container widget_text"><h5 class="widget-title">Spread the Word</h5>			<div class="textwidget"><ul id="social">
<li>Facebook</li>
<li>Twitter</li>
<li>Email</li>
</ul><!--End #social--></div>
		</li>					</ul><!--End .widgets-->

					<ul class="widgets column">
						<li id="pages-3" class="widget-container widget_pages"><h5 class="widget-title">Info</h5>		<ul>
			<li class="page_item page-item-63"><a href="http://www.familyeconomics.com/conference/">Conference</a></li>
<li class="page_item page-item-184 current_page_item"><a href="http://www.familyeconomics.com/facility-accommodations/">Facility/Accommodations</a></li>
<li class="page_item page-item-8"><a href="http://www.familyeconomics.com/history/">History</a></li>
<li class="page_item page-item-206"><a href="http://www.familyeconomics.com/schedule/">Schedule</a></li>
<li class="page_item page-item-147"><a href="http://www.familyeconomics.com/speakers/">Speakers</a></li>
<li class="page_item page-item-257"><a href="http://www.familyeconomics.com/sponsors/">Sponsors</a></li>
<li class="page_item page-item-4"><a href="http://www.familyeconomics.com/vision/">Vision</a></li>
		</ul>
		</li>					</ul><!--End .widgets-->

					<ul class="widgets column">
						<li id="text-3" class="widget-container widget_text"><h5 class="widget-title">Registration</h5>			<div class="textwidget">Registration information coming soon.
</div>
		</li>					</ul><!--End .widgets-->
</div><!--End #footer-container-->

</div><!--End #footer-->

<?php

//Header Include
require_once (dirname(__FILE__) . "/inc/footer.inc");

//Begin Body

?>
