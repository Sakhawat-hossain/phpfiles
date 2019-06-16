<!DOCTYPE HTML>  
<html>
    <head>
        <style>
            .error {color: #FF0000;}
            body{
                margin-top: 100px;
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
        $nameErr = $passwordErr = $userOrpassErr = "";
        $username = $pass = "";
        $errormgs = "";

        if (isset($_POST['submit'])) {
            $errormgs="ok";

            if (empty($_POST["pass"])) {
                $passwordErr = "Password is required";
                $errormgs = "error";
            }/* else {
                $pass = test_input($_POST["pass"]);
                $errormgs1 = "ok";
                // check if password is well-formed
                if (!preg_match("/^(?=.*\d)(?=.*[a-zA-Z])[0-9a-zA-Z@#$& ]*$/", $pass)) {
                    $passwordErr = "Invalid password format. Atleast a digit, a character are required."
                            . "@,#,$,& are used.";
                    $errormgs1 = "error";
                }
                //check password length
                elseif (strlen($pass) < 6) {
                    $passwordErr = "Password length must be more than or equal 6";
                    $errormgs1 = "error";
                }
            }*/
            if (empty($_POST["username"])) {
                $nameErr = "Username is required";
                $errormgs = "error";
            } /*else {
                $username = test_input($_POST["username"]);
                $errormgs2 = "ok";
                // check if name only contains letters and whitespace
                if (!preg_match("/^[a-zA-Z ]*$/", $username)) {
                    $nameErr = "Only letters and white space allowed";
                    $errormgs2 = "error";
                }
            }*/

            if ($errormgs != "error") {
                $mgs="error";
                $pass = test_input($_POST["pass"]);
                $pass1=md5($pass);
                $username = test_input($_POST["username"]);
                 
                $conn=oci_connect("WSMS","wsms","//localhost/orcl");
                $query="SELECT USERNAME,PASSWORD FROM RETAILERS";
                
                $stid=oci_parse($conn,$query);
                $r=oci_execute($stid);
                echo $pass1;
                while ($row = oci_fetch_assoc($stid)) {
                    if($row['USERNAME'] == $username && $row['PASSWORD'] == $pass1){
                        
                        $mgs="ok";
                        break;
                    } 
                }
                if($mgs=="error"){
                    $userOrpassErr="Username or password error !";
                }
                else{
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
        <h2>Login for online orders </h2>
        <div align="center" >
            <div class="bgimage">
                
            <p><span class="error">* required field.</span></p>
            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">  
                Username: <input type="text" name="username" size="35" value="<?php echo $username; ?>">
                <span class="error">*</span>
                <br><span class="error"> <?php echo $nameErr; ?></span>
                <br>
                Password: <input type="text" name="pass" size="35" value="<?php echo $pass; ?>">
                <span class="error">* </span>
                <br><span class="error"><?php echo $passwordErr; ?></span>
                <br><span class="error"><?php echo $userOrpassErr; ?></span>
                <br><br>
                <div align="center" >
                    <input type="submit" name="submit" value="Submit">  
                </div>
                <br>
            </form>
            </div>
        </div>
    </body>
</html>