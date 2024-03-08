<?php 
$p_ty = 'questions';
/*

print_r($_SESSION);

if(!isset($_SESSION['admin_authorize'])){
  header("Location:index.php?status=unauthorize");
  }

    [_q_user] => Array
        (
            [_id] => 98fk7pt5s8jxammmd7f7
            [_title] => Bro
            [_fname] => Oluwafemi
            [_lname] => Epebinu
            [_dept] => LWNM
            [_new] => 1
            [_time] => 1487618336
        )

    [_access] => 1




 [0] => Array
        (
            [q_id] => pcae4sq8td4e2xgkhu7t
            [q_user] => ndxt96wry9vgfzb3x865
            [q_subject] => It uses a dictionary of over 200 Latin words, combined with a handful
            [q_content] => 
                            <p>Loveworld New Media</p>
            [q_date] => 2017-02-23 11:57:23
            [q_status] => 0
            [q_featured] => 0
            [q_answered] => 0
            [u_id] => ndxt96wry9vgfzb3x865
            [u_title] => Bro
            [u_firstname] => Oluwafemi
            [u_lastname] => Epebinu
            [u_dept] => LWNM
            [u_jobfamily] => -
            [u_status] => 0
            [qdate] => 2017-02-23
            [q_time] => 11:57 AM 
        )

a=filter&d=lwnm&l=5&s=1&t=02/23/2017

*/

include"nav.php";

$_get_a  = isset($_GET['a'])?$_GET['a']:'';
$_get_d  = isset($_GET['d'])?$_GET['d']:'';
$_get_r  = isset($_GET['r'])?$_GET['r']:'';
$_get_s  = isset($_GET['s'])?$_GET['s']:'';
//$_get_t  = isset($_GET['t'])?date('Y-m-d H:i:s', strtotime(str_replace('-', '/',$_GET['t']))):'';
$_get_t  = isset($_GET['t'])?date('Y-m-d', strtotime(str_replace('-', '/',$_GET['t']))):'';
$_get_p  = isset($_GET['p'])?$_GET['p']:'';
$_get_q  = isset($_GET['q'])?$_GET['q']:'';

$get_questions = get_questions($_get_a, $_get_d, $_get_r, $_get_s, $_get_t, $_get_p, $_get_q);    
//print_r($get_questions);            
//$date = date('Y-m-d H:i:s', strtotime(str_replace('-', '/', $date)));

?>

<!-- Main Wrapper -->

<!-- Main Wrapper -->
<div id="wrapper">


    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">
                    <ol class="hbreadcrumb breadcrumb">
                        <li><a href="index.html">Dashboard</a></li>
                        <li class="active">
                            <span>Questions </span>
                        </li>
                    </ol>
                </div>
                <h2 class="font-light m-b-xs">
                    Questions <span class="pull-right filter-modal-trigger text-center" style="width: 50px;height: 50px;"> <i class="pe pe-7s-filter fa-lg visible-xs text-warning"></i> </span>
                </h2>
                <small>Frequently ask questions</small>
            </div>
        </div>
    </div>


