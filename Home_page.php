<!DOCTYPE html>
<html>
<head>
	<title>Home Page</title>
	<link rel="stylesheet" type="text/css" href="stylehome.css" >
	<link rel="stylesheet" type="text/css" href="navbar.css"> 
</head>
<body>

	<div class="home">
      
   <ul>
 <li><a href="#">Home</a></li>
 <li><a href="#">Login</a>
  <ul>
   <li><a href="admin_login.php">Administrative Login</a></li>
   <li><a href="Auth_login.php">Authority Login</a></li>
   <li><a href="Home_page.php">Student Login</a></li>
  </ul>
 </li>
 <li><a href="#">Register</a>
  <ul>
   <li><a href="Auth_register.php">Authority Register</a></li>
   <li><a href="Register.php">Student Register</a></li>
  </ul>
 </li>
 <li><a href="#">Contact</a>
  <ul>
   <li><a href="">Mobile No.</a></li>
   <li><a href="">Email</a></li>
  </ul>
 </li>
 <li><a href="#">About us</a></li>
</ul>

		<div class="form-box" >
			<div class="button-box">
				<div id="btn"></div>
				<button type="button" class="toggle-btn">Login</button>
				
				<button type="submit" class="toggle-btn" onclick="register()">Register </button>
			    
	        </div> 
	          <div class="social-icons">
		 		<img src="fb.png">
		 		<img src="gp.png">
		 		<img src="tw.png">
			  </div>

			  <form id="login"class="input-group" action="server_log.php" method="post">
			  	<input type="text" name="user"class="input-field" placeholder="User Id" required >
			  	<input type="password" name="pass" class="input-field" placeholder="Enter Password" required>
			  	<input type="checkbox" class="check-box"> <span>Remember Password</span>
			  	<button id="lg1" type="submit" class="submit-box">Login</button>
			  </form>

			</div>

		</div>

		<script >
			function register(){
				window.location = "Register.php";
			}
        </script>

</body>
</html>