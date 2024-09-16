<?php
 include('../includes/connection.php');
 session_start();

 if(isset($_POST['adminLogin'])){
     $email = trim($_POST['email']);
     $password = trim($_POST['password']);
     
     $query = "SELECT * FROM `admins` WHERE `email` = '$email' AND `password` = '$password'";
     
     $result = mysqli_query($connect, $query);
     if(mysqli_num_rows($result) > 0){
         
         $userdata = mysqli_fetch_array($result);    
         $_SESSION['name'] = $userdata['name'];
         $_SESSION['email'] =  $_POST['email'];
         $_SESSION['password'] =  $_POST['password'];
        
        echo "<script>
        console.log('Admin exists ...');     
        window.location.href='admin_dashboard.php';
        </script>";      
        }else{
            echo "<script>
             alert('Invalid Credentials.');
                window.location.href='admin.php';
             </script>";   
         }
 }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> TT | Admin_Login</title>
    <link rel="stylesheet" href="../css/loginPage.css">
</head>

<body>
    <div class="login_container">
        <header>
            <h1 style="background-color:crimson;">Admin Login</h1>
        </header>
        <div class="login_form">
            <form action="" method="POST">
                <div class="icon">
                    <img width="48" height="48" src="https://img.icons8.com/color/48/new-post.png" alt="new-post" />
                    <input type="email" name="email" id="email" placeholder="Enter email" required>
                </div>
                <div class="icon">
                    <img src="../images/password.png" alt="password">
                    <input type="password" name="password" id="password" placeholder="Enter password" required>
                </div>

                <input id="loginbtn" type="submit" name="adminLogin" style="background-color:crimson;" value="Login">
                <a class="back" href="../index.php">
                    <img width="58" height="58" src="https://img.icons8.com/color/48/circled-left--v1.png"
                        alt="circled-left--v1" />
                </a>
            </form>
        </div>
    </div>
</body>

</html>