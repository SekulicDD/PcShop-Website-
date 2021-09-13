window.onload=()=>{
    
    getCategories();
    cartLabel();
   
    let fileName = location.pathname.split("/").slice(-1);
    if ((fileName == "index.html") || (fileName == ""))
    {              
        localStorage.removeItem("id");
        localStorage.removeItem("idSrch"); 
        getLatest();

        //SLIDE SHOW
        let iSlide=0;
        let images=["b1.png","b2.png","b3.png"];
        let time;
       
        let timer=function()
        {
            time=setInterval(()=>{
            iSlide++;
            if(iSlide>images.length-1)
                iSlide=0;
            changeSlider(images[iSlide]);    
        },5000);
        }

        timer();

        $("#leftSlide").on("click",(e)=>{
            e.preventDefault();
            iSlide--;
            if(iSlide==-1)
                iSlide=images.length-1;
            changeSlider(images[iSlide]);
            clearInterval(time);
            timer();
        });
    
        $("#rightSlide").on("click",(e)=>{
            e.preventDefault();                  
            iSlide++;
            if(iSlide>images.length-1)
                iSlide=0;
            changeSlider(images[iSlide]);
            clearInterval(time);
            timer();
        });

        //FEATURED PRODUCTS     
        let featuredArr=createRandomArr(13);
        let iFeatured=0;
        
        
        $("#featuredLeft").css("display","none");
        $("#featuredLeft").on("click",(e)=>{
            e.preventDefault();
            iFeatured--;          
            if(iFeatured==0){
                $("#featuredLeft").css("display","none");
            }
            $("#featuredRight").css("display","block");
            showFeatured(featuredArr,iFeatured,"left");
        });
    
        $("#featuredRight").on("click",(e)=>{
            e.preventDefault();                  
            iFeatured++;          
            if(iFeatured>8){
                $("#featuredRight").css("display","none");
            }
            $("#featuredLeft").css("display","block");
            showFeatured(featuredArr,iFeatured,"right");
        });
        
        
       
    }

    else if (fileName == "products.html")
    {       
        
        if(localStorage.getItem("id")==null&&localStorage.getItem("idSrch")==null) {
            localStorage.setItem("idSrch",0);
            localStorage.setItem("id",0);

        } 
           

        createProducts();
        productsView();

        //Razlicti prikaz proizvoda
        $("#sortBy").on("change",createProducts);
        $("#myTab a").on("click",function(e){
            e.preventDefault();
            let tmp=$(this).data("id");
            if(tmp!=localStorage.getItem("raspored")){
                localStorage.setItem("raspored",tmp);
                productsView();
            }
        });      
    }

    else if (fileName == "productDetails.html"){
        createDetails();
      
    }

    else if (fileName == "cart.html"){
       
        createCart();
        localStorage.setItem("pg",1);
    }

    else if (fileName == "contact.html")
    {   
        $("#send").on("click",regex);
    }

    else if (fileName == "author.html")
    {   
        $("#aLeft img").hover(function () {
            $(this).stop(true, true).css({ "opacity": "1","border":"3px solid #4a4aff"});
    
        },
            function () {
                $(this).stop(true, true).css({ "opacity": "0.8","border":"3px solid white"});
    
            });
    }




   
}

regex=()=>{
    let name,email,message;
    let reName,reEmail;
    let send=true;
    let errors=[];

    name=$("#name").val().trim();
    email=$("#email").val().trim();
    message=$("#mess").val().trim();

    reName = /^[A-Z][a-z]{1,14}(\s[A-Z][a-z]{1,19})+$/;
    reEmail = /^[a-z][a-z\d\_\.\-]+\@[a-z\d]+(\.[a-z]{2,4}){1,3}$/;
    
    if (!reName.test(name)){
        send=false;
        errors.push("Name not in correct format: John Smith");
    }
    if (!reEmail.test(email)){
        send=false;
        errors.push("Email not in correct format: john23@gmail.com");
    }
    if (message.length > 160||message.length < 16) {
        send = false;
        errors.push("Message need to between 16 and 160 characters");
    }
    
    if(send==false)
    {
        let errorIspis="<h4>Contact Format</h4>";
        errors.forEach(el => {
            errorIspis+=`<p>${el}</p>`;
        });
        $("#errors").html(errorIspis);
        $("#errors").css("color","red");
    }
    else{
        alert("Message was sent sucessfuly");
        $("#name").val("");
        $("#email").val("");
        $("#mess").val("");
        $("#errors").html(`<h4>Message Format</h4>
        <p>Name format: John Smith</p>
        <p>Email format: john23@gmail.com</p>
        <p>Message between 16 and 160 characters</p>`);
        $("#errors").css("color","black");
    }
}

