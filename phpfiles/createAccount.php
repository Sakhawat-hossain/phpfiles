<!DOCTYPE HTML>  
<html>
    <head>
        <style>
            .error {
                color: #FF0000;
            }
            body{
                margin: 0 auto;
            }
            h2{
                text-align: center;
            }
            form{
                text-align: left;
                margin: 0 auto;
                padding-left: 10px; 
            }
            .bgimage{
                background-color:  #e0e0e0;
                background-position: center;   
                
                height: 100%;
                width: 300px;
            }
        </style>
    </head>
    <body>  

    <?php
        // define variables and set to empty values
        $fnameErr = $lnameErr = $hsnoErr = $streetErr = $thanaErr = $disttrictErr = $phnoErr = $usernameErr = $passwordErr1 = $passwordErr2="";
        $fname = $lname = $houseno = $street  = $thana = $district = $phno = $username = $password1 = $password2 = "";
       
        $errormgs="";
        $mgs="";
       
        if (isset($_POST['submit'])) {
            $errormgs="ok";
            //--1
            if (!empty($_POST["fname"])) {
               /* $fnameErr = "First name is required";
                $errormgs="error";
            } else {*/
                $fname = test_input($_POST["fname"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/",$fname)) {
                    $fnameErr = "Only letters and white space allowed"; 
                    $errormgs="error";
                }
            }
            //--2
            if (empty($_POST["lname"])) {
                $lnameErr = "Last name is required";
                $errormgs="error";
            } else {
                $lname = test_input($_POST["lname"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/",$lname)) {
                    $lnameErr = "Only letters and white space allowed"; 
                    $errormgs="error";
                }
            }
            //--3
            if (empty($_POST["houseno"])) {
                $hsnoErr = "House no is required";
                $errormgs="error";
            } else {
                $houseno = test_input($_POST["houseno"]);
                // check if name only contains letters , digit and whitespace
                if (!preg_match("/^[0-9a-zA-Z# ]*$/",$houseno)) {
                    $hsnoErr = "Only letters, digits, white space and /,# : are allowed"; 
                    $errormgs="error";
                }
            }
            //4--
            if (empty($_POST["street"])) {
                $streetErr = "Street name is required";
                $errormgs="error";
            } else {
                $street = test_input($_POST["street"]);
                // check if name only contains letters , digit and whitespace
                if (!preg_match("/^[0-9a-zA-Z ]*$/",$street)) {
                    $streetErr = "Only letters, digits and white space allowed"; 
                    $errormgs="error";
                }
            }
            //5--
            if (empty($_POST["thana"])) {
                $thanaErr = "Thana name is required";
                $errormgs="error";
            } else {
                $thana = test_input($_POST["thana"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/",$thana)) {
                    $thanaErr = "Only letters and white space allowed"; 
                    $errormgs="error";
                }
            }
            //6--
            if (empty($_POST["district"])) {
                $disttrictErr = "District name is required";
                $errormgs="error";
            } else {
                $district = test_input($_POST["district"]);
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/",$district)) {
                    $disttrictErr = "Only letters and white space allowed"; 
                    $errormgs="error";
                }
            }
            //7--
            if (empty($_POST["phno"])) {
                $phnoErr = "Phone no is required";
                $errormgs="error";
            } else {
                $phno = test_input($_POST["phno"]);
                // check if name only contains digits
                if (!preg_match("/^[0-9]*$/",$phno)) {
                    $phnoErr = "Only digits allowed"; 
                    $errormgs="error";
                }
            }
            //8--
            if (empty($_POST["username"])) {
                $usernameErr = "Username is required";
                $errormgs="error";
            } else {
                $username = test_input($_POST["username"]);
                // check if name only contains letters, digits and whitespace
                if (!preg_match("/^[0-9a-zA-Z ]*$/",$username)) {
                    $usernameErr = "Only letters and white space allowed"; 
                    $errormgs="error";
                }
            }
            //9--
            if (empty($_POST["password1"])) {
                $passwordErr1 = "Password is required";
                $errormgs="error";
            } else {
                $password1 = test_input($_POST["password1"]);
                 // check if password is well-formed
                if (!preg_match("/^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z@#$& ]*$/", $password1)) {
                    $passwordErr1 = "Invalid password format. Atleast a digit, a character are required."
                            . "@,#,$,& can be used."; 
                    $errormgs="error";
                }
                //check password length
                elseif (strlen($password1)<6) {
                     $passwordErr1 = "Password length must be more than or equal 6";
                     $errormgs="error";
                }
            }
            //10--
            if (empty($_POST["password2"])) {
                $passwordErr2 = "Re-write the same password.";
                $errormgs="error";
            } else {
                $password2 = test_input($_POST["password2"]);
                 // check if password is same
                if($password1 != $password2){
                    $passwordErr2="Re-write the same password.";
                    $errormgs="error";
                }
            }
            if($errormgs=="ok" ){
                
                $conn = oci_connect("WSMS", "wsms", "//localhost/orcl");
            
               // $query = "select USERNAME from RETAILERS";
                $query='BEGIN IS_USERNAME_UNIQUE(:user,:flag); END;';
                
                $stid = oci_parse($conn, $query);
                
                oci_bind_by_name($stid,':user',$username);
                oci_bind_by_name($stid,':flag',$flag,10);
                
                $r = oci_execute($stid);
               
                /*while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
                    foreach( $row as $item){
                        if($item == $username){
                            $usernameErr="The username already exist.";
                            $mgs="error";
                        }
                    }  
                }*/
                echo "$flag";
                if($flag=="YES"){
                    $id=1;
                    $mgs="ok";
                    oci_free_statement($stid);
                    $query="SELECT NVL(MAX(RETAILER_ID),0) FROM RETAILERS";
                    $stid = oci_parse($conn, $query);
                    $r = oci_execute($stid);
                    while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
                        foreach($row as $item){
                            $id=$id+$item;
                        }
                    }
                    oci_free_statement($stid);
                    
                    $password11=md5($password1);
                    $query="INSERT INTO RETAILERS  (RETAILER_ID,FIRST_NAME,LAST_NAME, HOUSE_NO,STREET,THANA,DISTRICT,PHONE_NO,USERNAME,PASSWORD)   VALUES($id,"."'".$fname."','".$lname."','".$houseno."','".$street."','".$thana."','".$district."','".$phno."','".$username."','".$password11."')";
                    
                    $stid = oci_parse($conn, $query);
                    
                    oci_execute($stid);
                    
                    $r = oci_commit($conn);
                    
                        if (!$r) {
                            $e = oci_error($conn);
                            echo $e;
                        }
                    
                    oci_free_statement($stid);
                    oci_close($conn);
                
                }
                else{
                    $usernameErr="The username already exist.";
                }
                if($mgs=="ok"){
                    header("Location: homePage.php"); 
                    //  echo "$errormgs1";
                    exit();
                }
            }
        }

    function test_input($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
        
    ?>

    <h2>Create an account for online orders </h2>
    <div align="center">
        <div class="bgimage">
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">  
        First name : <input type="text" name="fname" size="35" value="<?php echo $fname;?>">
        <span class="error">* <?php echo $fnameErr;?></span>
        <br>
        Last name :  <input type="text" name="lname" size="35" value="<?php echo $lname;?>">
        <span class="error">* <?php echo $lnameErr;?></span>
        <br>
        House no :  <input type="text" name="houseno" size="35" value="<?php echo $houseno;?>">
        <span class="error">* <?php echo $hsnoErr;?></span>
        <br>
        Street : <input type="text" name="street" size="35" value="<?php echo $street;?>">
        <span class="error">* <?php echo $streetErr;?></span>
        <br>
        Thana : <input type="text" name="thana" size="35" value="<?php echo $thana;?>">
        <span class="error">* <?php echo $thanaErr;?></span>
        <br>
        District : <input type="text" name="district" size="35" value="<?php echo $district;?>">
        <span class="error">* <?php echo $disttrictErr;?></span>
        <br>
        Phone No : <input type="text" name="phno" size="35" value="<?php echo $phno;?>">
        <span class="error">* <?php echo $phnoErr;?></span>
        <br>
        Username : <input type="text" name="username" size="35" value="<?php echo $username;?>">
        <span class="error">* <?php echo $usernameErr;?></span>
        <br>
        Password : <input type="text" name="password1" size="35" value="<?php echo $password1;?>">
        <span class="error">* <?php echo $passwordErr1;?></span>
        <br>
        Re-write : <input type="text" name="password2" size="35" value="<?php echo $password2;?>">
        <span class="error">* <?php echo $passwordErr2;?></span>
        <br><br>
        <div align="center">
            <input type="submit" name="submit" value="Submit">  
        </div>
    </form>
    <p><span class="error">* required field.</span></p>
        </div>
    </div>
    </body>
</html>