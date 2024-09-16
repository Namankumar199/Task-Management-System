<?php

include('../../includes/connection.php');

if(isset($_POST['createAdmin'])){
    
     $query = "INSERT INTO admins (name,email,password,mobile,status)
                         VALUES ('$_POST[name]','$_POST[email]','$_POST[password]','$_POST[mobile]','$_POST[status]')";   
    $result = mysqli_query($connect,$query);    

    if($result){
    echo "<script>
    alert('Admin Created Successfully');
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