<?php

include('../../includes/connection.php');
session_start();
if(!isset($_SESSION['name'])){
    header("location: ../../");
 }else{
    $query1 = "SELECT * FROM project";
    $result1 = mysqli_query($connect,$query1);
    $projectCount=mysqli_num_rows($result1);
    
    $query = "SELECT * FROM `admins` WHERE `email` =  '$_SESSION[email]' AND `password` =  '$_SESSION[password]'";
    $result = mysqli_query($connect,$query);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['name'] = $row['name'];
    $name = $_SESSION['name'];  
}

?>

  
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Project ||TT </title>
    <link rel="stylesheet" href="../../css/dashboardStyle.css">   
    <link rel="stylesheet" href="../../css/dataPageStyle.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <style>
        .userBtn{
            padding:.3rem 1rem;
            border-radius:5px;
            border:1px dashed #000;
            background-color:rgb(22, 185, 171);
            font-size:18px;
            color:#fff;
            font-family:sans;
            font-weight:500;
            cursor:pointer;
                }
        
        .userList{
            width:100%;
            display:flex;
            align-items:center;
            justify-content:center;
            gap:1rem;
            padding:.5rem 0;
            border-top:1px solid rgb(55, 130, 165);
            border-bottom:1px solid rgb(55, 130, 165);
            border-radius:5px;
            margin:.3rem 0;
        }
        .userList a{
            padding:.3rem 1rem;
            border-radius:5px;
            border:1px dashed #000;
            background-color:rgb(22, 185, 171);
            font-size:18px;
            color:#fff;
            font-family:sans;
            font-weight:500;
            cursor:grab;
        }
        .active1{
            display:flex;

        }
        .inactive1{
            display:none;
        }
        .aEditUser{
          text-decoration:none;
          background-color:green;
          color:#fff;
          padding:.5rem 1rem;
        }
        
.userrow{
   display:flex;
   flex-wrap:wrap;
   justify-content:center;
    /* border:1px solid red; */
}
.user{
    position: relative;
    border-radius:5px;
    margin:0 5px;
    width:fit-content;
    padding:5px 10px;
    border:1px solid blue;
    background-color:rgba(149,140,248,0.5);

}

