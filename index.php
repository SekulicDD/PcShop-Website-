
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

<!-- SLIDE SHOW -->
<div id="carouselBlk">
	<div id="myCarousel" class="carousel slide">
		<div class="carousel-inner">  		 
		   <div class="item active">
		   <div class="container">
				<img src="assets/img/b1.png" alt="special offers"/>	
		  </div>
		  </div>	    
		</div>
		<a id="leftSlide" class="left carousel-control" href="#myCarousel" >&lsaquo;</a>
		<a id="rightSlide" class="right carousel-control" href="#myCarousel" >&rsaquo;</a>		
	  </div> 	  
</div>


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
			<div class="well well-small">
			<h4>Featured Products <small class="pull-right"> best deals </small></h4>
			<div class="row-fluid">
				<div id="featured" class="carousel slide">
					<div class="carousel-inner">

					<div class="item active">
						<ul class="thumbnails" id="featuredShown">
						<?php 
							$data=$konekcija->query('select * from products where isFeatured=1');
							$rez=$data->fetchAll();
							shuffle($rez);
							$i=0;
							foreach($rez as $red):?>
								<?php $i++;
								if($i<5):?>
								<li class="span3">
								<div class="thumbnail">
								<i class="tag"></i>
									<a data-id="<?=$red->id?>" class="details" href="productDetails.html"><img src="assets/img/<?=$red->img?>.jpg" alt="<?=$red->id?>"></a>
									<div class="caption">
									<h4><a data-id="<?=$red->id?>" class="btn details" href="productDetails.html">VIEW</a> <span class="pull-right"><?=$red->price?>&euro;</span></h4>
									</div>
								</div>
								</li>
								<?php endif;?>    
							<?php endforeach;?>  
						</ul>
					</div> 

						<div class="item">
							<ul class="thumbnails">	</ul>
						</div>
					</div>
				
				</div>
			</div>
		</div>

		<h4>Latest Products </h4>
			<ul class="thumbnails" id="latestProducts">
				<?php
				$data=$konekcija->query('select * from products order by released DESC LIMIT 6');
				$rez=$data->fetchAll();
				foreach($rez as $red):?>
					<li class="span3">
					<div class="thumbnail">
					<a data-id="<?=$red->id?>" class="details" href="productDetails.html"><img src="assets/img/<?=$red->img?>.jpg" alt="<?=$red->img?>"/></a>
					<div class="caption">
						<h5><?=$red->name?></h5>
						<p> 
							<?=$red->text?>
						</p>
					
						<h4 style="text-align:center"><a data-id="<?=$red->id?>" class="details btn" href="productDetails.html"> <i class="icon-zoom-in"></i></a><a class="btn btn-primary" href="#"><?=$red->price?>&euro;</a></h4>
					</div>
					</div>
					</li>	  
				<?php endforeach;?>  
			</ul>	
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