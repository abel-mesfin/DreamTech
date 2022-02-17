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
    
    <link rel="stylesheet" href="./css/general.css"> 
    


</head>

<body>
    
    <div class="topnav">
        <a class="active" href="loginResponse.php">
            <i class="fas fa-home fa-lg"></i>
        </a>

        <a class="active" onclick="history.back()">
            <i class="fas fa-arrow-left" ></i>
        </a>

        
          

        <div class="btnright">
           <a class="active" href="signOut.php">
               <i class="fas fa-sign-out-alt"></i>
           </a>
        </div>

        <div class="navTitle">
            <h3> Purchase page </h3>
        </div>
        
    </div>

    <header>

    </header>
    <div class="page">   
            <div class="mediumSize">
                <center>
                <h2>Small/Medium Companies</h2>
                <p>Cources</p>
                <p>100+ videos</p>
                <p>Powerpoints</p>
                <p>Quizes</p>
                <center>
            </div> 

            <div class="largeSize">
                <center>
                <h2>Large Companies</h2>
                <p>Cources</p>
                <p>100+ videos</p>
                <p>Powerpoints</p>
                <p>Quizes</p>
                <center>
            </div> 

        <div class="choice">
            
            <form action="./handlers/purchaseHandler.php" method="POST" enctype="multipart/form-data" action="">

                
                    <div class="rectangle"></div>
                <input type="submit" value="Choose" name="smallChoice">
                <input type="submit" value="Choose" name="largeChoice">
            
            </form>
        </div>

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