// JavaScript Document
$(document).ready(function() {
    // Payment page Scripts
		  				$("#same-as-contact").attr('checked', true);
							$(".contact-duplicate").attr('disabled', true);
														
		                    var validate = $("#billing-info")
                            .validate(
                                    {
                                        debug : false,
                                        rules : {
																					"card-name" : {
																						required: true,
																						minlength: 2
																					},
                                          "card-number" : {
																						required: true,
																						digits: true,
																						maxlength: 30
																					},
																					year : {
																						required: true,
																						minlength: 4,
																						digits: true
																					},
																					csc : {
																						required: true,
																						minlength: 3,
																						digits: true
																					}
                                        },
                                        messages : {
																					"card-name" : {
																						required: "Name on Card is Required",
																						minlength: "Name on Card must be 2 digits"
																					},
                                          "card-number" :  {
																						required: "Card Number is Required",
																						digits: "Card Number must be digits."
																					},
																					year : {
																					  required: "Expiration Year is required",
																						minlength: "Expiration Year must be 4 digits",
																						digits: "Expiration Year must be digits."
																					},
																					csc : {
																						required: "Security Code is required",
																						minlength: "Security Code must be at least 3 characters",
																						digits: "Security Code must be digits"
																					}
                                        },
                                        errorContainer : "#error-container",
                                        errorLabelContainer : "#error-label-container"
                                    });
																		
                    $("error-container").hide();
                    $("#error-container").stickySidebar();
		
		$("#same-as-contact").click(function() {
					if (this.checked) {
						//$(".contact-duplicate").attr('disabled', true);
					} else {
						$(".contact-duplicate").removeAttr("disabled");		
						$("#same-as-contact-li").fadeOut('slow');
					}
		});
    		
});