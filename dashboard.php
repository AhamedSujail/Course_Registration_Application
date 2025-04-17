<?php
session_start();

if (!isset($_SESSION['name'])) {
    header("Location: login form.php"); // Redirect to login if not logged in
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lecturer Details</title>
    <link rel="stylesheet" href="login3.css">
    <link rel="stylesheet" href="dpt.css">

    <style>
  /* Center the table on the page */
  .table-container {
    margin: 0 auto; /* Centers the table horizontally */
    width: 70%; /* Adjust width as needed */
    border-collapse: collapse;
    font-family: Arial, sans-serif;
    font-size: 14px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1); /* Adds a subtle shadow */
  }

  /* Table header styling */
  .table-container thead {
    background-color: #008080;
    color: #fff; /* White text */
    text-transform: uppercase;
    font-weight: bold;
  }

  /* Table cells styling */
  .table-container th, .table-container td {
    border: 1px solid #ddd;
    text-align: center;
    padding: 8px;
  }

  /* Alternating row colors */
  .table-container tbody tr:nth-child(even) {
    background-color: #f9f9f9;
  }

  .table-container tbody tr:nth-child(odd) {
    background-color: #ffffff;
  }

  /* Hover effect for rows */
  .table-container tbody tr:hover {
    background-color: #f1f1f1;
  }

  /* Links inside the Action column */
  .table-container a {
    text-decoration: none;
    color: #007BFF; /* Bootstrap blue */
    font-weight: bold;
    margin: 0 5px; /* Spacing between links */
  }

  .table-container a:hover {
    text-decoration: underline;
    color: #0056b3; /* Darker blue on hover */
  }
</style>
</head>

<body>
    
    <header>
        <nav>
          <?php
             echo "<b><a style='font-size: 24px;'> " . $_SESSION['name'] . "</a>","</b>";
          ?>
            
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
    
   
    <h2 style="color: white;">Lecturer Information</h2>
            <table  class="table-container"> 
					  <thead>
					    <tr>
					       <td><strong>Lecturer ID</strong></td> 
                            <td><strong>Full Name</strong></td>
						     <td><strong>Email</strong></td>
						     <td><strong>Designation</strong></td>
                             <td><strong>Course</strong></td>
                             <td><strong>Gender</strong></td>
                             <td><strong>Option</strong></td>
					    </tr>
					 </thead>
					 
					 <tbody>
                     <?php
					   include 'dbconnection.php';

                  $sql = "SELECT Lecturer.LecID, Lecturer.Name, Lecturer.Email, Lecturer.Designation, Course.Title AS Course, Lecturer.Gender 
                  FROM Lecturer 
                  JOIN Course ON Lecturer.CourseID = Course.CourseID";
                       $result = $conn->query($sql);
             
                  while ($row = mysqli_fetch_assoc($result)) {
						 ?> 
								      <tr>
					                <td> <?php echo $row['LecID'] ?> </td> 
                                    <td> <?php echo $row['Name'] ?> </td> 
                                    <td> <?php echo $row['Email'] ?> </td> 
                                    <td> <?php echo $row['Designation'] ?> </td> 
                                    <td> <?php echo $row['Course'] ?> </td> 
                                    <td> <?php echo $row['Gender'] ?> </td>
                                    
                                           
						              <td>
									        <center><a href = "edit.php?LecID=<?php echo $row['LecID']?>"</a>Edit |  
									        <a href = "delete.php?LecID=<?php echo $row['LecID']?>"</a>Delete
									        </center>
									        </td>
						            
					            </tr>
                  
                  
								<?php
								
							}
						?>
					   
					  
					 </tbody>
					</table>

          
    </main>
    <a href="logout.php" class="logout-button">Logout</a>

    <footer>
    <p> Sliate Sammanthurai.</p>
    </footer>
</body>

</html>