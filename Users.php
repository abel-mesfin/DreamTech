<!--
Project Name: Milestone 3 Blog Post
Version 3
index.php module version 1
Abel Mesfin 
10/20/2020
The modules purpose is to create a html form that shows the user the required fields for regiseration
-->
<?php 



include_once('myfuncs.php');
if(empty(getUserId()) ): ?>




<html>
<head >
    <title>Dream Tech Training</title>   



    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: rgb(25, 168, 187);
        }
    
        .topnav {
            overflow: hidden;
            background-color: #333;
        }
    
        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }
    
        .topnav a.active {
            background-color: rgb(12, 99, 110);
            color: white;
        }
    
        .Header {
            text-align: center;
        }
    </style>      

</head>

<body >
    <div class="Header">
        <h2>Dream Tech Training</h2>
    </div>

    <div class="topnav">
        <a class="active" href="login.html">Login</a>
        <a class="active" href="register.html">Register</a>       
        
    </div>
       
    
</body>

<?php else: ?>
    <?php

    require_once('utility.php');
    $user = getUserId();
     
    $adminCheck = checkAdmin($user);
    if($adminCheck[0]['admini'] == 1): ?>

<head>
<title>Dream Tech Training</title>   
<link rel="icon" href="./images/favicon.png" type="image/png" sizes="16x16">  
    <script src="https://kit.fontawesome.com/27a3960bc7.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function getConfirmation(user_id) {
               var retVal = confirm("Do you want to continue ?");
               if( retVal == true ) {
                var url = "deleteUser.php?ID="+user_id
                  window.location.href = url;
                  return true;
               } else {
                  
                  return false;
                  
               }
            }
         
      </script>  
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./css/users.css" />


</head>

<body>
    <div class="topnav">
        <a class="active" href="newpost.php">
            <i class="fas fa-plus fa-lg"></i> New
        </a>
        <a class="active" href="index.php">
        <i class="fas fa-home fa-lg"></i>
        </a>
          

        <div class="btnright">

            <div class="dropdown">
                <button class="dropbtn">
                <i class="fas fa-cogs fa-lg"></i>
                </button>
                <div class="dropdown-content">
                <a href="drafts.php">Drafts</a>
                <a href="Profile.php">Account</a>
                <a href="settings.php">Update</a>
                <a href="Users.php">Users</a>
                </div>
            </div> 
            <a class="active" href="signOut.php">
            <i class="fas fa-sign-out-alt"></i>
            </a> 
        </div>

        <div class="navTitle">
            <h3> Dream Tech Training </h3>
        </div>
        
    </div>

    <div class="page">
       
        <?php
        require_once('utility.php');
        $user = getAllUsers(); 
        $users = array_reverse($user);
        $user = getUserId();
     
        $adminCheck = checkAdmin($user);
        if(!is_null($adminCheck[0]['admini'])){$userPosts=$posts;}else{$userPosts = getAllUserPosts($user);
        $userPosts = array_reverse($userPosts);}
        
        
        echo "<div class='homepage' > <h1>Users</h1></div>";
        //print_r($users);


             for($x=0;$x < count($users);$x++){
                $userPosts = $users;
                
                $full_name = $userPosts[$x]['first_name'].' '.$userPosts[$x]['last_name'];

                echo ' <div class="row"> <div class="leftcolumn"> <div class="posts">';
                
                echo ' <div class="title"> <h1>' . $full_name . '</h1> </div>' ;

                echo "<div class='editButton'> <a href='userEdit.php?ID=".$userPosts[$x]['ID']."'><button ><b>Edit </b></button></a>";
                echo "<div class='deleteButton'> <button id='delbutt' onclick='getConfirmation(".$userPosts[$x]['ID'].")'><b>Delete </b></button>";
                echo '</div></div> </div> </div> ' ;



            };
        
            
        ?>
        

    </div>
      
</body>
</html>
<?php else: ?>

<html>
<head >
    <title>My Activity 2 Application</title>   



    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
            background-color: rgb(25, 168, 187);
        }
    
        .topnav {
            overflow: hidden;
            background-color: #333;
        }
    
        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }
    
        .topnav a.active {
            background-color: rgb(12, 99, 110);
            color: white;
        }
    
        .Header {
            text-align: center;
        }
    </style>      

</head>

<body >
    <div class="Header">
        <h2>You do not have permission to view this page. </h2>
    </div>


       
    
</body>
<?php endif; ?>
<?php endif; ?>