var activeChat = -1;
var activeUsers;
var matchCount = 0;

$( "#chat" ).load( "src/chat.html" );
getUserMatches();

function getUserMatches()
{
    $(document).ready(function()
    {
        $.getJSON('src/getUserMatches.php', function(data)
        {
            console.log(data);
            setMatches(data);
        });
    });
}

function setActiveChat(index)
{
    activeChat = index;
    console.log(activeChat);
    for (var i = 0; i < matchCount; i++)
    {
       if (i == index)
           $("#chat" + i.toString()).css("background-color","#AFBEEE");
       else
           $("#chat" + i.toString()).css("background-color","#FFF");
    }
}

function sendMessage() 
{
    data = {};
    if (activeChat < 0 || activeChat > matchCount)
        return;
    console.log("users :" , activeUsers);

    data.message = $("#messagebox").val();
    data.user_to = activeUsers[activeChat].username;
    console.log("users :" , activeUsers);
    console.log("send message to", activeUsers[activeChat].username);
    console.log("message", data.message);
    $.ajax({
        url: "src/sendMessage.php",
        data: data,
        type: 'post',
        success: function(data)
        {
        }
    })
}

function setMatches(data)
{
    if (!data || data.length == 0)
    {
        $("#matches").append("<h6>No matches yet, get liking!</h6>");
        return ;
    }
    matchCount = data.length;
    activeChat = 1;
    for (var i = 0; i < data.length; i++)
    {
        var match = '<div id="chat' + i.toString() + '" class="media conversation"'+ 'onclick="setActiveChat(' + i.toString() + ')"' + '>' +
                        '<a class="pull-left" href="#">' +
                            '<img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 50px; height: 50px;" ' +
            'src="' + data[i].profile_pic +'">' +
                        '</a>' +
        '<div class="media-body"><br>' +
        '<h5 class="media-heading">'+
            data[i].name + ' ' + data[i].surname +
            '</h5></div></div>';
        $("#matches").append(match);
        if (i == 0)
            $("#chat0").css("background-color","#AFBEEE");
    }
    activeUsers = data;
}