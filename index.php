<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/22/2018
 * Time: 4:56 PM
 */
session_start();
if(!isset($_SESSION["username"])){
    header('Location: /php/login.php');
}
?>


<html>
<head>
    <title>CMS Php Project</title>
</head>
<body>
<strong>Welcome</strong><?php echo ": ".$_SESSION["username"]; ?>
<br>
<br>
<strong>You are successfully Logined</strong>
</body>
</html>

