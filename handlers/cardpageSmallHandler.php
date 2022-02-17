<?php


include('../myfuncs.php');

$conn = dbConnect();

//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);



// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}else{
//echo "Connected successfully" . "<br>";
}

//Variables from form
$fullName = $_POST['fullName'];
$nameCard = $_POST['nameCard'];
$email = $_POST['email'];
$address = $_POST['address'];
$cardNum = $_POST['cardNum'];
$city = $_POST['city'];
$expirM = $_POST['expirM'];
$expirY = $_POST['expirY'];
$state = $_POST['state'];
$zip = $_POST['zip'];
$cvv = $_POST['cvv'];

//Validate and insert data into users table in database
if(empty($fullName)){
  echo "The First Name is a required field and cannot be blank.". "<br>";
}elseif(empty($nameCard) || empty($address) || empty($cardNum)|| empty($city) || empty($expirM) || empty($expirY) || empty($state) || empty($zip) || empty($cvv)|| empty($email)){
  echo "Please go back and fill out missing fields". "<br>";
}else{
//$sql = "INSERT INTO `users` (`id`, `FIRST_NAME`, `LAST_NAME`, `EMAIL`, `PASSWORD`, `BIRTHDAY`, `USERNAME`, `ORGANIZATION`) 
//VALUES (NULL, '$first', '$last', '$email', '$pass', '$birthday', '$username', '$org')";
//print("Success");
//include('../purchaseSuccess.php');
}
?>

<meta id="baseurl" http-equiv="refresh" content="<?php echo $baseU; ?>/purchaseSuccess.php" />


<?php









//Check for succesful record creation
//if($conn->query($sql) == TRUE){

  //$nsql = "SELECT ID, USERNAME, PASSWORD FROM `users` WHERE USERNAME='$username' AND BINARY PASSWORD= BINARY'$pass'";
  //$result1 = $conn->query($nsql);
  //if ($result1->num_rows == 1) {
        
    //$row = $result1->fetch_assoc();	// Read the Row from the Query
    //saveUserId($row["ID"]);		// Save User ID in the Session
    //include('../.php');  
  
  //echo "New record created succesfully". "<br>";
 // }
//}else{
  //include('../registerFailed.php'); 
  //echo "Error: " . $sql . "<br>" . $conn->error;
//}

$conn->close();

?>