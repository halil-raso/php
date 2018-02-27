<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/23/2018
 * Time: 2:12 PM
 */
session_start();
if(!isset($_SESSION["username"]) || !isset($_SESSION["firstname"])){
    header("Location: login.php");
}
if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "DBHelper.php";
    $db = DBHelper::getInstance();
    $db->updateArticle($_REQUEST["id"],$_REQUEST["title"],$_REQUEST["content"]);
    header("Location: index.php");
    $db = null;
} elseif ($_SERVER["REQUEST_METHOD"]=="GET") {
    if (!isset($_REQUEST["id"])) {
        header("Location: index.php");
    }
    include "DBHelper.php";
    $db = DBHelper::getInstance();
    $result = $db->getArticle($_REQUEST["id"]);
    foreach ($result as $article) {
        $id = $article["id"];
        $title = $article["title"];
        $content = $article["content"];
    }
    $db = null;
}


?>
<html>
<head>
    <title>Update Title Page</title>
</head>
<body>
<form action="update.php" method="post">
Title: <input type="text"  name="title" value="<?php echo $title; ?>">
<br><br>
<textarea name ="content" cols="50"><?php echo $content; ?></textarea>
    <input type="text" name="id" value="<?php echo $id?>" hidden="hidden">
<br>
    <input type="submit">
</form>
</body>
</html>
