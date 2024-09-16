<?php
include('../../includes/connection.php');
 $query = "SELECT * FROM task WHERE id = $_GET[id]";
 $result = mysqli_query($connect,$query);
 
 if (mysqli_num_rows($result) > 0) {
   // output data of each row
  $row = mysqli_fetch_assoc($result);
  $id=$row['id'];
  $project = $row['project'];
  $name = $row['task'];
  $start_date = $row['start_date'];
  $end_date = $row['end_date'];
  $description = $row['description'];
  $status = $row['status'];
  $assignUser = $row['assignuser'];
  
  
} else {
   echo "0 results";
 }
?>

<?php
 
if(isset($_POST['updateTask'])){

    $assignUserId = $_POST['assignUserId'];   
    $assignUserId1 = $_POST['assignUserId'];   
 
    // convert into array
    $arr1 = explode(',', $assignUser);
    $arr2 = explode(',', $assignUserId);

    // Remove elements of $arr2 from $arr1
    $arr1 = array_diff($arr1, $arr2);

    // Convert array back to comma-separated string
    $str1 = implode(',', $arr1);

    if($str1=="")
    $str1='none';

    $str1 = trim($str1, ',');
    $str1 = trim($str1, ' ');

    $query1 = "UPDATE task SET task = '$_POST[name]',
    project = '$_POST[projects]',
    start_date = '$_POST[start_date]',  end_date = '$_POST[end_date]',
    description = '$_POST[description]', status='$_POST[status]',
    assignuser = '$str1'
     WHERE id = $_GET[id]";
    $result1 = mysqli_query($connect, $query1);

   $arr3 = explode(',', $assignUserId1);
   foreach ($arr3 as $userid2) {
       $userid2 = mysqli_real_escape_string($connect, $userid2);
       $commentdelete = "DELETE FROM `comments` WHERE userid = $userid2 and taskid=$id";
       $resultdelete = mysqli_query($connect, $commentdelete);
   }
   
   
   $arr3 = explode(',', $_POST['assignUserId']);
   foreach ($arr3 as $userid3) {
       $userid3 = mysqli_real_escape_string($connect, $userid3);
       
       // Select user details
       $queryUser = "SELECT * FROM `users` WHERE id='$userid3'";
       $resultUser = mysqli_query($connect, $queryUser);
       
       if ($resultUser && mysqli_num_rows($resultUser) > 0) {
           $rowUser = mysqli_fetch_assoc($resultUser);
           
           // Assuming taskid is stored as comma-separated string in users table
           $taskId = $rowUser['taskid'];
           
           // Explode taskid string to array
           $arr1 = explode(',', $taskId);
           
           // Remove $userid3 from $arr1 if it exists
           $arr1 = array_diff($arr1, array($id));
           
           // Implode array back to string
           $str1 = implode(',', $arr1);
           
           if($str1=="")
            $str1='none';

           $str1 = trim($str1, ',');
           $str1 = trim($str1, ' ');

           // Update users table with updated taskid
           $queryUpdate = "UPDATE users SET taskid = '$str1' WHERE id = '$userid3'";
           $resultUpdate = mysqli_query($connect, $queryUpdate);
           
           if ($resultUpdate) {
            //    echo "Updated taskid for user with id $userid3 successfully.<br>";
           } else {
            //    echo "Error updating taskid for user with id $userid3: " . mysqli_error($connect) . "<br>";
           }
       } else {
        //    echo "User with id $userid3 not found.<br>";
       }
   }
   

   if($result1){
        echo "<script>
                 alert('data updated..');
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
    <title>Edit Task || TT</title>
    <link rel="stylesheet" href="../../css/editPageStyle.css">
</head>
<style>
    
.userrow h2{
    font-size:20px;
    font-weight:400;
    padding:5px 0;
    margin:0;
}
 .users{
        display:flex;
        flex-wrap:wrap;
        gap:.5rem;
        padding:.5rem .2rem;
        border-radius:5px;
        border:1px solid #000;
    }

    .user{
        font-size:19px;
        border-radius:5px;
        width:fit-content;
        padding:5px 10px;
        display:flex;
        border:1px solid #000;
    }
    .remove{
        display:inline !important;
        cursor :pointer;
        font-weight:bold;
        font-size:20px !important;
        /* margin-left:10px; */
        color:red !important;
        padding:0;
        background-color:#fff !important;
    }
    .user:hover{
        border:2px solid #000;
    }
    .removeform{
        display:inline;
        padding:0;

    }
    .userNotExists{
        padding:.2rem .5rem;
        background-color:red;
    }
    </style>

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
                    <select id="id" name="status" class="status" required>
                        <option value="pending" name="pending"  <?php if($status=="pending") echo 'selected'?>>pending</option>
                        <option value="start" name="start"  <?php if($status=="start") echo 'selected'?>>Start</option> 
                </select>
                </label>
            </div>

            <div class="userrow">
                <div class="userheader">
                    <h2>Assign Users:</h2>
                </div>
                <div class="users">
    <?php
    // Assuming $assignUser is properly initialized before this point
    
    if ($assignUser != 'none' && $assignUser != '') {
        $assignUsers = explode(",", $assignUser);
        
        foreach ($assignUsers as $user) {
            $user = (int)$user;
            
            // Ensure $user is within valid range (0 to 200)
            if ($user >= 0 && $user <= 200) {
                $queryUser = "SELECT * FROM users WHERE id = $user";
                $resultUser = mysqli_query($connect, $queryUser);
                
                if ($resultUser && mysqli_num_rows($resultUser) > 0) {
                    $rowUser = mysqli_fetch_assoc($resultUser);
                    ?>
                    <div class="user">
                        <div class="bro">
                            <?php echo htmlspecialchars($rowUser['name']) ?>   
                        </div>
                        <div class="bro">             
                            <?php echo $rowUser['id'] ?>  
                        </div>
                        <span class="remove">X</span> 
                    </div>
                    <?php   
                }
            }
        }
    } else {
        ?>
        <div class="userNotExists">No assigned users</div>
        <?php
    }
    ?>
    <input type="text" id="userid" name="assignUserId" value="" hidden>
</div>

            </div>
                <div class="row"> <label for="description"> Description : </label>
                <textarea name="description"  rows="5" cols="40" required><?php echo $description ?></textarea>
             </div>
            <input type="submit" name="updateTask" id="updateTask" value="Update">
        </form>
    </div>

    <script>
     var remove = document.querySelectorAll('.remove');
     var userid = document.getElementById('userid');
     
     for(let i =0;i<remove.length;i++){
        remove[i].addEventListener("click", function(){

            remove[i].parentNode.remove();

            console.log("remove clicked");
            if(userid.value=="")
                userid.value=remove[i].previousElementSibling.innerText.trim();
            else
                userid.value=userid.value+','+remove[i].previousElementSibling.innerText.trim();
        });

    }
   </script>
</body>
</html>