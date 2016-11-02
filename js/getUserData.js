var images;

function getUserData()
{
    $(document).ready(function()
    {
        // When id with Action is clicked
        $.getJSON('src/getUserData.php', function(data)
        {
            setValues(data[0]);
        });
    });
}

function getImages()
{
    $(document).ready(function()
    {
        $.getJSON('src/imageJson.php', function(data)
        {
            console.log(data);
            setImages(data);
        });
    });
}

function deleteImage(img)
{
    data = {};
    data.image = img;
    $.ajax({
        url: "src/deleteImage.php",
        data: data,
        type: 'post',
        complete : function(data)
        {
            getUserData();
        }
    });
}

function setPfp(img)
{
    data = {};
    data.image = img;
    $.ajax({
        url: "src/changePP.php",
        data: data,
        type: 'post',
        complete : function(data)
        {
            getUserData();
        }
    });
}


function setModal(img, id)
{
    $("#modalsrc").attr("src", img);

    if (id)
    {
        _("#delete").setAttribute("onclick", "deleteImage('" + id + "')");
        _("#setpfp").setAttribute("onclick", "setPfp('" + id + "')");
    }
}

function setImages(data)
{
    console.log("images", data.length);
    if (data.length >= 5)
    {
        $("#img_stat").html("Image limit reached, please delete some to upload again...");
        $("#image_upload_form").hide();
    }
    var i = 0;
    var imgC = 1;
    var id;
    $("#profile_pic").attr("src", "site_images/ppic.jpg");
    $("#modalsrc").attr("src", "site_images/ppic.jpg");
    while (i < data.length)
    {
        if (data[i].is_main == "Y")
        {
            $("#profile_pic").attr("src", data[i].image_path);
            _("#profile_pic").setAttribute("onclick", "setModal('" + data[i].image_path + "', '" + data[i].image_id + "')");
        }
        else
        {
            id = "#img" + imgC.toString();
            $(id).attr("src", data[i].image_path);
            _(id).setAttribute("onclick", "setModal('" + data[i].image_path + "', '" + data[i].image_id + "')");
            $(id).parent().show();
            imgC++;
        }
        i++;
    }
    while (imgC < 5)
    {
        id = "#img" + imgC.toString();
        $(id).parent().hide();
        //$(id).hide();
        imgC++;
    }
    images = data;
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
    $("#age").val(data.age);
    getImages();
    getInterests();
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
    data.age = $("#age").val();
    $.ajax({
        url: "src/updateProfile.php",
        data: data,
        type: 'post',
        success: function(data)
        {
            getUserData();
        }
    });
}

