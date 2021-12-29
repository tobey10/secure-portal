<?php
session_start();

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = 'You must log in first to view this page.';

    header("location: /login.php");
}

if (isset($_SESSION['logout'])) {
    session_destroy();
    echo $_SESSION['email'];
	header('location: /task/login.php');
}
?>

<!DOCTYPE html>
<html>

<head>
    <title>Home Page</title>
</head>

<body>
    <h1>this is the homepage</h1>
    <?php if (isset($_SESSION['success'])) : ?>
        <div>
            <?php
            echo $_SESSION['success'];
            unset($_SESSION['success']);
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['email'])) : ?>
        <h3>welcome <?php echo $_SESSION['email']; ?></h3>
        <button  type="submit" name="logout" style="color: red;">logout</button>
    <?php endif; ?>
</body>

</html>