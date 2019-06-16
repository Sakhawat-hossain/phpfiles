<html>
    <head>
        <title></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="header-design.css">
        <link rel="stylesheet" type="text/css" href="footer-design.css">
        <link rel="stylesheet" type="text/css" href="review-page-design.css">
      
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
        <?php 
            if(isset($_GET['review'])){
                
                $product_id=$_GET['review'];
                
                echo'<div id="review-container">
                    <form>
                        <h3>Review...<h3>
                        <div id="review-text-container">
                            <input type="text" name="reviewtext">
                        </div>
                        <div id="review-user-container">
                            <input type="text" name="username" placeholder="username">
                            <input type="text" name="password" placeholder="password">';
                            echo"<button type='submit' name='submit' value=$product_id>Send</button>";
                        echo'</div>
                        <p style="margin-top:10px;"> More reviews...</p>
                        <div id="morereview-container">';
                
                        $conn=oci_connect("WSMS","wsms","//localhost/orcl");
                
                        $query="SELECT RT.FIRST_NAME,RT.LAST_NAME,R.TEXT,R.REVIEW_DATE FROM REVIEWS R JOIN RETAILERS RT ON(RT.RETAILER_ID=R.RETAILER_ID) WHERE INVENTORY_ID='".$product_id."'";
                
                        $stid=oci_parse($conn,$query);
                        $r=oci_execute($stid);
                        
                        $arr='';
                        while($row=oci_fetch_array($stid,OCI_RETURN_NULLS+OCI_ASSOC)){
                            
                            $idx=0;
                            foreach($row as $item){
                                $arr[$idx]=$item;
                                $idx++;
                            }
                            $fname=$arr[0];
                            $lname=$arr[1];
                            $date=$arr[3];
                            $text=$arr[2];
                            
                            $name=$fname." ".$lname;

                            echo"<div id='morereview-container'>
                                <div id='morereview-name-container'>
                                    <p>$name</p>
                                    <p>$date</p>
                                </div>
                                <div id='morereview-text-container'>
                                    <p>$text</p>
                                </div>
                            </div>";
                        }
                        if($arr==''){
                            echo"<div id='morereview-container'>
                                <div id='morereview-text-container'>
                                    <p>No review yet</p>
                                </div>
                            </div>";
                        }

                    echo'</div>
                    </form>
                </div>';
            }
            elseif(isset($_GET['submit'])){
                
                $conn=oci_connect("WSMS","wsms","//localhost/orcl");
                
                $product_id=$_GET['submit'];
                $username=$_GET['username'];
                $password=$_GET['password'];
                $password=md5($password);
                
                $query="SELECT RETAILER_ID FROM RETAILERS WHERE USERNAME='".$username."' AND PASSWORD='".$password."'";
                
                $stid=oci_parse($conn,$query);
                $r=oci_execute($stid);
                $row=oci_fetch_assoc($stid);
                
                $retailerid=$row['RETAILER_ID'];
                
                if($retailerid==0){
                    echo'<div id="review-container">
                        <form>
                            <h3>Review...<h3>
                            <div id="review-text-container">
                                <input type="text" name="reviewtext">
                            </div>
                            <div id="review-user-container">
                                <input type="text" name="username" placeholder="username">
                                <input type="text" name="password" placeholder="password">';
                                echo"<button type='submit' name='submit' value=$product_id>Send</button>
                                <p>Please sign up first</p>";
                            echo'</div>
                            <p style="margin-top:10px;"> More reviews...</p>
                            <div id="morereview-container">';

                            $query="SELECT RT.FIRST_NAME,RT.LAST_NAME,R.TEXT,R.REVIEW_DATE FROM REVIEWS R JOIN RETAILERS RT ON(RT.RETAILER_ID=R.RETAILER_ID) WHERE INVENTORY_ID='".$product_id."'";

                            $stid=oci_parse($conn,$query);
                            $r=oci_execute($stid);

                            $arr='';
                            while($row=oci_fetch_assoc($stid,OCI_RETURN_NULLS+OCI_ASSOC)){

                                $idx=0;
                                foreach($row as $item){
                                    $arr[$idx]=$item;
                                    $idx++;
                                }
                                $fname=$arr[0];
                                $lname=$arr[1];
                                $date=$arr[3];
                                $text=$arr[2];

                                $name=$fname." ".$lname;

                                echo"<div id='morereview-container'>
                                    <div id='morereview-name-container'>
                                        <p>$name</p>
                                        <p>$date</p>
                                    </div>
                                    <div id='morereview-text-container'>
                                        <p>$text</p>
                                    </div>
                                </div>";
                            }
                            if($arr==''){
                                echo"<div id='morereview-container'>
                                    <div id='morereview-text-container'>
                                        <p>No review yet</p>
                                    </div>
                                </div>";
                            }

                        echo'</div>
                        </form>
                    </div>';
                }
                else{
                    $reviewid=0;
                    $query="SELECT NVL(MAX(REVIEW_ID),0) FROM REVIEWS";

                    $stid=oci_parse($conn,$query);
                    $r=oci_execute($stid);
                    $row=oci_fetch_array($stid);
                    
                    foreach($row as $id)
                        $reviewid=$id;
                    
                    $reviewid++;
                    $text=$_GET['reviewtext'];
                    
                    $query="INSERT INTO REVIEWS VALUES($reviewid,$retailerid, $product_id,'".$text."',SYSDATE)";
                    
                    $stid=oci_parse($conn,$query);
                    $r=oci_execute($stid);
                    
                    oci_commit($conn);
                    
                    echo "<p>successfully reviewed</p>
                        <form method='get' action='homePage.php'>
                            <button type='submit'>Back to Homepage</button>
                        </form>";
                }
            }
        ?>
    <body>

    </body>
</html>