<?php
  require_once "konekcija.php";
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <title>Computer Shop - Products</title>
	<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Browse and buy from our collection of products" />
    <meta name="keywords" content="gaming, desktop, products, laptop, computer"/>
    <meta name="author" content="David Sekulić"/>

<!-- Bootstrap style --> 
    <link id="callCss" rel="stylesheet" href="themes/bootshop/bootstrap.min.css" media="screen"/>
    <link href="themes/css/base.css" rel="stylesheet" media="screen"/>
<!-- Bootstrap style responsive -->	
	<link href="themes/css/bootstrap-responsive.min.css" rel="stylesheet"/>
	<link href="themes/css/font-awesome.css" rel="stylesheet" type="text/css">

	<link rel="shortcut icon" href="assets/img/favicon.ico">
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

	<br/>
		
		  <br/>

		  <div class="thumbnail">
			<img src="themes/images/payment_methods.png" title="Bootshop Payment Methods" alt="Payments Methods">
			<div class="caption">
			  <h5>Payment Methods</h5>
			</div>
		  </div>
</div>
<!-- Sidebar end=============================================== -->

<?php 
  
    if($_GET["catId"]!=0){
      $data=$konekcija->query('select name from categories where id='.$_GET["catId"]);
      $rez=$data->fetch();  
      $name=$rez->name;      
    }
    else{
      $name='All';
    }
      
  ?> 

	<div class="span9">
    <ul class="breadcrumb">
		<li><a href="index.php">Home</a> <span class="divider">/</span></li>
		<li class="subName" class="active"><?=$name?></li>
	</ul>
	
 

	<h3  class="subName" > <?=$name?> </h3>
	
	<hr class="soft" >
	<p id="subText"></p>
	<hr class="soft"/>
	<form class="form-horizontal span6">
		<div class="control-group">
		  <label class="control-label alignL">Sort By </label>
      <?php $orderNum=$_GET["order"];
      ?>
			<select id="sortBy">
        <option value=1 <?php if($orderNum==1) echo 'selected' ?>  >Product name A - Z</option>
        <option value=2 <?php if($orderNum==2) echo 'selected' ?> >Product name Z - A</option>    
			  <option value=3 <?php if($orderNum==3) echo 'selected' ?> >Price Lowest first</option>
			  <option value=4 <?php if($orderNum==4) echo 'selected' ?> >Price Highest first</option>
            </select>
		</div>
	  </form>
	  
<?php 



//drop down order
  $order="";              
  switch ($orderNum) {                                    
    case 2:
        $order="name DESC";
        break;
    case 3:
        $order="price";
        break;
    case 4:
      $order="price DESC";
      break;
    default:
      $order="name";
      break;
  }


  if(isset($_GET["catId"])&&isset($_GET["subId"])) {                      
    $queryAll='select * from products where catID='.$_GET["catId"].' and subCatId='.$_GET["subId"];
  }

  else if(isset($_GET["catId"])){  
    if($_GET["catId"]==0){
      $queryAll='select * from products';
      if(isset($_GET["srch"])){
        $queryAll.=' where name like "%'.$_GET["srch"].'%"';
      }
    }
    else{          
      $queryAll='select * from products where catID='.$_GET["catId"];
      if(isset($_GET["srch"])){
        $queryAll.=' and name like "%'.$_GET["srch"].'%"';
      }
    } 
  
  }

  $offset=($_GET["pg"]-1)*6;
  $query=$queryAll.' ORDER BY '.$order.' LIMIT '.$offset.',6';
  $dataAll=$konekcija->query($queryAll);
  $data=$konekcija->query($query);

  $rez=$data->fetchAll();        

  $pgNum=count($dataAll->fetchAll());
  $pgNum=ceil($pgNum/6);

?>


<div id="myTab" class="pull-right">
 <a href="#listView" data-id=1><span id="listBtn" class="btn btn-large btn-primary"><i class="icon-list"></i></span></a>
 <a href="#blockView" data-id=2><span id="blockBtn" class="btn btn-large"><i class="icon-th-large"></i></span></a>
</div>
<br class="clr"/>
<div class="tab-content" id="contentProducts">
<div class="tab-pane active" id="blockView">
		<ul class="thumbnails" id="productsBlock">
           
            
    <?php
          $html="";                            
          foreach($rez as $red)
          {
              $html.="<li class='span3'>
              <div class='thumbnail'>
              <a class='details' data-id='$red->id' href='productDetails.html'><img src='assets/img/$red->img.jpg' alt='$red->img'/></a>
              <div class='caption'>
                  <h5>$red->name</h5>
                  <p> 
                      $red->text
                  </p>
                  <h4 style='text-align:center'><a class='details btn' data-id='$red->id' href='productDetails.htm'> <i class='icon-zoom-in'></i></a><a class='btn btn-primary' href='#'>&euro;$red->price</a></h4>
              </div>
              </div>
              </li>";
                      
          }
          echo $html;  
               
            ?>
            
             
		</ul>
	<hr class="soft"/>
	</div>

	<div class="tab-pane" id="listView">
		<div id="productsList">
    <?php
          $html="";                            
          foreach($rez as $red)
          {
              $html.="
              <div class='row'>	  
                      <div class='span2'>
                          <img class='details' data-id='$red->id' src='assets/img/$red->img.jpg' alt='$red->img}'/>
                      </div>
                      <div class='span4'>
                          <h3>$red->name</h3>				
                          <hr class='soft'/>
                          <h5>$red->brand</h5>
                          <p>
                          $red->text
                          </p>
                          <br class='clr'/>
                      </div>
                      <div class='span3 alignR'>
                      <form class='form-horizontal qtyFrm'>
                      <h3>  $red->price&euro;</h3>
                          
              
                      <a href='productDetails.php' data-id='$red->id' class='details btn btn-large'><i class='icon-zoom-in'></i></a>
                      
                          </form>
                      </div>
                  </div>
                  <hr class='soft'/>";                  
          }
          echo $html;  
               
            ?>
		</div>
 
	</div>
</div>

<div class="pagination">
	<ul>
        <?php
            $html="";
            for($i=1;$i<=$pgNum;$i++){
                if($i==$_GET["pg"]){
                  $html.='<li><a id="activePage" class="pages" href="">'.$i.'</a></li>';
                }
                else{
                  $html.='<li><a class="pages" href="">'.$i.'</a></li>';
                }
                
            }
            echo $html;
            
        ?>
        
		
	</ul>
</div>
	<br class="clr"/>

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