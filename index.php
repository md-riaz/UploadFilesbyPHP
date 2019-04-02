<?php
           session_start(); // Should always be on top
?>
<!DOCTYPE html>
<html>

<head>
	<title>File Upload</title>
	<meta charset="UTF-8">
	<meta name="description" content="Upload files with AJAX">
	<meta name="keywords" content="HTML,CSS,XML,JavaScript">
	<meta name="author" content="MD Riaz">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link href="assets/favicon.png" rel="icon" type="image/x-icon" />
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
             $handle = fopen("assets/counter.txt", "r"); 
             if(!$handle){ 
              echo "Could not open the file" ;
               } 
              else { 
                $counter = ( int ) fread ($handle,20) ;
                fclose ($handle) ;
                $counter++ ; 
                echo" <p> Visitor Count: ". $counter . " </p> " ; 
                $handle = fopen("assets/counter.txt", "w" ) ; 
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
	<script src="js/main.js"></script>
</body>

</html>