
$(document).ready(function(e) {



$( '.filter-item.void' ).click(function(event) {
    swal("Enroll To Participate", "Enroll for this course to gain access, its free", "warning");
      return false;
});
var _en_cs = $( '.ladda-button' ).data('cs');
    var l = $( '.ladda-button' ).ladda();
        l.click(function(){
            // Start loading
            l.ladda( 'start' );

       // console.log(summercode);
        // console.log(_en_cs);

            // Timeout example
            // Do something in backend and then stop ladda

   // $('#askform').on('submit', function(e) {
	//	event.preventDefault();
        $.ajax({
            url: 'lib/process-program.php',
            type: 'POST',
            data: "a_=enroll&cs="+_en_cs,
            dataType: 'json',
 
            success: function( json, textStatus ) {
                      // console.log(json);

                if( json.error ) {
                   // alert(json.error);
                    if( json.error.subscription ) {
                        swal("Access denied!", "Contact your admin to enroll for this course to gain access, its free", "warning");
                    }
                    
                }

                if( json.success ) {
                      window.location = 'lessonsession.php?_l='+json.success+'&cs='+_en_cs;
                        //  console.log('lessonsession.php?_l='+json.success+'&cs='+_en_cs);
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