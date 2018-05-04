<html>
    <head>
        <meta  charset="UTF-8">
        <title></title>
    </head>
    <style>
        body {
            background-image: url("signup.jpg");
            background-size: cover;
            background-position   : 15% 15%;
            background-repeat: no-repeat;

        }    
        <?php require 'style.css'; ?></style>
    <body>

        <?php
        require_once 'db.php';

        $name = $email = $mobile = $web = $gender = $password = $cpassword = $pass2 = NULL;
        $nameerr = $emailerr = $mobileerr = $weberr = $gendererr = $passworderr = $cpassworderr = NULL;

        if (isset($_SESSION['username']))
            destroySession();

        if (null !== (filter_input(INPUT_POST, 'submit'))) {
            if (null != filter_input(INPUT_POST, 'name')) {
                $name = filter_input(INPUT_POST, 'name');
                if (!preg_match("/^[a-zA-Z ]*$/", $name)) {
                    $nameerr = "only letters allowed";
                }
            } else {
                $nameerr = "name is required";
            }


            if (null != filter_input(INPUT_POST, 'email')) {
                $email = filter_input(INPUT_POST, 'email');
            } else {
                $emailerr = "email-id is required";
            }


            if (null != filter_input(INPUT_POST, 'mobile')) {
                $mobile = filter_input(INPUT_POST, 'mobile');
                if (!preg_match("/^[0-9]{10}+$/", $mobile)) {
                    $mobileerr = "invalid contact no";
                }
            } else {
                $mobileerr = "contact no is required";
            }





            if (null != filter_input(INPUT_POST, 'b1')) {
                $gender = filter_input(INPUT_POST, 'b1');
            }


            if (null != filter_input(INPUT_POST, 'website')) {
                $web = filter_input(INPUT_POST, 'website');
                if (!preg_match("/\b(?:(?:https?|ftp):\/\/|www\.)[-a-z0-9+&@#\/%?=~_|!:,.;]*[-a-z0-9+&@#\/%=~_|]/i", $web)) {
                    $weberr = "invalid website";
                }
            } else {
                $web = "";
            }


            if (null != filter_input(INPUT_POST, 'password')) {
                $pass2 = $password = filter_input(INPUT_POST, 'password');
            } else {
                $passworderr = "password is required";
            }



            if (null != filter_input(INPUT_POST, 'cpassword')) {
                $cpassword = filter_input(INPUT_POST, 'cpassword');
            } else {
                $cpassworderr = "confirmation is required";
            }





            if ($password === $cpassword) {
                $salt1 = "*!#She";
                $salt2 = "K*a@c5";
                $password = md5("$salt1$password$salt2");
                if ($name !== NULL && $email !== NULL && $mobile !== NULL && $nameerr === NULL && $emailerr === NULL && $mobileerr === NULL) {
                    $result = queryMysql("INSERT INTO members VALUES('$name','$email','$mobile','$password')");

                    if (!$result) {
                        echo mysqli_error($db_server);
                    } else {

                        echo "(<script>window.alert('u have registered successfully'); window.location.href='index.php';</script>)";
                    }
                }
            } else {
                $cpassworderr = "password not matched";
            }
        }
        ?>

        
            <table>
                <th  style="width:55%" > </th>
                <th style="width:15%"><a class="chooser" href="login1.php">Login</a> </th>
                <th style="width:15%"> <a class="chooser" href="signup.php">Sign-up</a> </th>
                <th style="width:15%"><a class="chooser" href="about.php">About us</a></th>
                <th style="width:5%"> </th>
            </table>
            
        
        <div class="modal" id="id02">
            
            <form id="id02" class="modal-content animate" method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

                <br>
                <label><b>Username</b></label> <span class="error">* <?php echo $nameerr; ?></span>               
                <input type="text" name="name" value="<?php echo $name; ?>" placeholder="Enter Full Name" />

                <label><b>Email-id</b></label>     <span class="error">* <?php echo $emailerr; ?> </span>
                <input type="email" name="email" value="<?php echo $email; ?>" placeholder="Enter Email-id" />


                <label><b>Contact-no</b></label><span class="error">* <?php echo $mobileerr; ?></span>   
                <input type="text" name="mobile" value="<?php echo $mobile; ?>" placeholder="Enter contact no" />

                <label><b>Website</b></label> <span class="error"> <?php echo $weberr; ?> </span>
                <input type="text" name="website" value="<?php echo $web; ?>" placeholder="Enter website" />


                <br><br>
                <label><b>Gender</b></label>
                <input type="radio" name="b1" value="<?php echo $gender; ?>" checked="checked" />Male
                <input type="radio" name="b1" value="<?php echo $gender; ?>" />Female

                <br><br>



                <label><b>Password</b></label><span class="error">* <?php echo $passworderr; ?></span>               
                <input type="password" name="password" value="<?php echo $pass2; ?>" placeholder="type your password" />


                <label><b>Confirm Password</b></label><span class="error">* <?php echo $cpassworderr; ?></span>                
                <input type="password" name="cpassword" value="<?php echo $cpassword; ?>" placeholder="retype your password" />

                <br>
                <input type="submit" value="Submit" name="submit" />

            </form>   
        </div>

    </body>
</html>