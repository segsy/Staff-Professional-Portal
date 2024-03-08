
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


            // Timeout example
            // Do something in backend and then stop ladda

   // $('#slideform').on('submit', function(e) {
	//	event.preventDefault();
        $.ajax({
            url: 'lib/process-slide.php',
            type: 'POST',
            data: $('#slideform input, #slideform textarea, #slideform select'),
          //  data: $('#slideform input[type=\'text\'], #slideform textarea, #slideform select'),
         //   data: $('#slideform input[type=\'text\'], #slideform textarea[name=\'c_code\']'),
          // data: $('#slideform').serialize(),
            dataType: 'json',
            beforeSend: function (XMLHttpRequest) {
	//	alert('preloader_it');
				//preloader_it();
                $('#slideform').fadeTo("slow", 0.33);
                $('#slideform .has-error').removeClass('has-error');
                $('#slideform .help-block').html('');
                $('#form_message').removeClass('alert-success').html('');
            },
            success: function( json, textStatus ) {
                if( json.error ) {
                 // Error messages
                             swal("Form Error", "kindly confirm that all fields are correct", "error");
                    if( json.error.subject ) {
                        $('#slideform input[name="c_subject"]').parent().addClass('has-error');
                        $('#slideform input[name="c_subject"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.subject );
                    }
                    if( json.error.code ) {
                        $('.email-compose .panel-body').addClass('has-error');
                        $('.email-compose #questionhelp').html('<i class="fa fa-warning"></i> ' + json.error.code );
                    }
                   if( json.error.slide ) {
                        $('#form_message').html('<div class="alert alert-danger"> <strong> <i class="fa fa-warning"></i> Form Error</strong><br><br> ' + json.error.slide + '</div>');
                    }
                }

                if( json.success ) {
                      //   Recaptcha.reload();
                   // $('#form_message').addClass('alert-success').html( json.success );
                                swal({
                                        title: "slide Submitted!",
                                        text: "Kindly add some slides or lecture to the newly added slide",
                                        type: "success"
                                    },
                                    function () {
                                        $('#slideform')[0].reset();
                                        $(".note-editable").html(' ');
                                    });

                }
                
            },
            complete: function( XMLHttpRequest, textStatus ) {
                   l.ladda('stop');
                $('#slideform').fadeTo("fast", 1);
            }
        });
        
      //  return false;
   // });




        });



});