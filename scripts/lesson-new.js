
$(document).ready(function(e) {


/*
r_title:Bro
r_dept:LWNM
r_fname:Oluwafemi
r_lname:Epebinu
r_pasword:joketwo16
r_password:joketwo
r_email:epebinuoluwafemi@gmail.com
r_phone:07088281068
*/


    // var l = $( '.ladda-button' ).ladda();
    //     l.click(function(){
    //         // Start loading
    //         l.ladda( 'start' );


            // Timeout example
            // Do something in backend and then stop ladda

   $('#lessonform').on('submit', function(e) {

		event.preventDefault();
    var l = $( '#lessonform .ladda-button' ).ladda();
        $.ajax({
            url: 'lib/process-lesson.php',
            type: 'POST',
            data: $('#lessonform input, #lessonform textarea, #lessonform select'),
          //  data: $('#lessonform input[type=\'text\'], #lessonform textarea, #lessonform select'),
         //   data: $('#lessonform input[type=\'text\'], #lessonform textarea[name=\'c_code\']'),
          // data: $('#lessonform').serialize(),
            dataType: 'json',
            beforeSend: function (XMLHttpRequest) {
	//	alert('preloader_it');
				//preloader_it();
            // Start loading
            l.ladda( 'start' );




                $('#lessonform').fadeTo("slow", 0.33);
                $('#lessonform .has-error').removeClass('has-error');
                $('#lessonform .help-block').html('');
                $('#addlesson_message').removeClass('alert-success').html('');
            },
            success: function( json, textStatus ) {
                if( json.error ) {
                 // Error messages
                             swal("Form Error", "kindly confirm that all fields are correct", "error");
                    if( json.error.subject ) {
                        $('#lessonform input[name="c_subject"]').parent().addClass('has-error');
                        $('#lessonform input[name="c_subject"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.subject );
                    }
                    if( json.error.code ) {
                        $('.email-compose .panel-body').addClass('has-error');
                        $('.email-compose #questionhelp').html('<i class="fa fa-warning"></i> ' + json.error.code );
                    }
                   if( json.error.lesson ) {
                        $('#addlesson_message').html('<div class="alert alert-danger"> <strong> <i class="fa fa-warning"></i> Form Error</strong><br><br> ' + json.error.lesson + '</div>');
                    }
                }

                if( json.success ) {
                      //   Recaptcha.reload();
                   // $('#addlesson_message').addClass('alert-success').html( json.success );
                                swal({
                                        title: "Lesson Submitted!",
                                        text: "Kindly add some lessons or lecture to the newly added lesson",
                                        type: "success"
                                    },
                                    function () {
                                        $('#lessonform')[0].reset();
                                        $(".note-editable").html(' ');

                                    $("tbody.lessonbody").prepend(json.lssIdTr);                                         
                                    $("tr.lesson"+json.lssId).addClass('animated bounce');


                                    });

/***


                                $("tbody.schedulebody").prepend(json.ScheduleTr);                                         
                                $("tr.schedule"+json.new_id).addClass('animated bounce');

                                 $("#total_schedule").val( +tschedule + +  1 );




                                    <tr class="tr<?=$id?>">
                                      <td><?=$lesson?></td>
                                      <td><?=$title?></td>
                                      <td><?=$duration?></td>
                                      <td><?=$date?></td>
                                      <td>
                                      <div class="btn-group btn-group-sm pull-right">
                                        <button data-id="<?=$id?>" data-type="lesson" data-name="<?=$title?>" class="del<?=$id?> btn btn-outline btn-danger btn-delete ladda-button" data-style="zoom-out"> <i class="pe pe-7s-trash fa-lg"></i> Delete </button>
                                      </div> 
                                      </td><!--   -->
                                    </tr>

*/


                }
                
            },
            complete: function( XMLHttpRequest, textStatus ) {
                   l.ladda('stop');
                $('#lessonform').fadeTo("fast", 1);
            }
        });
        
      //  return false;
   // });




        });



});