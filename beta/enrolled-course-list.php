<?php 
include"nav.php";
$_c   = isset( $_GET['i'] ) ? escape_s($_GET['i']) : '';
$_n   = isset( $_GET['n'] ) ? escape_s($_GET['n']) : '';

?>

<!-- Main Wrapper -->
<div id="wrapper">

    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-display2"></i> <?=substr($_n, 0, 40)?>... Enrollment List
                </h2>
            </div>
        </div>
    </div>




    <div class="content animate-panel">

      
        <div class="row">

            <div class="col-md-12">


                <div class="font-bold fa-lg m-b-sm">
                     Staff List
                </div>

                <div class="hpanel">

                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr class="headings">
                                <th class="column-title">Title </th>
                                <th class="column-title">Name </th>
                                <th class="column-title">Department </th>
                                <th class="column-title">Job Family </th>
                                <th class="column-title">Date </th>
                              </tr>
                            </thead>

                            <tbody>

<?php
$query = query("SELECT p.date, u.deptname, u.title AS u_title, u.firstname AS u_firstname, u.lastname AS u_lastname, p.progress, jobfamilyname, designation, DATE_FORMAT(p.date, '%e-%m-%y %r') AS format_date FROM training_program AS p
LEFT JOIN training_user AS u ON p.user = u.id
WHERE p.course = '$_c'");
/*
$query = query("SELECT c.id AS c_id, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, DATE_FORMAT(c.date, '%a, %b %y') AS c_date, COUNT(p.progress) AS p_enrolled, SUM(p.progress  = '100' ) AS p_completed,  SUM(p.progress  != '100' ) AS p_inprogresss FROM $tbl_course AS c 
                LEFT JOIN $tbl_program AS p ON c.id = p.course
                GROUP BY c.id");
                */
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $u_title        = $rows['u_title']; 
        $u_firstname    = $rows['u_firstname']; 
        $u_lastname     = $rows['u_lastname']; 
        $progress       = $rows['progress']; 
        $jobfamilyname  = $rows['jobfamilyname'];
        $date    = $rows['format_date'];
        $designation    = $rows['designation'];
        $deptname    = $rows['deptname'];
       // $lessontotal   = ($rows['lessontotal'] !=null)?$rows['lessontotal']:0; 
        //$assigtotal   = ($rows['assigtotal'] !=null)?$rows['assigtotal']:0; 

     ?>
                    <tr>
                      <td><?=$u_title?></td>
                      <td><?=$u_firstname?> <?=$u_lastname?></td>
                      <td><?=$deptname?></td>
                      <td><?=$jobfamilyname?></td>
                      <td><?=$date?></td>
                    </tr>

<?php } ?>

                         
                        </tbody>
                      </table>






                    </div>

                </div>
            </div>




    </div>


       
        
        
        
<?php include"footer.php";?>
<script src="vendor/sweetalert/lib/sweet-alert.min.js"></script>
<script src="vendor/ladda/dist/spin.min.js"></script>
<script src="vendor/peity/jquery.peity.min.js"></script>
<script src="vendor/ladda/dist/ladda.min.js"></script>
<script src="vendor/ladda/dist/ladda.jquery.min.js"></script>
<script language="javascript">
$(function () {
  
      $("span.pie").peity("pie", {
        fill: ["#62cb31", "#edf0f5"]
    });
});
</script>
<script src="scripts/table-core.js"></script><!--   -->
