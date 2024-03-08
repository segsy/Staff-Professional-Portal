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

  //  $('.log__form').submit(function(e) {
  //  $('.log__form').on('submit', function(e) {
	//	event.preventDefault();
        $.ajax({
            url: 'lib/form-process-log.php',
            type: 'POST',
            data: $('.log__form').serialize(),
            dataType: 'json',
            beforeSend: function (XMLHttpRequest) {
	//	alert('preloader_it');
				//preloader_it();
                $('.log__form').fadeTo("slow", 0.33);
                $('.log__form .has-error').removeClass('has-error');
                $('.log__form .help-block').html('');
                $('#form_message').removeClass('alert-success').html('');
            },
            success: function( json, textStatus ) {
                if( json.error ) {
                    l.ladda('stop');
                   // Error messages
                    swal("Invalid Login", "", "error");
                    if( json.error.email ) {
                        $('.log__form input[name="l_email"]').parent().addClass('has-error');
                        $('.log__form input[name="l_email"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.email );
                    }
                    if( json.error.pass ) {
                        $('.log__form input[name="l_password"]').parent().addClass('has-error');
                        $('.log__form input[name="l_password"]').next('.help-block').html('<i class="fa fa-warning"></i> ' + json.error.pass );
                    }
                    if( json.error.log ) {
                        $('#form_message').html('<div class="alert alert-danger"> <strong> <i class="fa fa-warning"></i> Login Error</strong><br><br> ' + json.error.log + '</div>');
                    }
                   if( json.error.recaptcha ) {
                        $('#form-captcha').addClass('has-error');
                     //   $('#form-captcha .help-block').html( json.error.recaptcha );
                      //   Recaptcha.reload();
                    }
                }

                if( json.success ) {

                    if(json.loc){
                        window.location = json.loc;
                    }else{
                        window.location = 'dashboard.php';
                    }
        

                }
                
            },
            complete: function( XMLHttpRequest, textStatus ) {
              //  preloader_st();
                $('.log__form').fadeTo("fast", 1);
            }
        });
        
      //  return false;
    });
});