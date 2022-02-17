<!--
Project Name: Milestone 3 Blog Post
Version 3
newPost module version 1
Abel Mesfin 
10/20/2020
The modules purpose is to create a html form that shows the user the required fields for regiseration
-->
<?php 
include('myfuncs.php');
$vari = getUserId()?>
<?php if(!empty($vari) ): ?>
<html>
<head>
<title>Dream Tech Training</title>   
<link rel="icon" href="./images/favicon.png" type="image/png" sizes="16x16">

<script src="https://kit.fontawesome.com/27a3960bc7.js" crossorigin="anonymous"></script>
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
  

</head>

<body>
    
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
            <h3> Add new entry </h3>
        </div>
        
    </div>



    <div class="page">
        

        <form action="./handlers/upload.php" method="POST" enctype="multipart/form-data" action="">


            Title: <input type="text" name="title" size=56 style="height:30;"> <br>
            <label for="textArea" class="mainLabel">Description:</label>
            <textarea name="textArea" ></textarea><br>
            <input type="hidden" name="hideArray" id="hideArray" >
            Embeded Quiz: <input type="text" name="quiz" size=56 style="height:30;"> <br>


            File(s): <input type="file" name="fileToUpload[]" id="files" onChange="createArray(); checkOrder()" multiple><br>

            Published: <input type="checkbox" name="published"><br> 
            <input type="submit" value="Post" name="post">
            
        </form>
            
        
        <ul id="draggable-list" class="draggable-list">
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



<script src="script.js"></script>
  
<script
    src="https://kit.fontawesome.com/3da1a747b2.js"
    crossorigin="anonymous" >
</script>

</body>
    
</html>
<?php else: ?>
    <html>
        <body>
            <p>Error you are not logged in</p>
        </body>
    </html>
<?php endif; ?>