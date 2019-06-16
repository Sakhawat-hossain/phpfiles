<?php session_start(); ?>

<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="footer-design.css">
        <link rel="stylesheet" type="text/css" href="transaction-details-design.css">
        <link rel="stylesheet" type="text/css" href="transaction-design.css">
      
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
                position: relative;
            } 
        </style>
    </head>
    
    <body>
        <div id="transaction-container">
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
                    <div id='backbox'>
                        <a href='adminLoginPage.php'>
                            <Button type='submit' name='back'>Back</button>
                        </a>
                    </div>
                    <h2>New orders</h2>";
            echo "<div id='transaction-inner-container'>";
            
            $conn = oci_connect("WSMS", "wsms", "//localhost/orcl");
            
            if(isset($_GET['detail'])){
                
                    $orderId=$_GET['detail'];
                
                $query="SELECT O.ORDER_ID,(R.FIRST_NAME ||' '|| R.LAST_NAME),R.HOUSE_NO, R.STREET,R.THANA,R.DISTRICT,O.ORDERED_DATE FROM ORDERS O JOIN RETAILERS R ON(O.RETAILER_ID=R.RETAILER_ID) WHERE O.CONFORMATION='pendding'";

                $stid = oci_parse($conn, $query);
                $r = oci_execute($stid);

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
                    $name=$arr[1];
                    $houseno=$arr[2];
                    $street=$arr[3];
                    $thana=$arr[4];
                    $district=$arr[5];
                    $date=$arr[6];
                    echo "<form method='get' action='test.php'>
                        <div id='topbox-of-a-orderbox'>
                            <div id='namebox'>$name</div>
                            <div id='datebox'>$date</div>
                            <p>Pendding</p>
                            <button type='submit' name='detail' value=$arr[0]>Details  &#xf0d7</button>
                        </div>";
                    
                     //create list and voucher   order_id==$arr
                    $totalcost=0;
                    
                    if($orderId==$arr[0]){
                        
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
                        <div id="dropdownbox-of-conformation">
                            <div id="selectbox">';
                             echo"<select name='zone' style='display:block' >
                                    <option value=$thana>$thana</option>
                                </select>
                            </div>";
                                    
                        echo'<div id="selectbox">
                                <select name="salesman" style="display:block" >
                                    <option value="Salesman">Add salesman</option>';
                                   
                                    $query2="SELECT EMPLOYEE_ID ,(FIRST_NAME || ' ' || LAST_NAME) FROM EMPLOYEES WHERE WORKING_ZONE='".$thana."'";

                                    $stid2 = oci_parse($conn, $query2);
                                    $r2 = oci_execute($stid2);
                                    while($row2 = oci_fetch_array($stid2)){
                                        $I=0;
                                        if(empty($row2))
                                            echo"<option value=104>Rahim Uddin</option>";
                                        else{
                                            $ename='';
                                            $eid='';
                                            foreach($row2 as $item2){
                                                if($I==0){
                                                    $eid=$item2;
                                                    $I++;
                                                }
                                                else{
                                                    $ename=$item2;
                                                }
                                            }
                                            echo"<option value=$eid>$ename</option>";
                                        }
                                    }
                           echo"</select>
                            </div>
                            <button type='submit' name='confirmorder' value=$orderId>Confirm</button>
                        </div>
                        
                        </div>";//end of detailbox
                        echo"<div id='address-container'>
                            <p>Address : House No = $houseno, Street = $street, Thana = $thana, District = $district</p>
                        </div>";
                    }
                }
                if($flag == 0){
                    echo "<div id='empty-container'>There is no order yet";
                }
            }/// confirm send ordered product
            elseif(isset($_GET['confirmorder'])){
                
                $orderId = $_GET['confirmorder'];
                $salesman = $_GET['salesman'];
                $zone = $_GET['zone'];
                
                if(($salesman != 'Salesman') && ($zone != 'zone')){
                    $query = "UPDATE ORDERS SET EMPLOYEE_ID = $salesman,ZONE = '".$zone."',CONFORMATION='confirmed' WHERE ORDER_ID=$orderId";
                    $stid = oci_parse($conn, $query);
                    $r = oci_execute($stid);

                    oci_commit($conn);
                }
                $query="SELECT O.ORDER_ID,(R.FIRST_NAME ||' '|| R.LAST_NAME),O.ORDERED_DATE FROM ORDERS O JOIN RETAILERS R ON(O.RETAILER_ID=R.RETAILER_ID) WHERE O.CONFORMATION='pendding'";

                $stid = oci_parse($conn, $query);
                $r = oci_execute($stid);

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
                    echo"<form method='get' action='test.php'>
                        <div id='topbox-of-a-orderbox'>
                            <div id='namebox'>$arr[1]</div>
                            <div id='datebox'>$arr[2]</div>
                            <p>Pendding</p>
                            <button type='submit' name='detail' value=$arr[0]>Details &#xf0d7</button>
                        </div>
                    </form>";
                    
                }
                if($flag == 0){
                    echo "<div id='empty-container'>There is no order yet";  
                }
                
                oci_free_statement($stid);
                oci_close($conn);

            }
            else{
                $query="SELECT O.ORDER_ID,(R.FIRST_NAME ||' '|| R.LAST_NAME),O.ORDERED_DATE FROM ORDERS O JOIN RETAILERS R ON(O.RETAILER_ID=R.RETAILER_ID) WHERE O.CONFORMATION='pendding'";

                $stid = oci_parse($conn, $query);
                $r = oci_execute($stid);

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
                    echo "<form method='get' action='test.php'>
                        <div id='topbox-of-a-orderbox'>
                            <div id='namebox'>$arr[1]</div>
                            <div id='datebox'>$arr[2]</div>
                            <p>Pendding</p>
                            <button type='submit' name='detail' value=$arr[0]>Details &#xf0d7</button>
                        </div>";
                    
                }
                if($flag == 0){
                    echo "<div id='empty-container'>There is no order yet";
                }
                
                oci_free_statement($stid);
                oci_close($conn);
            }// details
            
            echo"</div>";
        ?>
        </div>
    </body>
</html>