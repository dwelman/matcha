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

function getInterests()
{
    $(document).ready(function()
    {
        $.getJSON('src/getInterests.php', function(data)
        {
            setInterests(data);
            console.log("data", data);
        });
    });
}

function setInterests(data)
{
    var i = 0;
    var parent = _("#interest_div");
    while (parent.firstChild) {
        parent.removeChild(parent.firstChild);
    }
    console.log("data", data);

    if (!data)
        return;
    while (i < data.length)
    {
        var cont = document.createElement("div");
        var alert = document.createElement("div");
        var p = document.createElement("p");
        var button = document.createElement("button");

        button.setAttribute("class", "close");
        button.setAttribute("type", "button");
        button.setAttribute("aria-label", "Close");
        button.setAttribute("data-dismiss", "alert");
        button.setAttribute("onclick", "deleteInterest('" + data[i] + "')");

        button.innerHTML = "×";

        alert.setAttribute("class", "alert alert-info alert-dismissable");
        alert.setAttribute("role", "alert");

        p.setAttribute("class", "alert-title");
        p.setAttribute("id", "p" + i.toString());
        p.innerHTML = data[i];
        cont.setAttribute("class", "col-xs-4");

        alert.appendChild(button);
        alert.appendChild(p);
        cont.appendChild(alert);
        parent.insertBefore(cont, _("#interest_div").childNodes[0]);
        //$("#interest").append(document.createElement("br"));
        i++;
    }
    console.log("parent", parent.childNodes);
}

function	deleteInterest(interest)
{
    data = {};
    data.interest = interest;
    console.log("interest", interest);
    $.ajax({
        url: "src/addInterest.php",
        data: data,
        type: 'post',
        success: function(data)
        {
            getInterests();
            $("#interest").val("");
        }
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
            $("#interest").val("");

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