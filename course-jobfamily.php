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
                            <span>COurse</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs text-info">
                   <i class="pe pe-7s-display2"></i> View Job Family Courses
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
                                <th class="column-title">Category </th>
                                <th class="column-title">Duration </th>
                                <th class="column-title">Status</th>
                                <th class="column-title">Date Created</th>
                                <th class="column-title">Action</th>
                              </tr>
                            </thead>

                            <tbody>

<?php

$query = query("SELECT jb.name,c.id, c.title, c.date, c.visibility, c.duration, c.category, c.status 
  FROM $tbl_course AS c
  LEFT JOIN $tbl_jobfamily AS jb ON c.category = jb.id
  WHERE visibility='2' ORDER By date DESC");

while($rows=mysqli_fetch_array($query)){
    /*
    print_r($rows);*/

        $id        = $rows['id'];; 
        $title     = $rows['title']; 
        $category  = $rows['name'];
        $duration  = $rows['duration']; 
        $visibility  = $rows['visibility']; 
        // $status  = $rows['status']; 
        $date  = $rows['date']; 
          switch ($rows['status']) {
            case '1':
               $status = "<span class='label label-primary'>Enabled<span>";
              break;
            case '0':
                $status = "<span class='label label-danger'>Disabled<span>";
              break;
          }

// $query = query("SELECT ct.id AS c_id, ct.title AS c_title, ct.date AS c_date, COUNT(cs.id) AS cstotal FROM $tbl_category AS ct 
//                 LEFT JOIN $tbl_course AS cs ON ct.id = cs.category
//                 GROUP BY ct.id  ORDER BY ct.date DESC");
// while($rows=mysqli_fetch_array($query)){
//  // print_r($rows);
//         $c_id         = $rows['c_id'];; 
//         $c_title      = $rows['c_title'];; 
//         $c_date        = $rows['c_date'];; 
//         $cstotal   = $rows['cstotal']; 

     ?>
                    <tr class="tr<?=$id?>">
                      <td><?=strlen($title) >= 70 ? substr($title, 0, 69) .' ...' : $title?></td>
                      <td><?=$category?></td>
                      <td><?=$duration?></td>
                      <td><?=$status?></td>
                      <td><?=$date?></td>
                      <td>
                      <div class="btn-group btn-group-sm pull-right">
                        <button data-id="<?=$id?>" data-type="course" data-name="<?=$title?>" class="del<?=$id?> btn btn-outline btn-danger btn-delete ladda-button" data-style="zoom-out"> <i class="pe pe-7s-trash fa-lg"></i>  </button>
                        <a href="course-new-add-lesson.php?cs=<?=$id?>" class="btn btn-outline btn-info"><i class="pe pe-7s-play fa-lg"></i> View Videos </a>
                        <a href="course-edit.php?i=<?=$id?>" class="btn btn-outline btn-primary"><i class="pe pe-7s-pen fa-lg"></i> Edit </a>
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
