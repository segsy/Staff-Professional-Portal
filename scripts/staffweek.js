$(document).ready(function(e) {


    var l = $( '.ladda-button' ).ladda();
        l.click(function(){
            // Start loading
            l.ladda( 'start' );
            // Timeout example
            // Do something in backend and then stop ladda

   // $('.reg__form__staffweek').on('submit', function(e) {
	//	event.preventDefault();
        $.ajax({
            url: 'lib/form-process-staffweek.php',
            type: 'POST',
            data: $('.reg__form__staffweek').serialize(),
            dataType: 'json',
            beforeSend: function (XMLHttpRequest) {
	//	alert('preloader_it');
				//preloader_it();
                $('.reg__form__staffweek').fadeTo("slow", 0.33);
                $('.reg__form__staffweek .has-error').removeClass('has-error');
                $('.reg__form__staffweek .help-block').html('');
                $('#form_message').removeClass('alert-success').html('');
            },
            success: function( json, textStatus ) {
                   l.ladda('stop');
                if( json.error ) {
                 // Error messages
                             swal("Registeration Error", "kindly confirm that all fields are correct", "error");

                    if( json.error.fname ) {
                        $('.reg__form__staffweek input[name="fname"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="fname"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.fname );
                    }
                    if( json.error.title ) {
                        $('.reg__form__staffweek input[name="title"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="title"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.title );
                    }
                    if( json.error.lname ) {
                        $('.reg__form__staffweek input[name="lname"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="lname"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.lname );
                    }
                     if( json.error.gender ) {
                        $('.reg__form__staffweek input[name="gender"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="gender"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.gender );
                    }
                     if( json.error.jobfamily ) {
                        $('.reg__form__staffweek input[name="jobfamily"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="jobfamily"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.jobfamily );
                    }
                     if( json.error.zone ) {
                        $('.reg__form__staffweek input[name="zone"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="zone"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.zone );
                    }
                     if( json.error.date_training ) {
                        $('.reg__form__staffweek input[name="date_training"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="date_training"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.date_training );
                    }
                     if( json.error.prof_level ) {
                        $('.reg__form__staffweek input[name="prof_level"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="prof_level"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.prof_level );
                    }
                     if( json.error.take_course ) {
                        $('.reg__form__staffweek input[name="take_course"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="take_course"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.take_course );
                    }
                    if( json.error.preffered_time ) {
                        $('.reg__form__staffweek input[name="preffered_time"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="preffered_time"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.preffered_time );
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
					           $('.reg__form__staffweek')[0].reset();
                                 swal({
                                        title: "Information Recieved!",
                                        text: json.success,
                                        type: "success"
                                    });

                }
                
            },
            complete: function( XMLHttpRequest, textStatus ) {
                $('.reg__form__staffweek').fadeTo("fast", 1);
            }
        });
        
      //  return false;
   // });




        });



});