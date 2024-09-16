<?php

include('../../includes/connection.php');
session_start(); 
$query = "SELECT * FROM task WHERE id = $_GET[id]";
 $result = mysqli_query($connect,$query);
 
 if (mysqli_num_rows($result) > 0) {
   // output data of each row
  $row = mysqli_fetch_assoc($result);
  $project = $row['project'];
  $task = $row['task'];
  $taskid = $row['id'];
  $start_date = $row['start_date'];
  $end_date = $row['end_date'];
  $status = $row['status'];
  $description = $row['description'];
  $assignUser= $row['assignuser'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View || TT </title>
    <link rel="stylesheet" href="../../css/viewPageStyle.css">   
<style>

.assignUserList{
    /* background-color: red; */
    width: 100%;
    height:fit-content;
    display:flex;
    flex-direction:column;
    /* border:1px solid #000; */
}
.assignUserListH2{
 font-size:22px;
 text-align:center;
 padding:.5rem 0;
 background-color:rgba(35, 145, 240, 0.789);
 color:#fff;
 border-radius:5px;
}
.user{
width: 100%;
    font-size:20px;
    text-transform: capitalize;
}
.comments{
    width:100%;
    margin:5px;
    box-sizing: border-box;

    /* border:1px solid #000; */
}
.commentrow{
    box-sizing: border-box;
    display:flex;
    flex-direction:column;
    flex-wrap:wrap;
    border:1px solid rgba(2,33,44,0.4);
    border-radius:5px;
    margin:5px 10px;
    align-items:center;
    padding:0 5px;
    justify-content:space-between;
}
.commentrow:hover{
border:2px dashed rgba(2,33,44,0.9);
}
.commentdate{
    box-sizing: border-box;
    text-align:end;
    width:100%;
    font-size:16px;
    font-weight:bold;
    color: rgba(35, 145, 240, 0.789);
    /* border:1px solid #000; */
    padding:0 10px;
}

.commentcol{
    width:100%;
    font-size:18px;
    /* width:fit-content; */
    /* border:1px solid #000; */
    padding:2px 0;

}
</style>
</head>

<body>

<div class="view-project-page">
        
    <div class="view-page">
        <div class="view-header">
            Show Task 
        </div>
            <div class="row">
                <div class="col">
                    <label for="code"> Project  </label>
                    <?php echo $project?>     
                </div>
                <div class="col">
                    <label for="name"> Name </label>
                    <?php echo $task?>
                </div>
            </div>
       <div class="row date">
            <div class="col">
                <label for="start_date"> Start date </label>
                <?php echo $start_date?>
            </div>    
            <div class="col">
                <label for="end_date"> End date</label>
                <?php echo $end_date?>
            </div>
        </div>
        <div class="row">
            <div class="col">
               <label for="status"> Status </label>
                <?php echo $status?>
            </div>
        </div>
          <div class="row description"> 
             <div class="col">
                <label for="description"> Description </label>
                <?php echo $description?>
             </div>
          </div>
        <div class="assignUserList"> 
           <h2 class="assignUserListH2"> Users & Comment  </h2>   
           <div class="allUser">
    <?php
    if($assignUser != 'none') {
        $assignUsers = explode(",", $assignUser);
        
        foreach ($assignUsers as $user) {
            $user = (int)$user;     
        if($user>0){

            $queryUser = "SELECT * FROM users WHERE id = $user";
            $resultUser = mysqli_query($connect, $queryUser);
            
            // Check if query was successful and row exists
            if($resultUser && mysqli_num_rows($resultUser) > 0) {
                $rowUser = mysqli_fetch_assoc($resultUser);
                ?>
                <div class="row"> 
                    <div class="col user">
                        <?php echo $rowUser['name'] ?>
                        <div class="comments">
                            <?php
                            $queryComment = "SELECT * FROM comments 
                                            WHERE userid = '$user' 
                                            AND taskid = '$taskid'";
                                            $resultComment = mysqli_query($connect, $queryComment);
                                            
                                            // Check if comments query was successful
                                            if($resultComment) {
                                                while($rowComment = mysqli_fetch_assoc($resultComment)) {
                                                    ?>
                                    <div class="commentrow">
                                        <div class="commentdate">
                                            <?php echo $rowComment['created_date'] ?>  
                                        </div>
                                        
                                        <div class="commentcol">
                                            <?php echo $rowComment['comments'] ?>  
                                        </div>
                                    </div>
                                    <?php
                                }
                            } else {
                                echo "Error fetching comments: " . mysqli_error($connect);
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                echo "User with id $user not found.";
            }
        }     
     }
    }
    ?>
</div>


      </div>

            <a class="arow" href="index.php">
                <span class="backarrow">  ⬅️ </span>
                  Back
               </a>
        </div>  
</div>
</div>    
</body>

</html>