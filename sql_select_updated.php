<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Viewing the jobs table</title>
</head>
<body>
    <style>
        body {
            font-family: Arial, Helvetica, sans-serif;
        }
        a.button {
            padding: 5px;
            background-color: green;
            color: white;
            border-radius: 3px;
            margin-top: 3px;
            display: block;
            width: 130px;
            text-decoration: none;
        }
        a.dbutton {
            padding: 5px;
            background-color: red;
            color: white;
            border-radius: 3px;
            margin-top: 3px;
            display: block;
            width: 130px;
            text-decoration: none;
        }
    </style>
    <table>
        <tr>
            <th>ID</th><th>First Name</th><th>Last Name</th><th>Email</th><th>Location</th><th>Description</th><th>Completed</th><th>Update</th><th>Delete</th>
        </tr>
    <?php
        // Database connection variables for the job management database
        $servername = "localhost";
        $username = "job_management_username_2024";
        $password = "job_management_password_2024";
        $database = "job_management_name_2024";

        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Selecting multiple rows from the jobs_table
            $sql = "SELECT * FROM jobs_table ORDER BY id DESC LIMIT 50";

            foreach ($conn->query($sql, PDO::FETCH_ASSOC) as $row) {
                echo '<tr>';
                echo '<td>' . $row['id'] . '</td>';
                echo '<td>' . $row['first_name'] . '</td>';
                echo '<td>' . $row['last_name'] . '</td>';
                echo '<td>' . $row['email'] . '</td>';
                echo '<td>' . $row['location'] . '</td>';
                echo '<td>' . $row['description'] . '</td>';
                echo '<td>' . $row['completed'] . '</td>';
                echo '<td><a href="update_job.php?id=' . $row['id'] . '" class="button">Update this job</a></td>';
                echo '<td><a href="delete_job.php?id=' . $row['id'] . '" class="dbutton" onclick="return confirm(\'Are you sure you want to delete this job?\');">Delete this job</a></td>';
                echo '</tr>';
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    ?>
    </table>
</body>
</html>
