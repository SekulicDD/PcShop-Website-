
<?php
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
	  }
    if(!isset($_SESSION["user"])){
        header("Location: manage/noAccess.php");
    }
    else if($_SESSION["user"][0]->uloga!="Admin"){
        header("Location: manage/noAccess.php");
    }

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
  <link href="assets/css/style.css" rel="stylesheet" type="text/css">


	
  </head>
<body>


<?php
  require_once "header.php";
?>

<div id="mainBody">
	<div class="container">
	<div class="row">
  <div class="span12">		
			<div class="well">
        <h3>Admin panel</h3>
        <ul>
        <li class="btn" id="select">SHOW ALL PRODUCTS</li>
        <li class="btn" data-toggle="modal" data-target="#insertModal" id="insert">INSERT NEW PRODUCT</li>
        <li class="btn" id="delete">DELETE SELECTED PRODUCT</li>       
        </ul>

        <div id="op">
         
        </div>



<!-- Modal -->
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">New product data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form  action="operations/insert.php" method="POST">
        <input type="text" name="productName" placeholder="Product name">
        <input type="text" name="productText" placeholder="Product text">
        <input type="number" name="productPrice" placeholder="Product price">
        <input type="number" name="productStock" placeholder="Number in stock">
        <input type="text" name="productBrand" placeholder="Brand">
        <input type="text" name="productModel" placeholder="Model">
        <input type="text" name="productFeatures" placeholder="Product features">

        <?php       
          $data=$konekcija->query('select * from subcategories');
          $kategorije=$data->fetchAll();
          $html="<label>Category:</label><select id='category' name='category'>";
          foreach($kategorije as $redKat){
            $html.="<option value='".$redKat->catID.",".$redKat->id."'>".$redKat->name."</option>";
          }
          $html.="</select>";

          echo $html;
        ?>   

        <label>Date released:</label>
        <input type="date" name="productDate" placeholder="Date released">
        <button type="submit" name="insertSubmit" class="btn btn-primary">Insert</button>
      <form>

 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        
      </div>
    </div>
  </div>
</div>
     
<div class="modal fade" id="insertModal" tabindex="-1" role="dialog" aria-labelledby="insertModal" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">New product data</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      
 

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        
      </div>
    </div>
  </div>
</div>











 
	</div>
  


  
  <div id="adminProducts">
    
  </div>
 







	</div>
	</div>
</div>
<!-- Footer ================================================================== -->
<?php
	require_once "footer.php";
?>

	<script src="assets/js/jquery-3.4.1.min.js"></script>
  <script src="assets/js/main2.js"></script>
  <script src="themes/js/bootstrap.min.js" type="text/javascript"></script>
  
</body>

</html>