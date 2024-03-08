<?php 
include"nav-landing.php";

?>

<style type="text/css">

@media (max-width: 700px){

.reg_form_new {

    background: #fff !important;

}

}

</style>

<section id="components" class="bg-light" style="padding-top: 100px;">

<div class="container">

<div class="col-md-8 col-sm-offset-2 reg_form_new login-page p-none">

    <div class="col-md-6 reg_form_intro hidden-xs hidden-sm">

               <div class="row text-center inf0">

            <div class="col-lg-10 col-md-offset-1"><!--

                <h2>Login</h2>

                <h4>Access BLW Continous Professional Development Program Using Your Staff Portal Login</h4>

                -->

            </div>

        </div>

    </div>



        <div class="col-md-6 p-none reg_form_input">



   <div class="row">

    <div class="col-md-12 no-p">



         <div class="hpanel">

            <div class="panel-body">

                 <form action="#" class="log__form">

                    <output id="form_message" class="form"></output>





         <div class="row text-center hidden visible-xs">

            <div class="col-lg-12">

                <h2>Login</h2>

                <!-- <h4>Access BLW Continous Professional Development Program Using Your Staff Portal Login</h4> -->

              

            </div>

        </div>

        <hr>

 <!--   -->    

                      <div class="row">



 

                          <div class="form-group col-lg-12">

                                <label class="control-label" for="l_email">Portal ID</label>

                                <input type="text" placeholder=" 123456 " name="l_email" class="form-control" required>

                                <span class="help-block text-danger"></span>

                            </div>

                           <div class="form-group col-lg-12">

                                <label class="control-label" for="l_password">Portal Password</label>

                                <input type="password" placeholder="******" name="l_password" class="form-control" required>

                                <span class="help-block text-danger"></span>

                            </div>

                       

                            </div>

                            <div class="text-center">

                                 <button type="submit" name="submit" class="btn btn-info pull-left ladda-button" data-style="expand-right"> <i class="pe pe-7s-unlock"></i> Login</button>

                            </div>

                                 <a href="no-login.php" class="text-danger pull-right m-t-sm"> <i class="pe pe-7s-help1 fa-lg"></i> Don't Have Portal Login</a>

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

<!-- App scripts -->

<script src="scripts/js.js"></script>

<script src="scripts/log.js"></script>



<!-- Local script for menu handle -->

<!-- It can be also directive -->

<script>

    $(document).ready(function () {





        $('body').scrollspy({

            target: '.navbar-fixed-top',

            offset: 80

        });



    });

</script>



</body>

</html>