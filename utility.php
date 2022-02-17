<?php
require_once('myfuncs.php');

//$conn = dbConnect();
// Check connection
/*if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  echo "Connection to SQL server failed" . "<br>";
}else{
//echo "Connected successfully" . "<br>";
}*/

function getAllUsers() {
  $conn = dbConnect();
  $sql = "SELECT ID, first_name, last_name, admini FROM users";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $users[] = $row;
    }
  }else {
  echo "0 results";
  }
  //print_r($users);
return $users;


}


function searchTags($search) {
  $conn = dbConnect();
  $sql = "SELECT ID, Categories FROM posts";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $cat[] = $row;
     
    }
    foreach($cat as $key){
      $cat_arr = explode(" ",$key['Categories']);
       foreach($cat_arr as $tag){
        if (stripos($tag,$search)){
          if (!in_array($key["ID"], $tagPosts)) {
          $tagPosts[] = $key["ID"];
          }
        }
       };
       //print_r($key['ID']);
     }
  }else {
  echo "0 results";
  }
  return($tagPosts);
//print_r($cat[0]);


}

function searchTitle($search) {
  $conn = dbConnect();
  $sql = "SELECT ID, Title FROM posts";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $cat[] = $row;
     
    }
    foreach($cat as $key){
      $key['Title'] = strtolower($key['Title']);
      $search = strtolower($search);
      if(stripos($key['Title'],$search)!== false){
        $tagPosts[] = $key["ID"];
      }
       
     }
  }else {
  echo "0 results";
  }
  return($tagPosts);
//print_r($cat[0]);


}

function searchBody($search) {
  $conn = dbConnect();
  $sql = "SELECT ID, body FROM posts";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $cat[] = $row;
     
    }
    foreach($cat as $key){
      $key['body'] = strtolower($key['body']);
      $search = strtolower($search);
      if(stripos($key['body'],$search)!== false ){
        $tagPosts[] = $key["ID"];
        //if (!in_array($key["ID"], $tagPosts)) {
        
        
        //}
      }
       
       //print_r($key['ID']);
     }
  }else {
  echo "0 results";
  }
  return($tagPosts);
//print_r($cat[0]);


}

function findName($search) {

  $conn = dbConnect();
  $sql = "SELECT ID, FIRST_NAME, LAST_NAME FROM users";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $cat[] = $row;
     
    }
   
    foreach($cat as $key){
      $key['FIRST_NAME'] = strtolower($key['FIRST_NAME']);
      $key['LAST_NAME'] = strtolower($key['LAST_NAME']);
      $search = strtolower($search);
      //echo $key["LAST_NAME"];
      if(stripos($key['FIRST_NAME'],$search)!== false or stripos($key['LAST_NAME'],$search)!== false){
        $tagPosts[] = $key["ID"];
        //if (!in_array($key["ID"], $tagPosts)) {
        
        
        //}
      }
       
       //print_r($key['ID']);
     }
  }else {
  echo "0 results";
  }
  return($tagPosts);
//print_r($cat[0]);


}


function searchName($userIDs) {
  $conn = dbConnect();
  $sql = "SELECT ID FROM posts where user_id = ".$userIDs;

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $cat[] = $row;
     
    }
    foreach($cat as $key){
 
        $tagPosts[] = $key["ID"];
        //if (!in_array($key["ID"], $tagPosts)) {
        
        
        //}
      
       
       //print_r($key['ID']);
     }
  }else {
  echo "0 results";
  }
  return($tagPosts);
//print_r($cat[0]);


}

function searchComments($postID) {
  $conn = dbConnect();
  $sql = "SELECT comment, user FROM comments WHERE post_id  = ".$postID;

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $users[] = $row;
    }
  }else {
  //echo "0 results";
  }
  //print_r($users);
return $users;


}


function checkAdmin($userID) {
  $conn = dbConnect();
  $sql = "SELECT admini FROM users WHERE ID = ".$userID;

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $users[] = $row;
    }
  }else {
  echo "0 results";
  }
  //print_r($users);
