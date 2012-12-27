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

  <h2 class="entrytitle">October 2013 Washington Family Economics</h2>
  <!-- Attendees -->
  <div id="content" class="column">
  
		
    <form id="billing-info" action="/washington/api/registration/register.php" class="fec-form">
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
                        echo "$119";
                    }
                    else
                    {
                        echo "$45";
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
<li><a href="http://www.facebook.com/events/194482497347433/?ref=ts" onclick="javascript:_gaq.push(['_trackEvent','outbound-widget','http://www.facebook.com']);">Facebook</a></li>
<a href="https://twitter.com/share" onclick="javascript:_gaq.push(['_trackEvent','outbound-widget','http://twitter.com']);" class="twitter-share-button" data-url="http://www.familyeconomics.com/" data-text="Twitter" data-count="none">Tweet</a>
<script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
</ul><!--End #social-->
<a href="http://www.familyeconomics.com/conference/help-spread-the-word/" >Conference Graphics and Flyers</a></div>
		</li><li id="text-6" class="widget-container widget_text"><h5 class="widget-title">The Vision</h5>			<div class="textwidget"><p><a href="https://www.familyeconomics.com/vision/" >A Taste of the Vision</a><br />
<a href="https://www.familyeconomics.com/history/" >History</a><br />
<a href="https://www.familyeconomics.com/143-2/meet-the-families/" >Meet the Families</a></p>
</div>
		</li><li id="text-5" class="widget-container widget_text"><h5 class="widget-title">Contact Us</h5>			<div class="textwidget"><a href="http://www.familyeconomics.com/contact-us/" >Contact Us</a></div>
		</li>					</ul><!--End .widgets-->

					<ul class="widgets column">
						<li id="pages-3" class="widget-container widget_pages"><h5 class="widget-title">MO Conference</h5>		<ul>
			<li class="page_item page-item-4"><a href="https://www.familyeconomics.com/vision/">Vision</a></li>
<li class="page_item page-item-8"><a href="https://www.familyeconomics.com/history/">History</a></li>
<li class="page_item page-item-63"><a href="https://www.familyeconomics.com/conference/stlouis/">St. Louis Conference</a></li>
<li class="page_item page-item-231"><a href="https://www.familyeconomics.com/conference/stlouis/registration-2/">Registration Information</a></li>
<li class="page_item page-item-147"><a href="https://www.familyeconomics.com/conference/stlouis/speakers/">Speakers</a></li>
<li class="page_item page-item-184"><a href="https://www.familyeconomics.com/conference/stlouis/facility-accommodations/">Facility/Accommodations</a></li>
<li class="page_item page-item-206"><a href="https://www.familyeconomics.com/conference/stlouis/schedule/">Schedule</a></li>
<li class="page_item page-item-252"><a href="https://www.familyeconomics.com/conference/stlouis/travel-and-dining/">Travel and Dining</a></li>
<li class="page_item page-item-289"><a href="https://www.familyeconomics.com/conference/stlouis/area-attractions/">Area Attractions</a></li>
<li class="page_item page-item-491"><a href="https://www.familyeconomics.com/conference/stlouis/vendors/">Vendors</a></li>
<li class="page_item page-item-257"><a href="https://www.familyeconomics.com/conference/stlouis/sponsors/">Sponsors</a></li>
		</ul>
		</li>					</ul><!--End .widgets-->

					<ul class="widgets column">
						<li id="nav_menu-2" class="widget-container widget_nav_menu"><h5 class="widget-title">WA Conference</h5><div class="menu-washington-side-menu-container"><ul id="menu-washington-side-menu" class="menu"><li id="menu-item-704" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-704"><a href="https://www.familyeconomics.com/conference/washington/" >Washington Conference</a></li>
<li id="menu-item-734" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-734"><a href="https://www.familyeconomics.com/history/" >History</a></li>
<li id="menu-item-735" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-735"><a href="https://www.familyeconomics.com/vision/" >Vision</a></li>
<li id="menu-item-732" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-732"><a href="https://www.familyeconomics.com/conference/washington/washingto-speakers/" >Speakers</a></li>
<li id="menu-item-731" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-731"><a href="https://www.familyeconomics.com/conference/washington/washington-facility-and-accomodations/" >Facility and Accomodations</a></li>
<li id="menu-item-730" class="menu-item menu-item-type-post_type menu-item-object-page menu-item-730"><a href="https://www.familyeconomics.com/washington-travel-and-dining/" >Travel and Dining</a></li>
</ul></div></li>					</ul><!--End .widgets-->
</div><!--End #footer-container-->

</div><!--End #footer-->

<?php

//Header Include
require_once (dirname(__FILE__) . "/inc/footer.inc");

//Begin Body

?>
