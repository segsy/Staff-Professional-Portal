<?php 
include"nav-landing.php";
?>
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Pacifico">
<style type="text/css">
 body {
    background-color: #016997;
    }
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

<section id="components" style="padding-top: 3vh;">
<div class="container">
<div class="col-md-12 reg_form_new reg_left p-none">
        <div class="col-md-5 reg_form_intro hidden-xs hidden-sm">
                   <div class="row text-center inf0">
                <div class="col-lg-10 col-md-offset-1">
                    <h2 class="logo-name">Continous Professional Development Program</h2>
                    <h4>LoveWorld Staff Gap analyst assessment form </h4>
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
                           <h2 class="logo-name">LoveWorld Staff</h2>
                           <h4 style="font-size: 18px;color: #076ef1;line-height: 0.6;">Gap analyst assessment form</h2>
                        </div>
                    </div>
                    <hr>
                    <br>

                      <div class="row">

                       <div class="col-lg-12">
                        <div class="row">  
                         <div class="form-group">
                                <label class="h4 text-info">Personal Data</label>
                                <span class="help-block text-infso"></span>
                          </div>
                        </div>
                        </div>

                       <div class="col-lg-12">
                       <div class="row">                        
                          <div class="form-group col-lg-6">
                                <label>Title</label>
                                    <select class="form-control m-b" name="title" required>
                                         <option value="pastor"> Pastor</option>                        
                                         <option value="deacon"> Deacon</option>                        
                                         <option value="deaconess"> Deaconess</option>                        
                                         <option value="brother" selected> Brother</option>                        
                                         <option value="sister"> Sister</option>                        
                                    </select> 
                                <span class="help-block text-danger"></span>
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
                                <label>Kingschat Mobile Number</label>
                                  <input type="numeric" class="form-control" name="phoneNumber" placeholder="Your Phone Number" required="">                                
                                  <span class="help-block text-danger"></span>
                            </div>
                           <div class="form-group col-lg-6">
                                <label>Email Address</label>
                                  <input type="email" class="form-control" name="email" placeholder="Your Email Address" required="">                                
                                  <span class="help-block text-danger"></span>
                            </div>
                          </div>
                      </div>  

   
                       <div class="col-lg-12">
                       <div class="row">  
                             <div class="form-group col-lg-6">
                                <label>Your Job Function</label>
                                <div class="col-md-12 p-none">
                                    <input type="text" class="form-control" id="jobfunction" name="jobfunction" placeholder="Video editor, Admin Officer, Broadcaster, Programmer, Script writer, Programs monitor ,Protocol Officer, Graphics designer" required="">
                                      <span class="help-block text-danger"></span>
                                 </div>
                            </div>
