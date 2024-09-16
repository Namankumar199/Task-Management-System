<?php

include('../../includes/connection.php');

$querySelect = "SELECT * FROM project WHERE id = $_GET[id]";
$resultSelect = mysqli_query($connect,$querySelect);
$row = mysqli_fetch_array($resultSelect);
$title = $row['name'];
$details = $row['description'];

$queryDustbin = "INSERT INTO dustbin (title,details,category)
VALUES ('$title','$details','Project')"; 
$resultDustbin = mysqli_query($connect,$queryDustbin);

$query = "DELETE FROM project WHERE id = $_GET[id]";
$result = mysqli_query($connect, $query);

$query = "SELECT * FROM task  WHERE project = '$title'";
$result = mysqli_query($connect, $query);

while($row = mysqli_fetch_array($result)){
    $queryDustbin = "INSERT INTO dustbin (title,details,category)
                      VALUES ('$row[task]','$row[description]','Task')"; 
    $resultDustbin = mysqli_query($connect,$queryDustbin);
}

$query = "DELETE FROM task  WHERE project = '$title'";
$result = mysqli_query($connect, $query);

if($result){
    header('location:index.php');
}else{
    echo "some problem occurs" ;
    header('location:index.php');
}
?>