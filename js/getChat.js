var activeChat = -1;
var activeUsers;
var activeChatUser;
var activeChatHTML;
var matchCount = 0;
var loggedOnUser;
var unreadTotal = 0;
var setActive = true;


$( "#chat" ).load( "src/chat.html" , initPage);

function initPage()
{
    getUserMatches();
    $.getJSON('src/getLoggedOnUser.php', function(data)
    {
        console.log(data);
        loggedOnUser = data;
    });
    getMessages();
}

function chatClick()
{
    data = {};
    data.user_to = loggedOnUser;
    data.user_from = activeChatUser;
    $.ajax({
        url: "src/setRead.php",
        data: data,
        type: 'post'
    });
    setTimeout(function()
    {
        $("#msgwrap").animate({
            scrollTop: $('#msgwrap')[0].scrollHeight * 10000
        }, 1000);
    }, 800);
}

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

function setActiveChat(index, setRead)
{
    var data = {};
    console.log("Set to", index);
    if (matchCount <= 0)
        return;
    activeChat = index;
    activeChatUser = activeUsers[index].username;
    activeChatHTML = $("#chat" + index.toString()).html();
    console.log("acu", activeChatUser);
    console.log("index", index);
    for (var i = 0; i < matchCount; i++)
    {
        if (setRead)
        {
            data.user_to = loggedOnUser;
            data.user_from = activeChatUser;
            $.ajax({
                url: "src/setRead.php",
                data: data,
                type: 'post',
                success: function (data)
                {
                    console.log("data", data.toString());
                    if (data > 0)
                        $("#chatu" + chat.toString()).html(data.toString());
                    unreadTotal += parseInt(data);
                    if (unreadTotal > 0)
                        $("#chat_link").html("Chat <span style='color:red'>" + unreadTotal.toString() + "</span>");
                    getUserMatches();
                    $("#chat" + activeChat.toString()).css("background-color", "#AFBEEE");
                }
            });
        }
    }
    getMessages();
}

function getMessages()
{
    $(document).ready(function()
    {
        $.getJSON('src/getMessages.php', function(data)
        {
            setMessages(data);
        });
    });
}

function setMessages(data)
{
    $(document).ready(function()
    {
        if (!data)
            return;
        var parent = document.querySelector("#msgwrap");
        while (parent.firstChild)
            parent.removeChild(parent.firstChild);
        for (var i = 0; i < data.length; i++)
        {
            var color;
            if ((activeChatUser == data[i].user_to && loggedOnUser == data[i].user)
                || (activeChatUser == data[i].user && loggedOnUser == data[i].user_to))
            {
                if (activeChatUser == data[i].user)
                    color = "#E4F5E3";
                else
                    color = "#FFF";
                var message = '<div class="media msg" style="background-color: ' + color + '">'
                    + '<a class="pull-left" href="#">'
                    + '<img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 32px; height: 32px;" src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAACqUlEQVR4Xu2Y60tiURTFl48STFJMwkQjUTDtixq+Av93P6iBJFTgg1JL8QWBGT4QfDX7gDIyNE3nEBO6D0Rh9+5z9rprr19dTa/XW2KHl4YFYAfwCHAG7HAGgkOQKcAUYAowBZgCO6wAY5AxyBhkDDIGdxgC/M8QY5AxyBhkDDIGGYM7rIAyBgeDAYrFIkajEYxGIwKBAA4PDzckpd+322243W54PJ5P5f6Omh9tqiTAfD5HNpuFVqvFyckJms0m9vf3EY/H1/u9vb0hn89jsVj8kwDfUfNviisJ8PLygru7O4TDYVgsFtDh9Xo9NBrNes9cLgeTybThgKenJ1SrVXGf1WoVDup2u4jFYhiPx1I1P7XVBxcoCVCr1UBfTqcTrVYLe3t7OD8/x/HxsdiOPqNGo9Eo0un02gHkBhJmuVzC7/fj5uYGXq8XZ2dnop5Mzf8iwMPDAxqNBmw2GxwOBx4fHzGdTpFMJkVzNB7UGAmSSqU2RoDmnETQ6XQiOyKRiHCOSk0ZEZQcUKlU8Pz8LA5vNptRr9eFCJQBFHq//szG5eWlGA1ywOnpqQhBapoWPfl+vw+fzweXyyU+U635VRGUBOh0OigUCggGg8IFK/teXV3h/v4ew+Hwj/OQU4gUq/w4ODgQrkkkEmKEVGp+tXm6XkkAOngmk4HBYBAjQA6gEKRmyOL05GnR99vbW9jtdjEGdP319bUIR8oA+pnG5OLiQoghU5OElFlKAtCGr6+vKJfLmEwm64aosd/XbDbbyIBSqSSeNKU+HXzlnFAohKOjI6maMs0rO0B20590n7IDflIzMmdhAfiNEL8R4jdC/EZIJj235R6mAFOAKcAUYApsS6LL9MEUYAowBZgCTAGZ9NyWe5gCTAGmAFOAKbAtiS7TB1Ng1ynwDkxRe58vH3FfAAAAAElFTkSuQmCC">'
                    + '</a><div class="media-body">'
                    + '  <small class="pull-right time"><i class="fa fa-clock-o"></i> 12:10am</small>'
                    + ' <small class="col-lg-10" style="text-align: left">'
                    + data[i].message
                    + '</small></div>'
                    + '</div><br>';
                $("#msgwrap").append(message);
            }
        }

    });
}

