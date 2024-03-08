
$(document).ready(function(e) {



$( '.filter-item.void' ).click(function(event) {
    swal("Enroll To Participate", "Enroll for this course to gain access, its free", "warning");
      return false;
});

    var l = $( '.ladda-button' ).ladda();
        l.click(function(){
            // Start loading
            l.ladda( 'start' );

       // console.log(summercode);
        console.log(l.data('cs'));

            // Timeout example
            // Do something in backend and then stop ladda

   // $('#askform').on('submit', function(e) {
	//	event.preventDefault();
        $.ajax({
            url: 'lib/process-program.php',
            type: 'POST',
            data: "a_=enroll&cs="+l.data('cs'),
            dataType: 'json',
 
            success: function( json, textStatus ) {
                if( json.error ) {
                   // alert(json.error);
                    if( json.error.subscription ) {
                        swal("Access denied!", "Contact your admin to enroll for this course to gain access, its free", "warning");
                    }
                    
                }

                if( json.success ) {
                        window.location = 'lessonsession.php?_l=1&cs='+l.data('cs');
                }
                
            },
            complete: function( XMLHttpRequest, textStatus ) {
                   l.ladda('stop');
            }
        });
        
      //  return false;
   // });




        });



});