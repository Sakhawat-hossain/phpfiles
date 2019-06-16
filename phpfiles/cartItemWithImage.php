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
        <link rel="stylesheet" type="text/css" href="cartitem-with-image-design.css">
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
            </div>
            
        </div>
        <!-- end header here -->
        
        <?php 
            $itemnum=0;
            $item_list;
            $conn=oci_connect("WSMS","wsms","//localhost/orcl");
        
            //send from cart icon
            if(isset($_GET['gotocart'])){
                if(!empty($_SESSION['id'])){

                    $itemnum=count($_SESSION['id']);

                    print '<form method="get" action="cartItemWithImage.php">
                    <div id="cartitem-with-image-quantity-container">';
                        for($i=0;$i<$itemnum;$i++){
                            if($_SESSION['id'][$i] != 9999){
                                $inventoryid=$_SESSION['id'][$i];
                                $query="SELECT IMAGE_NAME FROM INVENTORY WHERE INVENTORY_ID=".$inventoryid;
                
                                $stid=oci_parse($conn,$query);
                                $r=oci_execute($stid);
                                $row=oci_fetch_assoc($stid);
                                $imagename=$row['IMAGE_NAME'];
                                
                                print '<div id="cartitem-with-image-quantity">';
                                echo"<div id='cartitem-imagebox'>
                                    <img id='image-of-cart' src=$imagename>
                                </div>
                                <div id='cartitem-quantitybox'>
                                    <input type='text' name='quantity[]'>
                                </div>
                                <div id='cartitem-removebox'>
                                    <button type='submit' name='remove' value=$i>Remove</button>
                                </div>";
                                print'</div>';
                            }    
                        }
                        echo'<div id="containerbottom">
                            <div id="usernamebox">
                                <input type="text" name="username" placeholder="username" >
                                <input type="password" name="password" placeholder="password">
                            </div>
                            <div id="submitbox" >
                                <input type="submit" name="buy" value="Buy">
                            </div>
                        </div>';
                    print '</div>
                    </form>';
                }
                else{
                    echo "<div id='empty'><p>Add item to the cart</p></div> ";
                }
            }
           
            //after remove a item
            if(isset($_GET['remove'])){
                if(!empty($_SESSION['id'])){
    
                    $item=$_GET['remove'];
                    $_SESSION['id'][$item]=9999;

                    $arr=$_GET['quantity'];
                    
                    $itemnum=count($_SESSION['id']);
                    $flag=0;
                    for($i=0;$i<$itemnum;$i++){
                        if($_SESSION['id'][$i] != 9999){
                            $flag=1;
                        }
                    }
                    if($flag==1){
                        $idx=0;
                        print '<form method="get" action="cartItemWithImage.php">
                        <div id="cartitem-with-image-quantity-container">';
                        for($i=0;$i<$itemnum;$i++){
                            if($i==$item){
                                $idx++;
                            }
                            if($_SESSION['id'][$i] != 9999){
                                $inventoryid=$_SESSION['id'][$i];
                                $query="SELECT IMAGE_NAME FROM INVENTORY WHERE INVENTORY_ID=".$inventoryid;
                
                                $stid=oci_parse($conn,$query);
                                $r=oci_execute($stid);
                                $row=oci_fetch_assoc($stid);
                                $imagename=$row['IMAGE_NAME'];
                                
                                $qty=$arr[$idx];
                                $idx++;
                                print '<div id="cartitem-with-image-quantity">';
                                echo"<div id='cartitem-imagebox'>
                                    <img id='image-of-cart' src=$imagename>
                                </div>
                                <div id='cartitem-quantitybox'>
                                    <input type='text' name=quantity[] value=$qty>
                                </div>
                                <div id='cartitem-removebox'>
                                    <button type='submit' name='remove' value=$i> Remove</button>
                                </div>";
                                print'</div>';
                            }    
                        }
                        echo'<div id="containerbottom">
                            <div id="usernamebox">
                                <input type="text" name="username" placeholder="username" >
                                <input type="password" name="password" placeholder="password">
                            </div>
                            <div id="submitbox" >
                                <input type="submit" name="buy" value="Buy">
                            </div>
                        </div>';
                        print '</div>
                        </form>';
                    }
                    else{
                        session_unset($_SESSION['id']);
                        echo "<div id='empty'><p>Add item to the cart</p></div> ";
                    }
                }
                else{
                    echo "<div id='empty'><p>Add item to the cart</p></div> ";
                }
            }
        
            //when click buy
            if(isset($_GET['buy'])){
                if(!empty($_SESSION['id'])){
     
                    $arr=$_GET['quantity']; 
                    $itemnum=count($_SESSION['id']);
                    $username=$_GET['username'];
                    $password=$_GET['password'];
                    $idx=0;
                    $password=md5($password);
                    
                    $query="SELECT IS_USER_EXIST('".$username."','".$password."') FROM DUAL ";
                    
                    $stid=oci_parse($conn,$query);
                    $r=oci_execute($stid);

                    $row=oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
                    
                    $item="";
                    foreach($row as $item);

                    
                    $flag=0;
                    for($i=0;$i<count($arr);$i++){
                        $data=$arr[$i];
                        
                        if($data == 0){
                            $flag=1;
                        }
                    }
                    $usererror="";
                    if($item=='NO') $usererror="*Username or password error";
                    
                    if($item=='NO' || $flag==1){
                        print '<form method="get" action="cartItemWithImage.php">
                        <div id="cartitem-with-image-quantity-container">';
                        for($i=0;$i<$itemnum;$i++){
                            if($_SESSION['id'][$i] != 9999){
                                $inventoryid=$_SESSION['id'][$i];
                                $query="SELECT IMAGE_NAME FROM INVENTORY WHERE INVENTORY_ID=".$inventoryid;
                
                                $stid=oci_parse($conn,$query);
                                $r=oci_execute($stid);
                                $row=oci_fetch_assoc($stid);
                                $imagename=$row['IMAGE_NAME'];
                                
                                $qty=$arr[$idx];
                                $msg="";
                                if($qty==0) $msg="*add quantity or remove";
                                $idx++;
                                print '<div id="cartitem-with-image-quantity">';
                                echo"<div id='cartitem-imagebox'>
                                    <img id='image-of-cart' src=$imagename>
                                </div>
                                <div id='cartitem-quantitybox'>
                                    <input type='text' name=quantity[] value=$qty>
                                    <p>$msg</P>
                                </div>
                                <div id='cartitem-removebox'>
                                    <button type='submit' name='remove' value=$i> Remove</button>
                                </div>";
                                print'</div>';
                            }    
                        }
                        echo'<div id="containerbottom">
                            <div id="usernamebox">
                                <input type="text" name="username" placeholder="username"'; 
                                echo "value=$username>";
                                echo'<input type="password" name="password" placeholder="password">';
                                echo "<p>$usererror</p>
                            </div>";
                            echo '<div id="submitbox" >
                                <input type="submit" name="buy" value="Buy">
                            </div>
                        </div>';
                        print '</div>
                        </form>';
                    }            ///when all okey
                    elseif($item=='YES'){
                        $_SESSION['username']=$username;
                        $_SESSION['password']=$password;
                        print '<form method="get" action="orderCompletePage.php">
                        <div id="cartitem-with-image-quantity-container">';
                        for($i=0;$i<$itemnum;$i++){
                            if($_SESSION['id'][$i] != 9999){
                                $inventoryid=$_SESSION['id'][$i];
                                $query="SELECT QUANTITY,IMAGE_NAME FROM INVENTORY WHERE INVENTORY_ID=".$inventoryid;
                
                                $stid=oci_parse($conn,$query);
                                $r=oci_execute($stid);
                                
                                $row=oci_fetch_assoc($stid);
                                $imagename=$row['IMAGE_NAME'];
                                $quantity=$row['QUANTITY'];
                                
                                $qty=$arr[$idx];
                                $_SESSION['inventoryid'][$idx]=$_SESSION['id'][$i];
                                $idx++;
                                
                                $mgs="";
                                if($qty > $quantity){
                                    $mgs="*You can't order more than it";
                                    $qty=$quantity;
                                }
                                
                                print '<div id="cartitem-with-image-quantity">';
                                echo"<div id='cartitem-imagebox'>
                                    <img id='image-of-cart' src=$imagename>
                                </div>
                                <div id='cartitem-quantitybox'>
                                    <input type='text' name=quantity[] value=$qty>
                                    <p>$mgs</p>
                                </div>
                                <div id='cartitem-removebox'>
                                    <input type='button' name='remove' value=Back to remove>
                                </div>";
                                print'</div>';
                            }    
                        }
                        echo'<div id="containerbottom">
                            <div id="usernamebox">
                            </div>
                            <div id="submitbox" >
                                <input type="submit" name="send" value="Send">
                            </div>
                        </div>';
                        print '</div>
                        </form>';
                    }
                    else{
                        echo "<div id='empty'><p>Add item to the cart</p></div> ";
                    }
                }
            }
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            //&#xf002;&#x1F50D;
        ?>
    </body>
</html>