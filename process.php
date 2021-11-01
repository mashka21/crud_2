<?php

session_start();


$mysqli = new mysqli('localhost','root','','tijaabo') or die(mysqli_error($mysqli));

$id = 0;
$update = false;
$name ='';
$location='';

if(isset($_POST['save'])){
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("INSERT  INTO formdata (name,location) VALUES('$name','$location')") or 
    die($mysqli->error);

    $_SESSION['message'] = "Record has been saved.";
    $_SESSION['msg_type'] = "success";

    header("location: index.php");

}

if(isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM formdata WHERE id=$id") or die(mysqli_error($mysqli));

    $_SESSION['message'] = "Record has been deleted.";
    $_SESSION['msg_type'] = "danger";

    header("location: index.php");
}


if(isset($_GET['edit'])) {
    $id = $_GET['edit'];
    $update = true;
    $result = $mysqli->query("SELECT * FROM formdata WHERE id=$id") or die(mysqli_error($mysqli));

    if (count(array($result))==1) {
        $row = $result->fetch_array();
        $name = $row['name'];
        $location =$row['location'];
        
    }

}


if(isset($_POST['update'])) {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $location = $_POST['location'];

    $mysqli->query("UPDATE formdata SET name = '$name', location = '$location'  where id = $id")
        or die($mysqli->error);

        $_SESSION['message'] = "Record has been updated.";
        $_SESSION['msg_type'] = "warning";
    
        header("location: index.php");

}


?>