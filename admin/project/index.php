<?php 
include('../../includes/connection.php');
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
    
    <style>
 @media screen and (width<=1000px) {
    .project-table{
        overflow:scroll;
    }
 }
 </style>
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
                    <li><a href="../admin_dashboard.php">Dashboard</a></li>
                    <li><a href="../admin1/index.php" id="admins">Admin</a></li>
                    <li><a href="../user/index.php" id="users">User</a></li>
                    <li><a style="background-color: rgb(51, 122, 183); color: #fff !important;border-top-right-radius: 20px;
                                    border-bottom-right-radius: 20px;" href="index.php" id="projects">Project</a></li>
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
                    <h2 class="usernameh2"><?php echo $name ?></h2>
                </div>
            </div>
            <div class="right-body" id="right-body">

    <div class="project-container">
        <div class="project-header">
            <h2>Projects</h2>
        </div>
        <div class="project-body">
            <div class="project-btn">
                <h2>Project Informations</h2>
                <div class="action-btn-section">
                <div class="action-btns">
                    <h4>DragAndDrop on Data</h4>
                    <a class="aView action_btn"  draggable="true">View</a>
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
                <div class="search">Search : <input type="text" id="searchInput" class="search-input"> </div>
            </div>

        <div class="project-table">
           <table>
             <thead>
                 <tr>
                     <td>SNO.</td>
                     <td>Name</td>
                     <td>Project Category</td>
                     <td>Department</td>
                     <td>Period</td>
                     <td>Status</td>
                     <td>Tasks</td>
                     <td hidden>Date</td>
                     <td hidden>Manage</td>
                  </tr>
            </thead>
             <tbody>
                         <?php
                         $sno = 1;
                         $query = "SELECT * FROM project";
                         $result = mysqli_query($connect,$query);
                         
                         while($row = mysqli_fetch_array($result)){
                       ?>
                       <tr class="status">
                             <td> <?php echo $sno?></td>
                             <td><?php echo $row['name']?></td>
                             <td><?php echo $row['category']?></td>
                             <td><?php echo $row['department']?></td>
                             <td style="color:#404040;">
                                 <span style="color:green;font-weight:bold;">  From:</span>
                                 <?php echo addDaysToDate($row['start_date'])?> <br>
                                 <span style="color:red;font-weight:bold;">To: </span>
                                 <?php echo addDaysToDate($row['end_date'])?>
                            </td>
                             <td>
                             <?php 
                                 if($row['status']=='start')
                                      echo "<span class='start'> {$row['status']} </span>";
                                 else if($row['status']=='pending')
                                     echo "<span class='pending'> {$row['status']} </span>"; 
                             ?>     
                            </td>
                             <td>
                               <?php
                                      $query1 = "SELECT * FROM task WHERE project ='$row[name]'"; 
                                       $result1 = mysqli_query($connect,$query1);
                                       
                                       $rowcount1=mysqli_num_rows($result1); 
                                       echo $rowcount1; 
                                 ?>
                             </td>
                             <td hidden>
                              <?php echo $row['createdAt'] ?>
                             </td>
                               <td hidden>
                                     <a class="aView" href="viewProject.php?id=<?php echo $row['id']?>" class="icon">View</a>
                                     <a class="aDel"  href="deleteProject.php?id=<?php echo $row['id']?>">Del</a>
                                     <a class="aEdit" href="editProject.php?id=<?php echo $row['id']?>">Edit</a>
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

 <div class="popUp">
    <div class="form">
        <div class="cross">X</div>
       <div class="form-heading">
        New Project Information
       </div>
    <form action="insertProject.php" method="POST">
            
        <div class="date_row">
             <label for="code"> Code :<br>  <input type="text" name="code" required>   </label>
            <label for="name"> Name : <br><input type="text" name="name" required>     </label>
        </div>
        <div class="row"> <label for="project"> Project category: </label><input type="text" name="projectcategory" required></div>
        <div class="row"> <label for="department"> Departemnt :</label><input type="text" name="department" required>  </div>
        <div class="date_row"> 
            <label for="start_date"> Start date: <br><input type="date" name="start_date" required></label>
            <label for="end_date"> End date: <br><input type="date" name="end_date" required></label>
        </div>
        <div class="date_row"> 
            <label for="price"> Price: <br><input type="number" name="price" required> </label>
            <label for="status"> Status :  <br>
                  <select id="id" name="status" class="status" required>
                         <option value="pending" name="pending">pending</option>
                          <option value="start" name="start">Start</option>
                   </select>
            </label>
            </div>
        <div class="row"> <label for="description"> Description : </label><textarea name="description" id="" rows="5" cols="40" required></textarea></div>
        <input type="submit" name="createProject" id="createProject" value="Create Project">
        </form>
    </div>
    
 </div>
 <?php
    function addDaysToDate($dateString, $numberOfDays=0) {
       $newDateTimestamp = strtotime($dateString . ' +' . $numberOfDays . ' days');
       $newDate = date('d-m-Y', $newDateTimestamp);
       return $newDate;
    }   
  ?>

 <script>
    <?php require_once("../../script/script.js");?>
    <?php require_once("../../script/script1.js");?>   
 </script>
</body>
</html>