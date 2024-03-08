<?php 
include"nav.php";
$_i   = isset( $_GET['i'] ) ? escape_s($_GET['i']) : '';

?>

<!-- Main Wrapper -->
<div id="wrapper">

    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-display2"></i> Department Enrollment
                </h2>
            </div>
        </div>
    </div>




    <div class="content animate-panel">

      
        <div class="row">

            <div class="col-md-12">


                <div class="font-bold fa-lg m-b-sm">
                     Curriculum
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
$query = query("SELECT c.id AS c_id, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, DATE_FORMAT(c.date, '%a, %b %y') AS c_date, COUNT(p.progress) AS p_enrolled, SUM(p.progress  = '100' ) AS p_completed,  SUM(p.progress  != '100' ) AS p_inprogresss FROM $tbl_course AS c 
                LEFT JOIN $tbl_program AS p ON c.id = p.course
                GROUP BY c.id");
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $c_id         = $rows['c_id']; 
        $c_title      = $rows['c_title']; 
        $c_duration   = $rows['c_duration']; 
        $p_enrolled        = $rows['p_enrolled']; 
        $p_completed        = $rows['p_completed'];
        $p_inprogresss        = $rows['p_inprogresss'];
       // $lessontotal   = ($rows['lessontotal'] !=null)?$rows['lessontotal']:0; 
        //$assigtotal   = ($rows['assigtotal'] !=null)?$rows['assigtotal']:0; 

     ?>

                    <tr class="tr<?=$c_id?>">
                      <td><?=$c_title?></td>
                      <td><?=$p_enrolled?></td>
                      <td><?=$p_completed?></td>
                      <td><?=$p_inprogresss?></td>
                      <td>
                      <div class="btn-group btn-group-sm pull-right">                   
                        <a href="enrolled-course-open.php?i=<?=$c_id?>&n=<?=$c_title?>" class="btn btn-outline btn-primary2">
                            View Records </a>                          
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
