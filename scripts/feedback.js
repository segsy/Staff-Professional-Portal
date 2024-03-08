    $(function () {

        // Initialize summernote plugin
        $('.summernote').summernote({
        placeholder: 'Your Feedback Message Here...',
        height: 200,
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
        $('#contactform textarea[name=\'c_code\']').val(summercode);

            // Timeout example
            // Do something in backend and then stop ladda

   // $('#contactform').on('submit', function(e) {
	//	event.preventDefault();
        var formData = new FormData($('#contactform')[0]);
        
      $.ajax({
            url: 'lib/form-process-feedback.php',
            type: 'POST',
            data: formData,
            async: false,
       cache: false,
       contentType: false,
       enctype: 'multipart/form-data',
       processData: false,
            dataType: 'json',
            beforeSend: function (XMLHttpRequest) {

                $('#contactform').fadeTo("slow", 0.33);
                $('#contactform .has-error').removeClass('has-error');
                $('#contactform .help-block').html('');
                $('#form_message').removeClass('alert-success').html('');
            },
            success: function( json, textStatus ) {
                if( json.error ) {
                 // Error messages
                             swal("Form Error", "kindly confirm that all fields are correct", "error");
                    if( json.error.title ) {
                        $('#contactform input[name="c_subject"]').parent().addClass('has-error');
                        $('#contactform input[name="c_subject"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.title );
                    }                
                     if( json.error.code ) {
                        $('.email-compose .panel-body').addClass('has-error');
                        $('.email-compose #questionhelp').html('<i class="fa fa-warning"></i> ' + json.error.code );
                    }
                   if( json.error.contact ) {
                        $('#form_message').html('<div class="alert alert-danger"> <strong> <i class="fa fa-warning"></i> Form Error</strong><br><br> ' + json.error.course + '</div>');
                    }
                }

                if( json.success ) {
                      //   Recaptcha.reload();
                   // $('#form_message').addClass('alert-success').html( json.success );
                                swal({
                                        title: "Feedback Recieved!",
                                        text: "Thank you, we will surely get back to you.",
                                        type: "success"
                                    },
                                    function () {
                                        $('#contactform')[0].reset();
                                        $(".note-editable").html(' ');
                                    });

                }
                
            },
            complete: function( XMLHttpRequest, textStatus ) {
                   l.ladda('stop');
                  $('#contactform').fadeTo("slow", 1);
          }
        });
        
        return false;
   // });




        });



});