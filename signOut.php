<!--
Project Name: Milestone 3 Blog Post
Version 3
Signout module version 1
Abel Mesfin 
10/20/2020
The modules purpose is to create a html form that shows the user the required fields for regiseration
-->
<?php 
include('myfuncs.php');
$vari = getUserId()?>
<html>
<head>

<link rel="stylesheet" href="./css/signOut.css" />
   

</head>

<body>
   <?php   ?>
    <div class="page">
        <center><h2>You have been signed out</h2></center>

    </div>
     <a href="index.php">Homepage</a> 
     <?php if(!empty($vari) ): endSession() ?>
     <?php endif; ?>
      
<body>
   
</html>

