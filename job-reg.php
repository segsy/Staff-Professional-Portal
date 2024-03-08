<?php 
include"nav-landing.php";
?>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Pacifico">
<style type="text/css">
  .reg_form_new .reg_form_intro, .reg_form_new .reg_form_input .hpanel .panel-body {
    min-height: 740px;
}
#components {
    position: absolute;
    top: 0px;
    width: 100%;
        height: 100%;
    }
.reg_form_new .reg_form_intro .inf0 h4 {
    font-size: 18px;
}
#particles-js {
    width: 100%;
    height: 100vh;
/*    background: rgb(0,212,255);
background: radial-gradient(circle, rgba(0,212,255,1) 0%, rgba(9,9,121,1) 100%);
background: radial-gradient(circle, rgba(3,185,172,1) 0%, rgba(1,26,194,1) 100%);*/
background: rgb(3,185,172);
background: radial-gradient(circle, rgba(3,185,172,1) 0%, rgba(0,100,149,1) 100%);
    background-size: cover;
    background-position: 50% 50%;
}
#particles-js .particles-js-canvas-el {
    height: 100vh;
    -ms-transform: scale(1);
    -webkit-transform: scale(1);
    transform: scale(1);
    opacity: 1;
    -webkit-animation: appear 1.4s 1;
    animation: appear 1.4s 1;
    -webkit-animation-fill-mode: forwards;
    animation-fill-mode: forwards;
  } 

.form-group {
    margin-bottom: 25px;
}
/* 
  ##Device = Tablets, Ipads (portrait)
  ##Screen = B/w 768px to 1024px
*/

@media (min-width: 768px) and (max-width: 1024px) {
  
  .reg_form_new .reg_form_input .hpanel .panel-body {
      min-height: 1050px;
  }
    
  #particles-js {
      height: calc(100vh + 200px);
  }

  .reg_form_new.reg_left {
      margin-left: 10vw;
      width: 75vw;
  }
    .logo-name {
      font-size: 18px;
  }
}

/* 
  ##Device = Tablets, Ipads (landscape)
  ##Screen = B/w 768px to 1024px
*/

@media (min-width: 768px) and (max-width: 1024px) and (orientation: landscape) {
    #particles-js {
      height: calc(100vh + 500px);
  }


.reg_form_new.reg_left {
    background-size: 400px;
    background-position: 1% 55%;
}

}





/* 
  ##Device = Low Resolution Tablets, Mobiles (Landscape)
  ##Screen = B/w 481px to 767px
*/

@media (min-width: 481px) and (max-width: 767px) {
  
.reg_form_new {
    background: #fff !important;
}
.reg_form_new .hpanel .panel-body {
    padding: 20px 30px;
}

#particles-js {
      height: calc(100vh + 400px);
}   
}

/* 
  ##Device = Most of the Smartphones Mobiles (Portrait)
  ##Screen = B/w 320px to 479px
*/

@media (min-width: 320px) and (max-width: 480px) {
  


  .reg_form_new {
    background: #fff !important;
}
.reg_form_new .hpanel .panel-body {
    padding: 20px 30px;
}
 
  
}


@media (max-width: 700px){

}

</style>
            <div id="particles-js"></div>
            <div class="clearfix"></div>

