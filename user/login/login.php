<?php

include '../../util/config.php';
include '../../util/util.php';
include '../../util/strings.php';


session_start ();
session_destroy ();

if (isset ($_POST['submit-login']) && $_POST['submit-login'] == 1 && $_POST['input_email'] && $_POST['input_password'])
{
    $email = $_POST['input_email'];
    $password = md5($_POST['input_password']);
//    echo $password;

    $query = "SELECT * from `users` where `email` = :email AND `pass` = :password";
    $result = query($query,['email'=>$email,'password'=>$password]);
    $data = $result->fetch();

    if ($result->rowCount() > 0)
    {
        session_start ();
        $_SESSION['user']=true;
        $_SESSION['username']=$data['fn'];
        $_SESSION['user-email']=$data['email'];
        echo json_encode(array('login-success'=>true));
    }

    else
    {
        var_dump(http_response_code(409));
    }
}

?>
