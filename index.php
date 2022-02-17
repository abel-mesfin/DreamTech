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
      

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Free JavaScript library for star rating. Star Rating system">
    <meta name="keywords" content="HTML, CSS, JavaScript, library, free">
    <meta name="author" content="Djordje Vujicic">

    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="476" />
    <meta property="og:image:height" content="286" />
    <meta property="og:image:alt" content="Star rating" />
    <meta property="og:url" content="https://starratingjs.netlify.app">

    <link rel="icon" href="./images/favicon.png" type="image/png" sizes="16x16">
    <title>Dream Tech Training</title>
    <script src="index.js"></script>
    
     <link rel="stylesheet" href="./css/index1.css"> 
    

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

     <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="476" />
    <meta property="og:image:height" content="286" />
    <meta property="og:image:alt" content="Star rating" />
    <meta property="og:url" content="https://starratingjs.netlify.app">

    <link rel="icon" href="./images/favicon.png" type="image/png" sizes="16x16">
    <title>Dream Tech Training</title>
    <script src="index.js"></script>

    <script src="https://kit.fontawesome.com/27a3960bc7.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./css/index.css">  
    
    

</head>

<body>
    <div class="topnav">
        <div class="btnleft">
            <a class="active" href="newpost.php">
                <i class="fas fa-plus fa-lg"></i> New
            </a>
            <a class="active" href="index.php">
            <i class="fas fa-home fa-lg"></i>
            </a>
        </div>

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
        $post = getAllPublishedPosts();
        $posts = array_reverse($post);
        
        

        echo "<div class='homepage' > <h1>Homepage</h1></div>";

        echo '
        <form class="searchField" method="post">
        <label class="tagLabel">Search courses by: </label>';
        echo '<select name="criteria" id="cars">
            <option value="Title">Title</option>
            <option value="body">Body</option>
        </select>';
        echo ' <input class="search" type="text" name="search">';
        echo '<input class="tagSubmit" type="submit" name="submit">';
        echo '<input class="tagSubmit" type="submit" name="Allsubmit" value="All Posts">';
        echo '</form>';
        $userNum = getUserId();

        if(isset($_POST["submit"])){
            if($_POST["criteria"] === "Tag" ){
                $arrOfPosts = searchTags($_POST['search']);
            }elseif($_POST["criteria"] === "Title"){
                $arrOfPosts = searchTitle($_POST['search']);
            }elseif($_POST["criteria"] === "body"){
                $arrOfPosts = searchBody($_POST['search']);
            }elseif($_POST["criteria"] === "name"){
               $usersID = findName($_POST['search']);
               foreach($usersID as $IDNum){
                $allUsers[] = searchName($IDNum);
               }
               $arrOfPosts = $allUsers;
                
            }
        
            if($_POST["criteria"] === "name"){
                foreach($arrOfPosts as $numPost){
                    foreach($numPost as $numID){
                        $finalAllPosts[] = getAllPostsByID($numID);
                    }
                    //print_r($numPost);
                    
                    
                }
            }else{
                foreach($arrOfPosts as $numPost){
                    $finalAllPosts[] = getAllPostsByID($numPost);    
                }
            }
           //print_r($finalAllPosts[1][0]);

            for($x=0;$x < count($finalAllPosts);$x++){
                $userPosts = $finalAllPosts[$x];
                $postComment = searchComments($userPosts[$x][ID]);
                $nam = getName($userPosts[0]['user_id']);
                
                $full_name = $nam['FIRST_NAME'].' '.$nam['LAST_NAME'];
                $tim = strtotime($userPosts[0]['created_at']);
                $dat = date('l jS \of F Y  ', $tim);
                $postID = $userPosts[0][ID];
                $rating = getRate($postID,$userNum)[rate];
                $arrayofFiles = $posts[$x]['files'];

                $files_arr =  explode (",", $arrayofFiles);


                echo ' <div class="row"> <div class="leftcolumn"> <div class="posts">';

                if(empty($userPosts[0]['image_name'])): 

                    echo '<div class="defaultimg" style="height:160px;"><center>N/A</center></div>';
                 else: 
                
                 echo '<img class="fakeimg" height="150" width="200" src="media/'.$files_arr[0].'"></img>';
                endif;
                 
                
                echo ' <div class="title"> <h1>' . $userPosts[0]['Title'] . '</h1> </div>' ;

 

                echo ' <div class="time"> <p>' . $dat . '</p></div>';

                if(strlen($userPosts[0]['body']) > 550){echo '<p>' . substr($userPosts[0]['body'],0,180).'...' . '<p>';}
                else echo '<p>' . $userPosts[0]['body'] . '<p>';

                echo "<div class='readMore'> <a href='readPost.php?user=".urlencode(base64_encode("$userNum"))."&ID=".urlencode(base64_encode("$postID"))."'><button name=readBtn'".$x."'><b>READ MORE »</b></button></a>";
                
                
                echo '</div></div> </div> </div> ' ;
                /*
                #THis section is for if I want a comment section under each entry under homepage
                echo ' <div class="row"> <div class="leftcolumn"> <div class="commentSection">';
                echo ' <p class="viewComment"> View all comments</p>';
                echo '
                
                ';
                $a = 0;
                foreach($postComment as $pc){
                    echo "<div class='commentDivName'>";
                    echo getName($pc[user])[FIRST_NAME].' ';
                    echo " ";
                    echo "</div>";
                    echo "<div class='commentDiv'>";
                    if(strlen($pc[comment]) > 50){echo substr($pc[comment],0,50).'...' ;}
                    else{ echo $pc[comment];}
                
                    //echo $pc[comment];
                    echo "</div>";

                    echo '<br>';
                    $a = $a+1;
                    if($a == 3){
                    break;
                    }
                    
                }   

                #echo ' <div class="rightcolumn">Your rate: <label   class="yourLabel" name="rateNum"  >'.$rating.'</label></div></div></div>  </div>' ;
                */
            };
            
        }elseif((isset($_POST["Allsubmit"]))) {
            for($x=0;$x < count($posts);$x++){
                $postComment = searchComments($posts[$x][ID]);
                $nam = getName($posts[$x]['user_id']);
                $full_name = $nam['FIRST_NAME'].' '.$nam['LAST_NAME'];
                $tim = strtotime($posts[$x]['created_at']);
                $dat = date('l jS \of F Y  ', $tim);
                $postID = $posts[$x][ID];
                $rating = getRate($postID,$userNum)[rate];
                $arrayofFiles = $posts[$x]['files'];

                $files_arr =  explode (",", $arrayofFiles);


                echo ' <div class="row"> <div class="leftcolumn"> <div class="posts">';

                //if(empty($posts[$x]['image_name'])): 

                  //  echo '<div class="defaultimg" style="height:160px;"><center>N/A</center></div>';
                // else: 
                
                    echo '<img height="150" width="200" src="media/'.$files_arr[0].'">';
                //endif;
                 
                
                echo ' <div class="title"> <h1>' . $posts[$x]['Title'] . '</h1> </div>' ;



                echo ' <div class="time"> <p>' . $dat . '</p></div>';

                if(strlen($posts[$x]['body']) > 550){echo '<p>' . substr($posts[$x]['body'],0,180).'...' . '<p>';}
                else echo '<p>' . $posts[$x]['body'] . '<p>';

                echo "<div class='readMore'> <a href='readPost.php?user=".urlencode(base64_encode("$userNum"))."&ID=".urlencode(base64_encode("$postID"))."'><button name=readBtn'".$x."'><b>READ MORE »</b></button></a>";
                
                echo '</div></div> </div> </div> ' ;
                /*
                echo ' <div class="row"> <div class="leftcolumn"> <div class="commentSection">';
                echo ' <p class="viewComment"> View all comments</p>';
                echo '
                
                ';
                $a = 0;
                foreach($postComment as $pc){
                    echo "<div class='commentDivName'>";
                    echo getName($pc[user])[FIRST_NAME].' ';
                    echo " ";
                    echo "</div>";
                    echo "<div class='commentDiv'>";
                    if(strlen($pc[comment]) > 50){echo substr($pc[comment],0,50).'...' ;}
                    else{ echo $pc[comment];}
                
                    //echo $pc[comment];
                    echo "</div>";

                    echo '<br>';
                    $a = $a+1;
                    if($a == 3){
                    break;
                    }
                    
                }   

                echo ' <div class="rightcolumn">Your rate: <label   class="yourLabel" name="rateNum"  >'.$rating.'</label></div></div></div>  </div>' ;
                
               */ 



            };
        }else{
            for($x=0;$x < count($posts);$x++){
                $postComment = searchComments($posts[$x][ID]);
                $nam = getName($posts[$x]['user_id']);
                $full_name = $nam['FIRST_NAME'].' '.$nam['LAST_NAME'];
                $tim = strtotime($posts[$x]['created_at']);
                $dat = date('l jS \of F Y  ', $tim);
                $postID = $posts[$x][ID];
                $rating = getRate($postID,$userNum)[rate];
                $arrayofFiles = $posts[$x]['files'];


                $files_arr =  explode (",", $arrayofFiles);



                echo ' <div class="row"> <div class="leftcolumn"> <div class="posts">';

                if(empty($posts[$x]['image_name'])): 

                    echo '<div class="defaultimg" style="height:160px; width:200px;"><center>N/A</center></div>';
                 else: 
                
                    echo '<img class="fakeimg" height="180" width="200" src="media/'.$files_arr[0].'">';
                endif;
                 
                
                echo ' <div class="title"> <h1>' . $posts[$x]['Title'] . '</h1> </div>' ;


                echo ' <div class="time"> <p>' . $dat . '</p></div>';

                if(strlen($posts[$x]['body']) > 550){echo '<p>' . substr($posts[$x]['body'],0,180).'...' . '<p>';}
                else echo '<p>' . $posts[$x]['body'] . '<p>';

                
                echo "<div class='readMore'> <a href='readPost.php?user=".urlencode(base64_encode("$userNum"))."&ID=".urlencode(base64_encode("$postID"))."'><button name=readBtn'".$x."'><b>READ MORE »</b></button></a>";
                
                echo '</div></div> </div> </div> ' ;
                /*
                echo ' <div class="row"> <div class="leftcolumn"> <div class="commentSection">';
                echo ' <p class="viewComment"> View all comments</p>';
                echo '
                
                ';
                $a = 0;
                foreach($postComment as $pc){
                    echo "<div class='commentDivName'>";
                    echo getName($pc[user])[FIRST_NAME].' ';
                    echo " ";
                    echo "</div>";
                    echo "<div class='commentDiv'>";
                    if(strlen($pc[comment]) > 50){echo substr($pc[comment],0,50).'...' ;}
                    else{ echo $pc[comment];}
                
                    //echo $pc[comment];
                    echo "</div>";

                    echo '<br>';
                    $a = $a+1;
                    if($a == 3){
                    break;
                    }
                    
                }   

                echo ' <div class="rightcolumn"><div><div class="starRatingContainer"><div class="ratingSystem"></div></div></div>Your rate: <label   class="yourLabel" name="rateNum"  >'.$rating.'</label></div></div></div>  </div>' ;
                */
            };
        }
        ?>
        

    </div>
      

</body>
</html>
<?php endif; ?>
