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
        <link rel="stylesheet" type="text/css" href="add-new-products-design.css">
        <link rel="stylesheet" type="text/css" href="footer-design.css">
        <link rel="stylesheet" type="text/css" href="additionbox-design.css">
        <link rel="stylesheet" type="text/css" href="add-purchase-design.css">
        
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
        <div id="add-new-purchases-container">
            <?php
                $inventoryId=$quatity=$employeeId=$price=$date="";
                $inventoryIdErr=$quatityErr=$employeeIdErr=$priceErr=$dateErr="";
            //initial
                if(isset($_GET['addpurchase'])){
                    $username=$_SESSION['username'];
                    echo "<div id='usernamebox'>
                        <p>Logged in as </p>
                        <button>$username</button>
                    </div>
                    <div id='logoutbox'>
                        <form method='get' action='adminLoginPage.php'>
                            <Button type='submit' name='logout'>Log out</button>
                        </form>
                    </div>
                    <div id='backbox'>
                        <a href='adminLoginPage.php'>
                            <Button type='submit' name='back'>Back</button>
                        </a>
                    </div>
                    <h2>Add Purchases History</h2>";
         
                    echo"<form method='get' action='addPurchaseInfo.php'>
                        <div id='product-namebox'>
                            <p>Add name of the product</p>
                            <input type='text' name='productname'>
                            <button type='submit' name='searchid'>Click</button>
                        </div>
                        <div id='search-product-to-purchase'>
                            <button type='submit' name='searchtopurchase'>Search products to purchase</button>
                        </div>
                    </form>";
                }/// confirm which roduct has been purchased
                elseif(isset($_GET['searchid'])){
                    
                    $username=$_SESSION['username'];
                    echo "<div id='usernamebox'>
                        <p>Logged in as </p>
                        <button>$username</button>
                    </div>
                    <div id='logoutbox'>
                        <form method='get' action='adminLoginPage.php'>
                            <Button type='submit' name='logout'>Log out</button>
                        </form>
                    </div>
                    <div id='backbox'>
                        <a href='adminLoginPage.php'>
                            <Button type='submit' name='back'>Back</button>
                        </a>
                    </div>
                    <h2>Add Purchases History</h2>";
                    
                    $conn=oci_connect("WSMS","wsms","//localhost/orcl");
                    
                    $name=test_input($_GET['productname']);
                    if($name==''){
                        echo"<form method='get' action='addPurchaseInfo.php'>
                            <div id='product-namebox'>
                                <p>Add name of the product</p>
                                <input type='text' name='productname'>
                                <button type='submit' name='searchid'>Click</button>
                            </div>
                            <div id='search-product-to-purchase'>
                                <button type='submit' name='searchtopurchase'>Search products to purchase</button>
                            </div>
                        </form>"; 
                    }
                    else{    
                        $query="SELECT INVENTORY_ID,NAME,PRODUCT_SIZE,CATEGORY, MANUFACTURER_ID FROM INVENTORY WHERE LOWER(NAME) LIKE LOWER('%".$name."%')";
                    
                        $stid=oci_parse($conn,$query);
                        $r=oci_execute($stid);
                        
                        $flag=0;
                        echo"<div id='purchase-table-container'>
                            <form method='get' action='addPurchaseInfo.php'>
                            <table id='dataTable'>";
                            echo "<th>Name</th> <th>Size</th> <th>Category</th> <th>Manu_Id</th> <th>Confirm</th>";
                            while($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
                                $flag=1;
                                $idx=0;
                                $id=0;
                                echo "<tr>";
                                foreach($row as $item){
                                    if($idx==0){
                                        $id=$item;
                                        $idx++;
                                    }
                                    else{
                                        echo"<td>$item</td>";
                                    }
                                }
                                echo"<td><button type='submit' name='purchased' value=$id>Purchased</button></td>
                                </tr>";
                            }
                        echo"</table></form>";
                        
                            if($flag==0){
                                echo"<form method='get' action='addNewProduct.php'>
                                    <div id='messagebox-of-purchase'>
                                        There is no product having this name.<br>
                                          Please insert this product in inventory.
                                        <button type='submit' name='addproduct'>Insert this product</button>
                                    </div>
                                </form>";
                            }
                        echo"</div>";
                    }
                }// add the purchased product history
                elseif(isset($_GET['purchased'])){
                    
                    $username=$_SESSION['username'];
                    echo "<div id='usernamebox'>
                        <p>Logged in as </p>
                        <button>$username</button>
                    </div>
                    <div id='logoutbox'>
                        <form method='get' action='adminLoginPage.php'>
                            <Button type='submit' name='logout'>Log out</button>
                        </form>
                    </div>
                    <div id='backbox'>
                        <a href='adminLoginPage.php'>
                            <Button type='submit' name='back'>Back</button>
                        </a>
                    </div>
                    <h2>Add Purchases History</h2>";
       
                    $inventoryId=test_input($_GET['purchased']);
                    
                    echo"<form method='get' action='addPurchaseInfo.php'>
                    <div id='additionbox-of-purchases'>
                        Inventory Id   : <input type='text' name='inventoryid' value=$inventoryId><br>
                        <span class='error'>** $inventoryIdErr</span><br>
                        Quantity   : <input type='text' name='quantity' value=$quatity><br>
                        <span class='error'>* $quatityErr</span><br>
                        Unit price   : <input type='text' name='price' value=$price><br>
                        <span class='error'>* $priceErr</span><br>
                        Employee ID : <input type='text' name='employeeid' value=$employeeId><br><span class='error'>* $employeeIdErr </span><br>
                        Purchase date : <input type='text' name='date' placeholder='dd-Mon-yy' value=$date><br><span class='error'>*$dateErr</span><br>
                        
                        <p class='error'>* Must be filled up</p>
                        <p class='error'>** Don't change</p>
                        <button type='submit' name='add' value='add'>Add</button> 
                    </div>
                    </form>";
                    
                }
                elseif(isset($_GET['add'])){
                      
                    $inventoryId=test_input($_GET['inventoryid']);                    
                    $quatity=test_input($_GET['quantity']);                    
                    $price=test_input($_GET['price']);                    
                    $employeeId=test_input($_GET['employeeid']);                    
                    $date=test_input($_GET['date']);   
                    
                    $mgs="ok";
                    if($inventoryId==''){
                        $inventoryIdErr="Confirm inventory Id";
                        $mgs="error";
                    }
                    if($quatity==''){
                        $quatityErr="Add purchased quantity";
                        $mgs="error";
                    }
                    if($price==''){
                        $priceErr="Add unit price";
                        $mgs="error";
                    }
                    if($employeeId==''){
                        $employeeIdErr="Add employee Id who purchased";
                        $mgs="error";
                    }
                    if($date==''){
                        $dateErr="Add purchased date";
                        $mgs="error";
                    }
                    if($mgs=="error"){
                        $username=$_SESSION['username'];
                        echo "<div id='usernamebox'>
                            <p>Logged in as </p>
                            <button>$username</button>
                        </div>
                        <div id='logoutbox'>
                            <form method='get' action='adminLoginPage.php'>
                                <Button type='submit' name='logout'>Log out</button>
                            </form>
                        </div>
                        <div id='backbox'>
                            <a href='adminLoginPage.php'>
                                <Button type='submit' name='back'>Back</button>
                            </a>
                        </div>
                        <h2>Add Purchases History</h2>";

                        echo"<form method='get' action='addPurchaseInfo.php'>
                        <div id='additionbox-of-purchases'>
                            Inventory Id   : <input type='text' name='inventoryid' value=$inventoryId><br>
                            <span class='error'>** $inventoryIdErr</span><br>
                            Quantity   : <input type='text' name='quantity' value=$quatity><br>
                            <span class='error'>* $quatityErr</span><br>
                            Unit price   : <input type='text' name='price' value=$price><br>
                            <span class='error'>* $priceErr</span><br>
                            Employee ID : <input type='text' name='employeeid' value=$employeeId><br><span class='error'>* $employeeIdErr </span><br>
                            Purchase date : <input type='text' name='date' placeholder='dd-Mon-yy' value=$date><br><span class='error'>*$dateErr</span><br>

                            <p class='error'>* Must be filled up</p>
                            <p class='error'>** Don't change</p>
                            <button type='submit' name='add' value='add'>Add</button> 
                        </div>
                        </form>";
                    
                    }
                    else{
                        
                        $username=$_SESSION['username'];
                        
                        $conn=oci_connect("WSMS","wsms","//localhost/orcl");
                        
                        $query="SELECT GENERATE_ID('PURCHASE_ID','PURCHASES') FROM DUAL";
                        $stid=oci_parse($conn,$query);
                        $r=oci_execute($stid);
                        
                        $purchaseId=0;
                        $row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
                        foreach($row as $orderId)
                            $purchaseId=$orderId;
                        
                        $query="INSERT INTO PURCHASES VALUES(".$purchaseId.", ".$inventoryId.",".$quatity.",".$price.",".$employeeId.",TO_DATE('".$date."','DD-MON-YY'))";
                
                        $stid=oci_parse($conn,$query);
                        $r=oci_execute($stid);
                        oci_commit($conn);
                        
                        $inventoryId=$quatity=$employeeId=$price=$date="";
                        $inventoryIdErr=$quatityErr=$employeeIdErr=$priceErr=$dateErr="";                
                        $username=$_SESSION['username'];
                        echo "<div id='usernamebox'>
                            <p>Logged in as </p>
                            <button>$username</button>
                        </div>
                        <div id='logoutbox'>
                            <form method='get' action='adminLoginPage.php'>
                                <Button type='submit' name='logout'>Log out</button>
                            </form>
                        </div>
                        <div id='backbox'>
                            <a href='adminLoginPage.php'>
                                <Button type='submit' name='back'>Back</button>
                            </a>
                        </div>
                        <h2>Add Purchases History</h2>
                        <div id='messagebox'>
                            <h4>Successfully added</h4>
                        </div>";

                        echo"<form method='get' action='addPurchaseInfo.php'>
                        <div id='additionbox-of-purchases'>
                            Inventory Id   : <input type='text' name='inventoryid' value=$inventoryId><br>
                            <span class='error'>** $inventoryIdErr</span><br>
                            Quantity   : <input type='text' name='quantity' value=$quatity><br>
                            <span class='error'>* $quatityErr</span><br>
                            Unit price   : <input type='text' name='price' value=$price><br>
                            <span class='error'>* $priceErr</span><br>
                            Employee ID : <input type='text' name='employeeid' value=$employeeId><br><span class='error'>* $employeeIdErr </span><br>
                            Purchase date : <input type='text' name='date' placeholder='dd-Mon-yy' value=$date><br><span class='error'>*$dateErr</span><br>

                            <p class='error'>* Must be filled up</p>
                            <p class='error'>** Don't change</p>
                            <button type='submit' name='add' value='add'>Add</button> 
                        </div>
                        </form>";
                    }
                } // search those product whict store quantity less than 1000
                elseif(isset($_GET['searchtopurchase'])){
                    
                    $username=$_SESSION['username'];
                    echo "<div id='usernamebox'>
                        <p>Logged in as </p>
                        <button>$username</button>
                    </div>
                    <div id='logoutbox'>
                        <form method='get' action='adminLoginPage.php'>
                            <Button type='submit' name='logout'>Log out</button>
                        </form>
                    </div>
                    <div id='backbox'>
                        <a href='adminLoginPage.php'>
                            <Button type='submit' name='back'>Back</button>
                        </a>
                    </div>
                    <h2>Add Purchases History</h2>";
                    
                    $conn=oci_connect("WSMS","wsms","//localhost/orcl");
                        
                        $query="SELECT INVENTORY_ID,NAME,PRODUCT_SIZE,CATEGORY, MANUFACTURER_ID FROM INVENTORY WHERE QUANTITY<1000";
                    
                        $stid=oci_parse($conn,$query);
                        $r=oci_execute($stid);
                        
                        $flag=0;
                        echo"<div id='purchase-table-container'>
                            <form method='get' action='addPurchaseInfo.php'>
                            <table id='dataTable'>";
                            echo "<th>InventoryId</th><th>Name</th> <th>Size</th> <th>Category</th> <th>Manu_Id</th>";
                            while($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
                                $flag=1;
                                $idx=0;
                                $id=0;
                                echo "<tr>";
                                foreach($row as $item){
                                    
                                        echo"<td>$item</td>";
                                    
                                }
                               // echo"<td><button type='submit' name='purchased' value=$id>Purchased</button></td>";
                                echo"</tr>";
                            }
                        echo"</table></form>";
                    
                            if($flag==1){
                                echo"<div id='purchase-table-container-mgs'>Contact to purchase these products</div>";
                            }
                        
                            if($flag==0){
                                echo"<form method='get' action='addNewProduct.php'>
                                    <div id='messagebox-of-purchase'>
                                        There is no product which stored quantity less than 1000.
                                    </div>
                                </form>";
                            }
                        echo"</div>";
                    }
                function test_input($data) {
                    $data = trim($data);
                    $data = stripslashes($data);
                    $data = htmlspecialchars($data);
                    return $data;
                }
            ?>
        </div>
    </body>
</html>