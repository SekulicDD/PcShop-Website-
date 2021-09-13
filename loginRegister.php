
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
		<?php
			require_once "sideNav.php";
		?>
		</ul>

		<!-- SMISLI KASNIJE -->
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
    <ul class="breadcrumb">
		<li><a href="index.html">Home</a> <span class="divider">/</span></li>
		<li class="active">Registration</li>
    </ul>

	<?php if(!isset($_SESSION["user"])):?>
    <h3>Login</h3>	
	<div class="well">
        <form class="form-horizontal" action="manage/login.php" method="POST">
            <div class="control-group">
                <label class="control-label" for="input_email0">Email <sup>*</sup></label>
                <div class="controls">
                    <input type="text" name="input_email0" id="input_email0" placeholder="Email">
                </div>
            </div>
            <div class="control-group">
                <label class="control-label" for="inputPassword0">Password <sup>*</sup></label>
                <div class="controls">
                    <input type="password" name="inputPassword0" id="inputPassword0" placeholder="Password">
                </div>
	        </div>	
            <div class="control-group">                  
                <input  class="btn" name="login" type="submit" id="login" value="Log in">                                    
	        </div>	
      </form>	
    </div>
	<?php endif;?>
<?php 
	$html="";
	if(isset($_SESSION["errorLogin"]))
	{
		if(count($_SESSION["errorLogin"])>0){
			for ($i=0; $i <count($_SESSION["errorLogin"]); $i++) { 
				$html.="<p>".$_SESSION["errorLogin"][$i]."</p>";
			}
			
		}	
		echo "<div class='well' id='msg'>".$html."</div>";
	}
	
?>


	<h3> Register</h3>	
	<div class="well">


	<form class="form-horizontal" action="manage/register.php" method="POST" onSubmit="return check();" >
		<h4>Your personal information</h4>
		<div class="control-group">
		
		</div>
		
		<div class="control-group">
			<label class="control-label" for="inputFname1">First name <sup>*</sup></label>
			<div class="controls">
			  <input type="text" name="inputFname1" id="inputFname1" placeholder="First Name"> <span class="error" id="errorFname"></span>
			</div>
		 </div>
		 <div class="control-group">
			<label class="control-label" for="inputLnam">Last name <sup>*</sup></label>
			<div class="controls">
			  <input type="text" name="inputLnam" id="inputLnam" placeholder="Last Name"> <span class="error" id="errorLname"></span>
			</div>
		 </div>
		<div class="control-group">
		<label class="control-label" for="input_email">Email <sup>*</sup></label>
		<div class="controls">
		  <input type="text" name="input_email" id="input_email" placeholder="Email"> <span class="error" id="errorEmail"></span>
		</div>
	  </div>	  
	<div class="control-group">
		<label class="control-label" for="inputPassword1">Password <sup>*</sup></label>
		<div class="controls">
		  <input type="password" name="inputPassword1" id="inputPassword1" placeholder="Password"><span class="error" id="errorPass"></span>
		</div>
	  </div>
      <div class="control-group">
		<label class="control-label" for="inputPassword2">Confrim password <sup>*</sup></label>
		<div class="controls">
		  <input type="password" name="inputPassword2" id="inputPassword2" placeholder="Password"><span class="error" id="errorCpass"></span>
		</div>
	  </div>	
        <div class="control-group">                  
            <input  class="btn" type="submit" name="registerBtn" id="registerBtn" value="Register">                                    
	    </div>	
	</form>
</div>

<?php 
	$html="";
	if(isset($_SESSION["success"])){
		$html=$_SESSION["success"];
		session_destroy();
		echo "<div class='well' id='msg'>".$html."</div>";
	}
	else if(isset($_SESSION["errors"]))
	{
		if(count($_SESSION["errors"])>1){
			$html="<h3>Please turn on the javascript</h3>";
			for ($i=0; $i <count($_SESSION["errors"]); $i++) { 
				$html.="<p>".$_SESSION["errors"][$i]."</p>";
			}
			
		}
		else{
			$html="<p>".$_SESSION["errors"][0]."</p>";
		}	
	echo "<div class='well' id='msg'>".$html."</div>";	
	}
	
?>


	
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