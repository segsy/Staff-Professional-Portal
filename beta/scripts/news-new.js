    $(function () {

        // Initialize summernote plugin
        $('.summernote').summernote({
        placeholder: 'News Informtaion Goes Here...',
        height: 150,
        toolbar: [
            ['style', ['italic', 'bold', 'underline', 'strikethrough', 'clear']],
            ['textsize', ['fontsize']],
            ['color', ['color']],
            ['insert', ['link']],

        ]
        });

    });
$(document).ready(function(e) {


    var l = $( '.ladda-button' ).ladda();
        l.click(function(){
            // Start loading
            l.ladda( 'start' );

        var summercode = $('.summernote').code();
       // console.log(summercode);
        $('#newsform textarea[name=\'c_code\']').val(summercode);

            // Timeout example
            // Do something in backend and then stop ladda

   // $('#newsform').on('submit', function(e) {
	//	event.preventDefault();
        var formData = new FormData($('#newsform')[0]);
        
      $.ajax({
            url: 'lib/process-news.php',
            type: 'POST',
            data: formData,
            async: false,
       cache: false,
       contentType: false,
       enctype: 'multipart/form-data',
       processData: false,
            dataType: 'json',
            beforeSend: function (XMLHttpRequest) {

                $('#newsform').fadeTo("slow", 0.33);
                $('#newsform .has-error').removeClass('has-error');
                $('#newsform .help-block').html('');
                $('#form_message').removeClass('alert-success').html('');
            },
            success: function( json, textStatus ) {
                if( json.error ) {
                 // Error messages
                             swal("Form Error", "kindly confirm that all fields are correct", "error");
                    if( json.error.title ) {
                        $('#newsform input[name="c_title"]').parent().addClass('has-error');
                        $('#newsform input[name="c_title"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.title );
                    }             
                     if( json.error.code ) {
                        $('.email-compose .panel-body').addClass('has-error');
                        $('.email-compose #questionhelp').html('<i class="fa fa-warning"></i> ' + json.error.code );
                    }
                   if( json.error.news ) {
                        $('#form_message').html('<div class="alert alert-danger"> <strong> <i class="fa fa-warning"></i> Form Error</strong><br><br> ' + json.error.news + '</div>');
                    }
                }

                if( json.success ) {
                      //   Recaptcha.reload();
                   // $('#form_message').addClass('alert-success').html( json.success );
                                swal({
                                        title: "News Submitted!",
                                       // text: "Kindly add some lessons or lecture to the newly added news",
                                        type: "success"
                                    },
                                    function () {
                                        $('#newsform')[0].reset();
                                        $(".note-editable").html(' ');
                                    });

                }
                
            },
            complete: function( XMLHttpRequest, textStatus ) {
                   l.ladda('stop');
                $('#newsform').fadeTo("fast", 1);
            }
        });
        
        return false;
   // });




        });



});