<?php 
$p_ty = 'course';

include("lib/config.php");

include("nav-all.php");
// include"nav.php";
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
                            <span>Add A News</span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-pen"></i> Add A News
                </h2>
                <small>Add a new news</small>
            </div>
        </div>
    </div>


    <div class="content animate-panel">

        <div class="row">
            
            <div class="col-md-7">
                <div class="hpanel email-compose">
                    <div class="panel-heading hbuilt">
                        <div class="p-xs h4">
                            News Form
                        </div>
                    </div>
                        <output id="form_message" class="form" style="padding: 0"></output>                    
                    <div class="panel-heading hbuilt">
                        <div class="p-xs">
                            <form id="newsform" class="news__form form-horizontal" enctype="multipart/form-data">

                <input name="_a" type="hidden" value="new"/>



                                <div class="row">
                                <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <input type="text" class="form-control input-sm" name="c_title" placeholder="News Title">

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
                            <button class="btn btn-info pull-right ladda-button"  data-style="expand-right"><i class="fa fa-check"></i> Submit News</button>
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

<script src="scripts/news-new.js"></script>
