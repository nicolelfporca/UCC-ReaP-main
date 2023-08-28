<?php
require("./includes/config.php");
$title = $_GET['name'];

$populateUiShowPage = "SELECT * FROM user WHERE title = :title";
$pdo = Database::connection();
$stmt = $pdo->prepare($populateUiShowPage);
$stmt->bindParam(':title', $title, PDO::PARAM_STR);
$stmt->execute();

if ($stmt === false) {
    $errorInfo = $pdo->errorInfo();
    $errorMsg = "SQL Error: " . $errorInfo[2];
    echo "<script> alert('" . $errorMsg . "')</script>";
} else {
    // Debugging: Output the executed query for verification
    // echo "Executed Query: " . $populateUiShowPage . "<br>";
    $datas = $stmt->fetchAll();
    // // Debugging: Output the number of rows returned by the query
    // echo "Number of Rows Fetched: " . count($datas) . "<br>";
    foreach ($datas as $data) {
        $thesisTitle = $data['title'];
        $thesisDate = $data['date'];
        $thesisAuthor = $data['author'];
        $abstractType = $data['type'];
        $abstract = $data['abstract'];
        $thesisKeyword = $data['keywords'];
    }
    $thesisDate = date("F j, Y", strtotime($thesisDate));
    $newKeywordArray = explode(",", $thesisKeyword);

    foreach ($newKeywordArray as $keyword) {
        $sql[] = "keywords LIKE '%" . $keyword . "%'";
    }
    // note dont foreach when you want to handle multiple data in a query
    $relatedStudiesFetch = "SELECT DISTINCT * FROM user WHERE title != '" . $thesisTitle . "' AND (" . implode(" OR ", $sql) . ") AND status = 1";
    // you can echo for checking for query echo $relatedStudiesFetch;
    $stmt1 = $pdo->prepare($relatedStudiesFetch);
    $stmt1->execute();
    $relatedStudiesUi = $stmt1->fetchAll();
}

function formatInitials($name)
{
    $parts = explode(' ', $name);
    $formattedName = $parts[0] . ' ';
    for ($i = 1; $i < count($parts); $i++) {
        $formattedName .= strtoupper(substr($parts[$i], 0, 1)) . '. ';
    }
    return trim($formattedName);
}


function formatAPAAuthors($authors)
{
    $authorList = explode(',  ', $authors);
    $numAuthors = count($authorList);
    if ($numAuthors === 1) {
        return ($authorList[0]);
    } elseif ($numAuthors === 2) {
        $formattedAuthors = array_map('formatInitials', $authorList);
        return implode(' & ', $formattedAuthors);
    } elseif ($numAuthors <= 6) {
        $lastAuthor = array_pop($authorList);
        $formattedAuthors = implode(', ', array_map('formatInitials', $authorList)) . ', & ' . formatInitials($lastAuthor);
        return $formattedAuthors;
    } else {
        $firstSixAuthors = array_slice($authorList, 0, 6);
        $formattedAuthors = implode(', ', array_map('formatInitials', $firstSixAuthors)) . ' et al.';
        return $formattedAuthors;
    }

}

