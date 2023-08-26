<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UCC REAP</title>
    <link rel="icon" href="dist/image/UCC.png">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="dist/css/search_engine.css">
</head>

<body>

    <div class="dropdown d-flex justify-content-end mt-2">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown"
            aria-haspopup="true" aria-expanded="false">
            <img src="dist/image/unknown.jpg" alt="User Profile" width="50" class="user-profile">
        </button>
        <div class="dropdown-menu border-0 rounded-0 text-center" aria-labelledby="dropdownMenuButton">
            <a class="dropdown-item" href="settings_personal_info.php">Profile</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item" href="upload_form.php">Upload Form</a>
            <div class="dropdown-divider"></div>
            <a class="dropdown-item text-danger" href="#">Logout</a>
        </div>
    </div>

    <div class="s006">
        <form action="links_page.php" method="POST">
            <fieldset>
                <div class="ucc-logo mb-3">
                    <img src="dist/image/UCC.png" alt="UCC Logo" width="160" class="rounded mx-auto d-block">
                </div>
                <div class="reap text-center text-white mb-4 h1">
                    <b>UCC Research and Publication Online</b>
                </div>
                <div class="inner-form">
                    <div class="input-field">
                        <button class="btn-search" type="submit" value="Search">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                                <path
                                    d="M15.5 14h-.79l-.28-.27C15.41 12.59 16 11.11 16 9.5 16 5.91 13.09 3 9.5 3S3 5.91 3 9.5 5.91 16 9.5 16c1.61 0 3.09-.59 4.23-1.57l.27.28v.79l5 4.99L20.49 19l-4.99-5zm-6 0C7.01 14 5 11.99 5 9.5S7.01 5 9.5 5 14 7.01 14 9.5 11.99 14 9.5 14z">
                                </path>
                            </svg>
                        </button>
                        <input id="search" type="text" name="query" placeholder="Search" required>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js"></script>
    <script src="dist/js/script.js"></script>
    <script src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag() { dataLayer.push(arguments); }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script
        src="https://static.cloudflareinsights.com/beacon.min.js/v8b253dfea2ab4077af8c6f58422dfbfd1689876627854"></script>
</body>

</html>

<script>
</script>
</head>