<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 15/10/2021
 * Time: 12:52 PM
 */
include("config.php");

include("common.php");

include("aes.php");

 //if (isset($_POST['submit1'])) {

if(isset($_POST['submit1'])){

    $json = array();


    $_a = isset($_POST['_a']) ? escape_s($_POST['_a']) : '';
    $visibility = isset($_POST['visibility']) ? escape_s($_POST['visibility']) : '';
    $c_jb = isset($_POST['c_jb']) ? escape_s($_POST['c_jb']) : '';
    $c_pc = isset($_POST['c_pc']) ? escape_s($_POST['c_pc']) : '';
    $assessment_course = isset($_POST['assessment_course']) ? escape_s($_POST['assessment_course']) : '';
    $question = isset($_POST['question']) ? escape_s($_POST['question']) : '';
    $opt1 = isset($_POST['opt1']) ? escape_s($_POST['opt1']) : '';
    $opt2 = isset($_POST['opt2']) ? escape_s($_POST['opt2']) : '';
    $opt3 = isset($_POST['opt3']) ? escape_s($_POST['opt3']) : '';
    $opt4 = isset($_POST['opt4']) ? escape_s($_POST['opt4']) : '';
    $answer = isset($_POST['answer']) ? escape_s($_POST['answer']) : '';
     //echo $assessment_course;

    //exit;
    $_category = '';


    if (!$question) {

        $json['error']['question'] = 'title is required';

    } else {

        //if (strlen($question) < 5) {

            $json['error']['question'] = 'Please your title is too short';

       // }

    }


    if (!$visibility) {

        $json['error']['visibility'] = 'course visibility is required';

    } else {

        if ($visibility == '2' && empty($c_jb)) {

            $json['error']['c_jb'] = 'Please your job family is required';

            $_category = $c_jb;

        }

        if ($visibility == '3' && empty($c_pc)) {

            $json['error']['c_pc'] = 'Please your professional categories is required';

            $_category = $c_pc;

        }

    }


    if ($visibility == '1') {

        $_category = '99999';

    }

    if ($visibility == '2') {

        $_category = $c_jb;

    }


    if ($visibility == '3') {

        $_category = $c_pc;

    }

        $loop = 0;
        $count = 0;
        $query = query("select * from questions where category='$category' order by id asc") or die (mysqli_error($query));
        $count = mysqli_num_rows($query);
        if ($count == 0) {

        } else {
            while ($row = mysqli_fetch_array($query)) {
                $loop = $loop + 1;
                query("update questions set question_no='$loop' where id=$row[id]");
            }
        }

        $loop = $loop + 1;
        if (query("INSERT INTO assessment_question(id,question,opt1,opt2,opt3,opt4,date,category,status,visibility,answer,assessment_course)

        VALUES(NULL,'$i','$loop','$question','$opt1','$opt2','$opt3','$opt4',$answer,NOW(),'$_category','0','$visibility')")) {

            $json['success'] = 'assessment has been added!';

            $json['goto'] = $i;

        } else {

            $json['error']['course'] = 'Server error, please check back later';

        }


  //  }
}
 //if(isset($_POST['submit2'])) {

if(isset($_POST['submit2'])){
    $question        = isset( $_POST['question'] ) ? escape_s($_POST['question']) : '';
    $opt1        = isset( $_POST['opt1'] ) ? escape_s($_POST['opt1']) : '';
    $opt2        = isset( $_POST['opt2'] ) ? escape_s($_POST['opt2']) : '';
    $opt3        = isset( $_POST['opt3'] ) ? escape_s($_POST['opt3']) : '';
    $opt4        = isset( $_POST['opt4'] ) ? escape_s($_POST['opt4']) : '';
    $answer        = isset( $_POST['answer'] ) ? escape_s($_POST['answer']) : '';
    $json  = array();



        $exam_category = '';

        $loop = 0;
        $count = 0;
        $query = query("select * from questions where category='$category' order by id asc") or die (mysqli_error($query));
        $count = mysqli_num_rows($query);
        if ($count == 0) {

        } else {
            while ($row = mysqli_fetch_array($query)) {
                $loop = $loop + 1;
                query("update questions set question_no='$loop' where id=$row[id]");
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


        if (query("INSERT INTO assessment_question(id,fquestion,opt1,opt2,opt3,opt4,date,category,status,answer,assessment_course)

        VALUES(NULL,'$i','$loop','$question','$dst_dbl','$dst_db2','$dst_db3','$dst_db4','$dst_db5','$category',$answer,NOW(),'$_category','0')")) {

            $json['success'] = 'Assessment image has been added!';


            $json['goto'] = $i;

        } else {

            $json['error']['course'] = 'Server error, please check back later';




        }
   // }



}
