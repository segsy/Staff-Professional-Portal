    $(function () {

        // Initialize summernote plugin
        $('.summernote').summernote({
        placeholder: 'Course Description Goes Here...',
        height: 350,
            toolbar: [
                ['headline', ['style']],
                ['style', ['bold', 'italic', 'underline', 'superscript', 'subscript', 'strikethrough', 'clear']],
                ['textsize', ['fontsize']],
                ['alignment', ['ul', 'ol', 'paragraph', 'lineheight']],
            ]
        });

    });
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


    var l = $( '.ladda-button' ).ladda();
        l.click(function(){
            // Start loading
            l.ladda( 'start' );

        var summercode = $('.summernote').code();
       // console.log(summercode);
        $('#courseform textarea[name=\'c_code\']').val(summercode);

            // Timeout example
            // Do something in backend and then stop ladda

   // $('#courseform').on('submit', function(e) {
	//	event.preventDefault();
        var formData = new FormData($('#courseform')[0]);
        
      $.ajax({
            url: 'lib/process-course.php',
            type: 'POST',
            data: formData,
            async: false,
       cache: false,
       contentType: false,
       enctype: 'multipart/form-data',
       processData: false,
            dataType: 'json',
            beforeSend: function (XMLHttpRequest) {

                $('#courseform').fadeTo("slow", 0.33);
                $('#courseform .has-error').removeClass('has-error');
                $('#courseform .help-block').html('');
                $('#form_message').removeClass('alert-success').html('');
            },
            success: function( json, textStatus ) {
                if( json.error ) {
                 // Error messages
                             swal("Form Error", "kindly confirm that all fields are correct", "error");
                    if( json.error.title ) {
                        $('#courseform input[name="c_title"]').parent().addClass('has-error');
                        $('#courseform input[name="c_title"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.title );
                    }
                       if( json.error.category ) {
                        $('#courseform select[name="c_category"]').parent().addClass('has-error');
                        $('#courseform select[name="c_category"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.category );
                    }                       
                       if( json.error.duration ) {
                        $('#courseform input[name="c_duration"]').parent().addClass('has-error');
                        $('#courseform input[name="c_duration"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.duration );
                    }                      
                     if( json.error.upload ) {
                        $('#courseform input[name="c_picture"]').parent().addClass('has-error');
                        $('#courseform input[name="c_picture"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.upload );
                    }                  
                     if( json.error.code ) {
                        $('.email-compose .panel-body').addClass('has-error');
                        $('.email-compose #questionhelp').html('<i class="fa fa-warning"></i> ' + json.error.code );
                    }
                   if( json.error.course ) {
                        $('#form_message').html('<div class="alert alert-danger"> <strong> <i class="fa fa-warning"></i> Form Error</strong><br><br> ' + json.error.course + '</div>');
                    }
                }

                if( json.success ) {
                      //   Recaptcha.reload();
                   // $('#form_message').addClass('alert-success').html( json.success );
                                swal({
                                        title: "Course Submitted!",
                                        text: "Kindly add some lessons or lecture to the newly added course",
                                        type: "success"
                                    },
                                    function () {
                                        $('#courseform')[0].reset();
                                        $(".note-editable").html(' ');
                                         window.location = 'course-new-add-lesson.php?cs='+json.goto;
                                    });

                }
                
            },
            complete: function( XMLHttpRequest, textStatus ) {
                   l.ladda('stop');
                $('#courseform').fadeTo("fast", 1);
            }
        });
        
        return false;
   // });




        });



});