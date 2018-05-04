<?php

// profile.php
session_start();
?>
<html>
    <style>
        
       <?php        require_once 'style.css';?>
        
    </style>
  <?php   
require_once 'db.php';


if (!$_SESSION['loggedin'])
    die();

  $user1 = $_SESSION['username'];
echo "<table>" .
     "<th  style='width:10%' > </th>".   
"<th style='width:15%'><a class='chooser' href='header.php?view=$user1'>Home</a> </th>" .
"<th style='width:15%'><a class='chooser' href='members.php'>Members</a> </th>" .
"<th style='width:15%'><a class='chooser' href='friends.php'>Friends</a> </th>" .
"<th style='width:15%'><a class='chooser' href='messages.php'>Message</a> </th>" .
"<th style='width:15%'><a class='chooser' href='profile.php'>Edit Profile</a> </th>" .
"<th style='width:15%'><a class='chooser' href='logout.php'>Log out</a> </th>".
     "<th  style='width:5%' > </th>".        
       "</table>" 
        ;


echo "<div class='main'><h3>Your Profile</h3>";
if (isset($_POST['text'])) {
    $text = test_input($_POST['text']);
    $text = preg_replace('/\s\s+/', ' ', $text);
    if (mysqli_num_rows(queryMysql("SELECT * FROM profiles WHERE user='$user1'")))
        queryMysql("UPDATE profiles SET text='$text' where user='$user1'");
    else
        queryMysql("INSERT INTO profiles VALUES('$user1', '$text')");
}
else {

    $result = queryMysql("SELECT * FROM profiles WHERE user='$user1'");
    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_row($result);
        $text = stripslashes($row[1]);
    } else
        $text = "";
}
$text = stripslashes(preg_replace('/\s\s+/', ' ', $text));
if (isset($_FILES['image']['name'])) {
    $saveto = "$user1.jpg";
    move_uploaded_file($_FILES['image']['tmp_name'], $saveto);
    $typeok = TRUE;
    switch ($_FILES['image']['type']) {
        case "image/gif":
            $src = imagecreatefromgif($saveto);
            break;
        case "image/jpeg": 
$src = imagecreatefromjpeg($saveto);
            break;// Allow both regular and progressive jpegs
        case "image/pjpeg": $src = imagecreatefrompjpeg($saveto);
            break;
        case "image/png":
            $src = imagecreatefrompng($saveto);
            break;
        default:
            $typeok = FALSE;
            break;
    }
    if ($typeok) {
        list($w, $h) = getimagesize($saveto);
        $max = 100;
        $tw = $w;
        $th = $h;
        if ($w > $h && $max < $w) {
            $th = $max / $w * $h;
            $tw = $max;
        } elseif ($h > $w && $max < $h) {
            $tw = $max / $h * $w;
            $th = $max;
        } elseif ($max < $w) {
            $tw = $th = $max;
        }

        $tmp = imagecreatetruecolor($tw, $th);
        imagecopyresampled($tmp, $src, 0, 0, 0, 0, $tw, $th, $w, $h);
        imageconvolution($tmp, array(array(-1,-1,-1),
            array(-1, 16, -1), array(-1,-1,-1)) , 8, 0);
        imagejpeg($tmp, $saveto);
        imagedestroy($tmp);
        imagedestroy($src); 
    }
}




showProfile($user1);

?>        




   <form method='post' action='profile.php' enctype='multipart/form-data'>
<h3>Enter or edit your details and/or upload an image</h3>
<textarea name='text' cols='50' rows='3'>$text</textarea><br />
        Image: <input type='file' name='image' size='14' maxlength='32' />
<input type='submit' value='Save Profile' />
</form></div><br /></body></html>



</html>