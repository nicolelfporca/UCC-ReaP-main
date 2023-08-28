<?php
session_start();
require('./includes/config.php');

if (!isset($_SESSION['stdno'])) {
    header('Location: search_engine.php');
    exit;
}

$populateUiDropDown = "SELECT * FROM course";
$pdo = Database::connection();
$stmt = $pdo->prepare($populateUiDropDown);
$stmt->execute();
if ($stmt === false) {
    $errorInfo = $pdo->errorInfo();
    $errorMsg = "SQL Error: " . $errorInfo[2];
    echo "<script> alert('" . $errorMsg . "')</script>";
}
$datas = $stmt->fetchAll();

$course = $_SESSION['course'];

$courseQuery = "SELECT user_profile.*, course.*
FROM user_profile
JOIN course ON user_profile.course_id = course.course_id
WHERE user_profile.course_id = $course  AND course.course_id = $course";
$stmt1 = $pdo->prepare($courseQuery);
$stmt1->execute();
if ($stmt1 === false) {
    $errorInfo = $pdo->errorInfo();
    $errorMsg = "SQL Error: " . $errorInfo[2];
    echo "<script> alert('" . $errorMsg . "')</script>";
}
$datas1 = $stmt1->fetchAll();

foreach($datas1 as $data1){
    $courseId = $data1['course_id'];
    $courseName = $data1['course_name'];
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
    <!-- wag alisin -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="dist/css/all.css">
</head>

<body class="bg-light">

    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="search_engine.php">
                <img src="dist/image/UCC.png" alt="UCC Logo" width="50" class="mr-2">
                <span class="full">UCC Research and Publication Online</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link ml-2" href="upload_form.php">Upload</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-2 active" href="settings_personal_info.php">Profile</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link ml-2" href="logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container card-container">
        <label class="h3 font-weight-normal mb-4 text-muted">Profile Settings</label>
        <div class="row">
            <div class="col-sm-4 left-column">
                <div class="card rounded-0 p-4">
                    <div class="profile-picture text-center">
                        <img src="dist/image/unknown.jpg" alt="Profile Picture" width="150" class="user-profile">
                    </div>
                    <div class="user-name mb-2 text-center">
                        <label class="h4 font-weight-normal"><?php echo $_SESSION['fname']. ' ' .$_SESSION['lname'] ?></label>
                    </div>
                    <div class="upload-photo text-center">
                        <label class="btn btn-secondary">
                            <input type="file" name="abstractPic" hidden>
                            Upload Photo
                        </label>
                    </div>
                    <hr>
                    <div class="student-no mb-3">
                        <label class="font-weight-bold m-0">Student No.</label> <br>
                        <label class="m-0"><?php echo $_SESSION['stdno'] ?></label>
                    </div>
                    <div class="course mb-3">
                        <label class="font-weight-bold m-0">Course</label> <br>
                        <label class="m-0"><?php echo $courseName ?></label>
                    </div>
                </div>
            </div>
            <div class="col-sm-8">
                <div class="card rounded-0">
                    <div class="card-header">
                        <ul class="nav nav-tabs card-header-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" href="settings_personal_info.php">Personal Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="settings_passwords.php">Passwords</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="campus mb-2">
                                    <label>Campus <span class="text-danger">*</span></label>
                                    <select class="form-control rounded-0" id="campus">
                                        <?php if ($_SESSION['campus'] == 1) { ?>
                                            <option value="1">Main</option>
                                        <?php } else { ?>
                                            <option value="2">North</option>
                                        <?php } ?>
                                        <option value="1">Main</option>
                                        <option value="2">North</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="student-no2 mb-2">
                                    <label>Student No. <span class="text-danger">*</span></label>
                                    <input type="text" id="stdno" class="form-control rounded-0" value="<?php echo $_SESSION['stdno'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="first-name mb-2">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" id="fname" class="form-control rounded-0" value="<?php echo $_SESSION['fname'] ?>">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="last-name mb-2">
                                    <label>Last Name <span class="text-danger">*</span></label>
                                    <input type="text" id="lname" class="form-control rounded-0" value="<?php echo $_SESSION['lname'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="course mb-2">
                                    <label>Course <span class="text-danger">*</span></label>
                                    <select id="course" class="form-control rounded-0">
                                        <option value="<?php echo $courseId?>"><?php echo $courseName ?></option>
                                        <?php foreach ($datas as $data) { ?>
                                            <option value="<?php echo $data['course_id'] ?>"><?php echo $data['course_name'] ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="academic-year mb-2">
                                    <label>Academic Year <span class="text-danger">*</span></label>
                                    <input class="form-control" type="text" id="date" value="<?php echo $_SESSION['ac_year'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="email mb-3">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="email" id="email" class="form-control rounded-0" value="<?php echo  $_SESSION['email'] ?>">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="save-btn d-flex float-right">
                                    <button class="btn btn-primary" onclick="updateUser()">Save Changes</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <!-- wag alisin -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>


    <script>
        $(function() {
            $("#date").datepicker({
                dateFormat: 'yy'
            });
        });

        function updateUser() {
            var campus = $('#campus').val();
            var stdno = $('#stdno').val();
            var fname = $('#fname').val();
            var lname = $('#lname').val();
            var course = $('#course').val();
            var date = $('#date').val();
            var email = $('#email').val();

            // Construct payload object
            var payload = {
                campus: campus,
                stdno: stdno,
                fname: fname,
                lname: lname,
                course: course,
                date: date,
                email:email
            };

            // Create a new FormData object
            var formData = new FormData();

            // Append payload data as JSON
            formData.append('payload', JSON.stringify(payload));
            formData.append('setFunction', 'updateUserProfile');

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