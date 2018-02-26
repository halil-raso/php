<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/23/2018
 * Time: 3:12 PM
 */
session_start();
if(!isset($_SESSION["username"])){
    header("Location: /php/login.php");
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include "DBHelper.php";
        $db= new DBHelper("localhost","root","","cms");
        $db->updateArticle($_REQUEST["id"],$_REQUEST["title"],$_REQUEST["content"]);
        header("Location: /php/index.php");
        $db = null;
    }
}
?>