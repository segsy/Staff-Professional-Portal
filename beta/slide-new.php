<?php 
$p_ty = 'slide';

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
                        <li class="active">
                            <span>Add A New Slide</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-pen"></i> Add A New Slide
                </h2>
                <small>Add a new slide presentation to a course</small>
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
                            
                            <form id="slideform" class="slide__form form-horizontal">

                                <div class="row">
                                <div class="col-sm-7">
                                <div class="form-group">
                                    <label class="col-sm-1 control-label text-left">Title:</label>
                                    <div class="col-sm-11">
                <input name="_a" type="hidden" value="new"/>
                                        <input type="text" class="form-control input-sm" name="s_title" placeholder="Enter A Slide Title" required>

                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>

                              <div class="col-sm-5">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                          <select class="form-control input-sm" name="s_course" required>
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
                                        <input type="text" class="form-control input-sm" name="s_path" placeholder="Full Path To Slide File" required>

                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>

                              <div class="col-sm-2">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control input-sm" name="s_duration" placeholder="Duration In Hours" required>

                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>


                              <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control input-sm" name="s_slide" placeholder="Lesson Number" required>

                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>




                                </div>


                              <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="exampleInputPassword1" class="m-b-sm">Summary:</label>
                              <textarea class="form-control input-sm" rows="6" placeholder="A Short Summary" name="s_summary"></textarea>
                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>

                                <div class="clearfix"></div>


                        </div>
                    </div>


                    <div class="panel-footer">
                        <div class="col-md-4 pull-right">
                            <button class="btn btn-info pull-right ladda-button"  data-style="expand-right"><i class="fa fa-check"></i> Submit slide</button>
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

<script src="scripts/slide-new.js"></script>
