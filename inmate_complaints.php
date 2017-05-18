<?php
include_once('common_connection.php');
include_once('inmate_session.php');
include_once('_includes/php/functions.php');

if ($_SERVER['REQUEST_METHOD']=='POST') {
  $admno = $_POST['admno'];
  $roomno = $_POST['roomno'];
  $type = $_POST['ctype'];
  $description = $_POST['description'];
  $complaint_date = $_POST['complaint_date'];

  $insert_stmt = "insert into complaint_details (admno,roomno,complaint_type,description,complaint_date) values($admno,$roomno,'$type','$description','$complaint_date')" ;

  if (!mysqli_query($connection, $insert_stmt))
    $alert_trigger=0;
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
        <h3 class="panel-title">Post Complaint</h3>
      </div>

      <div class="panel-body">

        <!--Alert Function-->
        <?php if($_SERVER['REQUEST_METHOD']=='POST') alertmessage($alert_trigger,'Complaint Poseted Successfully');  ?>
        <!--Alert Function-->

        <form id="complaints_form" class="well form-horizontal" action="inmate_complaints.php" method="post" autocomplete="on">
          <fieldset>
            <!-- Admission N0-->
            <div class="form-group">
              <label class="col-md-4 control-label">Admission No</label>
              <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                  <input  name="admno" placeholder="Admission No" class="form-control" value = <?= $inmate_details['admno']?> type = "text"  required>
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
              <label class="col-md-4 control-label" >Complaint Date</label>
              <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                  <input name="complaint_date" value= '<?= date('Y-m-d'); ?>' min = '<?= date('Y-m-d'); ?>' class="form-control"  type="date"  required>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label " for="exampleSelect1">Select Complaint Type</label>
              <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                  <select name = "ctype" class="form-control dropdown-menu complaintcustom" id="exampleSelect1" required>
                    <option>Furniture</option>
                    <option>Lighting</option>
                    <option>Wiring</option>
                    <option>Plumbing</option>
                    <option>Others</option>
                  </select>
                </div>
              </div>
            </div>

            <div class="form-group">
              <label class="col-md-4 control-label">Description</label>
              <div class="col-md-4 inputGroupContainer">
                <div class="input-group">
                  <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
                  <!--<input name="reason" placeholder="Specify Reason" class="form-control"  type="text" rows = "3"> -->
                  <textarea name="description" form="complaints_form" class="form-control" id="exampleTextarea" rows="3" required></textarea>
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