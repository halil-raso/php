<?php
/**
 * Created by PhpStorm.
 * User: halil
 * Date: 2/23/2018
 * Time: 11:53 AM
 */
session_start();
?>
<!DOCTYPE html>
<html>
<body>

<?php
session_unset();
session_destroy();
header('Location: login.php');
?>

</body>
</html>