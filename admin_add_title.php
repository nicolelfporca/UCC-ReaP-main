<?php

include 'includes/config.php';

$pdo = Database::connection();

if(isset($_POST['title'])) {
    
    $title=$_POST['title'];
   

    // Check if course already exists
    $check_course_query = "SELECT * FROM cover_title WHERE cover_title = :cover_title";
    $stmt = $pdo->prepare($check_course_query);
    $stmt->bindParam(':cover_title', $title, PDO::PARAM_STR);
    $stmt->execute();

    // Use rowCount() to check the number of rows returned
    if ($stmt->rowCount() > 0) {
        // Course already exists, so don't insert the new record
        $data = array(
            'status' => 'data_exist',
        );
        echo json_encode($data);
    } else {
        // Course doesn't exist, so insert the new record
        $insert_course_query = "INSERT INTO `cover_title` (`cover_title`)
            VALUES (:cover_title )";


        $stmt = $pdo->prepare($insert_course_query);
        $stmt->bindParam(':cover_title', $title, PDO::PARAM_STR);
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
