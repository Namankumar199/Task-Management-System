<?php

include('../../includes/connection.php');
 $query = "SELECT * FROM admins WHERE id = $_GET[id]";
 $result = mysqli_query($connect,$query);
 
 if (mysqli_num_rows($result) > 0) {
   // output data of each row
  $row = mysqli_fetch_assoc($result);
  $name = $row['name'];
  $mobile = $row['mobile'];
  $email = $row['email'];
  $password = $row['password'];
  $status = $row['status'];
  

  } else {
   echo "0 results";
 }
?>

<?php
 
if(isset($_POST['updateAdmin'])){
   


    $query = "UPDATE admins SET name = '$_POST[name]', mobile = '$_POST[mobile]',
    email = '$_POST[email]',  password = '$_POST[password]', status = '$_POST[status]'
     WHERE id = $_GET[id]";
   $result = mysqli_query($connect, $query);

    if($result){
     
      echo "<script>

        alert('Data updated..');
                 window.location.href='index.php';
            </script>";
    }else{
        echo "<script>
                 alert('Not updated..');
                 window.location.href='index.php';
             </script>";

    }
}
?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Admin || TT</title>
    <link rel="stylesheet" href="../../css/editPageStyle.css">
</head>

<body>
    <div class="update-project-form">
        <div class="update-header">
            Update Information
        </div>
        <form action="" method="POST">
            
        <div class="row">
            <label for="name"> Name : </label>
            <input type="text" name="name" value="<?php echo $name ?>" required>
        </div>
        <div class="row">
          <label for="mobile"> Mobile : </label>
          <input type="text" name="mobile" value="<?php echo $mobile ?>" required>
        </div>
        <div class="row">
          <label for="email"> Email : </label>
          <input type="email" name="email" value="<?php echo $email ?>" required>
        </div>
        <div class="row">
          <label for="password"> Password : </label>
          <input type="text" name="password"  value="<?php echo $password ?>" required>
        </div>
        
        <div class="row">
        <label for="status"> Status :        
          <input type="radio" name="status" value="active" <?php if($status=='active') echo "checked"?>> <span class="radio"> Active</span> 
          <input type="radio" name="status" value="inactive" <?php if($status=='inactive') echo "checked"?>> <span class="radio"> InActive</span>
          </label>
        </div>      
        <input type="submit" name="updateAdmin" id="updateAdmin" value="Update Admin">
    </form>
  </div>
</body>
</html>