<?php
//connect to db
include 'dbConfig.php';

session_start();


if(isset($_GET['id']) && !empty($_GET['id'])){ 

    $selsql = "SELECT location FROM documents where id=". $_GET['id'];
    $result = mysqli_query($conn, $selsql);
    $r = mysqli_fetch_assoc($result);

    if($r['location']){
        $delsql = "DELETE FROM documents WHERE id=" .$_GET['id'];
        if(mysqli_query($conn, $delsql)){
            header('Location: view.php');
        }
    }

}else{ 
    header('Location: view.php');
}