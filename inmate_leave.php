<?php
include_once('common_connection.php');
include_once('inmate_session.php');
include_once('_includes/php/functions.php');

//echo date("h:i a");

if ($_SERVER['REQUEST_METHOD']=='POST') {
  $admno = $_POST['admno'];
  $roomno = $_POST['roomno'];
  $date_applied = $_POST['date_applied'];
  $reason = $_POST['reason'];
  $start_time = $_POST['start_time'].":00";
  $end_time = $_POST['end_time'].":00";


  $insert_stmt = "insert into sick_leave_details (admno,roomno,date_applied,reason,start_time,end_time) values($admno,$roomno,'$date_applied','$reason','$start_time','$end_time')" ;

  if (!mysqli_query($connection, $insert_stmt))
    $alert_trigger = 0;
  else
    $alert_trigger=1;
}



?>

<!DOCTYPE html>
<html lang="en">

<?php include('_includes/page_head.html');?>

<body>
  <div class="container">

    <!--Navbar-->
    <?php include('_includes/page_inmate_navbar.html');?>
    <!--Navbar-->

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Issue Sick Leave</h3>
      </div>
      <div class="panel-body">

        <!--Alert Function-->
        <?php if($_SERVER['REQUEST_METHOD']=='POST') alertmessage($alert_trigger,'Leave Issued Successfully');  ?>
        <!--Alert Function-->

        <form id="inmate_leave_form" class="well form-horizontal" action="inmate_leave.php" method="post" autocomplete="on">
          <fieldset>

            <!-- Admission N0-->
            <div class="form-group">
              <label class="col-md-4 control-label">Admission No</label>
              <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input  name="admno" placeholder="Admission No" class="form-control" value = <?= $inmate_details['admno']?> type="text"  required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Name</label>
              <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input  name="name" placeholder="Full Name" class="form-control" value = '<?php echo $inmate_details['fullname'] ?>' type="text"  required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Room No</label>
              <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input  name="roomno" placeholder="Room No" class="form-control" value = '<?php echo $inmate_details['roomno'] ?>' type="text"  required>
                </div>
              </div>
            </div>

            <!-- Date input-->

            <div class="form-group">
              <label class="col-md-4 control-label" >Date of Application</label>
              <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  <input name="date_applied" min = '<?= date('Y-m-d'); ?>' value= '<?= date('Y-m-d'); ?>' class="form-control"  type="date"  required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Reason of Leave</label>
              <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                  <input name="reason" placeholder="Specify Reason" class="form-control"  type="text" required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Start Time</label>
              <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <input name="start_time"  class="form-control"  type="time" min = '<?= date("H:i:00");?>'  required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">End Time</label>
              <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
                  <input name="end_time"  class="form-control"  type="time" min = '<?= date("H:i:00");?>' required>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-6 inputGroupContainer">
                <div class="form-group text-right buttonright">
                  <input class="btn btn-primary" type="submit" value="Submit">
                </div>
              </div>
              <div class="col-md-6 inputGroupContainer">
                <div class="form-group text-left buttonleft">
                  <input class="btn btn-primary" type="reset" value="Reset">
                </div>
              </div>
            </div>
          </fieldset>
        </form>
      </div>
    </div>
  </div>
</body>

<!--Scripts for bootstrap working-->
<?php include('_includes/links_script.html');?>
<!--Scripts for bootstrap working-->

</html>