function _(element)
{
	return (document.getElementById(element));
}

function userUpload()
{
	if (_("image1").files[0] != null)
		uploadFile(_("image1").files[0], "user" ,null);
	_("image1").value = "";
//	location.reload();
}

function uploadFile(file, key, name)
{
	var formElem = document.querySelector("#image_upload_form");
	var	formdata = new FormData(formElem);
	console.log(formdata.toString());
	if (name)
		formdata.append(key, file, name);
	else
		formdata.append(key, file);
	var ajax = new XMLHttpRequest();
	ajax.upload.addEventListener("progress", progressHandler, false);
	ajax.addEventListener("load", completeHandler, false);
	ajax.addEventListener("error", errorHandler, false);
	ajax.addEventListener("abort", abortHandler, false);
	ajax.open("POST", "src/upload.php");
	ajax.send(formdata);
}

function progressHandler(event)
{
   //_("loaded_n_total").innerHTML =
	// "Uploaded "+event.loaded+" bytes of "+event.total;
	  var percent = (event.loaded / event.total) * 100;
   _("progressBar").value = Math.round(percent);
   _("status").innerHTML = Math.round(percent)+"% uploaded... please wait";
 }

function completeHandler(event)
{
   _("status").innerHTML = event.target.responseText;
   _("progressBar").value = 0;
}

function errorHandler(event)
{
   _("status").innerHTML = "Upload Failed";
}

function abortHandler(event)
{
  _("status").innerHTML = "Upload Aborted";
}

