<?php include('file.php') ?>
<?php include('logout.php') ?>
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
                    <button type="submit" name="logout" class="logout-button" hre>logout</button>
                </ul>
            </div>
        </div>
    </div>
    <div class="container" style="margin-top: 58px;">
        <p>Document details</p>
        <p>Name: <?php echo $r['name'] ?></p>
        <p>Size: <?php echo $r['size'] ?></p>
        <p>Type: <?php echo $r['type'] ?></p>
        <p>Decription: <?php echo $r['description'] ?></p>
        <p>Shared:</p>
        <?php while($shared = mysqli_fetch_assoc($result_shared))  {?>
            <div>
                <p>Name: <?php echo $shared['lastname']?> <?php echo $shared['firstname']?></p>
                <p>Email: <?php echo $shared['email']?></p>
            </div>
        <?php }?>
    </div>
</body>

</html>