<div class="content animate-panel">

    <div class="row">
   
        <div class="col-md-9">
            <div class="row">
                <div class="col-lg-12">
                    <div class="hpanel">
                        <div class="panel-body">
                        <form id="search-question-form" role="form">
                            <div class="input-group search-box">
                                <input class="form-control" type="text" name="_q_search" placeholder="Search Questions..">
                                <div class="input-group-btn">
                                    <button type="submit" class="btn btn-default btn-q-search"><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row question-holder">

                <div class="col-lg-12">
 <?php
  /*       (
            [q_id] => pcae4sq8td4e2xgkhu7t
            [q_user] => ndxt96wry9vgfzb3x865
            [q_subject] => It uses a dictionary of over 200 Latin words, combined with a handful
            [q_content] => 
                            <p>Loveworld New Media</p>
            [q_date] => 2017-02-23 11:57:23
            [q_status] => 0
            [q_featured] => 0
            [q_answered] => 0

            [u_id] => ndxt96wry9vgfzb3x865
            [u_title] => Bro
            [u_firstname] => Oluwafemi
            [u_lastname] => Epebinu
            [u_dept] => LWNM
            [u_jobfamily] => -
            [u_status] => 0
            [qdate] => 2017-02-23
            [q_time] => 11:57 AM 
        )

*/ 

                   foreach ($get_questions as $inbox) {
                           $q_id = $inbox['q_id'];
                           $q_user = $inbox['q_user'];
                           $q_subject = $inbox['q_subject'];
                           $q_content = $inbox['q_content'];
                           $qdate = $inbox['qdate'];
                           $q_time = $inbox['q_time'];
                          $q_answered =$inbox['q_answered'];// 

                           switch ($q_answered) {
                               case '1':
                               $q_answered_active = " active";
                               $q_answered_check = "<h4 class='text-info'> Answered <i class='fa fa-check text-info'></i></h4>";
                                   break;
                              case '2':
                               $q_answered_active = " review";
                               $q_answered_check = "<h4 class='text-warning'> In-review <i class='fa fa-retweet text-warning'></i></h4>";
                                   break;

                               default:
                             //  $q_answered_active = "";
                             //  $q_answered_check = "";
                                   break;
                           }


                        //   $q_answered = ($inbox['q_answered'])?"true":"false";
                         //  $q_answered_active = ($inbox['q_answered'])?" active":"";
                         //  $q_answered_check = ($inbox['q_answered'])?"<h4> <i class='fa fa-check text-info'></i></h4>":"";

                           $u_id    = $inbox['u_id'];
                           $u_name  = $inbox['u_title']. ' '. $inbox['u_firstname'] . ' '. $inbox['u_lastname'] ;
                           $u_dept = $inbox['u_dept'];
                           $u_jobfamily = $inbox['u_jobfamily'];
                           $u_status = $inbox['u_status'];
                           $u_img = $inbox['u_img'];
                           $u_rank = $inbox['u_rank'];

?>
                     <div class="hpanel filter-item<?=$q_answered_active?>" data-q-answered="<?=$q_answered?>" data-q-id="<?=$q_id?>" data-u-rank="<?=$u_rank?>" data-u-img="<?=$u_img?>" data-u-id="<?=$u_id?>" data-u-name="<?=$u_name?>" data-u-dept="<?=$u_dept?>" data-u-jobfamily="<?=$u_jobfamily?>" data-u-status="<?=$u_status?>" data-date="<?=$qdate?>" data-subject="<?=$q_subject?>">
                        <a href="#" data-toggle="modal" data-target="#askdetails" data-content="<?=htmlentities($q_content)?>">
                        <div class="panel-body">
                            <div class="pull-right text-right filter-dept">
                                <small class="stat-label"><?=$qdate?></small>
                                <h4><?=$u_dept?>    <?=$q_answered_check?></h4>
                            </div>
                            <h4 class="m-b-xs"><?=$u_name?></h4>
                            <p class="small"><?=$q_subject?></p>
                        </div>
                        </a>
                    </div>


  <?php } ?>        
