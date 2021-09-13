<?php
    if (session_status() == PHP_SESSION_NONE) {
            session_start();
    }
?>
    
<div id="header">
    <div class="container">
        <div id="logoArea" class="navbar">     
        <div class="navbar-inner">
            <a class="brand" href="index.php#"><img src="assets/img/logo.png" alt="pcshop"/></a>
            <form class="form-inline navbar-search" method="post" action="products.php" >
                <input id="searchTxt" class="srchTxt" type="text" />
                <select class="srchTxt" id="searchSelect">
                    <option value=0>All</option>
                    <?php 
                       
                        $data=$konekcija->query('select * from categories');
                        $rez=$data->fetchAll();

                        for ($i=0; $i < count($rez); $i++):?>                           
                            <option value=<?=$i+1?>><?=$rez[$i]->name?></option>
                        <?php endfor;?>
                          
                </select> 
                <button type="button" id="searchBtn" class="btn btn-primary">Go</button>
            </form>
            <ul id="topMenu" class="nav pull-right">
            <li><a href="index.php#">Home</a></li>
            <li><a href="products.php?catId=0&pg=1&order=1">Products</a></li>
            <li><a href="contact.php#">Contact</a></li>
            <?php 
            if(isset($_SESSION["user"])){
                if($_SESSION["user"][0]->uloga=="Admin"){
                    echo "<li><a href='admin.php#'>Admin panel</a></li>";
                }
            }
            ?>
            <li class="">
            <?php 
                if(isset($_SESSION["user"]))
                    echo "<a href='manage/logout.php' style='padding-right:0'><span class='btn btn-large btn-success'>Log Out</span></a>";
                else
                    echo "<a href='loginRegister.php#' style='padding-right:0'><span class='btn btn-large btn-success'>Log In</span></a>";       
            ?>
         
            </ul>
        </div>
        </div>
        <div  class="row">
            <p class="span6"> 
            <?php 
                if(isset($_SESSION["user"]))
                    echo  "Welcome ".$_SESSION["user"][0]->name."!";
                else 
                    echo "You are browsing as guest.";
            ?>
            </p>
            </strong></div>
        </div>
    </div>
    
