
$(document).ready(function(){
//alert('d');


$('form#categoryform').on("click",function(){

  var l = $( '#btn-submit' ).ladda();
            l.ladda( 'start' );


alert('submitted');
  return false;
});














var deleteContainer=$("output.delete");

$('button.btn-delete').on("click",function(){

  var i=$(this).data("id");
  var n=$(this).data("name");
  var t=$(this).data("type");

                    swal({
                        title: "Are you sure?",
                        text: "Your will not be able to recover "+n,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#DD6B55",
                        confirmButtonText: "Yes, delete it!",
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: true,
                        closeOnCancel: true },
                    function (isConfirm) {
                        if (isConfirm) {


 // var l = Ladda.create('.del'+i);
  var l = $( '.del'+i ).ladda();
            l.ladda( 'start' );

  var cf=$(".tr"+i);
  //alert(".picture"+i);//
    //if(confirm(' Are you sure you want to delete '+t+'? \n\n Note: these action can not be reverse')){
  var dataString='n='+n+'&i='+i+'&t='+t+'&_a=delete';
   console.log(dataString);
 //return false;


   $.ajax({
    type:"POST",
    url:"lib/process-delete.php",
    data:dataString,
    cache:false,
    dataType: 'json',
    beforeSend:function(){cf.addClass('error');},
   success: function( json, textStatus ) {
   //console.log(json);
       if( json.error ) {
                    $(cf).removeClass("error").addClass('warning');
                   // Error messages
                    if( json.error.delete ) {
                        swal("An Error Occured!", json.error.delete, "error");
                    }
                }
      if( json.success ) {
           //alert('successxxxxx');
               swal({
                        title: "Deleted!",
                        text: "Information has been deleted.",
                        type: "success",
                    },
                    function () {
                           $(cf).addClass('animated hinge').delay(850).fadeOut('slow');
                    });
               }

    },
    complete: function( XMLHttpRequest, textStatus ) {
                    l.ladda('stop');
                 }
    });


  }
}
);

  return false;
});




});