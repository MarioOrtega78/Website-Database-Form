<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Update Job</title>
    
    <style>
    body {
        font-family: tahoma;
        background-color: #eee;
    }
    input[type=submit] {
        font-size: 110%;
        background-color: green;
        color: white;
        border-radius: 4px;
    }
    select {
        width: 100%;
        padding: 16px 20px;
        border: none;
        border-radius: 4px;
        background-color: #fff;
        font-size: 110%;
        margin: 5px 0 5px 0;
        border: 1px solid #333;
    }
    </style>
</head>
<body>
    <?php
        // Database connection variables for the new database
        $servername = "localhost";
        $username = "job_management_username_2024";
        $password = "job_management_password_2024";
        $database = "job_management_name_2024";

        try {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') { // The update / submit button has been pressed
                $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); // Building a new connection object
                // Set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                
                $id = $_POST['id']; // The ID of the job we wanted to edit from the hidden form field
                $completed = $_POST['completed']; // Completed status from $_POST

                $sql = $conn->prepare("UPDATE jobs_table SET completed = ? WHERE id = ?");
                $sql->bindValue(1, $completed); // Bind this variable to the first ? in the SQL statement
                $sql->bindValue(2, $id); // Bind this value to the second ? in the SQL statement
                
                $sql->execute(); // Execute the statement

                echo "Job updated";
            } else {
                $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); // Building a new connection object
                // Set the PDO error mode to exception
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $id = $_GET['id']; // The ID of the job we want to edit from the URL
                
                $sql = $conn->prepare("SELECT * FROM jobs_table WHERE id = ?");
                $sql->bindValue(1, $id); // Bind this variable to the first ? in the SQL statement

                $sql->execute(); // Execute the statement

                $row = $sql->fetch();
                
                // Pre-populate drop down logic
                if ($row['completed'] == 'no') {
                    $no_completed = 'selected = "selected"';
                } else {
                    $no_completed = '';
                }

                if ($row['completed'] == 'yes') {
                    $yes_completed = 'selected = "selected"';
                } else {
                    $yes_completed = '';
                }

                // Information about the job
                echo $row['id'] . '<br>';
                echo $row['first_name'] . '<br>';
                echo $row['last_name'] . '<br>';
                echo $row['email'] . '<br>';
                echo $row['location'] . '<br>';
                echo $row['description'] . '<br>';
                echo $row['completed'] . '<br>';

                // Include the form for updating the job
                include "update_job_form.php";

                echo '<hr><br>';
            }
        } catch (PDOException $e) {
            echo $sql . "<br>" . $e->getMessage(); // If we are not successful in connecting or running the query we will see an error
        }
    ?>
</body>
</html>
