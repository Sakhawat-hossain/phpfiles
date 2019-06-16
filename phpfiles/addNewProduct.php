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
        <div id="add-new-products-container">
            <?php
                $name=$size=$category=$price=$manuId=$imagename=$description="";
                $nameErr=$sizeErr=$priceErr=$manuIdErr="";
            
                if(isset($_GET['addproduct'])){
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
                    <h2>Add new product</h2>";
                    
                    echo"<form method='get' action='addNewProduct.php'>
                    <div id='additionbox'>
                        Name   : <input type='text' name='name' value=$name><br>
                        <span class='error'>* $nameErr</span><br>
                        Size   : <input type='text' name='size' value=$size><br>
                        <span class='error'>* $sizeErr</span><br>
                        Category : <input type='text' name='category' value=$category><br>
                        <span class='error'></span><br>
                        Price   : <input type='text' name='price' value=$price><br>
                        <span class='error'>* $priceErr</span><br>
                        Manufacturer ID : <input type='text' name='manuid' value=$manuId><br><span class='error'>* $manuIdErr</span><br>
                        Image name : <input type='text' name='imagename' value=$imagename><br><span class='error'></span><br>
                        Description : <input type='text' name='description' value=$description><br><span class='error'></span><br>
                        
                        <p class='error'>* Must be filled up</p>
                        <button type='submit' name='add' value='add'>Add</button> <br><br>
                    </div>
                    </form>";
                }
                elseif(isset($_GET['add'])){
                    
                    $name=test_input($_GET['name']);                    
                    $size=test_input($_GET['size']);                    
                    $category=test_input($_GET['category']);                    
                    $price=test_input($_GET['price']);                    
                    $manuId=test_input($_GET['manuid']);                    
                    $imagename=test_input($_GET['imagename']);                    
                    $description=test_input($_GET['description']);
                    
                    $mgs="ok";
                    if($name==''){
                        $nameErr="Add name";
                        $mgs="error";
                    }
                    if($size==''){
                        $sizeErr="Add size";
                        $mgs="error";
                    }
                    if($price==''){
                        $priceErr="Add price";
                        $mgs="error";
                    }
                    if($manuId==''){
                        $manuIdErr="Add manufacturer id";
                        $mgs="error";
                    }
                    $mgs_exist="ok";
                    if($mgs="ok"){
                        
                        $conn=oci_connect("WSMS","wsms","//localhost/orcl");
                        
                        $query="SELECT NAME FROM MANUFACTURERS WHERE MANUFACTURER_ID=$manuId";
                        $stid=oci_parse($conn,$query);
                        $r=oci_execute($stid);

                        $manu_name="";
                        
                        $row = oci_fetch_assoc($stid);
                            $manu_name=$row['NAME'];

                        if($manu_name==""){
                            $mgs_exist="no";
                            $mgs="checked";

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
                            </div>";
                            
                            echo"<div id='add-manufacturer-mgsbox'>
                                <form method='get' action='addNewManufacturer.php'>
                                    <p>Pleage first add the manufacturer </p>
                                    <button type='submit' name='addmanu'>Add manufacturer </button>
                                </form>
                            </div>";
                        }
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
                        <h2>Add new product</h2>";

                        echo"<form method='get' action='addNewProduct.php'>
                        <div id='additionbox'>
                            Name   : <input type='text' name='name' value=$name><br>
                            <span class='error'>* $nameErr</span><br>
                            Size   : <input type='text' name='size' value=$size><br>
                            <span class='error'>* $sizeErr</span><br>
                            Category : <input type='text' name='category' value=$category><br>
                            <span class='error'></span><br>
                            Price   : <input type='text' name='price' value=$price><br>
                            <span class='error'>* $priceErr</span><br>
                            Manufacturer ID : <input type='text' name='manuid' value=$manuId><br><span class='error'>* $manuIdErr</span><br>
                            Image name : <input type='text' name='imagename' value=$imagename><br><span class='error'></span><br>
                            Description : <input type='text' name='description' value=$description><br><span class='error'></span><br>

                            <p class='error'>* Must be filled up</p>
                            <button type='submit' name='add' value='add'>Add</button> <br><br>
                        </div>
                        </form>";
                    }
                    else if($mgs_exist == "ok"){
                        
                        $username=$_SESSION['username'];
                        
                        $conn=oci_connect("WSMS","wsms","//localhost/orcl");
                        
                        $query="SELECT GENERATE_ID('INVENTORY_ID','INVENTORY') FROM DUAL";
                        $stid=oci_parse($conn,$query);
                        $r=oci_execute($stid);
                        
                        $inventoryId=0;
                        $row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
                        foreach($row as $orderId)
                            $inventoryId=$orderId;
                        
                        $query="INSERT INTO INVENTORY VALUES(".$inventoryId.",'".$name."' ,'".$size."','".$category."',".$price.",0,".$manuId.",'".$imagename."','".$description."')";
                
                        $stid=oci_parse($conn,$query);
                        $r=oci_execute($stid);
                        oci_commit($conn);
                        
                        $name=$size=$category=$price=$manuId=$imagename=$description="";
                        $nameErr=$sizeErr=$priceErr=$manuIdErr="";
                        
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
                        <div id='messagebox'>
                            <h4>Successfully added</h4>
                        </div>
                        <h2>Add new product</h2>";
                        
                        echo"<form method='get' action='addNewProduct.php'>
                        <div id='additionbox'>
                            Name   : <input type='text' name='name' value=$name><br>
                            <span class='error'>* $nameErr</span><br>
                            Size   : <input type='text' name='size' value=$size><br>
                            <span class='error'>* $sizeErr</span><br>
                            Category : <input type='text' name='category' value=$category><br>
                            <span class='error'></span><br>
                            Price   : <input type='text' name='price' value=$price><br>
                            <span class='error'>* $priceErr</span><br>
                            Manufacturer ID : <input type='text' name='manuid' value=$manuId><br><span class='error'>* $manuIdErr</span><br>
                            Image name : <input type='text' name='imagename' value=$imagename><br><span class='error'></span><br>
                            Description : <input type='text' name='description' value=$description><br><span class='error'></span><br>

                            <p class='error'>* Must be filled up</p>
                            <button type='submit' name='add' value='add'>Add</button> <br><br>
                        </div>
                        </form>";
                    }
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