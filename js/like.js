getLikes();

function likeUser()
{
    data = {};
    data.like = getUrlParameter('user');
    $.ajax({
        url: "src/likeUser.php",
        data: data,
        type: 'post',
        success: function(data)
        {
            getLikes();
        }
    });
}

function setLike(data)
{
    if (data.length > 0)
        $("#likebtn").html("<span class='glyphicon glyphicon-thumbs-down'></span> Unlike");
    else
        $("#likebtn").html("<span class='glyphicon glyphicon-thumbs-up'></span> Like");
}

function getLikes()
{
    data = {};
    data.like = getUrlParameter('user');
    $.ajax({
        url: "src/getLikes.php",
        data: data,
        type: 'post',
        success: function(data)
        {
            setLike(jQuery.parseJSON(data));
        }
    });
}

function getUrlParameter(sParam)
{
    var sPageURL = decodeURIComponent(window.location.search.substring(1)),
        sURLVariables = sPageURL.split('&'),
        sParameterName,
        i;

    for (i = 0; i < sURLVariables.length; i++) {
        sParameterName = sURLVariables[i].split('=');

        if (sParameterName[0] === sParam) {
            return sParameterName[1] === undefined ? true : sParameterName[1];
        }
    }
};