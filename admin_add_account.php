<?php 
session_start();

if (!isset($_SESSION['admin_user'])) {
    header('Location: login.php');
    exit;
}
?>
<!DOCTYPE html>
<!-- helloworld -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCC REAP</title>
    <link rel="icon" href="dist/image/UCC.png">
    <link rel="stylesheet" href="dist/css/all.css">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/dist/css/adminlte.min.css?v=3.2.0">
    <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">
        <nav class="main-header navbar navbar-expand navbar-white navbar-light">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
                </li>
            </ul>
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </nav>

        <aside class="main-sidebar sidebar-dark-primary elevation-4">
            <a href="index3.html" class="brand-link">
                <img src="dist/image/UCC.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">UCC ReaP</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block"><?php echo $_SESSION['admin_user'] ?></a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="admin_approve_abstract.php" class="nav-link ">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>PENDING</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="admin_adding_courses.php" class="nav-link ">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Courses</p>
                            </a>
                        </li>

                        <li class="nav-item">
                            <a href="admin_add_account.php" class="nav-link active">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Account</p>
                            </a>
                        </li>
                        
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <h1 class="font-weight-normal">Dashboard</h1>
                </div>
            </div>

            <section class="content">
                <div class="container">
                
                    <div class="card p-3 rounded-0">
                        <div class="print-button mb-3">
                        <button class="btn btn-primary mb-3" id="add_account_admin" data-toggle="modal"
                        data-target="#add_account">Add Account</button>
                       
                        </div> 
                     
                        
                        <div class="card p-3 rounded-0">
                            <table id="admin_account" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Password</th>
                                        <th>Action</th>     
                                    </tr>
                                </thead>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        
         <!-- add department modal -->
        <div class="modal fade" id="add_account" tabindex="-1" role="dialog" aria-labelledby="addDepartmentModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="addDepartmentModalLabel">Add Username</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="course">Username:</label>
                            <input type="text" class="form-control" id="username"
                                placeholder="Set Username">
                        </div>

                        <div class="mb-3">
                            <label for="course">Password:</label>
                            <input type="password" class="form-control" id="password"
                                placeholder="Set Password">
                        </div>

                        <div class="mb-3">
                            <label for="professorName" class="mt-2">Confirm Password:</label>
                            <input type="password" class="form-control" id="passconfirm"
                                placeholder="Enter Confirm Password">
                                </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-primary" data-dismiss="modal"
                                onclick="Add_admin()">Add</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- edit details modal -->
        <div class="modal fade" id="update_account" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
                    </div>
                    <div class="modal-body">
                        <div class="mb-3">

                            <label for="">Username:</label>
                            <input type="text" class="form-control" id="update_username"
                        >
                        </div>
                        <div class="mb-3">
                            <label for="" class="mt-2">Password:</label>
                            <input type="password" class="form-control" id="update_password"
                        >
                        </div>

                        <div class="mb-3">
                            <label for="" class="mt-2">Confirm Password:</label>
                            <input type="password" class="form-control" id="update_Cpassword"
                        >
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" data-dismiss="modal"
                            onclick="course_update()">Update</button>
                        <input type="hidden" id="hiddendata_account">
                    </div>
                </div>
            </div>
        </div>


        <footer class="main-footer">
            <strong>Copyright &copy; 2023-2024.
                <a href="https://www.ucc-caloocan.edu.ph/" class="text-muted" target="blank">
                    University of Caloocan City
                </a>.
            </strong> All rights reserved.
        </footer>
    </div>

    <script src="https://adminlte.io/themes/v3/plugins/jquery/jquery.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="https://adminlte.io/themes/v3/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <script src="https://adminlte.io/themes/v3/dist/js/adminlte.js?v=3.2.0"></script>
    <script src="https://adminlte.io/themes/v3/dist/js/pages/dashboard.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.7.0.js"></script> -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap4.min.js"></script>
    <script>
  $(document).ready(function () {

        $('#admin_account').DataTable({
                'serverside': true,
                'processing': true,
                'paging': true,
                "columnDefs": [
                    { "className": "dt-center", "targets": "_all" },
                ],
                'ajax': {
                    'url': 'admin_account_tbl.php',
                    'type': 'post',
                
                },
            });
        });


        
     

        function Add_admin() {
            var username = $('#username').val();
            var password = $('#password').val();
            var passconfirm = $('#passconfirm').val();

            if (password != passconfirm) {
                alert("Password not match!");
            } else {
                $.ajax({
                    url: "admin_add_admin.php",
                    type: 'post',
                    data: {
                        username: username,
                        password: password,
                        passconfirm: passconfirm
                    },
                    success: function (data) {
                        var data = JSON.parse(data);
                        if (data.status == 'data_exist') {
                             alert('Data already exists.');
                            $('#username').val("");
                            $('#password').val("");
                            $('#passconfirm').val("");
                        } else if (data.status == 'success') {
                            $('#admin_account').DataTable().ajax.reload();
                            // alert('Data added successfully.');
                            $('#username').val("");
                            $('#password').val("");
                            $('#passconfirm').val("");
                        } else {
                            alert('Failed to add data.');
                        }
                    }
                })
            }
        }


        function update_admin_password(update) {
            $('#hiddendata_account').val(update);
            $.post("admin_update_account.php", { update: update }, function (data,
                status) {
                var userids = JSON.parse(data);
                $('#update_username').val(userids.username);
              
              
            });
            $('#update_account').modal("show");
        }

        function course_update(status) {
            var username = $('#update_username').val();
            var password = $('#update_password').val();
            var passconfirm = $('#update_Cpassword').val();
            var hiddendata =   $('#hiddendata_account').val();
            
            if (password != passconfirm) {
                alert("Password not match!");
            } else {

            $.post("admin_update_account.php", {
                 username: username,  hiddendata: hiddendata, password:password
            }, function (data, status) {
                var jsons = JSON.parse(data);
                status = jsons.status;
                if (status == 'success') {
                    var update = $('#admin_account').DataTable().ajax.reload();
                }
            });
        }
        
        }
    </script>
</body>

</html>