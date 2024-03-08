<?php 
$p_ty = 'course';

include("lib/config.php");

include("nav-all.php");

// include"nav.php";

$_c  = isset($_GET['i'])?$_GET['i']:'';

$query = query("SELECT 
    c.id,
    pf.name AS pf_name,
    c.category AS c_category,
    c.duration AS c_duration,
    c.title AS c_title,
    c.status AS c_status,
    c.summary AS c_summary,
    COUNT(l.id) AS lessontotal,
    c.visibility AS c_visibility,
    c.description AS c_description, 
    visibility
FROM
    training_course AS c
        LEFT JOIN
    training_jobfamily AS jb ON c.category = jb.jbf_id
       LEFT JOIN
    training_proffessional AS pf ON c.category = pf.id
        LEFT JOIN
    training_lesson AS l ON c.id = l.course_id
WHERE
    c.id ='".$_c."'");

/*

$query = query("SELECT *, c.category AS c_category_id, cs.title AS c_category_name, c.title AS c_title, c.summary AS c_summary, c.duration AS c_duration, c.description AS c_description, c.category AS c_category, c.visibility AS c_visibility, COUNT(l.id) AS lessontotal FROM $tbl_course AS c 
                LEFT JOIN $tbl_lesson AS l ON c.id = l.course_id 
                LEFT JOIN $tbl_category AS cs ON (c.category = cs.id)
                WHERE c.id='".$_c."'");
*/
while($rows=mysqli_fetch_array($query)){
    /*
    print_r($rows);*/

        $c_id             = $rows['id']; 
        $c_title         = $rows['c_title']; 
        $c_summary       = $rows['c_summary']; 
        $c_category_id      = $rows['c_category']; 
        $c_category_name      = $rows['pf_name']; 
        $c_duration      = $rows['c_duration']; 
        $c_status          = $rows['c_status']; 
        $c_description   = $rows['c_description']; 
        $c_category   = $rows['c_category']; 
        $c_visibility   = $rows['c_visibility']; 
        $lessontotal   = ($rows['lessontotal'] > 0)?$rows['lessontotal'].' Lessons':'0 Lesson'; 
 
         $statusaction  = ($c_status)?"<button data-id='$c_id' data-type='disable' data-name='$c_title' data-status='$c_status' data-style='zoom-out' class='status$c_id btn-disable btn btn-danger ladda-button pull-right'>  <i class='pe pe-7s-power fa-lg'></i> Disable course</button>":"<button data-id='$c_id' data-type='enable' data-name='$c_title' data-status='$c_status' data-style='zoom-out' class='status$c_id btn-disable btn-sm btn-info ladda-button pull-right'>  <i class='pe pe-7s-sun fa-lg'></i> Enable course</button>";

        }

?>
<style type="text/css">
.form-horizontal .control-label {
    text-align: left;
}
.visibility-layer {
    background: #e3f2fb;
    border: 1px solid lightskyblue;
    padding-top: 20px;
    border-radius: 5px;
    margin-bottom: 15px;
}
button.ladda-button {
    padding: 8px 30px;
    letter-spacing: 2px;
    font-size: 14px;
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
                            <span>Edit COurse</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-pen"></i> Edit Course

                   <?=$statusaction?>
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
                <input type="hidden" name="_visibilityType" id="_visibilityType">





                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label text-lexft">Title:</label>
                                     <div class="col-sm-10 p-l-none">
                                            <input type="text" class="form-control" name="c_title" placeholder="Enter A Course Title" value="<?=$c_title?>" required>

                                        <span class="help-block text-danger"></span>
                                      </div>
                                    </div>
                                </div>

                                 <div class="col-sm-12">
                                   <div class="form-group">
                                        <label class="col-sm-2 control-label">Course Visibility: </label>
                                            <div class="col-sm-10 staffType">

                                                <label class="radio-inline">
                                                  <input type="radio" class="i-checks" name="visibility" id="all" value="1"<?=($c_visibility == '1')?' checked':''?>> Available To All Staff
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" class="i-checks" name="visibility" id="jb" value="2"<?=($c_visibility == '2')?' checked':''?>> New Job Family
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" class="i-checks" name="visibility" id="pc" value="3"<?=($c_visibility == '3')?' checked':''?>> Professional Categories ( Old Job Family )
                                                </label>
                                            <span class="help-block text-danger"></span>
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-sm-12 visibility-layer" id="visibilityAll">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label text-left"></label>
                                     <div class="col-sm-10 p-l-none"> <i class="fa fa-check"></i> Course Will Be Visisble To All Staff
                                        <span class="help-block text-danger"></span>
                                      </div>
                                    </div>
                                </div>
                              <div class="col-sm-12 visibility-layer" id="visibilityJB">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label text-left">Select Job Family:</label>
                                     <div class="col-sm-10 p-l-none">
                                        <select class="form-control" name="c_jb" required>
                                                <?php if($c_visibility == 2){?>
                                                  <option value="<?=$c_category_id?>"><?=$c_category_name?></option>
                                                 <?php } ?> 
                                                 <?php echo getjobfamilys();?>                        
                                              </select> 
                                        <span class="help-block text-danger"></span>
                                      </div>
                                    </div>
                                </div>
                                <div class="col-sm-12 visibility-layer" id="visibilityPC">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label text-left">Professional Categories:</label>
                                     <div class="col-sm-10 p-l-none">
                                        <select class="form-control" name="c_pc" required>
                                                <?php if($c_visibility == '3'){?>
                                                  <option value="<?=$c_category_id?>"><?=$c_category_name?></option>
                                                 <?php } ?>                                             
                                                  <option value="<?=$c_category_id?>"><?=($c_category_id == '999999')?'[ Available to all Staff ]':$c_category_name?></option>
                                                 <?php echo getAllProfessional();?>                        
                                              </select> 
                                        <span class="help-block text-danger"></span>
                                      </div>
                                    </div>
                                </div>





                                <div class="col-sm-12">
                                        <div class="form-group">
                                            <label class="col-sm-2 m-l-xxs control-label text-lexft"> Picture</label>
                                         <div class="col-sm-10 p-l-none">
                                                <input type="file" class="form-control" name="c_picture" id="c_picture">
                                                <span class="help-block text-warning">Picture format supported: jpg</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label text-left">Duration:</label>
                                     <div class="col-sm-10 p-l-none">
                                            <input type="text" class="form-control" name="c_duration" placeholder="Duration In Hours" value="<?=$c_duration?>">

                                        <span class="help-block text-danger"></span>
                                      </div>
                                    </div>
                                </div>




                                <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-2 control-label text-left">Summary:</label>
                                     <div class="col-sm-10 p-l-none">
                                        <textarea class="form-control" rows="6" placeholder="A Short summary" name="c_summary"><?=$c_summary?></textarea>

                                    <span class="help-block text-danger"></span>
                                  </div>

                                </div>
                                </div>
                        <div class="clearfix"></div>


                              <textarea class="hidden" name="c_code"></textarea><!---->

                        </div>
                    </div>
                    <div class="panel-body no-padding">
                      <span id="coursehelp" class="help-block text-center text-danger" style="margin: 0;"></span>
                       <div class="summernote"><?=$c_description?></div>
                    </div>

                    <div class="panel-footer">
                        <div class="col-md-4 pull-right">
                            <button class="btn btn-info pull-right ladda-button" id="button-update"  data-style="expand-right"><i class="fa fa-check"></i> Update Course</button>
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

<script src="scripts/course-edit.js?sept"></script>
<script src="scripts/course-status.js?sept"></script>


<script>

    $(function () {



        function setTicketOption(v){
        var vv = parseInt(v);
        $('#_visibilityType').val(vv);
        console.log('setTicketOption '+vv);  
        switch(vv){
        case 1:
        $('#visibilityAll').removeClass('hidden').fadeIn();
        $('#visibilityJB').addClass('hidden').fadeOut();
        $('#visibilityPC').addClass('hidden').fadeOut();
        break;
        case 2:
        $('#visibilityAll').addClass('hidden').fadeOut();
        $('#visibilityJB').removeClass('hidden').fadeIn();
        $('#visibilityPC').addClass('hidden').fadeOut();
        break;
        case 3:
        $('#visibilityAll').addClass('hidden').fadeOut();
        $('#visibilityPC').removeClass('hidden').fadeIn();
        $('#visibilityJB').addClass('hidden').fadeOut();
        break;
        default:
        $('#visibilityAll').addClass('hidden').fadeOut();
        $('#visibilityJB').addClass('hidden').fadeOut();
        $('#visibilityPC').addClass('hidden').fadeOut();        
        break;
        }
        }


        $(".staffType input[name='visibility']").on('change', function(event){
            setTicketOption($(this).val());
        });


         setTicketOption(<?=$c_visibility?>);
         // $(".staffType .i-checks").val(<?=$c_visibility?>);
         $(".staffType .i-checks[value="+<?=$c_visibility?>+"]").prop('checked', true);








    });

</script>
