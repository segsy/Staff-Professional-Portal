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
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-display2"></i> <?=$_GET['n']?> Lessons
                </h2>
            </div>
        </div>
    </div>




    <div class="content animate-panel">

      
        <div class="row">

            <div class="col-md-12">


                <div class="font-bold fa-lg m-b-sm">
                     
                </div>

                <div class="hpanel">

                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr class="headings">
                                <th class="column-title">Lesson </th>
                                <th class="column-title">Title </th>
                                <th class="column-title">Duration </th>
                                <th class="column-title">Date Created</th>
                                <th class="column-title">Action</th>
                              </tr>
                            </thead>

                            <tbody>

<?php

$query = query("SELECT l.id, l.title, l.lesson, l.date, l.duration FROM $tbl_lesson AS l
 WHERE l.type='l' AND l.course_id = '$_i' ORDER By l.lesson ASC");

while($rows=mysqli_fetch_array($query)){
    /*
    print_r($rows);*/

        $id        = $rows['id'];; 
        $title     = $rows['title']; 
        $lesson    = $rows['lesson'];
        $duration  = $rows['duration']; 
        $date  = $rows['date']; 



     ?>

                    <tr class="tr<?=$id?>">
                      <td><?=$lesson?></td>
                      <td><?=$title?></td>
                      <td><?=$duration?></td>
                      <td><?=$date?></td>
                      <td>
                      <div class="btn-group btn-group-sm pull-right">
                        <button data-id="<?=$id?>" data-type="lesson" data-name="<?=$title?>" class="del<?=$id?> btn btn-outline btn-danger btn-delete ladda-button" data-style="zoom-out"> <i class="pe pe-7s-trash fa-lg"></i> Delete </button>
                        <a href="lesson-edit.php?i=<?=$id?>" class="btn btn-outline btn-info">
                        <i class="pe pe-7s-pen fa-lg"></i> Edit Lesson </a>
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
<script src="scripts/table-core.js?tyt"></script><!--   -->
