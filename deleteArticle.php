<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/23/2018
 * Time: 5:07 PM
 */
session_start();
if(!isset($_SESSION["username"])){
    header("Location: /php/login.php");
} else {
    include "DBHelper.php";
    $db = new DBHelper("localhost","root","","cms");
    $db->deleteArticle($_REQUEST["id"]);
    $db = null;
    header("Location: /php/index.php");
}
?>

