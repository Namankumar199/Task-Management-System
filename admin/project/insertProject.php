<?php

include('../../includes/connection.php');

if(isset($_POST['createProject'])){
    
    $query = "INSERT INTO project (category,department,name,start_date,end_date,price,description,code,createdAt,status)
                        VALUES ('$_POST[projectcategory]','$_POST[department]','$_POST[name]','$_POST[start_date]',
                        '$_POST[end_date]','$_POST[price]','$_POST[description]','$_POST[code]','02:02:02','$_POST[status]')";   
    $result = mysqli_query($connect,$query);

    if($result){
      echo "<script>
      alert('Project Created Successfully');
      window.location.href='index.php';
      </script>";
    }else{
         echo "<script>
         alert('Not Created');
         window.location.href='index.php';
         </script>";
    }
}
?>