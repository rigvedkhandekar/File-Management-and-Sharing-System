<?php
include '../../util/config.php';
include '../../util/util.php';
include '../../util/strings.php';
session_start();
session_destroy();

function userCreated($email)
{
    header("location:../../user/register/index.php?success=$email");

}

function errorOccured()
{
    header("location:../../user/register/index.php?error");

}

if (isset($_POST['submit-registration'])) {
$fn = $_POST['fn'];
$ln = $_POST['ln'];
$email = $_POST['email'];
$profession = $_POST['profession'];
$password = md5($_POST['password']);
$contact = $_POST['contact'];





    $query = "INSERT INTO `users` VALUES (NULL, :fn, :ln, :email, :password,:contact,:profession,'0')";
    //echo $query;
    $result = query($query,['fn'=>$fn, 'ln'=>$ln, 'email'=>$email, 'password'=>$password, 'contact'=>$contact, 'profession'=>$profession]);


    if ($result->rowCount()<=0) {
        errorOccured();
    }
    else
    {
        userCreated($email);
    }



}
?>

<!doctype html>
<html class="no-js" lang="en">
<head>
    <base href="../../template/">
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title><?php echo $project_name;?></title>

    <meta name="description" content="">
    <meta name="keywords" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="icon" href="favicon.ico" type="image/x-icon" />

    <link href="https://fonts.googleapis.com/css?family=Nunito+Sans:300,400,600,700,800" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/5.0.1/collection/components/icon/icon.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/icon-kit@1.0.0/dist/css/iconkit.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery.perfect-scrollbar/1.5.0/css/perfect-scrollbar.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.20/css/dataTables.bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/theme.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tempusdominus-bootstrap-4/5.0.1/css/tempusdominus-bootstrap-4.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
