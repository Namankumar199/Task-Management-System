<?php
include('../../includes/connection.php');
 $query = "SELECT * FROM task WHERE id = $_GET[id]";
 $result = mysqli_query($connect,$query);
 
 if (mysqli_num_rows($result) > 0) {
   // output data of each row
  $row = mysqli_fetch_assoc($result);
  $project = $row['project'];
  $name = $row['task'];
  $start_date = $row['start_date'];
  $end_date = $row['end_date'];
  $description = $row['description'];
  $status = $row['status'];
  
} else {
   echo "0 results";
 }
?>

<?php
 
if(isset($_POST['updateTask'])){
    $query1 = "UPDATE task SET task = '$_POST[name]',
    project = '$_POST[projects]',
    start_date = '$_POST[start_date]',  end_date = '$_POST[end_date]',
    description = '$_POST[description]', status='$_POST[status]'
     WHERE id = $_GET[id]";
   
   $result1 = mysqli_query($connect, $query1);
    if($result1){
        echo "<script>
                 alert('Data updated..');
                window.location.href='index.php';
            </script>";
    }else{
        echo "<script>
                 alert('not updated..some error occured');
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
    <title>Create Project || TT</title>
    <link rel="stylesheet" href="../../css/editPageStyle.css">
</head>

<body>
    <div class="update-project-form">
        <div class="update-header">
            Update Task 
        </div>
        <form action="" method="POST">
            <div class="row">
                <label for="code">  Project category:
                    <select name="projects" id="projects" value="<?php echo $project ?>">
                        <?php
                             $query = "SELECT * FROM project";
                             $result = mysqli_query($connect,$query);
                             while ($row = mysqli_fetch_array($result)){
                                 ?>
                                     <option value="<?php echo $row['name'] ?>" <?php if($row['name']==$project) echo 'selected' ?> >
                                         <?php echo $row['name'] ?> 
                                        </option>
                                 <?php
                              }
                         ?>
                  </select> 
                </label>
            </div>
            <div class="row">
                <label for="name"> Name : </label>
                <input type="text" name="name" value="<?php echo $name?>" required>
            </div>
            <div class="date_row">
                <label for="start_date"> Start date:<input type="date" name="start_date" value="<?php echo $start_date?>" required></label>
                <label for="end_date"> End date: <input type="date" name="end_date" value="<?php echo $end_date?>" required></label>
            </div>
            <div class="date_row">
                <label for="status"> Status :<br>
                    <select id="id" name="status" class="status">
                        <option value="pending" name="pending"  <?php if($status=="pending") echo 'selected'?>>pending</option>
                        <option value="start" name="start"  <?php if($status=="start") echo 'selected'?>>Start</option> 
                </select>
                </label>
            </div>
            <div class="row"> <label for="description"> Description : </label>
            <textarea name="description"  rows="5" cols="40" required><?php echo $description?></textarea></div>
            <input type="submit" name="updateTask" id="updateTask" value="Update">
        </form>
    </div>
 </body>
</html>