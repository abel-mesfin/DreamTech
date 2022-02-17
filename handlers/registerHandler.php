<?php
/*

Project Name: Milestone 3 Blog Post
Version 3
registerHadler.php module version 1
Abel Mesfin 
10/20/2020
The modules purpose is to create a html form that shows the user the required fields for regiseration


*/

//echo "You are now registered." . "<br>"; 

include('../myfuncs.php');

$conn = dbConnect();


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
//echo "Connected successfully" . "<br>";
}

//Variables from form
$first = $_POST['first_name'];
$last = $_POST['last_name'];
$email = $_POST['email'];
$username = $_POST['username'];
$pass = $_POST['password'];
$confirm = $_POST['confirm'];
$birthday = $_POST['birthday'];
$org = $_POST['organiz'];

//Encrypt Password
$pass = MD5($pass);
$confirm = MD5($confirm);

//Validate and insert data into users table in database
if(empty($first)){
  echo "The First Name is a required field and cannot be blank.". "<br>";
}elseif(empty($email) || empty($pass) || empty($birthday)|| empty($username)){
  echo "Please go back and fill out missing fields". "<br>";
}elseif($pass != $confirm){
  echo "Passwords do not match". "<br>";
  echo $pass. "<br>";
  echo $confirm;
}else{
$sql = "INSERT INTO `users` (`id`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `PASSWORD`, `BIRTHDAY`, `USERNAME`, `ORGANIZATION`) 
VALUES (NULL, '$first', '$last', '$email', '$pass', '$birthday', '$username', '$org')";
}


//Check for succesful record creation
if($conn->query($sql) == TRUE){

  $nsql = "SELECT ID, USERNAME, PASSWORD FROM `users` WHERE USERNAME='$username' AND BINARY PASSWORD= BINARY'$pass'";
  $result1 = $conn->query($nsql);
  if ($result1->num_rows == 1) {
        
    $row = $result1->fetch_assoc();	// Read the Row from the Query
    saveUserId($row["ID"]);		// Save User ID in the Session
    include('../registerResponse.php');  
  
  //echo "New record created succesfully". "<br>";
  }
}else{
  include('../registerFailed.php'); 
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();

?>