//PRAVLJENJE MENIJA
createMenu=(data)=>{
    let div=document.querySelector("#header");
    
    ispis=`<div class="container">
    <div id="logoArea" class="navbar">
    
      <div class="navbar-inner">
        <a class="brand" href="index.html#"><img src="assets/img/logo.png" alt="pcshop"/></a>
        <form class="form-inline navbar-search" method="post" action="products.html" >
            <input id="searchTxt" class="srchTxt" type="text" />
            <select class="srchTxt" id="searchSelect">
            <option value=0>All</option>`
                data.forEach(el => {
                    ispis+=`<option value=${el.id}>${el.name}</option>`
                });
                		
           ispis+=`</select> 
              <button type="button" id="searchBtn" class="btn btn-primary">Go</button>
        </form>
        <ul id="topMenu" class="nav pull-right">
         <li class=""><a href="index.html#">Home</a></li>
         <li class=""><a href="products.html#">Products</a></li>
         <li class=""><a href="contact.html#">Contact</a></li>
         <li class="">
         
        </li>
        </ul>
      </div>
    </div>
    </div>`
    div.innerHTML=ispis;

    
    $("#smallScreen").on("click",function(){
        $("#topMenu").slideToggle();
    });
    $("#searchBtn").on("click",search);
           
}

 search=()=>{
    let idSrch=$("#searchSelect").val();
    let srchTxt=$("#searchTxt").val().trim().toLowerCase();

    if(localStorage.getItem("idSrch")!=idSrch||localStorage.getItem("srchTxt")!=srchTxt){
        localStorage.setItem("idSrch",idSrch);
        localStorage.setItem("srchTxt",srchTxt);
        localStorage.setItem("id",0);
        window.location.href = "products.html#";
        createProducts();
    }
}



//SLIDE SHOW
changeSlider=(img)=>{
    let image=$("#myCarousel .container img");
    image.fadeOut("fast",()=>{
        image.attr("src", "assets/img/"+img);
        image.fadeIn();
    })
}

//SIDE BAR
createSideBar=(data)=>{
    let div=document.querySelector("#sideMenu");
    if(div!=null){
        let ispis="";

        for (let el of data) {
            ispis+=`<li class="subMenu"><a>${el.name}</a><ul>`
            el.subCategory.forEach(sub => {
                ispis+=`<li style="display:none"><a data-id="${el.id},${sub.id}" href="products.html#"><i class="icon-chevron-right"></i>${sub.name}</a></li>`
            });
            ispis+="</ul></li>";
        }

        div.innerHTML=ispis;
        $(".subMenu a").on("click",function(){
            $(this).siblings().find("li").slideToggle();
        })

        $(".subMenu li a").on("click",function(e){
            e.preventDefault();
            let id=$(this).data("id");
            localStorage.removeItem("idSrch"); 
            if(localStorage.getItem("id")!=id){
                localStorage.setItem("id",id); 
                createProducts();
            }       
            window.location.href = "products.html#";
            

        })
    }
}

//PRIKAZ FEATURED PROIZOVDA
showFeatured=(data,i,animate)=>{
    let ispis="";

    for ( index = i; index < i+4; index++) {              
        ispis+= `
        <li class="span3">
        <div class="thumbnail">
        <i class="tag"></i>
            <a data-id="${data[index].id}" class="details" href="productDetails.html"><img src="assets/img/${data[index].img.name}.jpg" alt="${data[index].img.alt}"></a>
            <div class="caption">
            <h4><a data-id="${data[index].id}" class="btn details" href="productDetails.html">VIEW</a> <span class="pull-right">${data[index].price}&euro;</span></h4>
            </div>
        </div>
        </li>`     
    }
            
    if(animate=="left"){
        $("#featuredShown").stop(true,true).animate({"margin-left":"+=30px"},200);
        $("#featuredShown").stop(true,true).html(ispis).animate({"margin-left":"-=30px"},200);
    }
    else{
        $("#featuredShown").stop(true,true).animate({"margin-right":"+=30px"},200);
        $("#featuredShown").stop(true,true).html(ispis).animate({"margin-right":"-=30px"},200);
    }

    $(".details").on("click",function(e){
        e.preventDefault();
        sendToDetails($(this).data("id"));
    });
      
}

