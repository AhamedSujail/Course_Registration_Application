<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login form.php"); // Redirect to login if not logged in
    exit();
}


include "dbconnection.php";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $designation = $_POST['designation'];
    $course_id = $_POST['CourseID'];
    $gender = $_POST['gender'];
    $password =password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "INSERT INTO Lecturer (Name, Email, Designation, CourseID, Gender, Password)
            VALUES ('$name', '$email', '$designation', '$course_id', '$gender', '$password')";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php?msg=New record created successfully"); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Registration</title>
    <link rel="stylesheet" href="login3.css">
    <link rel="stylesheet" href="dpt.css">
    <link rel="stylesheet" href="reg2.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            background-color: #f4f4f4;
            background-image: url('images/unnamed.jpg'); /* Replace with your image URL */
            background-size: cover; /* Ensures the image covers the entire screen */
            background-position: center; /* Centers the image */
            background-attachment: fixed; /* Keeps the background fixed when scrolling */
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin: 10px 0 5px;
        }

        input, textarea, button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        button {
            background-color: #008080;
            color: white;
            border: none;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background-color: #005959;
        }
        .logout-button {
    position: fixed; /* Fix position on the screen */
    bottom: 100px;    /* Distance from the bottom */
    right: 20px;     /* Distance from the right */
    background-color: #008080; /* Button background color */
    color: white;    /* Text color */
    padding: 10px 20px; /* Padding for the button */
    border: none;    /* No border */
    border-radius: 5px; /* Rounded corners */
    text-decoration: none; /* Remove underline */
    font-weight: bold; /* Bold text */
    cursor: pointer; /* Pointer cursor */
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2); /* Slight shadow */
    transition: transform 0.3s ease; /* Smooth transformation */
}

.logout-button:hover {
    animation: shake 0.5s; /* Apply shake animation */
    animation-iteration-count: 1; /* Shake only once */
}

    </style>
    
    
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
    <form method="POST" action="">
    <h1><b> Lecture Registartion </b></h1>
    
        <label for="name">Name in Full:</label><br>
        <input type="text" id="name" name="name" required><br>

        <label for="email">Email:</label><br>
       <input type="email" id="email" name="email" required pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$" 
       title="Please enter a valid email address."><br> 


        <label for="designation">Designation:</label><br>
        <select id="designation" name="designation">
            <option value="Assistant Lecturer">Assistant Lecturer</option>
            <option value="Lecturer">Lecturer</option>
            <option value="Senior Lecturer I">Senior Lecturer I</option>
            <option value="Senior Lecturer II">Senior Lecturer II</option>
        </select><br>

        <label for="course">Course:</label><br>
        <select id="course" name="CourseID">
        <?php
            include "dbconnection.php";
            $result = $conn->query("SELECT CourseID, Title FROM Course");
            while ($row = $result->fetch_assoc()) {
                echo "<option value='" . $row['CourseID'] . "'>" . $row['Title'] . "</option>";
            }
            $conn->close();
            ?>
        </select><br>

        <label for="gender">Gender:</label><br>
        <select id="gender" name="gender">
            <option value="Male">Male</option>
            <option value="Female">Female</option>
        </select><br>

        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>

        <button type="submit">Register Lecturer</button>
    </form>
    </main>
    <a href="logout.php" class="logout-button">Logout</a>
</body>

</html>
	
 
	