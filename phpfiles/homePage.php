<?php session_start(); ?>
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
        <link rel="stylesheet" type="text/css" href="header-design.css">
        <link rel="stylesheet" type="text/css" href="homepage-grocerybox-design.css">
        <link rel="stylesheet" type="text/css" href="footer-design.css">
        
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
                   
        </style>
      
    </head>
    <body>
        <?php 
            $item=0;
            $item_list;
        
            //if(isset($_SESSION['id'])){
                if(isset($_GET['0']) && empty($_SESSION['id'])){
                    $_SESSION['id'][$item]=$_GET['0'];
                    $item = $item+1;
                }
                if(!empty($_SESSION['id'])){

                    $item=count($_SESSION['id']);

                    if(isset($_GET[$item])){
                        $_SESSION['id'][$item]=$_GET[$item];
                    }
                }
           // }
             
             function itemnumber($n){
                 $item_list[$item]=$n;
                 $item += 1;
                 echo $item_list[$item-1];
             }
            //&#xf002;&#x1F50D;
        ?>
        
        <!-- start header here -->
        <div id="headerbox">
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
                
                <a href="login.php">
                <button style="width:70px; height:30px;"> Login </button></a>
                <a href="createAccount.php">
                <button style="width:120px; height:30px;">Create Account</button></a>
                
            </div>    
             
            <div class="headerbottom">
                <a href="homePage.php">Home</a>
                <a href="#footerbox">Contact</a>
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
                    <form method="get" action="cartItemWithImage.php">
                         <p style="float:left; padding-top:10px;">Cart</p>
                         <input type="submit" id="circle" name="gotocart" style="color:black;text-align:center; font-size:20px;" value="<?php if(!empty($_SESSION['id'])){$item=count($_SESSION['id']);}echo $item; ?>">
                    </form>
                </div>
            </div>
            
        </div>
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
            <!-- for image show -->
            <div class="rightbox">
                <div class="imagebox">
                    <form method="get" action="details.php">
                        <button class="imageboxbutton1" type="submit" name="detail" value="53">Details</button>
                    </form>
                    <form method="get" action="homePage.php">
                        <button class="imageboxbutton2" type="submit" name="<?php echo $item ?>" value="53">Buy</button>
                    </form>
                    <div class="imageboxtop">
                        <img class="image" src="Images/Food-Grocery/cocacola_1250ml.jpeg"> 
                    </div>
                    <div class="imageboxbottom">
                        <p class="pbox">Coca Cola 1200ml</p>
                        <p style="color: #FF5733">65 Tk</p>
                    </div>  
                </div>
                <div class="imagebox">
                    <form method="get" action="details.php">
                        <button class="imageboxbutton1" type="submit" name="detail" value="32">Details</button>
                    </form>
                    <form method="get" action="homePage.php">
                        <button class="imageboxbutton2" type="submit" name="<?php echo $item ?>" value="32">Buy</button>
                    </form>
                    <div class="imageboxtop">
                        <img class="image" src="Images/Food-Grocery/pran-pran-up-pet-1000-ml.jpeg"> 
                    </div>
                    <div class="imageboxbottom">
                        <p class="pbox">Pran up 1000ml</p>
                        <p style="color: #FF5733">50 Tk</p>
                    </div>  
                </div>
                <div class="imagebox">
                    <form method="get" action="details.php">
                        <button class="imageboxbutton1" type="submit" name="detail" value="35">Details</button>
                    </form>
                    <form method="get" action="homePage.php">
                        <button class="imageboxbutton2" type="submit" name="<?php echo $item ?>" value="35">Buy</button>
                    </form>
                    <div class="imageboxtop">
                        <img class="image" src="Images/Food-Grocery/tango-orange-1000ml.jpeg"> 
                    </div>
                    <div class="imageboxbottom">
                        <p class="pbox">Tango orange 1000ml</p>
                        <p style="color: #FF5733">50 Tk</p>
                    </div>  
                </div>
                <div class="imagebox">
                    <form method="get" action="details.php">
                        <button class="imageboxbutton1" type="submit" name="detail" value="16">Details</button>
                    </form>
                    <form method="get" action="homePage.php">
                        <button class="imageboxbutton2" type="submit" name="<?php echo $item ?>" value="16">Buy</button>
                    </form>
                    <div class="imageboxtop">
                        <img class="image" src="Images/Food-Grocery/kazi-kazi-black-tea-80gm.jpeg"> 
                    </div>
                    <div class="imageboxbottom">
                        <p class="pbox">Kazi kazi black tea 80gm</p>
                        <p style="color: #FF5733">125 Tk</p>
                    </div>  
                </div>
                <div class="imagebox">
                    <form method="get" action="details.php">
                        <button class="imageboxbutton1" type="submit" name="detail" value="17">Details</button>
                    </form>
                    <form method="get" action="homePage.php">
                        <button class="imageboxbutton2" type="submit" name="<?php echo $item ?>" value="17">Buy</button>
                    </form>
                    <div class="imageboxtop">
                        <img class="image" src="Images/Food-Grocery/kazi-kazi-green-tea-60gm.jpeg"> 
                    </div>
                    <div class="imageboxbottom">
                        <p class="pbox">Kazi-kazi green tea 60gm</p>
                        <p style="color: #FF5733">140 Tk</p>
                    </div>  
                </div>
                <div class="imagebox">
                    <form method="get" action="details.php">
                        <button class="imageboxbutton1" type="submit" name="detail" value="37">Details</button>
                    </form>
                    <form method="get" action="homePage.php">
                        <button class="imageboxbutton2" type="submit" name="<?php echo $item ?>" value="37">Buy</button>
                    </form>
                    <div class="imageboxtop">
                        <img class="image" src="Images/Food-Grocery/olympic-lexus-biscuits-veg-crackers-240g.jpeg"> 
                    </div>
                    <div class="imageboxbottom">
                        <p class="pbox">Olympic lexus biscuits 240gm</p>
                        <p style="color: #FF5733">100 Tk</p>
                    </div>  
                </div>
                <div class="imagebox">
                    <form method="get" action="details.php">
                        <button class="imageboxbutton1" type="submit" name="detail" value="9">Details</button>
                    </form>
                    <form method="get" action="homePage.php">
                        <button class="imageboxbutton2" type="submit" name="<?php echo $item ?>" value="9">Buy</button>
                    </form>
                    <div class="imageboxtop">
                        <img class="image" src="Images/Food-Grocery/pran-all-time-ghee-toast-150gm.jpeg"> 
                    </div>
                    <div class="imageboxbottom">
                        <p class="pbox">Pran all time toast 150gm</p>
                        <p style="color: #FF5733">20 Tk</p>
                    </div>  
                </div>
                <div class="imagebox">
                    <form method="get" action="details.php">
                        <button class="imageboxbutton1" type="submit" name="detail" value="31">Details</button>
                    </form>
                    <form method="get" action="homePage.php">
                        <button class="imageboxbutton2" type="submit" name="<?php echo $item ?>" value="31">Buy</button>
                    </form>
                    <div class="imageboxtop">
                        <img class="image" src="Images/Food-Grocery/pran-up-500-ml.jpeg"> 
                    </div>
                    <div class="imageboxbottom">
                        <p class="pbox">Pran up 500ml</p>
                        <p style="color: #FF5733">30 Tk</p>
                    </div>  
                </div>
            </div>
        </div>
        
        <footer>
            <div id="footerbox">
                <p>About</p>
                <p>Contact</p>
            </div>
        </footer>
        
        <?php //session_destroy() ?>
        
    </body>
</html>
