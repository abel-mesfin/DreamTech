<?php


require_once('../myfuncs.php');
require_once('../utility.php');


$conn = dbConnect();


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  echo "Connection to SQL server failed" . "<br>";
}else{
//echo "Connected successfully" . "<br>";
}


//Variables from form
$vari = getUserId();
$code = $_POST['code'];
$username = $_POST['username'];
$emails = getEmails();
$rand_num = $_POST['userNumber'];
$user_ID = $_POST['userID'];


require '../vendor/autoload.php';
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

//print_r($usernames);
foreach($emails as $em){
    if($email_in == $em[EMAIL]) {
        $emy = $em[EMAIL];
    }
}
use SendGrid\Mail\Mail;
if(empty($code)){
echo "Please enter a code";
//include('passwordReset.php');
}else{
    if($code == $rand_num){
        include('../passwordRecovery/changePassword.php');
    }else{
        echo "Failed";
        //echo $code;
        echo $rand_num;
    }
}

?>