<?php

include('../../includes/connection.php');
$query = "DELETE FROM users WHERE id = $_GET[id]";

$result = mysqli_query($connect, $query);

if($result){
    header('location:index.php');
}else{

    echo "some problem occurs" ;
    header('location:index.php');
}

?>