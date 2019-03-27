<?php
//This line assigns a random number to a variable. 
$ran = rand () ;
 //This takes the random number (or timestamp) you generated and adds a __ on the end, so it is ready for the file extension to be appended.
$ran2 = $ran."___";

$source_path = $_FILES['uploadFile']['tmp_name'];
$target_path = 'upload/' .$ran2.$_FILES['uploadFile']['name'];

//Now starting upload
if(!empty($_FILES))
{
	if(is_uploaded_file($source_path))
	{
		sleep(1);
		if(move_uploaded_file($source_path, $target_path))
		{
			echo '<img src="'.$target_path.'" class="img-thumbnail" width="300" height="250" /><br>';
            echo "The File Successfully Uploaded as " .$ran2.$_FILES['uploadFile']['name'];
		}
	}
}

?>



?>