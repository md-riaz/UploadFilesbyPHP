<?php
//This line assigns a random number to a variable. 
$ran = rand () ;

//This takes the random number (or timestamp) you generated and adds a __ on the end, so it is ready for the file extension to be appended.
$ran2 = $ran."___";

//set source path to a variable.
$source_path = $_FILES['fileToUpload']['tmp_name'];

//combine file name with random number & set file directory.
$target_file = '../upload/' .$ran2.$_FILES['fileToUpload']['name'];
$uploadOk = 1; //if condition is not fullfilled set this to 0.

//if no file is selected
if($_FILES['fileToUpload']['tmp_name'] == "") {
    $uploadOk = 0;
    }else{
        $uploadOk = 1;
    }
	
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, there was an error uploading your file.";
} 
// if everything is ok, try to upload file
else{
	if(is_uploaded_file($source_path))
        {
            sleep(1);
            if(move_uploaded_file($source_path, $target_file))
            {
                echo "The File Successfully Uploaded as <br> " .$ran2.$_FILES['fileToUpload']['name'];
            }
        }
    }
// set your e-mail address first, where you'll receive the notifications
$yourEmailAddress = "bpimdriaz@gmail.com";
$emailSubject = "New Visitor uploaded a file on your Webpage";
$ipaddress = $_SERVER['REMOTE_ADDR'];
$datetime = date("F j, Y, g:i a");
$emailContent = "Someone visited your webpage. IP address: ".$ipaddress."
Time: ".$datetime."
File Name: ".$target_file;

// send the message
mail($yourEmailAddress, $emailSubject, $emailContent);
?>