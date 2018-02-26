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
        $handle = $dpo->prepare("SELECT id, username, password FROM users where username=? and password=?");
        $handle->bindValue(1,$_REQUEST["username"]);
        $handle->bindValue(2,$_REQUEST["password"]);
        $handle->execute();
        $handle->setFetchMode(PDO::FETCH_ASSOC);
        $result = $handle->rowCount();
        $this->closeConnection();
        return $result;

    }

    function getUserInfo($username){

        $dpo =  $this->openConnection();
        $handle = $dpo->prepare("SELECT firstname FROM users where username=?");
        $handle->bindValue(1,$username);
        $handle->execute();
        $handle->setFetchMode(PDO::FETCH_ASSOC);
        $result= $handle->fetchColumn();
        $this->closeConnection();
        return $result;

    }


    function getArticles($username){

        $dpo =  $this->openConnection();
        $handle = $dpo->prepare("SELECT id, title, content FROM articles where userId=  (select users.id from users where username=?)");
        $handle->bindValue(1,$username);
        $handle->execute();
        $result= $handle->fetchAll(PDO::FETCH_ASSOC);
        $this->closeConnection();
        return $result;

    }


    function getArticle($id){

        $dpo = $this->openConnection();
        $handle = $dpo->prepare("SELECT id, title, content FROM articles where id= ?");
        $handle->bindValue(1,$id);
        $handle->execute();
        $handle->setFetchMode(PDO::FETCH_ASSOC);
        $result= $handle->fetchAll();
        $this->closeConnection();
        return $result;

    }


    function updateArticle($id, $title,$content){

        $dpo = $this->openConnection();
        $handle = $dpo->prepare("UPDATE `articles` SET `title` = ?, `content` = ? WHERE `articles`.`id` = ?");
        $handle->bindValue(1,$title);
        $handle->bindValue(2,$content);
        $handle->bindValue(3,$id);
        $handle->execute();
        $this->closeConnection();

    }

    function insertArticle( $title,$content, $uid){

        $dpo = $this->openConnection();
        $handle = $dpo->prepare("insert into articles (`title`, `content`, `userId`) values (?,?,? ");
        $handle->bindValue(1,$title);
        $handle->bindValue(2,$content);
        $handle->bindValue(3,$uid);
        $handle->execute();
        $this->closeConnection();

    }

    function getUserId($username){

        $dpo = $this->openConnection();
        $handle = $dpo->prepare("SELECT id FROM users where username=?");
        $handle->bindValue(1,$username);
        $handle->execute();
        $handle->setFetchMode(PDO::FETCH_ASSOC);
        $result= $handle->fetchColumn();
        $this->closeConnection();
        return $result;

    }

    function deleteArticle($id){

        $dpo = $this->openConnection();
        $handle = $dpo->prepare("Delete from `articles` where id =  ?");
        $handle->bindValue(1,$id);
        $handle->execute();
        $this->closeConnection();

    }

}