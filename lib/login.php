<?php



include"nav-landing.php";

?>

    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Pacifico">



<style type="text/css">



.reg_form_new {

    -webkit-box-shadow: -4px 5px 16px 0px rgba(0,0,0,0.15);

    -moz-box-shadow: -4px 5px 16px 0px rgba(0,0,0,0.15);

    box-shadow: -4px 5px 16px 0px rgba(0,0,0,0.15);

}



.reg_form_new .reg_form_input{

    padding: 50px;

    background: #fff !important;

        border-top-left-radius: 10px;

    border-bottom-left-radius: 10px;

}

.reg_form_new.login-page .reg_form_input .hpanel .panel-body {

    border: none;

}

.form-group {

        padding-left: 0px;

    }

.form-control {

    height: 47px;

    }

button.ladda-button {

    padding: 14px 40px;

    letter-spacing: 2px;

    font-size: 16px;

}  

#components {

    position: absolute;

    top: 0px;

    width: 100%;

        height: 100%;
padding-top: 20vh;
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

  .logo-name {

    font-family: 'Pacifico',cursive;

    color: #7000fb;

    text-transform: lowercase;

    letter-spacing: 6px;

    font-size: 36px;

    font-weight: bold;

        margin-top: 0px;

    margin-bottom: 16px;

}

.reg_form_new.login-page .reg_form_intro{
margin-top: 10%;
}



@media (max-width: 700px){
#components {

padding-top: 17vh;
    }


.reg_form_new {

    background: #fff !important;

}
.reg_form_new .reg_form_input {
    padding: 10px;
    border-radius: 5px;
}


.reg_form_new .reg_form_input .m-t-xxl {
    margin-top: 30px;
}

.reg_form_new.login-page .reg_form_input .hpanel .panel-body {
    height: 300px;
}

.reg_form_new .reg_form_input .form-control {
    width: 100%;
}

  .logo-name {
margin-top: 14px !important;
}

}



</style>

            <div id="particles-js"></div>

            <div class="clearfix"></div>



<section id="components">

<div class="container">

<div class="col-md-10 col-sm-offset-1 reg_form_new login-page p-none">





        <div class="col-md-6 p-none reg_form_input">



                   <div class="row">

                    <div class="col-md-12 no-p">



                     <div class="hpanel">



                         <div class="row text-center">

                            <div class="col-lg-12">

                                <h2 class="logo-name">Login</h2>

                                <!-- <h4>Access BLW Continous Professional Development Program Using Your Staff Portal Login</h4> -->

                            </div>

                        </div>

                        <div class="panel-body">

                             <form action="#" class="log__form" autocomplete="off">

                                <output id="form_message" class="form"></output>



             <!--   -->    

                                  <div class="row">



                                      <div class="form-group col-lg-12">

                                            <input type="text" placeholder="Staff Portal ID " name="l_email" class="form-control" autocomplete="false" required>

                                            <span class="help-block text-danger"></span>

                                        </div>

                                       <div class="form-group col-lg-12">

                                            <input type="password" placeholder="Your Password" name="l_password" class="form-control" autocomplete="false" required>

                                            <span class="help-block text-danger"></span>

                                        </div>

                                   

                                   </div>



                                  <div class="row">

                                        <div class="text-center">

                                             <button type="submit" name="submit" class="btn btn-lg btn-info pull-left ladda-button" data-style="expand-right"> <i class="pe pe-7s-unlock"></i> SIGN IN</button>

                                        </div>

                                     </div>



                                    <hr>


                                  <div class="clearfix"></div>
                                    <div class="row m-t-xxl">

                                          <!-- <a href="no-login.php" class="text-danger m-t-lg"> Click here if you don't have a portal id to login to CPDP</a> -->
                                          <!-- &amp;amp;lt;span style=&quot;font-weight: bold;&quot;&amp;amp;gt;Enroll to watch&amp;amp;lt;/span&amp;amp;gt; -->

                                        <div class="subheader">
                                            <div class="row">
                                                <div class="col-md-12">
                                                  <marquee behavior="scroll" onmouseover="this.stop();" onmouseout="this.start();" direction="left" style="color: #e74c3c; font-weight: 600;">
                                                      <?php 
                                                      $query = query("SELECT * FROM training_news");
                                                      $ticker= '';
                                                      while($rows=mysqli_fetch_array($query)){
                                                              $ticker = $rows['content']; 
                                                           ?>
                                                                  <?=html_entity_decode($ticker)?> <span class="spacer"></span>

                                                      <?php }/* */?>

                                                  </marquee>
                                                </div>
                                            </div>
                                        </div>
                                     </div>



                           </form>

                        </div>

                    </div>





            </div>

            </div>

            <div class="clearfix"></div>

        </div>







    <div class="col-md-6 reg_form_intro hidden-xs hidden-sm">

               <div class="row text-center inf0">

            <div class="col-lg-12" style="position: absolute; bottom: 0px;">
             
             <h2 class="logo-name footer-info">Continuous Professional Development Program</h2>


            <!--

                <h2>Login</h2>

                <h4>Access BLW Continous Professional Development Program Using Your Staff Portal Login</h4>

                -->

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

<script src="scripts/js.js?2908"></script>

<script src="scripts/log.js?2908"></script>



<!-- Local script for menu handle -->

<!-- It can be also directive -->

<script>

    $(document).ready(function () {



      particlesJS.load('particles-js', 'scripts/config.json', function() {

        console.log('particles.js loaded - callback');

      });



    });

</script>



</body>

</html>