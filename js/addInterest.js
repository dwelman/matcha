function checkInterest(name, output, message)
{
    var filter = /^[A-Za-z0-9-_ ]+$/;
    if (!filter.test(name.value))
    {
        output.innerHTML = message;
        name.style.borderColor = "#c55";
        name.focus();
        return (true);
    }
    else
    {
        name.style.borderColor = fieldBorderColor;
        return (false);
    }
}

function	getInterests()
{
	location.reload();
	$(document).ready(function()
	{
        //document.getElementById('#interest_frame').contentWindow.location.reload();
	});
}

function	addInterest()
{
	data = {};

	data.interest = $("#interest").val();
	console.log(data);
	$.ajax({
        url: "src/addInterest.php",
        data: data,
        type: 'post',
        success: function(data)
        {
            getInterests();
        }
    });
}

function	verifyInterest(s)
{
	var message = _("#message");
    if (message != null)
        _("#personal").removeChild(message);
    message = document.createElement("div");
    message.setAttribute("class" ,"alert alert-info alert-dismissable");
    message.setAttribute("id" ,"message");
    _("#personal").insertBefore(message, _("#personal").childNodes[0]);
    var dismiss = "<a class='panel-close close' data-dismiss='alert'>×</a>"
        + "<i class='fa fa-coffee'></i>";
	if (checkInterest(_("#firstname"), _("#message"), dismiss + "Invalid interest, no special characters.") || s == 1)
    	return;
	if (message != null)
        _("#personal").removeChild(message);
	addInterest();
}