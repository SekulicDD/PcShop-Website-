
<?php	
    require_once "konekcija.php";
?>


<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Computer Shop - Home</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Everything you ever wanted form a PC store" />
    <meta name="keywords" content="gaming, desktop, products, laptop, computer, CPU, GPU"/>
    <meta name="author" content="David Sekulić"/>

<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">

    <link rel="shortcut icon" href="asssets/img/favicon.ico" type="image/x-icon"/>
	<link href="assets/css/style-min.css" rel="stylesheet" type="text/css">
	
  </head>
<body>

<?php
  require_once "header.php";
?>

<div id="mainBody">
		<div class="container">
		<div class="row">
	<!-- Sidebar ================================================== -->
	<div id="sidebar" class="span3">
	
		<!-- side menu -->
		<ul id="sideMenu" class="nav nav-tabs nav-stacked">	
		</ul>
	
		<!-- payments -->
		<br/>
		<div class="thumbnail">
		<img src="themes/images/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
		<div class="caption">
			<h5>Payment Methods</h5>
		</div>
		</div>
	</div>
<!-- Sidebar end=============================================== -->
	<div class="span9">
   
	<div class="row" id="detailsDiv">	  
		
          
	</div>
</div>
</div> 
</div>
</div>





<!-- Footer ================================================================== -->
<?php
	require_once "footer.php";
?>

	<script src="assets/js/main2.js"></script>
	<script src="assets/js/jquery-3.4.1.min.js"></script>

</body>
</html>