.commentcount{
    position: absolute;
    top:-10%;
    right:-20%;
    padding:2px;
    color:#fff;
    font-weight:300;
    font-size:20px;
    background-color:orange;
    border-radius:50px;
   
}
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
                    <li><a  href="../project/index.php" id="projects">Project</a></li>
                    <li><a style="background-color: rgb(51, 122, 183); color: #fff !important;border-top-right-radius: 20px;
                                    border-bottom-right-radius: 20px;" href="index.php" id="tasks">Task</a></li>
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
            <h2>Task</h2>
        </div>
        <div class="project-body">
            <div class="project-btn">
                <h2> Task Informations</h2>
                <div class="action-btn-section">

                <div class="action-btns">
                    <button class="userBtn">Users</button>
                    <h4>DragAndDrop on Data : </h4>
                    <a class="aView action_btn"  draggable="true">View</a>
                    <a class="aEdit action_btn"  draggable="true">Edit</a>                                             
                    <a class="aDel action_btn"  draggable="true">Delete</a>
                </div>

                <button onClick="fun(<?php echo $projectCount ?>);"> 
                    <a href="#">
                        <img width="20" height="20" src="https://img.icons8.com/ios/50/228BE6/plus--v1.png"
                        alt="plus--v1" />
                        Create New
                    </a>
                </button>     
            </div>
            
        </div>
        <div class="userList inactive1">
          <?php
              $query = "SELECT * FROM users";
              $result = mysqli_query($connect,$query);
              
              while($row = mysqli_fetch_array($result)){
               ?>
                <a class="<?php echo $row['name']?> action_btn" draggable="true">
                    <?php echo $row['name'] ?>
                 </a>
              <?php  
              }
            ?> 
        </div> 

        <div class="project-filter">                         
            <div class="filter"> Show <select name="filter-select" id="">
                    <option value="5">5</option>
                    <option value="10">10</option>
                    <option value="15">15</option>
                    <option value="20">20</option>
                </select>entries
            </div>
          <div class="search">Search : <input type="text" id="searchInput" class="search-input"> </div>
            </div>

        <div class="project-table">
           <table>
            <thead>
                <tr>
                    <td>SNO.</td>
                    <td>Project</td>
                    <td>Task</td>
                    <td>Period</td>
                    <td>Status</td>
                    <td style="text-align:center">User & Comments</td>
                    <td>Description</td>
                    <td hidden>Manage</td>
                </tr>
            </thead>
            <tbody>
                <?php
                $sno = 1;
                $query = "SELECT * FROM task";
                $result = mysqli_query($connect,$query);
                
                while($row = mysqli_fetch_array($result)){
              ?>
              <tr class="status">
                    <td> <?php echo $sno?></td>
                    <td><?php echo $row['project']?></td>
                    <td><?php echo $row['task']?></td>
                    <td  style="color:#404040;"> 
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
                    <div class="userrow"> 
                         <?php
                              $assignUser= $row['assignuser'];
                             if($assignUser!='none'){       
                                $assignUsers = explode(",", $assignUser);

                                foreach ($assignUsers as $user) {
                                    $user = (int)$user;
                                 if(($user>0) && ($user<=300)){
                                     $queryUser = "SELECT * FROM users WHERE id = $user";
                                     $resultUser = mysqli_query($connect,$queryUser);
                                     $rowUser = mysqli_fetch_array($resultUser);
                                    //  $row = mysqli_fetch_array($result)
                                    ?>              
                                  <div class="user">
                                      <?php echo $rowUser['name']?>
                                      <?php
                                           $commentcount = "SELECT COUNT(*) FROM comments 
                                                            WHERE userid='$user' and taskid = '$row[id]'";
                                            $commentcountresult = mysqli_query($connect,$commentcount);
                                            $commentrow = mysqli_fetch_array($commentcountresult);
    
                                            // Access the count value
                                            $countcomment = $commentrow['COUNT(*)'];
                                            if($countcomment>0){
                                                ?>
                                                <div class="commentcount">
                                                    <?php echo $countcomment; ?>    
                                                </div>
                                            <?php
                                                }
                                        ?>
                                    </div>
                                    <?php
                                }
                            }
                        }else{
                            ?>
                            <div class="user" style="background-color:red;color:#fff;">user not selected</div>
                        <?php
                        }
                        ?>
                     </div>

                     </td>
                    <td><?php echo $row['description']?></td>
                    <td hidden>
                            <a class="aView"   href="viewTask.php?id=<?php echo $row['id']?>">View</a>
                            <a class="aDel"  href="deleteTask.php?id=<?php echo $row['id']?>">Del</a>
                            <a class="aEdit"  href="editTask.php?id=<?php echo $row['id']?>">Edit</a>
                            <Button class="aEdit1" id="updateButton">EditUserComment</Button>          
                   
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
        New Task Information
       </div>
    <form action="insertTask.php" method="POST">          
        <div class="date_row">
             <label for="code">Project :   <br>             
                <select name="projectCategory" class="status">
                    <?php
                         while ($row1 = mysqli_fetch_array($result1)){
                          ?>
                            <option  value="<?php echo $row1['name'] ?>"  > <?php echo $row1['name'] ?> </option>
                        <?php
                        }
                     ?> 
                </select> 
             </label>
            <label for="name"> Name :<br> <input type="text" name="name" required></label>
        </div>
        <div class="date_row"> 
            <label for="start_date"> Start date: <br><input type="date" name="start_date" required></label>
            <label for="end_date"> End date: <br><input type="date" name="end_date" required></label>
        </div>
        <div class="date_row">         
            <label for="status"> Status :  <br>
                  <select id="id" name="status" class="status" required>
                         <option value="pending" name="pending">pending</option>
                          <option value="start" name="start">Start</option>
                   </select>
            </label>
            </div>
        <div class="row"> <label for="description"> Description : </label><textarea name="description" id="" rows="5" cols="40" required></textarea></div>
        <input type="submit" name="createTask" id="createTask" value="Create Task">
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
    <?php require_once("../../script/script2.js");?>
   
</script>
<script>
document.addEventListener('DOMContentLoaded', function () {
    var btn = document.querySelector('.userBtn');
    var userlist = document.querySelector('.userList');
    // userlist.style.display='none';

    
    btn.addEventListener('click', () => {
        if( userlist.style.display=='flex'){
            userlist.style.display='none';
            window.location.href="index.php"; 

        }
        else{
            userlist.style.display='flex';
        
        }
    });    
});
</script>

</body>

</html>