return $users;


}

function checkPublished($userID) {
  $conn = dbConnect();
  $sql = "SELECT ID FROM posts WHERE published = 0 and user_id = ".$userID;

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $users[] = $row;
    }
    
  }else {
  echo "0 results";
  }
  //print_r($users);
return $users;


}

function getAllPostsByID($ID) {
  $conn = dbConnect();
  $sql = "SELECT ID,user_id, Title, body, image_name,files,created_at,published,Categories FROM posts WHERE ID =".$ID;

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $posts[] = $row;
    }
  }else {
  echo "0 results";
  }
  //print_r($users);
return $posts;


}

function getAllPosts() {
  $conn = dbConnect();
  $sql = "SELECT ID,user_id, Title, body, image_name,files,created_at,published,Categories FROM posts";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $posts[] = $row;
    }
  }else {
  echo "0 results";
  }
  //print_r($users);
return $posts;


}

function getAllPublishedPosts() {
  $conn = dbConnect();
  $sql = "SELECT ID,user_id, Title, body, image_name,files,created_at,published,Categories FROM posts WHERE published = 1";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $posts[] = $row;
    }
  }else {
  echo "0 results";
  }
  //print_r($users);
return $posts;


}

function getAllUserPosts($user) {
  $conn = dbConnect();
  $sql = "SELECT ID,user_id, Title, body, image_name,files,created_at,published,Categories FROM posts WHERE user_id = ".$user;

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $posts[] = $row;
    }
  }else {
  echo "0 results";
  }
  //print_r($users);
return $posts;


}

function getOnePost($postNumber) {
  $conn = dbConnect();
  $sql = "SELECT * FROM posts where ID = ".$postNumber;

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $posts[] = $row;
    }
  }else {
  echo "0 results";
  }
  //print_r($users);
return $posts;


}

function getOneUser($user_ID) {
  $conn = dbConnect();
  $sql = "SELECT * FROM users where ID = ".$user_ID;

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $posts[] = $row;
    }
  }else {
  echo "0 results";
  }
  //print_r($users);
return $posts;


}

function getUsernames() {
  $conn = dbConnect();
  $sql = "SELECT USERNAME FROM users";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $posts[] = $row;
    }
  }else {
  echo "0 results";
  }
  //print_r($users);
return $posts;


}

function getCurrentUsername($user_ID) {
  $conn = dbConnect();
  $sql = "SELECT USERNAME FROM users where ID = " .$user_ID;

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $posts[] = $row;
    }
  }else {
  //echo "0 results";
  }
  //print_r($users);
return $posts;


}

function getEmails() {
  $conn = dbConnect();
  $sql = "SELECT EMAIL FROM users";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $posts[] = $row;
    }
  }else {
  //echo "0 results";
  }
  //print_r($users);
return $posts;


}


function getUserFromEmail($email){
    $conn = dbConnect();
  $sql = "SELECT USERNAME FROM users where EMAIL = '" . $email ."'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $posts[] = $row;
    }
  }else {
  echo "0 results";
  }
  //print_r($users);
return $posts;
}

function getIDByEmail($email){
    $conn = dbConnect();
  $sql = "SELECT ID FROM users where EMAIL = '" . $email ."'";

  $result = $conn->query($sql);

  if ($result->num_rows > 0) {
  // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
     $posts[] = $row;
    }
  }else {
  //echo "0 results";
  }
  //print_r($users);
return $posts;
}



function getName($ID){
  $conn = dbConnect();
  $sql = "SELECT FIRST_NAME, LAST_NAME FROM users where ID = ".$ID;
  $result = $conn->query($sql);
  $row = mysqli_fetch_assoc($result);
  return $row;
}


function getRate($post, $IDuser){
  $conn = dbConnect();
  $sql = "SELECT rate FROM ratings where post = ".$post." and user = " . $IDuser;
  $result = $conn->query($sql);
  $row = mysqli_fetch_assoc($result);
  return $row;
}



//searchTags();
//$conn->close();

?>