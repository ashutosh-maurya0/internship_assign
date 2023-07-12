<?php
    include_once('connection.php'); 
    //check form is submitted or not
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        //get user details from form
        $name = $_POST["name"];
        $age = $_POST["age"];
        $weight = $_POST["weight"];
        $email = $_POST["email"];

        //get the details of uploaded file 
        $file_name = $_FILES["pdf"]["name"];
        $file_tmp = $_FILES["pdf"]["tmp_name"];

        //move uploaded file to a desired location
        $target_dir = "uploads/";
        $target_file = $target_dir . basename($file_name);
        move_uploaded_file($file_tmp, $target_file);

        //inserting user details and file information into database
        $sql = "INSERT INTO users (name, age, weight, email, file_name) VALUES ('$name', '$age', '$weight', '$email', '$file_name')";

        if ($conn->query($sql) === TRUE) {
            echo "<script type='text/javascript'>alert('submitted successfully!')</script>";
        } else {
            echo "<script type='text/javascript'>alert('failed!')</script>";
        }
    }
   
    // close database connection
    $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Fetch Health Report</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
    <body>
        <div class="container">
            <div class="box"> 
            <h1>Fetch Health Report</h1>
            <form method="POST"  enctype="multipart/form-data">
                <label for="name">Name</label>
                <input type="text" id="name" name="name" required>

                <label for="age">Age</label>
                <input type="number" id="age" name="age" required>

                <label for="weight">Weight</label>
                <input type="number" id="weight" name="weight" required>

                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>

                <label for="report">Upload Health Report</label>
                <input type="file" name="pdf" required><br><br>

                <input type="submit" style="background-color: #3e563f;" value="Submit">
            </form>
        </div>
        <div class="box">
            <h1>Fetch Health Report</h1>
            <a class="button" style="background-color: #3e533e;" href="down_health_report.php">Download</a>
            <a class="button" style="background-color: #3e533e;" href="view.php">Search</a>
        </div>
    </div>
    </body>
</html>
