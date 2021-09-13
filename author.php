
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
<div class="container" id="mainBodyA">
	<hr class="soften">
	<h1>About author</h1>
	<h4>This website was created by David Sekulić.</h4>
	<hr class="soften"/>	
	<div class="row">
		<div id="aLeft" class="span8">	
			<a href="http://davidskola.dx.am"><img src="assets/img/porto.jpg" alt="protofollio"></a>
		</div>
		<div class="span4">	
			<p>If you want to find out more about me be sure to check out my portofollio.</p>
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