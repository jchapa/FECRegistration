// JavaScript Document
$(document).ready(function() {
	  //Set Drop-Down Values
		$("#number-of-attendees")[0].selectedIndex = 0;
		$("select#registration-type")[0].selectedIndex = 0;
	
	  //Registration Change function.
    $("select#registration-type").change(function () {
          var intRegType = $("select#registration-type")[0].selectedIndex;
	    		var intAttendCount = $("select#number-of-attendees")[0].selectedIndex;
      		var intPersonLICount = $("ul#person-information-list li").length;
					var newLI = '<li class="person-information hide">\r\n<!-- First Name -->\r\n<input type="text" class="person-name-first" name="person-name-first" />\r\n<!-- Last Name -->\r\n<input type="text" class="person-name-last" name="person-name-last"/>\r\n<!-- Age -->\r\n<select class="person-age" name="person-age">\r\n<option value="1">Infant/Toddler (1-3)</option>\r\n<option value="2">Child (4-17)</option>\r\n<option value="3">Adult (18+)</option>\r\n</select>\r\n</li>\r\n';
					switch (intRegType) {
						case 0: ;break;
						case 1: 
						  $(".regular-price").text('$199');
							$(".early-pricing").text('$299');
							$("#registration-total").text('$199');
						  $("#attendee-num-li").fadeIn('fast', null, function () { $("#registration-setup").css('margin-bottom', '0') });
							$("#attendee-total").text('Total:');
							var intResult = intAttendCount - intPersonLICount;
						   for(i=0;i<intResult;i++){
							  $("#person-information-list").append(newLI).hide().fadeIn('slow');
						   };
						  break;
						case 2: 
						  $(".regular-price").text('$79');
							$(".early-pricing").text('$109');
							$("#registration-total").text('$79');
						  $("#attendee-num-li").fadeOut('fast', null, function (){ $("#registration-setup").css('margin-bottom', '35px') }); 
						  $("#attendee-total").text('Individual Registration');
			    		var intPersonLICount = $("ul#person-information-list li").length;
							if (intPersonLICount > 1)
    		  		{
							  //remove some LI's
    		        var intResult = intPersonLICount - 1;
						    for(i=intResult;i>0;i--){
							    $('#person-information-list li:last-child').remove();							
						    };
    		      }
							else if (intPersonLICount < 1)
							{
								 $("#person-information-list").append(newLI).fadeIn('slow');
                 $("#person-information-list li:last-child").fadeIn('slow');
							}
						  break;
					}
        });
				
      //Number of Attendees Function - Math included to calculate and trim LI's   
      $("select#number-of-attendees").change(function() {
    		//Set Variables
    		var intAttendCount = $("select#number-of-attendees")[0].selectedIndex;
    		var intPersonLICount = $("ul#person-information-list li").length;
				var newLI = '<li class="person-information hide">\r\n<!-- First Name -->\r\n<input type="text" class="person-name-first" name="person-name-first" />\r\n<!-- Last Name -->\r\n<input type="text" class="person-name-last" name="person-name-last"/>\r\n<!-- Age -->\r\n<select class="person-age" name="person-age">\r\n<option value="1">Infant/Toddler (1-3)</option>\r\n<option value="2">Child (4-17)</option>\r\n<option value="3">Adult (18+)</option>\r\n</select>\r\n</li>\r\n';
    		$("#attendee-total").text('Total: ' + intAttendCount + ' Attendees');
    		//Compare LI Count and drop-down number to determine whether to append LI or remove
    		if (intAttendCount > intPersonLICount)
    		  {
     		    //append LI's	
						var intResult = intAttendCount - intPersonLICount;
						for(i=0;i<intResult;i++){
							$("#person-information-list").append(newLI);
							$("#person-information-list li:last-child").fadeIn('slow');
						};
    		  }
    		else if (intAttendCount < intPersonLICount)
    		  {
    		    //remove some LI's
    		    var intResult = intPersonLICount - intAttendCount;
						for(i=intResult;i>0;i--){
							$('#person-information-list li:last-child').remove();							
						};
    		  } 
    		 
    		});
				
				//Attending Functions
				$("#all-days").click(function() {
					if (this.checked) {
						$("input.select-days").attr("disabled", true);
						$(".select-days:checked").checked = false;
					} else {
						$("input.select-days").removeAttr("disabled");
					}	
				});
				
				$(".select-days").click(function() {
					var checked = $(".select-days:checked").length;
					switch(checked) {
					case 0: $("input#all-days").removeAttr("disabled"); break;
					case 1: $("input#all-days").attr("disabled", true); break;
					case 2: $("input#all-days").attr("disabled", true); break;
					case 3: $("input#all-days").attr("disabled", true); break;
					case 4: 
					        $("input#all-days").removeAttr("disabled");
									$(".select-days:checked").attr('checked', false);
									$("input#all-days").attr('checked', true);
									$("input.select-days").attr("disabled", true);
							break;	
					}
				});
				
				//Other Checkbox Enable/Disable
				$("#other").click(function() {
					if (this.checked) {
						$("input#other-text").removeAttr("disabled", true);
					} else {
						$("input#other-text").attr('disabled', true);
					}
					
				});
							 
				//Add Methods/Class rules for Names
				$.validator.addMethod("fNameRequired", $.validator.methods.required, "First Name Required");
				$.validator.addMethod("fNameMinlength", $.validator.methods.minlength, $.format("First Name must have at least {0} characters"));
				$.validator.addMethod("lNameRequired", $.validator.methods.required, "Last Name Required");
				$.validator.addMethod("lNameMinlength", $.validator.methods.minlength, $.format("Last Name must have at least {0} characters"));
				$.validator.addClassRules("person-name-first", { fNameRequired: true, fNameMinlength: 2 });
				$.validator.addClassRules("person-name-last", { lNameRequired: true, lNameMinlength: 2 });
		
				//Function for Not Equal
				$.validator.addMethod("valueNotEquals", function(value, element, arg){
					return arg != value;
				 }, "Value must not equal arg.");
				 
				 //Error Container css hide and make float.
  			$("error-container").hide();
				$("#error-container").stickySidebar();
								
								
				//validate Form				
				var validate = $("#registration-details").validate({	
				debug: true,

				
			rules: {
				"registration-type": {
				  valueNotEquals: 0
				},
				"number-of-attendees": {
					required: {
						depends: function(element) {
							return $("#registration-type")[0].selectedIndex != 2 && $("#registration-type")[0].selectedIndex != 0
						} 
					}
				},
				"all-days": {
					required: {
						depends: function(element) {
							return $(".select-days:checked").length = 0
						}
					}
				},
				"select-days": {
					required: {
						depends: function(element) {
							return $("#all-days:not(:checked)")
						}
					}
				},
				"street-1": {
					required: true,
					minlength: 2,
				},
				"street-2": {
					required: false
				},
				city: {
					required: true,
					minlength: 2
				},
				state: {
					required: true,
					minlength: 2,
					maxlength: 2
				},
				zip: {
					required: true,
					minlength: 6
				},
				phone: {
					required: true
				},
				email: {
					required: true,
					email: true
				},
				"reference-cbox": {
					required: true,
					minlength:1
				}
			},
			messages: {
				"registration-type": {
				  valueNotEquals: 'Please Select a Registration Type'
				},
				"number-of-attendees": {
					required: "Please select the number of attendees in your family"
				},
				"all-days": {
					required: "Please Select Days you Plan to Attend"
				},
				"select-days": {
					required: "Please Select Days you Plan to Attend"
				},
				"street-1": {
					required: "Address 1 is required"
				},
				city: {
					required: "City is required",
					minlength: "City must be at least 2 characters"
				},
				state: {
					required: "State is required",
					minlength: "State must be 2 characters",
					maxlength: "State must be 2 characters"
				},
				zip: {
					required: "Zip Code is required",
					minlength: "Zip Code must be at least 6 digits"
				},
				phone: {
					required: "Please enter a Phone Number"
				},
				email: {
					required: "Please enter a valid email address",
					minlength: "Please enter a valid email address"
				},
				"reference-cbox": {
					minlength: "Please select at least one reference",
					required: "Please select at least one reference"
				}
			},
			errorContainer: "#error-container",
			errorLabelContainer: "#error-label-container",

			// set this class to error-labels to indicate valid fields
			success: function(label) {
				label.addClass("checked");
			}, 
		submitHandler: function(form) {
			 $(form).ajaxSubmit({success: showResponse, target: '#server-response'});
		 }	
		});
	
    		
    		
});