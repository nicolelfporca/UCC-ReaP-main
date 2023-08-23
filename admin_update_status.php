<?php 
include 'includes/config.php';
$pdo = DATABASE::connection();

$response = array(); // Initialize a response array

if (isset($_POST['update'])) {
    $id = $_POST['update'];
    $sql = "SELECT * FROM `user` WHERE id = :id";
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

    $sql = "UPDATE user SET status = :status WHERE id = :hiddendata ";
    $stmt = $pdo->prepare($sql);
  
    if ($stmt->execute([
        ':status' => $status,
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
} else {
    $response = array(
        'status' => 'failed',
        'message' => 'Invalid request'
    );
}

echo json_encode($response);
?>
