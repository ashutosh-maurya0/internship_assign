<?php
    include_once('connection.php');
    //check form is submitted or not
        if (isset($_POST["search"])) {
        // get the search query
        $search_email = $_POST["search_email"];

        // fetch the information based on the email
        $sql = "SELECT * FROM users WHERE email = '$search_email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<script type='text/javascript'>alert('Report Found!')</script>";
                echo "<div class=''>";            
                echo "<table border='2' align=''>
                    <H2 align='center'> </h2>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Weight</th>
                        <th>Email</th>
                        <th>Health Report</th>
                    </tr>";
                echo "<tr>";
                echo "<td>" . $row['name'] . "</td>";
                echo "<td>" . $row['age'] . "</td>";
                echo "<td>" . $row['weight'] . "</td>";
                echo "<td>" . $row['email'] . "</td>";
                echo "<td>" . $row['file_name'] . "</td>";
                echo "</tr>";
                echo "</div>";
            }
        } else {
            echo "<div class='container'>";
                echo "<script type='text/javascript'>alert('Not Found!')</script>";
            echo "</div>";
        }
    }
    // close database connection
    $conn->close();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ptaient Details</title>
    <link rel="stylesheet" type="text/css" href="stylesheet.css">
</head>
<body>
    <div class="container">
        <h1>Fetch User Health Report</h1>
        <form method="POST">
            <label for="search_email">Email:</label>
            <input type="email" name="search_email" required>
            <input type="submit" style="background-color: #3e533e;" name="search" value="Search">
        </form>
    </div><br /><br /><br /><br />
</body>
</html>


