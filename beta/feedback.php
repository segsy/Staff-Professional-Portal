<?php 
$p_ty = 'contact';
include"nav.php";

$_l  = isset($_GET['_l'])?escape_s($_GET['_l']):'';
$cs  = isset($_GET['cs'])?escape_s($_GET['cs']):'';
$getCourseNameById = getCourseNameById($cs);
$getLessonNameById = getLessonNameById($_l);

?>

<!-- Main Wrapper -->
<div id="wrapper">

    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">

                </div>
                <h2 class="font-light m-b-xs text-center">
                    <i class="pe pe-7s-mail"></i>  Leave A Feedback
                </h2>
            </div>
        </div>
    </div>



    <div class="content animate-panel">










        <div class="row">
            
            <div class="col-md-8 col-md-offset-2">
                <div class="hpanel email-compose">
                    <div class="panel-heading hbuilt">
                        <div class="p-xs h4">
                            <i class="pe pe-7s-note2"></i>  <?=$getCourseNameById?>
                        </div>
                    </div>
                        <output id="form_message" class="form" style="padding: 0"></output>                    
                    <div class="panel-heading hbuilt">
                        <div class="p-xs">
                            <form id="contactform" class="contact__form form-horizontal" enctype="multipart/form-data">

                <input name="_a" type="hidden" value="new"/>
                <input name="_cs" type="hidden" value="<?=$cs?>"/>
                <input name="_l" type="hidden" value="<?=$_l?>"/>
                <input name="_lname" type="hidden" value="<?=$getLessonNameById?>"/>
                <input name="_csname" type="hidden" value="<?=$getCourseNameById?>"/>



                                <div class="row">
                                <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-1 m-l-xxs control-label text-lexft">Subject:</label>
                                    <div class="col-sm-11">
                                        <input type="text" class="form-control input-sm" name="c_subject" placeholder="Enter A Message Subject"/>

                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>

                                </div>

  


                              <textarea class="hidden" name="c_code"></textarea><!---->

                        </div>
                    </div>
                    <div class="panel-body no-padding">
                      <span id="coursehelp" class="help-block text-center text-danger" style="margin: 0;"></span>
                       <div class="summernote"></div>
                    </div>

                    <div class="panel-footer">
                        <div class="col-md-4 pull-right">
                            <button class="btn btn-info pull-right ladda-button"  data-style="expand-right"><i class="pe pe-7s-paper-plane"></i> Submit</button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                             </form>
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

<script src="scripts/feedback.js"></script>
