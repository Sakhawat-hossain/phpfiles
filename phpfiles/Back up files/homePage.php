<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="header.css">
      
        <style>
            * {
                margin: 0;
                padding: 0;
            }
            html,body{
                height: 100%;
                width: 100%;
                margin: 0;
                padding: 0;
            }
            
            header{
                background-color: #808080;
                width: 100%;
                height: 110px;
                
            }
            .headertop{
                width: 100%;
                height: 60px;
                display: inline-flex;
            }
            h2{
                text-align: left;
                margin: auto;
            }
            .searchbox{
                height: 42px;
                width: 500px;
                margin-top: 10px;
            }
            .searchbox form{
                font-size: 30px;
                border: 1px chocolate solid;
                margin-right: 50px;
                height: inherit;
                transition: 0.6s ease;
                border-radius: 5px 5px 5px 5px;
                display: flex;
            }
            .searchbox form input{
                height: 40px;
                width: 300px;
                margin: 0;
                border: 1px white solid;
                padding-left: 10px;
            }
            .searchbox form button{
                height: inherit;
                min-width: 50px;
                max-width: 50px;
                margin: 0;
                transition: 0.6s ease;
                border-radius: 0 5px 5px 0;
                border: 1px chocolate solid;
                background-color: chocolate;
            }
            #selectbox{
                height: inherit;
                width: auto;
                margin: 0;
                transition: 0.6s ease;
                border-radius: 5px 0 0 5px;
                background-color: darkgrey;
            }
            
            select{
                height: inherit;
                width: 120px;
                margin: 0;
                transition: 0.6s ease;
                border-radius: 5px 0 0 5px;
                
            }
            select:selected {background-color: dimgrey;}
            
.headerbottom{
    width: inherit;
    height: 50px;
    overflow: hidden;
    font-family: Arial;
}

.headerbottom a {
    float: left;
    font-size: 20px;
    color: white;
    text-align: center;
    padding: 12px 15px;
    margin-top: 2px;
    margin-left: 2px;
    text-decoration: none;
}

.dropdown {
    float: left;
    overflow: hidden;
    margin-top: 2px;
}

.dropdown .dropbtn {
    font-size: 20px;    
    border: none;
    outline: none;
    color: white;
    padding: 12px 15px;
    background-color: inherit;
}

.headerbottom a:hover, .dropdown:hover .dropbtn {
    background-color: red;
}

.dropdown-content {
    display: none;
    position: absolute;
    background-color: #f9f9f9;
    min-width: 160px;
    box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
    z-index: 1;
}
.content{
    display: inline-block;
    position: relative;
    overflow: hidden;
}           
.dropdown-content-1 {
    height: inherit;
    width: auto;
    float: left;
    border-right: 1px #D7CCC8 solid;
    border-top: 2px #263238 solid;
}
.dropdown-content-2 {
    height: inherit;
    width: auto;
    float: left;
    border-top: 2px #263238 solid;
}
.dropdown-content-1 p,.dropdown-content-2 p{
    padding-left: 30px;
    padding-top: 30px;
    color: black;
}
.dropdown-content a {
    float: none;
    color: black;
    padding: 7px 30px;
    text-decoration: none;
    display: block;
    text-align: left;
}

.dropdown-content a:hover {
    background-color: #ddd;
}

