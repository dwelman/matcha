
var fieldBorderColor = document.querySelector("#firstname").style.borderColor;

function checkName(name, output , message)
{
    var filter = /^[A-Za-z- ]+$/;
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

function checkEmail(email, output, message)
{
    var email = document.getElementById('email');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email.value))
    {
        output.innerHTML = message;
        email.style.borderColor = "#c55";
        email.focus();
        return (true);
    }
    else
    {
        email.style.borderColor = fieldBorderColor;
        return false;
    }
}

function checkAge(age, output, message)
{
    var age = document.getElementById('age');
    if (parseInt(age.value) < 18)
    {
        output.innerHTML = message;
        age.style.borderColor = "#c55";
        age.focus();
        return (true);
    }
    else
    {
        age.style.borderColor = fieldBorderColor;
        return false;
    }
}

function verifyDetails(s)
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
    if (checkName(_("#firstname"), _("#message"), dismiss + "Invalid first name, only alphabetical characters are allowed.") || s == 1)
        return;
    if (checkName(_("#lastname"), _("#message"), dismiss + "Invalid last name, only alphabetical characters are allowed.")  || s == 1)
        return;
    if (checkEmail(_("#email"), _("#message"), dismiss + "Please provide a valid email address")  || s == 3)
        return;
    if (checkAge(_("#age"), _("#message"), dismiss + "Must be 18 or older")  || s == 4)
        return;
    if (message != null)
        _("#personal").removeChild(message);
    updateProfile();
   }



  function chkPasswordStrength()
  {
     var desc = new Array();
     desc[0] = "very weak";
     desc[1] = "weak";
     desc[2] = "better";
     desc[3] = "medium";
     desc[4] = "strong";
     desc[5] = "strongest";

     var score = 0;
     var pass = document.getElementById('password');
     var pstring = document.getElementById('pstr');
     var txtpass = pass.value;
     var errMsg;

    if (txtpass.length >= 6) 
    {
      score++;
     if ( ( txtpass.match(/[a-z]/) ) && ( txtpass.match(/[A-Z]/) ) ) score++;
     if (txtpass.match(/\d+/)) score++;
     if ( txtpass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) ) score++;
     if (txtpass.length > 12) score++;
     pstring.innerHTML = "strength " + desc[score];
     pstring.className = "strength" + score;
    }
    else
       pstring.innerHTML = "";
}