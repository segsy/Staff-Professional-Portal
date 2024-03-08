<?php 
$p_ty = 'course';

include("lib/config.php");

include("nav-all.php");

// include"nav.php";
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
                            <span>Add A New COurse</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-pen"></i> Add A New COurse
                </h2>
                <small>Add a new course</small>
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
                    <div class="clearfix"></div>
                    <div class="panel-heading hbuilt">
                        <div class="p-xs">
                            <form id="courseform" class="course__form form-horizontal" enctype="multipart/form-data">

                                <input name="_a" type="hidden" value="new"/>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="col-sm-2 m-l-xxs control-label text-lexft">Title:</label>
                                         <div class="col-sm-10 p-l-none">
                                            <input type="text" class="form-control" name="c_title" placeholder="Enter A Course Title">

                                        <span class="help-block text-danger"></span>
                                      </div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                   <div class="form-group">
                                        <label class="col-sm-2 control-label">Course Visibility: </label>
                                            <div class="col-sm-10 staffType">

                                                <label class="radio-inline">
                                                  <input type="radio" class="i-checks" name="visibility" id="all" value="1" checked> Available To All Staff
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" class="i-checks" name="visibility" id="jb" value="2"> New Job Family
                                                </label>
                                                <label class="radio-inline">
                                                  <input type="radio" class="i-checks" name="visibility" id="pc" value="3"> Professional Categories ( Old Job Family )
                                                </label>
                                            <span class="help-block text-danger"></span>
                                        </div>
                                    </div> 
                                </div>

                                <div class="col-sm-12 visibility-layer" id="visibilityAll">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label text-left"></label>
                                     <div class="col-sm-10 p-l-none"> <i class="fa fa-check"></i> Course Will Be Visible To All Staff
                                        <span class="help-block text-danger"></span>
                                      </div>
                                    </div>
                                </div>

                                <div class="col-sm-12 visibility-layer" id="visibilityJB">
                                    <div class="form-group">
                                        <label class="col-sm-2 control-label text-left">Select Job Family:</label>
                                     <div class="col-sm-10 p-l-none">
                                        <select class="form-control" name="c_jb" required>
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
                                            <input type="text" class="form-control" name="c_duration" placeholder="Duration In Hours">

                                        <span class="help-block text-danger"></span>
                                      </div>
                                    </div>
                                </div>

                                <div class="clearfix"></div>

                                <div class="col-sm-12">
                                  <div class="form-group">
                                    <label class="col-sm-2 control-label text-left">Summary:</label>
                                     <div class="col-sm-10 p-l-none">
                                        <textarea class="form-control" rows="6" placeholder="A Short summary" name="c_summary"></textarea>

                                        <span class="help-block text-danger"></span>
                                      </div>

                                    </div>


                                    <textarea class="hidden" name="c_code"></textarea><!---->
                                </div>

                                <div class="clearfix"></div>
                            </form>

                        </div>
                    </div>    
                    <div class="panel-body no-padding">
                      <span id="coursehelp" class="help-block text-center text-danger" style="margin: 0;"></span>
                       <div class="summernote"></div>
                    </div>

                    <div class="panel-footer">
                        <div class="col-md-4 pull-right">
                            <button class="btn btn-info pull-right ladda-button"  data-style="expand-right"><i class="fa fa-check"></i> Submit Course</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    

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

<script src="scripts/course-new.js"></script>
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


         setTicketOption(1);



    });

</script>