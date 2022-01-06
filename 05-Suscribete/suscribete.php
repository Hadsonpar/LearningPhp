<!DOCTYPE html>
<html lang="en">

    <head>
      <meta charset="utf-8">
      <meta content="width=device-width, initial-scale=1.0" name="viewport">

      <title>Suscríbite | New Talents</title>
      <meta content="" name="description">
      <meta content="" name="keywords">

      <!-- Favicons -->
      <link href="assets/img/favicon.png" rel="icon">
      <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

      <!-- Google Fonts -->
      <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,
                  700,700i|Raleway:300,300i,400,400i,500,500i,600,600i,700,700i|Poppins:300,300i,400,
                  400i,500,500i,600,600i,700,700i" rel="stylesheet">

      <!-- Vendor CSS Files -->
      <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
      <link href="assets/vendor/icofont/icofont.min.css" rel="stylesheet">
      <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
      <link href="assets/vendor/owl.carousel/assets/owl.carousel.min.css" rel="stylesheet">
      <link href="assets/vendor/venobox/venobox.css" rel="stylesheet">
      <link href="assets/vendor/aos/aos.css" rel="stylesheet">

      <!-- Template Main CSS File -->
      <link href="assets/css/style.css" rel="stylesheet">

      <!-- =======================================================   
      * Template Name: nTalents - v1.0.0
      * Template URL: https://hadsonpar.com/template/bootstrap-web-new-talents/
      * Author: hadsonpar.com
      * License: https://hadsonpar.com/license/
      ======================================================== -->
    </head>

    <body>

    <section id="newsletter" class="d-flex align-items-center">
	    <!-- container -->
    	<div class="container">
    		<!-- row -->
    		<div class="row">
    			<div class="col-lg-12">
    
    				<div class="newsletter">
    					<p>Suscribete para los próximos <strong>eventos</strong></p>
    					<form id="offer_form" onsubmit="return false">
    						<input class="input" type="email" id="email" name="email" placeholder="Enter Your Email">
    						<button class="newsletter-btn" value="Sign Up" name="signup_button" type="submit"><i class="bx bxl-facebook"></i> Suscribete</button>
    					</form>
    					<div class="" id="offer_msg">
                            <!--Alert para el registro-->
                        </div>
    					<ul class="newsletter-follow">
    						<li>
    							<a href="#"><i class="bx bxl-facebook"></i></a>
    						</li>
    						<li>
    							<a href="#"><i class="bx bxl-twitter"></i></a>
    						</li>
    						<li>
    							<a href="#"><i class="bx bxl-linkedin"></i></a>
    						</li>
    
    					</ul>
    				</div>
    			</div>
    		</div>
    		<!-- /row -->
    	</div>
    	<!-- /container -->
    </section>

    <!-- Vendor JS Files -->
    <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="assets/vendor/jquery.easing/jquery.easing.min.js"></script>  
    <script src="assets/vendor/owl.carousel/owl.carousel.min.js"></script>
    <script src="assets/vendor/venobox/venobox.min.js"></script>
    <script src="assets/vendor/aos/aos.js"></script>

    <!-- Template Main JS File -->
    <script src="assets/js/main.js"></script>

    <script>
        /*$(document).ready(function(){*/            
        $("#offer_form").on("submit",function(event){
        	event.preventDefault();
        	$(".overlay").show();
        	$.ajax({
        		url : "registremail.php",
        		method : "POST",
        		data : $("#offer_form").serialize(),
        		success : function(data){
        			$(".overlay").hide();
        			$("#offer_msg").html(data);
                
        		}
        	})
        })
        /*})*/
    </script>

    </body>
</html>