//KREIRANJE NIZA SA RANDOM BROJEVIMA
createRandomArr=(len)=>{
    let rndProducts=[];
    $.ajax({
        type:"json",
        method: "GET",
        url: "data/products.json",
        success:function(data){
            for (let i=0;i<len;i++){
                let rnd=Math.round(Math.random()*34);
                while(rndProducts.includes(data[rnd])){
                    rnd=Math.round(Math.random()*34);
                }                                   
                rndProducts[i]=data[rnd];
            }
            showFeatured(rndProducts,0,"right");
        },
        error:function(xhr,error,status){
            console.log(status,error);
        }
      }); 
    return rndProducts;
}

//PRIKAZ NAJNOVIJIH PROIZVODA
createLatest=(data)=>{
    let div=document.querySelector("#latestProducts");
    let ispis="";
    for (let i = 0; i < 6; i++) {
        ispis+=`<li class="span3">
        <div class="thumbnail">
          <a data-id="${data[i].id}" class="details" href="productDetails.html"><img src="assets/img/${data[i].img.name}.jpg" alt="${data[i].img.alt}"/></a>
          <div class="caption">
            <h5>${data[i].name}</h5>
            <p> 
                ${data[i].text} 
            </p>
           
            <h4 style="text-align:center"><a data-id="${data[i].id}" class="details btn" href="productDetails.html"> <i class="icon-zoom-in"></i></a> <a data-id="${data[i].id}" class="btn cartAdd" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">${data[i].price}&euro;</a></h4>
          </div>
        </div>
        </li>`        
    }
    div.innerHTML=ispis;

    $(".details").on("click",function(e){
        e.preventDefault();
        sendToDetails($(this).data("id"));
    });

    $(".cartAdd").on("click",function(e){
        e.preventDefault();
        addToCart($(this).data("id"),1);
    })
 
}

//DOHVATANJE PROIZVODA I PRIKAZ
createProducts=()=>{
    
    let idSrch=localStorage.getItem("idSrch");
    let srchTxt=localStorage.getItem("srchTxt");
    
    let products=[];
    localStorage.setItem("pg",1);

    let [idCat,idSubcat] = localStorage.getItem("id").split(",");

    $.ajax({
        type:"json",
        method: "GET",
        url: "data/products.json",
        success:function(data){
            if(idSrch==null){
                products=data.filter(el=>el.catID==idCat && el.subCatId==idSubcat)

               
            }
            else if(idSrch==0)
            {
                if(srchTxt){
                    products=data.filter(el=>el.name.toLowerCase().indexOf(srchTxt)>-1)
                    
                }

                else
                    products=data;
            }
            else
            {
                if(srchTxt){
                    products=data.filter(el=>el.catID==idSrch && el.name.toLowerCase().indexOf(srchTxt)>-1)
               
                }
                else{
                    products=data.filter(el=>el.catID==idSrch)
                   
                }
            } 
            
            let checked=$("#priceRanges input[name=priceRange]:checked");
            let tmp=[];
                 
           $("#productCount").text(products.length+" products are available");
           //console.log(products);
           showPagination(products);
           showProducts(sortProducts(products),1);  
           setCategoryText(idCat,idSubcat,idSrch);               
        },
        error:function(xhr,error,status){
            console.log(status,error);
        }
      });       
}




//RAZLICIT PRIKAZ PROZIVODA
productsView=()=>{
    if(localStorage.getItem("raspored")==1){       
        $("#listView").addClass("active");
        $("#blockView").removeClass("active");
        $("#listBtn").addClass("btn-primary");
        $("#blockBtn").removeClass("btn-primary");
    }
    else {      
        $("#blockView").addClass("active");
        $("#listView").removeClass("active");
        $("#blockBtn").addClass("btn-primary");
        $("#listBtn").removeClass("btn-primary");
    }
}

//SORTIRANJE
sortProducts=(products)=>{  
    let number=parseInt($("#sortBy").val(),10);
     switch(number) {
        case 1:
            products.sort((a, b)=>{                        
                if(a.name < b.name)  
                    return -1; 
                if(a.name > b.name)  
                    return 1; 
                return 0;
            });          
        break;
        case 2:
            products.sort((a, b)=>{                        
                if(a.name > b.name)  
                    return -1; 
                if(a.name < b.name)  
                    return 1; 
                return 0;
            });                             
        break;
        case 3:
            products.sort((a, b)=>{                        
                return a.price-b.price;
            });                             
        break; 
        case 4:
            products.sort((a, b)=>{                        
                return b.price-a.price;
            });                             
        break;  
        default:
            console.log("Error sa selekcijom");                           
    }
      return products;
}


