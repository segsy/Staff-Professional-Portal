<?php 
include"nav.php";
?>

<!-- Main Wrapper -->
<div id="wrapper">

    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="#">Dashboard</a></li>
                        <li>
                            <span>Questions</span>
                        </li>
                        <li class="active">
                            <span>Inbox</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-display2"></i> All Courses
                </h2>
                <small>view and enroll for a course</small>
            </div>
        </div>
    </div>



    <div class="content animate-panel">


        <div class="row projects">


<?php 

$query = query("SELECT cs.title AS cs_title, c.id AS c_id, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, c.summary AS c_summary, COUNT(l.id) AS lessontotal FROM $tbl_course AS c 
                LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id
                LEFT JOIN $tbl_category AS cs ON c.category = cs.id
                WHERE c.status = '1'
                GROUP BY l.course_id");
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $c_id         = $rows['c_id'];; 
        $c_title      = $rows['c_title'];; 
        $cs_title     = $rows['cs_title'];; 
        $c_summary    = $rows['c_summary'];; 
        $c_duration   = $rows['c_duration'];; 
        $lessontotal   = $rows['lessontotal']; 
?>

            <div class="col-lg-6">
                  <div class="font-bold m-b-sm">
                     <?=strtoupper($cs_title)?> <!---->
                </div>
                <div class="hpanel hgreen">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <h4 style="line-height: 26px"><a href="course-details.php?id=<?=$c_id?>"><?=$c_title?></a></h4>
                                <p><?=substr($c_summary, 0, 230)?>...</p>

                                <div class="row">
                                    <div class="col-sm-5">
                                        <div class="project-label"><strong>Duration</strong></div>
                                        <small><?=$c_duration?></small>
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="project-label"><strong>Lesson</strong></div>
                                        <small><?=$lessontotal?> Lessons</small>
                                    </div>

                                </div>
                            </div>
                            <div class="col-sm-4 project-info p-l-none">
                                <a href="course-details.php?id=<?=$c_id?>">
                                    <img src="upload/<?=$c_id?>.jpg" alt="<?=$c_title?>" class="img-responsive">
                                  </a>  
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer hidden">
                        Additional information about course in footer
                    </div>
                </div>
            </div>

<?php } ?>








    </div>


       
        
        
        <!-- /page content -->
<?php include"footer.php";?>
