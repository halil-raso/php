<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/23/2018
 * Time: 4:19 PM
 */
session_start();
if(!isset($_SESSION["username"])){
    header("Location: /php/login.php");
}
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include "DBHelper.php";
    $db= new DBHelper("localhost","root","","cms");
    $db->insertArticle($_REQUEST["title"],$_REQUEST["content"],$_SESSION["uid"]);
    $db = null;
    header("Location: /php/index.php");
}
?>