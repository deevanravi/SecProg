<?php
    	session_start();
    	require "./koneksi.php";
?>

<!DOCTYPE html>
    <html>
    <head>
	<style type="text/css">
        @import "style.css";
        p{text-indent : 50px };
    </style>
    </head>
    <body>
	<div class="login">
		<h2>Login</h2>
    	<form method="POST" action="controllers/AuthController.php">
			<table>
				<tr>
					<td><label>Username</label></td>
					<td>:</td>
					<td><input type="text" value="<?php if (isset($_COOKIE["user"])){echo $_COOKIE["user"];}?>" name="username"></td>
				</tr>
				<tr>
					<td><label>Password</label></td>
					<td>:</td>
					<td><input type="password" value="<?php if (isset($_COOKIE["pass"])){echo $_COOKIE["pass"];}?>" name="password"></td>
				</tr>
				<tr>
					<td><input type="checkbox" name="remember"> Remember me</td>
					<td></td>
					<td></td>
				</tr>
				<tr>
					<td><input type="submit" value="Login" name="login"></td>
					<td></td>
					<td></td>
				</tr>
			
				
			</table>
    	</form>
        </div>
    	
     
    	<span>
    	<?php
    		if (isset($_SESSION['message'])){
    			echo $_SESSION['message'];
    		}
    		unset($_SESSION['message']);
    	?>
    </span>
    </body>
</html>