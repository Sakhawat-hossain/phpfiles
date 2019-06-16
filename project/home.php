<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Booking Form HTML Template</title>

	<!-- Google font -->
	<link href="https://fonts.googleapis.com/css?family=Montserrat:400,700" rel="stylesheet">

	<!-- Bootstrap -->
	<link type="text/css" rel="stylesheet" href="css/bootstrap.min.css" />

	<!-- Custom stlylesheet -->
	<link type="text/css" rel="stylesheet" href="css/style.css" />

	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
		  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
    <style>
        #login_button{
            height: auto;
            width: auto;
            position: absolute;
            left: 80%;
            top: 5%;
        }
        #login_button button{
            color: blue;
            height: 40px;
            width: 100px;
            margin-left: 10px;
            float: left;
        }
    </style>

</head>

<body>
	<div id="booking" class="section">
        
                <div id="login_button">
                    <a href="createAccount.php">
                        <button type="submit">Sign up</button>
                    </a>
                    <a href="login.php">
                        <button type="submit">Login</button>
                    </a>
                </div>
        
		<div class="section-center">
			<div class="container"> 
				<div class="row">
					<div class="col-md-7 col-md-push-5">
						<div class="booking-cta">
							<h1>Make your reservation</h1>
							<p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Animi facere, soluta magnam consectetur molestias itaque
								ad sint fugit architecto incidunt iste culpa perspiciatis possimus voluptates aliquid consequuntur cumque quasi.
								Perspiciatis.
							</p>
						</div>
					</div>
                    
					<div class="col-md-4 col-md-pull-7">
						<div class="booking-form">
							<form method="get" action="busList.php">
                                <div class="form-group">
									<span class="form-label">From</span>
									<select class="form-control" name="from">
										<option>Dhaka</option>
										<option>Rangpur</option>
                                        <option>Bogura</option>
								    </select>
									<span class="select-arrow"></span>
								</div>
								<div class="form-group">
									<span class="form-label">To</span>
									<select class="form-control" name="to">
										<option>Dhaka</option>
										<option>Rangpur</option>
                                        <option>Bogura</option>
								    </select>
									<span class="select-arrow"></span>
								</div>
                                
                                <div class="form-group">
									<span class="form-label">Type</span>
									<select class="form-control" name="type">
										<option>AC</option>
										<option>Non-AC</option>
								    </select>
									<span class="select-arrow"></span>
								</div>
                                
								<div class="row">
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Check In</span>
											<input class="form-control" type="date" name="checkin" required>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<span class="form-label">Check out</span>
											<input class="form-control" type="date" name="checkout">
										</div>
									</div>
								</div>
								<div class="form-btn">
									<button class="submit-btn" name="send">Check availability</button>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body><!-- This templates was made by Colorlib (https://colorlib.com) -->

</html>