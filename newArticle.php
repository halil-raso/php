<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/23/2018
 * Time: 3:45 PM
 */
session_start();
if(!isset($_SESSION["username"]) || !isset($_SESSION["firstname"])){
    header("Location: login.php");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "DBHelper.php";
    $db = DBHelper::getInstance();
    $db->insertArticle($_REQUEST["title"],$_REQUEST["content"],$_SESSION["uid"]);
    header("Location: index.php");
    $db = null;
}

?>
<html>
<head><title>Compose new Article

    </title></head>
<body>
<form action="newArticle.php" method="post">
    Title: <input type="text" name="title" >
    <br>
    <br>
    Content: <textarea name="content" cols="50"></textarea>
    <br>
    <br>
    <input type="submit">
</form>

</body>
</html>
