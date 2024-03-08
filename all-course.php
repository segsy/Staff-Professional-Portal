<?php 
include("lib/config.php");

include("nav-all.php");
include("popup_nudget.php");
?>

<?php 
// include"nav.php";
?>

<style type="text/css">
    .hpanel.hgreen .panel-body {
    min-height: 249px;
}
</style>
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
                <div class="row">
                    <div class="col-lg-6">
                        <h2 class="font-light m-b-xs">
                           <i class="pe pe-7s-display2"></i> All Courses
                        </h2>
                        <small>view and enroll for a course</small>
                    </div>
                    <div class="col-lg-6" style="text-align: right;">
                        <h4><span class="label label-primary"><?= $_SESSION['_q_user']['_jobfamilyname'];?> Professional Job Family</span></h4>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div class="content animate-panel">

        <div class="row projects">


<?php 
/*
Array
(
    [_id] => 105057
    [_title] => Brother
    [_email] => epebinuoluwafemi@loveworld360.com
    [_fname] => Oluwafemi
    [_lname] => Epebinu
    [_dept] => 143
    [_deptname] => LoveWorld New Media
    [_jobfamily_id] => 1
    [_jobfamilyname] => Loveworld Media
    [_professionalCategoryID] => 3
    [_professionalCategoryName] => IT
    [_img] => https://www.blwstaffportal.org/user_res/picture/j/105057.jpg
    [_designation] => Web Developer in Training
    [_rank] => Senior Officer
    [_rank_id] => 2
    [_gender] => Male
    [_nationality] => Nigeria
    [_new] => 1
    [_time] => 1566240447
    [_log_type] => staff
)*/

$_search_query = 0;
 // print_r($_SESSION['_q_user']);

function jobFamilyTitle($v, $t)
{
    switch ($v) {
        case '1':
            $_t = 'GENERAL COURSE';
            break;
        case '2':
            $_t = strtoupper($t). ' JOB FAMILY';
            break;
        case '3':
            $_t = strtoupper($t). ' PROFFESSIONAL COURSE';
            break;
    }
    return $_t;
}



switch ($_SESSION['_q_user']['_jobfamily_id']) {
    case 4:
        $_search_query = 45;
        break;
    case 5:
        $_search_query = 45;
        break;
    
    default:
        $_search_query =$_SESSION['_q_user']['_jobfamily_id'];
        break;
}



