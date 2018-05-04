<?php session_start();?>
<html>
    <head>
     
        <meta  charset="UTF-8">
        <title></title>
        <style>
        body {
    background-image: url("login2.jpg");
    background-size: cover;
    background-position   : 21% 21%;
    background-repeat: no-repeat;
   
}    
               
            <?php require 'style.css'; ?>
        </style>
    </head>

    <body>
        <div class="modal" id="id01">
            <form  id="id01" class="modal-content animate" action=<?php echo $_SERVER['PHP_SELF']; ?>   method="POST">

                <div class="imagecontainer">
                    <img src="avtar.jpeg" alt="avatar" id="av1">                   

                </div>
                <a class="ch1" id="close" href="index.php">&times;</a> 
                <div class="container">

                    <label><b>Username</b></label>      
                    <input type="text" name="username" value="" required placeholder="Enter Username" />
                    <label><b>Password</b></label>                         
                    <input type="password" name="password" placeholder="Enter Password" required value="" />
                    <button type="submit" name="login2">Login</button>
                    <input type="checkbox" checked="checked"> Remember me
                </div>
                <div  id="my" class="container2" style="background-color:'blue'">

                    <a class="cancelbtn" href="index.php">cancel</a> 
                    <span class="psw">Forgot <a class="chooser" href="login.php">Password?</a> </span>    
                    


                </div>

            </form>

        </div>
        <br>
        <?php
      
        require_once 'db.php';

        if (null !== (filter_input(INPUT_POST, 'login2'))) {

            $salt1 = "*!#She";
            $salt2 = "K*a@c5";

            $user = $_POST['username'];
            $pass = $_POST['password'];

            $pass = md5("$salt1$pass$salt2");


            $result2 = queryMysql("SELECT * FROM members WHERE NAME='$user'");


            if (!$result2) {
                mysqli_error($db_server);
            } else {


                $row = mysqli_fetch_row($result2);

                if (!$row) {
                      echo "(<script> window.alert('Invalid username');  </script>)";
                } else {
                    if ($row[3] === $pass) {
                        $_SESSION['username'] = $user;
                        $_SESSION['password'] = $pass;
                        $_SESSION['loggedin']=TRUE;
                      $_SESSION['view']=$user;
                 echo "(<script> window.alert('you have successfully logged in.click ok to continue');"
                        . "window.location.href='header.php?view=$user';  </script>)";
                    } else {
                         $_SESSION['username'] = NULL;
                        $_SESSION['password'] = NULL;
                        $_SESSION['loggedin']=FALSE;
                        echo "(<script> window.alert('Invalid password');  </script>)";
                    }
                }
            }
        }
        ?>

    </body>
</html>