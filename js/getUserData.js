
function getUserData()
{
    $(document).ready(function()
    {
        // When id with Action is clicked
            // Load ajax.php as JSON and assign to the data variable
            $.getJSON('src/getUserData.php', function(data)
            {
                setValues(data[0]);
            });
    });
}

function setValues(data)
{
    console.log(data);
    $("#firstname").val(data.name);
    $("#lastname").val(data.surname);
    $("#email").val(data.email);
    if (data.gender == "M")
    {
        $("#genmale").prop("checked", true);
    }
    else
        $("#genfem").prop("checked", true);

    if (data.preference == "M")
    {
        $("#prefm").prop("checked", true);
    }
    else if (data.preference == "F")
    {
        $("#preffem").prop("checked", true);
    }
    else
    {
        $("#preffem").prop("checked", true);
        $("#prefm").prop("checked", true);
    }
    $("#bio").val(data.bio);
}

function updateProfile()
{
    data = {};

    var pref;

    if ($("#genmale").prop("checked"))
        data.gender = "M";
    else
        data.gender = "F";

    if ($("#preffem").prop("checked") && $("#prefm").prop("checked"))
        data.preference = "B";
    else if ($("#preffem").prop("checked") && !$("#prefm").prop("checked"))
        data.preference = "F";
    else if (!$("#preffem").prop("checked") && $("#prefm").prop("checked"))
        data.preference = "M";
    else
        data.preference = "B";

    data.name = $("#firstname").val();
    data.surname = $("#lastname").val();
    data.email = $("#email").val();
    data.bio = $("#bio").val();

    console.log(data);
    $.ajax({
        url: "src/updateProfile.php",
        data: data,
        type: 'post',
        success: function(data)
        {
            alert(data);
        }
    });
    getUserData();
}


getUserData();


