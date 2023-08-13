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
                                    <label class="font-weight-normal h3">Nicollette Porca</label>
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
                                    <label class="m-0 font-weight-normal">4TH -</label>
                                    <label class="m-0 font-weight-normal">A</label>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card">
                                <div class="card-header">
                                    <ul class="nav nav-tabs card-header-tabs">
                                        <li class="nav-item">
                                            <a class="nav-link active" href="settings_personal_info.php">
                                                Personal Information
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="settings_passwords.php">Password</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="card-body p-4">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="campus mb-2">
                                                <label class="font-weight-normal">Campus
                                                    <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <select class="form-control">
                                                    <option value="0">Select Campus</option>
                                                    <option value="1">Main</option>
                                                    <option value="2">North</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="student-no mb-2">
                                                <label class="font-weight-normal">Student No.
                                                    <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <input type="number" class="form-control"
                                                    placeholder="Enter student no.">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="full-name">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="first-name mb-2">
                                                    <label class="font-weight-normal">First Name
                                                        <span class="text-danger font-weight-bold">*</span>
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter first name">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="last-name mb-2">
                                                    <label class="font-weight-normal">Last Name
                                                        <span class="text-danger font-weight-bold">*</span>
                                                    </label>
                                                    <input type="text" class="form-control"
                                                        placeholder="Enter last name">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="course mb-2">
                                                <label class="font-weight-normal">Course
                                                    <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <select class="form-control">
                                                    <option value="0">Select Course</option>
                                                    <option value="1">Bachelor of Science in Computer Science</option>
                                                    <option value="2">Bachelor of Science in Information Technology
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="school-year mb-2">
                                                <label class="font-weight-normal">School Year
                                                    <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <select class="form-control">
                                                    <option value="0">Select School Year</option>
                                                    <option value="1">1ST</option>
                                                    <option value="2">2ND</option>
                                                    <option value="3">3RD</option>
                                                    <option value="4">4TH</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="section mb-2">
                                                <label class="font-weight-normal">Section
                                                    <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <select class="form-control">
                                                    <option value="0">Select Section</option>
                                                    <option value="1">A</option>
                                                    <option value="2">B</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="gender mb-2">
                                                <label class="font-weight-normal">Gender
                                                    <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <select class="form-control">
                                                    <option value="0">Select Gender</option>
                                                    <option value="1">Male</option>
                                                    <option value="2">Female</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="email mb-3">
                                                <label class="font-weight-normal">Email
                                                    <span class="text-danger font-weight-bold">*</span>
                                                </label>
                                                <input type="email" class="form-control" placeholder="Enter email">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="save-button">
                                                <button class="btn btn-primary d-flex float-right">Save Changes</button>
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