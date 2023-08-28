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

    <div class="container">
        <div class="card register-card rounded-0 p-4">
            <label class="text-center pb-2 text-secondary">Register your account</label>
            <form action="">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="campus mb-3">
                            <label>Campus <span class="text-danger">*</span></label>
                            <select class="form-control">
                                <option value="0">Select Campus</option>
                                <option value="1">Main</option>
                                <option value="2">North</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="student-no mb-3">
                            <label>Student No. <span class="text-danger">*</span></label>
                            <input type="number" class="form-control" placeholder="Enter student no.">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="first-name mb-3">
                            <label>First Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter first name">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="second-name mb-3">
                            <label>Second Name <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" placeholder="Enter second name">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="course mb-3">
                            <label>Course <span class="text-danger">*</span></label>
                            <select class="form-control">
                                <option value="0">Select Course</option>
                                <option value="1">BSCS</option>
                                <option value="2">BSIT</option>
                                <option value="3">BSIS</option>
                                <option value="4">BSEMC</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="academic-year mb-3">
                            <label>Academic Year <span class="text-danger">*</span></label>
                            <select class="form-control">
                                <option value="0">Select Academic Year</option>
                                <option value="1">1ST</option>
                                <option value="2">2ND</option>
                                <option value="3">3RD</option>
                                <option value="4">4TH</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="section mb-3">
                            <label>Section <span class="text-danger">*</span></label>
                            <select class="form-control">
                                <option value="0">Select Section</option>
                                <option value="1">A</option>
                                <option value="2">B</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="gender mb-3">
                            <label>Gender <span class="text-danger">*</span></label>
                            <select class="form-control">
                                <option value="0">Select Gender</option>
                                <option value="1">Male</option>
                                <option value="2">Female</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="email mb-3">
                            <label>Email <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" placeholder="Enter email">
                        </div>
                    </div>
                </div>
            </form>
            <div class="register-button mb-3">
                <button class="btn btn-primary w-100">Create Account</button>
            </div>
            <div class="login-link text-center">
                <a href="login.php" class="text-muted">Login here.</a>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>