<!--                              <div class="form-group col-lg-6">
                                <label>Your Job Family</label>
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
 -->
                          <div class="form-group col-lg-6">
                              <label>Your Department</label>
                                <div class="col-md-12 p-none">
                                <input type="text" class="form-control" id="department" name="department" placeholder="Your Department" required="">
                                  <span class="help-block text-danger"></span>
                             </div>
                          </div>
                            
                          </div>
                      </div> 
                      <div class="col-lg-12">
                        <div class="row">  
                         <div class="form-group">
                                <label class="control-label h4 text-info">2019 CPDP Training</label>
                                <span class="help-block text-infso"></span>
                          </div>
                        </div>
                        </div>

                       <div class="col-lg-12">
                        <div class="row">                          
                          <div class="form-group col-lg-6"> 
                                <label>(a). Have you enrolled and taken any of our CPDP course(s)online before?</label>
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
                                <label>If Yes, How would you rate your learning experience?</label>
                                <div class="col-md-12 p-none">
                                      <label class="radio-inline">
                                        <input type="radio" name="take_course_review_yes" value="educative"> Very Educative
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="take_course_review_yes" value="excellent"> Excellent
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="take_course_review_yes" value="okay" checked> Just okay 
                                      </label>
                                    </div>
                                 <span class="help-block text-danger"></span>
                            </div>

                          </div>
                      </div> 
                      <div class="clearfix"></div> 
                      <br>

                       <div class="col-lg-12">
                       <div class="row">  
                            <div class="form-group">
                                <label>(b). If Not, Why?</label>
                                <select class="form-control m-b" name="take_course_review_no" required>
                                         <option value="not-aware">I’m not aware of the CPDP portal</option>                  
                                         <option value="log-in">Had issues login in</option>                  
                                         <option value="other-reason">Other reason (Please Type below)</option>                  
                                  </select>
                                <span class="help-block text-danger"></span>
                            </div>  
                          </div>
                      </div> 
                       <div class="clearfix"></div> 
                      <br>
                                                 
                       <div class="col-lg-12">
                        <div class="row">  
                         <div class="form-group">
                                <label>Other reason(s) - Please Type here </label>
                                  <textarea class="form-control" rows="5" name="take_course_review_other_reason" placeholder="Other reason(s) why you haven't enrolled and taken any of our CPDP courses online?"></textarea>
                                 <span class="help-block text-danger"></span>
                            </div>

                          </div>
                        </div>
                      
                       <div class="clearfix"></div> 
                      <br>

                       <div class="col-lg-12">
                        <div class="row">                          
                          <div class="form-group col-lg-6">                                     
                                <label>(c). Did you attend any of our Onsite CPDP Training in 2019?</label>
                                <div class="col-md-12 p-none">
                                      <label class="radio-inline">
                                        <input type="radio" name="onsite_training" value="yes" checked> Yes
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="onsite_training" value="no"> No
                                      </label>
                                    </div>
                                 <span class="help-block text-danger"></span>
                            </div>
                           
                          <div class="form-group col-lg-6">                                                                          
                                <label>If yes .How would you rate your learning experience?</label>
                                <div class="col-md-12 p-none">
                                      <label class="radio-inline">
                                        <input type="radio" name="onsite_training_review_yes" value="educative"> Very Educative
                                      </label>
                                      <label class="radio-inline">
                                        <input type="radio" name="onsite_training_review_yes" value="excellent"> Excellent
                                      </label>
                                       <label class="radio-inline">
                                        <input type="radio" name="onsite_training_review_yes" value="okay" checked> Just Okay
                                      </label>
                                    </div>
                                <span class="help-block text-danger"></span>
                            </div>

                          </div>
                      </div>
                      <div class="clearfix"></div> 
                      <br>
                      <hr>

                      <div class="col-lg-12">
                        <div class="row">  
                         <div class="form-group">
                          <label class="h4 text-info">Performance Management</label>
                          </div>
                        </div>
                        </div>

                       <div class="col-lg-12">
                        <div class="row">                          
                          <div class="form-group col-lg-6">
                          <label>(a). How would you rate your Performance on the Job in 2019. (Pls select from 1-10,1 being the lowest and 10 being the highest)</label>
                          <div class="col-md-12 p-none">
                            <select name="jobPerf" id="jobPerf" class="form-control" required="">
                              <option value="1">1</option>
                              <option value="2">2</option>
                              <option value="3">3</option>
                              <option value="4">4</option>
                              <option value="5">5</option>
                              <option value="6">6</option>
                              <option value="7">7</option>
                              <option value="8">8</option>
                              <option value="9">9</option>
                              <option value="10" selected>10</option>
                            </select>
                            <span class="help-block text-danger"></span>
                          </div>
                        </div>
                          <div class="form-group col-lg-6">
                          <label>(b). Do you think Training will help improve your Performance?</label>
                          <div class="col-md-12 p-none">
                          <div class="col-sm-12 p-none radio-layout">
                          <label class="radio-inline pull-left">
                            <input type="radio" name="trainPerf" id="trainPerf" value="Yes"> Yes
                          </label>
                          <label class="radio-inline pull-left">
                            <input type="radio" name="trainPerf" id="trainPerf" value="Maybe"> Maybe
                          </label>
                          <label class="radio-inline pull-left">
                            <input type="radio" name="trainPerf" id="trainPerf" value="No"> No
                          </label>
                          </div>
                          <div class="clearfix"></div>
                          </div>
                        </div>
                          </div>
                        </div>

                      <div class="clearfix"></div> 
                      <br>
                      <hr>

                      <div class="col-lg-12">
                        <div class="row">  
                         <div class="form-group">
                          <label class="h4 text-info">2020 Personal Training Needs</label>
                          </div>
                        </div>
                        </div>

                      <div class="col-lg-12">
                        <div class="row">  
                         <div class="form-group">
                                <label class="control-label">(a). What are your 5 Top Professional Training needs in 2020?
(The most Important should be the top on the list )</label>
<!--                                 <span class="help-block text-infso">Time management, people management, competency training...please state clearly in what area these trainings are needed. The most important should be first on the list </span>
 -->                          </div>
                        </div>
                        </div>

                       <div class="col-lg-12">
                        <div class="row">  
                          <div class="form-group col-lg-6">
                              <label>Training Needs 1</label>
                              <div class="col-md-12 p-none">
                                <input type="text" class="form-control" name="persTrainNeeds1" id="persTrainNeeds1" placeholder=" Training needs 1">
                              </div>
                            </div>        
                          <div class="form-group col-lg-6">
                              <label>Training Needs 2</label>
                              <div class="col-md-12 p-none">
                                <input type="text" class="form-control" name="persTrainNeeds2" id="persTrainNeeds2" placeholder=" Training needs 2">
                              </div>
                            </div>

                          </div>
                        </div>

                       <div class="col-lg-12">
                        <div class="row">        
                          <div class="form-group col-lg-6">
                              <label>Training Needs 3</label>
                              <div class="col-md-12 p-none">
                                <input type="text" class="form-control" name="persTrainNeeds3" id="persTrainNeeds3" placeholder=" Training needs 3">
                              </div>
                            </div>                               
                          <div class="form-group col-lg-6">
                              <label>Training Needs 4</label>
                              <div class="col-md-12 p-none">
                                <input type="text" class="form-control" name="persTrainNeeds4" id="persTrainNeeds4" placeholder=" Training needs 4">
                              </div>
                            </div>

                          </div>
                        </div>

                          

                       <div class="col-lg-12">
                        <div class="row">                                 
                          <div class="form-group">
                              <label>Training Needs 5</label>
                              <div class="col-md-12 p-none">
                                <input type="text" class="form-control" name="persTrainNeeds5" id="persTrainNeeds5" placeholder=" Training needs 5">
                              </div>
                            </div>

                          </div>
                        </div>

                      <div class="clearfix"></div> 
                      <br>
                      <hr>



                            <div class="form-group">
                              <label class="control-label">Other comments/Suggestion(s)</label>
                              <div class="col-md-12 p-none">
                                <textarea class="form-control" rows="5" name="addComments" id="addComments" placeholder="Do you have any additional comments or Suggestion(s)?"></textarea>
                                <span id="helpBlock" class="help-block">Do you have any additional comment?</span>
                             </div>
                            </div>


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
<script src="scripts/gap.js"></script>

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