<?php
include '../../../util/config.php';
include '../../../util/util.php';
include '../../../util/check-student-session.php';
include '../../../util/strings.php';

if(isset($_POST['email'])) {
    $email = $_POST['email'];
    $query = "SELECT * from `users` where `email` = :email";
    $result = query($query, ['email' => $email]);
    $data = $result->fetch();

    if ($result->rowCount() > 0) {
        echo json_encode(array('email-valid' => true));
    }

    else
    {
        echo json_encode(array('email-valid' => false));
    }
}
?>