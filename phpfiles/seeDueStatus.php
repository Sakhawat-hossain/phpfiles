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
        <link rel="stylesheet" type="text/css" href="transaction-details-design.css">
        <link rel="stylesheet" type="text/css" href="see-due-status-design.css">
        
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
        <div id="see-due-status-container">
            <?php 
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
                    
                    <h2>Dues</h2>";
            
            $conn = oci_connect("WSMS", "wsms", "//localhost/orcl");
            
                //initial
            if(isset($_GET['due'])){
                $query="SELECT O.ORDER_ID,(R.FIRST_NAME ||' '|| R.LAST_NAME),O.ORDERED_DATE FROM ORDERS O JOIN RETAILERS R ON(O.RETAILER_ID=R.RETAILER_ID) WHERE O.DUE_STATUS='due'";

                $stid = oci_parse($conn, $query);
                $r = oci_execute($stid);
                
                echo"<div id='backbox'>
                    <a href='adminLoginPage.php'>
                        <Button type='submit' name='back'>Back</button>
                    </a>
                </div>";

                echo'<div id="see-due-inner-container">';
                $flag=0;
                while($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
                    
                    $flag=1;
                    $idx=0;
                    $arr='';
                    foreach($row as $item){
                        $arr[$idx]=$item;
                        $idx++;
                       // echo $arr[$idx-1];
                    }
                    echo "<form method='get' action='seeDueStatus.php'>
                        <div id='topbox-of-a-orderbox'>
                            <div id='namebox'>$arr[1]</div>
                            <div id='datebox'>$arr[2]</div>
                            <p>Due</p>
                            <button type='submit' name='detail' value=$arr[0]>Details &#xf0d7</button>
                        </div>
                    </form>";
                    
                }
                if($flag == 0){
                    echo "<div id='empty-container'>All paid..";
                }
                echo"</div>";
                oci_free_statement($stid);
                oci_close($conn);
            }
            elseif(isset($_GET['detail'])){
                
                $orderId=$_GET['detail'];
                
                $query="SELECT (R.FIRST_NAME ||' '|| R.LAST_NAME),R.HOUSE_NO, R.STREET,R.THANA,R.DISTRICT,O.ORDERED_DATE FROM ORDERS O JOIN RETAILERS R ON(O.RETAILER_ID=R.RETAILER_ID) WHERE O.ORDER_ID=$orderId";

                $stid = oci_parse($conn, $query);
                $r = oci_execute($stid);
                
                echo"<div id='backbox'>
                    <form method='get' action='seeDueStatus.php'>
                        <Button type='submit' name='due'>Back</button>
                    </form>
                </div>";

                echo' <div id="see-due-inner-container">';
                $flag=0;
                while($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
                    
                    $flag=1;
                    $idx=0;
                    $arr='';
                    foreach($row as $item){
                        $arr[$idx]=$item;
                        $idx++;
                       // echo $arr[$idx-1];
                    }
                    $name=$arr[0];
                    $houseno=$arr[1];
                    $street=$arr[2];
                    $thana=$arr[3];
                    $district=$arr[4];
                    $date=$arr[5];
                    echo "<form method='get' action='seeDueStatus.php'>
                        <div id='topbox-of-a-orderbox'>
                            <div id='namebox'>$name</div>
                            <div id='datebox'>$date</div>
                            <p>Pendding</p>
                            <button type='submit' name='detail' value=$orderId>Details  &#xf0d7</button>
                        </div>
                    </form>";
                    
                     //create list and voucher   order_id==$arr
                    $totalcost=0;
                    
                   // if($orderId==$arr[0]){
                    // same as transaction detail
                    
                        print "<div id='container'>
                        <table id='dataTable' >";
                        echo "<th>Product name</th> <th>Size</th> <th>Quantity</th> <th>Cost</th>";
                        
                        $query1="SELECT I.NAME,I.PRODUCT_SIZE,I.CURRENT_PRICE,OP.QUANTITY FROM ORDERED_PRODUCTS OP JOIN INVENTORY I ON(OP.INVENTORY_ID = I.INVENTORY_ID) WHERE OP.ORDER_ID=$orderId";
                            
                        $stid1 = oci_parse($conn, $query1);
                        $r1 = oci_execute($stid1);
                        
                        while($row1 = oci_fetch_assoc($stid1)){

                            $quantity=$row1['QUANTITY'];                            
                            $proname=$row1['NAME'];
                            $size=$row1['PRODUCT_SIZE'];
                            $cost=$row1['CURRENT_PRICE']*$quantity;
                            $totalcost=$totalcost+$cost;
                            
                            print '<tr>';
                            echo "<td>$proname</td><td>$size</td><td>$quantity</td><td>$cost</td>";
                            print '</tr>';
                        }
                        print'</table>';
                        print'<table id="dataTable" style="text-align:center">';
                        print "<tr><td style='width:80%;'>Total cost</td><td>$totalcost</td>";
                        print '</table>
                        <form method="get" action="seeDueStatus.php">
                            <div id="dropdownbox-of-conformation">';
                                echo "<button type='submit' name='confirmpaid' value=$orderId>Confirm</button>
                            </div>
                        </form>
                        </div>";//end of detailbox
                   // }
                    // adddress
                    echo"<div id='address-container'>
                        <p>Address : House No = $arr[1], Street = $arr[2], Thana = $arr[3], District = $arr[4]</p>
                    </div>";
                }
                if($flag == 0){
                    echo "<div id='empty-container'>All paid...";
                }
                echo"</div>";
            }
            elseif(isset($_GET['confirmpaid'])){
                $orderId = $_GET['confirmpaid'];
                
                $query = "UPDATE ORDERS SET DUE_STATUS='paid' WHERE ORDER_ID=$orderId";
                    $stid = oci_parse($conn, $query);
                    $r = oci_execute($stid);

                    oci_commit($conn);
                
                $query="SELECT O.ORDER_ID,(R.FIRST_NAME ||' '|| R.LAST_NAME),O.ORDERED_DATE FROM ORDERS O JOIN RETAILERS R ON(O.RETAILER_ID=R.RETAILER_ID) WHERE O.DUE_STATUS='due'";

                $stid = oci_parse($conn, $query);
                $r = oci_execute($stid);

                echo"<div id='backbox'>
                    <a href='adminLoginPage.php'>
                        <Button type='submit' name='back'>Back</button>
                    </a>
                </div>";
                echo' <div id="see-due-inner-container">';
                $flag=0;
                while($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)){
                    
                    $flag=1;
                    $idx=0;
                    $arr='';
                    foreach($row as $item){
                        $arr[$idx]=$item;
                        $idx++;
                       // echo $arr[$idx-1];
                    }
                    echo"<form method='get' action='seeDueStatus.php'>
                        <div id='topbox-of-a-orderbox'>
                            <div id='namebox'>$arr[1]</div>
                            <div id='datebox'>$arr[2]</div>
                            <p>Pendding</p>
                            <button type='submit' name='detail' value=$arr[0]>Details &#xf0d7</button>
                        </div>
                    </form>";
                    
                }
                if($flag == 0){
                    echo "<div id='empty-container'>All paid...";   
                }
                echo"</div>";
                
                oci_free_statement($stid);
                oci_close($conn);

            }
            else{
                echo "<div id='empty-container'>All paid..";
                echo "<a href='adminLoginPage.php'><button>Back</button></a></div>";
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