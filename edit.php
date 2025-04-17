<?php
 
include "dbconnection.php";
$LecID=$_GET["LecID"];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $designation = $_POST['designation'];
    $course_id = $_POST['course'];
    $gender = $_POST['gender'];
    $password =password_hash($_POST['password'], PASSWORD_DEFAULT);

    $sql = "UPDATE `Lecturer` SET `Name`='$name',`Email`='$email',`Designation`='$designation',
    `CourseID`='$course_id',`Gender`='$gender',`Password`='$password' WHERE LecID='$LecID'";

    if ($conn->query($sql) === TRUE) {
        header("Location: dashboard.php?msg=Updated successfully"); 
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Fetch courses for the dropdown
$courses = $conn->query("SELECT CourseID, Title FROM Course");
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ureka Hospitals (Pvt) Ltd</title>
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

    <?php
				include "dbconnection.php";
	  
				$sql = "SELECT * FROM `Lecturer` where LecID= '$LecID' LIMIT 1";
				$result = $conn->query($sql);
             
                $row = mysqli_fetch_assoc($result);
				
		?>

<main>
    <form method="POST" action="">
    <h1><b> Lecture Registartion </b></h1>
    
        <label for="name">Name in Full:</label><br>
        <input type="text" id="name" name="name" value='<?php echo $row['Name'] ?>' required><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" value='<?php echo $row['Email'] ?>' required><br>

        <label for="designation">Designation:</label><br>
        <select id="designation" name="designation" >
        <option value="Assistant Lecturer" <?= $row['Designation'] == 'Assistant Lecturer' ? 'selected' : '' ?>>Assistant Lecturer</option>
            <option value="Lecturer" <?= $row['Designation'] == 'Lecturer' ? 'selected' : '' ?>>Lecturer</option>
            <option value="Senior Lecturer I" <?= $row['Designation'] == 'Senior Lecturer I' ? 'selected' : '' ?>>Senior Lecturer I</option>
            <option value="Senior Lecturer II" <?= $row['Designation'] == 'Senior Lecturer II' ? 'selected' : '' ?>>Senior Lecturer II</option>
        </select><br>

        <label for="course">Course:</label><br>
        <select id="course" name="course" value='<?php echo $row['CourseID'] ?>'>
        <?php while ($row = $courses->fetch_assoc()): ?>
                <option value="<?= $row['CourseID'] ?>" <?= $row['CourseID'] == $row['CourseID'] ? 'selected' : '' ?>>
                    <?= $row['Title'] ?>
                </option>
            <?php endwhile; ?>
        </select><br>

        <label for="gender">Gender:</label><br>
        <select id="gender" name="gender" value='<?php echo $row['Gender'] ?>'>
        <option value="Male" <?= $row['Gender'] == 'Male' ? 'selected' : '' ?>>Male</option>
        <option value="Female" <?= $row['Gender'] == 'Female' ? 'selected' : '' ?>>Female</option>
        </select><br>


        <button type="submit">UPDATE</button>
    </form>
    </main>
    <a href="logout.php" class="logout-button">Logout</a>
</body>

</html>