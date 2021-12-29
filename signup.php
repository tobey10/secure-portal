<?php
include 'sendMail.php';
session_start();
//initialize vairables 
$errors = array();
//connect to conn
include 'dbConfig.php';
//registration user logic
if (isset($_POST['reg_user'])) {
	//Register users
	$lastName = mysqli_real_escape_string($conn, $_POST['lastName']);
	$firstName = mysqli_real_escape_string($conn, $_POST['firstName']);
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	$secretQuestion = mysqli_real_escape_string($conn, $_POST['secretQuestion']);
	$answer = mysqli_real_escape_string($conn, $_POST['answer']);

	//form validation
	if (empty($lastName)) {
		array_push($errors, 'last name is required');
	}
	if (empty($firstName)) {
		array_push($errors, 'first name is required');
	}
	if (empty($password)) {
		array_push($errors, 'password is required');
	}
	if (empty($email)) {
		array_push($errors, 'email is required');
	}
	if (empty($secretQuestion)) {
		array_push($errors, 'secret question is required');
	}
	if (empty($answer)) {
		array_push($errors, 'answer is required');
	}
	$email = strtolower($email);
	$answer = strtolower($answer);

	//check conn for exisitng user with same username
	$user_check_query = "SELECT * FROM users WHERE email='$email'LIMIT 1";
	$results = mysqli_query($conn, $user_check_query);
	$user = mysqli_fetch_assoc($results);
	if ($user) {
		if ($user['email'] === $email) {
			array_push($errors, 'email already has a registered user');
		}
	}
	//register user
	if (count($errors) == 0) {
		$password = md5($password);
		$answer = md5($answer);
		$query = "INSERT INTO users (firstname, lastname, email, password, secretquestion, answer) 
		VALUES ('$firstName', '$lastName', '$email', '$password', '$secretQuestion', '$answer')";
		mysqli_query($conn, $query);
		$query_find = "SELECT * FROM users WHERE email='$email'";
		$result_find = mysqli_query($conn, $query_find);
		$user_create = mysqli_fetch_assoc($result_find);
		$userId = $user_create['id'];
		echo $userId;

		//token setup
		$token = rand(1000, 10000);
		$selectedTime = date('H:i:s');
		$endTime = strtotime("+15 minutes", strtotime($selectedTime));
		$expireAt = date('h:i:s', $endTime);

		$token_query = "INSERT INTO token (token, user, expireAt) VALUES ('$token', '$userId', '$expireAt')";

		mysqli_query($conn, $token_query);

		$subject = 'Account verfication';
		$body = 'Hello '.$email. 'Please verify your account by using this otp' .$token;
		sendMail($email, $subject, $body, $user['email']);

		$_SESSION['email'] = $email;
		$_SESSION['step'] = "verify your account";

		header('location: /task/otp.php');
	}
}


if (isset($_POST['login_user'])) {
	//Register users
	$email = mysqli_real_escape_string($conn, $_POST['email']);
	$password = mysqli_real_escape_string($conn, $_POST['password']);
	//form validation
	if (empty($password)) {
		array_push($errors, 'password is required');
	}
	if (empty($email)) {
		array_push($errors, 'email is required');
	}
	$email = strtolower($email);
	//check conn for exisitng user with same username
	if (count($errors) == 0) {
		$password = md5($password);
		$query = "SELECT * FROM users WHERE email='$email' AND password='$password'";
		$results = mysqli_query($conn, $query);
		$user = mysqli_fetch_assoc($results);
		if (mysqli_num_rows($results) == 1) {
			$token = rand(1000, 10000);
			$selectedTime = date('H:i:s');
			$endTime = strtotime("+15 minutes", strtotime($selectedTime));
			$expireAt = date('h:i:s', $endTime);
			$userId = $user['id'];
			$token_query = "INSERT INTO token (token, user, expireAt) VALUES ('$token', '$userId', '$expireAt')";
			mysqli_query($conn, $token_query);
			$subject = 'Account verfication';
			$body = 'Dear user, Please verify your account by using this otp' .$token;
			sendMail($email, $subject, $body, $user['email']);
			$_SESSION['email'] = $email;
			$_SESSION['step'] = "Passed the first step";

			header('location: /task/verification.php');
		} else {
			array_push($errors, "Wrong email/password combination");
		}
	}
}


if (isset($_POST['verify_user'])) {

	//Register users
	$answer = mysqli_real_escape_string($conn, $_POST['answer']);
	$token = mysqli_real_escape_string($conn, $_POST['token']);

	if (empty($answer)) {
		array_push($errors, 'answer is required');
	}
	if (empty($token)) {
		array_push($errors, 'token is required');
	}

	$answer = strtolower($answer);

	if (count($errors) == 0) {
		$email = $_SESSION['email'];
		$user = "SELECT * FROM users WHERE email='$email'LIMIT 1";
		$results = mysqli_query($conn, $user);
		$user = mysqli_fetch_assoc($results);
		$userId = $user['id'];


		$token_query = "SELECT * FROM token WHERE user='$userId'LIMIT 1";
		$results_token = mysqli_query($conn, $token_query);
		$token_result = mysqli_fetch_assoc($results_token);
		$selectedTime = date('H:i:s');
		if ($token === $token_result['token'] && md5($answer) === $user['answer']) {
			$token_id = $token_result['id'];
			$token_delete = "DELETE FROM token WHERE id='$token_id'";
			$result_delete = mysqli_query($conn, $token_delete);

			$_SESSION['step'] = "Passed the second step";
			header('location: /task/home.php');
		}
	}
}


if (isset($_POST['isVerfied'])) {

	$token = mysqli_real_escape_string($conn, $_POST['otp']);

	if (empty($token)) {
		array_push($errors, 'otp is required');
	}

	if (count($errors) == 0) {
		$email = $_SESSION['email'];
		$user = "SELECT * FROM users WHERE email='$email'LIMIT 1";
		$results = mysqli_query($conn, $user);
		$user = mysqli_fetch_assoc($results);
		$userId = $user['id'];


		$token_query = "SELECT * FROM token WHERE user='$userId'LIMIT 1";
		$results_token = mysqli_query($conn, $token_query);
		$token_result = mysqli_fetch_assoc($results_token);
		$selectedTime = date('H:i:s');
		if ($token === $token_result['token']) {
			$token_id = $token_result['id'];
			$token_delete = "DELETE FROM token WHERE id='$token_id'";
			$result_delete = mysqli_query($conn, $token_delete);

			$user_query = "UPDATE users SET isVerified=1 WHERE email='$email'";
			$user_result = mysqli_query($conn, $user_query);

			$_SESSION['step'] = "Passed the second step";
			header('location: /task/login.php');
		}
	}
}