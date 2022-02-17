<!--
Project Name: Milestone 3 Blog Post
Version 3
postHandler.php module version 1
Abel Mesfin 
10/20/2020
The modules purpose is to create a html form that shows the user the required fields for regiseration
-->

<html>
<script>
    $("#success").click(function () {
  $(".notify").toggleClass("active");
  $("#notifyType").toggleClass("success");
  
  setTimeout(function(){
    $(".notify").removeClass("active");
    $("#notifyType").removeClass("success");
  },2000);
});

$("#failure").click(function () {
  $(".notify").addClass("active");
  $("#notifyType").addClass("failure");
  
  setTimeout(function(){
    $(".notify").removeClass("active");
    $("#notifyType").removeClass("failure");
  },2000);
});
</script>
</html>


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
$first = $_POST['first_name'];
$last = $_POST['last_name'];
$vari = getUserId();
$email = $_POST['email'];
$username = $_POST['username'];
$old_password = $_POST['old_password'];
$user_ID = $_POST['userNumber'];
$currentUsername = getCurrentUsername($user_ID);
$admin = $_POST['admin'];
if(empty($admin)){
    $admin = 0;
}else{
    $admin = 1;
}


$pwd = $_POST['password'];
$confirm = $_POST['confirm'];
$saved_usernames = getUsernames();
$aValid = array('-', '_', '.');

//foreach($saved_usernames as $su){
  //  print_r($su["USERNAME"]);
//}

if(empty($first)){
  echo "A first name is a required field and cannot be blank.". "<br>";
}elseif(empty($email)){
  echo "A email is a required field and cannot be blank.". "<br>";
}elseif(empty($username)){
  echo "A username is a required field and cannot be blank.". "<br>";
}elseif(strpos($username, ' ') || ctype_space($username[0])){
  echo "Invalid username. Can not include spaces". "<br>";
}elseif(!ctype_alnum(str_replace($aValid, '', $username))){
  echo "Unable to make post. There is a special characheter in the body". "<br>";
}elseif($pwd != $confirm){
    echo "Unable to make post. Password does not match". "<br>";
    
}elseif(!ctype_alnum(str_replace($aValid, '', $username))){
  echo "Unable to make post. There is a special characheter in the body". "<br>";
}else{
    $currentUsername = strtolower($currentUsername[0]['USERNAME']);
    foreach($saved_usernames as $su){
    $saved = $su["USERNAME"];
    $saved = strtolower($saved);
    $user = strtolower($username);
    //$user = str_replace(' ', '', $user);
    if ($saved == $user){
        if($user == $currentUsername){
            $success = "Same";
        }else{
            echo "The chosen username already exists, please choose another.". "<br>";
            $success = "Error";
        }
    break;
    }else{
        $success = "Changed";
    }
    $success = True;
    }

    try {
        if($success == "Changed"){
            if(!empty($pwd)){
            $sql = "UPDATE users SET FIRST_NAME='".$first."', LAST_NAME='".$last."', EMAIL='".$email."', PASSWORD='".$pwd."', USERNAME='".$username."', admini='".$admin."' WHERE ID = ".$user_ID;
                header("Location: " . $baseE . "updateSuccess.html");
            }else{
                $sql = "UPDATE users SET FIRST_NAME='".$first."', LAST_NAME='".$last."', EMAIL='".$email."', USERNAME='".$username."', admini='".$admin."' WHERE ID = ".$user_ID;
                  header("Location: " . $baseE . "updateSuccess.html");
            }
        }elseif($success == "Same"){
            if(!empty($pwd)){
            $sql = "UPDATE users SET FIRST_NAME='".$first."', LAST_NAME='".$last."', EMAIL='".$email."', PASSWORD='".$pwd."', admini='".$admin."' WHERE ID = ".$user_ID;
               header("Location: " . $baseE . "updateSuccess.html");
            }else{
                $sql = "UPDATE users SET FIRST_NAME='".$first."', LAST_NAME='".$last."', EMAIL='".$email."', admini='".$admin."' WHERE ID = ".$user_ID;
                  header("Location: " . $baseE . "updateSuccess.html");
            }
        }
        $update = 1;
        //Check for succesful record creation
        if($conn->query($sql) == TRUE){
            echo "New record created succesfully". "<br>";
        }
        else{
            //echo "Error: " . $sql . "<br>" . $conn->error;
        }

    }catch(Exception $e){
        $update = 0;
    }

}


//header("Location: http://localhost:8888/Milestone4/settings.php?success=".$update);
//exit();




$conn->close();



?>
