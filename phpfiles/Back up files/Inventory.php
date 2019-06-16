<html>
    <head>
        <style>
            body{
                padding: 0;
                margin: 0;
            }
            .container{
                width: 60%;
                display: inline-block;
                position: absolute;
                left: 20%;
            }
            #dataTable{
                border-collapse: collapse;
                width: 100%;
                position:relative;
                
            }
            #dataTable td,#dataTable th{
                border: 1px solid #ddd;
                padding: 10px;
            }
            #dataTable tr:nth-child(even) {
                
                background-color: #f2f2f2;   
            }
            #dataTable tr:hover{
                color: white;
                background-color: #333;
            }
            #dataTable th{
                padding-top: 12px;
                padding-bottom: 12px;
                text-align: left;
                background-color: #4CAF50;
                color: white;               
            }
            #dcheckbox{
                width: 20px;
                height: 20px;
                margin-left: 20px;
            }
            #dSubmit{
                position: relative;
                margin-top: 30px;
                width: auto;
                height: 35px;
                left: 50%;
            }
            p{
                width: 23%;
                left: 0%;
                padding-left: 8px;
            }
        </style>
	</head>
	<body>
        <div class="container">
        
        <?php

            // Create connection to Oracle
            $conn = oci_connect("WSMS", "wsms", "//localhost/orcl");
            
            $query = "select INVENTORY_ID, NAME,PRODUCT_SIZE,CATEGORY,CURRENT_PRICE from INVENTORY";
            
            if(isset($_GET['send'])){
                
                $item=test_input($_GET['item']);
            
                if($_GET['category']=='all'){
                    if($item != ""){                        
                        $query = "select INVENTORY_ID, NAME,PRODUCT_SIZE,CATEGORY,CURRENT_PRICE from INVENTORY where lower(NAME) like '%".$item."%'";              
                    }
                }
                else{
                    $category=$_GET['category']; 
                    
                    if($item==""){
                        $query = "select INVENTORY_ID, NAME,PRODUCT_SIZE,CATEGORY,CURRENT_PRICE from INVENTORY where CATEGORY='".$category."'";
                    }
                    else{
                        $query = "select INVENTORY_ID, NAME,PRODUCT_SIZE,CATEGORY,CURRENT_PRICE from INVENTORY where CATEGORY='".$category."' and lower(NAME) like '%".$item."%'";              
                    }
                }
            }
            
            $stid = oci_parse($conn, $query);
            $r = oci_execute($stid);

            $rowNumber=1;
            $item_list[$rowNumber]=0;
            // Fetch each row in an associative array
            print'<form method="get" action="test2.php">';
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