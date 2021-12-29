<?php include('signup.php') ?>
<?php

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = 'You must log in first to view this page.';

    header("location: /login.php");
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP</title>
    <link rel="stylesheet" type="text/css" href="styles.css?v=<?php echo time(); ?>">
</head>
<body>
    <form method="post">
        <h2>User verfication</h2>
        <?php include('error.php') ?> 

        <label>otp</label>
        <input type="text" name="otp" placeholder="11111"><br>

        <div class="button-container">
            <button type="submit" name="isVerfied">verify</button>
        </div>
        <p>
            <span><a>resend otp</a></span>
        </p>
    </form>
</body>
</html>