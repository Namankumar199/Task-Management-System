<?php
include('../includes/connection.php');

session_start();
if(empty($_SESSION['name'])){
    header("location:../");
 }

$query = "SELECT * FROM `admins` WHERE `email` =  '$_SESSION[email]' AND `password` =  '$_SESSION[password]'";
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
    <title>TT | Admin_Dashboard</title>
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
                                    border-bottom-right-radius: 20px;"href="admin_dashboard.php" class="icon">Dashboard</a></li>
                    <li><a href="admin1/index.php" id="admins">Admin</a></li>
                    <li><a href="user/index.php" id="users">User</a></li>
                    <li><a href="project/index.php" id="projects">Project</a></li>
                    <li><a href="task/index.php" id="tasks">Task</a></li>
                    <li><a href="dustbin/index.php" id="dustbin">Dustbin</a></li>
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
                    <div class="card" id="cardAdmin">
                        <div class="card-content">
                            <div class="card-text">
                                <h2>
                                <?php 
                                    $query ="SELECT COUNT(*) FROM admins";
                                    $result = mysqli_query($connect, $query);
                                    $row = mysqli_fetch_row($result);
                                    $count = $row[0];
                                    echo $count;
                                    ?>
                                </h2>
                                <h3>ADMIN</h3>
                            </div>
                            <div class="img">
                                <img width="60" height="60" src="https://img.icons8.com/ultraviolet/40/administrator-male.png" alt="administrator-male"/>
                            </div>
                        </div>
                        <div class="show-info">
                            SHOW INFO ➡️
                        </div>
                    </div>
                    <div class="card" id="cardUser">
                        <div class="card-content">
                            <div class="card-text">
                                <h2>
                                <?php 
                                       $query ="SELECT COUNT(*) FROM users";
                                       $result = mysqli_query($connect, $query);
                                       $row = mysqli_fetch_row($result);
                                       $count = $row[0];
                                       echo $count;
                                       ?>
                                </h2>
                                <h3>USERS</h3>
                            </div>
                            <div class="img">
                            <img width="60" height="60" src="https://img.icons8.com/pulsar-gradient/48/user.png" alt="user"/>
                          </div>
                        </div>
                        <div class="show-info">
                            SHOW INFO ➡️
                        </div>
                    </div><div class="card" id="cardProject">
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
                    </div><div class="card" id="cardTask">
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
  
 <script>
    <?php require_once("../script/script.js");?>
    </script>
<script>

var cardAdmin = document.getElementById('cardAdmin');
var cardUser = document.getElementById('cardUser');
var cardProject = document.getElementById('cardProject');
var cardTask = document.getElementById('cardTask');

cardAdmin.addEventListener('click', function () {
    window.location.href = "admin1/index.php";
});

cardUser.addEventListener('click', function () {
   window.location.href = "user/index.php";
});

cardProject.addEventListener('click', function () {
   window.location.href = "project/index.php";
});

cardTask.addEventListener('click', function () {
   window.location.href = "task/index.php";
});
 </script>
</body>
</html>