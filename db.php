<?php

$db_hostname = 'localhost';
$db_username = 'root';
$db_password = '';
$db_database = 'social';


$db_server = mysqli_connect($db_hostname, $db_username, $db_password);


if (!$db_server) {
    mysqli_error($db_server);
}

mysqli_select_db($db_server, $db_database) or die(mysqli_error($db_server));

function createTable($name, $query) {
    queryMysql("CREATE TABLE IF NOT EXISTS $name($query)");
    
}

function queryMysql($query) {
    $result = mysqli_query($GLOBALS['db_server'], $query);
    return $result;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

function destroySession() {
    $_SESSION = array();
    
    if (session_id() != "" || isset($_COOKIE[session_name()]))
        setcookie(session_name(), '', time() - 2592000, '/');
    session_destroy();
}

function showProfile($user) {
    if (file_exists("$user.jpg"))
        echo "<img src='$user.jpg' align='left' />";
    $result = queryMysql("SELECT * FROM profiles WHERE user='$user'");


    if (mysqli_num_rows($result)) {
        $row = mysqli_fetch_row($result);
        echo stripslashes($row[1]) . "<br clear=left /><br/>";
    }
}
?>