function generateAPAWebsiteCitation($authors, $year, $title, $url)
{
    $formattedAuthors = formatAPAAuthors($authors);
    $citation = "$formattedAuthors ($year). $title. Retrieved from $url";
    return $citation;
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
            <a class="navbar-brand" href="search_engine.php">
                <img src="dist/image/UCC.png" alt="UCC Logo" width="50" class="mr-2">
                <span class="full">UCC ReaP</span>
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item d-flex">
                        <div class="input-group search-input">
                            <input class="form-control mr-1 rounded-0" type="search" placeholder="Search"
                                aria-label="Search" id="search">
                            <span class="input-group-append">
                                <button class="btn search-btn text-white" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                    </li>
                </ul>
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <img src="dist/image/unknown.jpg" alt="User Profile" width="50" class="user-profile">
                        </a>
                        <div class="dropdown-menu text-center" aria-labelledby="navbarDropdown">
                            <div class="for-user" hidden>
                                <a class="dropdown-item" href="upload_form.php">Upload</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="settings_personal_info.php">Profile</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item text-danger" href="#">Logout</a>
                            </div>
                            <div class="join-sign-in">
                                <a class="dropdown-item" href="register.php">Join now</a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal"
                                    data-target="#exampleModalCenter">Sign up</a>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- sign in modal -->
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-body p-5">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <div class="logo text-center mb-4">
                        <img src="dist/image/UCC.png" alt="" width="100">
                    </div>
                    <form>
                        <div class="email mb-3">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Email" aria-label="Email"
                                    aria-describedby="enevelope">
                                <span class="input-group-text" id="envelope"><i class="far fa-envelope"></i></span>
                            </div>
                        </div>
                        <div class="password mb-3">
                            <div class="input-group">
                                <input type="password" class="form-control" placeholder="Password" aria-label="Password"
                                    aria-describedby="lock">
                                <span class="input-group-text" id="lock"><i class="fa-solid fa-lock"></i></span>
                            </div>
                        </div>
                    </form>
                    <div class="forgot-password mb-3">
                        <a href="" class="text-muted">Forgot Password?</a>
                    </div>
                    <div class="login-button mb-3">
                        <button class="btn btn-primary w-100">Login</button>
                    </div>
                    <div class="register-link text-center">
                        <a href="register.php" class="text-muted">Register here.</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="mt-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="title">
                        <label class="research-title">
                            <?php echo $thesisTitle ?>
                        </label>
                    </div>
                    <div class="date">
                        <label class="font-italic text-muted">
                            <?php echo $thesisDate ?>
                        </label>
                    </div>
                    <div class="researchers">
                        <ul class="list-inline text-muted">
                            <li class="list-inline-item">
                                <?php echo '&bull; ' . $thesisAuthor ?>
                            </li>
                        </ul>
                    </div>

                    <div class="card p-4 rounded-0 mb-4">
                        <div class="abstract-title">
                            <label class="h3 mb-3">ABSTRACT</label>
                        </div>
                        <div class="abstract-body">
                            <?php if ($abstractType == 1) { ?>
                                <label>
                                    <?php echo $abstract ?>
                                </label>
                            <?php } elseif ($abstractType == 2) { ?>
                                <img src="<?php echo "webimg/" . $abstract ?>" alt="Image" width="100">
                            <?php } ?>
                        </div>
                    </div>

                    <div class="citation text-muted">
                        <label>Citation:</label>
                        <ul class="list-inline">
                            <li class="list-inline-item" id="authors">
                                <?php
                                if (strpos($thesisAuthor, ',  ') === false) {
                                    $authorsForCitation = formatInitials($thesisAuthor);
                                } else {
                                    $authorsForCitation = formatAPAAuthors($thesisAuthor);
                                }

                                $publicationYear = date("Y", strtotime($thesisDate));
                                $abstractTitle = $thesisTitle;
                                $websiteURL = "https://www.your-website.com/abstract-page"; // Update this URL
                                
                                // Count authors and format according to APA style
                                
                                $websiteCitation = generateAPAWebsiteCitation($authorsForCitation, $publicationYear, $abstractTitle, $websiteURL);

                                echo "<p class='apa-citation'>$websiteCitation</p>";
                                ?>
                            </li>
                        </ul>
                    </div>
                </div>

                <hr class="container text-muted">

                <div class="col-sm-4 mt-2">
                    <div class="related-studies">
                        <label class="h3 mb-3">RELATED STUDIES</label>
                    </div>
                    <?php foreach ($relatedStudiesUi as $relatedStudy) { ?>
                        <div class="card related-studies-card p-3 rounded-0 mb-4">
                            <a href=<?php echo "show_page.php?name=" . urldecode($relatedStudy['title']) ?>
                                class="related-studies-title">
                                <?php echo $relatedStudy['title'] ?>
                            </a>
                            <a href=<?php echo "show_page.php?name=" . urldecode($relatedStudy['title']) ?>
                                class="related-studies-date font-italic text-muted">
                                <?php echo date("F j, Y", strtotime($relatedStudy['date'])); ?>
                            </a>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <footer class="bg-white text-center text-muted border">
        <div class="text-center p-3">
            <strong>Copyright &copy; 2023-2024. <a href="https://www.ucc-caloocan.edu.ph/"
                    class="link text-muted">University of Caloocan City</a>.
            </strong> All rights reserved.
        </div>
    </footer>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
</body>

</html>