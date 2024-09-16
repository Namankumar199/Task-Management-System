<?php

include('../../includes/connection.php');
$query = "SELECT * FROM project";
$result = mysqli_query($connect,$query);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Project || TT</title>
<style>

.create-project-form{
    display:flex;
    flex-direction:column;
    gap:1rem;
    border:1px solid red;
    justify-content: center;
    /* align-items: center; */

}
input{
    padding:.5rem 0;
}

    </style>
</head>

<body>
    <div class="create-project-form">
<form action="insertTask.php" method="POST">
    <div>Project <select name="projectCategory">
          <?php
        while ($row = mysqli_fetch_array($result)){
            ?>
            <option value="<?php echo $row['name'] ?>"> <?php echo $row['name'] ?> </option>
            <?php
          }
        ?>
     </select> 
    </div>
     <div>  Name : <input type="text" name="name"></div>
        <div>  start date: <input type="date" name="start_date"></div>
        <div>  End date: <input type="date" name="end_date"></div>
        <div>  status : <select id="id" name="status">
                            <option value="start" name="start">start</option>
                            <option value="pending" name="pending">pending</option>
                        </select>
        </div>
        <div>Description : <textarea name="description" id=""></textarea></div>
        <input type="submit" value="create Task" name="createTask">
    </form> 
    </div>
</body>
</html>