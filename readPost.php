<?php
require_once('utility.php');

$conn = dbConnect();


?>

<html>


<head>


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

    <link rel="icon" href="favicon.png" type="image/png" sizes="16x16">
    <title>Dream Tech Training</title>
    <script src="index.js"></script>

    <script src="https://kit.fontawesome.com/27a3960bc7.js" crossorigin="anonymous"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="./css/readPost.css" />
    <!--
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
-->
     

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
            $postIDG = base64_decode($_GET['ID']);
            $post = getOnePost($postIDG);
            $name = getName($post[0]['user_id']);
            $full_name = $name['FIRST_NAME'].' '.$name['LAST_NAME'];
            $tim = strtotime($post[0]['created_at']);
            $dat = date('l jS \of F Y h:i:s A', $tim);
            $postComment = searchComments($postIDG);
            $currentUserG = base64_decode($_GET['user']);
            $rating = getRate($postIDG,$currentUserG)['rate'];
            $filesOrder = $post[0]['files'];
            $quiz = $post[0]['image_name'];
            $emptyQ = false;

            //$quiz = htmlspecialchars($quiz, ENT_QUOTES);

            if (empty($quiz)){
                $emptyQ = true;
            }else{
                //$filesOrder.push($quiz);
                //$filesOrder = $filesOrder.','.$quiz;
                //echo $filesOrder;
            }

            echo ' <div class="row"> <div class="leftcolumn"> ';

            //Title
            echo '<div class="title"> <h1>'.$post[0]['Title'].'</h1> </div>';
            
            //Media
            echo '<div class="w3-content" style="max-width:800px">';
            $sortedFiles = explode (",", $filesOrder);
            $sortedFiles = array_splice($sortedFiles, 1);

            echo '<div class="dem"> ';
            foreach($sortedFiles as $key2 => $sup){
                $key2 = $key2 +1;
                echo ' <button class="w3-button demo" onclick="currentDiv('.$key2.')">'.$key2.'</button> ';
            }
            echo '</div>';


            foreach($sortedFiles as $ke => $sf){
                
                $full_path = "media/".$sf;
                $extension = substr(strrchr($full_path, '.'), 1);
                //echo $extension;
                
                if($extension == "jpg" or $extension == "png" or $extension == "jpeg" or $extension == "JPG" or $extension == "HEIC"){
                    echo  '<img class="mySlides" src="media/'.$sf.'" style="width:100%"></img>';
                    //echo $quiz;

                }elseif($extension == "mp4" or $extension == "MOV" or $extension == "mov") {

                    echo '<video class="mySlides" id="video" src="media/'.$sf.'" style="width:1180px; height:450px" type="video/mp4"  controls></video>';

                }elseif($extension == "pdf" or $extension == "PDF"){
                    echo '<embed src="media/'.$sf.'" width="1180px" height="750px" /> ';
                }
                else{
                    echo  '<img class="mySlides" src="media/'.$sf.'" style="width:100%"></img>';

                }


            }   

            echo '            <div class="nexPrev">
            <div class="w3-section">
                <button class="w3-button w3-light-grey" onclick="plusDivs(-1); playVideo()">❮ Prev</button>
                <button class="w3-button w3-light-grey" onclick="plusDivs(1); playVideo()">Next ❯</button>
            </div>';      

            echo '</div>';


            //Description
            echo '<div class="bio"> <p>'.$post[0]['body'].'</p> </div>';
            
            



            
    
        ?>
        
        

    </div>
    
    <script>
    var slideIndex = 1;
    var vid = document.getElementById("video");
    /*
    vid.addEventListener("playing", () => {
    console.log("Playing event triggered");
    });

    vid.addEventListener("pause", () => {
    console.log("Pause event triggered");
    });

    vid.addEventListener("seeking", () => {
    console.log("Seeking event triggered");
    });

    vid.addEventListener("volumechange", () => {
    console.log("Volumechange event triggered");
    });
*/
    //function playVideo(){
    //    if(!vid.playing){
    //        vid.play();
    //    }
    //}
    showDivs(slideIndex);

    function plusDivs(n) {
    showDivs(slideIndex += n);
    }

    function currentDiv(n) {
    showDivs(slideIndex = n);
    }

    function showDivs(n) {
    //n is the post number that wants to be changed to
    var i;
    //x is a list of the different images that are on the screen
    var x = document.getElementsByClassName("mySlides");
    //dot is the different buttons that allows to click through the images
    var dots = document.getElementsByClassName("demo");
    //if the post number is bigger than that amount of total posts, set it to the first post
    if (n > x.length) {slideIndex = x.length}    
    //if the post number is below 1 than set the current picture to the last element in the list
    if (n < 1) {slideIndex = 1}
    for (i = 0; i < x.length; i++) {
        x[i].style.display = "none";  
    }
    for (i = 0; i < dots.length; i++) {
        dots[i].className = dots[i].className.replace(" w3-red", "");
    }
    x[slideIndex-1].style.display = "block";  
    dots[slideIndex-1].className += " w3-red";
    }
    </script>


      
</body>
</html>
