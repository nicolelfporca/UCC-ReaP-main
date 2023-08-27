<?php
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
;



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
}
;



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
}
;

function uploadToDb($request = null)
{
    $msg = array();

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
                $sql = 'INSERT INTO user (title,author,date,keywords,abstract,type) VALUES(:title, :author, :date, :keywords, :abstract, :type)';
                $stmt = $pdo->prepare($sql);
                $stmt->execute(
                    array(
                        ':title' => $title,
                        ':author' => $commaSeparatedStringAuthor,
                        ':date' => $thesisDate,
                        ':keywords' => $commaSeparatedStringKeyword,
                        ':abstract' => $newImageName,
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
            $sql = 'INSERT INTO user (title,author,date,keywords,abstract,type) VALUES(:title, :author, :date, :keywords, :abstract, :type)';
            $stmt = $pdo->prepare($sql);
            $stmt->execute(
                array(
                    ':title' => $title,
                    ':author' => $commaSeparatedStringAuthor,
                    ':date' => $thesisDate,
                    ':keywords' => $commaSeparatedStringKeyword,
                    ':abstract' => $abstractText,
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
}
;