<?php 
    $data=$konekcija->query('select * from categories');
    $kategorije=$data->fetchAll();
    foreach($kategorije as $redKat){
        $subKat=$konekcija->query('select * from subcategories where catID='.$redKat->id)->fetchAll();
        echo '<li class="subMenu"><a>'.$redKat->name.'</a><ul>';
        foreach($subKat as $subRed){
            echo '<li style="display:none"><a href="products.php?catId='.$redKat->id.'&subId='.$subRed->id.'&pg=1&order=1#'.'"><i class="icon-chevron-right"></i>'.$subRed->name.'</a></li>';
        }
        echo '</ul></li>';
    }
?>