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
    <link rel="stylesheet" href="dist/css/font.css">
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
            <a href="search_engine.php" class="brand-link">
                <img src="dist/image/UCC.png" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
                    style="opacity: .8">
                <span class="brand-text font-weight-light">UCC ReaP</span>
            </a>

            <div class="sidebar">
                <div class="user-panel mt-3 pb-3 mb-3 d-flex">
                    <div class="info">
                        <a href="#" class="d-block">
                            <?php echo $_SESSION['admin_user'] ?>
                        </a>
                    </div>
                </div>
                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="admin_approve_abstract.php" class="nav-link active">
                                <i class="nav-icon fas fa-clock"></i>
                                Pending
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin_adding_courses.php" class="nav-link">
                                <i class="nav-icon fas fa-bookmark"></i>
                                Courses
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin_add_account.php" class="nav-link">
                                <i class="nav-icon fas fa-user-plus"></i>
                                Account
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="admin_cover-page.php" class="nav-link">
                                <i class="nav-icon fas fa-book"></i>
                                Cover Page
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <h1 class="font-weight-normal text-muted">Pending</h1>
                </div>
            </div>
            <section class="content">
                <div class="container">
                    <div class="card p-3 rounded-0">
                        <div class="card p-3 rounded-0">
                            <div class="table-responsive">
                                <table id="Pending_abstacts" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Title</th>
                                            <th>Author</th>
                                            <th>Uploaded By:</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>

    <!-- show abstract modal -->
    <div class="modal fade" id="viewAbstract" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Abstract</h5>
                </div>
                <div class="modal-body view">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="hidden" id="hiddendata">
                </div>
            </div>
        </div>
    </div>

    <!-- edit details modal -->
    <div class="modal fade" id="update" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Details</h5>
                </div>
                <div class="modal-body">
                    <div class="title mb-2">
                        <label>Title <span class="text-danger">*</span></label>
                        <input type="text" class="form-control" id="Update_title" placeholder="Enter new title"
                            disabled>
                    </div>

                    <div class="status">
                        <label>Status <span class="text-danger">*</span></label>
                        <select class="form-control" name="" id="update_status">
                            <option value="" readonly>Select Status</option>
                            <option value="1">Approved</option>
                            <option value="0">Pending</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal"
                        onclick="update1()">Update</button>
                    <input type="hidden" id="hiddendata">
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

            $('#Pending_abstacts').DataTable({
                'serverside': true,
                'processing': true,
                'paging': true,
                "columnDefs": [
                    { "className": "dt-center", "targets": "_all" },
                ],
                'ajax': {
                    'url': 'pending_abstract_tbl.php',
                    'type': 'post',

                },
            });
        });


        function view(views) {
            $('#hiddendata').val(views);

            $.ajax({
                url: 'admin_view_abstract.php',
                type: 'post',
                data: { views: views }, // Change 'update' to 'views'
                success: function (response) {
                    $('.modal-body.view').html(response); // Correct the selector for modal-body
                }
            });

            $('#viewAbstract').modal("show");
        }

        function update(update) {
            $('#hiddendata').val(update);
            $.post("admin_update_status.php", { update: update }, function (data,
                status) {
                var userid = JSON.parse(data);
                $('#Update_title').val(userid.title);
                $('#update_status option[value="' + userid.status + '"]').prop('selected', true); // Use this line

            });
            $('#update').modal("show");
        }

        function update1(status) {
            var status = $('#update_status').val()
            var title = $('#Update_title').val();
            var hiddendata = $('#hiddendata').val();

            $.post("admin_update_status.php", {
                status: status, hiddendata: hiddendata
            }, function (data, status) {
                var jsons = JSON.parse(data);
                status = jsons.status;
                if (status == 'success') {
                    var update = $('#Pending_abstacts').DataTable().ajax.reload();
                }
            });

        }
    </script>
</body>

</html>