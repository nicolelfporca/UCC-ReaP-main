<?php

include 'config.php';
// template.php
if (isset($_GET['name'])) {
    $name = $_GET['name'];
 

    // Check connection
    if (mysqli_connect_errno()) {
        die("Database connection failed: " . mysqli_connect_error());
    }

    // Prepare the query to fetch all data where the title is equal to $name
    $name = mysqli_real_escape_string($conn, $name);
    $sql = "SELECT * FROM abstract WHERE title = '$name'";

    // Execute the query
    $result = mysqli_query($conn, $sql);

    // Display the fetched data
    while ($row = mysqli_fetch_assoc($result)) {
        // Display data here (customize this based on your database structure)
        echo '<p>' . $row['title'] . '</p>';
        echo '<p>' . $row['author'] . '</p>';
    }
} else {
    echo "No item name provided.";
}
?>
