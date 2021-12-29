<?php include('file.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles2.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
 
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
</head>

<body>
    <div class="navigation">
        <div class="navigation-logo">
            <p class="navigation-logo-body">Secure Portal</p>
        </div>
        <div class="nav">
            <div class="nav">
                <ul class="nav-list">
                    <li class="nav-items">
                        <a href="./home.php">home</a>
                    </li>
                    <li class="nav-items">
                        <a href="./view.php">uploaded documents</a>
                    </li>
                    <li class="nav-items">
                        <a href="./share.php">share</a>
                    </li>
                    <li class="nav-items">
                        <a href="./shared_document.php">shared documents</a>
                    </li>
                    <li class="nav-items">
                        <p style="margin:0;text-transform: lowercase;">Hello, <?php echo $_SESSION['email']?></p>
                    </li>
                    <a  class="logout-button" href="logout.php">
                        logout
                    </a>
                </ul>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 58px; width: 47%;">
        <div>
            <p>Upload a new document</p>
            <?php include('error.php') ?> 
            <form method="post" enctype="multipart/form-data">
                <div class="mb-9">
                    <label>Select document to upload:</label>
                    <input type="file" name="file" id="file">
                </div>

                <div>
                    <label>Description</label>
                    <input type="text" name="description" id="description" >
                </div>

                <button type="submit" name="upload_doc" class="button">Upload Document</button>
            </form>
        </div>
    </div>
</body>

</html>