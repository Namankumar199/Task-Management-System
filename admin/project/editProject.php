<?php

include('../../includes/connection.php');
 $query = "SELECT * FROM project WHERE id = $_GET[id]";
 $result = mysqli_query($connect,$query);
 
 if (mysqli_num_rows($result) > 0) {
   // output data of each row
  $row = mysqli_fetch_assoc($result);
  $code = $row['code'];
  $category = $row['category'];
  $department = $row['department'];
  $name = $row['name'];
  $price = $row['price'];
  $start_date = $row['start_date'];
  $end_date = $row['end_date'];
   $status = $row['status'];
  $description = $row['description'];
  } else {
   echo "0 results";
 }
?>

<?php
 
if(isset($_POST['updateProject'])){
    $query = "UPDATE project SET code = '$_POST[code]', name = '$_POST[name]',
    category = '$_POST[projectcategory]',  department = '$_POST[department]',
    start_date = '$_POST[start_date]',  end_date = '$_POST[end_date]',
    description = '$_POST[description]',  code = '$_POST[code]',
    status = '$_POST[status]'
     WHERE id = $_GET[id]";
   
   $result = mysqli_query($connect, $query);
    if($result){
        echo "<script>
                 alert('data updated..');
                window.location.href='index.php';
            </script>";
    }else{
        echo "<script>
                 alert('not updated..');
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
    <title>Update Project || TT</title>
    <link rel="stylesheet" href="../../css/editPageStyle.css">
</head>

<body>
    <div class="update-project-form">
        <div class="update-header">
            Update Information
        </div>
        <form action="" method="POST">
            <div class="row">
                <label for="code"> Code : </label>
                <input type="text" name="code" value="<?php echo $code?>" required>
            </div>
            <div class="row">
                <label for="name"> Name : </label>
                <input type="text" name="name" value="<?php echo $name?>" required>
            </div>
            <div class="row"> <label for="project"> Project category: </label><input type="text" name="projectcategory"
            value="<?php echo $category?>" required></div>
            <div class="row"> <label for="department"> Departemnt :</label><input type="text" name="department"
            value="<?php echo $department?>"  required> </div>
            <div class="date_row">
                <label for="start_date"> Start date:<input type="date" name="start_date" value="<?php echo $start_date?>" required></label>
                <label for="end_date"> End date: <input type="date" name="end_date" value="<?php echo $end_date?>" required></label>
            </div>
            <div class="date_row">
                <label for="price"> Price:<br><input type="number" name="price" id="price" value="<?php echo $price?>" required> </label>
                <label for="status"> Status :<br>
                    <select id="id" name="status" class="status">
                         <option value="pending" name="pending"  <?php if($status=="pending") echo 'selected'?>>pending</option>
                        <option value="start" name="start"  <?php if($status=="start") echo 'selected'?>>Start</option>
                    </select>
                </label>
            </div>
            <div class="row"> <label for="description"> Description : </label><textarea name="description" id=""
                    rows="5" cols="40" required><?php echo $description?></textarea></div>
            <input type="submit" name="updateProject" id="updateProject" value="Update">
        </form>
    </div>
</body>

</html>