<?php
include './includes/config.php';
session_start();
ini_set('display_errors', 0);
ini_set('display_startup_errors', 0);
error_reporting(0);


$pdo = Database::connection();

// Get the search query from the form submission
if (isset($_GET['/'])) {
    $search_query = $_GET['/'];
} else {
    die("No search query provided.");
}

// Prepare the query to fetch matching data from the database
$value = $search_query;

$search_query = '%' . $search_query . '%';
$status = 1;
$column = "title, keywords, abstract, date";



//$sql = "SELECT $column FROM user WHERE (title LIKE :search_query OR keywords LIKE :search_query OR abstract LIKE :search_query OR author = :search_query) AND status = :status";
$sql = "
    SELECT $column,
    CASE
        WHEN title LIKE :search_query THEN 3
        WHEN keywords LIKE :search_query THEN 2
        WHEN author LIKE :search_query THEN 1
        ELSE 0
    END AS relevance
    FROM user
    WHERE (title LIKE :search_query OR keywords LIKE :search_query OR author LIKE :search_query)
    AND status = :status
    ORDER BY relevance DESC";

$stmt = $pdo->prepare($sql);

$stmt->bindValue(':search_query', $search_query, PDO::PARAM_STR);
$stmt->bindValue(':status', $status, PDO::PARAM_INT);

$stmt->execute();



?>



<!DOCTYPE html>
<!-- helloworld -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCC REAP</title>
    <link rel="icon" href="dist/image/UCC.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/font.css">
    <link rel="stylesheet" href="dist/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="search_engine.php">
                <img src="dist/image/UCC.png" alt="UCC Logo" width="50" height="55" class="mr-2">
                UCC ReaP
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item">
                        <div class="input-group">
                            <input class="form-control me-1 rounded-0" type="search" placeholder="Search..."
                                value="<?php echo $value ?>" aria-label="Search" id="search">
                            <span class="input-group-append">
                                <button class="btn text-white" type="button" id="search-button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php if ($_SESSION['photo'] == "") { ?>
                                <img src="dist/image/unknown.jpg" alt="User Profile" width="50" class="user-profile">
                            <?php } else { ?>
                                <img src="<?php echo "webimg/" . $_SESSION['photo'] ?>" alt="User Profile" width="50"
                                    class="user-profile">
                            <?php } ?>
                        </a>
                        <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
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
                                    <a class="dropdown-item" href="#" data-toggle="modal"
                                        data-target="#exampleModalCenter">Sign in</a>
                                </div>
                            <?php } ?>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

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
                                <input type="text" class="form-control" id="username" placeholder="Student no."
                                    aria-label="Email" aria-describedby="enevelope">
                                <span class="input-group-text" id="envelope"><i class="far fa-envelope"></i></span>
                            </div>
                        </div>
                        <div class="password mb-3">
                            <div class="input-group">
                                <input type="password" class="form-control" id="pass" placeholder="Password"
                                    aria-label="Password" aria-describedby="lock">
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

    <div class="mt-4" id="links_page">
        <div class="container">
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="card p-2 mb-4">';
                echo '  <div class="card p-3 border-0">';
                echo '      <a href="show_page.php?name=' . urldecode($row['title']) . '" class="research-title mb-1">' . $row['title'] . '</a>';
                echo '      <div class="abstract-body mb-1">' . substr($row['abstract'], 0, 20) . "'...'" . '</div>';
                echo '      <div class="date font-italic text-muted">' . $row['date'] . '</div>';
                echo '  </div>';
                echo '</div>';
            }
            ?>
        </div>
    </div>

    <footer class="bg-white text-center text-muted border">
        <div class="text-center p-3">
            <strong>Copyright &copy; 2023-2024. <a href="https://www.ucc-caloocan.edu.ph/"
                    class="link text-muted">University of Caloocan City</a>.
            </strong> All rights reserved.
        </div>
    </footer>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            const searchInput = $("#search");

            // Perform search when Enter key is pressed in the search input
            searchInput.on("keypress", function (event) {
                if (event.key === "Enter") {
                    performSearch();
                }
            });

            // Perform search when the search button is clicked
            $("#search-button").on("click", function () {
                performSearch();
            });

            function performSearch() {
                const value = searchInput.val().trim(); // Trim whitespace from the input
                if (value !== "") {
                    // Redirect to the search results page with the user's input as a query parameter
                    window.location.href = "links_page.php?/=" + encodeURIComponent(value);

                }
            }
        });

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
                    swal.fire(data.title, data.message, data.icon);
                    setTimeout(function () {
                        window.location.reload();
                    }, 2000);
                }
            });

        };
    </script>
</body>


</html>