<?php
//Handle e-mail field

$grade = $_POST['grade'];
$subject = $_POST['subject'];
$timeL = $_POST['timeL'];
$notes = $_POST['notes'];
$payment = $_POST['payment'];
$address = $_POST['address'];

echo "grade = $grade ; subject = $subject ; Time Limit = $timeL ; payment = $payment ; notes = $notes ; address = $address" ;
echo '</br>';

//MySQL Database access
	$servername = "localhost";
	$username = "Calesc";
	$password = "47010KatoRd";
	$dbname="findmyshifu";
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	} 
	echo "Connected successfully";

	
	
//Following codes handle uploaded image file
//$target_dir = 'C:/xampp/htdocs/My Web Server/FindMyShifu.com/uploads/';
$target_dir = 'uploads/';
$target_file = $target_dir . basename($_FILES['userfile']['name']);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES['userfile']['tmp_name']);
    if($check !== false) {
        echo "File is an image - " . $check['mime'] . ".";
        $uploadOk = 1;
    } else {
        echo "File is not an image.";
        $uploadOk = 0;
    }
}
// Check if file already exists
if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    echo "</br>";
    $uploadOk = 0;
}
// Check file size set 64MB limit 
if ($_FILES['userfile']['size'] > 64000000) {
    echo "Sorry, your file is too large.";
    echo "</br>";
    $uploadOk = 0;
}
// Allow certain file formats
$a=($imageFileType == 'JPG')|| ($imageFileType == 'jpg') 
||($imageFileType == 'PNG')|| ($imageFileType == 'png')
|| ($imageFileType == 'JPEG') || ($imageFileType == 'jpeg') 
|| ($imageFileType == 'GIF')||( $imageFileType == 'gif');

//echo "a =  $a";
echo "</br>";


if(!$a) 
{
    echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
	echo "</br>";
	
    $uploadOk = 0;
}
// Check if $uploadOk is set to 0 by an error

if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
	echo "</br>";
    // if everything is ok, try to upload file
} else {
	
    if (move_uploaded_file($_FILES['userfile']["tmp_name"], $target_file)) {
        echo "The file ". basename( $_FILES['userfile']["name"]). " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

//following code send email to the input email address

$notes = 'Please click the following link to provide solution:  http://www.findmyShifu.com/solver.html?id=0 ' . $notes;

//if(mail($address ,"$grade grade $subject question.  Need answer within $timeL.  Will pay $payment",$notes)) {
//	 echo ("Successful!"); } 

//insert question into question list before sending out to solvers


//else {
//	 echo ("Fail"); }



?>