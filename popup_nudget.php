

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Popup nudget for the staff</title>
    <!-- Bootstrap CSS -->
    <link rel='stylesheet' href='https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.2/css/bootstrap.min.css'>
    <!-- Font Awesome CSS -->
    <link rel='stylesheet' href='https://use.fontawesome.com/releases/v5.3.1/css/all.css'>
    <!-- Style CSS -->
    <link rel="stylesheet" href="css/style.css">
    <!-- Demo CSS -->
    <link rel="stylesheet" href="css/demo.css">

</head>
<body>
<header class="intro">
    <!--<h1> Popup Nudget for the staff </h1>-->
   <!-- <p> popup nudget popup.</p> -->
    <!-- <div class="action">
     <a href="https://www.codehim.com/bootstrap/bootstrap-4-modal-popup-login-form/" title="Back to download and tutorial page" class="btn back">Back to Tutorial</a>
     </div>-->

</header>

<main>
    <article>
<?php
//include ("connect.php");
session_start();
//$_search_query = 0;
//$_search_query =$_SESSION['_q_user']['_jobfamily_id'];

$conn = new mysqli('localhost', 'root', '', 'cpdp');

  $result =mysqli_query($conn, "select * from training_lesson order by id  desc limit 1") or die (mysqli_error($conn));


  while($row = mysqli_fetch_array($result)){
   /*$title = $row['title'];
   $path  = $row['path'];*/


?>

        <!-- partial:index.partial.html -->
        <!--<div class="container">
            <button type="button" class="btn btn-info btn-round" data-toggle="modal" data-target="#loginModal">
                Enroll Now
            </button>
        </div>-->

        <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header border-bottom-0">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-title text-center">
                            <h4>Course for the week</h4>
                        </div>
                        <div class="d-flex flex-column text-center">
                            <strong><//?= $_SESSION['_q_user']['_jobfamilyname'];?></strong>
                            <p><?php echo $row['title']; ?></p>
                            <p><?php //echo $row['path']; ?></p>
                            <button type="button" class="btn btn-info btn-block btn-round">Enroll Now</button>

                            <?php } ?>



                </div>
            </div>
            <!-- partial -->


    </article>
</main>


<!-- jQuery -->
<script src='https://code.jquery.com/jquery-3.3.1.slim.min.js'></script>
<!-- Popper JS -->
<script src='https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js'></script>
<!-- Bootstrap JS -->
<script src='https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js'></script>
<!-- Custom Script -->
<script  src="js/script.js"></script>

</body>
</html>
