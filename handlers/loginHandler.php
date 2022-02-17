<?php
/*

Project Name: Milestone 3 Blog Post
Version 3
loginHandler.php module version 1
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
  echo "Connection to SQL server failed" . "<br>";
}else{
//echo "Connected successfully" . "<br>";
}


//Variables from form
$username = $_POST['username'];
$pass = $_POST['password'];


//Validate and check if user exists
if(empty($username)){
  echo "Username is a required field and cannot be blank.". "<br>";
}elseif(empty($pass)){
  echo "A Password is a required field and cannot be blank.". "<br>";
}

    $pass = MD5($pass);
    $sql = "SELECT ID, USERNAME, PASSWORD FROM users WHERE USERNAME='$username' AND BINARY PASSWORD= BINARY'$pass'";
    $result = $conn->query($sql);
    
    //Checks if any rows have returned and if so it logs in
    if ($result->num_rows == 1) {
        
        $row = $result->fetch_assoc();	// Read the Row from the Query
        saveUserId($row["ID"]);		// Save User ID in the Session
        include('../loginResponse.php');
    } elseif($result->num_rows == 0) {
       $message = "Login Failed";
       include('../loginFailed.php');
    }else{
        $message = "There are multiple users that have registered";
        include('loginError.php');
    }
  



//Check for succesful record creation
if($conn->query($sql) == TRUE){
    //echo "New record created succesfully". "<br>";
}
else{
    //echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();


?> 
