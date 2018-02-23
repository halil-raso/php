<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/23/2018
 * Time: 8:51 AM
 */
session_start();
if(isset($_SESSION["username"])){
    header('Location: /php/index.php');
}
?>
<html>
<head>
    <title>CMS Project</title>
</head>
<body>
<form action="checklogin.php" method="post">
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

