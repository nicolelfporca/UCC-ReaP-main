<?php
require('./includes/config.php');
$status= "1";
$populateUiDropDown = "SELECT * FROM course WHERE status = :status";
$pdo = Database::connection();
$stmt = $pdo->prepare($populateUiDropDown);

$stmt->bindValue(':status', $status, PDO::PARAM_STR);
$stmt->execute();
if ($stmt === false) {
    $errorInfo = $pdo->errorInfo();
    $errorMsg = "SQL Error: " . $errorInfo[2];
    echo "<script> alert('" . $errorMsg . "')</script>";
}
$datas = $stmt->fetchAll();



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

    <div class="container">
        <div class="card register-card rounded-0 p-4">
            <label class="text-center pb-2 text-secondary">Register your account</label>
            <form action="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="campus mb-3">
                            <label>Campus <span class="text-danger">*</span></label>
                            <select id="campus" class="form-control">
                                <option value="0">Select Campus</option>
                                <option value="1">Main</option>
                                <option value="2">North</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="student-no mb-3">
                            <label>Student No. <span class="text-danger">*</span></label>
                            <input type="text" id="student_no" class="form-control" placeholder="Enter student no.">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="academic-year mb-3">
                            <label>Academic Year <span class="text-danger">*</span></label>
                            <input class="form-control" type="text" id="date" placeholder="Enter academic year">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="first-name mb-3">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" id="f_name" class="form-control" placeholder="Enter first name">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="second-name mb-3">
                            <label>Middle Name <span class="text-danger">*</span></label>
                            <input type="text" id="m_name" class="form-control" placeholder="Enter second name">
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="first-name mb-3">
                            <label>Last Name <span class="text-danger">*</span></label>
                            <input type="text" id="l_name" class="form-control" placeholder="Enter last name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="course mb-3">
                            <label>Course <span class="text-danger">*</span></label>
                            <select id="course" class="form-control">
                                <?php foreach ($datas as $data) {
                                    echo $data['course_id'];
                                ?>
                                    <option value="<?php echo $data['course_id'] ?>"><?php echo $data['course_name'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="email mb-3">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" id="email" class="form-control" placeholder="Enter email">
                        </div>
                    </div>
                    <div class="col-sm-12">
                        <div class="email mb-3">
                            <label>Password <span class="text-danger">*</span></label>
                            <input type="password" id="pass" class="form-control" placeholder="Enter password">
                        </div>
                    </div>
                </div>
            </form>
            <div class="register-button mb-3">
                <button class="btn btn-primary w-100" onclick="regis()">Create Account</button>
            </div>
            <div class="login-link text-center">
                <a href="login.php" class="text-muted">Login here.</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <!-- wag alisin -->
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script> 
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        $(function() {
            $("#date").datepicker({
                dateFormat: 'yy'
            });
        });

        function regis() {
            let campus = $("#campus").val();
            let stdno = $("#student_no").val();
            let fname = $("#f_name").val();
            let mname = $("#m_name").val();
            let lname = $("#l_name").val();
            let acadYear = $("#date").val();
            let course = $("#course").val();
            let email = $("#email").val();
            let pass = $("#pass").val();
            // console.log(campus,stdno,fname,mname,lname,acadYear,course,email,pass)

            var payload = {
                campus: campus,
                stdno: stdno,
                fname: fname,
                mname: mname,
                lname: lname,
                acadYear: acadYear,
                course: course,
                email: email,
                pass: pass
            };

            $.ajax({
                type: "POST",
                url: 'controllers/registration.php',
                data: {
                    payload: JSON.stringify(payload),
                    setFunction: 'regisToDb'
                },
                success: function(response) {
                    data = JSON.parse(response);
                    swal.fire(data.title, data.message, data.icon);
                    setTimeout(function() {
                        window.location.reload();
                    }, 2000);
                }
            });
        };
    </script>
</body>

</html>