//PRIKAZ PROIZVODA
showProducts=(products,i)=>{
    let ispisBlok="";
    let ispisLista="";

    let pages=document.getElementsByClassName("pages");
    for (let index = 0; index < pages.length; index++) {
        pages[index].style.color="black";
    }

    pages[i-1].style.color="red";
     
    if(products.length>0){
        for (let ind=i*6-6; ind<i*6&&ind<products.length; ind++) {
            ispisBlok+=`<li class="span3">
            <div class="thumbnail">
            <a class="details" data-id="${products[ind].id}" href="productDetails.html"><img src="assets/img/${products[ind].img.name}.jpg" alt="${products[ind].img.alt}"/></a>
            <div class="caption">
                <h5>${products[ind].name}</h5>
                <p> 
                ${products[ind].text}
                </p>
                <h4 style="text-align:center"><a class="details btn" data-id="${products[ind].id}" href="productDetails.html"> <i class="icon-zoom-in"></i></a> <a data-id="${products[ind].id}" class="btn cartAdd" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">&euro;${products[ind].price}</a></h4>
            </div>
            </div>
        </li>`
        ispisLista+=`
        <div class="row">	  
                <div class="span2">
                    <img class="details" data-id="${products[ind].id}" src="assets/img/${products[ind].img.name}.jpg" alt="${products[ind].img.alt}"/>
                </div>
                <div class="span4">
                    <h3>${products[ind].name}</h3>				
                    <hr class="soft"/>
                    <h5>${products[ind].brand}</h5>
                    <p>
                    ${products[ind].text}
                    </p>
                    <br class="clr"/>
                </div>
                <div class="span3 alignR">
                <form class="form-horizontal qtyFrm">
                <h3>  ${products[ind].price}&euro;</h3>
                    
                <a href="productDetails.html" data-id="${products[ind].id}" class="btn btn-large btn-primary cartAdd"> Add to <i class=" icon-shopping-cart"></i></a>
                <a href="productDetails.html" data-id="${products[ind].id}" class="details btn btn-large"><i class="icon-zoom-in"></i></a>
                
                    </form>
                </div>
            </div>
            <hr class="soft"/>`

        }
    
    $("#productsBlock").hide();
    $("#productsBlock").fadeIn("slow");
    $("#productsBlock").html(ispisBlok);

    $("#productsList").hide();
    $("#productsList").fadeIn("slow");
    $("#productsList").html(ispisLista);  
    }

    else{
        $("#productsBlock").html("<li class='span9'><h2>Sorry we can't find your product</h2></li>");
    }

    $(".details").on("click",function(e){
        e.preventDefault();
        sendToDetails($(this).data("id"));
    });

    $(".cartAdd").on("click",function(e){
        e.preventDefault();
        addToCart($(this).data("id"),1);
    })

}

//SALJE DETAILS
function sendToDetails(id){
    localStorage.setItem("detailsId",id);
    window.location.href = "productDetails.html";
}

//DOHVATANJE PROIZVODA ZA DETAILS

createDetails=()=>{
    let id=localStorage.getItem("detailsId");
    let product;
    $.ajax({
        type:"json",
        method: "GET",
        url: "data/products.json",
        success:(data)=>{
            data.forEach(el => {
                if(el.id==id){
                    showDetails(el);                  
                }               
            });
        },
        error:(xhr,error,status)=>{
            console.log(status,error);
        }
      }); 
}

