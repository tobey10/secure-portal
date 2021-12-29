<?php include('signup.php') ?>
<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="styles.css?v=<?php echo time(); ?>">
</head>

<body>
    <form method="post">
        <h2>LOGIN</h2>
        <?php include('error.php') ?> 

        <label>email</label>
        <input type="email" name="email" placeholder="email"><br>

        <label>password</label>
        <input type="password" name="password" placeholder="Password"><br>

        <div class="button-container">
            <button type="submit" name="login_user">login</button>
        </div>
        <p>
            <span><a href="./create_account">create account</a></span>
        </p>
    </form>
</body>

</html>