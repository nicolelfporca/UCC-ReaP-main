<?php 
include 'includes/config.php';
$pdo = DATABASE::connection();

$response = array(); 

if (isset($_POST['update'])) {
    $id = $_POST['update'];
    $sql = "SELECT * FROM `login` WHERE log_id = :id";
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
    $username=$_POST['username'];
    $password=$_POST['password'];
    $encryptpass=sha1($password);


    $sql = "UPDATE login SET username = :user, password = :encrypt WHERE log_id = :hiddendata ";
    $stmt = $pdo->prepare($sql);
  
    if ($stmt->execute([
        ':user' => $username,
        ':hiddendata' => $hiddendata,
        ':encrypt'=> $encryptpass
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