<section id="components" style="padding-top: 10vh;">
<div class="container">
<div class="col-md-10 col-sm-offset-1 reg_form_new reg_left p-none">
        <div class="col-md-5 reg_form_intro hidden-xs hidden-sm">
                   <div class="row text-center inf0">
                <div class="col-lg-10 col-md-offset-1">
                    <h2 class="logo-name">Continous Professional Development Program</h2>
                    <h4>Welcome You To International Loveworld Staff Week 2019 </h4>
                </div>
            </div>
        </div>

        <div class="col-md-7 p-none reg_form__staffweek_input lg">

               <div class="row">
                <div class="col-md-12 no-p">

                     <div class="hpanel">
                        <div class="panel-body">
                             <form action="#" class="reg__form__staffweek">
                                <output id="form_message" class="form"></output>


                     <div class="row text-center">
                        <div class="col-lg-12">
                           <h2 class="logo-name">Staff Week 2019 </h2>
                        </div>
                    </div>
                    <hr>
                    <br>

                      <div class="row">

 
                       <div class="col-lg-12">
                       <div class="row">                        
                          <div class="form-group col-lg-6">
                                <label>Title</label>
                                    <select class="form-control m-b" name="title" required>
                                         <option value="brother" selected> Brother</option>                        
                                         <option value="sister"> Sister</option>                        
                                         <option value="pastor"> Pastor</option>                        
                                    </select> 
                                <span class="help-block text-danger"></span>
                            </div>
                          <div class="form-group col-lg-6">
                                <label>Gender</label>
                                  <div class="col-md-12">
                                      <label class="radio-inline">
                                        <input type="radio" name="gender" value="male" checked> Male
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="gender" value="female"> Female
                                      </label>
                                    </div>
                            </div>                            
                          </div>
                      </div>   
  
                       <div class="col-lg-12">
                       <div class="row">                        
                          <div class="form-group col-lg-6">
                                <label>First name</label>
                                <input type="text" placeholder="Your Name" class="form-control" name="fname" required>
                                <span class="help-block text-danger"></span>
                            </div>
                           <div class="form-group col-lg-6">
                                <label>Last name</label>
                                <input type="text" placeholder="Your Surname" class="form-control" name="lname" required>
                                <span class="help-block text-danger"></span>
                            </div>
                          </div>
                      </div>                        

   
                       <div class="col-lg-12">
                       <div class="row">  
                             <div class="form-group col-lg-6">
                                <label>Job Family <small>where you'll like to get trained</small></label>
                                <select class="form-control m-b" name="jobfamily" required>
                                         <option value="Church Ministry">Church Ministry</option>                  
                                         <option value="Ministry Services">Ministry Services</option>                  
                                         <option value="Ministry offices">Ministry offices</option>                  
                                         <option value="LoveWorld Media">LoveWorld Media</option>                  
                                         <option value="Innercity Missions">Innercity Missions</option>                  
                                         <option value="Healing school/ISM&Affiliates">Healing school/ISM&Affiliates</option>                  
                                         <option value="Rhapsody &LoveWorld Publishing ">Rhapsody &LoveWorld Publishing </option>                  
                                         <option value="LW Campus Ministry ">LW Campus Ministry </option>                  
                                         <option value="LMAM">LMAM</option>                  
                                         <option value="Broadcasting ">Broadcasting </option>                  
                                  </select>
                                <span class="help-block text-danger"></span>
                            </div>
                         <div class="form-group col-lg-6">
                                <label>Your zone</label>
                                  <select class="form-control m-b" name="zone" required>
                                         <?php // echo getDepts();?>    
                                         <option value="hq">LW Headquaters</option>                  
                                         <option value="zone1">Zone 1 </option>                  
                                         <option value="zone2">Zone 2 </option>                  
                                         <option value="zone3">Zone 3 </option>                  
                                         <option value="zone4">Zone 4 </option>                  
                                         <option value="zone5">Zone 5 </option>                  
                                         <option value="uk">Uk</option>                  
                                         <option value="ghana">Ghana</option>                  
                                         <option value="canada">Canada</option>                  
                                         <option value="others">Others</option>                                  
                                    </select> 
                                 <span class="help-block text-danger"></span>
                            </div>
                            
                          </div>
                      </div> 
                       <div class="col-lg-12">
                       <div class="row">  
                          <div class="form-group col-lg-6">
                                <label>Date of last professional training</label>
                                  <input type="text" placeholder="When Last Did You Receive One?" class="form-control" name="date_training" required>
                                 <span class="help-block text-danger"></span>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label>Your professional level</label>
                                <select class="form-control m-b" name="prof_level" required>
                                         <option value="beginner">Beginner</option>                  
                                         <option value="intermediary">Intermediary</option>                  
                                         <option value="advanced">Advanced</option>                  
                                  </select>
                                <span class="help-block text-danger"></span>
                            </div>
                          </div>
                      </div>                         
                       <div class="col-lg-12">
                       <div class="row">  
                          <div class="form-group col-lg-6">
                                <label>Willing to undertake online courses </label>
                                <div class="col-md-12 p-none">
                                      <label class="radio-inline">
                                        <input type="radio" name="take_course" value="yes" checked> Yes
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="take_course" value="no"> No
                                      </label>
                                    </div>
                                 <span class="help-block text-danger"></span>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label>Preffered time</label>
                                <div class="col-md-12 p-none">
                                      <label class="radio-inline">
                                        <input type="radio" name="preffered_time" value="morning" checked>Morning
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="preffered_time" value="afternoon">Afternoon
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="preffered_time" value="night">Night 
                                      </label>
                                    </div>
                                <span class="help-block text-danger"></span>
                            </div>
                          </div>
                      </div>                         
                            <br>


                            </div>
                                                <hr>

                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-lg ladda-button pull-right" data-style="expand-right"> <i class="fa fa-check"></i> Submit</button>
                            </div>
                        </form>
                </div>
            </div>


    </div>
    </div>
    <div class="clearfix"></div>
</div>
</div>
</section>


  
        
        <!-- /page content -->
<?php //include"footer.php";?>

<!-- Vendor scripts -->
<script src="vendor/jquery/dist/jquery.min.js"></script>
<script src="vendor/jquery-ui/jquery-ui.min.js"></script>
<script src="vendor/slimScroll/jquery.slimscroll.min.js"></script>
<script src="vendor/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="vendor/metisMenu/dist/metisMenu.min.js"></script>
<script src="vendor/sweetalert/lib/sweet-alert.min.js"></script>
<script src="vendor/ladda/dist/spin.min.js"></script>
<script src="vendor/ladda/dist/ladda.min.js"></script>
<script src="vendor/ladda/dist/ladda.jquery.min.js"></script>
<script src="scripts/particles.min.js"></script>
<!-- App scripts -->
<script src="scripts/js.js"></script>
<script src="scripts/staffweek.js"></script>

<!-- Local script for menu handle -->
<!-- It can be also directive -->
<script>
   $(document).ready(function () {

/*
   if($(window).width() < 500 ){
    
 alert($(document).height());
    $("#particles-js").css({ 'height': $(document).height() + "px" });

   }


 var c = $("#particles-js"), 
        ctx = c[0].getContext('2d');
         ctx.canvas.height = $(document).height();
*/

        $('body').scrollspy({
            target: '.navbar-fixed-top',
            offset: 80
        });

      particlesJS.load('particles-js', 'scripts/config.json', function() {
        console.log('particles.js loaded - callback');
      });

    });
</script>

</body>
</html>