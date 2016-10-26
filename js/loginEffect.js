/**
 * Created by ddu-toit on 10/26/16.
 */
$(document).ready(function()
{
    $("#show_login").click(function(){
        showpopup();
    });
    $("#close_login").click(function(){
        hidepopup();
    });
});

function showpopup()
{
    $("#loginform").fadeIn();
    $("#loginform").css({"visibility":"visible","display":"block"});
}

function hidepopup()
{
    $("#loginform").fadeOut();
    $("#loginform").css({"visibility":"hidden","display":"none"});
}