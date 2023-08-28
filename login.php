<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCC REAP</title>
    <link rel="icon" href="dist/image/UCC.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/all.css">
    <link rel="stylesheet" href="dist/css/login-register.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-light">

    <div class="container">
        <div class="card login-card rounded-0 p-4">
            <div class="logo text-center mb-4">
                <img src="dist/image/UCC.png" alt="" width="100">
            </div>
            <form>
                <div class="email mb-3">
                    <div class="input-group">
                        <input type="text" class="form-control" id="username" placeholder="Username" aria-label="Email" aria-describedby="enevelope">
                        <span class="input-group-text" id="envelope"><i class="far fa-envelope"></i></span>
                    </div>
                </div>
                <div class="password mb-3">
                    <div class="input-group">
                        <input type="password" class="form-control" id="pass" placeholder="Password" aria-label="Password" aria-describedby="lock">
                        <span class="input-group-text" id="lock"><i class="fa-solid fa-lock"></i></span>
                    </div>
                </div>
            </form>
            <!-- <div class="forgot-password mb-3">
                <a href="" class="text-muted">Forgot Password?</a>
            </div> -->
            <div class="login-button mb-3">
                <button class="btn btn-primary w-100" onclick="login()">Login</button>
            </div>
            <div class="register-link text-center">
                <a href="register.php" class="text-muted">Register here.</a>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
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
                    if (data.role == 1) {
                        setTimeout(function() {
                            window.location.href = "search_engine.php"
                        }, 2000);
                    }

                }
            });

        };
    </script>
</body>

</html>