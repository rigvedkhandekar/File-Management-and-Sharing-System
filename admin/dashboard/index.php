<?php
include '../../util/config.php';
include '../../util/check-admin-session.php';
include '../../util/strings.php';
include '../../util/util.php';

if(isset($_GET['approve-user']) && isset($_GET['uid']))
{
    $uid = $_GET['uid'];
    $query = "UPDATE `users` SET `status`= 1 WHERE `users`.`uid`= :uid";
    $result = query($query,['uid'=>$uid]);

    header("location:../../admin/dashboard/index.php?success=1&uid=".$uid);
} //approve

if(isset($_GET['reject-user']) && isset($_GET['uid']))
{
    $uid = $_GET['uid'];
    $query = "UPDATE `users` SET `status`= 2 WHERE `users`.`uid`= :uid";
    $result = query($query,['uid'=>$uid]);

    header("location:../../admin/dashboard/index.php?success=2&uid=".$uid);
} //reject


if(isset($_GET['suspend-user']) && isset($_GET['uid']))
{
    $uid = $_GET['uid'];
    $query = "UPDATE `users` SET `status`= 3 WHERE `users`.`uid`= :uid";
    $result = query($query,['uid'=>$uid]);

    header("location:../../admin/dashboard/index.php?success=3&uid=".$uid);
} //delete




$todaysDate = date('Y-m-d');

