<?php

include('../../includes/connection.php');
session_start();
if(!isset($_SESSION['name'])){
    header("location: ../../");
 }else{
    $query1 = "SELECT * FROM project";
    $result1 = mysqli_query($connect,$query1);
    $projectCount = mysqli_num_rows($result1);
    
    $query = "SELECT * FROM `users` WHERE `email` =  '$_SESSION[email]' AND `password` =  '$_SESSION[password]'";
    $result = mysqli_query($connect,$query);
    $row = mysqli_fetch_assoc($result);
    $_SESSION['name'] = $row['name'];
    $_SESSION['id'] = $row['id'];
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
    <link rel="stylesheet" href="style.css">
    
    <style>
        .granted,
        .notGranted{
            width:fit-content;
            padding:.2rem .5rem;
            color:#fff;
            margin:0 auto;
            border-radius:5px;
            background-color:green;
        }
        .notGranted{
            background-color:yellow;
            color:#000;
        }
        #taskName{
            width:100%;
            color:rgb(85,44,122);
            font-size:22px;
            margin:0 10px;
            text-transform: capitalize;
            font-weight:bold;
        }
        .comments,
        .noComments{
            width:fit-content;
            padding:5px 10px;
            margin:0 auto;
            background-color: rgb(73, 208, 35);
            color:#fff;
            border-radius:5px;
        }
        .noComments{
            background-color: rgb(237, 39, 17);
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
                    <li><a href="../user_dashboard.php">Dashboard</a></li>
                    <li><a style="background-color: rgb(51, 122, 183); color: #fff !important;border-top-right-radius: 20px;
                                    border-bottom-right-radius: 20px;" href="index.php" id="tasks">Task</a></li>
                    <li hidden><a href="../dustbin/index.php" id="dustbin">Dustbin</a></li>
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
                    <h4>Drag on Data</h4>
                    <a class="aView action_btn"  draggable="true">View</a>
                    <a class="aEdit action_btn"  draggable="true">Comment</a>                                             
                </div>
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
                    <td>Project</td>
                    <td>Task</td>
                    <td>Period</td>
                    <td>Status</td>
                    <td>AssignToYou</td>
                    <td>Your Comments</td>
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
                        <?php
                              $str1 = $row['assignuser'];
                              $str2 = $_SESSION['id'];
                            // Check if str2 is present in str1
                            if (strpos($str1, $str2) !== false) {
                               echo "<div class='granted'>Granted</div>";
                                // echo "$str2 is present in $str1";
                            } else {
                                // echo "$str2 is not present in $str1";
                                echo "<div class='notGranted'>Not Granted</div>";
                            }
                                 
                        ?>
                    </td>
                    <td>
                    <?php
                
                $commentcount = "SELECT COUNT(*) FROM comments 
                 WHERE userid='$_SESSION[id]' and taskid = '$row[id]'";
                 $commentcountresult = mysqli_query($connect,$commentcount);
                 $commentrow = mysqli_fetch_array($commentcountresult);

                  // Access the count value
                    $countcomment = $commentrow['COUNT(*)'];
                    if($countcomment >0){
                      echo "<div class='comments'> $countcomment </div>";
                    } else{
                         echo "<div class='noComments'> No Comment </div>";                 
                     }
                    ?>
                    </td>
                    <td hidden>
                          <a class="aView"   href="viewTask.php?id=<?php echo $row['id']?>" class="icon">View</a>
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
 
<div class="commentPopUp">
<div class="form">
    <div class="commentCross">X</div>
       <div class="form-heading">
           Comment
       </div>
    <form action="insertComment.php" method="POST">          
        <div class="date_row">
            <label for="name"> Task  :<span id="taskName"></span><br>
         <input type="text" name="taskName" id="taskNameInput" value="" hidden />
        </label>
        </div>
        <div class="row"> <label for="description"> Comment : </label>
        <textarea name="comment" rows="5" cols="40"></textarea></div>
        <input type="submit" name="createComment" id="createComment" value="Comment">
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
    <?php require_once("script1.js");?>   
</script>
<script>

</script>
</body>

</html>