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
<title>Dream Tech Training</title>   
<link rel="icon" href="./images/favicon.png" type="image/png" sizes="16x16">

<script src="https://kit.fontawesome.com/27a3960bc7.js" crossorigin="anonymous"></script>
<script type="text/javascript" src="js/bootstrap-filestyle.min.js"> </script>
    <script type='text/javascript'> 

    function checkUsernames(){
        
        var username = document.getElementById('usernam').value
        var low_username = username.replaceAll(" ","").toLowerCase();
        <?php 
        $user = getUsernames(); ?>
        //alert(user)
        var book = <?php echo json_encode($user, JSON_PRETTY_PRINT); ?>;
        for(var i = 0; i < book.length ; i++){
          var saved_names = Object.values(book[i])
          //alert(saved_names);
          var low_names = String(saved_names);
          var low_names = low_names.toLowerCase();
          //alert(low_username);
          if( low_username == low_names){
                document.getElementById('userLab').innerHTML = "Username Taken"
                break;
            }else if(low_username.length <= 3){
            document.getElementById('userLab').innerHTML = "Username too short"

            }else{
            document.getElementById('userLab').innerHTML = "Username available"
        }
        }
        
        
        
        
        /*
        if( username == "Amesfin"){
            document.getElementById('userLab').innerHTML = "Yes"
        }else{
            document.getElementById('userLab').innerHTML = ""
        }
        */
        
    }
   

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


    <link rel="stylesheet" href="./css/profile.css" />


</head>

<body>



<div class="notify"><span id="notifyType" class=""></span></div>
    
    <div class="topnav">
        <a class="active" href="loginResponse.php">
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
            <h3> Edit page </h3>
        </div>
        
    </div>

    <div class="page">
    <?php
        $user_ID = getUserId();
        $user = getOneUser($user_ID);
        $curr_user = getUserId();
        $adminCheck = checkAdmin($curr_user);
        


       echo '<form action="userEditForm.php" method="POST" enctype="multipart/form-data" action="">';

        echo '<input  type="hidden" name="userNumber" value="'.$user_ID.'"> ';
        echo    'First Name: <input type="text" value="'.$user[0]['FIRST_NAME'].'" name="first_name" size=56 style="height:30;"> <br>';
        echo    'Last Name: <input type="text" value="'.$user[0]['LAST_NAME'].'" name="last_name" size=56 style="height:30;"> <br>';
        echo    'Email: <input type="text" value="'.$user[0]['EMAIL'].'" name="email" size=56 style="height:30;"> <br>';
        echo    'Username: <input type="text" oninput="checkUsernames()" value="'.$user[0]['USERNAME'].'" id="usernam" name="username" size=56 style="height:30;"> <label class="bodLabel" for="textArea" id="userLab"></label><br>';
        if(!is_null($adminCheck[0]['admini'])){}else{echo    'Old Password: <input type="password" name="old_password" size=56 style="height:30;"> <br>';}
        
        echo    'Password: <input type="password"  name="password" size=56 style="height:30;"> <br>';
        echo    'Confirm: <input type="password" name="confirm" size=56 style="height:30;"> <br>';
        echo    '<input type="submit" value="Update" name="post">';
        
       echo '</form>';
        

    ?>

    </div>


      
<body>
    
</html>
<?php else: ?>
    <html>
        <body>
            <p>Error you are not logged in</p>
        </body>
    </html>
<?php endif; ?>