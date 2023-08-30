<?php
session_start();
require_once("../includes/config.php");
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);


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




function addAuthors($request = null)
{
    $authors = json_decode($request->authors); // Decode the JSON array
    foreach ($authors as $author) {
        $response[] = "<div class='row mb-2'>
                                <div class='col-sm-12'>
                                    <div class='input-group'>
                                        <input type='text' id='authorName' name='authorName' class='form-control authorName' value = '" . htmlspecialchars($author->value) . "' placeholder='Enter name (surname, first name)'>
                                        <button class='btn minus-btn' type='button' data-key='" . htmlspecialchars($author->value) . "'><i class='fas fa-minus'></i></button>
                                    </div>
                                </div>
                            </div>";
    }
    $response[] = "<div class='row mb-2'>
                    <div class='col-sm-12'>
                        <div class='input-group'>
                            <input type='text' id='authorName' class='form-control authorName' placeholder='Enter name (surname, first name)'>
                            <button class='btn add-btn' type='button' onclick='addAuthor()'><i class='fas fa-plus'></i></button>
                        </div>
                    </div>
                </div>";
    echo json_encode($response);
};



function addKeywords($request = null)
{
    $keywordsValue = json_decode($request->keywordsValue);
    foreach ($keywordsValue as $keyword) {
        $response[] = " <div class='row mb-2'>
                <div class='col-sm-12'>
                    <div class='input-group'>
                        <input type='text' class='form-control keywords' name='keywordData' value = '" . htmlspecialchars($keyword->val) . "' placeholder='Enter keyword'>
                        <button class='btn minus-btn' type='button' data-keyword='" . htmlspecialchars($keyword->val) . "'><i class='fas fa-minus'></i></button>
                    </div>
                </div>
            </div>";
    }
    $response[] = "<div class='row mb-2'>
        <div class='col-sm-12'>
            <div class='input-group'>
                <input type='text' class='form-control keywords' placeholder='Enter keyword'>
                <button class='btn add-btn' type='button' onclick='addKeyword()'><i class='fas fa-plus'></i></button>
            </div>
        </div>
    </div>
    ";
    echo json_encode($response);
};

function uploadToDb($request = null)
{
    $msg = array();
    $userName =  $_SESSION['fname'].' '. $_SESSION['mname'].' '. $_SESSION['lname']; 

    $title = $request->titleName;
    $thesisDate = $request->thesisDate;
    $abstractText = $request->abstractText;
    $type = $request->type;

    $authors = $request->authors;
    $commaSeparatedArray = [];

    foreach ($authors as $author) {
        $authorValue = $author->value;
        if (is_array($authorValue)) {
            $commaSeparated = implode(', ', $authorValue);
        } else {
            $commaSeparated = $authorValue;
        }
        $commaSeparatedArray[] = $commaSeparated;
    }
    $commaSeparatedStringAuthor = implode(',  ', $commaSeparatedArray);

    $keywords = $request->keywordsValue;
    $keywordSeperatedArray = array();

    foreach ($keywords as $keyword) {
        $keywordVal = $keyword->val;
        if (is_array($keywordVal)) {
            $commaSeparatedKeyword = implode(',', $keywordVal);
        } else {
            $commaSeparatedKeyword = $keywordVal;
        }
        $keywordSeperatedArray[] = $commaSeparatedKeyword;
    }
    $commaSeparatedStringKeyword = implode(',', $keywordSeperatedArray);

    // return json_encode([$commaSeparatedStringKeyword]); this is for checking 



    // Handle uploaded image
    if (!empty($_FILES['abstractPic']['name'])) {
        $filename = $_FILES['abstractPic']['name'];
        $size = $_FILES['abstractPic']['size'];
        $tmp_name = $_FILES['abstractPic']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            $targetDirectory = '../webimg/';
            $targetPath = $targetDirectory . $newImageName;

            if (move_uploaded_file($tmp_name, $targetPath)) {
                // Image uploaded successfully
                // ... Your existing database insertion logic ...
                $pdo = Database::connection();
                $sql = 'INSERT INTO user (title,author,date,keywords,abstract,uploaded_by,type) VALUES(:title, :author, :date, :keywords, :abstract, :userid, :type)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(
                    array(
                        ':title' => $title,
                        ':author' => $commaSeparatedStringAuthor,
                        ':date' => $thesisDate,
                        ':keywords' => $commaSeparatedStringKeyword,
                        ':abstract' => $newImageName,
                        ':userid' => $userName,
                        ':type' => $type
                    )
                );
                $datas  = $stmt->fetchAll();
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
                // echo json_encode($targetPath); // this should be inserted in the database
            } else {
                // Failed to upload image
                $msg['title'] = "Error";
                $msg['message'] = "Failed to move uploaded image to destination";
                $msg['icon'] = "error";
                $msg['status'] = "error";
                $msg['debug'] = $_FILES; // Add this for debugging
            }
        }
    } else {
        if ($abstractText != "") {
            $abstractText = addcslashes($abstractText, '\'\\');
            // code for abstract text here
            $pdo = Database::connection();
            $sql = 'INSERT INTO user (title,author,date,keywords,abstract,uploaded_by,type) VALUES(:title, :author, :date, :keywords, :abstract, :userid, :type)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':title' => $title,
                    ':author' => $commaSeparatedStringAuthor,
                    ':date' => $thesisDate,
                    ':keywords' => $commaSeparatedStringKeyword,
                    ':abstract' => $abstractText,
                    ':userid' => $userName,
                    ':type' => $type
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
        } else {
            $msg['title'] = "Warning";
            $msg['message'] = "Error Please Reload The Page";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
        }
    }

    // Print the error message if status is "error"
    if ($msg['status'] === 'error') {
        echo json_encode($msg);
        return;
    }


    echo json_encode($msg);
};

