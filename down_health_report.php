<?php
     include_once('connection.php'); 

    //check form is submitted or not
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // get the entered email address
        $email = $_POST["email"];

        // fetch the information based on the email
        $sql = "SELECT * FROM users WHERE email = '$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            // retrieve information
            $name = $row["name"];
            $age = $row["age"];
            $weight = $row["weight"];
            $file_name = $row["file_name"];
            $file_path = "uploads/" . $file_name;
            echo "$file_name";
            if (file_exists($file_path)) {
                   // download PDF file 
                    header("Content-Type: application/pdf");
                    header("Content-Disposition: attachment; filename=\"$file_name\"");
                    readfile($file_path);
            } 
            else {
                echo "Health report not found.";
            }
        } else {
            echo "Email not found.";
        }  
    }
    // close database connection
    $conn->close();
?>
<html>
    <head>
        <title>Ptaient Health Report</title>
        <link rel="stylesheet" type="text/css" href="stylesheet.css">
    </head>
    <body>
        <div class="container">
            <h1>Fetch User Health Report</h1>
            <form method="POST">
                <label for="email">Email:</label>
                <input type="email" name="email" required>
                <input type="submit" style="background-color: #3e533e;" value="Download Health Report">
            </form>
        </div>
    </body>
</html>

