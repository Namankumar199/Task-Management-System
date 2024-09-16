<?php include('../../includes/connection.php');
session_start();
if(!isset($_SESSION['name'])){
    header("location: ../../");
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
    <title>Project ||TT </title>
    <link rel="stylesheet" href="../../css/dashboardStyle.css">
    <link rel="stylesheet" href="../../css/dataPageStyle.css">
</head>

<body>
    
<div class="container" style="background-color:#fff;">
        <div class="left-container">
            <div class="left-header">Projects</div>
            <div class="userName">
                <!-- <img src="" alt="image"> -->
                <h2 class="usernameh2"><?php echo $name?></h2>
            </div>
            <div class="menus">
                <ul class="menus-list">
                    <li><a href="../admin_dashboard.php">Dashboard</a></li>
                    <li><a href="../admin1/index.php" id="admins">Admin</a></li>
                    <li><a style="background-color: rgb(51, 122, 183); color: #fff !important;border-top-right-radius: 20px;
                                    border-bottom-right-radius: 20px;" href="index.php" id="users">User</a></li>
                    <li><a href="../project/index.php" id="projects">Project</a></li>
                    <li><a href="../task/index.php" id="tasks">Task</a></li>
                    <li><a href="../dustbin/index.php" id="dustbin">Dustbin</a></li>
                    <li><a href="../../includes/logout.php" id="dustbin">Logout</a></li>            
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
<div class="project-container">
        <div class="project-header">
            <h2>Users</h2>
        </div>
        <div class="project-body">
            <div class="project-btn">
                <h2> User Informations</h2>

                <div class="action-btn-section">
                <div class="action-btns">
                    <h4>DragAndDrop on Data</h4>
                    <a class="aEdit action_btn"  draggable="true">Edit</a>                                             
                    <a class="aDel action_btn"  draggable="true">Delete</a>
                </div>
                <button onClick="fun();">      
                    <a href="#">
                        <img width="20" height="20" src="https://img.icons8.com/ios/50/228BE6/plus--v1.png"
                        alt="plus--v1" />
                        Create New
                    </a>
                </button>   
              </div>
            </div>
            <div class="project-filter">
                <div class="filter"> Show <select name="filter-select" id="">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select> 
            entries</div>
                <div class="search">Search : <input type="text" class="search-input" id="searchInput"> </div>
            </div>

            <div class="project-table">
           <table>
            <thead>
                <tr>
                    <td>SNO.</td>
                    <td>Name</td>
                    <td>Email Address</td>
                    <td>Phone</td>
                    <td>status</td>
                    <td hidden>Manage</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sno = 1;
                $query = "SELECT * FROM users";
                $result = mysqli_query($connect,$query);
                
                while($row = mysqli_fetch_array($result)){
              ?>
              <tr class="status">
                    <td> <?php echo $sno?></td>
                    <td><?php echo $row['name']?></td>
                    <td><?php echo $row['email']?></td>
                    <td><?php echo $row['mobile']?></td>
                    <td>
                    <?php 
                        if($row['status']=='active')
                           echo "<span class='active'> {$row['status']} </span>";
                        else 
                           echo "<span class='inactive'> {$row['status']} </span>"; 
                     ?> 
                    </td>
                    <td hidden>
                          <a class="aDel" href="deleteUser.php?id=<?php echo $row['id']?>">Del</a>
                          <a class="aEdit" href="editUser.php?id=<?php echo $row['id']?>">Edit</a>
                    </td>
                </tr>
            <?php
        $sno++;    
        }
      ?>
     </tbody>
    </table>
   </div>
 </div>
</div>
    </div>
    </div>


    <!-- popup -->

    
 <div class="popUp">
    <div class="form">
        <div class="cross">X</div>
       <div class="form-heading">
        New User Information
       </div>
    <form action="insertUser.php" method="POST">
            
        <div class="row">
            <label for="name"> Name : </label>
            <input type="text" name="name" required>
        </div>
        <div class="row">
          <label for="mobile"> Mobile : </label>
          <input type="text" name="mobile" required>
        </div>
        <div class="row">
          <label for="email"> Email : </label>
          <input type="email" name="email" required>
        </div>
        <div class="row">
          <label for="password"> Password : </label>
          <input type="password" name="password" required>
        </div>
        
        <div class="row">
        <label for="status"> Status :        
          <input type="radio" name="status" value="active" required> <span class="radio"> Active</span> 
          <input type="radio" name="status" value="inactive" required> <span class="radio"> InActive</span>
          </label>
        </div>
        
        <input type="submit" name="createUser" id="createUser" value="Create User">
        </form>
    </div>
    
 </div>

 
<script>
    <?php require_once("../../script/script.js");?>
    <?php require_once("../../script/script1.js");?>
    
</script>
</body>

</html>