<?php
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
                                        <input type='text' id='authorName' class='form-control authorName' value = '".htmlspecialchars($author->value)."'>
                                        <button class='btn' type='button' onclick='addAuthor()'><i class='fas fa-minus'></i></button>
                                    </div>
                                </div>
                            </div>";
        }
            $response[] ="<div class='row mb-2'>
                    <div class='col-sm-12'>
                        <div class='input-group'>
                            <input type='text' id='authorName' class='form-control authorName' placeholder='Enter author/s'>
                            <button class='btn' type='button' onclick='addAuthor()'><i class='fas fa-plus'></i></button>
                        </div>
                    </div>
                </div>";
    echo json_encode($response);
};