<!--

                     <div class="hpanel filter-item">
                        <a href="#">
                        <div class="panel-body">
                            <div class="pull-right text-right filter-dept">
                                    <small class="stat-label">Last week</small>
                                <h4>LWNM & PCO</h4>
                            </div>
                            <h4 class="m-b-xs">Bro Oluwafemi</h4>
                            <p class="small">Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still</p>
                        </div>
                        </a>
                    </div>

                    <div class="hpanel filter-item active">
                        <a href="#">
                            <div class="panel-body">
                                <div class="pull-right text-right filter-dept">
                                    <small class="stat-label">Last week</small>
                                    <h4>LWPM <i class="fa fa-check text-info"></i></h4>
                                </div>
                                <h4 class="m-b-xs">Bro Alex</h4>
                                <p class="small">It is a long established fact that a reader will be distracted by the readable</p>
                            </div>
                        </a>
                    </div>

                    <div class="hpanel filter-item">
                        <a href="#">
                            <div class="panel-body">
                                <div class="pull-right text-right filter-dept">
                                    <small class="stat-label">Last week</small>
                                    <h4>Healing School </h4>
                                </div>
                                <h4 class="m-b-xs">Pastor Lade</h4>
                                <p class="small">There are many variations of passages of Lorem Ipsum available, </p>
                            </div>
                        </a>
                    </div>

                    <div class="hpanel filter-item">
                        <a href="#">
                            <div class="panel-body">
                                <div class="pull-right text-right filter-dept">
                                    <small class="stat-label">Last week</small>
                                    <h4>Zone 5 </h4>
                                </div>
                                <h4 class="m-b-xs">Deacon Daniel</h4>
                                <p class="small">All the Lorem Ipsum generators on the Internet tend to repeat</p>
                            </div>
                        </a>
                    </div>

                    <div class="hpanel filter-item">
                        <a href="#">
                            <div class="panel-body">
                                <div class="pull-right text-right filter-dept">
                                    <small class="stat-label">Last week</small>
                                    <h4>Zone 1 </h4>
                                </div>
                                <h4 class="m-b-xs">Pastor Dipo</h4>
                                <p class="small">Making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words</p>
                            </div>
                        </a>
                    </div>

                    <div class="hpanel filter-item">
                        <a href="#">
                            <div class="panel-body">
                                <div class="pull-right text-right filter-dept">
                                    <small class="stat-label">Last week</small>
                                    <h4>Teaching </h4>
                                </div>
                                <h4 class="m-b-xs">Brother Edosa</h4>
                                <p class="small">Lorem Ipsum as their default model text, and a search for 'lorem ipsum' will uncover many web sites still</p>
                            </div>
                        </a>
                    </div>

                    <div class="hpanel filter-item">
                        <a href="#">
                            <div class="panel-body">
                                <div class="pull-right text-right filter-dept">
                                    <small class="stat-label">Last week</small>
                                    <h4>IMM</h4>
                                </div>
                                <h4 class="m-b-xs">Sis ESther</h4>
                                <p class="small">It is a long established fact that a reader will be distracted by the readable</p>
                            </div>
                        </a>
                    </div>

                    <div class="hpanel filter-item">
                        <a href="#">
                            <div class="panel-body">
                                <div class="pull-right text-right filter-dept">
                                    <small class="stat-label">Last week</small>
                                    <h4>Rhapsody</h4>
                                </div>
                                <h4 class="m-b-xs">Sis Blessing</h4>
                                <p class="small">There are many variations of passages of Lorem Ipsum available, </p>
                            </div>
                        </a>
                    </div>

-->




                </div>



            </div>


        </div>









             <div class="col-md-3 hidden-xs">
            <div class="hpanel">
                <div class="panel-body filter-input">
                    <div class="m-b-md">
                        <h4>
                            Filter
                        </h4>
                        <small>
                            Filter questions base on diferent options below.
                        </small>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Filter By Date:</label>
                        <div class="input-group date">
                            <input type="text" name="f_date" class="form-control" value="<?=isset($_GET['t'])?$_GET['t']:date('m/d/Y')?>">
                            <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label">Filter By Department:</label>
                        <div class="input-group">
                            <select class="form-control m-b" name="f_dept">
                                <option value="lwnm" selected>Lwnm & Pastor Chris Online</option>
                                <option value="lwpm" >LWPM</option>
                                <option value="imm" >IMM</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Filter By Rank:</label>
                        <div class="input-group">
                            <input id="demo1" type="text"  name="f_rank" value="5">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label">Filter By Status:</label>



                        <div class="input-group">
                            <div class="radio"><label> 
                                <input type="radio" name="f_status" value="1" class="i-checks"> Answered </label>
                                </div>
                            <div class="radio"><label> 
                                <input type="radio" name="f_status" value="0" class="i-checks" checked> Pending</label>
                            </div>

                        </div>
                    </div>
  

                    <button type="submit" class="btn btn-success btn-block ladda-button">Apply</button>

                </div>

            </div>

        </div>








    </div>


