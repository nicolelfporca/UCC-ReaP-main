<?php 
include 'includes/config.php';
$pdo = DATABASE::connection();

$response = array(); 

if (isset($_POST['update'])) {
    $id = $_POST['update'];
    $sql = "SELECT * FROM `course` WHERE course_id = :id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':id', $id, PDO::PARAM_INT);
    
    if ($stmt->execute()) {
        $userData = $stmt->fetch(PDO::FETCH_ASSOC);
        if ($userData) {
            $response = $userData;
        } else {
            $response = array(
                'status' => 'failed',
                'message' => 'Data not found'
            );
        }
    } else {
        $response = array(
            'status' => 'failed',
            'error' => $stmt->errorInfo()
        );
    }
} elseif (isset($_POST['hiddendata'])) {
    $hiddendata = $_POST['hiddendata'];
    $status = $_POST['status'];
    $course =$_POST['course'];

    $sql = "UPDATE course SET course_name = UPPER(:courses), status = :status WHERE course_id = :hiddendata ";
    $stmt = $pdo->prepare($sql);
  
    if ($stmt->execute([
        ':status' => $status,
        ':hiddendata' => $hiddendata,
        ':courses'=> $course
    ])) {
        $response = array(
            'status' => 'success'
        );
    } else {
        $response = array(
            'status' => 'failed',
            'error' => $stmt->errorInfo()
        );
    }
} else {
    $response = array(
        'status' => 'failed',
        'message' => 'Invalid request'
    );
}

echo json_encode($response);
?>
