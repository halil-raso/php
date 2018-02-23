<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/23/2018
 * Time: 3:12 PM
 */
session_start();
if(!isset($_SESSION["username"])){

} else {

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        include "DBHelper.php";
        $d= new DBHelper("localhost","root","","cms");
        $d->updateArticle($_REQUEST["id"],$_REQUEST["title"],$_REQUEST["content"]);
        header("Location: /php/index.php");
    }
}


?>