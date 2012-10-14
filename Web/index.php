<?php 
// Includes
require_once (dirname(__FILE__) . "/inc/session.form.func.inc");

//Debug - SET TO FALSE FOR PRODUCTION
$bDebug = true;

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

  <h2 class="entrytitle">2013 Family Economics Registration</h2>
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
        <fieldset id="registration-info-dds">
          <ul id="registration-setup">
            <li id="reg-type-li">
              <label for="registration-type">Registration Type</label>
              <select id="registration-type" name="registration-type">
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
                ?>
                >Family</option>
                <option value="individual"
                <?php 
                    if (isset($aPersonalFormSessionData["registration-type"]))
                    {
                        if ($aPersonalFormSessionData["registration-type"] === "individual")
                        {
                            echo "selected=\"selected\"";
                        }
                    }
                ?>
                >Individual</option>
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

       <h2>Attendee Information</h2>

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
         <span>OR</span><br />
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
       <h2>How Did You Hear About This Event</h2>
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
