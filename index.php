<?php
           session_start(); // Should always be on top
?>
<!DOCTYPE html>
<html>

<head>
	<title>File Upload</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="favicon.png" rel="icon" type="image/x-icon" />
	<link href="https://fonts.googleapis.com/css?family=Poppins" rel="stylesheet">
	<link rel="stylesheet" href="css/style.css">
</head>

<body>
	<div class="wrapper">
		<h3 class="title">File Upload System <br> by MD Riaz</h3>
		<br />
		<div class="form-group">
			<div class="form-heading"><b>Choose a File & Click Upload Button</b></div>
			<form action="" method="POST" enctype="multipart/form-data" class="form">
				<b>File Upload</b> <br>
				<input type="file" name="fileToUpload" id="fileToUpload" />
				<progress id="progressBar" value="0" max="100"></progress>
				<h3 id="status"></h3>
				<p id="loaded_n_total"></p>
				<input type="button" id="uploadSubmit" value="Upload" onclick="myFunction()" disabled />
			</form>
		</div>
<!-- PHP code for visit counter -->
		<?php
           if(!isset($_SESSION['counter'])) { // It's the first visit in this session
             $handle = fopen("counter.txt", "r"); 
             if(!$handle){ 
              echo "Could not open the file" ;
               } 
              else { 
                $counter = ( int ) fread ($handle,20) ;
                fclose ($handle) ;
                $counter++ ; 
                echo" <p> Visitor Count: ". $counter . " </p> " ; 
                $handle = fopen("counter.txt", "w" ) ; 
                fwrite($handle,$counter) ; 
                fclose ($handle) ;
                $_SESSION['counter'] = $counter;
                }

           } else { // It's not the first time, do not update the counter but show the total hits stored in session
             $counter = $_SESSION['counter'];
             echo" <p> Visitor Count: ". $counter . " </p> " ;
           }
		?>
	</div>
	<script>
		//function for calling getElementById by(_)
		function _(ele) {
			return document.getElementById(ele);
		}

		//remove brand
		window.onload = () => {
			let el = document.querySelector('[alt="www.000webhost.com"]').parentNode.parentNode;
			el.parentNode.removeChild(el);
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
			ajax.open("POST", "upload.php"); //Specifies the type of request & request method
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
	</script>
</body>

</html>