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
    $d= new DBHelper("localhost","root","","cms");
    $d->insertArticle($_REQUEST["title"],$_REQUEST["content"],$_SESSION["uid"]);
    header("Location: /php/index.php");
}
?>