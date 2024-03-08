$(document).ready(function(e) {


    var l = $( '.ladda-button' ).ladda();
        l.click(function(){
            // Start loading
            l.ladda( 'start' );
            // Timeout example
            // Do something in backend and then stop ladda

   // $('.reg__form').on('submit', function(e) {
	//	event.preventDefault();
        $.ajax({
            url: 'lib/form-process-reg.php',
            type: 'POST',
            data: $('.reg__form').serialize(),
            dataType: 'json',
            beforeSend: function (XMLHttpRequest) {
	//	alert('preloader_it');
				//preloader_it();
                $('.reg__form').fadeTo("slow", 0.33);
                $('.reg__form .has-error').removeClass('has-error');
                $('.reg__form .help-block').html('');
                $('#form_message').removeClass('alert-success').html('');
            },
            success: function( json, textStatus ) {
                   l.ladda('stop');
                if( json.error ) {
                 // Error messages
                             swal("Registeration Error", "kindly confirm that all fields are correct", "error");
                    if( json.error.fname ) {
                        $('.reg__form input[name="r_fname"]').parent().addClass('has-error');
                        $('.reg__form input[name="r_fname"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.fname );
                    }
                    if( json.error.email ) {
                        $('.reg__form input[name="r_email"]').parent().addClass('has-error');
                        $('.reg__form input[name="r_email"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.email );
                    }
                    if( json.error.lname ) {
                        $('.reg__form input[name="r_lname"]').parent().addClass('has-error');
                        $('.reg__form input[name="r_lname"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.lname );
                    }
                     if( json.error.pass ) {
                        $('.reg__form input[name="r_password"]').parent().addClass('has-error');
                        $('.reg__form input[name="r_password"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.pass );
                    }
                     if( json.error.pass2 ) {
                        $('.reg__form input[name="r_password2"]').parent().addClass('has-error');
                        $('.reg__form input[name="r_password2"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.pass2 );
                    }
                     if( json.error.phone ) {
                        $('.reg__form input[name="r_phone"]').parent().addClass('has-error');
                        $('.reg__form input[name="r_phone"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.phone );
                    }

                   if( json.error.reg ) {
                        $('#form_message').html('<div class="alert alert-danger"> <strong> <i class="fa fa-warning"></i> Form Error</strong><br><br> ' + json.error.reg + '</div>');
                    }




                    if( json.error.recaptcha ) {
                        $('#form-captcha').addClass('has-error');
                     //   $('#form-captcha .help-block').html( json.error.recaptcha );
                      //   Recaptcha.reload();
                    }
                }

                if( json.success ) {
                      //   Recaptcha.reload();
					           $('.reg__form')[0].reset();
                                 swal({
                                        title: "Information Recieved!",
                                        text: json.success,
                                        type: "success"
                                    });

                }
                
            },
            complete: function( XMLHttpRequest, textStatus ) {
                $('.reg__form').fadeTo("fast", 1);
            }
        });
        
      //  return false;
   // });




        });



});