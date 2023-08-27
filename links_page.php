<?php
include './includes/config.php';

$pdo = Database::connection();

// Get the search query from the form submission
if (isset($_POST['query'])) {
    $search_query = $_POST['query'];
} else {
    die("No search query provided.");
}

// Prepare the query to fetch matching data from the database
$search_query = '%' . $search_query . '%';
$status = 1;

$sql = "Select * FROM user WHERE title like :search_query AND status = :status";
$stmt = $pdo->prepare($sql);

$stmt->execute(
    [
        ':search_query' => $search_query,
        ':status' => $status
    ]
);
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
    <link rel="stylesheet" href="dist/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="search_engine.php">
                <img src="dist/image/UCC.png" alt="UCC Logo" width="50" class="mr-2">
                <span class="full">UCC ReaP</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item d-flex">
                        <div class="input-group search-input">
                            <input class="form-control mr-1 rounded-0" type="search" placeholder="Search"
                                aria-label="Search" id="search">
                            <span class="input-group-append">
                                <button class="btn search-btn text-white" type="button">
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
                            <img src="dist/image/unknown.jpg" alt="User Profile" width="50" class="user-profile">
                        </a>
                        <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
                            <div class="for-user">
                                <a class="dropdown-item" href="upload_form.php">Upload</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="settings_personal_info.php">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="#">Logout</a>
                            </div>
                            <div class="join-sign-in" hidden>
                                <a class="dropdown-item" href="register.php">Join now</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#">Sign up</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="mt-4" id="links_page">
        <div class="container">
            <?php
            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                echo '<div class="card p-4 rounded-0 mb-4">';
                echo '<a href="show_page.php?name=' . urlencode($row['title']) . '" class="research-title mb-2">' . $row['title'] . '</a>';
                echo '<div class="text-black mb-2">' . $row['abstract'] . ' <a class="text-muted" href="">See more.</a></div>';
                echo '<div class="font-italic text-muted">' . $row['date'] . '</div>';
                echo '</div>';
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

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>