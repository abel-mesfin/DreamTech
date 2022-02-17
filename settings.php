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
<head>
<title>Dream Tech Training</title>   
<link rel="icon" href="./images/favicon.png" type="image/png" sizes="16x16">
    <script src="https://kit.fontawesome.com/27a3960bc7.js" crossorigin="anonymous"></script>
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
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="./css/settings.css">  
     

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
     
        $adminCheck = checkAdmin($user);
        if($adminCheck[0]['admini'] == 1){$userPosts=$posts;}else{$userPosts = getAllUserPosts($user);
        $userPosts = array_reverse($userPosts);}
        
        
        echo "<div class='homepage' > <h1>Update Courses</h1></div>";

        echo '
        <form method="post">
        <label class="tagLabel">Search tags: </label>';
        echo ' <input class="search" type="text" name="search">';
        echo '<input class="tagSubmit" type="submit" name="submit">';
        echo '<input class="tagSubmit" type="submit" name="Allsubmit" value="All Posts">';
        echo '</form>';


        

        if(isset($_POST["submit"])){
           $arrOfPosts = searchTags($_POST['search']);
           foreach($arrOfPosts as $numPost){
               $finalAllPosts[] = getAllPostsByID($numPost);
               
           }
           //print_r($finalAllPosts[1][0]);

            for($x=0;$x < count($finalAllPosts);$x++){
                $userPosts = $finalAllPosts[$x];
                
                $nam = getName($userPosts[0]['user_id']);
                
                $full_name = $nam['FIRST_NAME'].' '.$nam['LAST_NAME'];
                $tim = strtotime($userPosts[0]['created_at']);
                $dat = date('l jS \of F Y  ', $tim);

                echo ' <div class="row"> <div class="leftcolumn"> <div class="posts">';

                if(empty($userPosts[0]['image_name'])): 

                    echo '<div class="defaultimg" style="height:160px;"><center>N/A</center></div>';
                 else: 
                
                echo '<img class="fakeimg" height="150" width="200" src="data:image;base64,'.$userPosts[0]['files'].'">';
                endif;
                 
                
                echo ' <div class="title"> <h1>' . $userPosts[0]['Title'] . '</h1> </div>' ;

                echo '<h5 >' . $full_name . '</h5>';

                echo ' <div class="time"> <p>' . $dat . '</p></div>';

                if(strlen($userPosts[0]['body']) > 550){echo '<p>' . substr($userPosts[0]['body'],0,180).'...' . '<p>';}
                else echo '<p>' . $userPosts[0]['body'] . '<p>';

                echo "<div class='editButton'> <a href='edit.php?ID=".$userPosts[0][ID]."'><button ><b>Edit </b></button></a>";
                echo "<div class='deleteButton'> <button id='delbutt' onclick='getConfirmation(".$userPosts[0][ID].")'><b>Delete </b></button>";
                echo '</div></div> </div> </div> ' ;



            };
        }elseif((isset($_POST["Allsubmit"]))) {
                for($x=0;$x < count($userPosts);$x++){
                $nam = getName($userPosts[$x]['user_id']);
                $full_name = $nam['FIRST_NAME'].' '.$nam['LAST_NAME'];
                $tim = strtotime($userPosts[$x]['created_at']);
                $dat = date('l jS \of F Y  ', $tim);

                echo ' <div class="row"> <div class="leftcolumn"> <div class="posts">';

                if(empty($userPosts[$x]['image_name'])): 

                    echo '<div class="defaultimg" style="height:160px;"><center>N/A</center></div>';
                 else: 
                
                echo '<img class="fakeimg" height="150" width="200" src="data:image;base64,'.$userPosts[$x]['files'].'">';
                endif;
                 
                
                echo ' <div class="title"> <h1>' . $userPosts[$x]['Title'] . '</h1> </div>' ;

                echo '<h5 >' . $full_name . '</h5>';

                echo ' <div class="time"> <p>' . $dat . '</p></div>';

                if(strlen($userPosts[$x]['body']) > 550){echo '<p>' . substr($userPosts[$x]['body'],0,180).'...' . '<p>';}
                else echo '<p>' . $userPosts[$x]['body'] . '<p>';

                echo "<div class='editButton'> <a href='edit.php?ID=".$userPosts[$x][ID]."'><button ><b>Edit </b></button></a>";
                echo "<div class='deleteButton'> <button id='delbutt' onclick='getConfirmation(".$userPosts[$x][ID].")'><b>Delete </b></button>";
                echo '</div></div> </div> </div> ' ;



            };
        }else{
            for($x=0;$x < count($userPosts);$x++){
                $nam = getName($userPosts[$x]['user_id']);
                $full_name = $nam['FIRST_NAME'].' '.$nam['LAST_NAME'];
                $tim = strtotime($userPosts[$x]['created_at']);
                $dat = date('l jS \of F Y  ', $tim);
                $arrayofFiles = $userPosts[$x]['files'];


                $files_arr =  explode (",", $arrayofFiles);


                echo ' <div class="row"> <div class="leftcolumn"> <div class="posts">';

                if(empty($userPosts[$x]['image_name'])): 

                    echo '<div class="defaultimg" style="height:160px;"><center>N/A</center></div>';
                 else: 
                
                    echo '<img class="fakeimg" height="180" width="200" src="media/'.$files_arr[0].'">';
                endif;
                 
                
                echo ' <div class="title"> <h1>' . $userPosts[$x]['Title'] . '</h1> </div>' ;

                echo '<h5 >' . $full_name . '</h5>';

                echo ' <div class="time"> <p>' . $dat . '</p></div>';

                if(strlen($userPosts[$x]['body']) > 550){echo '<p>' . substr($userPosts[$x]['body'],0,180).'...' . '<p>';}
                else echo '<p>' . $userPosts[$x]['body'] . '<p>';

                echo "<div class='editButton'> <a href='edit.php?ID=".$userPosts[$x][ID]."'><button ><b>Edit </b></button></a>";
                echo "<div class='deleteButton'> <button id='delbutt' onclick='getConfirmation(".$userPosts[$x][ID].")'><b>Delete </b></button>";
                echo '</div></div> </div> </div> ' ;



            };
        }
            
        ?>
        

    </div>
      
</body>
</html>
<?php endif; ?>