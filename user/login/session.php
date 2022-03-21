<?php

include '../../util/config.php';

session_start ();

if (isset($_POST['eno']) && isset($_POST['dept']))
{
$_SESSION['user']=true;
$_SESSION['user-session'] = array();
$_SESSION['user-session'] ['key'] = $_POST['eno'];
$_SESSION['user-session'] ['dept'] = $_POST['dept'];


print_r($_SESSION);

}

else {
      header("location:../../user/login/index.php");
}
?>
