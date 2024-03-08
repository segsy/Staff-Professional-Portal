<?php 
include("lib/config.php");

include("nav-all.php");
?>

<?php 
// include"nav.php";
$_i   = isset( $_GET['i'] ) ? escape_s($_GET['i']) : '';
$_n   = isset( $_GET['n'] ) ? escape_s($_GET['n']) : '';

?>

<!-- Main Wrapper -->
<div id="wrapper">

    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">
                            <span>Add A New COurse</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-display2"></i> <?=substr($_n, 0, 30)?>... Course Subscriptions
                </h2>
            </div>
        </div>
    </div>




    <div class="content animate-panel">

      
        <div class="row">

            <div class="col-md-12">


                <div class="font-bold fa-lg m-b-sm">
                     Department
                </div>

                <div class="hpanel">

                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr class="headings">
                                <th class="column-title">Title </th>
                                <th class="column-title">Enrolled </th>
                                <th class="column-title">Completed </th>
                                <th class="column-title">In Progress</th>
                                <th class="column-title">Action</th>
                              </tr>
                            </thead>

                            <tbody>

<?php
$query = query("SELECT p.course, p.id AS p_id, d.id AS d_id, d.name AS d_name, COUNT(d.id) AS d_record, SUM(p.progress  = '100' ) AS p_completed,  SUM(p.progress  != '100' ) AS p_inprogresss FROM training_program AS p
 LEFT JOIN training_dept AS d ON (p.dept = d.id)
 WHERE p.course='$_i' AND p.dept IS NOT NULL
GROUP BY d.id ORDER BY d_record DESC");
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $p_id     = $rows['p_id']; 
        $d_id     = $rows['d_id']; 
        $d_name   = $rows['d_name']; 
        $d_record        = $rows['d_record']; 
        $p_completed        = $rows['p_completed'];
        $p_inprogresss        = $rows['p_inprogresss'];
       // $lessontotal   = ($rows['lessontotal'] !=null)?$rows['lessontotal']:0; 
        //$assigtotal   = ($rows['assigtotal'] !=null)?$rows['assigtotal']:0; 
     ?>
                    <tr class="tr<?=$d_id?>">
                      <td><?=$d_name?></td>
                      <td><?=$d_record?></td>
                      <td><?=$p_completed?></td>
                      <td><?=$p_inprogresss?></td>
                      <td>
                      <div class="btn-group btn-group-sm pull-right">
                        <a href="enrolled-course-dept-overview.php?d=<?=$d_id?>&c=<?=$_i?>&n=<?=$_n?>" class="btn btn-outline btn-info">
                        <i class="fa fa-file-text fa-lg"></i> Overview </a>                     
                        
                        </div> 
                      </td><!--   -->
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
<script src="vendor/ladda/dist/ladda.min.js"></script>
<script src="vendor/ladda/dist/ladda.jquery.min.js"></script>
<script src="scripts/table-core.js"></script><!--   -->
