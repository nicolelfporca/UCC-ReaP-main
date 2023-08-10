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
                        <li class="nav-item menu-open">
                            <a href="upload_form.php" class="nav-link active">
                                <i class="nav-icon fas fa-upload"></i>
                                <p>Upload</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="settings_personal_info.php" class="nav-link">
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
                    <h1 class="font-weight-normal">Upload Form</h1>
                </div>
            </div>

            <section class="content">
                <div class="container">
                    <div class="row">
                        <div class="card p-4 w-100 rounded-0">
                            <div class="title mb-2">
                                <label class="font-weight-normal w-50">Title:</label>
                                <input type="text" class="form-control" placeholder="Enter title">
                            </div>
                            <div class="date mb-2">
                                <label class="font-weight-normal">Date:</label>
                                <input type="date" class="form-control" placeholder="Enter date">
                            </div>
                            <div class="authors mb-2">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label class="font-weight-normal">Author/s:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Enter author/s">
                                            <button class="btn" type="button"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <label class="font-weight-normal">Keyword/s:</label>
                                        <div class="input-group">
                                            <input type="text" class="form-control" placeholder="Enter keyword/s">
                                            <button class="btn" type="button"><i class="fas fa-plus"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="abstract mb-1">
                                <label class="font-weight-normal">Abstract:</label>
                                <select class="form-control">
                                    <option value="0">Select Abstract</option>
                                    <option value="1">Plain Text</option>
                                    <option value="2">Upload Photo</option>
                                </select>
                            </div>
                            <div class="plain-text">
                                <textarea rows="8" class="form-control"></textarea>
                            </div>
                            <div class="upload-photo">
                                <label class="btn btn-secondary font-weight-normal">
                                    <input type="file" hidden />
                                    Upload Photo
                                </label>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <button class="btn btn-primary d-flex float-right">Submit</button>
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