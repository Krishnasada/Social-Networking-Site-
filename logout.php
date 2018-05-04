<?php
session_start();

require_once 'db.php';
if (isset($_SESSION['username']))
{
destroySession();
echo "<script>window.alert('you have successfully logged out'); window.location.href='index.php'; </script>";
}
else echo "<div class='main'><br />" .
"<script>window.alert('You cannot log out because you are not logged in'); </script>";
?>
<br /><br /></div></body></html>