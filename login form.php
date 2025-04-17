<?php
session_start();
include "dbconnection.php";

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM Lecturer WHERE Email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['Password'])) {
            $_SESSION['name'] = $row['Name'];
            $_SESSION['email'] = $email;
            header("Location: dashboard.php");
            exit();
        } else {
            echo "Invalid password.";
        }
    } else {
        echo "No user found with this email.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Login</title>
    <link rel="stylesheet" href="login3.css">
    <link rel="stylesheet" href="dpt.css">
</head>

<body>
    <header>
        <nav>
            <div class="nav-left">
            <h1>Welcome to Our ATI !!</h1>
            </div>
            <div class="div nav-right">
                <ul>
				<li><a href="index.php">Home</a></li>
                <li><a href="login form.php">Login</a></li>
                <li class="dropdown">
                    <a href="dashboard.php">Records</a>
                    <div class="dropdown-content">
                        <a href="course registration.php">Course Registration</a>
                        <a href="course details.php">Course Details</a>
                    </div>
                </li>
                <li><a href="registration form.php">Registration</a></li>
                </ul>
            </div>
        </nav>
    </header>
	
    <main>
    
       <form action="" method="post">
       <h2> Login Form </h2>
       
            <label for="email">Email:</label>
            <input type="text" id="email" name="email" required>
            <br>
            <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
            <!--<button type="submit" name="submit">Add</button>-->
            <button name="submit">Login</button>

           

        </form>
    </main>
    <footer>
    <p> Sliate Sammanthurai.</p>
    </footer>
</body>

</html>
	
 
	