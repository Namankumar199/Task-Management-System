<?php
include('../includes/connection.php');

session_start();
if(empty($_SESSION['name'])){
    header("location:../");
 }

$query = "SELECT * FROM `users` WHERE `email` =  '$_SESSION[email]' AND `password` =  '$_SESSION[password]'";
$result = mysqli_query($connect,$query);
$row = mysqli_fetch_assoc($result);
$_SESSION['name'] = $row['name'];
$name = $_SESSION['name'];
   
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TT | User_Dashboard</title>
    <link rel="stylesheet" href="../css/dashboardStyle.css">
</head>
<body>
    <div class="container" style="background-color:#fff;">
        <div class="left-container">
            <div class="left-header">Projects</div>
            <div class="userName">
                <!-- <img src="" alt="image"> -->
                <h2><?php echo $name?></h2>
            </div>
            <div class="menus">
                <ul class="menus-list">
                    <li><a style="background-color: rgb(51, 122, 183); color: #fff !important;border-top-right-radius: 20px;
                                    border-bottom-right-radius: 20px;"href="user_dashboard.php" class="icon">Dashboard</a></li>
                    <li><a href="task/index.php" id="tasks">Task</a></li>
                    <li hidden><a href="dustbin/index.php" id="dustbin">Dustbin</a></li>
                    <li><a href="../includes/logout.php" id="dustbin">Logout</a></li>            
                </ul>
            </div>
        </div>

        <div class="right-container">
            <div class="right-header">
                <div class="burger">
                    <div class="line"></div>
                    <div class="line"></div>
                    <div class="line"></div>
                </div>
                <div class="userName">
                    <!-- <img src="" alt="image"> -->
                    <h2><?php echo $name ?></h2>
                </div>
            </div>
            <div class="right-body" id="right-body">
                <div class="dashboard-header">Dashboard </div>
                <div class="cards">
                
                    <div class="card" >
                        <div class="card-content">
                            <div class="card-text">
                                <h2>
                                <?php 
                                     $query ="SELECT COUNT(*) FROM project";
                                     $result = mysqli_query($connect, $query);
                                     $row = mysqli_fetch_row($result);
                                     $count = $row[0];
                                     echo $count;
                                 ?>
                                </h2>
                                <h3>PROJECT</h3>
                            </div>
                            <div class="img">
                            <img width="60" height="60" src="https://img.icons8.com/arcade/64/project.png" alt="project"/>
                        </div>
                        </div>
                        <div class="show-info">
                            SHOW INFO ➡️
                        </div>
                    </div><div class="card">
                        <div class="card-content">
                            <div class="card-text">
                                <h2>
                                <?php 
                                    $query ="SELECT COUNT(*) FROM task";
                                    $result = mysqli_query($connect, $query);
                                    $row = mysqli_fetch_row($result);
                                    $count = $row[0];
                                    echo $count;
                                 ?>
                                </h2>
                                <h3>TASK</h3>
                            </div>
                            <div class="img">
                            <img width="60" height="60" src="https://img.icons8.com/arcade/64/task.png" alt="task"/>
                        </div>
                        </div>
                        <div class="show-info">
                            SHOW INFO ➡️
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>