<?php 
session_start();
require_once("../includes/config.php");

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['payload'])) {
    $receivedData = json_decode($_POST['payload']);
    $receivedFunction = $_POST['setFunction'];

    if (function_exists($receivedFunction)) {
        $result = $receivedFunction($receivedData);
        echo $result;
    } else {
        echo "Invalid function name.";
    }
}

function checkUserDb($request = null){
    $username = $request->username;
    $pass = $request->pass;
    $hashedPassword = sha1($pass);
    $msg = array();
    $loginQuery = "SELECT login.*, user_profile.*
    FROM login
    JOIN user_profile ON login.username = :username AND user_profile.student_no = :username
    WHERE login.username = :username AND login.password = :pass";
    $pdo = Database::connection();
    $stmt = $pdo->prepare($loginQuery);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $hashedPassword, PDO::PARAM_STR);
    $stmt->execute();
    $datas  = $stmt -> fetchAll();
    $numRows = $stmt->rowCount();

    if($numRows == 0){
        $msg['title'] = "Waning";
        $msg['message'] = "There's no such user";
        $msg['icon'] = "info";
       
        echo json_encode($msg);
    }else{
        foreach($datas as $data){
           $role = $data['role'];
           $_SESSION['campus'] = $data['campus'];
           $_SESSION['fname'] = $data['first_name'];
           $_SESSION['mname'] = $data['middle_name'];
           $_SESSION['lname'] = $data['last_name'];
           $_SESSION['course'] = $data['course_id'];
           $_SESSION['email'] = $data['email'];
           $_SESSION['stdno'] = $data['student_no'];
        }
        

        $msg['title'] = "Successful";
        $msg['message'] = "Welcome";
        $msg['icon'] = "success";
        $msg['role'] = $role;

        echo json_encode($msg);
    }

}


?>