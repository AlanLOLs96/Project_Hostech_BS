<?php
include_once('common_connection.php');
include_once('inmate_session.php');
include_once('_includes/php/functions.php');

//echo date("h:i a");
//echo date("H:i:00");


function checkForPendingOutpass($admno,$connection){
  $checkstmt = "select * from outpass_details where admno = '".$admno."' and warden_reject = 0 and return_confirm is null ";
  $checkstmt_sql = $connection->query($checkstmt);
  return  mysqli_num_rows($checkstmt_sql);
}

if($_SERVER['REQUEST_METHOD']=="POST")
{
  $admno = $_POST['admno'];
  $issue_date = $_POST['issue_date'];
  $destination = $_POST['destination'];
  $purpose = $_POST['purpose'];
  $leaving_date = $_POST['leaving_date'];
  $leaving_time = $_POST['leaving_time'].":00";
  $return_date = $_POST['return_date'];
  $return_time = $_POST['return_time'].":00";

  $insert_stmt = "insert into outpass_details (admno,issue_date,destination,purpose,leaving_date,leaving_time,return_date,return_time,warden_approval
  ) values($admno,'$issue_date','$destination','$purpose','$leaving_date','$leaving_time','$return_date','$return_time',0)";

  if (!mysqli_query($connection, $insert_stmt))
    $alert_trigger = 0;
  else
    $alert_trigger=1;
}
?>

<!DOCTYPE html>
<html lang="en">

<?php include('_includes/page_head.html');?>
<?php include('_includes/links_script.html');?>

<body>
  <div class="container">

    <!--Navbar-->
    <?php include('_includes/page_inmate_navbar.html');?>
    <!--Navbar-->

    <div class="panel panel-default">
      <div class="panel-heading">
        <h3 class="panel-title">Out Pass Issue Form</h3>
      </div>
      <div class="panel-body">

        <!--Alert Function-->
        <?php if($_SERVER['REQUEST_METHOD']=='POST') alertmessage($alert_trigger,'Outpass Issued Successfully');  ?>
        <!--Alert Function-->

        <?php if(checkForPendingOutpass($inmate_details['admno'],$connection)!=0)
        {
          echo '<div class="alert alert-warning" id="dynamicalert">
          <strong>Hello</strong> You can only issue new outpass after retrun confirmation of the currently issued one
        </div>
        <script>
          $(document).ready(function(){
           $("input").prop("disabled", true);
         });     
       </script>
       ';
     }
     ?>

     <form class="well form-horizontal"  id='opissueform' action="inmate_home.php" method="post" name="outpass_issue" autocomplete="on"  >
      <fieldset>
       <div class="form-group">
        <label class="col-md-4 control-label">Admission No</label>
        <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
            <input  name="admno" placeholder="Admission No" class="form-control" value = <?= $inmate_details['admno']?> type="text">
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

      <!-- Date input-->

      <div class="form-group">
        <label class="col-md-4 control-label" >Issue Date</label>
        <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            <input name="issue_date" value= '<?= date('Y-m-d'); ?>'  min = '<?= date('Y-m-d'); ?>' class="form-control"  type="date"  required>
          </div>
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label">Destination</label>
        <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
            <input name="destination" placeholder="Destination" class="form-control"  type="text" required>
          </div>
        </div>
      </div>

      <!-- Text input-->
      <div class="form-group">
        <label class="col-md-4 control-label">Purpose</label>
        <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-map-marker"></i></span>
            <input name="purpose" placeholder="Purpose" class="form-control"  type="text" required>
          </div>
        </div>
      </div>

      <!-- Date input-->

      <div class="form-group">
        <label class="col-md-4 control-label" >Leaving Date</label>
        <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            <input name="leaving_date" id="sdate"  class="form-control"  type="date" min = '<?= date('Y-m-d'); ?>' required>
          </div>
        </div>
      </div>

      <!-- Leaving Time-->

      <div class="form-group">
        <label class="col-md-4 control-label">Leaving Time</label>
        <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
            <input name="leaving_time" id="leavetime" placeholder="Leaving Time" class="form-control" min = '<?= date("H:i:00");?>' type="time"  required>
          </div>
        </div>
      </div>

      <!-- Date input-->

      <div class="form-group">
        <label class="col-md-4 control-label" >Return Date</label>
        <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
            <input name="return_date" id="bdate" class="form-control"  type="date" onfocus="setDate()" required>
          </div>
        </div>
      </div>

      <!-- Time Input -->

      <div class="form-group">
        <label class="col-md-4 control-label">Return Time</label>
        <div class="col-md-4 inputGroupContainer">
          <div class="input-group">
            <span class="input-group-addon"><i class="glyphicon glyphicon-time"></i></span>
            <input name="return_time" id="returntime" placeholder="Return Time" class="form-control"  type="time" onfocus="setTime()" required>
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
</body>

<!--Scripts for bootstrap working-->

<!--Scripts for bootstrap working-->
<script type="text/javascript">
  function setDate()
  {
    var x=document.getElementById('sdate').value;
    document.getElementById('bdate').min=x;

  }

  function setTime()
  {
    var reset = '00:00';
    var today = new Date();
    today.toISOString().substring(0, 10);
    var dateleave = document.getElementById('sdate').value;
    var dateret = document.getElementById('bdate').value; 
    var time = document.getElementById('leavetime').value;
    console.log(time);
    if(dateleave!=today)
      document.getElementById('leavetime').min = reset;
    if (dateleave == dateret)
      document.getElementById('returntime').min = time;
    else
      document.getElementById('returntime').min = reset;
  }

</script>

</html>