    $(function () {


$('button.btn-disable').on("click",function(){

  var i=$(this).data("id");
  var n=$(this).data("name");
  var s=$(this).data("status");
  var t=$(this).data("type");
  var l = $(this).ladda();

var sttitle = (s == 0)?"You want to enable "+n:"You want to disable "+n;
var sttext = (s == 0)?"Enable!":"Disable!";
var stcolor = (s == 0)?"#3E8BEA":"#DD6B55";
                    swal({
                        title: "Are you sure?",
                        text: sttitle,
                        type: "warning",
                        showCancelButton: true,
                        confirmButtonColor: stcolor,
                        confirmButtonText: sttext,
                        cancelButtonText: "No, cancel it!",
                        closeOnConfirm: true,
                        closeOnCancel: true },
                    function (isConfirm) {
                        if (isConfirm) {


 // var l = Ladda.create('.del'+i);
  // var l = $( this ).ladda();
            l.ladda( 'start' );

  // var cf=$(".tr"+i);
  //alert(".picture"+i);//
    //if(confirm(' Are you sure you want to delete '+t+'? \n\n Note: these action can not be reverse')){
  var dataString='i='+i+'&s='+s+'&t='+t;
   console.log(dataString);
 //return false;


   $.ajax({
    type:"POST",
    url:"lib/process-course-status.php",
    data:dataString,
    cache:false,
    dataType: 'json',
    // beforeSend:function(){cf.addClass('error');},
   success: function( json, textStatus ) {
   //console.log(json);
       if( json.error ) {
                    // $(cf).removeClass("error").addClass('warning');
                   // Error messages
                    // if( json.error.enroll ) {
                        // swal("An Error Occured!", json.error.enroll, "error");
                        swal("An Error Occured!", json.error, "error");
                    // }
                }
      if( json.success ) {
            window.location.reload();
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