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
            #completebox{
                width: 100%;
                height: 80%;
                position: relative;
                background-color: aqua;
            }
            #completebox h3{
                position: absolute;
                left: 10%;
                top: 10%;
            }
            #completebox h2{
                position: absolute;
                left: 20%;
                top: 40%;
            }
            #completebox button{
                border: none;
                width: 200px;
                height: 35px;
                font-size: 20px;
                text-align: center;
                position: absolute;
                background-color: #FF8A80;
                left: 60%;
                top: 60%;
            }
                   
        </style>
      
    </head>
    <body>
        
        <!-- start header here -->
        <div id="headerbox">
            <div class="headertop">
                <h2> Wholesale Shop </h2>
                
                <div class="searchbox" style="margin-right:20%;">
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
            $item=0;
        
            if(isset($_GET['send'])){
                
                $conn=oci_connect("WSMS","wsms","//localhost/orcl");

                $username=$_SESSION['username'];
                $password=$_SESSION['password'];
                
                //$retailer_id;
                $query='BEGIN GET_RETAILER_ID(:user,:pass,:id); END;';
                
                $stid=oci_parse($conn,$query);
                
                oci_bind_by_name($stid,':user',$username);
                oci_bind_by_name($stid,':pass',$password);
                oci_bind_by_name($stid,':id',$retailer_id);
                
                oci_execute($stid);
                
                //order_id
                $query="SELECT NVL(MAX(ORDER_ID),0) FROM ORDERS";
                $stid=oci_parse($conn,$query);
                oci_execute($stid);
                
                $row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
                $orderId=0;
                foreach($row as $Id){
                    $orderId=$Id;
                }
                $orderId++;
                
                //insert into orders
                $query="INSERT INTO ORDERS VALUES($orderId,$retailer_id, 'due',TO_DATE(SYSDATE,'DD-MON-YY'),'','','pendding')";
                $stid=oci_parse($conn,$query);
                oci_execute($stid);
                oci_commit($conn);
                
                //insert into ordered_products
                $arr=$_GET['quantity']; 
                $itemnum=count($_SESSION['inventoryid']);
                
                for($i=0;$i<$itemnum;$i++){
                    $inventoryId=$_SESSION['inventoryid'][$i];
                    $quantity=$arr[$i];
                    $query="INSERT INTO ORDERED_PRODUCTS VALUES($orderId,$inventoryId,$quantity)";
                    $stid=oci_parse($conn,$query);
                    oci_execute($stid);
                }
                oci_commit($conn);
                session_destroy();
            }
            elseif(isset($_GET['buyfromcartlist'])){
                
                $conn=oci_connect("WSMS","wsms","//localhost/orcl");

                $username=$_SESSION['username'];
                $password=$_SESSION['password'];
                
                //$retailer_id;
                $query='BEGIN GET_RETAILER_ID(:user,:pass,:id); END;';
                
                $stid=oci_parse($conn,$query);
                
                oci_bind_by_name($stid,':user',$username);
                oci_bind_by_name($stid,':pass',$password);
                oci_bind_by_name($stid,':id',$retailer_id);
                
                oci_execute($stid);
                
                //order_id
                $query="SELECT MAX(ORDER_ID) FROM ORDERS";
                $stid=oci_parse($conn,$query);
                oci_execute($stid);
                
                $row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
                $orderId=0;
                foreach($row as $orderId) $orderId=$orderId;
                $orderId++;
                
                //insert into orders
                $query="INSERT INTO ORDERS VALUES($orderId,$retailer_id, 'due',TO_DATE(SYSDATE,'DD-MON-YY'),'','','pendding')";
                $stid=oci_parse($conn,$query);
                oci_execute($stid);
                oci_commit($conn);
                
                //insert into ordered_products
                $arr=$_GET['quantity']; 
                
                $i=0;
                foreach($_GET['item_list'] as $inventoryId){
                    $quantity=$arr[$i];
                    $query="INSERT INTO ORDERED_PRODUCTS VALUES($orderId,$inventoryId,$quantity)";
                    $stid=oci_parse($conn,$query);
                    oci_execute($stid);
                    $i++;
                }
                oci_commit($conn);
                
                session_destroy();
            }
            
             function itemnumber($n){
                 $item_list[$item]=$n;
                 $item += 1;
                 //echo $item_list[$item-1];
             }
            //&#xf002;&#x1F50D;
        ?>
        <div id="completebox">
            <h3>Your order have been completed...</h3>
            <h2>Thank you for giving order</h2>
            <a href="homePage.php">
            <button>Go to Home</button></a>
        </div>
        <footer style="margin-top:0px">
            <div id="footerbox" style="margin-top:0px">
                <p>About</p>
                <p>Contact</p>
            </div>
        </footer>
    </body>
</html>