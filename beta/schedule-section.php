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
                   <i class="pe pe-7s-display2"></i> Select Course
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
                                <th class="column-title">Sections </th>
                                <th class="column-title">Action</th>
                              </tr>
                            </thead>

                            <tbody>

<?php
$query = query("SELECT d.title, d.id, COUNT(s.id) AS count
FROM training_course AS d
LEFT JOIN training_section AS s ON d.id =s.course
GROUP BY d.id
ORDER BY count DESC");
/*
$query = query("SELECT c.id AS c_id, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, DATE_FORMAT(c.date, '%a, %b %y') AS c_date, COUNT(p.progress) AS p_enrolled, SUM(p.progress  = '100' ) AS p_completed,  SUM(p.progress  != '100' ) AS p_inprogresss FROM $tbl_course AS c 
                LEFT JOIN $tbl_program AS p ON c.id = p.course
                GROUP BY c.id");
                */
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $c_id         = $rows['id']; 
        $c_title      = $rows['title']; 
        $count        = $rows['count']; 
     ?>

                    <tr>
                      <td><?=$c_title?></td>
                      <td><?=$count?></td>
                      <td>
                      <div class="btn-group btn-group-sm pull-right">
                        <a href="schedule-section-open.php?i=<?=$c_id?>&n=<?=$c_title?>" class="btn btn-outline btn-success">
                            View Section </a>                                              
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
