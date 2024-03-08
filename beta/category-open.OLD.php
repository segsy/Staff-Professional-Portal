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
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li class="active">
                            <span>Add A New COurse</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-display2"></i> <?=$_GET['n']?> Courses
                </h2>
                <small>view and manage all course</small>
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
                                <th class="column-title">Duration </th>
                                <th class="column-title">Lesson </th>
                                <th class="column-title">Assign. </th>
                                <th class="column-title">Date</th>
                                <th class="column-title">Action</th>
                              </tr>
                            </thead>

                            <tbody>

<?php
$query = query("SELECT c.id AS c_id, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, DATE_FORMAT(c.date, '%a, %b %y') AS c_date, SUM(l.type  = 'l' ) AS lessontotal,  SUM(l.type  = 'a' ) AS assigtotal FROM $tbl_course AS c 
                LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id
                WHERE c.category = '$_i'
                GROUP BY c.id");
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $c_id         = $rows['c_id'];; 
        $c_title      = $rows['c_title'];; 
        $c_duration   = $rows['c_duration'];; 
        $c_date        = $rows['c_date'];; 
        $lessontotal   = ($rows['lessontotal'] !=null)?$rows['lessontotal']:0; 
        $assigtotal   = ($rows['assigtotal'] !=null)?$rows['assigtotal']:0; 

     ?>

                    <tr class="tr<?=$c_id?>">
                      <td><?=$c_title?></td>
                      <td><?=$c_duration?></td>
                      <td><?=$lessontotal?></td>
                      <td><?=$assigtotal?></td>
                      <td><?=$c_date?></td>
                      <td>
                      <div class="btn-group btn-group-sm pull-right">
                        <button data-id="<?=$c_id?>" data-type="course" data-name="<?=$c_title?>" class="del<?=$c_id?> btn btn-outline btn-danger btn-delete ladda-button" data-style="zoom-out"> <i class="pe pe-7s-trash fa-lg"></i> </button>
                        <a href="course-edit.php?i=<?=$c_id?>" data-c-name="<?=$c_title?>" class="btn btn-outline btn-info">
                        <i class="pe pe-7s-pen fa-lg"></i></a>
                        <a href="course-assignment.php?i=<?=$c_id?>&n=<?=$c_title?>" class="btn btn-outline btn-success">
                        <i class="pe pe-7s-help1 fa-lg"></i> Assignm. </a>                     
                        <a href="course-open.php?i=<?=$c_id?>&n=<?=$c_title?>" class="btn btn-outline btn-primary2">
                        <i class="fa fa-file-text fa-lg"></i> Lesson </a>                          
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
