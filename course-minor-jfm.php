<?php 
include("lib/config.php");

include("nav-all.php");
?>

<?php 
// include"nav2.php";
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
                <div class="row">
                    <div class="col-lg-6">
                      <h2 class="font-light m-b-xs">
                         <i class="pe pe-7s-display2"></i> View All Courses
                      </h2>
                      <small>view and manage all course</small>
                    </div>
                    <div class="col-lg-6" style="text-align: right;">
                        <h4><span class="label label-primary"><?= $_SESSION['_q_user']['_fname'];?> Job Family</span></h4>
                    </div>
                </div>
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
                                <th class="column-title">Courses </th>
                                <!-- <th class="column-title">Date</th> -->
                                <th class="column-title">Action</th>
                              </tr>
                            </thead>

                            <tbody>

<?php
$query = query("SELECT ct.id AS c_id, ct.title AS c_title, ct.date AS c_date, COUNT(cs.id) AS cstotal FROM $tbl_category AS ct 
                LEFT JOIN $tbl_course AS cs ON ct.id = cs.category
                GROUP BY ct.id  ORDER BY ct.date DESC");
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $c_id         = $rows['c_id'];; 
        $c_title      = $rows['c_title'];; 
        $c_date        = $rows['c_date'];; 
        $cstotal   = $rows['cstotal']; 

     ?>

                    <tr class="cat<?=$c_id?>">
                      <td class="tdcourse"><?=$c_title?> Category</td>
                      <td><?=$cstotal?></td>
                      <!-- <td><?=$c_date?></td> -->
                      <td>
                      <div class="btn-group btn-group-sm pull-right">
                        <a href="category-open.php?i=<?=$c_id?>&n=<?=$c_title?>" class="btn btn-outline btn-info">
                        <i class="fa fa-file-text fa-lg"></i> View Course </a>
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
