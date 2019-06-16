<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="inventoryDesign.css">
        <style>
            
        </style>
	</head>
	<body>
        <div id="container">
        
        <?php

            // Create connection to Oracle
            $conn = oci_connect("WSMS", "wsms", "//localhost/orcl");
            
            $query = "select INVENTORY_ID, NAME,PRODUCT_SIZE,CATEGORY,CURRENT_PRICE from INVENTORY WHERE QUANTITY>0";
            
            if(isset($_GET['send'])){
                
                $item=test_input($_GET['item']);
            
                if($_GET['category']=='all'){
                    if($item != ""){                        
                        $query = "select INVENTORY_ID, NAME,PRODUCT_SIZE,CATEGORY,CURRENT_PRICE from INVENTORY where lower(NAME) like '%".$item."%' AND QUANTITY>0";              
                    }
                }
                else{
                    $category=$_GET['category']; 
                    
                    if($item==""){
                        $query = "select INVENTORY_ID, NAME,PRODUCT_SIZE,CATEGORY,CURRENT_PRICE from INVENTORY where CATEGORY='".$category."' AND QUANTITY>0";
                    }
                    else{
                        $query = "select INVENTORY_ID, NAME,PRODUCT_SIZE,CATEGORY,CURRENT_PRICE from INVENTORY where CATEGORY='".$category."' and lower(NAME) like '%".$item."%' AND QUANTITY>0";              
                    }
                }
            }
            
            $stid = oci_parse($conn, $query);
            $r = oci_execute($stid);

            $rowNumber=1;
            $item_list[$rowNumber]=0;
            // Fetch each row in an associative array
            print'<form method="get" action="cartItemWithList.php">';
            print '<table id="dataTable" border="2">';
        
                echo "<th>Select</th> <th>Name</th> <th>Size</th> <th>Category</th> <th>Price</th> <th>Image</th>";

                while ($row = oci_fetch_array($stid, OCI_RETURN_NULLS+OCI_ASSOC)) {
                    print '<tr>';
                    $f=0;
                    
                    foreach ($row as $item) {
                        if($f==0){
                            echo "<td><input id='dcheckbox' type='checkbox' name='item_list[]'  value=$item></td>";
                        }
                        else{
                            echo "<td>$item</td>";
                        }
                        $f=$f+1;
                    }
                    echo "<td>i</td>";
                    
                    print '</tr>';
                    
                    $rowNumber=$rowNumber+1;
                }
            print '</table>';
            
                print'<input id="dSubmit" type="submit" name="addtocart" value="Add to Cart">';     
            
            print'</form>';
                

            function test_input($data) {
                $data = trim($data);
                $data = stripslashes($data);
                $data = htmlspecialchars($data);
                return $data;
            }
            oci_free_statement($stid);
            oci_close($conn);
        ?>
        </div>
       
    </body>
</html>