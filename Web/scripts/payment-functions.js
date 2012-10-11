// JavaScript Document
$(document).ready(function() {
    // Payment page Scripts
		
		$("#same-as-contact").click(function() {
					if (this.checked) {
						$(".contact-duplicate").attr('disabled', true);
					} else {
						$(".contact-duplicate").removeAttr("disabled");		
					}
		});
    		
});