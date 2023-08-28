<?php 
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCC REAP</title>
    <link rel="icon" href="dist/image/UCC.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/font.css">
    <link rel="stylesheet" href="dist/css/search_engine.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="dropdown d-flex justify-content-end mt-2">
        <button class="btn dropdown-toggle text-white" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="dist/image/unknown.jpg" alt="User Profile" width="50" class="user-profile">
        </button>
        <div class="dropdown-menu border-0 rounded-0 text-center" aria-labelledby="dropdownMenuButton">
            <!-- ito ibahin pag naka log in na -->
            <?php if ($_SESSION['stdno'] != "") { ?>
            <div class="for-user">
                <a class="dropdown-item" href="upload_form.php">Upload</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="settings_personal_info.php">Profile</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item text-danger" href="logout.php">Logout</a>
            </div>
            <?php } else { ?>
            <div class="join-sign-in">
                <a class="dropdown-item" href="register.php">Join now</a>
                <div class="dropdown-divider"></div>
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModalCenter">Sign up</a>
            </div>
            <?php } ?>
        </div>
    </div>

    <!-- sign in modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="logo text-center mb-4">
                        <img src="dist/image/UCC.png" alt="" width="100">
                    </div>
                    <form>
                        <div class="email mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" id="username" placeholder="Username" aria-label="Email"
                                    aria-describedby="enevelope">
                                <span class="input-group-text" id="envelope"><i class="far fa-envelope"></i></span>
                            </div>
                        </div>
                        <div class="password mb-3">
                            <div class="input-group">
                                <input type="password" class="form-control" id="pass" placeholder="Password" aria-label="Password"
                                    aria-describedby="lock">
                                <span class="input-group-text" id="lock"><i class="fa-solid fa-lock"></i></span>
                            </div>
                        </div>
                    </form>
                    <div class="login-button mb-3">
                        <button class="btn btn-primary w-100" onclick="login()">Login</button>
                    </div>
                    <div class="register-link text-center">
                        <a href="register.php" class="text-muted">Register here.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="s006">
        <form action="links_page.php" method="GET">
            <fieldset>
                <div class="ucc-logo mb-3">
                    <img src="dist/image/UCC.png" alt="UCC Logo" width="160" class="rounded mx-auto d-block">
                </div>
                <div class="reap text-center text-white mb-4 h1">
                    <b>UCC Research and Publication Online</b>
                </div>
                <div class="inner-form">
                    <div class="input-field">
                        <button class="btn-search" type="submit" value="search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                                </path>
                            </svg>
                        </button>
                        <input id="search" type="text" name="/" placeholder="Search..." required>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/script.js"></script>
    <script src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');

        function login() {
            var username = $("#username").val();
            var pass = $("#pass").val();

            var payload = {
                username: username,
                pass: pass
            };

            $.ajax({
                type: "POST",
                url: 'controllers/login_controller.php',
                data: {
                    payload: JSON.stringify(payload),
                    setFunction: 'checkUserDb'
                },
                success: function(response) {
                    data = JSON.parse(response);
                    swal.fire(data.title, data.message, data.icon);
                        setTimeout(function() {
                            window.location.reload();
                        }, 2000);
                }
            });

        };
    </script>
    <script src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854"></script>
</body>

</html>

<script>
</script>
</head>