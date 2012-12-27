<?php 
// Includes
require_once (dirname(__FILE__) . "/inc/session.form.func.inc");

//Debug - SET TO FALSE FOR PRODUCTION
$bDebug = false;

// First let's kick off our session
LoadSession();

// Setup our vars (should eventually load from config/randomize itself)
$strPersonalFormKey = "PERSONAL";

// Let's get any current session info
$aPersonalFormSessionData = GetFormSessionData($strPersonalFormKey);

?>

<?php

//Header Include
require_once (dirname(__FILE__) . "/inc/header.inc");

//Begin Body

?>
<script type="text/javascript" src="scripts/functions.js"></script>

<?php 
if ($bDebug)
{
    echo var_dump($aPersonalFormSessionData);
}
?>

<input type="hidden" id="wizardry" 
<?php
if (isset($aPersonalFormSessionData["registration-type"]))
{
    echo 'value="bam"';
}
?>
/>
<div id="header">
	<div id="header-container">
	   <a href="http://www.familyeconomics.com/"><div id="logo"></div></a><!--End #logo-->

	<div id="nav">
	 <div class="menu"><ul><li ><a href="http://www.familyeconomics.com/" title="Home">Home</a></li><li class="page_item page-item-4"><a href="http://www.familyeconomics.com/vision/">Vision</a></li><li class="page_item page-item-8"><a href="http://www.familyeconomics.com/history/">History</a></li><li class="page_item page-item-63"><a href="http://www.familyeconomics.com/conference/">Conference</a></li><li class="page_item page-item-22"><a href="http://www.familyeconomics.com/meet-the-families/">Meet the Families</a></li><li class="page_item page-item-257"><a href="http://www.familyeconomics.com/sponsors/">Sponsors</a></li></ul></div>
    </div><!--End #nav-->

	</div><!--End #header-container-->
</div><!--End #header-->

