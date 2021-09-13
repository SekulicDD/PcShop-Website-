
<?php if(isset($_GET["id"])):?>
<?php 
    $id=$_GET["id"];
    require_once "konekcija.php";
    $query="select * from products where id=:id";
    $prepare=$konekcija->prepare($query);
    $prepare->bindParam(":id", $id);
    $prepare->execute();
    $product=$prepare->fetch();
?>

<div id="gallery" class="span3" >
    <div>
        <img id="imgDetail" src="assets/img/<?=$product->img?>.jpg" style="width:100%" alt="<?=$product->img?>"/>		
    </div>
</div>
        
<div id="blok1" class="span6">			  
    <h3><?=$product->name?></h3>
        <small><?=$product->text?></small>
        <hr class="soft"/>
        <form class="form-horizontal qtyFrm">
            <div class="control-group">
            <label class="control-label"><span id="price"><?=$product->price?>&euro;</span></label>
            <div class="controls">          
            </div>
            </div>
        </form>
        
        <hr class="soft"/>
        <h4>In stock: <?=$product->inStock?></h4>
        
        <hr class="soft clr"/>
        <p>
        <?=$product->features?>
        </p>

    <hr class="soft"/>
</div> 

<div id="blok2" class="span9">
    <div id="myTabContent" class="tab-content">
        <div class="tab-pane fade active in" id="home">
            <h4>Product Information</h4>
            <table class="table table-bordered">
            <tbody>
                <tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
                <tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2"><?=$product->brand?></td></tr>
                <tr class="techSpecRow"><td class="techSpecTD1">Model:</td><td class="techSpecTD2"><?=$product->model?></td></tr>
                <tr class="techSpecRow"><td class="techSpecTD1">Released on:</td><td class="techSpecTD2"><?=$product->released?></td></tr>
            </tbody>
            </table>
            
            <br/>
            <br/>
        </div>
    </div>
</div>

<?php endif;?>


