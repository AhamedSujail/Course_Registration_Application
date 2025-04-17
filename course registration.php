<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login form.php"); // Redirect to login if not logged in
    exit();
}


include "dbconnection.php";
// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $titleInShort = $_POST['title_in_short'];
    $description = $_POST['description'];

    $sql = "INSERT INTO Course (Title, TitleInShort, Description) VALUES ('$title', '$titleInShort', '$description')";

    if ($conn->query($sql) === TRUE) {
        header("Location: course details.php?msg=New record created successfully");
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
    <title>Course Registration</title>
    <link rel="stylesheet" href="login3.css">
    <link rel="stylesheet" href="reg2.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            background-image: url('images/unnamed.jpg'); /* Replace with your image URL */
            background-size: cover; /* Ensures the image covers the entire screen */
            background-position: center; /* Centers the image */
            background-attachment: fixed; /* Keeps the background fixed when scrolling */
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
            margin-top: 20px;
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
    <div>
        
        <form method="POST" action="">
        <h1><b>Course Registration</b></h1>
            <label for="title">Course Title</label>
            <input type="text" id="title" name="title" placeholder="Enter course title" required>

            <label for="title_in_short">Title in Short</label>
            <input type="text" id="title_in_short" name="title_in_short" placeholder="Enter short title">

            <label for="description">Description</label>
            <textarea id="description" name="description" rows="4" placeholder="Enter course description"></textarea>

            <button type="submit">Register Course</button>
        </form>
    </div>
    <a href="logout.php" class="logout-button">Logout</a>
</body>

</html>