function sendMessage() 
{
    data = {};
    if (activeChat < 0 || activeChat > matchCount)
        return;
    console.log("users :" , activeUsers);
    console.log("chat :" , activeChat);
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
            getMessages();
        }
    });
    $("#messagebox").val("");
    $("#msgwrap").animate({
        scrollTop: $('#msgwrap')[0].scrollHeight * 10000
    }, 1000);
}

function getUnread(user, chat)
{
    data = {};
    data.user = user;
    $.ajax({
        url: "src/getUnread.php",
        data: data,
        type: 'post',
        success: function(data)
        {
            console.log("data", data.toString());
            if (data > 0)
                $("#chatu" + chat.toString()).html(data.toString());
            else
                $("#chatu" + chat.toString()).html("");
            unreadTotal += parseInt(data);
            if (unreadTotal > 0)
                $("#chat_link").html("Chat <span style='color:red'>" + unreadTotal.toString() + "</span>");
            else
                $("#chat_link").html("Chat");
        }
    });
}

function setMatches(data)
{
    $(document).ready(function()
    {
        var parent = document.querySelector("#matches");
        while (parent.firstChild)
            parent.removeChild(parent.firstChild);
        if (!data || data.length == 0) {
            $("#matches").append("<h6>No matches yet, get liking!</h6>");
            return;
        }
        matchCount = data.length;
        if (setActive)
            activeChat = 0;
        for (var i = 0; i < data.length; i++)
        {
            var match = '<div id="chat' + i.toString() + '" class="media conversation"' + 'onclick="setActiveChat(' + i.toString() + ', true)"' + '>' +
                '<a class="pull-left" href="#">' +
                '<img class="media-object" data-src="holder.js/64x64" alt="64x64" style="width: 50px; height: 50px;" ' +
                'src="' + data[i].profile_pic + '">' +
                '</a>' +
                '<div class="media-body"><br>' +
                '<h5 class="media-heading">' +
                data[i].name + ' ' + data[i].surname +
                '</h5><small id="chatu' + i.toString() + '"class="pull-right" style="color:red"></small></div></div>';
            $("#matches").append(match);
            getUnread(data[i].username, i);
        }
        if (setActive)
        {
            activeUsers = data;
            $("#chat0").css("background-color", "#AFBEEE");
            setActiveChat(0, false)
            activeChatUser = data[0].username;
            setActive = false;
        }
        $("#chat" + activeChat.toString()).css("background-color", "#AFBEEE");
    });
}