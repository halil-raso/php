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

        $stmt = $this->connection->prepare("SELECT id, username, password FROM users where username=\"".$_REQUEST["username"]."\" and password=\"".$_REQUEST["password"]."\"");
        $stmt->execute();
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $result = $stmt->rowCount();
        return $result;

    }


}