</head>

    <body>
    <?php
    if (isset($_GET['success'])) {
        $email = $_GET['success'];
        echo "
                                              <script>
                                              Swal.fire({
                                               title: 'Your account has been created.',
                                               html: 'Email ID : $email <br>'+
                                                       'Please wait..',
                                               icon: 'success',
                                               timer: 4000,
                                               allowOutsideClick: false,
                                               showCancelButton: false,
                                               showConfirmButton: false
                                               })
                                               .then(() => {
                                                 window.location.href = '../../fss/user/login/';
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
                                          window.location.href = '../../fss/user/register/'
                                       })
                    </script>";
        header("refresh:5;`url=../../index.php");
    }
    ?>
        <div class="auth-wrapper">
            <div class="container-fluid h-100">
                <div class="row flex-row h-100 bg-white">
                    <div class="col-xl-8 col-lg-6 col-md-5 p-0 d-md-block d-lg-block d-sm-none d-none">
                        <div class="lavalite-bg" style="background-image: url('../../../fss/template/img/auth/register-bg.jpg')">
                            <div class="lavalite-overlay"></div>
                        </div>
                    </div>
                    <div class="col-xl-4 col-lg-6 col-md-7 my-auto p-0">
                        <div class="authentication-form mx-auto">
                            <div class="logo-centered">
                                <a href="../index.html"><img src="../../../fss/template/img/auth/brand.svg" alt="" width="100"></a>
                            </div>
                            <h3>File Management and Sharing System</h3>
                            <p id="msg">Register today! It takes only few steps</p>
                            <form action="" method="POST" onsubmit="return validateForm()" name="register-user">

                                <div class="form-group" id="div-fn">
                                    <input type="text" class="form-control" placeholder="First Name" required="" name="fn" id="fn" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" maxlength="12">
                                    <i class="ik ik-user"></i>
                                </div>
                                <div class="form-group" id="div-ln">
                                    <input type="text" class="form-control" placeholder="Last Name" required="" name="ln" id="ln" onkeypress="return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode==32)" maxlength="12">
                                    <i class="ik ik-user"></i>
                                </div>
                                <div class="form-group" id="div-email">
                                    <input type="text" class="form-control" placeholder="Email" required="" name="email" id="email">
                                    <i class="ik ik-mail"></i>
                                </div>
                                <div class="form-group" id="div-contact">
                                    <input type="text" class="form-control" placeholder="Contact No." required="" name="contact" id="contact">
                                    <i class="ik ik-phone"></i>
                                </div>
                                <div class="form-group" id="div-profession">
                                    <select class="form-control" id="profession" name="profession">
                                        <option selected="true" disabled="disabled">Select Profession</option>
                                        <option value="Employee">Employee</option>
                                        <option value="Student">Student</option>
                                        <option value="School">School</option>
                                        <option value="Institute">Institute</option>

                                    </select>
                                    <i class="ik ik-file"></i>
                                </div>
                                <div class="form-group" id="div-pass">
                                    <input type="password" class="form-control" placeholder="Password" required="" name="password" id="password">
                                    <i class="ik ik-lock"></i>
                                </div>
                                <div class="form-group" id="div-cnfpass">
                                    <input type="password" class="form-control" placeholder="Confirm Password" required="" id="cnfpassword">
                                    <i class="ik ik-eye-off"></i>
                                </div>
                                <div class="form-group" id="div-otp">
                                    <input type="text" class="form-control" placeholder="Enter OTP" name="otp" id="otp" maxlength="6">
                                    <i class="ik ik-phone"></i>
                                </div>
                                <div class="row" id="div-tc">
                                    <div class="col-12 text-left">
                                        <label class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="agreement" name="agreement" value="option1">
                                            <span class="custom-control-label">&nbsp;I Accept <a href="#">Terms and Conditions</a></span>
                                        </label>
                                    </div>
                                </div>

                                <div class="sign-btn text-center">
                                    <input type="submit" name="submit-registration" id="submit-button" class="btn btn-theme" value="Create Account">
                                </div>


                            </form>
                            <div class="register">
                                <p>Already have an account? <a href="login.html">Sign In</a></p>
                            </div>
                        </div>
                    </div>
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


        <!-- Google Analytics: change UA-XXXXX-X to be your site's ID. -->
        <script>
            var otp = Math.floor(Math.random() * (888888 - 111111 + 1)) + 111111;
            var isOtpSent = false;

            $(document).ready(function() {
                $("#div-otp").hide();
            });

                function validateForm ()
            {
                var pass1 = document.getElementById("password").value;
                var pass2 = document.getElementById("cnfpassword").value;
                var agreement = document.getElementById("agreement");

                if (isOtpSent == true)
                {
                    var user_otp = document.getElementById("otp").value;
                    if (user_otp == otp)
                    {
                        // alert("page submitted.")

                    }
                    else
                    {
                        alert ("OTP Didn't match.")
                        return false;
                    }
                }


                else if (pass1 != pass2)
                {
                    alert("Password Didn't match.")

                    return false;
                }

                else
                {
                    if (agreement.checked)
                    {
                        verifyEmail ();
                        return false;

                    }
                    else
                    {
                        alert("You must accept the Terms and Conditions.")

                        return false;
                    }
                }
            }

            function verifyEmail()
            {
                $("#div-otp").show();
                $("#submit-button").attr('value', 'Verify & Create Account');



                console.log (otp);
                $.ajax({
                    type: 'POST',
                    url: '../../fss/user/register/verifyemail.php',
                    data: {
                        user_email: $('#email').val().trim(),
                        otp : otp,
                        'verify-email': '1'
                    },
                    success: function (data) {
                        isOtpSent = true;
                        console.log ("OTP SENT.")
                    },

                    statusCode: {
                        409: function () {
                            $('#staff-login').trigger("reset");
                            $('#res-msg').text('Invalid Credentials')
                        }
                    },

                    error: function (XMLHttpRequest, textStatus, errorThrown) {
                        console.error("Status : " + textStatus);
                        console.error("Error  : " + errorThrown);
                    }
                });
            }

        </script>
    </body>
</html>
