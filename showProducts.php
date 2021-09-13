<?php
    require_once "konekcija.php";

    $data=$konekcija->query('select * from products');
    $rez=$data->fetchAll();  
?>

<div class="tab-pane active" id="#adminShow">
		<ul class="thumbnails">              
            <?php
                $html="";    
                for ($i=($_GET["page"]-1)*8; $i <($_GET["page"])*8 && $i<count($rez); $i++) { 
                    
                    $html.="<li class='span3'>
                    <div class='thumbnail'>
                    <p>Product ID ".$rez[$i]->id."</p>                   
                    <a class='productSelect' data-id='".$rez[$i]->id."'href='#'><img src='assets/img/".$rez[$i]->img.".jpg' alt='".$rez[$i]->img."'/></a>
                    <div class='caption'>
                        <h5>".$rez[$i]->name."</h5>
                        <p> 
                            ".$rez[$i]->text."
                        </p>
                        <h4 style='text-align:center'>&euro;".$rez[$i]->price."</h4>
                    </div>
                    </div>
                    </li>";


                }                        
             
                echo $html;            
            ?>                          
	    </ul>
	<hr class="soft"/>
</div>

<div class="pagination">
	<ul>
        <?php
            $html="";
            for($i=1;$i<=ceil(count($rez)/8);$i++){
                if($i==$_GET["page"]){
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