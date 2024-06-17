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
        body{
            font-family: Arial, Helvetica, sans-serif;
        }
    </style>
    <table>
        <tr>
            <th>First Name</th><th>Last Name</th><th>Email</th><th>Location</th><th>Description</th><th>Completed</th>
        </tr>
    <?php
        
      //database connection variables for the database on your web server
      $servername = "localhost"; //you can leave server name as localhost, as the database is on the same server as apache. 
      $username = "job_management_username_2024";
      $password = "job_management_password_2024";
      $database = "job_management_name_2024";

        //we start a try and catch block to attempt to connect to our database and run the query. If it fails, we see the error/exception generated by the catch
        try {
            $conn = new PDO("mysql:host=$servername;dbname=$database", $username, $password); //building a new PDO connection object
            
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // set the PDO error mode to exception
            
            //Selecting multiple rows from a MySQL database using the PDO::query function.
            //Sorting the data by the ID field and limiting the results to the last 50 for the purpose of this example
            $sql = "SELECT * FROM jobs_table ORDER BY id DESC LIMIT 50";
            
            //For each result that we return, loop through the result and perform the echo statements.
            //Data will be formatted into a table
            //$row is an array with the fields for each record returned from the SELECT
                foreach($conn->query($sql, PDO::FETCH_ASSOC) as $row){
                    echo '<tr>';
                    echo '<td>'. $row['first_name'] . '</td>';
                    echo '<td>'. $row['last_name'] . '</td>';
                    echo '<td>'. $row['email'] . '</td>';
                    echo '<td>'. $row['location'] . '</td>';
                    echo '<td>'. $row['description'] . '</td>';
                    echo '<td>'. $row['completed'] . '</td>';
                    
                    echo '</tr>';
                }
            
            }
        catch(PDOException $e)
            {
            echo "Error" . $e->getMessage(); //If we are not successful we will see an error
            }
        ?>

        </table>
</body>
</html>
