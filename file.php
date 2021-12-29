<?php
$statusMsg = '';
//connect to db
include 'dbConfig.php';
include 'sendMail.php';

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

$queryReturnDocuments = "SELECT * FROM documents where user = '$userId'";
$resultDocuments = mysqli_query($conn, $queryReturnDocuments);

$queryPermissions = "SELECT * FROM permission";
$resultPermissions = mysqli_query($conn, $queryPermissions);

$queryUsers = "SELECT * FROM users";
$resultUsers = mysqli_query($conn, $queryUsers);


//upload the document
if (isset($_POST['upload_doc'])) {
    //allow certain file formats to be uploaded
    $allowTypes = array('jpg', 'png', 'jpeg', 'pdf', 'doc', 'docx', '.xls');
    $location = "uploads/";

    $name = $_FILES['file']['name'];
    $size = $_FILES['file']['size'];
    $type = $_FILES['file']['type'];
    $tmp_name = $_FILES['file']['tmp_name'];
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    if (empty($description)) {
        array_push($errors, "description is required");
    }
    if (empty($name)) {
        array_push($errors, "Please select a file to upload.");
    }
    $date = date(DATE_W3C);
    $target_file = $location . basename($name);

    if (move_uploaded_file($_FILES['file']['tmp_name'], $location)){
        $query = "INSERT INTO documents (name, size, type, location, user, description, created_at) VALUES ('$name', '$size' , '$type', '$location', '$userId', '$description', '$date')";
        echo $query;
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            $statusMsg = "the file " . $name . "has been uploaded succesfully.";
            header('location: /task/view.php');
        } else {
            array_push($errors, "File upload failed, please try again.");
        }
    }else{
        array_push($errors, "File upload failed");
    }
}

//share a document
if (isset($_POST['save'])) {
    $document = mysqli_real_escape_string($conn, $_POST['document']);
    $user = mysqli_real_escape_string($conn, $_POST['user']);
    $permission = mysqli_real_escape_string($conn, $_POST['permission']);

    if (empty($user)) {
        array_push($errors, 'user is required');
    }
    if (empty($document)) {
        array_push($errors, 'document is required');
    }
    if (empty($permission)) {
        array_push($errors, 'permission is required');
    }

    //preventing sharing the same documents twice to the same user
    $document_shared_query = "SELECT * FROM document_shared WHERE document='$document' AND user='$user'";
    $result_document_shared = mysqli_query($conn, $document_shared_query);
    $document_shared = mysqli_fetch_assoc($result_document_shared);
    echo $document_shared_query;

    if ($document_shared) {
        array_push($errors, 'this documents has been shared with this user already');
    }

    //checking for the amout of users the document has been shared too
    $document_query = "SELECT * FROM documents WHERE id='$document' LIMIT 1";
    $result_document = mysqli_query($conn, $document_query);
    $document_get = mysqli_fetch_assoc($result_document);

    if ($document_get['shared'] == 5) {
        array_push($errors, 'this document has been shared to 5 users already');
    }

    //fetch users details
    $user_fetch_query = "SELECT * FROM users WHERE id='$user' LIMIT 1";
    $result_user_query = mysqli_query($conn, $user_fetch_query);
    $user_result = mysqli_fetch_assoc($result_user_query);

    $user_email = $user_result['email'];

    if (count($errors) == 0) {
        $query_shared = "INSERT INTO document_shared (user, document, permission) VALUES ('$user','$document','$permission')";
        mysqli_query($conn, $query_shared);


        $query_document = "SELECT * FROM documents WHERE id='$document'LIMIT 1";
        $result_query = mysqli_query($conn, $query_document);
        $result_document = mysqli_fetch_assoc($result_query);

        $shared_total = $result_document['shared'];
        $updated_value = ($shared_total + 1);
        echo $updated_value;

        $update_document = "UPDATE documents SET shared = $updated_value WHERE id='$document'";
        $update_result = mysqli_query($conn, $update_document);

        //send email notification
        $subject = "File Shared";
        $body = 'A document has been shared to by ' .$_SESSION['email']. ' and document: ' .$document_get['name'];
        sendMail($user_email, $subject, $body, $user_email);

    }
}

//get a document by id
if (isset($_GET['id']) && !empty($_GET['id'])) {

    $selsql = "SELECT * FROM documents where id=" . $_GET['id'];
    $result = mysqli_query($conn, $selsql);
    $r = mysqli_fetch_assoc($result);

    $document_Id = $r['id'];
    $shared_query = "SELECT users.firstname, users.lastname, users.email FROM document_shared INNER JOIN users ON users.id = document_shared.user where document= '$document_Id'";
    $result_shared = mysqli_query($conn, $shared_query);
}
