<?php

include('../../includes/connection.php');
session_start();

if(isset($_POST['createComment'])){

   $query1 = "SELECT * FROM task WHERE task = '$_POST[taskName]'";
   $result1 = mysqli_query($connect,$query1);    
   $row1 = mysqli_fetch_array($result1);
   $taskId = $row1['id']; 

    $date = date("Y-m-d");
     $query2 = "INSERT INTO comments (comments,created_date,users,userid,taskid)
                         VALUES ('$_POST[comment]','$date','$_SESSION[name]','$_SESSION[id]','$taskId')";   
    $result2 = mysqli_query($connect,$query2);    

    if($result2){
    echo "<script>
    alert('Commented');
    window.location.href='index.php'; 
    </script>";

}else{
    echo "<script>
    alert('Not Created .  some error');
    window.location.href='index.php';
    </script>";
}
}

?>