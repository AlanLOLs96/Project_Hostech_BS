<?php
include_once('common_connection.php');
include_once('inmate_session.php');
include_once('_includes/php/functions.php');

$c_hist_fetch_sql_stmt = "select * from complaint_details where admno = '".$inmate_details['admno']."' " ;
$c_hist_sql = $connection->query($c_hist_fetch_sql_stmt);
$c_hist_details = $c_hist_sql->fetch_all(MYSQLI_ASSOC);


foreach ($c_hist_details as $arrayob => $novalue) 
  {unset($c_hist_details[$arrayob]['admno']);
unset($c_hist_details[$arrayob]['roomno']);}

function printresult($arraylist){
  foreach ($arraylist as $arrayob => $novalue) {
    echo "<tr>";
    echo "<td>".$arraylist[$arrayob]['comp_no']."</td>";
    echo "<td id = 'alignleft'>".$arraylist[$arrayob]['complaint_type']."</td>";
    echo "<td id = 'alignleft' >".$arraylist[$arrayob]['description']."</td>";
    echo "<td>".$arraylist[$arrayob]['complaint_date']."</td>";
    if ($arraylist[$arrayob]['fixing_date']==NULL)
      echo "<td>PENDING</td>";
    else
      echo "<td>".$arraylist[$arrayob]['fixing_date']."</td>";
    echo "</tr>";
  }
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
    <div class="panel panel-primary">
      <div class="panel-heading">
        <h3 class="panel-title ">ISSUED COMPLAINTS HISTORY</h3>
      </div>
      <div class="panel-body">
        <table class="table table-striped" id="complainthistorytable">
          <thead>
            <tr>
              <th>Complaint#</th>
              <th id = 'alignleft'>Type</th>
              <th id = 'alignleft'>Description</th>
              <th>Issue Date</th>
              <th>Fixed Date</th>           
            </tr>
          </thead>
          <tbody>
            <?php printresult($c_hist_details); ?>           
          </tbody>
        </table>
      </div>
    </div>
  </div>
</body>

 <!--Scripts for bootstrap working-->
  <?php include('_includes/links_script.html');?>
 <!--Scripts for bootstrap working-->

 <script> 
  $(document).ready(function() {
    $('#complainthistorytable').DataTable();
  } );  
</script>

