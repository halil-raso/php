<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/23/2018
 * Time: 2:12 PM
 */
session_start();
if(!isset($_SESSION["username"]) || !isset($_SESSION["firstname"])){
    header("Location: /php/login.php");
}

    if (!isset($_REQUEST["id"])) {
        header("Location: /php/index.php");
    }
    include "DBHelper.php";
    $db = new DBHelper("localhost", "root", "", "cms");
    $result = $db->getArticle($_REQUEST["id"]);
    foreach ($result as $article) {
        $id = $article["id"];
        $title = $article["title"];
        $content = $article["content"];
    }
    $db = null;
?>
<html>
<head>
    <title>Update Title Page</title>
</head>
<body>
<form action="/php/checkupdate.php" method="post">
Title: <input type="text"  name="title" value="<?php echo $title; ?>">
<br><br>
<textarea name ="content" cols="50"><?php echo $content; ?></textarea>
    <input type="text" name="id" value="<?php echo $id?>" hidden="hidden">
<br>
    <input type="submit">
</form>
</body>
</html>
