<?php include('signup.php') ?>
<?php

if (!isset($_SESSION['email'])) {
    $_SESSION['msg'] = 'You must log in first to view this page.';

    header("location: /login.php");
}

//connection
$host = "localhost";
$username = "root";
$dbpassword = "root";

$db_name = "secure-portal";
$conn = mysqli_connect($host, $username, $dbpassword, $db_name);

if ($conn->connect_error) {
	die("connection failed " . $conn->connect_error);
}

$email = $_SESSION['email'];
$user_check_query = "SELECT * FROM users WHERE email='$email'LIMIT 1";
$results = mysqli_query($conn, $user_check_query);
$user = mysqli_fetch_assoc($results);

?>


<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">`
    <title>Verification</title>
    <link rel="stylesheet" type="text/css" href="styles.css?v=<?php echo time(); ?>">
</head>

<body>
    <form method="post">
        <h2>Verify Account</h2>
        <?php include('error.php') ?>

        <label>Secret Question</label>
        <input type="text" name="secretquestion" placeholder="secretquestion" value="<?php echo (isset($user['secretquestion']))? $user['secretquestion']:'' ;?>" readonly>

        <label>Answer</label>
        <input type="text" name="answer" placeholder="answer">

        <label for="token">token</label>
        <input type="token" name="token" placeholder="token">

        <div class="button-container">
            <button type="submit" name="verify_user">verify</button>
        </div>
    </form>
</body>

</html>