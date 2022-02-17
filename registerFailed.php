<!--
Project Name: Milestone 3 Blog Post
Version 3
loginFailed.php module version 1
Abel Mesfin 
10/20/2020
The modules purpose is to create a html form that shows the user the required fields for regiseration
-->
<?php include('myfuncs.php'); ?>
<!DOCTYPE html>
<html>
    <head>    
        <style>
            form {
                background-color: silver;
                width: 500px;
                margin-left: 100px;
                margin-top: 200px;
                align-items: center;
                padding: 20px;
            }

            * {
                font-family: Arial;
                background-color: rgb(25, 168, 187);

            }

            .home {
                margin-top: 10px;
            }
        </style>

    </head>

    <body>
        <h2><?php echo " " . $message?></h2>  
        <meta http-equiv="refresh" content="5; URL="<?php $baseE ?> />   
    <body>
</html>