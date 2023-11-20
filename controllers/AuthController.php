<?php
    session_start();
    require "../koneksi.php";

    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        if(isset($_POST['login'])) {
            $username=$_POST['username'];
			$password=$_POST['password'];

            $query = "SELECT * FROM user WHERE username = ? AND password = ?;";
            $statement = $con->prepare($query);
            $statement->bind_param('ss', $username, $password);
            $statement->execute();
            $result = $statement->get_result();

            $con->close();

            if($result->num_rows === 1) {
                $row = $result->fetch_assoc();
                
                $_SESSION["success_message"] = "Login Success";
                $_SESSION["id"] = $row['id_user'];
                $_SESSION['login'] = true;
                $_SESSION['username'] = $row['username'];
                $_SESSION['role'] = $row['role'];
                $_SESSION['email'] = $row['email'];
                $_SESSION['telp'] = $row['telepon'];
                $role = $row['role'];

                if ($role == "Admin") {
					echo "<script>alert('selamat datang di halaman admin');</script>";
					header('location: ../index.html');
				} else if ($role == "Kasir") {
					echo "<script>alert('selamat datang di halaman Kasir');</script>";
					header('location: ../index_Kasir.html');
				}
            } 

            if (isset($_POST['remember'])){
                //set up cookie
                setcookie("user", $row['username'], time()+1800); 
            }

        } else {
            $_SESSION["error_message"] = "Login Failed";
            header("Location: ../login.php");
        }
    } 

?>