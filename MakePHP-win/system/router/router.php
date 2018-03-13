
<?php
header("Content-type: text/html; charset=utf-8");
include_once("../../APP/Controller/".$_GET['controller']."Controller.php");
$tagClass = $_GET['controller']."Controller";
$obj = new $tagClass;
$tagAction=$_GET['action'];
call_user_func(array($obj,$tagAction));
//$obj->$tagAction();
echo '当前Controller：' . $_GET['controller'];
echo '<br/>';
echo '当前Action：' . $_GET['action'];
?>