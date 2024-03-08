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

                    <i class="pe pe-7s-display2"></i> View Professional Family Assessment List

                </h2>

                <small>view and manage all course</small>

            </div>

        </div>

    </div>









    <div class="content animate-panel">





        <div class="row">



            <div class="col-md-12">





                <div class="font-bold fa-lg m-b-sm">

                    Assessment List

                </div>
                <div class="container-fluid admin">
                    <div class="col-md-12 alert alert-primary">Quiz List</div>
                    <button class="btn btn-primary bt-sm" id="new_quiz"><i class="fa fa-plus"></i>	Add New</button>
                    <br>
                    <br>
                    <div class="card">
                        <div class="card-body">



                <div class="hpanel">



                    <div class="panel-body">

                        <table class="table table-striped table-bordered" id='table' >

                            <thead>

                            <tr class="headings">

                                <th class="column-title">Title </th>

                                <th class="column-title">Items </th>

                                <th class="column-title">Point per Items</th>

                                <th class="column-title">Job Family</th>

                                <th class="column-title">Date Created</th>

                                <th class="column-title">Action</th>

                            </tr>

                            </thead>



                            <tbody>



                            <?php



                         /*   $query = query("SELECT pf.name,c.id, c.title, c.date, c.visibility, c.duration, c.category, c.status

  FROM $tbl_course AS c

  LEFT JOIN $tbl_proffessional AS pf ON c.category = pf.id

  WHERE visibility='3' ORDER By date DESC");*/
                            $where = '';

                            if(!isset($_SESSION['_q_user'])){
                                $where = " where u.id = ".$_SESSION['login_id']." ";


                            }



                            $query = query("SELECT q.*,u.firstname as fname from quiz_list q left join $tbl_user u on u.rank_id = u.id ".$where." order by q.title asc ");
                            $i = 1;
                            if(mysqli_num_rows($query)){

                                $items = query("SELECT count(id) as item_count from questions ".$where." qid = '" . $row['id'] . "' ")->fetch_array()['item_count'];
                            }






                            while($rows=mysqli_fetch_array($query)){

                                /*

                                print_r($rows);*/



                                $id        = $rows['id'];;

                                $title     = $rows['title'];

                                $item      = $rows['item'];

                                $qpoints  = $rows['qpoints'];

                                $fname  = $rows['fname'];

                                // $status  = $rows['status'];

                                $date  = $rows['date'];

                                switch ($rows['status']) {

                                    case '2':

                                        $status = "<span class='fa fa-task'>Manage<span>";

                                        break;
                                    case '1':

                                        $status = "<span class='fa fa-trash'>Delete<span>";
                                        break;
                                    case '0':

                                        $status = "<span class='fa fa-edit'>Edit<span>";

                                        break;

                                }



// $query = query("SELECT ct.id AS c_id, ct.title AS c_title, ct.date AS c_date, COUNT(cs.id) AS cstotal FROM $tbl_category AS ct

//                 LEFT JOIN $tbl_course AS cs ON ct.id = cs.category

//                 GROUP BY ct.id  ORDER BY ct.date DESC");

// while($rows=mysqli_fetch_array($query)){

//  // print_r($rows);

//         $c_id         = $rows['c_id'];;

//         $c_title      = $rows['c_title'];;

//         $c_date        = $rows['c_date'];;

//         $cstotal   = $rows['cstotal'];



                                ?>

                                <tr class="tr<?=$id?>">

                                    <td><?=strlen($title) >= 70 ? substr($title, 0, 69) .' ...' : $title?></td>

                                    <td><?php echo $items ?></td>

                                    <td><?=$qpoints?></td>
                                    <td><?=$fname?></td>

                                    <td><?=$status?></td>

                                    <td><?=$date?></td>

                                    <td>
                                        <center>
                                            <a class="btn btn-sm btn-outline-primary edit_quiz" href="./assessment_view.php?id=<?php echo $row['id']?>"><i class="fa fa-task"></i> Manage</a>
                                            <button class="btn btn-sm btn-outline-primary edit_quiz" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-edit"></i> Edit</button>
                                            <button class="btn btn-sm btn-outline-danger remove_quiz" data-id="<?php echo $row['id']?>" type="button"><i class="fa fa-trash"></i> Delete</button>
                                        </center>
                                    </td>

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
                </div>
            </div>

        <div class="modal fade" id="manage_quiz" tabindex="-1" role="dialog" >
            <div class="modal-dialog modal-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">

                        <h4 class="modal-title" id="myModallabel">Add New Assessment</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    </div>
                    <form id='quiz-frm'>
                        <div class ="modal-body">
                            <div id="msg"></div>
                            <div class="form-group">
                                <label>Title</label>
                                <input type="hidden" name="id" />
                                <input type="text" name="title" required="required" class="form-control" />
                            </div>
                            <div class="form-group">
                                <label>Points per question</label>
                                <input type="nember" name ="qpoints" required="" class="form-control" />
                            </div>
                            <?php //if($_SESSION['login_user_type'] == 1): ?>
                                <div class="form-group">
                                    <label>Faculty</label>
                                    <select name="user_id" required="required" class="form-control" />
                                    <option value="" selected="" disabled="">Select Here</option>
                                    <?php
                                    //$qry = $conn->query("SELECT * from users where user_type = 2 order by name asc");
                                    //while($row= $qry->fetch_assoc()){
                                        ?>
                                        <option value="<?php //echo $row['id'] ?>"><?php //echo $row['name'] ?></option>
                                    <?php //} ?>
                                    </select>
                                </div>
                            <?php //else: ?>
                                <input type="hidden" name="user_id" />
                            <?php //endif; ?>
                        </div>
                        <div class="modal-footer">
                            <button  class="btn btn-primary" name="save"><span class="glyphicon glyphicon-save"></span> Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>









        </div>














        <?php include"footer.php";?>

        <script src="../vendor/sweetalert/lib/sweet-alert.min.js"></script>

        <script src="../vendor/ladda/dist/spin.min.js"></script>

        <script src="../vendor/ladda/dist/ladda.min.js"></script>

        <script src="../vendor/ladda/dist/ladda.jquery.min.js"></script>

        <script src="../scripts/table-core.js"></script><!--   -->


    <script>

            alert("question added successfully");
        window.location.href=window.location.href;

        $(document).ready(function() {
            alert("I am good");
            $('#table').DataTable();
            $('#new_quiz').click(function(){
                $('#msg').html('')
                $('#manage_quiz .modal-title').html('Add New quiz')
                $('#manage_quiz #quiz-frm').get(0).reset()
                $('#manage_quiz').modal('show')
            })
            $('.edit_quiz').click(function(){
                var id = $(this).attr('data-id')
                $.ajax({
                        url:'./get_quiz.php?id='+id,
                        error:err=>console.log(err),
                    success:function(resp){
                    if(typeof resp != undefined){
                        resp = JSON.parse(resp)
                        $('[name="id"]').val(resp.id)
                        $('[name="title"]').val(resp.title)
                        $('[name="qpoints"]').val(resp.qpoints)
                        $('[name="user_id"] ').val(resp.user_id)
                        $('#manage_quiz .modal-title').html('Edit Quiz')
                        $('#manage_quiz').modal('show')

                    }
                }
            })

            })
            $('.remove_quiz').click(function(){
                var id = $(this).attr('data-id')
                var conf = confirm('Are you sure to delete this data.');
                if(conf == true){
                    $.ajax({
                            url:'./delete_quiz.php?id='+id,
                            error:err=>console.log(err),
                        success:function(resp){
                        if(resp == true)
                            location.reload()
                    }
                })
                }
            })
            $('#quiz-frm').submit(function(e){
                e.preventDefault();
                $('#quiz-frm [name="submit"]').attr('disabled',true)
                $('#quiz-frm [name="submit"]').html('Saving...')
                $('#msg').html('')

                $.ajax({
                        url:'./save_quiz.php',
                        method:'POST',
                        data:$(this).serialize(),
                        error:err=>{
                        console.log(err)
                alert('An error occured')
                $('#quiz-frm [name="submit"]').removeAttr('disabled')
                $('#quiz-frm [name="submit"]').html('Save')
            },
                success:function(resp){
                    if(typeof resp != undefined){
                        resp = JSON.parse(resp)
                        if(resp.status == 1){
                            alert('Data successfully saved');
                            location.replace('./assessment_view.php?id='+resp.id)
                        }else{
                            $('#msg').html('<div class="alert alert-danger">'+resp.msg+'</div>')

                        }
                    }
                }
            })
            })
        })
        }
    </script>




