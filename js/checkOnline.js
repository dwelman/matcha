getNotif();

function getNotif()
{
	$.getJSON('src/getNotifications.php', function(data)
	{
		setNotifications(data);
	});
}

setInterval(
	function()
	{
		$.get("src/stillAlive.php");
		getNotif();
	}
, 5000);

function deleteNotif(id)
{
	data = {};
	data.id = id;
	$.ajax({
		url: "src/deleteNotif.php",
		data: data,
		type: 'post',
		complete : function(data)
		{
			getNotif();
		}
	});
}

function setNotifications(data)
{
	parent = document.querySelector("#notifdrop");
	while (parent.firstChild)
		parent.removeChild(parent.firstChild);
	if (!data)
		return;
	if (data.length > 0)
		$("#notiflink").html("Notifications<span style='color: red' class='glyphicon glyphicon-asterisk'></span><span class='caret'></span>");
	else
		$("#notiflink").html("Notifications<span class='caret'></span>");
	for (var i = 0; i < data.length; i++)
	{
		$("#notifdrop").append("<li onclick='deleteNotif(" + data[i].id + ")' >" + data[i].link + data[i].message + "</a></li>");
	}
}