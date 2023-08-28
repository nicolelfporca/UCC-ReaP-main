<?php 
 session_start();
 session_unset(); // Unset all session variables
 session_destroy(); // Destroy the session
 header('Location: search_engine.php'); // Redirect to the login page
 exit;
?>