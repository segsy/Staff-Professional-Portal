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
            url: 'lib/form-process-gap.php',
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

                    if( json.error.title ) {
                        $('.reg__form__staffweek input[name="title"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="title"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.phoneNumber );
                    }                    
                    if( json.error.fname ) {
                        $('.reg__form__staffweek input[name="fname"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="fname"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.fname );
                    }

                    if( json.error.lname ) {
                        $('.reg__form__staffweek input[name="lname"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="lname"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.lname );
                    }
                    if( json.error.phoneNumber ) {
                        $('.reg__form__staffweek input[name="phoneNumber"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="phoneNumber"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.phoneNumber );
                    }
                    if( json.error.email ) {
                        $('.reg__form__staffweek input[name="email"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="email"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.email );
                    }                     
                    if( json.error.department ) {
                        $('.reg__form__staffweek input[name="department"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="department"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.department );
                    }
                     if( json.error.jobfunction ) {
                        $('.reg__form__staffweek input[name="jobfunction"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="jobfunction"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.jobfunction );
                    }
                     if( json.error.take_course ) {
                        $('.reg__form__staffweek input[name="take_course"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="take_course"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.take_course );
                    }
                     if( json.error.take_course_review_yes ) {
                        $('.reg__form__staffweek input[name="take_course_review_yes"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="take_course_review_yes"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.take_course_review_yes );
                    }
                     if( json.error.take_course_review_no ) {
                        $('.reg__form__staffweek input[name="take_course_review_no"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="take_course_review_no"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.take_course_review_no );
                    }
                     if( json.error.take_course_review_other_reason ) {
                        $('.reg__form__staffweek textarea[name="take_course_review_other_reason"]').parent().addClass('has-error');
                        $('.reg__form__staffweek textarea[name="take_course_review_other_reason"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.take_course_review_other_reason );
                    }
                     if( json.error.onsite_training ) {
                        $('.reg__form__staffweek input[name="onsite_training"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="onsite_training"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.onsite_training );
                    }
                     if( json.error.onsite_training_review_yes ) {
                        $('.reg__form__staffweek input[name="onsite_training_review_yes"]').parent().addClass('has-error');
                        $('.reg__form__staffweek input[name="onsite_training_review_yes"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.onsite_training_review_yes );
                    }
                   if( json.error.jobPerf ) {
                        $('.reg__form__staffweek textarea[name="jobPerf"]').parent().addClass('has-error');
                        $('.reg__form__staffweek textarea[name="jobPerf"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.jobPerf );
                    }
                   if( json.error.trainPerf ) {
                        $('.reg__form__staffweek textarea[name="trainPerf"]').parent().addClass('has-error');
                        $('.reg__form__staffweek textarea[name="trainPerf"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.trainPerf );
                    }
                    if( json.error.persTrainNeeds1 ) {
                        $('.reg__form__staffweek textarea[name="persTrainNeeds1"]').parent().addClass('has-error');
                        $('.reg__form__staffweek textarea[name="persTrainNeeds1"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.persTrainNeeds1 );
                    }
                   if( json.error.persTrainNeeds2 ) {
                        $('.reg__form__staffweek textarea[name="persTrainNeeds2"]').parent().addClass('has-error');
                        $('.reg__form__staffweek textarea[name="persTrainNeeds2"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.persTrainNeeds2 );
                    }
                   if( json.error.persTrainNeeds3 ) {
                        $('.reg__form__staffweek textarea[name="persTrainNeeds3"]').parent().addClass('has-error');
                        $('.reg__form__staffweek textarea[name="persTrainNeeds3"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.persTrainNeeds3 );
                    }
                   if( json.error.persTrainNeeds4 ) {
                        $('.reg__form__staffweek textarea[name="persTrainNeeds4"]').parent().addClass('has-error');
                        $('.reg__form__staffweek textarea[name="persTrainNeeds4"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.persTrainNeeds4 );
                    }
                   if( json.error.persTrainNeeds5 ) {
                        $('.reg__form__staffweek textarea[name="persTrainNeeds5"]').parent().addClass('has-error');
                        $('.reg__form__staffweek textarea[name="persTrainNeeds5"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.persTrainNeeds5 );
                    }
                   if( json.error.addComments ) {
                        $('.reg__form__staffweek textarea[name="addComments"]').parent().addClass('has-error');
                        $('.reg__form__staffweek textarea[name="addComments"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.addComments );
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