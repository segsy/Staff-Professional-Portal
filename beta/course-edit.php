<?php 
$p_ty = 'course';
include"nav.php";

$_c  = isset($_GET['i'])?$_GET['i']:'';


$query = query("SELECT *, c.category AS c_category_id, cs.title AS c_category_name, c.title AS c_title, c.summary AS c_summary, c.duration AS c_duration, c.description AS c_description, COUNT(l.id) AS lessontotal FROM $tbl_course AS c 
                LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id 
                LEFT JOIN $tbl_category AS cs ON (c.category = cs.id)
                WHERE c.id='".$_c."'");
while($rows=mysqli_fetch_array($query)){
    /*
    print_r($rows);*/

       $c_id             = $rows['id'];; 
        $c_title         = $rows['c_title'];; 
        $c_summary       = $rows['c_summary'];; 
        $c_category_id      = $rows['c_category_id'];; 
        $c_category_name      = $rows['c_category_name'];; 
        $c_duration      = $rows['c_duration'];; 
        $c_description   = $rows['c_description']; 
        $lessontotal   = ($rows['lessontotal'] > 0)?$rows['lessontotal'].' Lessons':'0 Lesson'; 
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
                            <span>Edit COurse</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-pen"></i> Edit COurse
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
                            <form id="courseform" class="course__form form-horizontal" enctype="multipart/form-data">

                <input name="_a" type="hidden" value="edit"/>
                <input name="_c" type="hidden" value="<?=$_c?>"/>





                                <div class="row">
                                <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="col-sm-2 m-l-xxs control-label text-lexft">Title:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-sm" name="c_title" placeholder="Enter A Course Title" value="<?=$c_title?>" required>

                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>

                              <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-left">Category:</label>
                                    <div class="col-sm-9">                                          
                                    <select class="form-control input-sm" name="c_category" required>
                                              <option value="<?=$c_category_id?>"><?=$c_category_name?></option>
                                             <?php echo getAllCategory();?>                        
                                          </select> 
                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>
                                </div>




                                <div class="row">
                                <div class="col-sm-8">
                                <div class="form-group">
                                    <label class="col-sm-2 m-l-xxs control-label text-lexft"> Picture</label>
                                 <div class="col-sm-10 p-l-none">
                                        <input type="file" class="form-control input-sm" name="c_picture" id="c_picture">
                                        <span class="help-block text-warning">Picture format supported: jpg</span>
                                </div>

                                </div>
                                </div>

                              <div class="col-sm-4">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-left">Duration:</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control input-sm" name="c_duration" placeholder="Duration In Hours" value="<?=$c_duration?>">

                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>

                                </div>













                                  <div class="form-group">
                                    <label class="col-sm-1 control-label text-left">Summary:</label>
                                    <div class="col-sm-11">
                              <textarea class="form-control input-sm" rows="6" placeholder="A Short summary" name="c_summary"><?=$c_summary?></textarea>

                                    <span class="help-block text-danger"></span>
                                  </div>

                                </div>


                              <textarea class="hidden" name="c_code"></textarea><!---->

                        </div>
                    </div>
                    <div class="panel-body no-padding">
                      <span id="coursehelp" class="help-block text-center text-danger" style="margin: 0;"></span>
                       <div class="summernote"><?=$c_description?></div>
                    </div>

                    <div class="panel-footer">
                        <div class="col-md-4 pull-right">
                            <button class="btn btn-info pull-right ladda-button"  data-style="expand-right"><i class="fa fa-check"></i> Update Course</button>
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

<script src="scripts/course-edit.js?00"></script>
