<?php

include 'includes/config.php';

$pdo = Database::connection();

if(isset($_POST['username'])  && isset($_POST['password'])) {
    
    $username=$_POST['username'];
    $password=$_POST['password'];
    $encryptpass=sha1($password);

    // Check if course already exists
    $check_course_query = "SELECT * FROM login WHERE username = :username";
    $stmt = $pdo->prepare($check_course_query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->execute();

    // Use rowCount() to check the number of rows returned
    if ($stmt->rowCount() > 0) {
        // Course already exists, so don't insert the new record
        $data = array(
            'status' => 'data_exist',
        );
        echo json_encode($data);
    } else {
        $status = 2;
        // Course doesn't exist, so insert the new record
        $insert_course_query = "INSERT INTO `login` (`username`,`password`,`role`)
            VALUES (:username,:password,:r)";
        $stmt = $pdo->prepare($insert_course_query);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);
        $stmt->bindParam(':password', $encryptpass, PDO::PARAM_STR);
        $stmt->bindParam(':r', $status , PDO::PARAM_INT);
        $insert_course_result = $stmt->execute(); // Store the result of the execution

        if ($insert_course_result) {
            $data = array(
                'status' => 'success',
            );
            echo json_encode($data);
        } else {
            $data = array(
                'status' => 'failed',
            );
            echo json_encode($data);
        }
    }
}

?>
