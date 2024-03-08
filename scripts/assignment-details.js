
$(document).ready(function(e) {



    var l = $( '.ladda-button' ).ladda();
        l.click(function(){
            // Start loading
            l.ladda( 'start' );
      var formData = new FormData($('#assignform')[0]);

        $.ajax({
            url: 'lib/process-assignm-frontpage.php',
            type: 'POST',
            data: formData,
            async: false,
       cache: false,
       contentType: false,
       enctype: 'multipart/form-data',
       processData: false,
            dataType: 'json',
            beforeSend: function (XMLHttpRequest) {
	//	alert('preloader_it');
				//preloader_it();
                $('#assignform').fadeTo("slow", 0.33);
                $('#assignform .has-error').removeClass('has-error');
                $('#assignform .help-block').html('');
                $('#form_message').removeClass('alert-success').html('');
            },
            success: function( json, textStatus ) {
                if( json.error ) {
                             swal("Form Error", "An error has occured", "error");
                    if( json.error.file ) {
                        $('#assignform input[type="file"]').parent().addClass('has-error');
                        $('#assignform input[type="file"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.file );
                    }
                     if( json.error.upload ) {
                         $('#form_message').html('<div class="alert alert-danger"> <strong> <i class="fa fa-warning"></i> Form Error</strong><br><br> ' + json.error.upload + '</div>');
                   }                  

                }

                if( json.success ) {
                                swal({
                                        title: "Assignment Submitted!",
                                       // text: "Kindly add some lessons or lecture to the newly added course",
                                        type: "success"
                                    },
                                    function () {
                                        $('#assignform')[0].reset();
                                        $('#upload_answer').addClass('animated hinge').delay(850).fadeOut('slow');

                                        setTimeout(function(){
                                            $('#upload_answer').remove();
                                            //  console.log('clear mediaticker');
                                              },3 * 1000);


                                    });

                }
                
            },
            complete: function( XMLHttpRequest, textStatus ) {
                   l.ladda('stop');
                $('#assignform').fadeTo("fast", 1);
            }
        });
        
        return false;
   // });




        });



});