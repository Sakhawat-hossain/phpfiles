<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        
        <style>
            
        </style>
	</head>
	<body>
        <?php
            $from=$to=$type=$checkin=$checkout="";
        
            if(isset($_GET['send'])){
                $from=$_GET['from'];
                $to=$_GET['to'];
                $type=$_GET['type'];
                $checkin=$_GET['checkin'];
                $checkout=$_GET['checkout'];
                
                echo "<span>From : $from</span><br>
                <span>To : $to</span><br>
                <span>Bus type : $type</span><br>
                <span>Check in : $checkin</span><br>
                <span>Check out : $checkout</span><br>";
                
            }
        ?>
    </body>
</html>