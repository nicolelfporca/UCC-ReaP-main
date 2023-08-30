<?php
session_start();
require('./includes/config.php');

if (!isset($_SESSION['stdno'])) {
    header('Location: search_engine.php');
    exit;
}
$course = $_SESSION['course'];

$courseQuery = "SELECT user_profile.*, course.*
FROM user_profile
JOIN course ON user_profile.course_id = course.course_id
WHERE user_profile.course_id = $course  AND course.course_id = $course";
$pdo = Database::connection();
$stmt1 = $pdo->prepare($courseQuery);
$stmt1->execute();
if ($stmt1 === false) {
    $errorInfo = $pdo->errorInfo();
    $errorMsg = "SQL Error: " . $errorInfo[2];
    echo "<script> alert('" . $errorMsg . "')</script>";
}
$datas1 = $stmt1->fetchAll();

foreach ($datas1 as $data1) {
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
                        <?php if ($_SESSION['photo'] == "") { ?>
                            <img src="dist/image/unknown.jpg" alt="Profile Picture" width="150" class="user-profile">
                        <?php } else { ?>
                            <img src="<?php echo "webimg/" . $_SESSION['photo']  ?>" alt="Profile Picture" width="150" class="user-profile">
                        <?php } ?>
                    </div>
                    <div class="user-name mb-2 text-center">
                        <label class="h4 font-weight-normal"><?php echo $_SESSION['fname'] . ' ' . $_SESSION['lname'] ?></label>
                    </div>
                    <!-- <div class="upload-photo text-center">
                        <label class="btn btn-secondary">
                            <input type="file" name="abstractPic" hidden>
                            Upload Photo
                        </label>
                    </div> -->
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
                                <a class="nav-link" href="settings_personal_info.php">Personal Information</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link active" href="settings_passwords.php">Passwords</a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="current-password mb-2">
                                    <label>Current Password <span class="text-danger">*</span></label>
                                    <input type="password" id="pass" class="form-control rounded-0" placeholder="Enter current password">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="new-password mb-2">
                                    <label>New Password <span class="text-danger">*</span></label>
                                    <input type="password" id="new_pass" class="form-control rounded-0" placeholder="Enter new password">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="confirm-password mb-3">
                                    <label>Confirm Password <span class="text-danger">*</span></label>
                                    <input type="password" id="con_pass" class="form-control rounded-0" placeholder="Enter confirm password">
                                </div>
                            </div>
                        </div>

                        <div class="row d-flex float-right">
                            <div class="col-sm-12">
                                <div class="buttons">
                                    <button class="btn btn-danger" onclick="deleteUser()">Delete Account</button>
                                    <button class="btn btn-primary" onclick="updatePass()">Save Changes</button>
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function updatePass() {
            var oldPass = $('#pass').val();
            var newPass = $('#new_pass').val();
            var conPass = $('#con_pass').val();

            if (newPass == conPass) {
                var payload = {
                    oldPass: oldPass,
                    newPass: newPass
                };
                $.ajax({
                    type: "POST",
                    url: 'controllers/Authors.php',
                    data: {
                        payload: JSON.stringify(payload),
                        setFunction: 'updatePass'
                    },
                    success: function(response) {
                        data = JSON.parse(response);
                        swal.fire(data.title, data.message, data.icon);
                        window.location.reload();
                    }
                });
            } else {
                Swal.fire(
                    'WARNING',
                    "Old password and New password didn't match",
                    'warning'
                )
            }
        };

        function deleteUser() {
            var id = <?php echo $_SESSION['log_id'] ?>;
            var payload = {
                id: id,
            };

            $.ajax({
                type: "POST",
                url: 'controllers/Authors.php',
                data: {
                    payload: JSON.stringify(payload),
                    setFunction: 'deleteUser'
                },
                success: function(response) {
                    data = JSON.parse(response);
                    swal.fire(data.title, data.message, data.icon);
                    setTimeout(function() {
                        window.location.href = "search_engine.php"
                    }, 2000);
                }
            });
        };
    </script>
</body>

</html>