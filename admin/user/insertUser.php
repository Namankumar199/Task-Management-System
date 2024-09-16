<?php

include('../../includes/connection.php');

if(isset($_POST['createUser'])){
    
     $query = "INSERT INTO users (name,email,password,mobile,status,comment,taskid)
                         VALUES ('$_POST[name]','$_POST[email]','$_POST[password]','$_POST[mobile]','$_POST[status]','false','none')";   
    $result = mysqli_query($connect,$query);    

    if($result){
    echo "<script>
    alert('User Created Successfully');
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