?>
    <head>
        <base href="../../template/">
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title><?php echo $project_name; ?> Admin Dashboard</title>

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
                        <button type="button" class="nav-toggle"><i data-toggle="expanded" class="ik ik-toggle-right toggle-icon"></i></button>
                        <button id="sidebarClose" class="nav-close"><i class="ik ik-x"></i></button>
                    </div>

                    <div class="sidebar-content">
                      <div class="nav-container">
                        <nav id="main-menu-navigation" class="navigation-main">
                          <div class="nav-lavel">User Management</div>
                          <div class="nav-item active">
                            <a href="../../fss/admin/dashboard/"><i class="ik ik-user"></i><span>Manage Users</span> </a>
                          </div>
                          <div class="nav-item">
                            <a href="../../fss/admin/monitor"><i class="ik ik-file-plus"></i><span>Monitor Users</span> </a>
                          </div>

                          <div class="nav-lavel">Account</div>
                          <div class="nav-item">
                            <a href="../../fss/admin/login/logout.php"><i class="ik ik-log-out"></i><span>Logout</span> </a>
                          </div>

                        </nav>
                      </div>
                    </div>
                </div>

                          <div class="main-content">
                              <?php
                              if (isset($_GET['success']) && isset($_GET['uid'])) {
                                  $code = $_GET['success'];
                                  $uid = $_GET['uid'];
                                  echo $code;
                                  if ($code == 1)
                                      {
                                          echo "
                                              <script>
                                              Swal.fire({
                                               title: 'Following user has been approved.',
                                               html: 'User ID : $uid <br>',
                                               icon: 'success',
                                               timer: 3000,
                                               allowOutsideClick: false,
                                               showCancelButton: false,
                                               showConfirmButton: false
                                               })
                                               .then(() => {
                                                 window.location.href = '../../fss/admin/dashboard/';
                                               });
                                           </script>";
                                      }

                                  else if ($code == 2)
                                  {
                                      echo "
                                              <script>
                                              Swal.fire({
                                               title: 'Following user has been rejected.',
                                               html: 'User ID : $uid <br>',
                                               icon: 'error',
                                               timer: 3000,
                                               allowOutsideClick: false,
                                               showCancelButton: false,
                                               showConfirmButton: false
                                               })
                                               .then(() => {
                                                 window.location.href = '../../fss/admin/dashboard/';
                                               });
                                           </script>";
                                  }

                                  else
                                  {
                                      echo "
                                              <script>
                                              Swal.fire({
                                               title: 'Following user has been suspended.',
                                               html: 'User ID : $uid <br>',
                                               icon: 'warning',
                                               timer: 3000,
                                               allowOutsideClick: false,
                                               showCancelButton: false,
                                               showConfirmButton: false
                                               })
                                               .then(() => {
                                                 window.location.href = '../../fss/admin/dashboard/';
                                               });
                                           </script>";
                                  }


                              }
                              ?>
                            <div class="mt-1 row">
                                <div class="col-sm-12">
                                    <div class="card">
                                        <div class="card-header d-block">
                                            <h3>All Exams</h3>
                                        </div>
                                        <div class="card-body">
                                            <div class="dt-responsive">
                                                <table id="simpletable" class="table table-striped table-bordered nowrap table-responsive">
                                                    <colgroup>
                                                        <col span="1" style="width: 1%;">
                                                        <col span="2" style="width: 1%;">
                                                        <col span="3" style="width: 1%;">
                                                        <col span="4" style="width: 1%;">
                                                        <col span="5" style="width: 1%;">
                                                        <col span="6" style="width: 1%;">
                                                        <col span="7" style="width: 1%;">
                                                    </colgroup>
                                                    <thead>
                                                        <tr>
                                                            <th>User ID</th>
                                                            <th>Name</th>
                                                            <th>Email</th>
                                                            <th>Contact No.</th>
                                                            <th>Profession</th>
                                                            <th>Account Status</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>

                                                    <tbody>
                                                        <?php
                                                        $fetchUsers = "SELECT * FROM `users`";
                                                        $stmt = $pdo->query($fetchUsers);
                                                        while ($data = $stmt->fetch()) {
                                                            if ($data['status'] == 1)
                                                            {
                                                                $status = 'Approved';
                                                            }
                                                            elseif ($data['status'] == 2)
                                                            {
                                                                $status = 'Rejected';
                                                            }
                                                            elseif ($data['status'] == 3)
                                                            {
                                                                 $status = 'Suspended';
                                                            }
                                                           else
                                                            {
                                                                 $status = 'Pending';
                                                            }

                                                        ?>
                                                            <tr>
                                                                <td><?php echo $data['uid']; ?></td>
                                                                <td><?php echo $data['fn']." ".$data['ln']; ?></td>
                                                                <td><?php echo $data['email']; ?></td>
                                                                <td><?php echo $data['contact']; ?></td>
                                                                <td><?php echo $data['profession']; ?></td>
                                                                <td style="text-decoration: underline; text-underline: #1d2124"><?php echo $status ?></td>

                                                                <td>
                                                                    <?php if ($status == 'Pending')
                                                                        {?>
                                                                    <a href="../../fss/admin/dashboard/index.php?approve-user=1&uid=<?php echo $data['uid'];?>" type="button" name="approve-user" class="btn btn-success">Approve User
                                                                    </a>

                                                                    <a href="../../fss/admin/dashboard/index.php?reject-user=1&uid=<?php echo $data['uid'];?>" type="button" name="reject-user" class="btn btn-danger">Reject User
                                                                    </a>
                                                                    <?php
                                                                        }
                                                                    ?>

                                                                    <?php if ($status == 'Approved')
                                                                    {?>
                                                                        <a href="../../fss/admin/dashboard/index.php?suspend-user=1&uid=<?php echo $data['uid'];?>" type="button" name="suspend-user" class="btn btn-warning">Suspend User
                                                                        </a>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                    <?php if ($status == 'Rejected')
                                                                    {?>
                                                                        <a href="../../fss/admin/dashboard/index.php?approve-user=1&uid=<?php echo $data['uid'];?>" type="button" name="approve-user" class="btn btn-info">Approve User
                                                                        </a>
                                                                        <?php
                                                                    }
                                                                    ?>

                                                                    <?php if ($status == 'Suspended')
                                                                    {?>
                                                                        <a href="../../fss/admin/dashboard/index.php?approve-user=1&uid=<?php echo $data['uid'];?>" type="button" name="view-questions" class="btn btn-info">Approve User
                                                                        </a>
                                                                        <?php
                                                                    }
                                                                    ?>


                                                                </td>
                                                            </tr>
                                                        <?php
                                                        }
                                                        ?>

                                                    </tbody>
                                                    <tfoot>
                                                    <tr>
                                                        <th>User ID</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Contact No.</th>
                                                        <th>Profession</th>
                                                        <th>Account Status</th>
                                                        <th>Action</th>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>





                <footer class="footer">
                    <div class="w-100 clearfix">
                        <span class="text-center text-sm-left d-md-inline-block">Copyright © 2020 <?php echo $copyRightOwner; ?>. All Rights Reserved.</span>
                        <span class="float-none float-sm-right mt-1 mt-sm-0 text-center">Developed and Designed by  <?php echo $developerLink; ?></span>
                    </div>
                </footer>

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



        $('#simpletable').DataTable();

    </script>

</body>
</html>