</div>












                    <div class="modal fade hmodal-info" id="filtermodal" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="color-line"></div>

                                <div class="modal-header">
                                    <h4 class="modal-title">
                                        <span class="ask_title">Filter</span>
                                    </h4>
                                </div>
                                <div class="modal-body modal-slim">


                                            <div class="form-group">
                                                <label class="control-label">Filter By Date:</label>
                                                <div class="input-group date">
                                                    <input type="text" name="f_date" class="form-control" value="<?=isset($_GET['t'])?$_GET['t']:date('m/d/Y')?>">
                                                    <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label class="control-label">Filter By Department:</label>
                                                <div class="input-group col-xs-12">
                                                    <select class="form-control m-b" name="f_dept">
                                                        <option value="lwnm" selected>Lwnm & Pastor Chris Online</option>
                                                        <option value="lwpm" >LWPM</option>
                                                        <option value="imm" >IMM</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Filter By Rank:</label>
                                                <div class="input-group col-xs-12">
                                                    <input id="demo1" type="text"  name="f_rank" value="5" class="form-control">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label class="control-label">Filter By Status:</label>



                                                <div class="input-group">
                                                    <div class="radio"><label> 
                                                        <input type="radio" name="f_status" value="1" class="i-checks"> Answered </label>
                                                        </div>
                                                    <div class="radio"><label> 
                                                        <input type="radio" name="f_status" value="0" class="i-checks" checked> Pending</label>
                                                    </div>

                                                </div>
                                            </div>
                          

                                            <button type="submit" class="btn btn-success btn-block ladda-button">Apply</button>






                            </div>




                            </div>
                        </div>
                    </div>















                    <div class="modal fade hmodal-info" id="askdetails" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-xl">
                            <div class="modal-content">
                                <div class="color-line"></div>

                                <div class="modal-description-folder">
                                <div class="modal-header">
                                    <h4 class="modal-title">
                                        <span class="ask_title"></span>
                                        <small class="ask_date pull-right"></small>
                                    </h4>
                                <p style="color: #9d9fa2;" class="font-bold ask_subject">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
                                </div>
                                <div class="modal-body questiondetailsmo">
                                    <div class="askdetailscontent">
                                        <h4>Hello Oluwafemi! </h4>

                                        <p>dummy text of the printing and typesetting industry. <strong>Lorem Ipsum has been the dustrys</strong> standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more
                                            <br/><br/>All the Lorem Ipsum generators on the Internet tend to repeat predefined chunks as necessary, making this the first true generator on the Internet. It uses a dictionary of over 200 Latin words, combined with a handful of model sentence structures, to generate Lorem Ipsum which looks reasonable.
                                            recently with.</p>

                                        <p>President's Desk
                                        </p>
                                    </div>
                                       <div class="answeredcontentholder hidden">
                                       <hr>
                                       <div class="answeredcontent">
                                             <div class="col-md-12">
                                             <div class="text-center">
                                                <div class="alert alert-info animate-panel" data-effect="zomeIn">
                                                  <strong><em>Answer Loading! </em></strong> please wait while we load the answer(s).<br>
                                                  </div>
                                              </div>
                                        </div>
                                      </div>
                                       <div class="clearfix"></div>
                                     </div> 
                            </div>
                            <div class="modal-footer">
                                <div class="text-center">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                                    <a class="btn btn-info btn-reply pull-right" href="#"><i class="fa fa-reply"></i> Reply</a>
                                </div>

                            </div>


                                </div>



                                <div class="modal-info-folder">
                                    <div class="profile-picture">
                                        <a href="account.php">
                                            <img src="images/img.jpg" class="img-circle m-b ask_u_img" alt="logo">
                                        </a>


                                        <div class="stats-label text-color">
                                            <span class="font-extra-bold font-uppercase ask_u_name"></span>
                                            <div>
                                                <h4 class="font-extra-bold m-b-xs "></h4><br>
                                                <!-- <small class="text-muted">Webdeveloper</small> -->
                                            </div>
                                        </div>
                                    </div>

                                          <div class="table-responsive">
                                                <table class="table table-striped">
                                                  <colgroup>
                                                    <col class="col-xs-5">
                                                    <col class="col-xs-6">
                                                  </colgroup>
                                                  <thead>
                                                    <tr>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    <tr>
                                                      <th scope="row">Dept:</th>
                                                      <td class="ask_u_dept"></td>
                                                    </tr>
                                                    <tr>
                                                      <th scope="row">Job family:</th>
                                                      <td class="ask_u_jbfamily"></td>
                                                    </tr>                                                     
                                                    <tr>
                                                      <th scope="row">Rank:</th>
                                                      <td class="ask_u_jbrank"></td>
                                                    </tr>                                                  
                                                    </tbody>
                                                </table>
                                              </div>




                                </div>

                                <div class="clearfix"></div>


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
<script src="vendor/iCheck/icheck.min.js"></script>
<script src="vendor/select2-3.5.2/select2.min.js"></script>
<script src="vendor/bootstrap-touchspin/dist/jquery.bootstrap-touchspin.min.js"></script>
<script src="vendor/bootstrap-datepicker-master/dist/js/bootstrap-datepicker.min.js"></script>
<script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
    

