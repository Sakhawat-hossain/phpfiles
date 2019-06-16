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
                $name=$office=$street=$thana=$district=$postcode=$phoneno=$email="";
                $nameErr="";
            
                if(isset($_GET['addmanu'])){
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
                    <h2>Add new Manufacturers</h2>";

                    echo"<form method='get' action='addNewManufacturer.php'>
                    <div id='additionbox-of-manufacturers'>
                        Name   : <input type='text' name='name' value=$name><br>
                        <span class='error'>* $nameErr</span><br>
                        Office   : <input type='text' name='office' value=$office><br>
                        <span class='error'></span><br>
                        Street : <input type='text' name='street' value=$street><br>
                        <span class='error'></span><br>
                        Thana   : <input type='text' name='thana' value=$thana><br>
                        <span class='error'></span><br>
                        District : <input type='text' name='district' value=$district><br><span class='error'></span><br>
                        Post code : <input type='text' name='postcode' value=$postcode><br><span class='error'></span><br>
                        Phone no : <input type='text' name='phoneno' value=$phoneno><br><span class='error'></span><br>
                        Email : <input type='text' name='email' value=$email><br><span class='error'></span><br>
                        
                        <p class='error'>* Must be filled up</p>
                        <button type='submit' name='add' value='add'>Add</button> <br>
                    </div>
                    </form>";
                }
                elseif(isset($_GET['add'])){
                    
                    $name=test_input($_GET['name']);                    
                    $office=test_input($_GET['office']);                    
                    $street=test_input($_GET['street']);                    
                    $thana=test_input($_GET['thana']);                    
                    $district=test_input($_GET['district']);                    
                    $postcode=test_input($_GET['postcode']);                    
                    $phoneno=test_input($_GET['phoneno']);
                    $email=test_input($_GET['email']);
                    
                    $mgs="ok";
                    if($name==''){
                        $nameErr="Add name";
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
                        <h2>Add new Manufacturers</h2>";

                        echo"<form method='get' action='addNewManufacturer.php'>
                        <div id='additionbox-of-manufacturers'>
                            Name   : <input type='text' name='name' value=$name><br>
                            <span class='error'>* $nameErr</span><br>
                            Office   : <input type='text' name='office' value=$office><br>
                            <span class='error'></span><br>
                            Street : <input type='text' name='street' value=$street><br>
                            <span class='error'></span><br>
                            Thana   : <input type='text' name='thana' value=$thana><br>
                            <span class='error'></span><br>
                            District : <input type='text' name='district' value=$district><br><span class='error'></span><br>
                            Post code : <input type='text' name='postcode' value=$postcode><br><span class='error'></span><br>
                            Phone no : <input type='text' name='phoneno' value=$phoneno><br><span class='error'></span><br>
                            Email : <input type='text' name='email' value=$email><br><span class='error'></span><br>

                            <p class='error'>* Must be filled up</p>
                            <button type='submit' name='add' value='add'>Add</button> <br>
                        </div>
                        </form>";
                    }
                    else{
                        
                        $username=$_SESSION['username'];
                        
                        $conn=oci_connect("WSMS","wsms","//localhost/orcl");
                        
                        $query="SELECT GENERATE_ID('MANUFACTURER_ID','MANUFACTURERS') FROM DUAL";
                        $stid=oci_parse($conn,$query);
                        $r=oci_execute($stid);
                        
                        $manuId=0;
                        $row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
                        foreach($row as $orderId);
                            $manuId=$orderId;
                        
                        $query="INSERT INTO MANUFACTURERS VALUES(".$manuId.",'".$name."','". $office."','".$street."','".$thana."','".$district."','".$postcode."','".$phoneno."','".$email."')";
                
                        $stid=oci_parse($conn,$query);
                        $r=oci_execute($stid);
                        oci_commit($conn);
                        
                        
                        $name=$office=$street=$thana=$district=$postcode=$phoneno=$email=""; $nameErr='';                
                        
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
                        <h2>Add new Manufacturers</h2>";
                        
                        echo"<form method='get' action='addNewManufacturer.php'>
                        <div id='additionbox-of-manufacturers'>
                            Name   : <input type='text' name='name' value=$name><br>
                            <span class='error'>* $nameErr</span><br>
                            Office   : <input type='text' name='office' value=$office><br>
                            <span class='error'></span><br>
                            Street : <input type='text' name='street' value=$street><br>
                            <span class='error'></span><br>
                            Thana   : <input type='text' name='thana' value=$thana><br>
                            <span class='error'></span><br>
                            District : <input type='text' name='district' value=$district><br><span class='error'></span><br>
                            Post code : <input type='text' name='postcode' value=$postcode><br><span class='error'></span><br>
                            Phone no : <input type='text' name='phoneno' value=$phoneno><br><span class='error'></span><br>
                            Email : <input type='text' name='email' value=$email><br><span class='error'></span><br>

                            <p class='error'>* Must be filled up</p>
                            <button type='submit' name='add' value='add'>Add</button> <br>
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