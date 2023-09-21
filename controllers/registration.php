<?php
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

function regisToDb($request = null)
{
    $campus = $request->campus;
    $stdno = $request->stdno;
    $fname = $request->fname;
    $mname = $request->mname;
    $lname = $request->lname;
    $acYear = $request->acadYear;
    $course = $request->course;
    $email = $request->email;
    $pass = $request->pass;
    $hashedPassword = sha1($pass);

    $pdo = Database::connection();
    $sql = 'INSERT INTO login (username,password,role) VALUES(:username, :password, :role)';
    $stmt = $pdo->prepare($sql);
    $stmt->execute(
        array(
            ':username' => $stdno,
            ':password' => $hashedPassword,
            ':role' => 1,
        )
    );
    if ($stmt->errorCode() !== '00000') {
        $errorInfo = $stmt->errorInfo();
        $errorMsg = "SQL Error: " . $errorInfo[2];
        // Handle the error as needed (e.g., logging, displaying an error message)
        $msg['title'] = "Error";
        $msg['message'] = $errorMsg;
        $msg['icon'] = "error";
    } else {    
        $sql1 = 'INSERT INTO user_profile (campus,first_name,middle_name,last_name,course_id,ac_year,student_no,email) VALUES(:campus, :fname, :mname, :lname, :course, :acadyear, :stdno, :email)';
        $stmt = $pdo->prepare($sql1);
        $stmt->execute(
            array(
                ':campus' => $campus,
                ':fname' => $fname,
                ':mname' => $mname,
                ':lname' => $lname,
                ':course' => $course,
                ':acadyear' => $acYear,
                ':stdno' => $stdno,
                ':email' => $email
            )
        );
        if ($stmt->errorCode() !== '00000') {
            $errorInfo = $stmt->errorInfo();
            $errorMsg = "SQL Error: " . $errorInfo[2];
            // Handle the error as needed (e.g., logging, displaying an error message)
            $msg['title'] = "Error";
            $msg['message'] = $errorMsg;
            $msg['icon'] = "error";
        } else {
            $msg['title'] = "Successful";
            $msg['message'] = "Success";
            $msg['icon'] = "success";
            $msg['status'] = "success";
        }
    }

    echo json_encode($msg);
};
