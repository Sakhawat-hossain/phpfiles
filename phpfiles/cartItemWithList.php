<?php session_start(); ?>

<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="header-design.css">
        <link rel="stylesheet" type="text/css" href="cartitem-with-list-design.css">
        <style>
            body{
                padding: 0;
                margin: 0;
            }
        </style>
	</head>
	<body>
        <!-- start header here // style sheet-  -->
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
            
            if(isset($_GET['addtocart'])){
                
                // Create connection to Oracle
                    $conn = oci_connect("WSMS", "wsms", "//localhost/orcl");
                if(isset($_GET['item_list'])){
                    print '<div class="container">';    
                    print '<form method="get" action="cartItemWithList.php">';
                    print '<table id="dataTable" border="1">';
        
                    $i=0;
                    echo "<th>Select</th> <th>Name</th> <th>Size</th> <th>Category</th> <th>Price</th> <th>Quantity</th>";

                    foreach($_GET['item_list'] as $id){

                        $id=test_input($id);
                        $query = "select NAME, PRODUCT_SIZE, CATEGORY, CURRENT_PRICE from INVENTORY where INVENTORY_ID=$id";

                        $stid = oci_parse($conn, $query);
                        $r = oci_execute($stid);
                        
                        $id=$id.",".$i;
                        print '<tr>';
                        echo "<td><input id='dcheckbox' type='checkbox' name='item_list[]'  value=$id checked></td>";

                        $row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
                        foreach ($row as $item) {
                            echo "<td>$item</td>";
                        }
                        echo "<td><input type='text' style='width:80px;margin-left:20px;' name=quantity[]></td>";

                        print '</tr>';
                         $i=$i+1;

                        oci_free_statement($stid);
                    }
                    print '</table>';

                    echo'<div class="containerbottom">
                        <button type="submit" name="buy" value="Buy">Buy</button>
                        <input type="text" name="username" placeholder="username" >
                        <input type="text" name="password" placeholder="password" >
                    </div>';    

                    print '</form>'; 
                    print '</div>';
                }
                else{
                    echo "<div id='empty'><p>Add item to the cart</p></div> ";
                }
                
                oci_close($conn); 
            } // from buy
            elseif(isset($_GET['buy'])){
                $rid=0;
                $mgs="ok";
                $userErr=$qtyErr='';
                $arrqty='';
                
                if(isset($_GET['quantity'])){
                    $arrqty=$_GET['quantity'];
                    
                    foreach($_GET['item_list'] as $idx){
                        $arr=explode(",",$idx);
                        $inventoryid=$arr[0];
                        $i=$arr[1];
                        $quantity=$arrqty[$i];
                        if($quantity==0){
                            $qtyErr="Add quantity of each product";
                            $mgs="error";
                        }
                    }
                }
                if(($_GET['username']=='') || ($_GET['password']=='')){
                    $userErr="Please sign up.";
                    $mgs="error";
                }
                else{
                    
                    $username=$_GET['username'];
                    $password=$_GET['password'];
                    $password=md5($password);
                    
                    $conn = oci_connect("WSMS", "wsms", "//localhost/orcl");
                    $query="select RETAILER_ID from RETAILERS where USERNAME='".$username."' AND PASSWORD='".$password."'";

                    $stid = oci_parse($conn, $query);
                    $r = oci_execute($stid);
                    
                    $row=oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
                    if(empty($row)){
                        $userErr="Wrong username or password";
                        $mgs="error";
                    }
                }
                if($mgs=="error"){
                
                    $conn = oci_connect("WSMS", "wsms", "//localhost/orcl");
                
                    print '<div class="container">';    
                    print '<form method="get" action="cartItemWithList.php">';
                    print '<table id="dataTable" border="1">';
        
                    $ii=0;
                    echo "<th>Select</th> <th>Name</th> <th>Size</th> <th>Category</th> <th>Price</th> <th>Quantity</th>";

                    foreach($_GET['item_list'] as $idx){

                        $arr=explode(",",$idx);
                        $inventoryid=$arr[0];
                        $i=$arr[1];
                        $quantity=$arrqty[$i];
                        
                        $query = "select NAME, PRODUCT_SIZE, CATEGORY, CURRENT_PRICE from INVENTORY where INVENTORY_ID=$inventoryid";

                        $stid = oci_parse($conn, $query);
                        $r = oci_execute($stid);
                        
                        $inventoryid=$inventoryid.",".$ii;
                        print '<tr>';
                        echo "<td><input id='dcheckbox' type='checkbox' name='item_list[]'  value=$inventoryid checked></td>";

                        $row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
                        foreach ($row as $item) {
                            echo "<td>$item</td>";
                        }
                        echo "<td><input type='text' style='width:80px;margin-left:20px;' name='quantity[]' value=$quantity></td>";

                        print '</tr>';
                         $ii=$ii+1;

                        oci_free_statement($stid);
                    }
                    print '</table>';

                    echo'<div class="containerbottom">
                        <button type="submit" name="buy" value="Buy">Buy</button>
                        <input type="text" name="username" placeholder="username" >
                        <input type="text" name="password" placeholder="password" >';
                    echo"<p id='error'>$userErr , $qtyErr </p>
                    </div>";    

                    print '</form>'; 
                    print '</div>';
                    
                    oci_close($conn);
                }
                else{
                    $conn = oci_connect("WSMS", "wsms", "//localhost/orcl");
                
                    print '<div class="container">';    
                    print '<form method="get" action="orderCompletePage.php">';
                    print '<table id="dataTable" border="1">';
        
                    $ii=0;
                    echo "<th>Select</th> <th>Name</th> <th>Size</th> <th>Category</th> <th>Price</th> <th>Quantity</th>";

                    foreach($_GET['item_list'] as $idx){

                        $arr=explode(",",$idx);
                        $inventoryid=$arr[0];
                        $i=$arr[1];
                        $quantity=$arrqty[$i];
                        
                        $query = "select NAME, PRODUCT_SIZE, CATEGORY, CURRENT_PRICE from INVENTORY where INVENTORY_ID=$inventoryid";

                        $stid = oci_parse($conn, $query);
                        $r = oci_execute($stid);
                        
                        print '<tr>';
                        echo "<td><input id='dcheckbox' type='checkbox' name='item_list[]'  value=$inventoryid checked></td>";

                        $row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
                        foreach ($row as $item) {
                            echo "<td>$item</td>";
                        }
                        echo "<td><input type='text' style='width:80px;margin-left:20px;' name='quantity[]' value=$quantity></td>";

                        print '</tr>';
                         $ii=$ii+1;

                        oci_free_statement($stid);
                    }
                    print '</table>';

                    echo'<div class="containerbottom">
                        <button type="submit" name="buyfromcartlist" value="Buy">Send</button>
                        ';    

                    print '</form>'; 
                    print '</div>';
                    
                    $_SESSION['username']=test_input($_GET['username']);
                    $pass=test_input($_GET['password']);
                    $_SESSION['password']=md5($pass);
                    
                    oci_close($conn);
                }
                 
            }
            else{
                echo "<div id='empty'><p>Add item to the cart</p></div> ";                
            }
            
            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
                       
        ?>
       
    </body>
</html>