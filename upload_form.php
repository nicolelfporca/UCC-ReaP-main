<?php
session_start();

if (!isset($_SESSION['stdno'])) {
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCC REAP</title>
    <link rel="icon" href="dist/image/UCC.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/font.css">
    <link rel="stylesheet" href="dist/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <img src="dist/image/UCC.png" alt="UCC Logo" width="50" class="mr-2">
                <span class="full">UCC Research and Publication Online</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link ml-2 active" href="upload_form.php">Upload</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-2" href="settings_personal_info.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-2" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container card-container">
        <label class="h3 font-weight-normal mb-4 text-muted">Upload Form</label>
        <div class="row">
            <div class="card w-100 p-4">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="publish-date mb-2">
                            <label>Publish Date <span class="text-danger">*</span></label>
                            <input type="date" name="thesisDate" class="form-control">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="category mb-2">
                            <label>Cover Title <span class="text-danger">*</span></label>
                            <select class="form-control" id="coverVal">
                                <option value="" readonly>Select Cover Title</option>
                                <?php
                                include 'includes/config.php';
                                $pdo = DATABASE::connection();
                                // Fetch data from the covers table
                                $sql = "SELECT * from cover_title WHERE status = 1";
                                $result = $conn->query($sql);

                                // Build the dropdown options
                                while ($row = $result->fetch_assoc()) {
                                    echo '<option value="' . $row['id'] . '">' . $row['cover_title'] . '</option>';
                                }

                                // Close the database connection
                                $conn->close();
                                ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="title mb-2">
                    <label>Title <span class="text-danger">*</span></label>
                    <input type="text" name="titleName" class="form-control" placeholder="Enter title">
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="authors">
                            <label>Author(s) <span class="text-danger">*</span></label>
                            <div id="uiAuthors">
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="text" id="authorName" class="form-control authorName"
                                                placeholder="Enter name (surname, first name)"
                                                onkeydown="handleAuthorInput(event)">
                                            <button class="btn add-btn" type="button" onclick="addAuthor()">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="keywords">
                            <label>Keyword(s) <span class="text-danger">*</span></label>
                            <div id="uiKeywords">
                                <div class="row mb-2">
                                    <div class="col-sm-12">
                                        <div class="input-group">
                                            <input type="text" class="form-control keywords" placeholder="Enter keyword"
                                                onkeydown="handleKeywordInput(event)">
                                            <button class="btn add-btn" type="button" onclick="addKeyword()">
                                                <i class="fa-solid fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="abstract mb-2">
                    <label>Abstract <span class="text-danger">*</span></label>
                    <select class="form-control" id="selectUI" onchange="showUI()">
                        <option value="0">Select Abstract</option>
                        <option value="1">Plain Text</option>
                        <option value="2">Upload Photo</option>
                    </select>
                </div>
                <div class="plain-text mb-1" id="plainAbsUi">
                    <textarea rows="8" name="abstractText" class="form-control"></textarea>
                </div>
                <div class="upload-photo mb-1" id="PicAbsUi">
                    <label class="btn btn-secondary">
                        <input type="file" name="abstractPic" hidden>Upload Photo
                    </label>
                </div>
                <div class="submit-button">
                    <button type="button" onclick="uploadAbstract()"
                        class="btn btn-primary d-flex float-right">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(document).ready(function () {
            $('#plainAbsUi').hide();
            $('#PicAbsUi').hide();

            $(document).on("click", ".minus-button-author", function () {
                var key = $(this).data("key");
                removeAuthorDiv(this, key);
            });
            $(document).on("click", ".minus-button-keyword", function () {
                var key = $(this).data("keyword");
                removeAuthorDiv(this, key);
            });

            function handleAuthorInput(event) {
                if (event.key === "Enter") {
                    addAuthor();
                }
            }

            function handleKeywordInput(event) {
                if (event.key === "Enter") {
                    addKeyword();
                }
            }
        });

        function addAuthor() {
            let allVal = [];
            $(".authorName").each(function () {
                let val = $(this).val(); // Trim to remove leading/trailing spaces
                if (val !== "") {
                    allVal.push({
                        value: val
                    });
                }
            });

            if (allVal.length === 0) {
                allVal.push({
                    value: ""
                });
            }

            let payload = {
                authors: JSON.stringify(allVal)
            }

            // console.log(payload)

            $.ajax({
                type: "POST",
                url: 'controllers/Authors.php',
                data: {
                    payload: JSON.stringify(payload),
                    setFunction: 'addAuthors'
                },
                success: function (response) {
                    response = JSON.parse(response);
                    // alert(response); // Display a success message
                    $('#uiAuthors').html(response);
                }
            });
        };

        function addKeyword() {
            let allData = [];

            $(".keywords").each(function () {
                let val = $(this).val(); // Trim to remove leading/trailing spaces
                if (val !== "") {
                    allData.push({
                        val: val
                    });
                }
            });


            if (allData.length === 0) {
                allData.push({
                    val: ""
                });
            }

            let payload = {
                keywordsValue: JSON.stringify(allData)
            };

            // console.log(payload)

            $.ajax({
                type: "POST",
                url: 'controllers/Authors.php',
                data: {
                    payload: JSON.stringify(payload),
                    setFunction: 'addKeywords'
                },
                success: function (response) {
                    response = JSON.parse(response);
                    $('#uiKeywords').html(response);
                }
            });
        };

        function removeAuthorDiv(button, key) {
            if (key === '') {
                var divToRemove = $(button).closest(".row.mb-2");
                divToRemove.remove();
            } else {
                var divToRemove = $(button).closest(".row.mb-2");
                divToRemove.remove();
            }
        };

        function showUI() {
            let num = $('#selectUI').val();
            if (num == 1) {
                $('#plainAbsUi').show();
                $('#PicAbsUi').hide();
            } else if (num == 2) {
                $('#PicAbsUi').show();
                $('#plainAbsUi').hide();
            } else {
                $('#PicAbsUi').hide();
                $('#plainAbsUi').hide();
            }
        };


        //working ajax jquery upload image with array of object and XMLHttpRequest
        function uploadAbstract() {
            var titleName = $("input[name='titleName']").val();
            var thesisDate = $("input[name='thesisDate']").val();
            var abstractText = $("#plainAbsUi textarea[name='abstractText']").val();
            var coverVal = $("#coverVal").val();
            var num = $('#selectUI').val();
            var authors = [];
            $(".authorName").each(function () {
                var authorValue = $(this).val().trim();
                if (authorValue !== "") {
                    authors.push({
                        value: authorValue
                    });
                }
            });
            var keywordsValue = [];
            $(".keywords").each(function () {
                var keywordValue = $(this).val().trim();
                if (keywordValue !== "") {
                    keywordsValue.push({
                        val: keywordValue
                    });
                }
            });

            // Construct payload object
            var payload = {
                titleName: titleName,
                thesisDate: thesisDate,
                abstractText: abstractText,
                authors: authors, 
                keywordsValue: keywordsValue, 
                type: num, 
                coverVal: coverVal
            };

            // Create a new FormData object
            var formData = new FormData();

            // Append payload data as JSON
            formData.append('payload', JSON.stringify(payload));
            formData.append('setFunction', 'uploadToDb');

            // Get the selected file (input element)
            var abstractPicInput = $("input[name='abstractPic']")[0]; // Assuming it's the first input element
            var abstractPicFile = abstractPicInput.files[0];

            // Append file to FormData object
            formData.append('abstractPic', abstractPicFile);

            // Create a new XMLHttpRequest
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "controllers/Authors.php", true);

            xhr.onreadystatechange = function () {
                if (xhr.readyState === 4) {
                    console.log("Server response:", xhr.responseText);
                    if (xhr.status === 200) {
                        // Handle success response
                        var data = JSON.parse(xhr.responseText);
                        console.log("Data received:", data);
                        swal.fire(data.title, data.message, data.icon);
                        setTimeout(function () {
                            window.location.reload();
                        }, 2000);
                    } else {
                        // Handle error
                        console.log("Error:", xhr.statusText);
                    }
                }
            };

            // Send the FormData object
            xhr.send(formData);
        };
    </script>
</body>

</html>