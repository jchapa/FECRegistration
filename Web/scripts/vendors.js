$(document).ready(function() {
    $("#vendor-form :input").change(function() {
        // Recalc the total
        var newTot = recalcVendorForm();
        $("#total").html(newTot);
    });
});

function recalcVendorForm() {
    var total = 0;
    // Check the big booths
    var bigBooths = $("#vendor-booth-big").val();
    var smallBooths = $("#vendor-booth-small").val();
    var badges = $("#vendor-badges").val();
    var passes = $("#vendor-speaker-pass").val();

    if (!isNaN(bigBooths)) {
        total = total + (340 * bigBooths);
    } else {
        alert("Booth quantities must be numbers!");
    }

    if (!isNaN(smallBooths)) {
        total = total + (265 * smallBooths);
    } else {
        alert("Booth quantities must be numbers!");
    }

    if (passes != '') {
        switch (passes) {
        case 'individual-1':
            total = total + 19;
            break;
        case 'individual-2':
            total = total + 38;
            break;
        case 'individual-3':
            total = total + 57;
            break;
        case 'individual-4':
            total = total + 76;
            break;
        case 'family-1':
            total = total + 79;
            break;
        default:
            break;
        }
    }

    return '$' + total;
}