<?php
// Includes
require_once (dirname(__FILE__) . "/inc/session.form.func.inc");
require_once (dirname(__FILE__) . "/inc/form.personal.func.inc");

$strPersonalFormKey = "PERSONAL";
$strPaymentFormKey = "PAYMENT";

// Pickup our session
$bSessionStarted = LoadSession();

if (!$bSessionStarted)
{
    // We shouldn't be here! We don't have a session yet
    header("location:index.php");
}

// We need to create the session from the info that was posted to us
ProcessPersonalForm($strPersonalFormKey);

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

<script type="text/javascript" src="scripts/payment-functions.js"></script>

</head>

<body>

<?php 
echo var_dump($_SESSION);
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
            
            <li>
            <!-- If this button works, go hug the nearest developer -->
             <input type="checkbox" name="same-as-contact" id="same-as-contact" value="weds"/> Same as Contact Information <br />
						</li>
            
            <li>
              <label for="street-1">Address 1</label>
              <input type="text" class="contact-duplicate" id="street-1" name="street-1" />
            </li>
            
            <li>
              <label for="street-2">Address 2</label>
              <input type="text" class="contact-duplicate" id="street-2" name="street-2" />
            </li>
            
            <li class="city">
              <label for="city">City</label>
              <input type="text" class="contact-duplicate" id="city" name="city" />
            </li>
            
            <li class="state">
              <label for="state">State</label>
              <input type="text" class="contact-duplicate" id="state" name="state" />
            </li>
            
            <li class="zip">
              <label for="zip">Zip</label>
              <input type="text" class="contact-duplicate" id="zip" name="zip" />
            </li>
            
            <li>
              <label for="phone">Phone</label>
              <input type="text" class="contact-duplicate" id="phone" name="phone" />
            </li>
            
            <li>
              <label for="alt-phone">Alternate Phone</label>
              <input type="text" class="contact-duplicate" id="alt-phone" name="alt-phone" /> 
            </li>

            <li>
              <label for="email">Email Address</label>
              <input type="text" class="contact-duplicate" id="email" name="email" />
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
                <option value="1">Jan</option>
                <option value="2">Feb</option>
                <option value="3">Mar</option>
                <option value="4">Apr</option>
                <option value="5">May</option>
                <option value="6">Jun</option>
                <option value="7">Jul</option>
                <option value="8">Aug</option>
                <option value="9">Sep</option>
                <option value="10">Oct</option>
                <option value="11">Nov</option>
                <option value="12">Dec</option>
              </select>
              <input type="text" class="contact-duplicate" id="name" name="year" /> (YYYY) <!-- that's right - all four numbers -->
            </li>
            <li class="zip">
              <label for="csc">Security Code</label>
              <input type="text" id="csc" name="csc" />
            </li>
         </ul>
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