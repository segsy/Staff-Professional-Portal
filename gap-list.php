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
                            <span>Gap</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs text-danger">
                   <i class="pe pe-7s-display2"></i> View Gap analyst assessment
                </h2>
                <small>view and manage assessment form</small>
            </div>
        </div>
    </div>




    <div class="content animate-panel">

      
        <div class="row">

            <div class="col-md-12">


                <div class="font-bold fa-lg m-b-sm">
                     ASSESSMENT FORM
                </div>

                <div class="hpanel">

                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr class="headings">
                                <th class="column-title">Name </th>
                                <th class="column-title">Department </th>
                                <th class="column-title">Job Function </th>
                                <th class="column-title">Take Course</th>
                                <th class="column-title">Job Performance</th>
                                <th class="column-title">Date Created</th>
                                <th class="column-title">Action</th>
                              </tr>
                            </thead>

                            <tbody>

<?php
// die();
$query = query("SELECT id, title, firstname, lastname, department, jobfunction, take_course, jobPerf, date_created, status FROM training_gap ORDER By date_created DESC");
while($rows=mysqli_fetch_array($query)){
        $id        = $rows['id'];
        $title     = $rows['title']; 
        $firstname  = $rows['firstname'];
        $lastname  = $rows['lastname'];
        $take_course  = $rows['take_course'];
        $department  = $rows['department']; 
        $jobfunction  = $rows['jobfunction']; 
        $jobPerf  = $rows['jobPerf']; 
        $status  = $rows['status']; 
        $date  = $rows['date_created']; 
          switch ($take_course) {
            case 'yes':
               $takecourse = "<span class='label label-primary'>Yes<span>";
              break;
            case 'no':
                $takecourse = "<span class='label label-danger'>No<span>";
              break;
          }
     ?>
                    <tr class="tr<?=$id?>">
                      <td><?=$title.' '.$firstname.' '.$lastname ?></td>
                      <td><?=$department?></td>
                      <td><?=$jobfunction?></td>
                      <td><?=$takecourse?></td>
                      <td><?=$jobPerf?></td>
                      <td><?=$date?></td>
                      <td>
                      <div class="btn-group btn-group-sm pull-right">
                        <a href="gap-assessment-details.php?gap=<?=$id?>" class="btn btn-outline btn-info"><i class="pe pe-7s-file fa-lg"></i> View Assessment </a>
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
