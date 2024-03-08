<?php

include("../lib/config.php");




include"nav2.php";

?>
<script src = "assets/js/jquery-3.5.1.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>



<?php //include('header.php') ?>



<!-- Main Wrapper -->

<div id="wrapper">





    <div class="small-header transition animated fadeIn">

        <div class="hpanel">

            <div class="panel-body">

                <div id="hbreadcrumb" class="pull-right">

                    <ol class="hbreadcrumb breadcrumb">

                        <li><a href="#">Dashboard</a></li>

                        <li class="active">

                            <span>COurse</span>

                        </li>

                    </ol>

                </div>

                <h2 class="font-light m-b-xs text-danger">

                    <i class="pe pe-7s-display2"></i> Staff Assessment

                </h2>

                <small>view and manage all course</small>

            </div>

        </div>

    </div>


    <br>
    <br>
    <br>



    <div class="content animate-panel">

        <div class="row">
            <div class="col-md-6">
                    <div class="hpanel email-compose">
                        <div class="panel-heading hbuilt">
                            <div class="p-xs h4">
                                Form
                            </div>
                <div class="card">
                    <div class="card-body">
                        <div class="card-header"><strong>Add New Question</strong></div>

                        <form id="assessmentform"  method="post" enctype="multipart/form-data">
                            <input name="_a" type="hidden" value="new"/>

                                <div class="form-group">
                                    <label class="col-sm-2 control-label">Assessment Visibility: </label>
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
                            <div class="form-group">
                                <select class="form-control"  name="assessment_course"  rows="6" id="assessment_course">
                                    <?php echo getAllCourse(); ?>
                                </select>


                            </div>
                            <br>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Add new questions</label>

                                <textarea class="form-control "  name="question" id="question" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Add opt1</label>
                                <input type="text" class="form-control" name="opt1"  placeholder="add opt1">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Add opt2</label>
                                <input type="text" class="form-control" name="opt2"  placeholder="add opt2">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Add opt3</label>
                                <input type="text" class="form-control" name="opt3"  placeholder="add opt3">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Add opt4</label>
                                <input type="text" class="form-control" name="opt4"  placeholder="add opt4">
                            </div>

                            <div class="form-group">
                                <label for="formGroupExampleInput2">Add Answer</label>
                                <input type="text" class="form-control" name="answer"  placeholder="add answer">
                            </div>
                            <div class="form-group>">
                                <button type="submit" name="submit1" class="btn btn-success ladda-button">Add question</button><br/
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
                </div>
            </div>
       <!-- <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="card-header"><strong>Add New Image Options</strong></div>

                        <form>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Add new questions</label>

                                <textarea class="form-control "  name="fquestion" id="fquestion" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Add opt1</label>
                                <input type="file" class="form-control" name="fopt1" style="padding-bottom:45px;">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Add opt2</label>
                                <input type="file" class="form-control" name="fopt2" style="padding-bottom:45px;">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Add opt3</label>
                                <input type="file" class="form-control" name="fopt3" style="padding-bottom:45px;">
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Add opt4</label>
                                <input type="file" class="form-control" name="fopt4" style="padding-bottom:45px;">
                            </div>

                            <div class="form-group">
                                <label for="formGroupExampleInput2">Add Answer</label>
                                <input type="file" class="form-control" name="fanswer" style="padding-bottom:45px;">
                            </div>
                            <div class="form-group>">
                                <button type="submit" name="submit2" class="btn btn-success ladda-button">Add question</button><br/>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>-->
    </div>

    <div class="alert alert-success" id="success" style="margin-top:10px">
    <strong> Success!</strong> You have successfully participate in the assessment.
