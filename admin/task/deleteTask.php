<?php

include('../../includes/connection.php');


$querySelect = "SELECT * FROM task WHERE id = $_GET[id]";
$resultSelect = mysqli_query($connect,$querySelect);
$row = mysqli_fetch_array($resultSelect);
$title = $row['task'];
$details = $row['description'];

$queryDustbin = "INSERT INTO dustbin (title,details,category)
VALUES ('$title','$details','Task')"; 
$resultDustbin = mysqli_query($connect,$queryDustbin);

$query = "DELETE FROM task WHERE id = $_GET[id]";
$result = mysqli_query($connect, $query);


$query = "DELETE FROM comments WHERE taskid = $_GET[id]";
$result = mysqli_query($connect, $query);



if($result){
    header('location:index.php');
}else{

    echo "some problem occurs" ;
    header('location:index.php');
}

?>