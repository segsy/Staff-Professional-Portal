<?php 
$p_ty = 'category';

include"nav.php";

/*

ALTER TABLE `lwnm`.`training_course` ADD COLUMN `category` INT(2) NOT NULL DEFAULT 0 AFTER `date`;
*/


?>

<!-- Main Wrapper -->
<div id="wrapper">


    <div class="small-header transition animated fadeIn">
        <div class="hpanel">
            <div class="panel-body">
                <div id="hbreadcrumb" class="pull-right">
                   <button class="btn btn-info btn-outline btn-new-cat"><i class="pe pe-7s-plus"></i> Create New Category</button>
                </div>
                <h2 class="font-light m-b-xs">
                   <i class="pe pe-7s-pen"></i> Course Categories
                </h2>
                <small>create, view, manage course categories</small>
            </div>
        </div>
    </div>


    <div class="content animate-panel">

        <div class="row">
            
            <div class="col-md-7">



                <div class="hpanel">

                    <div class="panel-body">
                        <table class="table table-striped table-bordered">
                            <thead>
                              <tr class="headings">
                                <th class="column-title">Title </th>
                                <th class="column-title">Courses </th>
                                <!-- <th class="column-title">Date</th> -->
                                <th class="column-title">Action</th>
                              </tr>
                            </thead>

                            <tbody class="categorybody">

