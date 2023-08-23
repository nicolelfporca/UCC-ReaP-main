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
$search_query = '%'. $search_query . '%';
$status = 1;

$sql= "Select * FROM user WHERE title like :search_query AND status = :status";
$stmt = $pdo -> prepare($sql);

$stmt-> execute(
    [
        ':search_query'=> $search_query,
        ':status'=> $status
    ]
);

?>



<!DOCTYPE html>
<!-- helloworld -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCC REAP</title>
    <link rel="icon" href="dist/image/UCC.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="dist/css/links_page.css">
</head>

<body class="bg-light">

    <header style="background: rgb(53, 144, 53);">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand fw-semibold" href="#">
                    <img src="dist/image/UCC.png" alt="UCC Logo" width="50" height="55" class="me-2">
                    UCC ReaP
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <div class="input-group">
                                <input class="form-control me-1 rounded-5" type="search" placeholder="Search..."
                                    aria-label="Search" id="search">
                                <span class="input-group-append">
                                    <button class="btn bg-none rounded-5 text-white" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <button class="btn text-white me-1" type="submit">Join now</button>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="btn btn-outline-light rounded-5">Sign in</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="mt-4" id="links_page">
        <div class="container">
            <div class="results mb-4">
                <label>4 Results for "Search..."</label>
            </div>



            <?php
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    echo '<div class="card p-3 rounded-0 mb-4">';
    echo '<div class="card p-3 border-0">';
    echo '<a href="show_page.php?name=' . urlencode($row['title']) . '" class="research-title fw-semibold fs-5 mb-2">' . $row['title'] . '</a>';
    echo '<div class=" text-black mb-2">' . $row['abstract'] . '</div>';
    echo '<div class=" fst-italic text-muted">' . $row['date'] . '</div>';
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>
</body>

</html>