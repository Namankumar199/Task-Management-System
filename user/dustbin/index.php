<?php 
include('../../includes/connection.php');
session_start();
if(!isset($_SESSION['name'])){
    header("location: ../");
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
    <title>Project ||TT </title>
    <link rel="stylesheet" href="../../css/dashboardStyle.css">
    <link rel="stylesheet" href="../../css/dataPageStyle.css">
</head>

<style>
.action-btn-section
{
    width:100%;
    display:flex;
    gap:1rem;
    align-items:center;
    justify-content:end;
    gap:1rem;
}

.action-btn-section h4{
    color:#988e8e !important;
}

.aDel
    {
    margin-right:5rem;
 }
</style>

<body>
    
<div class="container" style="background-color:#fff;">
    <div class="cross"></div>
        <div class="left-container">
            <div class="left-header">Projects</div>
            <div class="userName">
                <!-- <img src="" alt="image"> -->
                <h2><?php echo $name?></h2>
            </div>
            <div class="menus">
                <ul class="menus-list">
                    <li><a href="../user_dashboard.php">Dashboard</a></li>
                    <li><a href="../task/index.php" id="tasks">Task</a></li>
                    <li hidden><a style="background-color: rgb(51, 122, 183); color: #fff !important;border-top-right-radius: 20px;
                                    border-bottom-right-radius: 20px;" href="index.php" id="dustbin">Dustbin</a></li>
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
            <h2>Dustbin</h2>
        </div>
        <div class="project-body">
            <div class="project-btn">
            <div class="action-btn-section">
            <h4>Drag on Data</h4>
                  
                <a class="aDel action_btn"  draggable="true">Delete</a>

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
                    <td>Category</td>
                    <td>Title</td>
                    <td>Details</td>
                    <td>Date</td>
                    <td hidden>Manage</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sno = 1;
                $query = "SELECT * FROM dustbin";
                $result = mysqli_query($connect,$query);
                
                while($row = mysqli_fetch_array($result)){
              ?>
              <tr class="status">
                    <td> <?php echo $sno?></td>
                    <td> <?php echo $row['category']?></td>
                    <td><?php echo $row['title']?></td>
                    <td><?php echo $row['details']?></td>
                    <td><?php echo $row['date']?></td>
                      <td hidden>
                            <a class="aDel"  href="deleteDustbin.php?id=<?php echo $row['id']?>">Del</a>
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

<script>
    <?php require_once("../../script/script.js");?>
    <?php require_once("../../script/script1.js");?>    
</script>
</body>
</html>