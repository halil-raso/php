<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/23/2018
 * Time: 8:51 AM
 */
session_start();
if(isset($_SESSION["username"])){
    header('Location: index.php');
} elseif($_SERVER["REQUEST_METHOD"]=="POST"){
    include "DBHelper.php";
    $db= DBHelper::getInstance();
    if($db->isValidUser()){
        $_SESSION["username"] = $_REQUEST["username"];
        $_SESSION["firstname"] = $db->getUserInfo($_SESSION["username"]);
        $_SESSION["uid"] = $db->getUserId($_SESSION["username"]);
        $db = null;
        header('Location: index.php');
    }else {
        session_unset();
        session_destroy();
        header('Location: login.php');
    }
}
?>
<html>
<head>
    <title>CMS Project</title>
</head>
<body>
<form action="login.php" method="post">
    Username: <input type="text" name="username">
    <br>
    <br>
    Password: <input type="password" name="password">
    <br>
    <br>
    <input type="submit">
</form>
</body>
</html>

