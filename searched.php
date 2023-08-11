<?php
include 'config.php';

// Check connection
if (mysqli_connect_errno()) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Get the search query from the form submission
if (isset($_POST['query'])) {
    $search_query = $_POST['query'];
} else {
    die("No search query provided.");
}

// Prepare the query to fetch matching data from the database
$search_query = mysqli_real_escape_string($conn, $search_query);
$sql = "SELECT * FROM abstract WHERE title LIKE '%$search_query%'";

// Execute the query
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Search Results</title>
</head>
<body>
    <h2>Search Results:</h2>
    <?php
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<a href="template.php?name=' . urlencode($row['title']) . '">' . $row['title'] . '</a><br>';
    }
    ?>
</body>
</html>
