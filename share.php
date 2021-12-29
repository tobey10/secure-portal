<?php include('file.php') ?>
<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles2.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css">
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
        <p>Share your document with a user</p>
        <form method="post">
        <?php include('error.php') ?> 

            <div class="mb-9">
                <label for="document">Document</label>
                <select name="document" id="document">
                    <option value="">Select on document</option>
                    <?php while ($r = mysqli_fetch_assoc($resultDocuments)) { ?>
                        <option value="<?php echo $r['id'] ?>"><?php echo $r['name'] ?></option>
                    <?php } ?>
                </select>
            </div>
            
            <div class="mb-9">
                <label for="user">User</label>
                <select name="user" id="user">
                    <option value="">Select a user</option>
                    <?php while ($a = mysqli_fetch_assoc($resultUsers)) { ?>
                        <option value="<?php echo $a['id'] ?>"><?php echo $a['email'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <div>
                <label for="permission">Permission</label>
                <select name="permission" id="permission">
                    <option value="">Select a permission</option>
                    <?php while ($b = mysqli_fetch_assoc($resultPermissions)) { ?>
                        <option value="<?php echo $b['id'] ?>"><?php echo $b['permission'] ?></option>
                    <?php } ?>
                </select>
            </div>

            <button type="submit" name="save" class="button">save</button>
        </form>
    </div>
</body>

</html>