$query = query("SELECT  *FROM
    ((SELECT 
        pf.name AS pf_name,
            c.id AS c_id,
            c.duration AS c_duration,
            c.title AS c_title,
            c.summary AS c_summary, COUNT(l.id) AS lessontotal,
            visibility
    FROM
        $tbl_course AS c
    LEFT JOIN $tbl_proffessional AS pf ON c.category = pf.id
    LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id
    WHERE
        c.category = '".$_SESSION['_q_user']['_professionalCategoryID']."' AND c.visibility = '3'
        GROUP BY l.course_id) 
UNION (SELECT 
        jb.name AS jb_name,
            c.id AS c_id,
            c.duration AS c_duration,
            c.title AS c_title,
            c.summary AS c_summary, COUNT(l.id) AS lessontotal,
            visibility
    FROM
        $tbl_course AS c
    LEFT JOIN $tbl_jobfamily AS jb ON c.category = jb.jbf_id
    LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id
    WHERE
        c.category = '".$_SESSION['_q_user']['_jobfamily_id']."' AND c.visibility = '2'
        GROUP BY l.course_id)        
UNION (SELECT 
        jb.name AS jb_name,
            c.id AS c_id,
            c.duration AS c_duration,
            c.title AS c_title,
            c.summary AS c_summary, COUNT(l.id) AS lessontotal,
            visibility
    FROM
        $tbl_course AS c
    LEFT JOIN $tbl_jobfamily AS jb ON c.category = jb.jbf_id
    LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id
    WHERE c.visibility = '1'
        GROUP BY l.course_id)) AS s");


/*
                AND pf.id = '".$_search_query."' 

        LEFT JOIN training_proffessional AS pf ON c.visibility = '2' AND c.category = pf.id AND   c.category = '3'     


$query = query("SELECT jb.name AS jb_name, c.id AS c_id, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, c.summary AS c_summary, COUNT(l.id) AS lessontotal, visibility 
                FROM $tbl_course AS c 
                LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id
                LEFT JOIN $tbl_jobfamily AS jb ON c.visibility = 1 AND  c.category = jb.jbf_id
                WHERE c.status = '1' 
                AND jb.jbf_id = '".$_search_query."' 
                OR c.visibility = '1'
                OR c.category = '".$_SESSION['_q_user']['_jobfamily_id']."'
                GROUP BY l.course_id");

                OR c.visibility = '1'
                AND pf.id = '".$_search_query."' 


$query = query("SELECT pf.name AS pf_name, c.id AS c_id, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, c.summary AS c_summary, COUNT(l.id) AS lessontotal, visibility 
                FROM $tbl_course AS c 
                LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id
                LEFT JOIN $tbl_proffessional AS pf ON c.visibility = 2 AND  c.category = pf.id
                LEFT JOIN $tbl_jobfamily AS jb ON c.visibility = 1 AND  c.category = jb.jbf_id
                WHERE c.status = '1' 
                AND pf.id = '".$_search_query."' 
                OR c.visibility = '1'
                OR pf.id = '0'
                OR c.category = '".$_SESSION['_q_user']['_jobfamily_id']."'
                OR c.category = '".$_SESSION['_q_user']['_professionalCategoryID']."'
                GROUP BY l.course_id");

    WHERE pf.name != 'NULL'


$query = query("SELECT cs.title AS cs_title, c.id AS c_id, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, c.summary AS c_summary, COUNT(l.id) AS lessontotal FROM $tbl_course AS c 
                LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id
                LEFT JOIN $tbl_category AS cs ON c.category = cs.id
                WHERE c.status = '1' AND cs.jobfamily_id = '$_search_query' OR c.category = '999999'  OR cs.jobfamily_id = '0' OR c.professionalId = '".$_SESSION['_q_user']['_professionalCategoryID']."' 
                GROUP BY l.course_id");

$query = query("SELECT cs.title AS cs_title, c.id AS c_id, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, c.summary AS c_summary, COUNT(l.id) AS lessontotal FROM $tbl_course AS c 
                LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id
                LEFT JOIN $tbl_category AS cs ON c.category = cs.id
                WHERE c.status = '1' AND cs.jobfamily_id = '".$_search_query."' OR cs.jobfamily_id = '0'
                GROUP BY l.course_id");

$query = query("SELECT cs.title AS cs_title, c.id AS c_id, c.duration AS c_duration, c.title AS c_title, c.duration AS c_duration, c.summary AS c_summary, COUNT(l.id) AS lessontotal FROM $tbl_course AS c 
                LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id
                LEFT JOIN $tbl_category AS cs ON c.category = cs.id
                WHERE c.status = '1' AND cs.jobfamily_id = '".$_SESSION['_q_user']['_jobfamily_id']."' OR cs.jobfamily_id = '0'
                GROUP BY l.course_id");

UPDATE cpdp.training_course SET category='3' WHERE  category='36';
UPDATE cpdp.training_course SET category='1' WHERE  category='35'
UPDATE cpdp.training_course SET category='2' WHERE  category='19'
UPDATE cpdp.training_course SET category='2' WHERE  category='19'
*/
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);

        $c_id         = $rows['c_id'];; 
        $c_title      = $rows['c_title'];; 
        $pf_title     = $rows['pf_name'];; 
        $c_summary    = $rows['c_summary'];; 
        $c_duration   = $rows['c_duration'];; 
        $lessontotal   = $rows['lessontotal']; 
        $visibility   = $rows['visibility'];  
    /*
        $c_id         = $rows['c_id'];; 
        $c_title      = $rows['c_title'];; 
        $pf_title     = $rows['pf_name'];; 
        $c_summary    = $rows['c_summary'];; 
        $c_duration   = $rows['c_duration'];; 
        $lessontotal   = $rows['lessontotal']; 
        $visibility   = $rows['visibility']; 
        */
?>

            <div class="col-lg-6">
                  <div class="font-bold m-b-sm">
                     <?=jobFamilyTitle($visibility, $pf_title)?>
                </div>
                <div class="hpanel hgreen">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-8">
                                <h4 style="line-height: 26px"><a href="course-details.php?id=<?=$c_id?>"><?=$c_title?></a></h4>
                                <p><?=substr($c_summary, 0, 103)?>...</p>

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

                    <!-- jQuery -->
                    <script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
                    <!-- Popper JS -->
                    <script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
                    <!-- Bootstrap JS -->
                    <script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
                    <!-- Custom Script -->
                    <script  src="js/script.js"></script>
