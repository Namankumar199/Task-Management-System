<?php

include('../../includes/connection.php');
 $query = "SELECT * FROM project WHERE id = $_GET[id]";
 $result = mysqli_query($connect,$query);
 
 if (mysqli_num_rows($result) > 0) {
   // output data of each row
  $row = mysqli_fetch_assoc($result);
  $code = $row['code'];
  $category = $row['category'];
  $department = $row['department'];
  $name = $row['name'];
  $price = $row['price'];
  $start_date = $row['start_date'];
  $end_date = $row['end_date'];
   $status = $row['status'];
  $description = $row['description'];
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View || TT </title>
    <!-- <link rel="stylesheet" href="../../css/dataPageStyle.css"> -->
    <link rel="stylesheet" href="../../css/viewPageStyle.css">

    <style>
 @media screen and (width<=1200px) {
    .project-table{
        overflow:scroll;
    }
 }
 </style>

</head>


<body>

<div class="view-project-page">
        
    <div class="view-page">
        <div class="view-header">
            Show Projects 
        </div>
            <div class="row">
                <div class="col">
                    <label for="code"> Code  </label>
                    <?php echo $code?>     
                </div>
                <div class="col">
                    <label for="name"> Name  </label>
                    <?php echo $name?>
                </div>
            </div>

        <div class="row">
            <div class="col"> 
                <label for="project"> Project category </label>
                <?php echo $category?>
            </div>
            <div class="col">
              <label for="department"> Departemnt </label>
               <?php echo $department?>
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
                <label for="price"> Price</label> 
                <?php echo $price?>
            </div>
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
          
              <a class="arow" href="index.php">
                <span class="backarrow">  ⬅️ </span>
                  Back
               </a>
          
        </div>      
<div class="project-container">   
        <div class="project-body">
            <div class="project-btn">
                <h2>Project Tasks</h2>
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
                    <td>Description</td>
                   
                </tr>
            </thead>
            <tbody>
                <?php
                $sno = 1;
                $query = "SELECT * FROM task WHERE project = '$name'";
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
                    <td><?php echo $row['description']?></td>
                  
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
</div>
</div>    
    <?php
        function addDaysToDate($dateString, $numberOfDays=0) {
        $newDateTimestamp = strtotime($dateString . ' +' . $numberOfDays . ' days');
        $newDate = date('d-m-Y', $newDateTimestamp);
        return $newDate;
         }   
     ?>   
</body>
<script>

document.getElementById('searchInput').addEventListener('input', function () {
   var searchText = this.value.toLowerCase();
   console.log('search clicked');
   var tableRows = document.querySelectorAll('tbody tr');

   tableRows.forEach(function (row) {
      var id = String(row.cells[0].textContent).toLowerCase();
      var project = row.cells[1].textContent.toLowerCase();
      var task = row.cells[2].textContent.toLowerCase();
      var status = row.cells[4].textContent.toLowerCase();

      if (id.includes(searchText)
         || project.includes(searchText)
         || task.includes(searchText)
         || status.includes(searchText)
      ) {
         row.style.display = '';
      } else {
         row.style.display = 'none';
      }
   });
});

    </script>
</html>