<div id="container">

  <h2 class="entrytitle">May 2013 St. Louis Family Economics Registration</h2>
  <!-- Attendees -->
  <div id="content" class="column">

	  <h2>Registration Type</h2>

    <form action="payment.php" id="registration-details" class="fec-form">
     <input type="hidden" value="
     <?php 
		    if (isset($aPersonalFormSessionData['registration-type']))
				{
					if ($aPersonalFormSessionData['registration-type'] = 2)
					{
						echo $aPersonalFormSessionData['number-of-attendees'];
					} else {
						echo 1;
					}
				} else {
					echo "";
				}
				?>
       " id="attendee-num-var" />
      <div id="registration-info-types">
       <div style="clear:both; margin-top:20px; margin-bottom:10px">
                  <span>
                      <strong>Family Rate</strong> (includes immediate family): 
                      <span style="text-decoration:line-through">Regular Price: $299</span> Early Bird Discount: $199
                  </span>
                  <br />
                  <span>
                      <strong>Individual Rate</strong>: 
                      <span style="text-decoration:line-through">Regular Price: $109</span> Early Bird Discount: $89
                  </span>
              </div>
        <fieldset id="registration-info-dds">
          <ul id="registration-setup">
            <li style="clear:both">
             
            </li>
            <li id="reg-type-li">
              <label for="registration-type">Registration Type</label>
              <select id="registration-type" name="registration-type"
				style="clear: both">
					<option value="0">- Please Select -</option>
					<option value="family"
					<?php
					if (isset($aPersonalFormSessionData["registration-type"]))
					{
					    if ($aPersonalFormSessionData["registration-type"] === "family")
					    {
					        echo "selected=\"selected\"";
					    }
					}
					?>>Family</option>
					<option value="individual"
					<?php
					if (isset($aPersonalFormSessionData["registration-type"]))
					{
					    if ($aPersonalFormSessionData["registration-type"] === "individual")
					    {
					        echo "selected=\"selected\"";
					    }
					}
					?>>Individual</option>
			</select>
				<div id="reg-detail" title="Family Rate includes immediate family" class="target"><span>?</span></div>
            </li>

            <li id="attendee-num-li">
              <label for="number-of-attendees">Number of Attendees:</label>
              <select id="number-of-attendees" name="number-of-attendees">
                <option value="">- Please Select -</option>
                <?php 
                    for ($i = 1; $i<=20; $i++)
                    {
                        $strOptionContent = '<option value="'. $i . '"';
                        if ($aPersonalFormSessionData["number-of-attendees"] ==
                               $i
                           )
                        {
                            $strOptionContent .= ' selected="selected"';
                        }
                        $strOptionContent .= '>' . $i . '</option>';
                        echo $strOptionContent;
                        $strOptionContent = "";
                    }
                ?>
              </select>
            </li>
          </ul>
        </fieldset>

        <fieldset id="registration-pricing">
          <span class="regular-price"></span>
          <span class="early-pricing"></span> 
        </fieldset>
       <h2 style="clear:both;">Attendee Information</h2>

       <fieldset id="person-information">
         <ul id="person-information-list">
         </ul>
       </fieldset>

       <fieldset id="person-summary">
         <span id="attendee-total">
         </span>
         <span id="registration-total">
         </span>
         <p>Reminder:  The Family Economics 2013 Mega Conference is a single event 
            co-hosted by both Generations with Vision and CHEF of Missouri. 
            Registration for this event covers the full 4-day admission and is 
            not available separately.</p>
       </fieldset>

       <fieldset>
         <h2>Let Us Know When You Will Be There!</h2>
         <input type="checkbox" name="all-days" id="all-days" value="all" 
         <?php
             if ($aPersonalFormSessionData["select-days"] == "all-days")
             {
                 echo "checked=\"checked\"";
             }
         ?>
         /> I plan to attend all four days <br />
         <span>OR (check all that apply)</span><br />
         <input type="checkbox" name="select-days" class="select-days" value="weds" 
         <?php
             if (false !== strpos($aPersonalFormSessionData["select-days"], "weds"))
             {
                 echo "checked=\"checked\"";
             }
         ?>
         /> I plan to attend Wednesday <br />
         <input type="checkbox" name="select-days" class="select-days" value="thurs" 
         <?php
             if (false !== strpos($aPersonalFormSessionData["select-days"], "thurs"))
             {
                 echo "checked=\"checked\"";
             }
         ?>
         /> I plan to attend Thursday <br />
         <input type="checkbox" name="select-days" class="select-days" value="fri" 
         <?php
             if (false !== strpos($aPersonalFormSessionData["select-days"], "fri"))
             {
                 echo "checked=\"checked\"";
             }
         ?>
         /> I plan to attend Friday <br />
         <input type="checkbox" name="select-days" class="select-days" value="sat" 
         <?php
             if (false !== strpos($aPersonalFormSessionData["select-days"], "sat"))
             {
                 echo "checked=\"checked\"";
             }
         ?>
         /> I plan to attend Saturday <br />
         <br />
         <input type="checkbox" name="worship" value="sun" 
         <?php
             if (isset($aPersonalFormSessionData["worship"]))
             {
                 echo "checked=\"checked\"";
             }
         ?>
         /> I plan to join Kevin Swanson and Reformation Church at the St. Charles Convention Center for worship on Sunday morning following the conference.
       </fieldset>

       <fieldset id="contact-info">
         <h2>Contact Information</h2>
         <ul>
            <li>
              <label for="street-1">Address 1</label>
              <input type="text" id="street-1" name="street-1" 
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
              <input type="text" id="street-2" name="street-2" 
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
              <input type="text" id="city" name="city" 
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
              <input type="text" id="state" name="state" 
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
              <input type="text" id="zip" name="zip" 
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
              <input type="text" id="phone" name="phone" 
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
              <input type="text" id="alt-phone" name="alt-phone" 
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
              <input type="text" id="email" name="email" 
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

       <fieldset id="reference">
       <h2>How Did You Hear About This Event?</h2>
         <ul>
         	<li>
            <input type="checkbox" class="reference-cbox"  id="radio" value="radio" name="radio" 
            <?php
                  if (isset($aPersonalFormSessionData["radio"]))
                  {
                      echo 'checked="checked"';
                  }
              ?>
            /> Generations Radio
          </li>
         	<li>
            <input type="checkbox" class="reference-cbox"  id="website" value="website" name="website" 
            <?php
                  if (isset($aPersonalFormSessionData["website"]))
                  {
                      echo 'checked="checked"';
                  }
              ?>
            /> Generations Website/Email
          </li>
         	<li>
            <input type="checkbox" class="reference-cbox"  id="chef" value="chef" name="chef" 
            <?php
                  if (isset($aPersonalFormSessionData["chef"]))
                  {
                      echo 'checked="checked"';
                  }
              ?>
            /> CHEF
          </li>
         	<li>
            <input type="checkbox" class="reference-cbox"  id="friend" value="friend" name="friend" 
            <?php
                  if (isset($aPersonalFormSessionData["friend"]))
                  {
                      echo 'checked="checked"';
                  }
              ?>
            /> Friend/Word of Mouth
          </li>
         	<li>
            <input type="checkbox" class="reference-cbox"  id="sermon" value="sermon" name="sermon" 
            <?php
                  if (isset($aPersonalFormSessionData["sermon"]))
                  {
                      echo 'checked="checked"';
                  }
              ?>
            /> Sermon Audio
          </li>
         	<li>
            <input type="checkbox" class="reference-cbox"  id="chec" value="chec" name="chec" 
            <?php
                  if (isset($aPersonalFormSessionData["chec"]))
                  {
                      echo 'checked="checked"';
                  }
              ?>
            /> CHEC magazine
          </li>
         	<li>
            <input type="checkbox" class="reference-cbox"  id="other" value="other" name="other" 
            <?php
                  if (isset($aPersonalFormSessionData["other"]))
                  {
                      echo 'checked="checked"';
                  }
              ?>
            /> Other <input type="text" id="other-text" name="other-text" disabled="true" 
            <?php
                  if (isset($aPersonalFormSessionData["value"]))
                  {
                      echo 'value="' . $aPersonalFormSessionData["value"] . '"';
                  }
              ?>
            />
          </li>
         </ul>
       </fieldset>

       <fieldset id="submit">
         <input type="submit" id="btnSubmit" style="cursor:pointer;" value="Continue" />
       </fieldset>
      </div>
    </form>
  </div>
  
  


<div id="sidebar" class="column">

<ul class="widgets">

<li id="pages-2" class="widget-container widget_pages"><h5 class="widget-title"> </h5>		<ul>
<li class="current_page_item"><a href="index.php">Information</a></li>
<li class=""><a href="payment.php">Payment</a></li>
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
