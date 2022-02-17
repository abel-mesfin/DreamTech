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
$email_in = $_POST['email'];
$username = $_POST['username'];
$emails = getEmails();
$user_ID = getIDByEmail($email_in);


require '../vendor/autoload.php';
// Uncomment next line if you're not using a dependency loader (such as Composer)
// require_once '<PATH TO>/sendgrid-php.php';

//print_r($usernames);


foreach($emails as $em){
    $em = strtolower($em[EMAIL]);
    $email_in = strtolower($email_in);
    if($email_in == $em) {
        $emy = $em;
        $emy = strtolower($emy);
    }
}
use SendGrid\Mail\Mail;
if(!empty($username)){
    $uname = getCurrentUsername($user_ID[0][ID]);
    $lusername = strtolower($username);
    $uname = strtolower($uname[0][USERNAME]);
    if($lusername == $uname and !empty($emy)){
    $rand_num = rand(1000,9000);



    $email = new Mail();
    $email->setFrom("abel.mesfin@outlook.com", "Abels Blog");
    $email->setSubject("Temporary authorization code");
    $email->addTo($emy, "Example User");
    $email->addContent("text/plain", "and easy to do anywhere, even with PHP");
    $email->addContent(
        "text/html", "<strong>".$rand_num."</strong>"
    );
    $sendgrid = new \SendGrid('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');
    try {
        $response = $sendgrid->send($email);
        //print $response->statusCode() . "\n";
        //print_r($response->headers());
        //print $response->body() . "\n";
    } catch (Exception $e) {
        echo 'Caught exception: '.  $e->getMessage(). "\n";
    }
    include('../passwordRecovery/verify.php');  
    }else{
        echo "User not found";
        echo $em;
        
    }

}else{
$foundUsername = getUserFromEmail($email_in);




$email = new Mail();
$email->setFrom("abel.mesfin@outlook.com", "Abels Blog");
$email->setSubject("Username requestal");
$email->addTo($emy, "Example User");
$email->addContent("text/plain", "and easy to do anywhere, even with PHP");
$email->addContent(
    "text/html", "<strong>Hello the following username was requested to this email: ".$foundUsername[0][USERNAME]."</strong>"
);
$sendgrid = new \SendGrid('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');
try {
    $response = $sendgrid->send($email);
    //print $response->statusCode() . "\n";
    //print_r($response->headers());
    //print $response->body() . "\n";
    include('../emailSuccess.html');
} catch (Exception $e) {
    echo 'Caught exception: '.  $e->getMessage(). "\n";
}

}
?>