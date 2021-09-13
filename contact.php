
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
	<hr class="soften">
	<h1>Visit us</h1>
	<hr class="soften"/>	
	<div class="row">
		<div class="span3">
		<h4>Contact Details</h4>
		<p>	18 Fresno,<br/> CA 93727, USA
			<br/><br/>
			info@pcshop.com<br/>
			﻿Tel 123-456-6780<br/>
			Fax 123-456-5679<br/>
			web:pcshop.com
		</p>		
		</div>
			
		<div class="span3">
		<h4>Opening Hours</h4>
			<h5> Monday - Friday</h5>
			<p>09:00am - 09:00pm<br/><br/></p>
			<h5>Saturday</h5>
			<p>09:00am - 07:00pm<br/><br/></p>
			<h5>Sunday</h5>
			<p>12:30pm - 06:00pm<br/><br/></p>
		</div>

		<div class="span4">
		<h4>Email Us</h4>
		<form class="form-horizontal" method="POST" action="manage/contactSubmit.php" onSubmit="return regex()" >
        <fieldset>
          <div class="control-group">
           
              <input id="name" name="name" type="text" placeholder="name" class="input-xlarge"/>
           
          </div>
		   <div class="control-group">
           
              <input id="email" name="email"  type="text" placeholder="email" class="input-xlarge"/>
           
          </div>
		  
          <div class="control-group">
              <textarea id="mess" name="text" rows="3" id="textarea" class="input-xlarge"></textarea>
           
          </div>

            <button id="send" name="send" class="btn btn-large" type="submit">Send Messages</button>

        </fieldset>
      </form>
		</div>

		<div id="errors" class="span2">
			<h4>Message Format</h4>
			<p>Name format: John Smith</p>
			<p>Email format: john23@gmail.com</p>
			<p>Message between 16 and 160 characters</p>		
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