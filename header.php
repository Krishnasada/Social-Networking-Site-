<?php 
session_start();
?>
<html>
    <head>
        <meta charset="UTF-8">
        <title>home page</title>
        <style>
            <?php require_once 'style.css';?>
               
    body {
    background-image: url("10.jpg");
    background-size: cover;
    background-position   : 13% 13%;
    background-repeat: no-repeat;
   
}   
                      
        </style>   
    </head> 
    <body>
   <?php        

/*  
*/
  
$user=$_SESSION['username'];
//$_SESSION['view']=$user;
if ($_SESSION['loggedin']) {
echo "<table>" .
     "<th  style='width:10%' > </th>".   
"<th style='width:15%'><a class='chooser' href='header.php?view=$user'>Home</a> </th>" .
"<th style='width:15%'><a class='chooser' href='members.php'>Members</a> </th>" .
"<th style='width:15%'><a class='chooser' href='friends.php'>Friends</a> </th>" .
"<th style='width:15%'><a class='chooser' href='messages.php'>Message</a> </th>" .
"<th style='width:15%'><a class='chooser' href='profile.php'>Edit Profile</a> </th>" .
"<th style='width:15%'><a class='chooser' href='logout.php'>Log out</a> </th>".
     "<th  style='width:5%' > </th>".        
       "</table>" 
        ;
} else {

    echo "(<script> window.alert('you must have to login to view this page');"
    . "window.location.href='index.php')";
}

?>

        </body>