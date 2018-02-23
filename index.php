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
include "DBHelper.php";
?>
<html>
<head>
    <title>CMS Php Project</title>
    <style>
        table {
            font-family: arial, sans-serif;
            border-collapse: collapse;
            width: 100%;
        }
        td, th {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        tr:nth-child(even) {
            background-color: #dddddd;
        }
    </style>
</head>
<body>
<strong>Welcome</strong><?php echo ": ".$_SESSION["firstname"]."  "; ?>
<a href="/php/logout.php">Logout</a>
<br>
<a href="/php/newArticle.php">Add Article</a>
<br>
<table>
    <tr>
        <th>Title</th>
        <th>Content</th>
        <th>Settings</th>
    </tr>
<?php
    $db= new DBHelper("localhost","root","","cms");
    $articles = $db->getArticles($_SESSION["username"]);
    foreach ($articles as $article){
        echo "<tr><td>".$article["title"]."</td>
        <td>".$article["content"]."</td><td><a href=\"/php/update.php?id=".$article["id"]."\">update</a></td><tr>";
    }
?>
</table>



</body>
</html>