</div>
<div class="alert alert-danger" id="failure" style="margin-top:10px">
<strong> Error!</strong> There was an error.
</div>

    <br>
    <br>

    <?php
    //error_reporting(0);
    //require_once('connect.php');
    $conn = new mysqli('localhost', 'root', '', 'cpdp');
    if(isset($_POST['submit1'])) {

        $json = array();
        $_a = isset($_POST['_a']);
        $visibility = isset($_POST['visibility']);
        $c_jb = isset($_POST['c_jb']);
        $c_pc = isset($_POST['c_pc']);
        $assessment_course = isset($_POST['assessment_course']);
        $question = isset($_POST['question']);
        $opt1 = isset($_POST['opt1']);
        $opt2 = isset($_POST['opt2']);
        $opt3 = isset($_POST['opt3']);
        $opt4 = isset($_POST['opt4']);
        $answer = isset($_POST['answer']);
        $_category = '';
        $status = '';


        if( !$visibility ) {

            $json['error']['visibility'] = 'course visibility is required';

        }else{

            if($visibility == '2' && empty($c_jb)  ) {

                $json['error']['c_jb'] = 'Please your job family is required';

                $_category   = $c_jb ;

            }

            if($visibility == '3' && empty($c_pc)  ) {

                $json['error']['c_pc'] = 'Please your professional categories is required';

                $_category   = $c_pc ;

            }

        }



        if( $visibility == '1' ) {

            $_category   = '99999' ;

        }

        if( $visibility == '2' ) {

            $_category   = $c_jb ;

        }



        if( $visibility == '3' ) {

            $_category   = $c_pc ;

        }


        $loop = 0;
        $count = 0;
        $res = mysqli_query($conn, "select * from assessment_question where category='$_category' and status='$status' order by id asc") or die (mysqli_error($conn));
        $count = mysqli_num_rows($res);
        if ($count == 0) {

        } else {
            while ($row = mysqli_fetch_array($res)) {
                $loop = $loop + 1;
                mysqli_query($conn, "update assessment_question set question_no='$loop' and status='$status' where id=$row[id]");
            }
        }

        $loop = $loop + 1;
       if(query("insert into assessment_question(question,opt1,opt2,opt3,opt4,answer,category,status,visibility,assessment_course,date) values(NULL,'$loop','$_POST[question]','$_POST[opt1]','$_POST[opt2]','$_POST[opt3]','$_POST[opt4]','$_POST[answer]','$_category','0','$_POST[visibility]','$_POST[$assessment_course]',NOW())")){

        //if($link->query($result) === TRUE) {

            echo "<div style='color:green;text-align:center;font-weight:40px;font-size:20px;'>You have successfully created an assessment.</div>";


        }




        ?>

        <?php

    }

    ?>


    <?php
    /*if(isset($_POST['submit2'])) {
        $fquestion = isset($_POST['question']);
        $exam_category = '';

        $loop = 0;
        $count = 0;
        $res = mysqli_query($link, "select * from assessment_question where category='$exam_category' order by id asc") or die (mysqli_error($link));
        $count = mysqli_num_rows($res);
        if ($count == 0) {

        } else {
            while ($row = mysqli_fetch_array($res)) {
                $loop = $loop + 1;
                mysqli_query($link, "update assessment_question set question_no='$loop'and status='$status' where id=$row[id]");
            }
        }

        $loop = $loop + 1;
        $tm = md5(time());
        $fnm1 = $_FILES["fopt1"]["name"];
        $dst1 = "./images/" . $tm . $fnm1;
        $dst_dbl = "images/" . $tm . $fnm1;
        move_uploaded_file($_FILES["fopt1"]["tmp_name"], $dst1);
        $fnm2 = $_FILES["fopt2"]["name"];
        $dst2 = "./images/" . $tm . $fnm2;
        $dst_db2 = "images/" . $tm . $fnm2;
        move_uploaded_file($_FILES['fopt2']["tmp_name"], $dst2);
        $fnm3 = $_FILES["fopt3"]["name"];
        $dst3 = "./images/" . $tm . $fnm3;
        $dst_db3 = "images/" . $tm . $fnm3;
        move_uploaded_file($_FILES['fopt3']["tmp_name"], $dst3);
        $fnm4 = $_FILES["fopt4"]["name"];
        $dst4 = "./images/" . $tm . $fnm4;
        $dst_db4 = "images/" . $tm . $fnm4;
        move_uploaded_file($_FILES['fopt4']["tmp_name"], $dst4);

        $fnm5 = $_FILES["fanswer"]["name"];
        $dst5 = "./images/" . $tm . $fnm5;
        $dst_db5 = "images/" . $tm . $fnm5;
        move_uploaded_file($_FILES['fanswer']["tmp_name"], $dst5);


        mysqli_query($link, "insert into assessment_question(question,opt1,opt2,opt3,opt4,category,answer,date,status) values(NULL,'$loop','$_POST[fquestion]','$dst_dbl','$dst_db2','$dst_db3','$dst_db4','$dst_db5','$exam_category',$answer,NOW(),'0')") or die(mysqli_error($link));


        if ($link->query()) {
            $_SESSION['message'] = 'You have successfully participate in the assessment';

            echo "<div style='text-align:center;font-weight:40px;font-size:20px;'>You have successfully participate in the assessment</div>";
        } else {
            $_SESSION['error'] = 'There was an error';
            echo "<div style='text-align:center; color:#F00;'>Please try again </div>";
        }


        '<div class="row">';
        '<div class="col-md-8 col-md-offset-2">';

        if (isset($_SESSION['message'])):

            '<div class="alert alert-success">';
            $_SESSION['message'];
            unset($_SESSION['message']);

            '</div>';

        endif;

        '</div>
</div>';

        '<div class="row">';
        '<div class="col-md-8 col-md-offset-2">';

        if (isset($_SESSION['error'])):

            '<div class="alert alert-danger">';
            $_SESSION['error'];
            unset($_SESSION['error']);

            '</div>';

        endif;

        '</div>
</div>';*/


        ?>
        <?php

   // } ?>






</div>

















    <?php include"footer.php";?>

    <script src="../vendor/sweetalert/lib/sweet-alert.min.js"></script>

    <script src="../vendor/ladda/dist/spin.min.js"></script>

    <script src="../vendor/ladda/dist/ladda.min.js"></script>

    <script src="../vendor/ladda/dist/ladda.jquery.min.js"></script>

    <script src="../scripts/table-core.js"></script><!--   -->


