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

  <h2 class="entrytitle">May 2013 St. Louis Family Economics Registration</h2>
  <!-- Attendees -->
  <div id="content" class="column">

	  <h2>Thank You!</h2>
      <p>Your registration has been processed! If you do not receive a confirmation email,
      please contact us with your first and last name, along with your address.
      </p>
  </div>
  
  


<div id="sidebar" class="column">


</div><!--End #sidebar-->

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
