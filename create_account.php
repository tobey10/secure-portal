<?php include('signup.php') ?>
<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">`
    <title>Create Account</title>
    <link rel="stylesheet" type="text/css" href="styles.css?v=<?php echo time(); ?>">
</head>
<body>
    <form method="post" action="create_account.php">
        <h2>Create Account</h2>
        <?php include('error.php') ?>
        <div class="row">
            <div class="col">
                <label for="firstName">first name</label>
                <input type="text" name="firstName" placeholder="first name" required>
            </div>
            <div class="col">
                <label for="lastName">last name</label>
                <input type="text" name="lastName" placeholder="last name" required>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <label for="email">email</label>
                <input type="email" name="email" placeholder="email" required>
            </div>
            <div class="col">
                <label for="password">password</label>
                <input type="password" name="password" placeholder="Password" required>
            </div>
        </div>
        <label>Secret Question</label>
        <select name="secretQuestion" id="secretQuestion">
            <option value="">pick one question</option>
            <option value="What is your mother's maiden name?">What is your mother's maiden name?</option>
            <option value="What was your first pet?">What was your first pet?</option>
            <option value="What was the model of your first car?">What was the model of your first car?</option>
            <option value="In what city were you born?">In what city were you born?</option>
            <option value="What was your father's middle name?">What was your father's middle name?</option>
            <option value="What was your childhood nickname?">What was your childhood nickname?</option>
        </select>
        <label>Answer</label>
        <input type="text" name="answer" placeholder="answer" required>
        <div class="button-container"><button type="submit" name="reg_user">create account</button></div>
        <p><a href="./login">Already have an account? Log In</a></p>
    </form>
</body>
</html>