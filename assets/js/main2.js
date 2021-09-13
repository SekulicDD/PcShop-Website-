window.onload=()=>{

    //NAV BAR
    $(".subMenu a").on("click",function(){
        $(this).siblings().find("li").slideToggle();
    })

    //PRETRAGA
    $("#searchBtn").on("click",function(){
        let idSrch=$("#searchSelect").val();  
        let srchTxt=$("#searchTxt").val().trim().toLowerCase();   

        if(srchTxt)
            window.location.href="products.php?catId="+idSrch+'&pg=1&order=1&srch='+srchTxt+'#'; 
        else
            window.location.href="products.php?catId="+idSrch+'&pg=1&order=1#';
    });

    let fileName = location.pathname.split("/").slice(-1);
    if ((fileName == "index.php") || (fileName == ""))
    {         
        
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

        $(".details").on("click",function(e){
            e.preventDefault();
            sendToDetails($(this).data("id"));
        });
    }
    else if ((fileName == "products.php")){
       
        $(".pagination ul li a").on("click",function(e){
            e.preventDefault();
            let url="";
            url=window.location.href;
            let tmp=url.indexOf("order");
            url=url.substring(0,url.indexOf("pg"))+'pg='+$(this).text()+'&order='+url[tmp+6];
            window.location.href=url;
        });

        $("#sortBy").on("change",function(){
            let url="";
            url=window.location.href;
            url=url.substring(0,url.indexOf("order"))+'order='+$(this).val();
            window.location.href=url;
        });

        //RAZLICIT PRIKAZ
        productsView();
        $("#myTab a").on("click",function(e){
            e.preventDefault();
            let tmp=$(this).data("id");
            if(tmp!=localStorage.getItem("raspored")){
                localStorage.setItem("raspored",tmp);
                productsView();
            }
        }); 

        $("#productsBlock").hide();
        $("#productsBlock").fadeIn("slow");
        
        $("#productsList").hide();
        $("#productsList").fadeIn("slow");

        $(".details").on("click",function(e){
            e.preventDefault();
            sendToDetails($(this).data("id"));
        });
    
    }
    
    else if ((fileName == "admin.php")){

        localStorage.removeItem("selectedItem");
        $("#select").on("click",()=>{
            adminShow(1);
        });

        $("#insert").on("click",()=>{
            insertProduct();
        });

        $("#delete").on("click",()=>{
            deleteProduct();
        
        });
        
   
    }

    else if (fileName == "author.php")
    {   
        $("#aLeft img").hover(function () {
            $(this).stop(true, true).css({ "opacity": "1","border":"3px solid #4a4aff"});
    
        },
            function () {
                $(this).stop(true, true).css({ "opacity": "0.8","border":"3px solid white"});
    
            });
    }

    else if (fileName == "contact.php")
    {   
        $("#send").on("click",regex);
    }

    else if (fileName == "productDetails.php")
    {   
        if(!localStorage.getItem("tmp")){
            window.location.href="index.php";
        }

        $("#detailsDiv").html(localStorage.getItem("tmp"));
        localStorage.removeItem("tmp");
    }
    

}

function sendToDetails(id){
    $.ajax({
        method: "GET",
        data:{"id":id},
        url: "showProductDetails.php",
        success:(data)=>{
            localStorage.setItem("tmp",data);
            window.location.href="productDetails.php";   
                
        },
        error:(xhr,error,status)=>{
            console.log(status,error);
        }
      }); 
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

    return send;
}

function deleteProduct(){
    let id=localStorage.getItem("selectedItem");
    localStorage.removeItem("selectedItem");
    $.ajax({
        method: "POST",
        data:{"id":id},
        url: "operations/delete.php",
        success:(data)=>{
            adminShow(1);
            $("#op").html(data);     
        },
        error:(xhr,error,status)=>{
            console.log(status,error);
        }
      }); 
}


function selectProduct(item){
    if(localStorage.getItem("selectedItem")!=item.data("id")){
        localStorage.setItem("selectedItem",item.data("id"));
        $(".productSelect").parent().css("border","none");
        item.parent().css("border","2px solid blue");
    }
    else{
        localStorage.removeItem("selectedItem");
        item.parent().css("border","none");
    }
    
}

changeSlider=(img)=>{
    let image=$("#myCarousel .container img");
    image.fadeOut("fast",()=>{
        image.attr("src", "assets/img/"+img);
        image.fadeIn();
    })
}

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


function adminShow(page){
    $.ajax({
        method: "GET",
        data:{"page":page},
        url: "showProducts.php",
        success:(data)=>{
            $("#adminProducts").html(data);
            $(".pagination ul li a").on("click",function(e){
                localStorage.removeItem("selectedItem");
                e.preventDefault();
                adminShow($(this).text());
            });
            $(".productSelect").on("click",function(e){
                e.preventDefault();              
                selectProduct($(this));
            });
        },
        error:(xhr,error,status)=>{
            console.log(status,error);
        }
      }); 
 }



function check(){
    $(".error").hide();
    $(".error").fadeIn();

    let errors=[];
    let test=false;

    let reFname,reLname,reEmail,rePass,fname,lname,email,pass,cpass;
    fname=$("#inputFname1").val().trim();
    lname=$("#inputLnam").val().trim();
    email=$("#input_email").val().trim();
    pass=$("#inputPassword1").val().trim();
    cpass=$("#inputPassword2").val().trim();

    reFname=/^[A-Z][a-z]{2,25}$/;
    reLname=/^[A-Z][a-z]{2,35}$/;
    reEmail=/^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+.[a-zA-Z0-9-.]+$/;
    rePass=/^.{5,30}$/;

    if(!reFname.test(fname)){
        let tmp="First name is in wrong format - Example: John";
        errors.push(tmp);
        $("#errorFname").html(tmp);
    }
    else
        $("#errorFname").html("");


    if(!reLname.test(lname)){
        let tmp="Last name is in wrong format - Example: Smith";
        errors.push(tmp);
        $("#errorLname").html(tmp);
    }
    else
        $("#errorLname").html("");

    if(!reEmail.test(email)){
        let tmp="Email is in wrong format - Example: john12@gmail.com";
        errors.push(tmp);
        $("#errorEmail").html(tmp);
    }
    else
        $("#errorEmail").html("");

    if(!rePass.test(pass)){
        let tmp="Password is in wrong format - Example: m0nk3y (minimum 5 characters)";
        errors.push(tmp);
        $("#errorPass").html(tmp);
    }
    else
        $("#errorPass").html("");

    if(cpass!=pass){
        let tmp="Password and confrim password do not match";
        errors.push(tmp);
        $("#errorCpass").html(tmp);
    }
    else
        $("#errorCpass").html("");

    if(errors.length==0){
        test=true;
    }

    return test;

 }

