<html>
    <head>
        <style>
            body{
                padding: 0;
                margin: 0;
            }
            .container{
                width: 60%;
                height: auto;
                margin: 0px;
                display: inline-block;
                position: absolute;
                left: 20%;
                border: 1px red solid;
            }
            #dataTable{
                border-collapse: collapse;
                width: 100%;
                position:relative;
                
            }
            #dataTable td,#dataTable th{
                border: 1px solid #ddd;
                padding: 8px;
                padding-left: 10px;
            }
            #dataTable tr:nth-child(even) {
                
                background-color: #f2f2f2;   
            }
            #dataTable tr:hover{
                color: white;
                background-color: #333;
            }
            #dataTable th{
                padding-top: 10px;
                padding-bottom: 10px;
                text-align: left;
                background-color: #4CAF50;
                color: white;               
            }
            #dcheckbox{
                width: 20px;
                height: 20px;
                margin-left: 20px;
            }
            .containerbottom{
                width: 100%;
                height: 90px;
                position: relative;
                background-color: #808080;
                margin-bottom: 0px;
            }
            #empty{
                width: 400px;;
                height: 300px;
                left: 30%;
                position: absolute;
                background-color: bisque;
            }
            #empty p{
                top: 35%;
                position: relative;
                text-align: center;
            
            }
            #dSubmit{
                position: relative;
                margin-top: 30px;
                width: 60px;;
                height: 35px;
                left: 50%;
                background-color: burlywood;
            }
        </style>
	</head>
	<body>
        
        <?php
            
            if(isset($_GET['addtocart'])){
                
                // Create connection to Oracle
                    $conn = oci_connect("WSMS", "wsms", "//localhost/orcl");
                if(isset($_GET['item_list'])){
                    print '<div class="container">';    
                    print '<form method="get" action="test2.php">';
                    print '<table id="dataTable" border="2">';
        
                
                    echo "<th>Select</th> <th>Name</th> <th>Size</th> <th>Category</th> <th>Price</th> <th>Quantity</th>";

                    foreach($_GET['item_list'] as $id){

                        $id=test_input($id);
                        $query = "select NAME, PRODUCT_SIZE, CATEGORY, CURRENT_PRICE from INVENTORY where INVENTORY_ID=$id";

                        $stid = oci_parse($conn, $query);
                        $r = oci_execute($stid);

                        print '<tr>';
                        echo "<td><input id='dcheckbox' type='checkbox' name='item_list[]'  value=$id checked></td>";

                        $row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC);
                        foreach ($row as $item) {
                            echo "<td>$item</td>";
                        }
                        echo "<td><input type='text' style='width:80px;margin-left:20px;' name=$id</td>";

                        print '</tr>';

                        oci_free_statement($stid);
                    }
                    print '</table>';

                    echo'<div class="containerbottom">
                        <input id="dSubmit" type="submit" name="buy" value="Buy">
                    </div>';    

                    print '</form>'; 
                    print '</div>';
                }
                else{
                    echo "<div id='empty'><p>Add item to the cart</p></div> ";
                }
                
                oci_close($conn); 
            }
            else{
                echo "<div id='empty'><p>Add item to the cart</p></div> ";                
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