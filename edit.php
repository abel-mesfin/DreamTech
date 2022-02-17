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

 
        <link rel="stylesheet" href="./css/newPost.css" />
        <link rel="stylesheet" href="style.css" />
        <link rel="stylesheet" href="./css/edit.css">  

   

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
                <a href="#">Account</a>
                <a href="settings.php">Settings</a>
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
        $post_ID = $_GET['ID'];
        $post = getOnePost($post_ID);
        $order = $post[0]['files'];
        $orderArr = explode(",", $order);
        function getPostID(){
            return $post_ID;
        }
        if($post[0]['published'] == 1){
            $checked = "checked";
        } else{
            $checked = " ";
        }
        

        if($post[0]['image_name'] == ""){
            $imageName = "No file currently on display";
        } else{
            $imageName = $post[0]['image_name'];
        }

        
        $imageName = htmlspecialchars($imageName, ENT_QUOTES);

       echo '<form action="./handlers/editForm.php" method="POST" enctype="multipart/form-data" action="">';

        echo '<input  type="hidden" name="postNumber" value="'.$post_ID.'"> ';
        echo    'Title: <input type="text" value="'.$post[0]['Title'].'" name="title" size=56 style="height:30;"> <br>';
        echo    '<label class="bodLabel" for="textArea" >Body:</label>';
        echo    '<textarea name="textArea" >'.$post[0]['body'].'</textarea><br>';
        echo '<input type="hidden" name="hideArray" value="'.$order.'" id="hideArray" >';
        echo '<input type="hidden" name="hide2" value="'.$order.'" id="hide2" >';

        

        
        echo 'Embeded Quiz: <input type="text" name="quiz" value="'.$imageName.'" size=56 style="height:30;"> <br>';

        echo    'File(s): <input type="file" class="custom-file-input" id="files"onChange="createArray(); checkOrder(); " name="fileToUpload[]" multiple><br>';

        echo    'Published: <input type="checkbox" name="published" '.$checked.'><br>';
        echo    '<input type="submit" value="Update" name="post">';
        
       echo '</form>';
        
        

    ?>

        <ul id="draggable-list" class="draggable-list">
            <?php
            /*
                foreach($orderArr as $key => $or){
                    $key2 = $key + 1;
                    echo '<li data-index="'.$key.'">
                    <span class="number">'.$key2.'</span>          <div class="draggable" draggable="true">
                    <p>'.$or.'</p>
                    <i class="fas fa-grip-lines"></i>
                  </div></li>';

                }
                */
            ?>
        </ul>


    </div>

    <script>
    function makeFileList() {
      var input = document.getElementById("files");
      var ul = document.getElementById("draggable-list");
      while (ul.hasChildNodes()) {
        ul.removeChild(ul.firstChild);
      }
      for (var i = 0; i < input.files.length; i++) {
        var li = document.createElement("li");
        console.log(input.files);
        li.innerHTML = '<img src="'+input.files[i].name+'" alt="'+input.files[i].name+'">';
        ul.appendChild(li);
      }
      if(!ul.hasChildNodes()) {
        var li = document.createElement("li");
        li.innerHTML = 'No Files Selected';
        ul.appendChild(li);
      }
    }
  </script>

<script src="script2.js"></script>

<script
    src="https://kit.fontawesome.com/3da1a747b2.js"
    crossorigin="anonymous" >
</script>


      
<body>
    
</html>
<?php else: ?>
    <html>
        <body>
            <p>Error you are not logged in</p>
        </body>
    </html>
<?php endif; ?>