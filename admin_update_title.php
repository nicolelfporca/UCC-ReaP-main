<?php 
include 'includes/config.php';
$pdo = DATABASE::connection();

$response = array(); // Initialize a response array

if (isset($_POST['id'])) {
    $id = $_POST['id'];
    $sql = "SELECT * FROM `cover_title` WHERE id = :id";
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
} 
elseif (isset($_POST['hiddendata'])) {
    $hiddendata = $_POST['hiddendata'];
    $status = $_POST['status'];
    $update_title = $_POST['update_title'];

    $sql = "UPDATE cover_title SET cover_title = :cover_title ,  status = :status WHERE id = :hiddendata ";
    $stmt = $pdo->prepare($sql);
  
    if ($stmt->execute([
        ':status' => $status,
        ':cover_title' => $update_title,
        ':hiddendata' => $hiddendata
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
} 
else {
    $response = array(
        'status' => 'failed',
        'message' => 'Invalid request'
    );
}

echo json_encode($response);
?>
