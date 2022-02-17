<!--
Project Name: Milestone 3 Blog Post
Version 3
postHandler.php module version 1
Abel Mesfin 
10/20/2020
The modules purpose is to create a html form that shows the user the required fields for regiseration
-->
<?php



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
$small = $_POST['smallChoice'];
$large = $_POST['largeChoice'];


//if(empty($Title)){
//  echo "A title is a required field and cannot be blank.". "<br>";
//}else{
//$sql = "INSERT INTO `posts` (`id`, `user_id`, `Title`, `body`, `published`,`image_name`, `files`, `Categories` ) 
//VALUES (NULL, '$vari', '$Title', '$body', '$published','$name', '$image', '$cats')";

//}

//Check for succesful record creation
//if($conn->query($sql) == TRUE){
//   echo "New record created succesfully". "<br>";
//    header("Location: http://localhost:8888/Milestone9/updateSuccess.html");
//}
//else{
//  echo "<script>";
//    echo "alert('Error could not make post')";
//    echo"</script>";
//    //echo "Error: " . $sql . "<br>" . $conn->error;
//}

if (isset($small)) {
    print("small");
    header("Location: " . $baseE . "cardInformation.php?purchase=small");
}elseif(isset($large)){
    print("large");
    header("Location: " . $baseE . "cardInfoLarge.php?purchase=large");

}

//$conn->close();



?>
