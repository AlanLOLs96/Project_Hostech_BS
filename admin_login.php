<?php

include('common_connection.php');


if($_SERVER['REQUEST_METHOD']=="POST")
{
  session_start();
  $uname = $_POST['username'];
  $pass = $_POST['password'];

  $sql = "select * from admin_details where username = '$uname' and password = PASSWORD('$pass')" ;
  $stmt = $connection->query($sql);
  $user_details = $stmt->fetch_array(MYSQLI_ASSOC);

  $count = mysqli_num_rows($stmt);

  if($count==1){
    $_SESSION['login_user'] = $uname;
    if($user_details['role']=='admin')
      header("location: admin_home.php");
    else
      header("location: assist_home.php");
  }
  else
    $err = "Wrong Username or Password";
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <title>Hostech Login</title>

  <!-- Bootstrap -->
  <link href="styles/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="styles/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="styles/custom.css" rel="stylesheet"></head>

  <body class="login">
    <div>
      <div class="login_wrapper">
        <div class="login_form">
          <section class="login_content">
            <form action="admin_login.php" method="POST" >
              <h1>Admin Sign In</h1>
              <div>
                <input type="text" class="form-control"  name="username" placeholder="Username" required="" />
              </div>
              <div>
                <input type="password" class="form-control" name="password" placeholder="Password" required="" />
              </div>

              <?php
              if($_SERVER['REQUEST_METHOD']=="POST")
              {
               echo "<div class='alert alert-danger' role='alert'>";
               echo "<span class='glyphicon glyphicon-exclamation-sign' aria-hidden='true'></span>";
               echo "<span class='sr-only'>Error:</span>";
               echo "<p>Incorrect Username or Password</p>" ;
               echo "</div>" ;
             }

             ?>


             <div>
              <input class="btn btn-default submit spec-but" type="submit" value="Log in">
            </div>

            <div class="clearfix"></div>

            <div class="separator">
              <p class="change_link">
                <a href="index.php" class="login_content"> Log in as Inmate </a>
              </p>

              <div class="clearfix"></div>
              <br />

              <div>
                <h1><i class="fa fa-building"></i> HOSTECH</h1>
                <p>©2016 All Rights Reserved.</p>
              </div>
            </div>
          </form>
        </section>
      </div>

    </div>
  </div>
</body>
</html>
