<?php

//Debug - SET TO FALSE FOR PRODUCTION
$bDebug = false;

//Header Include
require_once (dirname(__FILE__) . "/inc/header.inc");

//Begin Body

?>
<script
	type="text/javascript" src="scripts/vendors.js"></script>

<div id="header">
	<div id="header-container">
		<a href="http://www.familyeconomics.com/"><div id="logo"></div> </a>
		<!--End #logo-->

	</div>
	<!--End #header-container-->
</div>
<!--End #header-->

<div id="container">
	<h2 class="entrytitle">Vendor Registration - May 2012 St. Louis
		Economics</h2>

	<div id="content" class="column">

		<form action="/api/vendor/process.php" class="fec-form">
			<fieldset id="contact-info">
			    <h2>Vendor Information</h2>
				<ul>
					<li>
					    <label for="vendor-name">Vendor Name</label> 
					    <input type="text" id="vendor-name" name="vendor-name" />
					</li>
					<li>
					    <label for="vendor-type">Business Type</label> 
					    <input type="text" id="vendor-type" name="vendor-type" />
					</li>
					<li>
					    <label for="vendor-sales-tax">Sales Tax ID</label> 
					    <input type="text" id="vendor-sales-tax" name="vendor-sales-tax" />
					</li>
					<li style="margin-top:40px;">
					    <label for="vendor-address">Mailing Address</label> 
					    <input type="text" id="vendor-address" name="vendor-address" />
					</li>
					<li>
					    <label for="vendor-city">Mailing City</label> 
					    <input type="text" id="vendor-city" name="vendor-city" />
					</li>
					<li>
					    <label for="vendor-state">Mailing State</label> 
					    <input type="text" id="vendor-state" name="vendor-state" />
					</li>
					<li>
					    <label for="vendor-zip">Mailing Zip</label> 
					    <input type="text" id="vendor-zip" name="vendor-zip" />
					</li>
				</ul>
			</fieldset>
			<fieldset id="contact-info">
			    <h2>Contact Information</h2>
				<ul>
					<li>
					    <label for="vendor-rep">Representative</label> 
					    <input type="text" id="vendor-rep" name="vendor-rep" />
					</li>
					<li>
					    <label for="vendor-rep-email">Email</label> 
					    <input type="text" id="vendor-rep-email" name="vendor-rep-email" />
					</li>
					<li>
					    <label for="vendor-rep-phone">Phone</label> 
					    <input type="text" id="vendor-rep-phone" name="vendor-rep-phone" />
					</li>
					<li>
					    <label for="vendor-rep-cell">Cell Phone</label> 
					    <input type="text" id="vendor-rep-cell" name="vendor-rep-cell" />
					</li>
					<li style="margin-top:40px;">
					    <label for="vendor-alt">Alternate Contact</label> 
					    <input type="text" id="vendor-alt" name="vendor-alt" />
					</li>
					<li>
					    <label for="vendor-alt-email">Email</label> 
					    <input type="text" id="vendor-alt-email" name="vendor-alt-email" />
					</li>
					<li>
					    <label for="vendor-alt-phone">Phone</label> 
					    <input type="text" id="vendor-alt-phone" name="vendor-alt-phone" />
					</li>
					<li>
					    <label for="vendor-alt-cell">Cell Phone</label> 
					    <input type="text" id="vendor-alt-cell" name="vendor-alt-cell" />
					</li>
				</ul>
			</fieldset>
			<fieldset id="contact-info">
			    <h2>Booth Reservations</h2>
				<ul>
					<li>
					    <label for="vendor-booth-big">Qty. ($340/booth)</label> 
					    <input type="text" id="vendor-booth-big" name="vendor-booth-big" />
					    10ft. x 10ft. Display booth(s)
					</li>
					<li>
					    <label for="vendor-booth-small">Qty. ($265/booth)</label> 
					    <input type="text" id="vendor-booth-small" name="vendor-booth-small" />
					    8 ft. x 10ft. Display booth(s)
					</li>
					<li>
					    <label for="vendor-badges">Qty. (Free)</label> 
					    <input type="text" id="vendor-badges" name="vendor-badges" />
					    Additional Name Badges (Two Provided Automatically)
					</li>
					<li>
					    <label for="vendor-speaker-pass">Conference Pass</label> 
					    <select id="vendor-speaker-pass" name="vendor-speaker-pass" style="margin-right:5px;width:177px !important;">
					        <option value=""> -- None -- </option>
					        <option value="individual-1">Individual x1 ($19)</option>
					        <option value="individual-2">Individual x2 ($38)</option>
					        <option value="individual-3">Individual x3 ($57)</option>
					        <option value="individual-4">Individual x4 ($76)</option>
					        <option value="family-1">Family ($79)</option>
					    </select>
					    (Speaker Conference Pass - Guaranteed Seating)
					</li>
				</ul>
			</fieldset>
			<fieldset>
			    <label for="total" style="margin-right:5px;">Total Cost:</label>
			    <div id="total" style="font-size:17px; padding-left:20px !important;">$0</div>
			</fieldset>
			<fieldset id="contact-info">
         <h2>Billing Information</h2>
         <ul>
            <li>
              <label for="card-name">Name on Card:</label>
              <input type="text" id="card-name" name="card-name" />
            </li>
            
            <li>
              <label for="street-1">Address 1</label>
              <input type="text" class="contact-duplicate" id="street-1" name="street-1"/>
            </li>
            <li>
              <label for="street-2">Address 2</label>
              <input type="text" class="contact-duplicate" id="street-2" name="street-2"/>
            </li>
            <li class="city">
              <label for="city">City</label>
              <input type="text" class="contact-duplicate" id="city" name="city"/>
            </li>
            <li class="state">
              <label for="state">State</label>
              <input type="text" class="contact-duplicate" id="state" name="state"/>
            </li>
            <li class="zip">
              <label for="zip">Zip</label>
              <input type="text" class="contact-duplicate" id="zip" name="zip"/>
            </li>
            <li>
              <label for="phone">Phone</label>
              <input type="text" class="contact-duplicate" id="phone" name="phone"/>
            </li>
            <li>
              <label for="alt-phone">Alternate Phone</label>
              <input type="text" class="contact-duplicate" id="alt-phone" name="alt-phone"/>
            </li>
            <li>
              <label for="email">Email Address</label>
              <input type="text" class="contact-duplicate" id="email" name="email"/>
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
            
         </ul>
       </fieldset>            
			<fieldset id="submit">
                <input type="submit" id="btnSubmit" style="cursor:pointer;" value="Process Payment" />
            </fieldset>
		</form>

	</div>

	<div id="sidebar" class="column">

		<ul class="widgets">

			<li id="pages-2" class="widget-container widget_pages"><h5
					class="widget-title"></h5>
				<ul>
					<li class="current_page_item"><a href="#">Vendor Registration</a></li>
				</ul>
			</li>
		</ul>
		<!--End .widgets-->

	</div>
	<!--End #sidebar-->

	<div id="error-container">
		<div id="error-label-container"></div>
	</div>

	<br class="clearit">


