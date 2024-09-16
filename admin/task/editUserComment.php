<?php
include('../../includes/connection.php');

// Assuming $_POST variables are provided and sanitized properly

$userName = mysqli_real_escape_string($connect, $_POST['user_name']);
$commentValue = mysqli_real_escape_string($connect, $_POST['comment_value']);
$taskName = mysqli_real_escape_string($connect, $_POST['task_name']);

// Step 1: Check if the user exists
    $queryUser = "SELECT * FROM `users` WHERE `name` = '$userName'";
    $resultUser = mysqli_query($connect, $queryUser);
    $rowUser = mysqli_fetch_assoc($resultUser);
    $idUser = $rowUser['id'];
    $idUser1 = $rowUser['id'];
    $idTaskUser = $rowUser['taskid'];

// step 2. check task exists 
    $queryTask = "SELECT * FROM `task` WHERE `task` = '$taskName'";
    $resultTask = mysqli_query($connect, $queryTask);
    $rowTask = mysqli_fetch_assoc($resultTask);
    $idTask = $rowTask['id'];
    $idTask1 = $rowTask['id'];
    $idAssignUserTask = $rowTask['assignuser'];
    
    $pos = strpos($idAssignUserTask, $idUser1);
    
    if ($pos !== false) {
        $idUser1 = $idAssignUserTask;
        // echo "Found in the string";
    } else {
        // echo "Did not find  in the string";        
    if($idAssignUserTask=='none'){
        $idUser=$idUser;
    }else{
        $idUser1 = $idUser.','.$idAssignUserTask;
    }
    }

    $idUser1 = trim($idUser1, ',');
    $idUser1 = trim($idUser1, ' ');

    $pos1 = strpos($idTaskUser, $idTask1);
    
    if ($pos1 !== false) {
        $idTask1 = $idTaskUser;
    } else {
             
    if($idTaskUser=='none'){
        $idTask1= $idTask1;
    }else{
        $idTask1 = $idTask1.','.$idTaskUser;
    }
    }

    $$idTask1 = trim($idTask1, ',');
    $$idTask1 = trim($idTask1, ' ');


   $updateQueryUser = "UPDATE users SET comment = '$commentValue', taskid = '$idTask1' WHERE id = '$idUser'";
    $updateResultUser = mysqli_query($connect, $updateQueryUser);

    $updateQueryTask= "UPDATE task SET assignuser = '$idUser1' WHERE id = '$idTask'";
    $updateResultTask = mysqli_query($connect, $updateQueryTask);

    mysqli_close($connect);


// Redirect to index.php after completing all operations
// header('Location: index1.php');
// echo "<script> </script>"
// ob_end_flush(); // Flush output buffer and redirect
exit;
?>
