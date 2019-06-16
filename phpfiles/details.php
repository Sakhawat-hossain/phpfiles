<?php session_start();?>
<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="header-design.css">
        <link rel="stylesheet" type="text/css" href="footer-design.css">
        <link rel="stylesheet" type="text/css" href="details-design.css">
      
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
            $imagename=$description="";
            $name=$weight=$category=$price=$brand="";
            $product_id=0;
            $item=0;
        
            if(isset($_GET['0']) && empty($_SESSION['id'])){
                $_SESSION['id'][$item]=$_GET['0'];
                $item = $item+1;
                
                $product_id=$_GET['0'];
                
                $conn=oci_connect("WSMS","wsms","//localhost/orcl");
                $query="SELECT PRODUCT_SIZE,CATEGORY,CURRENT_PRICE, IMAGE_NAME,DESCRIPTION FROM INVENTORY WHERE INVENTORY_ID='".$product_id."'";
                
                $stid=oci_parse($conn,$query);
                $r=oci_execute($stid);
                
                while($row=oci_fetch_assoc($stid)){
                    $weight=$row['PRODUCT_SIZE'];
                    $category=$row['CATEGORY'];
                    $price=$row['CURRENT_PRICE'];
                    $imagename=$row['IMAGE_NAME'];
                    $description=$row['DESCRIPTION'];
                    
                   /* echo $row['IMAGE_NAME'];
                    if(empty($row['DESCRIPTION'])){
                        echo " empty  ";
                    }*/
                }
                if($description !=''){
                    $array=explode(",",$description);
                    $name=$array[0];
                    $brand=$array[1];
                }

            }
            if(!empty($_SESSION['id'])){

                $item=count($_SESSION['id']);

                if(isset($_GET[$item])){
                    $_SESSION['id'][$item]=$_GET[$item];
                    
                    $product_id=$_GET[$item];
                
                    $conn=oci_connect("WSMS","wsms","//localhost/orcl");
                    $query="SELECT PRODUCT_SIZE,CATEGORY,CURRENT_PRICE, IMAGE_NAME,DESCRIPTION FROM INVENTORY WHERE INVENTORY_ID='".$product_id."'";

                    $stid=oci_parse($conn,$query);
                    $r=oci_execute($stid);

                    while($row=oci_fetch_assoc($stid)){
                        $weight=$row['PRODUCT_SIZE'];
                        $category=$row['CATEGORY'];
                        $price=$row['CURRENT_PRICE'];
                        $imagename=$row['IMAGE_NAME'];
                        $description=$row['DESCRIPTION'];

                       /* echo $row['IMAGE_NAME'];
                        if(empty($row['DESCRIPTION'])){
                            echo " empty  ";
                        }*/
                    }
                    if($description !=''){
                        $array=explode(",",$description);
                        $name=$array[0];
                        $brand=$array[1];
                    }

                }
            }
        
            if(isset($_GET['detail'])){
                
                $product_id=$_GET['detail'];
                
                $conn=oci_connect("WSMS","wsms","//localhost/orcl");
                $query="SELECT PRODUCT_SIZE,CATEGORY,CURRENT_PRICE, IMAGE_NAME,DESCRIPTION FROM INVENTORY WHERE INVENTORY_ID='".$product_id."'";
                
                $stid=oci_parse($conn,$query);
                $r=oci_execute($stid);
                
                while($row=oci_fetch_assoc($stid)){
                    $weight=$row['PRODUCT_SIZE'];
                    $category=$row['CATEGORY'];
                    $price=$row['CURRENT_PRICE'];
                    $imagename=$row['IMAGE_NAME'];
                    $description=$row['DESCRIPTION'];
                    
                   /* echo $row['IMAGE_NAME'];
                    if(empty($row['DESCRIPTION'])){
                        echo " empty  ";
                    }*/
                }
                if($description !=''){
                    $array=explode(",",$description);
                    $name=$array[0];
                    $brand=$array[1];
                }
            }
            function test_input($data) {
                $data = trim($data);
                return $data;
            }
        
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
    
        <!-- image and description -->
        <div id="imagedescriptionbox">
            <div id="imagebox">
                <img id="image" src="<?php echo $imagename; ?>" alt="Image">
            </div>
            <div id="descriptionbox">
                <div id="namebox">
                     <h3 style="padding-top: 20px;"><?php echo $name; ?> </h3>
                </div>
                <div id="otherdescription">
                    <h3>Net weight : </h3>
                     <p><?php echo $weight; ?></p>
                </div>
                <div id="otherdescription">
                    <h3>Category : </h3> 
                    <p><?php echo $category; ?></p>
                </div>
                <div id="otherdescription">
                    <h3>Price : </h3> 
                    <p><?php echo $price; ?> Tk.</p>
                </div>
                <div id="otherdescription">
                     <h3>Brand : </h3>
                     <p><?php echo $brand; ?></p>
                </div>
                <div id="otherdescription">
                    <form method="get" action="details.php">
                        <div id="quantitybox">
                            <p>Quantity :   </p> 
                            <input type="text" name="quantity" value="<?php $quantity;?>">
                        </div>
                        <div id="buybox">
                            <button type="submit" name="<?php echo $item;?>" value="<?php echo $product_id;?>"> Buy</button>
                        </div>
                    </form>
                </div>
                <div id="otherdescription">
                    <div id="reviewbox">
                        <form method="get" action="reviewpage.php">
                             <button type="submit" name="review" value="<?php echo $product_id;?>">Be the first to review this product</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>  
        <!-- end image and description -->
    
        <!-- start footer  -->
        <footer>
            <div id="footerbox">
                <p>About</p>
                <p>Contact</p>
            </div>
        </footer> 
    </body>
</html>
        