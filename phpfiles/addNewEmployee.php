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
                $fname=$lname=$designation=$street=$city=$salary=$hiredate= $phoneno=$managerId="";
                $lnameErr=$fnameErr=$designationErr=$salaryErr="";
            
                if(isset($_GET['addemployee'])){
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
                    <h2>Add new Employees</h2>";
         
                    // design same as manufacturers
                    echo"<form method='get' action='addNewEmployee.php'>
                    <div id='additionbox-of-manufacturers'>
                        First Name   : <input type='text' name='fname' value=$fname><br>
                        <span class='error'>* $fnameErr</span><br>
                        Last Name   : <input type='text' name='lname' value=$lname><br>
                        <span class='error'>* $lnameErr</span><br>
                        Designation   : <input type='text' name='designation' value=$designation><br>
                        <span class='error'>* $designationErr</span><br>
                        Street : <input type='text' name='street' value=$street><br>
                        <span class='error'></span><br>
                        City : <input type='text' name='city' value=$city><br><span class='error'></span><br>
                        Salary : <input type='text' name='salary' value=$salary><br><span class='error'>* $salaryErr</span><br>
                        Hire Date : <input type='text' name='hiredate' placeholder='DD-MON-YY' value=$hiredate><br><span class='error'></span><br>
                        Phone no : <input type='text' name='phoneno' value=$phoneno><br><span class='error'></span><br>
                        <div id='selectbox-of-employee'>
                            <select name='managerid' style='display:block' >
                                <option value='manager'>Add manager</option>
                                <option value='100'>Sakhawat Hossain</option>
                                <option value='103'>Mosaddek Islam</option>
                            </select>
                        </div>
                        <p class='error'>* Must be filled up</p>
                        <button type='submit' name='add' value='add'>Add</button> <br>
                    </div>
                    </form>";
                }
                elseif(isset($_GET['add'])){
                      
                    $fname=test_input($_GET['fname']);                    
                    $lname=test_input($_GET['lname']);                    
                    $designation=test_input($_GET['designation']);                    
                    $street=test_input($_GET['street']);                    
                    $city=test_input($_GET['city']);                             
                    $salary=test_input($_GET['salary']); 
                    $hiredate=test_input($_GET['hiredate']);                   
                    $phoneno=test_input($_GET['phoneno']);
                    $managerId=$_GET['managerid'];
                    
                    $mgs="ok";
                    if($fname==''){
                        $fnameErr="Add first name";
                        $mgs="error";
                    }
                    if($lname==''){
                        $lnameErr="Add last name";
                        $mgs="error";
                    }
                    if($designation==''){
                        $designationErr="Add designation";
                        $mgs="error";
                    }
                    if($salary==''){
                        $salaryErr="Add salary";
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
                        <h2>Add new Employees</h2>";

                        // design same as manufacturers
                        echo"<form method='get' action='addNewEmployee.php'>
                        <div id='additionbox-of-manufacturers'>
                            First Name   : <input type='text' name='fname' value=$fname><br>
                            <span class='error'>* $fnameErr</span><br>
                            Last Name   : <input type='text' name='lname' value=$lname><br>
                            <span class='error'>* $lnameErr</span><br>
                            Designation   : <input type='text' name='designation' value=$designation><br>
                            <span class='error'>* $designationErr</span><br>
                            Street : <input type='text' name='street' value=$street><br>
                            <span class='error'></span><br>
                            City : <input type='text' name='city' value=$city><br><span class='error'></span><br>
                            Salary : <input type='text' name='salary' value=$salary><br><span class='error'>* $salaryErr</span><br>
                            Hire Date : <input type='text' name='hiredate' placeholder='DD-MON-YY' value=$hiredate><br><span class='error'></span><br>
                            Phone no : <input type='text' name='phoneno' value=$phoneno><br><span class='error'></span><br>
                            <div id='selectbox-of-employee'>
                                <select name='managerid' style='display:block' >
                                    <option value='manager'>Add manager</option>
                                    <option value='100'>Sakhawat Hossain</option>
                                    <option value='103'>Mosaddek Islam</option>
                                </select>
                            </div>
                            <p class='error'>* Must be filled up</p>
                            <button type='submit' name='add' value='add'>Add</button> <br>
                        </div>
                        </form>";
                    }
                    else{
                        
                        $username=$_SESSION['username'];
                        
                        $conn=oci_connect("WSMS","wsms","//localhost/orcl");
                        
                        $query="SELECT GENERATE_ID('EMPLOYEE_ID','EMPLOYEES') FROM DUAL";
                        $stid=oci_parse($conn,$query);
                        $r=oci_execute($stid);
                        
                        $employeeId=0;
                        $row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
                        foreach($row as $orderId)
                            $employeeId=$orderId;
                        
                        $query="INSERT INTO EMPLOYEES VALUES(".$employeeId.",'".$fname."' ,'".$lname."','".$designation."','".$street."','".$city."',".$salary.",TO_DATE('".$hiredate."','DD-MON-YY'),'".$phoneno."' ,".$managerId.",'')";
                
                        $stid=oci_parse($conn,$query);
                        $r=oci_execute($stid);
                        oci_commit($conn);
                        
                        $fname=$lname=$designation=$street=$city=$salary=$hiredate= $phoneno=$managerId="";
                        $lnameErr=$fnameErr=$designationErr=$salaryErr="";                
                        
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
                        <h2>Add new Employees</h2>";
                        
                        echo"<form method='get' action='addNewEmployee.php'>
                        <div id='additionbox-of-manufacturers'>
                            First Name   : <input type='text' name='fname' value=$fname><br>
                            <span class='error'>* $fnameErr</span><br>
                            Last Name   : <input type='text' name='lname' value=$lname><br>
                            <span class='error'>* $lnameErr</span><br>
                            Designation   : <input type='text' name='designation' value=$designation><br>
                            <span class='error'>* $designationErr</span><br>
                            Street : <input type='text' name='street' value=$street><br>
                            <span class='error'></span><br>
                            City : <input type='text' name='city' value=$city><br><span class='error'></span><br>
                            Salary : <input type='text' name='salary' value=$salary><br><span class='error'>* $salaryErr</span><br>
                            Hire Date : <input type='text' name='hiredate' placeholder='DD-MON-YY' value=$hiredate><br><span class='error'></span><br>
                            Phone no : <input type='text' name='phoneno' value=$phoneno><br><span class='error'></span><br>
                            <div id='selectbox-of-employee'>
                                <select name='managerid' style='display:block' >
                                    <option value='manager'>Add manager</option>
                                    <option value='100'>Sakhawat Hossain</option>
                                    <option value='103'>Mosaddek Islam</option>
                                </select>
                            </div>
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