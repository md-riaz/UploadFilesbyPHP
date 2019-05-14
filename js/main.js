//function for calling getElementById by(_)
function _(ele) {
    return document.getElementById(ele);
}
//remove disabled attribute from submit button
_("fileToUpload").addEventListener("change", function () {
    _("uploadSubmit").removeAttribute("disabled");
})


//main function for ajax file upload
function myFunction() {
    //Javascript for renaming submit button on click
    _("uploadSubmit").value = "Please wait till Successfull.....";
    //AJAX Codes
    var file = _("fileToUpload").files[0];
    var formdata = new FormData(); //creating empty formdata object
    formdata.append("fileToUpload", file); //storing HTMLform to form variable
    var ajax = new XMLHttpRequest(); //AJAX object for exchange data with a server behind the scenes.
    ajax.upload.addEventListener("progress", progressHandler,
    false); //When uploading file,run progressHandler function.
    ajax.addEventListener("load", completeHandler, false); //Show a messege when upload is completed
    ajax.addEventListener("error", errorHandler, false); //Show a messege when error happen
    ajax.addEventListener("abort", abortHandler, false); //Show a messege when upload is interrupted
    ajax.open("POST", "assets/upload.php"); //Specifies the type of request & request method
    ajax.send(formdata); //Sends the request to the server
}
//function for Progressbar & file size displaying
function progressHandler(event) {
    var total_size = (event.total/1048576).toFixed(2); //byte divided by 1048576 for byte to MB
    var loaded_size = (event.loaded/1048576).toFixed(2);
    _("loaded_n_total").innerHTML = "Uploaded " + loaded_size + " MB of " + total_size + " MB ";
    var percent = (event.loaded / event.total) * 100;
    _("progressBar").value = Math.round(percent);
    _("status").innerHTML = Math.round(percent) + "%";
}
//Function on file upload completed
function completeHandler(event) {
    _("status").innerHTML = event.target.responseText;
    _("progressBar").value = 0;
    _("uploadSubmit").value = "Upload";
}

function errorHandler(event) {
    _("status").innerHTML = "Upload Failed";
}

function abortHandler(event) {
    _("status").innerHTML = "Upload Aborted";
}