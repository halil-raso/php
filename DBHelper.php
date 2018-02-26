<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/23/2018
 * Time: 9:27 AM
 */

class DBHelper
{

    private static $instance = null;
    public static function getInstance(){
        if(!isset(self::$instance)){
            self::$instance = new DBHelper();
        }
    return self::$instance;
    }


    function __construct(){

        $this->HOSTNAME = "localhost";
        $this->DBNAME = "cms";
        $this->UNAME = "root";
        $this->UPASS = "";
        $this->dsn = 'mysql:host='.$this->HOSTNAME.';dbname='.$this->DBNAME.';charset=utf8mb4';
        $this->opt = array(
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_PERSISTENT 		 => false
        );
        $this->connection = new PDO($this->dsn, $this->UNAME, $this->UPASS, $this->opt);

    }

    function openConnection(){
        if(!isset($this->connection)){
            $this->connection = new PDO($this->dsn, $this->UNAME, $this->UPASS, $this->opt);
        }
        return $this->connection;
    }

    function closeConnection(){
        $this->connection = null;
    }

    function isValidUser(){

        $dpo =  $this->openConnection();
        $handle = $dpo->prepare("SELECT id, username, password FROM users where username=\"".$_REQUEST["username"]."\" and password=\"".$_REQUEST["password"]."\"");
        $handle->execute();
        $handle->setFetchMode(PDO::FETCH_ASSOC);
        $result = $handle->rowCount();
        $this->closeConnection();
        return $result;

    }

    function getUserInfo($username){

        $dpo =  $this->openConnection();
        $handle = $dpo->prepare("SELECT firstname FROM users where username=\"".$username."\"");
        $handle->execute();
        $handle->setFetchMode(PDO::FETCH_ASSOC);
        $result= $handle->fetchColumn();
        $this->closeConnection();
        return $result;

    }


    function getArticles($username){

        $dpo =  $this->openConnection();
        $handle = $dpo->prepare("SELECT id, title, content FROM articles where userId=  (select users.id from users where username=\"".$username."\")");
        $handle->execute();
        $result= $handle->fetchAll(PDO::FETCH_ASSOC);
        $this->closeConnection();
        return $result;

    }


    function getArticle($id){

        $dpo = $this->openConnection();
        $stmt = $dpo->prepare("SELECT id, title, content FROM articles where id= ".$id);
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result= $stmt->fetchAll();
        $this->closeConnection();
        return $result;

    }


    function updateArticle($id, $title,$content){

        $dpo = $this->openConnection();
        $handle = $dpo->prepare("UPDATE `articles` SET `title` = '$title', `content` = '$content' WHERE `articles`.`id` = $id");
        $handle->execute();
        $this->closeConnection();

    }

    function insertArticle( $title,$content, $uid){

        $dpo = $this->openConnection();
        $handle = $dpo->prepare("insert into articles (`title`, `content`, `userId`) values ('$title','$content','$uid') ");
        $handle->execute();
        $this->closeConnection();

    }

    function getUserId($username){

        $dpo = $this->openConnection();
        $handle = $dpo->prepare("SELECT id FROM users where username=\"".$username."\"");
        $handle->execute();
        $handle->setFetchMode(PDO::FETCH_ASSOC);
        $result= $handle->fetchColumn();
        $this->closeConnection();
        return $result;

    }

    function deleteArticle($id){

        $dpo = $this->openConnection();
        $handle = $dpo->prepare("Delete from `articles` where id =  $id");
        $handle->execute();
        $this->closeConnection();

    }

}