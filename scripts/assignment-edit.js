
$(document).ready(function(e) {


    var l = $( '.ladda-button' ).ladda();
        l.click(function(){
            // Start loading
            l.ladda( 'start' );


            // Timeout example
            // Do something in backend and then stop ladda

   // $('#assignmentform').on('submit', function(e) {
	//	event.preventDefault();
        $.ajax({
            url: 'lib/process-assignment.php',
            type: 'POST',
            data: $('#assignmentform input[type=\'hidden\'], #assignmentform input[type=\'text\'], #assignmentform textarea, #assignmentform select'),
            dataType: 'json',
            beforeSend: function (XMLHttpRequest) {
	//	alert('preloader_it');
				//preloader_it();
                $('#assignmentform').fadeTo("slow", 0.33);
                $('#assignmentform .has-error').removeClass('has-error');
                $('#assignmentform .help-block').html('');
                $('#form_message').removeClass('alert-success').html('');
            },
            success: function( json, textStatus ) {
                if( json.error ) {
                 // Error messages
                             swal("Form Error", "kindly confirm that all fields are correct", "error");
                    if( json.error.path ) {
                        $('#assignmentform input[name="a_path"]').parent().addClass('has-error');
                        $('#assignmentform input[name="a_path"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.path );
                    }
                    if( json.error.code ) {
                        $('.email-compose .panel-body').addClass('has-error');
                        $('.email-compose #questionhelp').html('<i class="fa fa-warning"></i> ' + json.error.code );
                    }
                   if( json.error.assignment ) {
                        $('#form_message').html('<div class="alert alert-danger"> <strong> <i class="fa fa-warning"></i> Form Error</strong><br><br> ' + json.error.assignment + '</div>');
                    }
                }

                if( json.success ) {
                      //   Recaptcha.reload();
                   // $('#form_message').addClass('alert-success').html( json.success );
                                swal({
                                        title: "Assignment Updated!",
                                        text: "",
                                        type: "success"
                                    },
                                    function () {
                                        window.location = 'assignment-all.php';
                                    });

                }
                
            },
            complete: function( XMLHttpRequest, textStatus ) {
                   l.ladda('stop');
                $('#assignmentform').fadeTo("fast", 1);
            }
        });
        
      //  return false;
   // });




        });



});