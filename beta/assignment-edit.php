<?php 
$p_ty = 'assignment';

include"nav.php";

$_l  = isset($_GET['i'])?$_GET['i']:'';


$query = query("SELECT l.id, l.title, l.path, l.lesson, l.summary, l.duration, c.title AS c_title
FROM $tbl_lesson AS l
 LEFT JOIN $tbl_course AS c ON (l.course_id = c.id)
 WHERE l.type='a' AND  l.id='".$_l."'");

while($rows=mysqli_fetch_array($query)){
    /*
    print_r($rows);*/
        $id        = $rows['id'];; 
        $title     = $rows['title']; 
        $lesson    = $rows['lesson'];
        $duration  = $rows['duration']; 
        $summary   = $rows['summary']; 
        $path       = $rows['path']; 

        $c_title       = $rows['c_title']; 
        $c_id       = $rows['c_id']; 

        }

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
                            <span>Add A New Assignment</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-pen"></i> Add A New Assignment
                </h2>
                <small>Add a new assignment to a course</small>
            </div>
        </div>
    </div>


    <div class="content animate-panel">

        <div class="row">
            
            <div class="col-md-12">
                <div class="hpanel email-compose">
                    <div class="panel-heading hbuilt">
                        <div class="p-xs h4">
                            Form
                        </div>
                    </div>
                        <output id="form_message" class="form" style="padding: 0"></output>                    
                    <div class="panel-heading hbuilt">
                        <div class="p-xs">
                            <form id="assignmentform" class="assignment__form form-horizontal">
                <input name="_a" type="hidden" value="edit"/>
                <input name="_l" type="hidden" value="<?=$_l?>"/>

                                <div class="row">
                                <div class="col-sm-7">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-left">Vid. Path:</label>
                                    <div class="col-sm-10">
                                        <input value="<?=$path?>" type="text" class="form-control input-sm" name="a_path" placeholder="Full Path To Video File" required>

                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>

                              <div class="col-sm-5">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                          <select class="form-control input-sm" name="a_course" required>
                                            <option value="<?=$c_id?>"><?=$c_title?></option>
                                               <?php echo getAllCourse();?>                        
                                          </select> 
                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>
                                </div>

                                 <div class="row">
                                <div class="col-sm-7">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-left">Duration:</label>
                                    <div class="col-sm-10">
                                        <input value="<?=$duration?>" type="text" class="form-control input-sm" name="a_duration" placeholder="Duration To Complete The Assignment " required>

                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>

                              <div class="col-sm-5">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                     <select class="form-control input-sm" name="a_number" required>
                                            <option value="<?=$lesson?>">Lesson <?=$lesson?></option>
                                               <?php echo getLessonsNo($c_id);?>                        
                                          </select> 
                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>


                                </div>


                              <div class="col-sm-12">
                                <div class="form-group m-t-md">
                                    <label for="exampleInputPassword1" class="m-b-sm">Assignment Instructions:</label>
                              <textarea class="form-control input-sm" rows="6" placeholder="Write Your Question Here ....." name="a_question"> <?=$summary?></textarea>
                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>

                                <div class="clearfix"></div>


                        </div>
                    </div>


                    <div class="panel-footer">
                        <div class="col-md-4 pull-right">
                            <button class="btn btn-info pull-right ladda-button"  data-style="expand-right"><i class="fa fa-check"></i> Update Assignment</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                             </form>
                </div>
            </div>
        </div>

    </div>



</div>

       
        
        
        <!-- /page content -->
<?php include"footer.php";?>
<script src="vendor/ladda/dist/spin.min.js"></script>
<script src="vendor/ladda/dist/ladda.min.js"></script>
<script src="vendor/ladda/dist/ladda.jquery.min.js"></script>
<script src="vendor/sweetalert/lib/sweet-alert.min.js"></script>

<script src="scripts/assignment-edit.js"></script>
