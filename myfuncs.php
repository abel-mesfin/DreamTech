<!--
Project Name: Milestone 3 Blog Post
Version 3
myfuncs.php module version 1
Abel Mesfin 
10/20/2020
The modules purpose is to create a html form that shows the user the required fields for regiseration
-->
<?php

//Base Website URL
$baseE = "https://dreamtechllc.azurewebsites.net/";
$baseU = "0; URL=https://dreamtechllc.azurewebsites.net/";


function dbConnect() {
//Mysql connection info
$servername = "127.0.0.1:50552";
$username = "azure";
$password = "6#vWHD_$";
$dbname = "activity1";


$conn = new mysqli($servername, $username, $password, $dbname);

return $conn;

}



function saveUserId($id)
{
	session_start();
	$_SESSION["USER_ID"] = $id;
}
function getUserId()
{
	session_start();
	return $_SESSION["USER_ID"];
}

function getTheUserID()
{
	//session_start();
	return $_SESSION["USER_ID"];
}

function endSession(){
	session_destroy();
}

?>
