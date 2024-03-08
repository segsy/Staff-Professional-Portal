<?php 
$p_ty = 'lesson';

include("lib/config.php");

include("nav-all.php");

$_c  = isset($_GET['cs'])?$_GET['cs']:'';


$query = query("SELECT * FROM $tbl_course WHERE id='".$_c."'");
while($rows=mysqli_fetch_array($query)){
    /*
    print_r($rows);*/

       $c_id             = $rows['id'];; 
        $c_title         = $rows['title'];; 
        $c_summary       = $rows['summary'];; 
        $c__status      = $rows['status'];; 
        // $c_category_name      = $rows['category_name'];; 
        $c_duration      = $rows['duration'];; 
        $c_description   = $rows['description']; 
        $c_category   = $rows['category']; 
        $c_visibility   = $rows['visibility']; 
        $statusaction  = ($c__status)?"<button data-id='$c_id' data-type='disable' data-name='$c_title' data-status='$c__status' data-style='zoom-out' class='status$c_id btn-disable btn btn-danger ladda-button pull-right'>  <i class='pe pe-7s-power fa-lg'></i> Disable course</button>":"<button data-id='$c_id' data-type='enable' data-name='$c_title' data-status='$c__status' data-style='zoom-out' class='status$c_id btn-disable btn-sm btn-info ladda-button pull-right'>  <i class='pe pe-7s-sun fa-lg'></i> Enable course</button>";

        // $lessontotal   = ($rows['lessontotal'] > 0)?$rows['lessontotal'].' Lessons':'0 Lesson'; 
           switch ($rows['status']) {
            case '1':
               $c__status = "<span class='label label-primary'>Enabled<span>";
              break;
            case '0':
                $c__status = "<span class='label label-danger'>Disabled<span>";
              break;
          }
        }


?>

<style type="text/css">
    .form-horizontal .control-label {
    text-align: left;
}
button.ladda-button {
    padding: 10px 20px;
    letter-spacing: 1px;
    font-size: 13px;
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
                        <li class="active">
                            <span>Add New Lesson</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-play"></i> <?=strlen($c_title) >= 50 ? substr($c_title, 0, 49) .' ...' : $c_title?> Course Videos <?=($c__status=='1')?'':$c__status?> 

                   <?=$statusaction?>
                </h2>
                <small>Manage <?=$c_title?> videos</small>
            </div>
        </div>
    </div>


    <div class="content animate-panel">

        <div class="row">
            <div class="col-md-8">
                <div class="hpanel email-compose">
                    <div class="panel-heading hbuilt">
                        <div class="p-xs h4">
                            Videos List
                        </div>
                    </div>
                    <output id="form_message" class="form" style="padding: 0"></output>                    
                    <div class="panel-heading hbuilt">
                        <div class="p-xs">

                        <table class="table table-striped table-bordered" id="lesson-table">
                            <thead>
                              <tr class="headings">
                                <th class="column-title"># </th>
                                <th class="column-title">Title </th>
                                <th class="column-title">Duration </th>
                                <th class="column-title">Status</th>
                                <th class="column-title">Date Created</th>
                                <th class="column-title">Action</th>
                              </tr>
                            </thead>

                            <tbody class="lessonbody">

                            <?php

                            $query = query("SELECT l.status,l.id, l.title, l.lesson, l.date, l.duration  FROM $tbl_lesson AS l
                             WHERE l.course_id='$_c' ORDER By l.lesson DESC");

                            while($rows=mysqli_fetch_array($query)){
                                /*
                                print_r($rows);*/

                                    $id        = $rows['id'];
                                    $title     = $rows['title']; 
                                    $lesson    = $rows['lesson'];
                                    // $status  = $rows['status']; 
                                    $duration  = $rows['duration']; 
                                    $date  = $rows['date']; 

                                  switch ($rows['status']) {
                                    case '1':
                                       $status = "<span class='label label-primary'>Enabled<span>";
                                      break;
                                    case '0':
                                        $status = "<span class='label label-danger'>Disabled<span>";
                                      break;
                                  }

                                 ?>

                                    <tr class="tr<?=$id?>">
                                      <td><?=$lesson?></td>
                                      <td><?=$title?></td>
                                      <td><?=$duration?></td>
                                      <td><?=$status?></td>
                                      <td><?=$date?></td>
                                      <td>
                                      <div class="btn-group btn-group-sm pull-right">
                                        <button data-id="<?=$id?>" data-type="lesson" data-name="<?=$title?>" class="del<?=$id?> btn btn-outline btn-danger btn-delete ladda-button" data-style="zoom-out"> <i class="pe pe-7s-trash fa-lg"></i> Delete </button>
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




            <div class="col-md-4">
                <div class="hpanel email-compose">
                    <div class="panel-heading hbuilt">
                        <div class="p-xs h4">
                            Add New Video To Course
                        </div>
                    </div>
                    <output id="addlesson_message" class="form" style="padding: 0"></output>                    
                    <div class="panel-heading hbuilt">
                        <div class="p-xs">
                            <form id="lessonform" class="lesson__form form-horizontal">

                                <input type="hidden" value="<?=$_c?>" name="l_course" id="l_course">


                                <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-left">Title:</label>
                                    <div class="col-sm-10">
                                    <input name="_a" type="hidden" value="new"/>
                                        <input type="text" class="form-control input-sm" name="l_title" placeholder="Enter A Lesson Title" required>
                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>

                                <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-left">Path:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-sm" name="l_path" placeholder="Full Path To Video File" required>
                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>

                                <div class="col-sm-12">
                                <div class="form-group">
                                      <label class="col-sm-2 control-label text-left">Duration:</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-sm" name="l_duration" placeholder="Duration In Hours" required>
                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>


                                <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-left">Postion</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control input-sm" name="l_lesson" placeholder="Lesson Number" required>
                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>


                              <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1" class="m-b-sm">Summary:</label>
                                    <textarea class="form-control input-sm" rows="6" placeholder="A Short Summary" name="l_summary"></textarea>
                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>

                                <div class="clearfix"></div>
                        </div>
                    </div>


                    <div class="panel-footer">
                        <div class="col-md-4 pull-right">
                            <button class="btn btn-info pull-right ladda-button" type="submit" data-style="expand-right"><i class="fa fa-check"></i> Add Video Lesson</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                             </form>
                </div>
            </div>
        </div>

    </div>


<!--                             <button class="btn btn-info pull-right ladda-button"  data-style="expand-right"><i class="fa fa-check"></i> Submit Lesson</button>
 -->
</div>

       
        
        
        <!-- /page content -->
<?php include"footer.php";?>
<script src="vendor/ladda/dist/spin.min.js"></script>
<script src="vendor/ladda/dist/ladda.min.js"></script>
<script src="vendor/ladda/dist/ladda.jquery.min.js"></script>
<script src="vendor/sweetalert/lib/sweet-alert.min.js"></script>
<script src="vendor/summernote/dist/summernote.min.js"></script>

<script src="scripts/table-core.js?august"></script><!--   -->
<script src="scripts/lesson-new.js?august"></script>
<script src="scripts/course-status.js?sept"></script>
