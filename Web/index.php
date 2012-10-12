<?php 
// Includes
require_once (dirname(__FILE__) . "/inc/session.form.func.inc");
// First let's kick off our session
LoadSession();

// Setup our vars
$strPersonalFormKey = "PERSONAL";

// Let's get any current session info
$aPersonalFormSessionData = GetFormSessionData($strPersonalFormKey);

?>

<!DOCTYPE html>
<html dir="ltr" lang="en-US">
<head>
<meta charset="UTF-8" />

<title>Register for the Conference! | Family Economics</title>
	
<link rel="profile" href="http://gmpg.org/xfn/11" />


<link rel="stylesheet" type="text/css" media="all" href="styles/mainstyles.css" />
<link rel="icon" href="http://www.familyeconomics.com/wp-content/themes/family-economics/images/favicon.png" type="image/png">

<script src="http://www.familyeconomics.com/wp-content/themes/family-economics/js/jquery.js" type="text/javascript"></script>
<script src="http://www.familyeconomics.com/wp-content/themes/family-economics/js/main.js" type="text/javascript"></script>
<script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.9/jquery.validate.min.js"></script>
<script src="http://malsup.github.com/jquery.form.js"></script>
<script src="scripts/jquery.easing.1.3.js"></script>
<script src="scripts/stickysidebar.jquery.min.js"></script>

<link rel="pingback" href="http://www.familyeconomics.com/xmlrpc.php" />

<meta name='robots' content='noindex,nofollow' />
<link rel="alternate" type="application/rss+xml" title="Family Economics &raquo; Feed" href="http://www.familyeconomics.com/feed/" />
<link rel="alternate" type="application/rss+xml" title="Family Economics &raquo; Comments Feed" href="http://www.familyeconomics.com/comments/feed/" />
<link rel='stylesheet' id='admin-bar-css'  href='http://www.familyeconomics.com/wp-includes/css/admin-bar.css?ver=3.4.2' type='text/css' media='all' />
<link rel="EditURI" type="application/rsd+xml" title="RSD" href="http://www.familyeconomics.com/xmlrpc.php?rsd" />
<link rel="wlwmanifest" type="application/wlwmanifest+xml" href="http://www.familyeconomics.com/wp-includes/wlwmanifest.xml" /> 
<link rel='prev' title='Speakers' href='http://www.familyeconomics.com/speakers/' />
<link rel='next' title='Schedule' href='http://www.familyeconomics.com/schedule/' />
<meta name="generator" content="WordPress 3.4.2" />
<link rel='canonical' href='http://www.familyeconomics.com/facility-accommodations/' />

<script type="text/javascript" src="scripts/functions.js"></script>

</head>

<body>
<?php 
echo var_dump($aPersonalFormSessionData);
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

      <div id="registration-info-types">
        <fieldset id="registration-info-dds">
          <ul id="registration-setup">
            <li id="reg-type-li">
              <label for="registration-type">Registration Type</label>
              <select id="registration-type" name="registration-type">
                <option value="0">- Please Select -</option>
                <option value="family"
                <?php 
                    if (isset($aFormSessionData["registration-type"]))
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
                    if (isset($aFormSessionData["registration-type"]))
                    {
                        if ($aPersonalFormSessionData["registration-type"] === "individual")
                        {
                            echo "selected=\"selected\"";
                        }
                    }
                ?>
                >Individual</option>
              </select>
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
         <p>Reminder:  The Family Economics 2013 Mega Conference is a single event co-hosted by both Generations with Vision and CHEF of Missouri.  Registration for this event covers the full 4-day admission and is not available separately.</p>
       </fieldset>

       <fieldset>
         <h2>Let Us Know When You'll Be There!</h2>
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

<div id="signup-form">
 
<div id="form-container">  
  
<form action="http://generationswithvision.us2.list-manage1.com/subscribe/post" method="POST">
<input type="hidden" name="u" value="641279d927137eec6730e767f">
<input type="hidden" name="id" value="ae104eb7d4">

<div id="mergeTable" class="mergeTable">

<ul id="form">  

<li>
<div class="mergeRow dojoDndItem mergeRow-email" id="mergeRow-0">

<label for="MERGE0"><strong>Email Address</strong> <span class="asterisk">*</span></label>
<div class="field-group">
    <input type="email" autocapitalize="off" autocorrect="off" name="MERGE0" id="MERGE0" size="25" value="">
</div><!--End .field-group-->
</div><!--End #mergeRow-->
  </li>

<li>
<div class="mergeRow dojoDndItem mergeRow-text" id="mergeRow-1">
<label for="MERGE1">First Name</label>
<div class="field-group">
    <input type="text" name="MERGE1" id="MERGE1" size="25" value="">
</div><!--End .field-group-->
</div><!--End #mergeRow-->
  </li>

<li>
<div class="mergeRow dojoDndItem mergeRow-text" id="mergeRow-2">
<label for="MERGE2">Last Name</label>
<div class="field-group">
    <input type="text" name="MERGE2" id="MERGE2" size="25" value="">
</div><!--End .field-group-->
</div><!--End #mergeRow-->
  </li>


<li>
<div class="mergeRow dojoDndItem mergeRow-text" id="mergeRow-4">
<label for="MERGE4">Address</label>
<div class="field-group">
    <input type="text" name="MERGE4" id="MERGE4" size="25" value="">
</div><!--End .field-group-->
</div><!--End #mergeRow-->
  </li>

<li>
<div class="mergeRow dojoDndItem mergeRow-text" id="mergeRow-3">
<label for="MERGE3">City</label>
<div class="field-group">
    <input type="text" name="MERGE3" id="MERGE3" size="25" value="">
</div><!--End .field-group-->
</div><!--End #mergeRow-->
  </li>

<li>
<div class="mergeRow dojoDndItem mergeRow-text" id="mergeRow-6">
<label for="MERGE6">State</label>
<div class="field-group">
    <input type="text" name="MERGE6" id="MERGE6" size="25" value="">
</div><!--End .field-group-->
</div><!--End #mergeRow-->
  </li>
  
  
<li>
<div class="mergeRow dojoDndItem mergeRow-text" id="mergeRow-7">
<label for="MERGE7">Zip</label>
<div class="field-group">
    <input type="text" name="MERGE7" id="MERGE7" size="25" value="">
</div><!--End .field-group-->
</div><!--End #mergeRow-->
 </li>
  
  
<li>
<div id="interestTable">
    
<div id="mergeRow-100-7393" class="mergeRow dojoDndItem mergeRowHidden mergeRow-interests-hidden" style="display:none;">
			<label>Referred by</label>
	        <div class="field-group groups">
<ul class="interestgroup_field" id="interestgroup_field_455445"><li class="interestgroup_row"><input type="checkbox" id="group_1" name="group[7393][1]" value="1">&nbsp;<label for="group_1">hslda</label></li><li class="interestgroup_row"><input type="checkbox" id="group_2" name="group[7393][2]" value="1">&nbsp;<label for="group_2">wnd</label></li></ul>
            </div><!--End .field-group-->

</div><!--End #mergeRow-100-7393-->
</div><!--End #interestTable-->
  </li>    

<br>


<div class="submit_container">
<input type="submit" class="button" name="submit" value="Subscribe to list">
</div><!--End #submit_container-->
 
</div><!--End #mergeTable-->
</ul><!--End #form-->

</form>


</div><!--End #form-container-->
</div><!--End #signup-form-->


		
</body>
</html>