.dropdown:hover .dropdown-content {
    display: block;
}
.cartitem{
    position: absolute;
    text-align: center;
    color: white;
    right: 80px;
    display: inline-block;
}
#circle {
	width: 40px;
	height: 40px;
	background: red;
    border: none;
	-moz-border-radius: 20px;
	-webkit-border-radius: 20px;
	border-radius: 20px 20px,20px,20px;
    float: left;
    margin-left: 10px;
}            
            .foodgrocerybox{
                width: 92%;
                height: 500px;
                margin-left: 4%;
                margin-top: 25px;
                margin-bottom: 25px;
            }  
            .leftbox{
                width: 20%;
                height: 100%;
                float: left;
                border: 1px #D7CCC8 solid ;
            }
            .leftbox button{
                width: 100%;
                height: 50px;
                background-color: black;
                border: none;
                color: white;
                font-size: 20px;
            }
            .leftinnerbox{
                width: 100%;
                height: auto;
                margin-top: 15px;
                color: black;
            }
            .leftinnerbox a {
                float: none;
                color: black;
                padding: 7px 30px;
                text-decoration: none;
                display: block;
                text-align: left;
            }

            .leftinnerbox a:hover {
                background-color: #ddd;
}
            .rightbox{
                width: 79%;
                height: 100%;
                float: left;
            }
            .imagebox{
                width: 24.60%;
                height: 50%;
                border: 1px #D7CCC8 solid;
                float: left;
                text-align: center;
            }
            .image{
                width: 90%;
                height: 70%;
            }
            .imagebox p{
                padding-top: 8px;
            }
            .image:hover{
                width:  95%;
                height: 75%;
            }
        </style>
      
    </head>
    <body>
        <?php 
             
            if(isset($_POST['submit'])){
               
                if($_POST["submit"]=="Login"){
                    header("Location: login.php");
                    exit();
                }
                elseif ($_POST["submit"]=="Create account") {
                    header("Location: createAccount.php");
                    exit();
                }
            }
            //&#xf002;&#x1F50D;
        ?>
        
        <!-- start header here -->
        <header>
            <div class="headertop">
                <h2> Wholesale Shop </h2>
                
                <div class="searchbox">
                    <form method="get" action="inventory.php">
                        <div id="selectbox">
                            
                            <select name="category" style="display:block" >
                                <option value="all">All</option>
                                <option value="Soft drink">Soft drink</option>
                                <option value="Drinking water">Drinking water</option>
                                <option value="Mustard oi">Mustard oi</option>
                                <option value="Bread">Bread</option>
                                <option value="Biscuit">Biscuit</option>
                                <option value="very large text">Very very large text</option>
                            </select>
                        </div>

                        <input type="text" name="item" />

                        <button type="submit" name="send" value="send"><i class="fa fa-search" style="font-size:25px;color:white;"></i></button>
                        
                    </form>
                </div>
                
                <form method="POST" style="padding-right: 30px;padding-bottom: 10px;padding-top: 10px;" action="<?php htmlspecialchars($_SERVER["PHP_SELF"]); ?>" >
                    <input type="submit" name="submit" style="width:70px; height:30px;" value="Login"/>
                    <input type="submit" name="submit" style="width:120px; height:30px;" value="Create account" />
                </form>
            </div>    
             
            <div class="headerbottom">
                <a href="#header">Home</a>
                <a href="#footer">Contact</a>
                <div class="dropdown">
                    <button class="dropbtn">Food & Grocery 
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <div class="content">
                            <div class="dropdown-content-1">
                                <p><b>Bevarage</b></p>
                                <a href="#">Juice</a>
                                <a href="#">Soft drink</a>
                                <a href="#">Mineral water</a>
                                <a href="#">Tea & Coffee</a>
                            </div>
                            <div class="dropdown-content-2">
                                <p><b>Bevarage</b></p>
                                <a href="#">Juice</a>
                                <a href="#">Soft drink</a>
                                <a href="#">Mineral water</a>
                                <a href="#">Tea & Coffee</a>
                            </div>
                            <div class="dropdown-content-2">
                                <p><b>Bevarage</b></p>
                                <a href="#">Juice</a>
                                <a href="#">Soft drink</a>
                                <a href="#">Mineral water</a>
                                <a href="#">Tea & Coffee</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="dropdown">
                    <button class="dropbtn">Electronics 
                        <i class="fa fa-caret-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <a href="#">Link 1</a>
                        <a href="#">Link 2</a>
                        <a href="#">Link 3</a>
                    </div>
                </div>
                <div class="cartitem">
                    <form>
                         <p style="float:left; padding-top:10px;">Cart</p>
                         <input type="text" id="circle">
                    </form>
                </div>
            </div>
            
        </header>
        <!-- end header here -->
        
        <!-- start here -->
        <div class="foodgrocerybox">
            <div class="leftbox">
                <button onclick="gopage()">Food & Grocery
                <i class="fa fa-caret-right"></i></button>
                <div class="leftinnerbox">
                    <a href="#">Juice</a>
                    <a href="#">Soft drink</a>
                    <a href="#">Mineral water</a>
                    <a href="#">Tea & Coffee</a>
                </div>
            </div>
            <div class="rightbox">
                <div class="imagebox">
                    <img class="image" src="Images/Food-Grocery/cocacola_1250ml.jpeg"> 
                    <p>Coca Cola 1200ml</p>
                    <p>65 Tk</p>
                </div>
                <div class="imagebox">
                    <img class="image" src="Images/Food-Grocery/pran-pran-up-pet-1000-ml.jpeg"> 
                    <p>Coca Cola 1200ml</p>
                    <p>65 Tk</p>
                </div>
                <div class="imagebox">
                    <img class="image" src="Images/Food-Grocery/tango-orange-1000ml.jpeg"> 
                    <p>Coca Cola 1200ml</p>
                    <p>65 Tk</p>
                </div>
                <div class="imagebox">
                    <img class="image" src="Images/Food-Grocery/kazi-kazi-black-tea-80gm.jpeg"> 
                    <p>Coca Cola 1200ml</p>
                    <p>65 Tk</p>
                </div>
                <div class="imagebox">
                    <img class="image" src="Images/Food-Grocery/kazi-kazi-green-tea-60gm.jpeg"> 
                    <p>Coca Cola 1200ml</p>
                    <p>65 Tk</p>
                </div>
                <div class="imagebox">
                    <img class="image" src="Images/Food-Grocery/olympic-lexus-biscuits-veg-crackers-240g.jpeg"> 
                    <p>Coca Cola 1200ml</p>
                    <p>65 Tk</p>
                </div>
                <div class="imagebox">
                    <img class="image" src="Images/Food-Grocery/pran-all-time-ghee-toast-150gm.jpeg"> 
                    <p>Coca Cola 1200ml</p>
                    <p>65 Tk</p>
                </div>
                <div class="imagebox">
                    <img class="image" src="Images/Food-Grocery/pran-up-500-ml.jpeg"> 
                    <p>Coca Cola 1200ml </p>
                    <p>65 Tk</p>
                </div>
            </div>
        </div>
        
    </body>
</html>
