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
<link rel="icon" href="./images/favicon.png" type="image/png" sizes="16x16">

<script type="text/javascript">
            function getConfirmation(post_id) {
               var retVal = confirm("Do you want to continue ?");
               if( retVal == true ) {
                var url = "deletePost.php?ID="+post_id
                  window.location.href = url;
                  return true;
               } else {
                  
                  return false;
                  
               }
            }
         
      </script> 

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
    <script src="https://kit.fontawesome.com/27a3960bc7.js" crossorigin="anonymous"></script>
        <script type="text/javascript">
            function getConfirmation(post_id) {
               var retVal = confirm("Do you want to continue ?");
               if( retVal == true ) {
                var url = "deletePost.php?ID="+post_id
                  window.location.href = url;
                  return true;
               } else {
                  var url = "settings.php"
                  window.location.href = url;
                  return false;
                  
               }
            }
         
      </script>  
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="./css/drafts.css" />
    
    <title>Dream Tech Training</title>   
<link rel="icon" href="./images/favicon.png" type="image/png" sizes="16x16">

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
        $post = getAllPosts(); 
        $posts = array_reverse($post);
        $user = getUserId();
        $unpublished = checkPublished($user);
        //print_r($unpublished);

        foreach($unpublished as $postID){
            $finalAllPosts[] = getAllPostsByID($postID['ID']);
        }
        
        $posts = $finalAllPosts;
        
        echo "<div class='homepage' > <h1>Drafts</h1></div>";


           for($x=0;$x < count($posts);$x++){
                $nam = getName($posts[$x][0]['user_id']);
                $full_name = $nam['FIRST_NAME'].' '.$nam['LAST_NAME'];
                $tim = strtotime($posts[$x][0]['created_at']);
                $dat = date('l jS \of F Y  ', $tim);

                echo ' <div class="row"> <div class="leftcolumn"> <div class="posts">';

                if(empty($posts[$x][0]['image_name'])): 

                    echo '<div class="defaultimg" style="height:160px;"><center>N/A</center></div>';
                 else: 
                
                echo '<img class="fakeimg" height="150" width="200" src="data:image;base64,'.$posts[$x][0]['files'].'">';
                endif;
                 
                
                echo ' <div class="title"> <h1>' . $posts[$x][0]['Title'] . '</h1> </div>' ;

                echo '<h5 >' . $full_name . '</h5>';

                echo ' <div class="time"> <p>' . $dat . '</p></div>';

                if(strlen($posts[$x][0]['body']) > 550){echo '<p>' . substr($posts[$x][0]['body'],0,180).'...' . '<p>';}
                else echo '<p>' . $posts[$x][0]['body'] . '<p>';

                
                echo "<div class='editButton'> <a href='edit.php?ID=".$posts[$x][0]['ID']."'><button ><b>Edit </b></button></a>";
                echo "<div class='deleteButton'> <button id='delbutt' onclick='getConfirmation(".$posts[$x][0]['ID'].")'><b>Delete </b></button>";
                echo '</div></div> </div> </div> ' ;



            };
        
            
        ?>
        

    </div>
      
</body>
</html>
<?php endif; ?>