jQuery(document).ready(function ($) {

    $("#acting").click(function(){
        if ($("#acting").is(':checked')) {
            $("#audition").slideDown("slow");
        }
        else {
            if ($("#singing").is(':checked')) {
                //
            }
            else {
                $("#audition").slideUp("slow");
            }
        }
    });

    $("#singing").click(function(){
        if ($("#singing").is(':checked')) {
            $("#audition").slideDown("slow");
        }
        else {
            if ($("#acting").is(':checked')) {
                //
            }
            else {
                $("#audition").slideUp("slow");
            }
        }
    });

    $("#orchestra").click(function(){
        if ($("#orchestra").is(':checked')) {
            $("#instrumentdiv").slideDown("slow");
        }
        else {
            $("#instrumentdiv").slideUp("slow");
        }
    });

});