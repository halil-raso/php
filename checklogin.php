<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/23/2018
 * Time: 8:55 AM
 */
session_start();
include "DBHelper.php";
$db= new DBHelper("localhost","root","","cms");
$v= $db->isValidUser();
    echo $v;
    if($v==1){
        $_SESSION["username"] = $_REQUEST["username"];
        $_SESSION["firstname"] = $db->getUserInfo($_SESSION["username"]);
        $_SESSION["uid"] = $db->getUserId($_SESSION["username"]);
        $db = null;
        header('Location: /php/index.php');
    }else {
        session_unset();
        session_destroy();
        header('Location: /php/login.php');
    }
?>