</div>



<div id="footer">
	<div id="footer-container">




		<ul class="widgets column">
			<li id="text-2" class="widget-container widget_text"><h5
					class="widget-title">Spread the Word</h5>
				<div class="textwidget">
					<ul id="social">
						<li>Facebook</li>
						<li>Twitter</li>
						<li>Email</li>
					</ul>
					<!--End #social-->
				</div>
			</li>
		</ul>
		<!--End .widgets-->

		<ul class="widgets column">
			<li id="pages-3" class="widget-container widget_pages"><h5
					class="widget-title">Info</h5>
				<ul>
					<li class="page_item page-item-63"><a
						href="http://www.familyeconomics.com/conference/">Conference</a></li>
					<li class="page_item page-item-184 current_page_item"><a
						href="http://www.familyeconomics.com/facility-accommodations/">Facility/Accommodations</a>
					</li>
					<li class="page_item page-item-8"><a
						href="http://www.familyeconomics.com/history/">History</a></li>
					<li class="page_item page-item-206"><a
						href="http://www.familyeconomics.com/schedule/">Schedule</a></li>
					<li class="page_item page-item-147"><a
						href="http://www.familyeconomics.com/speakers/">Speakers</a></li>
					<li class="page_item page-item-257"><a
						href="http://www.familyeconomics.com/sponsors/">Sponsors</a></li>
					<li class="page_item page-item-4"><a
						href="http://www.familyeconomics.com/vision/">Vision</a></li>
				</ul>
			</li>
		</ul>
		<!--End .widgets-->

		<ul class="widgets column">
			<li id="text-3" class="widget-container widget_text"><h5
					class="widget-title">Registration</h5>
				<div class="textwidget">Registration information coming soon.</div>
			</li>
		</ul>
		<!--End .widgets-->
	</div>
	<!--End #footer-container-->

</div>
<!--End #footer-->

<?php

//Header Include
require_once (dirname(__FILE__) . "/inc/footer.inc");

//Begin Body

?>