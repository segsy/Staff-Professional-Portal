<?php 
$p_ty = 'lesson';

include("lib/config.php");

include("nav-all.php");
// include"nav.php";

$_i  = isset($_GET['i'])?$_GET['i']:'';

$query = query("SELECT l.id, l.title, l.lesson, l.date, l.duration, l.path, l.summary, c.id AS c_id, c.title AS c_title
FROM $tbl_lesson AS l
 LEFT JOIN $tbl_course AS c ON (l.course_id = c.id)
 WHERE l.type='l' AND  l.id='".$_i."'");

while($rows=mysqli_fetch_array($query)){
    /*
    print_r($rows);*/
        $id        = $rows['id'];; 
        $title     = $rows['title']; 
        $lesson    = $rows['lesson'];
        $duration  = $rows['duration']; 
        $path       = $rows['path']; 
        $summary  = $rows['summary']; 
        $date       = $rows['date']; 
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
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-pen"></i> Edit Lesson
                </h2>
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
                            <form id="lessonform" class="lesson__form form-horizontal">

                <input name="_a" type="hidden" value="edit"/>
                <input name="_l" type="hidden" value="<?=$_i?>"/>

                                <div class="row">
                                <div class="col-sm-7">
                                <div class="form-group">
                                    <label class="col-sm-1 control-label text-left">Title:</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control input-sm" name="l_title" placeholder="Enter A Lesson Title" value="<?=$title?>" required>

                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>

                              <div class="col-sm-5">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                          <select class="form-control input-sm" name="l_course" required>
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
                                    <label class="col-sm-1 control-label text-left">Path:</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control input-sm" name="l_path" placeholder="Full Path To Video File" value="<?=$path?>" required>

                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>

                              <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control input-sm" name="l_duration" placeholder="Duration In Hours" value="<?=$duration?>" required>

                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>


                              <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control input-sm" name="l_lesson" placeholder="Lesson Number" value="<?=$lesson?>" required>

                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>




                                </div>


                              <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1" class="m-b-sm">Summary:</label>
                              <textarea class="form-control input-sm" rows="6" placeholder="A Short Summary" name="l_summary"><?=$summary?></textarea>
                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>

                                <div class="clearfix"></div>


                        </div>
                    </div>


                    <div class="panel-footer">
                        <div class="col-md-4 pull-right">
                            <button class="btn btn-info pull-right ladda-button"  data-style="expand-right"><i class="fa fa-check"></i> Update Lesson</button>
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
<script src="vendor/summernote/dist/summernote.min.js"></script>

<script src="scripts/lesson-edit.js"></script>
