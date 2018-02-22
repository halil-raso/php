<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/22/2018
 * Time: 4:56 PM
 */

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if($_REQUEST["username"]=="admin" && $_REQUEST["password"]=="admin"){
        echo "Welcome To CMS Project";
    }
} elseif ($_SERVER["REQUEST_METHOD"]=="GET"){
    echo "<html>
<head>
    <title>CMS Php Project</title>
</head>
<body>
<form action=\"index.php\" method=\"post\">
    Username: <input type=\"text\" name=\"username\">
    <br>
    Password: <input type=\"password\" name=\"password\">
    <br>
    <input type=\"submit\" value=\"submit\">
</form>
</body>
</html>";
}

?>

