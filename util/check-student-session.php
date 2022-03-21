<?php

session_start();

if (!(isset($_SESSION['user']) && isset($_SESSION['username']))) {
    header("location:../../user/login/");
}
?>