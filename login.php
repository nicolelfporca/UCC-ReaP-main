<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCC REAP</title>
    <link rel="icon" href="dist/image/UCC.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/font.css">
    <link rel="stylesheet" href="dist/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="login-body">

    <div class="container">
        <div class="card login-card rounded-0 p-4">
            <div class="logo text-center mb-4">
                <img src="dist/image/UCC.png" alt="UCC Logo" width="100">
            </div>
            <form>
                <div class="email mb-3">
                    <div class="input-group">
                        <input type="number" class="form-control rounded-0" id="username" placeholder="Student no."
                            aria-label="Email" aria-describedby="enevelope">
                        <span class="input-group-text rounded-0" id="envelope"><i class="far fa-envelope"></i></span>
                    </div>
                </div>
                <div class="password mb-3">
                    <div class="input-group">
                        <input type="password" class="form-control rounded-0" id="pass" placeholder="Password"
                            aria-label="Password" aria-describedby="lock">
                        <span class="input-group-text rounded-0" id="lock"><i class="fa-solid fa-lock"></i></span>
                    </div>
                </div>
            </form>
            <div class="login-button mb-3">
                <button class="btn btn-primary w-100 rounded-0" onclick="login()">Login</button>
            </div>
            <div class="register-link text-center">
                <a href="register.php" class="text-muted">Register here.</a>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
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
                success: function (response) {
                    data = JSON.parse(response);
                    if (data.role == 1) {
                        swal.fire(data.title, data.message, data.icon);
                        setTimeout(function () {
                            window.location.href = "search_engine.php"
                        }, 2000);
                    } else if (data.role == 2) {
                        Swal.fire(
                            'Welcome',
                            'Successfully login',
                            'success'
                        )
                        setTimeout(function () {
                            window.location.href = "admin_approve_abstract.php"
                        }, 2000);
                    } else {
                        swal.fire(data.title, data.message, data.icon);
                    }
                }
            });
        };
    </script>
</body>

</html>