showDetails=(product)=>{
    let ispisBlok1="";
    let ispisBlok2="";
    let defaultPrice=product.price;

    $("#imgDetail").attr("src","assets/img/"+product.img.name+".jpg");

    ispisBlok1=`
    <h3>${product.name}</h3>
        <small>${product.text}</small>
        <hr class="soft"/>
        <form class="form-horizontal qtyFrm">
            <div class="control-group">
            <label class="control-label"><span id="price">${product.price}&euro;</span></label>
            <div class="controls">
            <input id="quant" type="number" class="span1" placeholder="Qty." min="1" max="${product.inStock}"/>
                <button type="button" data-id="${product.id}" class="cartAdd btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
            </div>
            </div>
        </form>
        
        <hr class="soft"/>
        <h4>In stock: ${product.inStock}</h4>
        
        <hr class="soft clr"/>
        <p>
        ${product.features}
        </p>

    <hr class="soft"/>
    `

    ispisBlok2=`
    <div id="myTabContent" class="tab-content">
              <div class="tab-pane fade active in" id="home">
			  <h4>Product Information</h4>
                <table class="table table-bordered">
				<tbody>
				<tr class="techSpecRow"><th colspan="2">Product Details</th></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">${product.brand}</td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Model:</td><td class="techSpecTD2">${product.model}</td></tr>
				<tr class="techSpecRow"><td class="techSpecTD1">Released on:</td><td class="techSpecTD2">${product.released}</td></tr>
				</tbody>
				</table>
				
				<br/>
				<br/>
              </div>
		</div>
    `
    
    $("#blok1").html(ispisBlok1);
    $("#blok2").html(ispisBlok2);

    let quantity=1;
    $("#quant").on("change",function(){
        if($(this).val()<1)
            $(this).val(1);
        if($(this).val()>product.inStock)
            $(this).val(product.inStock);

        quantity=$(this).val();
        let price=(quantity*defaultPrice).toFixed(2);
        $("#price").text(price+'€');
    })

    $(".cartAdd").on("click",function(e){
        e.preventDefault();
        console.log(quantity);
        addToCart($(this).data("id"),quantity);
    })
    
}




//PRIKAZ BROJA STRANE
showPagination=(products)=>{
    let number=Math.ceil(products.length/6);
    let ispis="<ul>";
    for (let i = 1; i <=number; i++) {
       ispis+=`<li><a class="pages"href="#">${i}</a></li>`;    
    }
    ispis+="</ul>";
    $(".pagination").html(ispis);

    $(".pagination ul li a").on("click",function(e){
        e.preventDefault();
        let pg=$(this).text();
        if(localStorage.getItem("pg")!=pg)
        {
            localStorage.setItem("pg",pg);
            showProducts(products,pg);
        }
    });
}

//SETOVANJE TEKSTA product page
setCategoryText=(idCat,idSubcat,idSrch)=>{  
    $.ajax({
        type:"json",
        method: "GET",
        url: "data/categories.json",
        success:function(data){
            if(idSrch==null){
            data.forEach(el => {    
                if(el.id==idCat)
                    el.subCategory.forEach(sub => {
                        if(sub.id==idSubcat){
                            $(".subName").text(sub.name);
                            $("#subText").text(sub.text);
                        }
                    });                         
            }); 
            }
            else{   
                data.forEach(el => {
                    if(idSrch==0)
                        $(".subName").text("All");

                    else if(el.id==idSrch)                   
                        $(".subName").text(el.name);
                     
                    $("#subText").text("We hope you found item you were looking for.");
                });
            }                         
        },
        error:function(xhr,error,status){
            console.log(status,error);
        }
    }); 
}


//DODAVANJE U KORPU

addToCart=(id,quant)=>{ 
    
    let cartItems=JSON.parse(localStorage.getItem("cart"));
    var i;
    let tmp=[];

    if(cartItems!=null){
        for (i = 0; i < cartItems.length; i++) {
            if(cartItems[i][0]==id){
                cartItems[i][1]=parseInt(cartItems[i][1])+parseInt(quant);
                localStorage.setItem("cart",JSON.stringify(cartItems)); 
                break;
            }
            
        }
        if(i==cartItems.length){
            tmp.push(id,quant);                    
        }

    }
    else{
        cartItems=[];
        tmp.push(id,quant);     
    }

    if(tmp.length>0){
        cartItems.push(tmp);
        localStorage.setItem("cart",JSON.stringify(cartItems)); 
    } 

    alert("Added to cart");
    cartLabel();

}



//PRIKAZ KORPE
createCart=()=>{
   let cartItems=JSON.parse(localStorage.getItem("cart"));

   $.ajax({
    type:"json",
    method: "GET",
    url: "data/products.json",
    success:(data)=>{
        let productsIspis=[];
        for (let i = cartItems.length-1; i >= 0; i--){
            data.forEach(el => {
                if(cartItems[i][0]==el.id){
                    productsIspis.push(showCartItem(el,cartItems[i][1]));
                }      
            });
        }
        
        showCart(productsIspis,localStorage.getItem("pg"));
        showPaginationCart(productsIspis);
        
       
    },
    error:function(xhr,error,status){
        console.log(status,error);
    }
  }); 


}

