<?php header('Location:login.php');
include"nav-landing.php";
?>

<section id="components" class="bg-light" style="padding-top: 100px;">
<div class="container">
<div class="col-md-10 col-sm-offset-1 reg_form_new p-none">
    <div class="col-md-6 reg_form_intro">
               <div class="row text-center inf0">
            <div class="col-lg-10 col-md-offset-1">
                <h2>Register Now</h2>
                <h4>Register For BLW Continous Professional Development Program </h4>
            </div>
        </div>
    </div>

        <div class="col-md-6 p-none reg_form_input">

   <div class="row">
    <div class="col-md-12 no-p">

         <div class="hpanel">
            <div class="panel-body">
                 <form action="#" class="reg__form">
                    <output id="form_message" class="form"></output>


         <div class="row text-center hidden visible-xs">
            <div class="col-lg-12">
                <h3>Register</h3>
                <p>Register For BLW Continous Professional Development Program </p>
            </div>
        </div>
        <hr>
 <!--   -->    
                      <div class="row">

 
                       <div class="col-lg-12">
                       <div class="row">                        
                          <div class="form-group col-lg-6">
                                <label>First Name</label>
                                <input type="text" value="" placeholder="Your Name" class="form-control" name="r_fname" required>
                                <span class="help-block text-danger"></span>
                            </div>
                           <div class="form-group col-lg-6">
                                <label>Last Name</label>
                                <input type="text" value="" placeholder="Your Surname" class="form-control" name="r_lname" required>
                                <span class="help-block text-danger"></span>
                            </div>
                          </div>
                      </div>   
                       <div class="col-lg-12">
                       <div class="row">                              
                           <div class="form-group col-lg-6">
                                <label>Password</label>
                                <input type="password" value="" placeholder="Password" class="form-control" name="r_pasword" required>
                                <span class="help-block text-danger"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Repeat Password</label>
                                <input type="password" value="" placeholder="Confirm Password" class="form-control" name="r_password" required>
                                <span class="help-block text-danger"></span>
                            </div>
                           </div>
                      </div>   
                       <div class="col-lg-12">
                       <div class="row">                              
                            <div class="form-group col-lg-6">
                                <label>Email Address</label>
                                <input type="text" value="" placeholder="Email Address" class="form-control" name="r_email" required>
                                <span class="help-block text-danger"></span>
                            </div>
                            <div class="form-group col-lg-6">
                                <label>Phone Number</label>
                                <input type="text" value="" placeholder="Phone Number" class="form-control" name="r_phone" required>
                                <span class="help-block text-danger"></span>
                            </div>
                           </div>
                      </div>    
                       <div class="col-lg-12">
                       <div class="row">  
                          <div class="form-group col-lg-6">
                                <label>Department </label>
                                <select class="form-control m-b" name="account" required>
                                      <option>LWPLUS</option>
                                      <option>LMO</option>
                                      <option>LMMP</option>
                                      <option>CMO LAGOS</option>
                                      <option>OCOS</option>
                                      <option>ZONE 1</option>
                                      <option>ZONE 2</option>
                                      <option>ZONE 3</option>
                                      <option>ZONE 4</option>
                                      <option>ZONE 5</option>
                                      <option>ROR</option>
                                      <option>LWPM</option>
                                      <option>HEALING SCHOOL</option>
                                      <option>ISM</option>
                                      <option>OFTP</option>
                                      <option>OCEO</option>
                                      <option>OHOA</option>
                                      <option>ADF</option>
                                      <option>ICM4C</option>
                                      <option>LMAM</option>
                                      <option>LWNM</option>
                                      <option>LMP</option>
                                      <option>LMPT</option>
                                      <option>IMM</option>
                                      <option>CHILDREN MINISTRY</option>
                                      <option>AUDIO VISUAL</option>
                                  </select>                               
                                 <span class="help-block text-danger"></span>
                            </div>
                            
                            <div class="form-group col-lg-6">
                                <label>Job Family</label>
                                <select class="form-control m-b" name="account" required>
                                      <option>Administration</option>
                                      <option>IT</option>
                                      <option>Media </option>
                                      <option>Healing Specialist</option>
                                      <option>Publishing</option>
                                      <option>Partnership/Marketing & Sales</option>
                                      <option>Social works</option>
                                      <option>Finance</option>
                                      <option>Security</option>
                                      <option>Entertainment</option>
                                      <option>Church ministry</option>
                                  </select>
                                <span class="help-block text-danger"></span>
                            </div>
                          </div>
                      </div>   
                            <br>


                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-info btn-lg ladda-button" data-style="expand-right"> <i class="fa fa-check"></i> Register</button>
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
<!-- App scripts -->
<script src="scripts/homer.js"></script>
<script src="scripts/reg.js"></script>

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