<?php
$query = query("SELECT ct.id AS c_id, ct.title AS c_title, ct.date AS c_date, COUNT(cs.id) AS cstotal FROM $tbl_category AS ct 
                LEFT JOIN $tbl_course AS cs ON ct.id = cs.category
                GROUP BY ct.id  ORDER BY ct.date DESC");
while($rows=mysqli_fetch_array($query)){
 // print_r($rows);
        $c_id         = $rows['c_id'];; 
        $c_title      = $rows['c_title'];; 
        $c_date        = $rows['c_date'];; 
        $cstotal   = $rows['cstotal']; 

     ?>

                    <tr class="cat<?=$c_id?>">
                      <td class="tdcourse"><?=$c_title?></td>
                      <td><?=$cstotal?></td>
                      <!-- <td><?=$c_date?></td> -->
                      <td>
                      <div class="btn-group btn-group-sm pull-right">
                        <button data-id="<?=$c_id?>" data-name="<?=$c_title?>" class="del<?=$c_id?> btn btn-outline btn-danger btn-delete ladda-button" data-style="zoom-out"> <i class="pe pe-7s-trash fa-lg"></i>  </button>
                        <button data-id="<?=$c_id?>" data-name="<?=$c_title?>" class="edt<?=$c_id?> btn btn-outline btn-info btn-edit"> <i class="pe pe-7s-pen fa-lg"></i> Edit </button>
                      </div> 
                      </td><!--   -->
                    </tr>

<?php } ?>

                         
                        </tbody>
                      </table>






                    </div>

                </div>
            </div>







            <div class="col-md-5 category-form-holder hidden">
                <div class="hpanel email-compose">
                    <div class="panel-heading hbuilt">
                        <div class="p-xs h4 category-header">
                            New Category Form
                        </div>
                    </div>
                        <output id="form_message" class="form" style="padding: 0"></output>                    
                   <form id="categoryform" class="category__form form-horizontal">
                    <div class="panel-body">
                        <div class="p-xs">
                            <input name="_a" id="_a" type="hidden" value="new"/>
                                <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="col-sm-3 control-label text-left p-l-none">Name:</label>
                                    <div class="col-sm-9 p-l-none">
                                        <input type="text" class="form-control input-sm" id="c_title" name="c_title" placeholder="Enter A Category Title" required>

                                    <span class="help-block text-danger"></span>
                                  </div>
                                </div>
                                </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="col-md-4 pull-right">
                            <button class="btn btn-info pull-right ladda-button" id="btn-submit"  data-style="expand-right"><i class="fa fa-check"></i> Submit</button>
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

<!-- <script src="scripts/category.js"></script> -->


<script type="text/javascript">
    


$(document).ready(function(){
//alert('d');


function resettable(){
 $("table tr").removeClass('animated pulse');
 $("table tr").removeClass('animated bounce');
}

var cfh=$(".category-form-holder");



$('button.btn-new-cat').on("click",function(){
  cfh.removeClass('hidden');
  cfh.removeClass('fadeOutUp');

    cfh.fadeTo('fast', 0.1, function() {
         $("#_a").val('new');
         $("#c_title").val('');
         $(".category-header").text('');
   });
  cfh.addClass('hide animated fadeOutDown');
  cfh.removeClass('animated fadeOutUp');
  cfh.removeClass('fadeOutUp');
  cfh.fadeIn('slow', function() {
    $(".category-header").text('New Category Form');
$(this).removeClass('hide animated fadeOutDown').addClass('animated fadeInUp');
  });
}); 




$('body').on('click','button.btn-edit',function(){
  cfh.removeClass('hidden');
  cfh.removeClass('fadeOutUp');
        cfh.fadeTo('slow', 0.1, function() {
        $("#_a").val('');
        $("#c_title").val('');
    });
$(".category-header").text('');
  var p=$(this);
  var i=p.data("id");
  var n=p.data("name");
  var _t=" Edit "+n;
  cfh.addClass('hide animated fadeOutDown');
  cfh.removeClass('animated fadeOutUp');
  cfh.removeClass('fadeOutUp');
  cfh.fadeIn('slow', function() {
    $(".category-header").text(_t);
    $("#_a").val(i);
    $("#c_title").val(n);
$(this).removeClass('hide animated fadeOutDown').addClass('animated fadeInUp');
  });
}); 






$('form#categoryform').on("submit",function(){

  var l = $( '#btn-submit' ).ladda();
 l.ladda( 'start' );

var _a = $("#_a").val();
var _t = $("#c_title").val();

var _att = (_a == 'new')?"Category Created!":"Category Updated!";
  $.ajax({
            url: 'lib/process-category.php',
            type: 'POST',
            data: $('#categoryform input'),
         //   data: $('#categoryform input[type=\'text\'], #categoryform textarea[name=\'c_code\']'),
          // data: $('#categoryform').serialize(),
            dataType: 'json',
            beforeSend: function (XMLHttpRequest) {
    //  alert('preloader_it');
                //preloader_it();
                $('#categoryform').fadeTo("slow", 0.33);
                $('#categoryform .has-error').removeClass('has-error');
                $('#categoryform .help-block').html('');
                $('#form_message').removeClass('alert-success').html('');
            },
            success: function( json, textStatus ) {
                if( json.error ) {
                 // Error messages
                    swal("Form Error", "kindly confirm that all fields are correct", "error");

                    if( json.error.title ) {
                        $('#categoryform input[name="c_title"]').parent().addClass('has-error');
                        $('#categoryform input[name="c_title"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.title );
                    }

                   if( json.error.category ) {
                        $('#form_message').html('<div class="alert alert-danger"> <strong> <i class="fa fa-warning"></i> Form Error</strong><br><br> ' + json.error.category + '</div>');
                    }
                }

                if( json.success ) {
                                swal({
                                        title: _att,
                                        text: "",
                                        type: "success"
                                    },
                                    function () {
                                        if(_a == 'new'){
                                        $('#categoryform')[0].reset();
                                            $("tbody.categorybody").prepend(json.trdata);                                         
                                            $("tr.cat"+json.new_id).addClass('animated bounce');

                                            setTimeout(resettable, 1 * 1000);
                                        }else{
                                            
                                            $("tr.cat"+_a).addClass('animated pulse');
                                            $("tr.cat"+_a+" td.tdcourse").text(_t);
                                            $("button.del"+_a).data('name',_t);
                                            $("button.edt"+_a).data('name',_t);

                                            setTimeout(resettable, 1 * 1000);
                                            
                                        }
                                        
                                       // $(".note-editable").html(' ');
                                    });
                }
                
            },
        complete: function( XMLHttpRequest, textStatus ) {
               l.ladda('stop');
            $('#categoryform').fadeTo("fast", 1);
        }
        });
        

  return false;
});











var deleteContainer=$("output.delete");
//$('button.btn-delete').on("click",function(){

$('body').on('click','button.btn-delete', function(){

  var i=$(this).data("id");
  var n=$(this).data("name");

                    swal({
                        title: "Are you sure?",
                        text: "Your will not be able to recover "+n,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: true,
                        closeOnCancel: true },
                    function (isConfirm) {
                        if (isConfirm) {


 // var l = Ladda.create('.del'+i);
  var l = $( '.del'+i ).ladda();
            l.ladda( 'start' );

  var cf=$(".cat"+i);
  //alert(".picture"+i);//
    //if(confirm(' Are you sure you want to delete '+t+'? \n\n Note: these action can not be reverse')){
  var dataString='n='+n+'&i='+i+'&_a=delete';
   console.log(dataString);
 //return false;


   $.ajax({
    type:"POST",
    url:"lib/process-category.php",
    data:dataString,
    cache:false,
    dataType: 'json',
    beforeSend:function(){cf.addClass('error');},
   success: function( json, textStatus ) {
   //console.log(json);
       if( json.error ) {
                    $(cf).removeClass("error").addClass('warning');
                   // Error messages
                    if( json.error.delete ) {
                        swal("An Error Occured!", json.error.delete, "error");
                    }
                }
      if( json.success ) {
           //alert('successxxxxx');
                           $(cf).addClass('animated hinge').delay(850).fadeOut('slow');
               swal({
                        title: "Deleted!",
                        text: "Category has been deleted.",
                        type: "success",
                    },
                    function () {
                    });
               }

    },
    complete: function( XMLHttpRequest, textStatus ) {
                    l.ladda('stop');
                 }
    });


  }
}
);

  return false;
});




});

</script>