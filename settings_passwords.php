<!DOCTYPE html>
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
                    <a class="nav-link" href="#">Logout</a>
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
                        <a href="#" class="d-block">Nicollette Porca</a>
                    </div>
                </div>

                <nav class="mt-2">
                    <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu"
                        data-accordion="false">
                        <li class="nav-item">
                            <a href="upload_form.php" class="nav-link">
                                <i class="nav-icon fas fa-upload"></i>
                                <p>Upload</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="settings_personal_info.php" class="nav-link active">
                                <i class="nav-icon fas fa-cog"></i>
                                <p>Settings</p>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </aside>

        <div class="content-wrapper">
            <div class="content-header">
                <div class="container">
                    <h1 class="font-weight-normal">Account Settings</h1>
                </div>
            </div>

            <section class="content">
                <div class="container">
                    <div class="row g-3">
                        <div class="col-sm-4">
                            <div class="card p-4 rounded-0">
                                <div class="user_profile mb-2 text-center">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <img src="dist/image/unknown.jpg" alt="User Profile" width="150"
                                                style="border-radius:5rem;">
                                        </div>
                                    </div>
                                </div>
                                <div class="user_name mb-1 text-center">
                                    <label class="font-weight-normal h5">Nicollette Loanne F. Porca</label>
                                </div>
                                <div class="edit-photo text-center">
                                    <label class="btn btn-secondary font-weight-normal">
                                        <input type="file" hidden />
                                        Edit Photo
                                    </label>
                                </div>

                                <hr>

                                <div class="student-no-profile mb-3">
                                    <label class="m-0">Student No.</label> <br>
                                    <label class="m-0 font-weight-normal">20200108-M</label>
                                </div>
                                <div class="course mb-3">
                                    <label class="m-0">Course</label> <br>
                                    <label class="m-0 font-weight-normal">Bachelor of Science in Computer
                                        Science</label>
                                </div>
                                <div class="year-section">
                                    <label class="m-0">Year & Section</label> <br>
                                    <label class="m-0 font-weight-normal">4th -</label>
                                    <label class="m-0 font-weight-normal">A</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link" href="settings_personal_info.php">Personal
                                                Information</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link active" href="settings_passwords.php">Password</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="current-password mb-2">
                                                <label class="font-weight-normal">Current Password
                                                    <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <input type="password" class="form-control"
                                                    placeholder="Enter current password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="new-password mb-2">
                                                <label class="font-weight-normal">New Password
                                                    <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <input type="password" class="form-control"
                                                    placeholder="Enter new password">
                                            </div>
                                        </div>
                                        <div class="col-sm-6 mb-3">
                                            <div class="confirm-password">
                                                <label class="font-weight-normal">Confirm Password
                                                    <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <input type="password" class="form-control"
                                                    placeholder="Enter confirm password">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row d-flex float-right pr-3">
                                        <div class="row">
                                            <div class="delete-account mr-2">
                                                <button class="btn btn-danger">Delete Account</button>
                                            </div>
                                            <div class="save-button">
                                                <button class="btn btn-primary">Save
                                                    Changes</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
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
</body>

</html>