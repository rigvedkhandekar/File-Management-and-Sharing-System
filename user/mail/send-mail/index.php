<?php
include '../../../util/config.php';
include '../../../util/util.php';
include '../../../util/check-student-session.php';
include '../../../util/strings.php';

function emailSent($to)
{
    header("location:../../../user/mail/send-mail/index.php?success=$to");

}

function errorOccured()
{
    header("location:../../../user/mail/send-mail/index.php?error");

}

if (isset ($_POST['send-mail']))
{

    $sender = $_SESSION['user-email'];
    $to = $_POST['to'];
    $subject = bin2hex($_POST['subject']);
    $message = bin2hex($_POST['message']);
    $date = date("Y-m-d");



    $query = "INSERT INTO `mails`(`mid`, `date`, `sender`, `receiver`, `subject`, `message`) VALUES (NULL,:date,:sender,:receiver,:subject,:message)";

    $result = query($query,['date'=>$date, 'sender'=>$sender, 'receiver'=>$to, 'subject'=>$subject, 'message'=>$message]);

    if ($result->rowCount()<=0) {
        errorOccured();
    }
    else
    {
        emailSent($to);
    }
}


?>
<head>
    <base href="../../../template/">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $project_name;?></title>

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="favicon.ico" type="image/x-icon"/>

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.0.1/collection/components/icon/icon.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icon-kit@1.0.0/dist/css/iconkit.min.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.css">
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/theme.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

