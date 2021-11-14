$(document).ready(function() {

    $.get("view.php", function(data) { // jekono data jekono file connect kore get mthod diye niye asa hoyeche
        $("#table_content").html(data); //(.html) diye onno arekta page er html design add kore dey jay
    });

    $('#medicine1').hide();
    
	
});