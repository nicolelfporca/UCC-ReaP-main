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
    }
    $thesisDate = date("F j, Y", strtotime($thesisDate));
}

function formatInitials($name) {
    $parts = explode(' ', $name);
    $formattedName = $parts[0] . ' ';
    for ($i = 1; $i < count($parts); $i++) {
        $formattedName .= strtoupper(substr($parts[$i], 0, 1)) . '. ';
    }
    return trim($formattedName);
}


function formatAPAAuthors($authors) {
    $authorList = explode(',  ', $authors);
    $numAuthors = count($authorList);
    if ($numAuthors === 1 ) {
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

function generateAPAWebsiteCitation($authors, $year, $title, $url) {
    $formattedAuthors = formatAPAAuthors($authors);
    $citation = "$formattedAuthors ($year). $title. Retrieved from $url";
    return $citation;
}


?>
<!DOCTYPE html>
<!-- hello world -->
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCC REAP</title>
    <link rel="icon" href="dist/image/UCC.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/all.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="dist/css/links_page.css">
</head>

<body class="bg-light">

    <header style="background: rgb(53, 144, 53);">
        <nav class="navbar navbar-expand-lg navbar-dark">
            <div class="container">
                <a class="navbar-brand fw-semibold" href="#">
                    <img src="dist/image/UCC.png" alt="UCC Logo" width="50" height="55" class="me-2">
                    UCC ReaP
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-center" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <div class="input-group">
                                <input class="form-control me-1 rounded-5" type="search" placeholder="Search..."
                                    aria-label="Search" id="search">
                                <span class="input-group-append">
                                    <button class="btn bg-none rounded-5 text-white" type="button">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </span>
                            </div>
                        </li>
                    </ul>
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <button class="btn text-white me-1" type="submit">Join now</button>
                        </li>
                        <li class="nav-item">
                            <a href="#" class="btn btn-outline-light rounded-5">Sign in</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>

    <div class="mt-4 mb-4">
        <div class="container">
            <div class="row">
                <div class="col-sm-8">
                    <div class="title"> 
                        <label class="fw-semibold h2"><?php echo $thesisTitle ?></label>
                    </div>
                    <div class="date">
                        <label class="fst-italic"><?php echo $thesisDate ?></label>
                    </div>
                    <div class="researchers mb-4">
                        <ul class="list-inline">
                            <li class="list-inline-item">&bull; <?php echo $thesisAuthor ?> </li>
                        </ul>
                    </div>
                    <div class="card p-4 rounded-0 mb-4">
                        <div class="abstract-text">
                            <label class="fw-semibold fs-5 mb-3">ABSTRACT</label>
                        </div>
                        <div class="abstract-body">
                            <?php if($abstractType == 1){ ?>
                            <label>
                            <?php echo $abstract ?>
                            </label>
                            <?php }elseif($abstractType == 2){ ?>
                                <img src="<?php echo "webimg/".$abstract ?>" alt="Image" style="max-width: 100%; height: auto;">
                            <?php } ?>
                        </div>
                    </div>
                  
                    <div class="citation text-muted">
    <label>Citation:</label> <br>
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

                <div class="col-sm-4">
                    <div class="related-studies">
                        <label class="text-muted fs-4 mb-3">RELATED STUDIES</label>
                    </div>
                    <div class="card p-1 rounded-0 mb-4">
                        <div class="card p-3 border-0">
                            <a href="#" class="research-title fw-semibold fs-5">
                                UNIVERSITY OF CALOOCAN CITY TITLE RESEARCH
                            </a>
                            <a href="#" class="date fst-italic text-muted">
                                August 19, 2002
                            </a>
                        </div>
                    </div>
                   
                  
                   
               
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>