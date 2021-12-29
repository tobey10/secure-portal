<?php
$statusMsg = '';
//connect to db
include 'dbConfig.php';

session_start();

$errors = array();

$user = $_SESSION['email'];
if (!isset($user)) {
    $_SESSION['msg'] = 'You must log in first to view this page.';

    header("location: /task/login.php");
}

$queryUser = "SELECT * FROM users where email = '$user'";
$resultUser = mysqli_query($conn, $queryUser);
$userDetail = mysqli_fetch_object($resultUser);
$userId = $userDetail->id;


$query_shared = "SELECT 
                    documents.id, 
                    documents.name, 
                    documents.description, 
                    documents.size, 
                    documents.created_at,
                    permission.permission,
                    users.email
                    FROM document_Shared 
                    INNER JOIN documents ON document_shared.document = documents.id
                    INNER JOIN permission ON document_shared.permission = permission.id 
                    INNER JOIN users on documents.user = users.id
                    WHERE document_shared.user ='$userId' ";
$result_shared = mysqli_query($conn, $query_shared);