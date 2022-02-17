<!--
Project Name: Milestone 3 Blog Post
Version 3
newPost module version 1
Abel Mesfin 
10/20/2020
The modules purpose is to create a html form that shows the user the required fields for regiseration
-->
<?php 
require_once('myfuncs.php');
require_once('utility.php');
$vari = getUserId()?>
<?php if(!empty($vari) ): ?>
<html>
<head>
<script src="https://kit.fontawesome.com/27a3960bc7.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
    <script> 
   

    function cler(){
    var cats = document.getElementById('categories').value 
        
    if(cats != ''){
    if(document.getElementById('hideCats').value  != ''){
        window.end = ' #'+ cats
    }else{
        window.end = '#'+cats
    }
    
    
    window.leng = end.length
    //alert(document.getElementbyID('catsLabel')innerHTML)
    document.getElementById('catsLabel').innerHTML = document.getElementById('catsLabel').innerHTML + window.end
    document.getElementById('hideCats').value = document.getElementById('catsLabel').innerHTML
    document.getElementById('categories').value = ''
    }  
    

    }
    function remove(){
        var lengthStr = document.getElementById('catsLabel').innerHTML.length
        var yo = window.end
        var total = document.getElementById('catsLabel').innerHTML
        var first = total.lastIndexOf("#") -1
        var number_ofchar = lengthStr-first
        var test = total.substring(0,lengthStr - number_ofchar)
        document.getElementById('catsLabel').innerHTML = test
        document.getElementById('hideCats').value = test
        
    }
    </script>

          
    <link rel="stylesheet" href="./css/deletePost.css" />
    

</head>

<body>



<div class="notify"><span id="notifyType" class=""></span></div>
    
    <div class="topnav">
        <a class="active" href="loginResponse.php">
            <i class="fas fa-home fa-lg"></i>
        </a>
        
          

        <div class="btnright">
           <a class="active" href="signOut.php">
               <i class="fas fa-sign-out-alt"></i>
           </a>
        </div>

        <div class="navTitle">
            <h3> Edit page </h3>
        </div>
        
    </div>

    <div class="page">
    
        <center>
            <h1> Deletion succesful</h1>
                <div class="home">
                    <a href="settings.php"><button>Back to Settings</button></a>
                </div>
        </center>

    </div>

    
      
<body>
    
</html>
<?php

require_once('myfuncs.php');

$post_ID = $_GET['ID'];

$conn = dbConnect();


// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
  echo "Connection to SQL server failed" . "<br>";
}else{
//echo "Connected successfully" . "<br>";
}


try {
    $sql = "DELETE FROM posts WHERE ID = ".$post_ID;
    //$sql = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'activity1' AND   TABLE_NAME   = 'posts'; ";
    
}catch(Exception $e){
    alert("Error can not delete post");
}
$result = $conn->query($sql);


//Check for succesful record creation
if( $result == TRUE){
    $row = mysqli_fetch_assoc($result);
}
else{
//   echo "Error: " . $sql . "<br>" . $conn->error;
}


try {
    $sql = "SELECT `AUTO_INCREMENT` FROM INFORMATION_SCHEMA.TABLES WHERE TABLE_SCHEMA = 'activity1' AND   TABLE_NAME   = 'posts'; ";
    
}catch(Exception $e){
    alert("Error can not delete post");
}
$result = $conn->query($sql);
if( $result == TRUE){
$row = mysqli_fetch_assoc($result);
$inc = $row['AUTO_INCREMENT'] -1;
}else{
//    echo "Error: " . $sql . "<br>" . $conn->error;
}


$sql = "ALTER TABLE posts AUTO_INCREMENT = ".$inc;
$result = $conn->query($sql);
if( $result == TRUE){
}else{
//    echo "Error: " . $sql . "<br>" . $conn->error;
}


$conn->close();

?>
<?php else: ?>
    <html>
        <body>
            <p>Error you are not logged in</p>
        </body>
    </html>
<?php endif; ?>