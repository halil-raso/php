<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/23/2018
 * Time: 3:45 PM
 */
    session_start();
    if(!isset($_SESSION["username"])){
        header("Location: /php/login.php");
    }


?>
<html>
<head><title>Compose new Article

    </title></head>
<body>
<form action="checkAddNewArticle.php" method="post">
    Title: <input type="text" name="title" >
    <br>
    <br>
    Content: <textarea name="content" cols="50">
    </textarea>
    <input type="submit">
</form>

</body>
</html>
