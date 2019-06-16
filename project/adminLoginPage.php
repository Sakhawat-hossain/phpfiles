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
        <link rel="stylesheet" type="text/css" href="css/header-design.css">
        <link rel="stylesheet" type="text/css" href="css/adminpage-design.css">
        <link rel="stylesheet" type="text/css" href="css/footer-design.css">
        
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
            #report-button-box{
                width: auto;
                height: auto;
                position: absolute;
                left: 10%;
                bottom: 10%;
            }
            #report-button-box  button{
                width: auto;
                height: 35px;
            }
        </style>
      
    </head>
    <body>
        <?php
        
            $username=$password="";
            $usernameErr="";
        //initial
            if(isset($_GET['login'])){
              
                echo'<div id="adminpage-container">
                    <h2>Admin Homepage</h2>
                    <h1>Wholesale Shop</h1>
                    
                    <div id="login-form-box">
                        <form method="post" action="adminLoginPage.php">
                            <input id="login-form-box-input" type="text" name="username" placeholder="username">
                            <input id="login-form-box-input" type="password" name="password" placeholder="password">
                            <input id="inputdesign-2" type="submit" name="submit" value="Submit">
                        </form>
                    </div>
                </div>';
            }//after log out
            elseif(isset($_GET['logout'])){
                 
                session_destroy();
                
                echo'<div id="adminpage-container">
                    <h2>Admin Homepage</h2>
                    <h1>Wholesale Shop</h1>
                    
                    <div id="login-form-box">
                        <form method="post" action="adminLoginPage.php">
                            <input id="login-form-box-input" type="text" name="username" placeholder="username">
                            <input id="login-form-box-input" type="password" name="password" placeholder="password">
                            <input id="inputdesign-2" type="submit" name="submit" value="Submit">
                        </form>
                    </div>
                </div>';
            }    /// after tring sign up
            elseif(isset($_POST['submit'])){
                
                $username=test_input($_POST['username']);
                $password=test_input($_POST['password']);
                $password=md5($password);
               
                //$conn=oci_connect("WSMS","wsms","//localhost/orcl");
                //$mgs='OK';  
               
               // $query="SELECT IS_ADMIN_EXIST('".$username."','".$password."') FROM DUAL ";
               
                //$stid=oci_parse($conn,$query);
               // $r=oci_execute($stid);
                    
                //$row=oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
                //foreach($row as $item);
                $item='';
                if($item=='NO'){
                    echo'<div id="adminpage-container">
                        <h2>Admin Homepage</h2>
                        <h1>Wholesale Shop</h1>

                        <div id="login-form-box">
                            <form method="post" action="adminLoginPage.php">
                                <input id="login-form-box-input" type="text" name="username" placeholder="username">
                                <input id="login-form-box-input" type="password" name="password" placeholder="password">
                                <input id="inputdesign-2" type="submit" name="submit" value="Submit">
                            </form>
                            <p id="errordesign">*Username or password error</p>
                        </div>
                    </div>';
                }
                else{   /// after successfully log in
                    $_SESSION['username']=$username;
                    
                    echo'<div id="adminpage-container">
                        <h2 style="left: 15%;top: 47%;">Admin Homepage</h2>
                        <h1 style="left: 10%;top: 7%;">Wholesale Shop</h1>';
                    echo "<div id='usernamebox'>
                            <p>Logged in as </p>
                            <button>$username</button>
                        </div>
                        <div id='logoutbox'>
                            <form method='get' action='adminLoginPage.php'>
                                <Button type='submit' name='logout'>Log out</button>
                            </form>
                        </div>";
                    ///  different action
                    echo'<div id="different-link-box">
                            <form method="get" action="transaction.php">
                                <Button type="submit" name="fromloginpage">Check orders</button>
                            </form>
                            <form method="get" action="addNewProduct.php">
                                <Button type="submit" name="addproduct">Add new Products</button>
                            </form>
                            <form method="get" action="addNewManufacturer.php">
                                <Button type="submit" name="addmanu">Add new Manufacturers</button>
                            </form>
                            <form method="get" action="addNewEmployee.php">
                                <Button type="submit" name="addemployee">Add new Employees</button>
                            </form>
                            <form method="get" action="addPurchaseInfo.php">
                                <Button type="submit" name="addpurchase">Add new purchases</button>
                            </form>
                            <form method="get" action="seeDueStatus.php">
                                <Button type="submit" name="due">See dues</button>
                            </form>
                        </div>
                        
                        <div id="report-button-box">
                            <form method="get" action="report.php">
                                <Button type="submit" name="report">Create report</button>
                            </form>
                        </div>
                    </div>';
                }
            }
            elseif(!empty($_SESSION['username'])){
                $username=$_SESSION['username'];
                  
                    echo'<div id="adminpage-container">
                        <h2 style="left: 15%;top: 47%;">Admin Homepage</h2>
                        <h1 style="left: 10%;top: 7%;">Wholesale Shop</h1>';
                    echo "<div id='usernamebox'>
                            <p>Logged in as </p>
                            <button>$username</button>
                        </div>
                        <div id='logoutbox'>
                            <form method='get' action='adminLoginPage.php'>
                                <Button type='submit' name='logout'>Log out</button>
                            </form>
                        </div>";
                    echo'<div id="different-link-box">
                            <form method="get" action="transaction.php">
                                <Button type="submit" name="fromloginpage">Check orders</button>
                            </form>
                            <form method="get" action="addNewProduct.php">
                                <Button type="submit" name="addproduct">Add new Products</button>
                            </form>
                            <form method="get" action="addNewManufacturer.php">
                                <Button type="submit" name="addmanu">Add new Manufacturers</button>
                            </form>
                            <form method="get" action="addNewEmployee.php">
                                <Button type="submit" name="addemployee">Add new Employees</button>
                            </form>
                            <form method="get" action="addPurchaseInfo.php">
                                <Button type="submit" name="addpurchase">Add new purchases</button>
                            </form>
                            <form method="get" action="seeDueStatus.php">
                                <Button type="submit" name="due">See dues</button>
                            </form>
                        </div>
                        
                        <div id="report-button-box">
                            <form method="get" action="report.php">
                                <Button type="submit" name="report">Create report</button>
                            </form>
                        </div>
                    </div>';
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