<script src="scripts/questions.js"></script>
<script>

    $(function(){

   $('.modal-body.questiondetailsmo').slimscroll({
    alwaysVisible: true,
    height: 350
  });

                 $('.filter-modal-trigger').click(function(event) {
                    /* Act on the event */
$('#filtermodal').modal('show');
                }); 

        $('.input-group.date').datepicker();

        $("#demo1").TouchSpin({
            min: 0,
            max: 100,
            step: 1,
            decimals: 0,
            boostat: 5,
            maxboostedstep: 10
        });


        $(".select2").select2();








    });

</script>

<script>

    $(function () {

        $('#askdetails').on('show.bs.modal', function (event) {
          var btn      = $(event.relatedTarget); // Button that triggered the modal
          var _content = btn.data('content'); 
          var _subject = btn.parent().data('subject'); 
          var _date    = btn.parent().data('date'); 
          var _user_id = btn.parent().data('u-id'); 
          var _q_answered= btn.parent().data('q-answered'); 
          var _q_id    = btn.parent().data('q-id'); 
          var _user_name = btn.parent().data('u-name'); 
          var _user_dept = btn.parent().data('u-dept'); 
          var _user_img = btn.parent().data('u-img'); 
          var _user_rank = btn.parent().data('u-rank'); 
          var _user_jobfamily = btn.parent().data('u-jobfamily'); 

          var _user_reply  = "reply.php?msg="+_q_id+"&u="+_user_id; 

          if(_q_answered == 0){
            $('.answeredcontentholder').addClass('hidden');
             }
         if(_q_answered == 1){
           $('.answeredcontent').load('lib/process-answers.php?msg='+_q_id);
           $('.answeredcontentholder').removeClass('hidden');
             }
         if(_q_answered == 2){
            $('.answeredcontent').load('lib/process-review.php?msg='+_q_id);
           $('.answeredcontentholder').removeClass('hidden');
             }


          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          var modal = $(this);
          modal.find('.askdetailscontent').html(_content);
          modal.find('.modal-header small').text(_subject);
          modal.find('.modal-header .ask_subject').text(_subject);
          modal.find('.modal-footer .btn-reply').attr('href', _user_reply);
          modal.find('.modal-title span.ask_title').text(_user_name);
          modal.find('.modal-title small.ask_date').text(_date);

          modal.find('.modal-info-folder .ask_u_name').text(_user_name);
          modal.find('.modal-info-folder .ask_u_dept').text(_user_dept);
          modal.find('.modal-info-folder .ask_u_jbfamily').text(_user_jobfamily);
          modal.find('.modal-info-folder .ask_u_img').attr('src', _user_img);
         // modal.find('.modal-info-folder .ask_u_jblevel').text(_user_level);
          modal.find('.modal-info-folder .ask_u_jbrank').text(_user_rank);

    $('.modal-body.questiondetailsmo').slimscroll();


          //alert();

          
//

        });
    });

</script>