//PRIKAZ 1 cart itema
showCartItem=(product,quantity)=>{
   
    let ispis=`
    <tr>
        <td> <img width="60" src="assets/img/${product.img.name}.jpg" alt="${product.img.alt}"/></td>
        <td>${product.brand}<br/>${product.model}</td>
        <td>
        <div class="input-append">
        <input data-id="${product.id}" class="quantityInput span1" data-max=${product.inStock} value="${quantity}" style="max-width:34px" placeholder="1" type="number" min="1" max="${product.inStock}">  
        <button onclick="let tmp=$(this).parent().find('input');tmp.val(parseInt(tmp.val())-1);tmp.trigger('change');" class="btn" type="button"><i class="icon-minus"></i></button>
        <button onclick="let tmp=$(this).parent().find('input');tmp.val(parseInt(tmp.val())+1);tmp.trigger('change');" class="btn" type="button"><i class="icon-plus"></i></button>	
        <button data-id="${product.id}" class="itemDelete btn btn-danger" type="button"><i class="icon-remove icon-white"></i></button>
        </div>
        </td>
        <td>${product.price}&euro;</td>                 
        <td>${(product.price*quantity).toFixed(2)}&euro;</td>                
    </tr>`;

    return ispis;
}



//PRIKAZ KORPE

showCart=(productIspis,i)=>{
    
    let ispis="";
    for (let ind=i*4-4; ind<i*4&&ind<productIspis.length; ind++) 
        ispis+=productIspis[ind];

   
    $("#cartProducts").html(ispis);

    $(".quantityInput").on("change",function(){ 
        if($(this).val()<1)
            $(this).val(1);
        if($(this).val()>$(this).data("max"))
            $(this).val($(this).data("max")); 
            
        changeQuantity($(this).data("id"),$(this).val())
        createCart(localStorage.getItem("pg"));
    }); 
    
    $(".itemDelete").on("click",function(){deleteCartItem($(this).data("id"))});
    
}

//BRISANJE ITEMA IZ KORPE
deleteCartItem=(id)=>{
    console.log(id);
    let cartItems=JSON.parse(localStorage.getItem("cart"));
    console.log(cartItems);
    localStorage.setItem("cart",JSON.stringify(cartItems.filter(el=>el[0]!=id)));  
    createCart();
}


//PAGINACIJA KORPE
showPaginationCart=(products)=>{
    let number=Math.ceil(products.length/4);
    let ispis="<ul>";
    for (let i = 1; i <=number; i++) {
       ispis+=`<li><a href="#">${i}</a></li>`;    
    }
    ispis+="</ul>";
    $(".pagination").html(ispis);

    $(".pagination ul li a").on("click",function(e){
        e.preventDefault();
        let pg=$(this).text();
        if(localStorage.getItem("pg")!=pg)
        {
            localStorage.setItem("pg",pg);
            showCart(products,pg);
        }
    });
}

//PROMENA KOLICINE PROIZOVDA
changeQuantity=(id,value)=>{
    
    let cartItems=JSON.parse(localStorage.getItem("cart"));
    for (let i = 0; i < cartItems.length; i++) {
        if(cartItems[i][0]==id){
            cartItems[i][1]=value;
            break;
        }
    }

    localStorage.setItem("cart",JSON.stringify(cartItems));
    cartLabel();
}

//PRIKAZ MINI CART
cartLabel=()=>{
    let cartItems=JSON.parse(localStorage.getItem("cart"));
    let sum=0;

    if(cartItems!=null)
    {
        {
        cartItems.forEach(el => {
            sum=parseInt(sum)+parseInt(el[1]);
        });

        if(cartItems.length>0)
            $("#cartNumber").html("There is "+sum+" items in your cart");
        }
    }
}





    

//AJAX

getCategories=()=>{
    $.ajax({
        type:"json",
        method: "GET",
        url: "data/categories.json",
        success:function(data){
            createMenu(data);
            createSideBar(data);
        },
        error:function(xhr,error,status){
            console.log(status,error);
        }
      }); 
}

getLatest=()=>{
    $.ajax({
        type:"json",
        method: "GET",
        url: "data/products.json",
        success:function(data){
            let products=[];
            data.forEach(el => {
                products.push(el);
            });
            
            products.sort(function(a, b) {
                let d1 = Date.parse(a.released);
                let d2 = Date.parse(b.released);       
                return d2-d1;
            });
            
            createLatest(products);
            
        },
        error:function(xhr,error,status){
            console.log(status,error);
        }
      }); 

}



