<?php session_start();?>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
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
            #report-container{
                width: 90%;
                height: 90%;
                left: 5%;
                top: 5%;
                position: relative;
                background-color: chocolate;
            }
            #inner-container{
                width: 60%;
                height: 30%;
                left: 30%;
                top: 30%;
                display: flex;
                position: absolute;
            }
            #inner-container input{
                
                height: 30px;
                margin-left: 10px;   
            }
            #report-container h1{
                position: absolute;
                top: 10%;
                left: 40%;
            }
            h2{
                position: absolute;
                top: 50%;
                left: 25%;
            }
            h4{
                margin-left: 10px;
                margin-right: 10px;
            }
            #usernamebox{
    position: absolute;
    width: 250px;
    height: 30px;
    overflow: none;
    display: flex;
    top: 5%;
    right: 12%;
}
#usernamebox p{
    height: 100%;
    width: 130px;
    text-align: center;
}
#usernamebox button{
    height: 100%;
    width: 119px;
    border: none;
    overflow: hidden;
}
#logoutbox{
    position: absolute;
    right: 3%;
    top: 5%;
    text-align: center;
}
#logoutbox button{
    width: 70px;
    height: 30px;
}
#backbox{
    position: absolute;
    left:  2%;
    top: 5%;
    text-align: center;
}
#backbox button{
    width: 60px;
    height: 30px;
}

        </style>
	</head>
	<body>
        <div id="report-container">
            <?php 
                if(isset($_GET['report'])){
                    
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
                    
                    echo "<form method='get' action='report.php'>
                        <h1>Check profit</h1>
                        <div id='inner-container'>
                            
                            From <input type='text'placeholder='DD-MON-YY' name='sdate'>
                            To <input type='text'placeholder='DD-MON-YY' name='edate'>
                            <input type='submit' name='submit'>
                        </div>
                    </form>";
                }
                elseif(isset($_GET['submit'])){
                    
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
                    
                    $sdate=$_GET['sdate'];
                    $edate=$_GET['edate'];
                  
                    
                    $conn=oci_connect("WSMS","wsms","//localhost/orcl");
                        
                        $query="SELECT MONTHLY_PROFIT(TO_DATE('".$sdate."','DD-MON-YY'),TO_DATE('".$edate."','DD-MON-YY')) FROM DUAL";
                        $stid=oci_parse($conn,$query);
                        $r=oci_execute($stid);
                        
                        $profit=0;
                        $row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
                        foreach($row as $orderId)
                            $profit=$orderId;
                    
                   echo" <div id='inner-container'>
                            <p>The profit from <h4>$sdate</h4> to <h4>$edate</h4> is <br><br></p>
                            <h2 >$profit</h2>
                        </div>";
                }
            ?>
        </div>
    </body>
</html>