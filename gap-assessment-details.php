<?php 
$p_ty = 'lesson';

include("lib/config.php");

include("nav-all.php");

$_c  = isset($_GET['gap'])?$_GET['gap']:'';


// $query = query("SELECT id, title, firstname, lastname, department, jobfunction, take_course, jobPerf, date_created, status FROM training_gap ORDER By date_created DESC");
$query = query("SELECT * FROM training_gap WHERE id='".$_c."'");
while($rows=mysqli_fetch_array($query)){
        $id        = $rows['id'];
        $title     = $rows['title']; 
        $firstname  = $rows['firstname'];
        $lastname  = $rows['lastname'];

        $department  = $rows['department']; 
        $jobfunction  = $rows['jobfunction']; 
        $jobPerf  = $rows['jobPerf']; 
        $phoneNumber  = $rows['phoneNumber']; 
        $email  = $rows['email']; 
        $status  = $rows['status']; 
        $date  = $rows['date_created']; 

        $take_course  = $rows['take_course'];
          switch ($take_course) {
            case 'yes':
               $takecourse = "<span class='label label-primary'>Yes<span>";
              break;
            case 'no':
                $takecourse = "<span class='label label-danger'>No<span>";
              break;
          }
        $take_course_review_yes  = $rows['take_course_review_yes'];
        $take_course_review_no  = $rows['take_course_review_no'];
        $take_course_review_other_reason  = $rows['take_course_review_other_reason'];

        $persTrainNeeds1  = $rows['persTrainNeeds1']; 
        $persTrainNeeds2  = $rows['persTrainNeeds2']; 
        $persTrainNeeds3  = $rows['persTrainNeeds3']; 
        $persTrainNeeds4  = $rows['persTrainNeeds4']; 
        $persTrainNeeds5  = $rows['persTrainNeeds5']; 
        $addComments  = $rows['addComments']; 

        $onsite_training  = $rows['onsite_training']; 
        $onsite_training_review_yes  = $rows['onsite_training_review_yes']; 
        $trainPerf  = $rows['trainPerf']; 

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
.table > tbody > tr > td {
    padding: 8px;
    line-height: 1.99857143;
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
                   <i class="pe pe-7s-file"></i> Gap Assessment Details
                </h2>
            </div>
        </div>
    </div>


    <div class="content animate-panel">

        <div class="row">
            <div class="col-md-6">
                <div class="hpanel email-compose">
                    <div class="panel-heading hbuilt">
                        <div class="p-xs h4">
                           Assessment Details
                        </div>
                    </div>
                    <output id="form_message" class="form" style="padding: 0"></output>                    
                    <div class="panel-heading hbuilt">
                        <div class="p-xs">

                        <table class="table table-striped table-bordered" id="lesson-table">
                    <tbody class="lessonbody">

                        <tr>
                          <th class="text-center" colspan='2'> Personal Data</th>
                        </tr>                        
                        <tr class="tr">
                          <td>Name</td>
                          <td><?=$title.' '.$firstname.' '.$lastname ?></td>
                        </tr>                         
                        <tr>
                          <td>Email</td>
                          <td><?=$email?></td>
                        </tr>                         
                       <tr>
                          <td>Phone Number</td>
                          <td><?=$phoneNumber?></td>
                        </tr>                         
                       <tr>
                          <td>Department</td>
                          <td><?=$department?></td>
                        </tr>                         
                        <tr>
                          <td>Job Function</td>
                          <td><?=$jobfunction?></td>
                        </tr>                         


                        <tr>
                          <th class="text-center" colspan='2'>2019 CPDP Training</th>
                        </tr> 
                        <tr>
                          <td>Taken Course Online before?</td>
                          <td><?=$takecourse?></td>
                        </tr> 
                        <?php
                        if( $take_course == 'yes'){
                        ?>
                            <tr>
                              <td>learning Experience Rating</td>
                              <td><?=$take_course_review_yes?></td>
                            </tr>                         
                        <?php
                        }else{
                            if ($take_course_review_no = 'other-reason') {
                        ?>
                               <tr>
                                  <td>Reason(s)?</td>
                                  <td><?=$take_course_review_other_reason?></td>
                                </tr>                                
                         <?php
                           } else {
                         ?>
                              
                               <tr>
                                  <td>Reason(s)?</td>
                                  <td><?=$take_course_review_no?></td>
                                </tr> 
                        <?php
                            }
                            
                        ?>


                        <?php
                        }                        
                        ?>
                       <tr>
                          <th class="text-center" colspan='2'>Performance Management</th>
                        </tr> 
                        <tr>
                          <td>Performance Rating</td>
                          <td><?=$jobPerf?></td>
                        </tr>                     
                        <tr>
                          <td> Do you think Training will help<br> improve your Performance?</td>
                          <td><?=$trainPerf?></td>
                        </tr>                     
                    </tbody>
                  </table>



                        </div>
                    </div>
                </div>
            </div>


            <div class="col-md-6">
                <div class="hpanel email-compose">
                    <div class="panel-heading hbuilt">
                        <div class="p-xs h4">
                            2020 Personal Training Needs
                        </div>
                    </div>
                    <output id="addlesson_message" class="form" style="padding: 0"></output>                    
                    <div class="panel-heading hbuilt">
                        <div class="p-xs">

                        <table class="table table-striped table-bordered" id="lesson-table">
                    <tbody class="lessonbody">
                        <tr>
                          <th class="text-center" colspan='2'>Training Needs</th>
                        </tr>  
                        <tr>
                          <td>Training 1</td>
                          <td><?=$persTrainNeeds1?></td>
                        </tr>                         
                        <tr>
                          <td>Training 2</td>
                          <td><?=$persTrainNeeds2?></td>
                        </tr>                         
                        <tr>
                          <td>Training 3</td>
                          <td><?=$persTrainNeeds3?></td>
                        </tr>                         
                        <tr>
                          <td>Training 4</td>
                          <td><?=$persTrainNeeds4?></td>
                        </tr>                         
                        <tr>
                          <td>Training 5</td>
                          <td><?=$persTrainNeeds5?></td>
                        </tr>                         
                        <tr>
                          <th class="text-center" colspan='2'>Comments/Suggestion(s)</th>
                        </tr>                         
                       <tr>
                          <th colspan='2'><pre><?=$addComments?></pre></th>
                        </tr>                         
                        
                        
                    </tbody>
                  </table>


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

<script src="scripts/table-core.js?august"></script><!--   -->
<script src="scripts/lesson-new.js?august"></script>
<script src="scripts/course-status.js?sept"></script>