<body>
<div class="wrapper">
    <header class="header-top" header-theme="light">
        <div class="container-fluid">
            <div class="d-flex justify-content-between">
                <div class="top-menu d-flex align-items-center">
                    <button type="button" class="btn-icon mobile-nav-toggle d-lg-none"><span></span></button>
                </div>
                <div class="top-menu d-flex align-items-center">
                    <h5><?php echo $h5Tag; ?></h5>
                </div>
            </div>
        </div>
    </header>

    <div class="page-wrap">
        <div class="app-sidebar colored">
            <div class="sidebar-header">
                <a class="header-brand" href="index.html">
                    <!-- bs center ka kya tha?? kya bootsrap c ealnter align center? maybe -->
                    <div class="logo-img">
                        <img src="img/logo.jpg" width="55" class="rounded-circle" alt="user">
                    </div>
                    <!-- <span class="text">BGIT</span> -->
                </a>
                <button type="button" class="nav-toggle"><i data-toggle="expanded"
                                                            class="ik ik-toggle-right toggle-icon"></i></button>
                <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
            </div>

            <div class="sidebar-content">
                <div class="nav-container">
                    <nav id="main-menu-navigation" class="navigation-main">
                        <div class="nav-lavel">File Sharing</div>
                        <div class="nav-item">
                            <a href="javascript:void(0) javascript:void(0) ../../fss/user/sharing/share-a-file//"><i class="ik ik-upload-cloud"></i><span>Upload a File</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="javascript:void(0) ../../fss/user/sharing/share-a-file//"><i class="ik ik-send"></i><span>Share a File</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="javascript:void(0) ../../fss/user/sharing/share-a-file//"><i class="ik ik-folder"></i><span>My Files</span>
                            </a>
                        </div>
                        <div class="nav-lavel">Mailing</div>
                        <div class="nav-item ">
                            <a href="../../fss/user/mail/inbox"><i class="ik ik-inbox"></i><span>Inbox</span> </a>
                        </div>
                        <div class="nav-item active">
                            <a href="../../fss/user/mail/send-mail"><i class="ik ik-file-plus"></i><span>Send a Mail</span> </a>
                        </div>
                        <div class="nav-item">
                            <a href="../../fss/user/mail/sent-mails"><i class="ik ik-mail"></i><span>Sent Mails</span> </a>
                        </div>
                        <div class="nav-lavel">Groups</div>
                        <div class="nav-item">
                            <a href="javascript:void(0) ../../fss/user/groups/logout.php"><i class="ik ik-share-2"></i><span>Create a sharing group</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="javascript:void(0) ../../fss/user/groups/logout.php"><i class="ik ik-users"></i><span>My Groups</span>
                            </a>
                        </div>
                        <div class="nav-lavel">Account</div>
                        <div class="nav-item">
                            <a href="../../fss/user/profile/"><i class="ik ik-user"></i><span>Profile</span>
                            </a>
                        </div>
                        <div class="nav-item">
                            <a href="../../fss/user/login/logout.php"><i class="ik ik-log-out"></i><span>Logout</span>
                            </a>
                        </div>

                    </nav>
                </div>
            </div>
        </div>

        <div class="main-content">

            <?php
            if (isset($_GET['success'])) {
                $to = $_GET['success'];
                echo "
                                              <script>
                                              Swal.fire({
                                               title: 'Email has been successfully sent.',
                                               html: 'To Email : $to <br>'+
                                                       'Please wait..',
                                               icon: 'success',
                                               timer: 4000,
                                               allowOutsideClick: false,
                                               showCancelButton: false,
                                               showConfirmButton: false
                                               })
                                               .then(() => {
                                                 window.location.href = '../../fss/user/mail/sent-mails/'
                                               });
                                           </script>";



            } else if (isset($_GET['error'])) {

                echo "<script>
                                             Swal.fire({
                                           title: 'Error occured while creating the user',
                                           html: 'Please Wait, Redirecting in 2 Seconds...',
                                           icon: 'warning',
                                           timer: 3000,
                                           allowOutsideClick: false,
                                           showCancelButton: false,
                                           showConfirmButton: false
                                         }).then(() => {
                                          window.location.href = '../../fss/user/mail/send-mail/';
                                       })
                    </script>";
                header("refresh:5;`url=../../index.php");
            }
            ?>


            <form action="../../../fss/user/mail/send-mail/index.php" id='send-mail' name='send-mail' method="POST">

                <div class="container-fluid">
                    <h5>Send Email</h5>

                    <div class="mt-3 row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="to">To :</label>
                                <input type="email" class="form-control" id="to" name="to"
                                       placeholder="Receipient Mail" required="" >
                                <span id="status"></span>

                            </div>
                        </div>
                    </div>

                    <div class="mt-3 row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="subject">Subject :</label>
                                <input type="text" class="form-control" id="subject" name="subject"
                                       placeholder="Subject" required="" maxlength="16">

                            </div>
                        </div>
                    </div>

                    <div class="mt-3 row clearfix">
                        <div class="col-lg-4 col-md-6 col-sm-12">
                            <div class="form-group">
                                <label for="subject">Message :</label>
                                <textarea type="textarea" class="form-control" id="message" name="message"
                                          placeholder="Message" required="" maxlength="256" rows="6"> </textarea>

                            </div>
                        </div>
                    </div>



                    <div class=" mt-3 row clearfix">
                        <button type="submit" name="send-mail" id="send_mail" value="1" class="m-2 ml-3 btn btn-success"><i
                                    class="ik ik-plus-circle"></i>Send Mail
                        </button>
                        <button type="reset" class="m-2 btn btn-danger"><i class="ik ik-x"></i>Reset</button>
                    </div>






                </div>






                </div>
            </form>

        <footer class="footer">
            <div class="w-100 clearfix">
                <span class="text-center text-sm-left d-md-inline-block">Copyright © 2020 <?php echo $copyRightOwner; ?>. All Rights Reserved.</span>
                <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Developed and Designed by  <?php echo $developerLink; ?></span>
            </div>
        </footer>

        </div>



    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="plugins/popper.js/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/perfect-scrollbar.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/screenfull.js/5.0.0/screenfull.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/jquery.dataTables.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/js/dataTables.bootstrap4.min.js"></script>
<script src="dist/js/theme.min.js"></script>
<script src="js/datatables.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.25.3/moment.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/js/tempusdominus-bootstrap-4.min.js"></script>


<script type="text/javascript">


    $(document).ready(function () {
        $('#send_mail').attr("disabled", true);

        $('#to').keyup(function(){

            var email = $(this).val();

            $.ajax({
                url:'../../fss/user/mail/send-mail/check_email.php',
                method:"POST",
                data:{
                    email:email
                     },
                success:function(data)
                {
                    var dataObj = JSON.parse(data);

                    if (dataObj['email-valid'] != true)
                    {
                        $('#status').html('<span class="text-danger">This email does not exists.</span>');
                        $('#send_mail').attr("disabled", true);
                    }
                    else
                    {
                        $('#status').html('<span class="text-success">The above Email is found Valid.</span>');
                        $('#send_mail').attr("disabled", false);
                    }
                }
            })

        });

    });

    $('#simpletable').DataTable();




</script>

</body>
</html>
