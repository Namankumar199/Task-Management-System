<?php

include('../../includes/connection.php');

if(isset($_POST['createTask'])){
    
     $query = "INSERT INTO task (project,task,start_date,end_date,description,status,assignuser)
                         VALUES ('$_POST[projectCategory]','$_POST[name]','$_POST[start_date]','$_POST[end_date]','$_POST[description]','$_POST[status]','none')";   
    $result = mysqli_query($connect,$query);    

    if($result){
    echo "<script>
    alert('Task Created Successfully');
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