function updateUserProfile($request = null)
{
    $msg = array();
    $campus = $request->campus;
    $stdno = $request->stdno;
    $fname = $request->fname;
    $lname = $request->lname;
    $course = $request->course;
    $date = $request->date;
    $email = $request->email;
    $id = $_SESSION['id'];
    $log_id = $_SESSION['log_id'];




    // Handle uploaded image
    if (!empty($_FILES['abstractPic']['name'])) {
        $filename = $_FILES['abstractPic']['name'];
        $size = $_FILES['abstractPic']['size'];
        $tmp_name = $_FILES['abstractPic']['tmp_name'];

        $validImageExtensions = ['jpg', 'jpeg', 'png'];
        $imageExtension = pathinfo($filename, PATHINFO_EXTENSION);
        $imageExtension = strtolower($imageExtension);

        if (!in_array($imageExtension, $validImageExtensions)) {
            $msg['title'] = "Warning";
            $msg['message'] = "Invalid image extension";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
        } elseif ($size > 512000) {
            $msg['title'] = "Warning";
            $msg['message'] = "Image size is too large";
            $msg['icon'] = "warning";
            $msg['status'] = "error";
        } else {
            $newImageName = uniqid() . '.' . $imageExtension;
            $targetDirectory = '../webimg/';
            $targetPath = $targetDirectory . $newImageName;

            if (move_uploaded_file($tmp_name, $targetPath)) {
                // Image uploaded successfully
                // ... Your existing database insertion logic ...
                $updateUserQuery = "UPDATE user_profile SET campus = :campus, first_name = :fname, last_name = :lname, course_id = :course, ac_year = :date, student_no = :stdno, email = :email, photo = :photo WHERE prof_id = :id ";
                $pdo = Database::connection();
                $stmt = $pdo->prepare($updateUserQuery);
                // $stmt->execute();
                // if ($stmt === false) {
                //     $errorInfo = $pdo->errorInfo();
                //     $errorMsg = "SQL Error: " . $errorInfo[2];
                //     echo "<script> alert('" . $errorMsg . "')</script>";
                // }
                $stmt->execute(
                    array(
                        ':campus' => $campus,
                        ':fname' => $fname,
                        ':lname' => $lname,
                        ':course' => $course,
                        ':date' => $date,
                        ':stdno' => $stdno,
                        ':email' => $email,
                        ':photo' => $newImageName,
                        ':id' => $id
                    )
                );
                // Update session variables
                $_SESSION['campus'] = $campus;
                $_SESSION['stdno'] = $stdno;
                $_SESSION['fname'] = $fname;
                $_SESSION['lname'] = $lname;
                $_SESSION['course'] = $course;
                $_SESSION['ac_year'] = $date;
                $_SESSION['email'] = $email;
                $_SESSION['photo'] = $newImageName;

                // Regenerate the session ID for improved security
                session_regenerate_id();
                if ($stmt->errorCode() !== '00000') {
                    $errorInfo = $stmt->errorInfo();
                    $errorMsg = "SQL Error: " . $errorInfo[2];
                    // Handle the error as needed (e.g., logging, displaying an error message)
                    $msg['title'] = "Error";
                    $msg['message'] = $errorMsg;
                    $msg['icon'] = "error";
                } else {
                    $updateUserQuery1 = "UPDATE login SET username = :username WHERE log_id = :id";
                    $pdo = Database::connection();
                    $stmt = $pdo->prepare($updateUserQuery1);
                    // $stmt->execute();
                    // if ($stmt === false) {
                    //     $errorInfo = $pdo->errorInfo();
                    //     $errorMsg = "SQL Error: " . $errorInfo[2];
                    //     echo "<script> alert('" . $errorMsg . "')</script>";
                    // }
                    $stmt->execute(
                        array(
                            ':username' => $stdno,
                            ':id' => $log_id
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
                // echo json_encode($targetPath); // this should be inserted in the database
            } else {
                // Failed to upload image
                $msg['title'] = "Error";
                $msg['message'] = "Failed to move uploaded image to destination";
                $msg['icon'] = "error";
                $msg['status'] = "error";
                $msg['debug'] = $_FILES; // Add this for debugging
            }
        }
    } else {
        $updateUserQuery = "UPDATE user_profile SET campus = :campus, first_name = :fname, last_name = :lname, course_id = :course, ac_year = :date, student_no = :stdno, email = :email WHERE prof_id = :id";
        $pdo = Database::connection();
        $stmt = $pdo->prepare($updateUserQuery);
        // $stmt->execute();
        // if ($stmt === false) {
        //     $errorInfo = $pdo->errorInfo();
        //     $errorMsg = "SQL Error: " . $errorInfo[2];
        //     echo "<script> alert('" . $errorMsg . "')</script>";
        // }
        $stmt->execute(
            array(
                ':campus' => $campus,
                ':fname' => $fname,
                ':lname' => $lname,
                ':course' => $course,
                ':date' => $date,
                ':stdno' => $stdno,
                ':email' => $email,
                ':id' => $id
            )

        );
        // Update session variables
        $_SESSION['campus'] = $campus;
        $_SESSION['stdno'] = $stdno;
        $_SESSION['fname'] = $fname;
        $_SESSION['lname'] = $lname;
        $_SESSION['course'] = $course;
        $_SESSION['ac_year'] = $date;
        $_SESSION['email'] = $email;

        // Regenerate the session ID for improved security
        session_regenerate_id();
        if ($stmt->errorCode() !== '00000') {
            $errorInfo = $stmt->errorInfo();
            $errorMsg = "SQL Error: " . $errorInfo[2];
            // Handle the error as needed (e.g., logging, displaying an error message)
            $msg['title'] = "Error";
            $msg['message'] = $errorMsg;
            $msg['icon'] = "error";
        } else {
            $updateUserQuery1 = "UPDATE login SET username = :username WHERE log_id = :id";
            $pdo = Database::connection();
            $stmt = $pdo->prepare($updateUserQuery1);
            // $stmt->execute();
            // if ($stmt === false) {
            //     $errorInfo = $pdo->errorInfo();
            //     $errorMsg = "SQL Error: " . $errorInfo[2];
            //     echo "<script> alert('" . $errorMsg . "')</script>";
            // }
            $stmt->execute(
                array(
                    ':username' => $stdno,
                    ':id' => $log_id
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
    }

    // Print the error message if status is "error"
    if ($msg['status'] === 'error') {
        echo json_encode($msg);
        return;
    }


    echo json_encode($msg);
};

function updatePass($request = null)
{
    $oldPass = $request->oldPass;
    $newPass = $request->newPass;
    $hashedOldPass = sha1($oldPass);
    $hashedNewPass = sha1($newPass);
    $userId = $_SESSION['log_id'];

    $validateOldPass = "SELECT *
    FROM login
    WHERE log_id = :id AND password = :pass";
    $pdo = Database::connection();
    $stmt = $pdo->prepare($validateOldPass);
    $stmt->bindParam(':id', $userId, PDO::PARAM_STR);
    $stmt->bindParam(':pass', $hashedOldPass, PDO::PARAM_STR);
    $stmt->execute();
    $numRows = $stmt->rowCount();

    if ($numRows == 0) {
        $msg['title'] = "Waning";
        $msg['message'] = "Please Enter The Correct Old Password";
        $msg['icon'] = "warning";
        echo json_encode($msg);
    } else {
        $updatePassQuery = "UPDATE login SET password = :newpass WHERE log_id = :log_id";
        $pdo = Database::connection();
        $stmt = $pdo->prepare($updatePassQuery);
        // $stmt->execute();
        // if ($stmt === false) {
        //     $errorInfo = $pdo->errorInfo();
        //     $errorMsg = "SQL Error: " . $errorInfo[2];
        //     echo "<script> alert('" . $errorMsg . "')</script>";
        // }
        $stmt->execute(
            array(
                ':newpass' => $hashedNewPass,
                ':log_id' => $userId
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
        echo json_encode($msg);
    }
};

function deleteUser($request = null)
{
    $id = $request->id;
    $delteUser = "DELETE FROM login WHERE log_id = :id";
    $pdo = Database::connection();
    $stmt = $pdo->prepare($delteUser);
    // $stmt->execute();
    // if ($stmt === false) {
    //     $errorInfo = $pdo->errorInfo();
    //     $errorMsg = "SQL Error: " . $errorInfo[2];
    //     echo "<script> alert('" . $errorMsg . "')</script>";
    // }
    $stmt->execute(
        array(
            ':id' => $id
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
        $profid = $_SESSION['id'];
        $delteUser1 = "DELETE FROM user_profile WHERE prof_id = :id";
        $pdo = Database::connection();
        $stmt = $pdo->prepare($delteUser1);
        // $stmt->execute();
        // if ($stmt === false) {
        //     $errorInfo = $pdo->errorInfo();
        //     $errorMsg = "SQL Error: " . $errorInfo[2];
        //     echo "<script> alert('" . $errorMsg . "')</script>";
        // }
        $stmt->execute(
            array(
                ':id' => $profid
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
    session_unset(); // Unset all session variables
    session_destroy(); // Destroy the session
    echo json_encode($msg);
};
