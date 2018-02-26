<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/23/2018
 * Time: 9:27 AM
 */

class DBHelper
{
    var $connection;
    var $hostname;
    var $username;
    var $password;
    var $dbname;

    function __construct($hostname="localhost",$username, $password, $dbname)
    {

        $this->hostname = $hostname;
        $this->username = $username;
        $this->password = $password;
        $this->dbname =  $dbname;
        $this->connection = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $password);
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    }

    function isValidUser(){

        $stmt = $this->connection->exec("SELECT id, username, password FROM users where username=\"".$_REQUEST["username"]."\" and password=\"".$_REQUEST["password"]."\"");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->rowCount();
        return $result;

    }

    function getUserInfo($username){
        $stmt = $this->connection->exec("SELECT firstname FROM users where username=\"".$username."\"");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result= $stmt->fetchColumn();
        return $result;
    }


    function getArticles($username){

        $stmt = $this->connection->exec("SELECT id, title, content FROM articles where userId=  (select users.id from users where username=\"".$username."\")");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result= $stmt->fetchAll();
        return $result;
    }


    function getArticle($id){

        $stmt = $this->connection->exec("SELECT id, title, content FROM articles where id= ".$id);
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result= $stmt->fetchAll();
        return $result;

    }


    function updateArticle($id, $title,$content){
        $stmt = $this->connection->exec("UPDATE `articles` SET `title` = '$title', `content` = '$content' WHERE `articles`.`id` = $id");
    }

    function insertArticle( $title,$content, $uid){
        $this->connection->exec("insert into articles (`title`, `content`, `userId`) values ('$title','$content','$uid') ");
    }

    function getUserId($username){
        $stmt = $this->connection->exec("SELECT id FROM users where username=\"".$username."\"");
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result= $stmt->fetchColumn();
        return $result;
    }

    function deleteArticle($id){
        $sql = "Delete from `articles` where id =  $id";
        $stmt = $this->connection->exec($sql);
    }




}