<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "appointment_db";

// Connect to the database
$connection = new mysqli($servername, $username, $password, $database);

// Check if the connection is successful
if ($connection->connect_error) {
    die("Connection failed: " . $connection->connect_error);
}

// Check if an ID is passed
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Retrieve the record to move
    $sql = "SELECT * FROM appointments WHERE id = $id";
    $result = $connection->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Insert into done_appointments
        $insert_sql = "INSERT INTO done_appointments (id, name, age, dentist, number, date, time)
                       VALUES ('{$row['id']}', '{$row['name']}', '{$row['age']}', '{$row['dentist']}', '{$row['number']}', '{$row['date']}', '{$row['time']}')";
        $connection->query($insert_sql);

        // Delete from appointments
        $delete_sql = "DELETE FROM appointments WHERE id = $id";
        $connection->query($delete_sql);

        // Redirect back to admin.php
        header("Location: admin.php");
        exit;
    } else {
        echo "Record not found.";
    }
} else {
    echo "";
}

$connection->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SparkDent | Admin</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="../img/logo.png" type="image/png">


    <style>

/* Media Queries */

@media (max-width: 1200px) {
    .header {
        padding: 2rem;
    }
    section {
        padding: 3rem 2rem;
    }
    .home .content h3 {
        font-size: 4rem;
    }
}

@media (max-width: 991px) {
    html {
        font-size: 55%;
    }
}

@media (max-width: 768px) {
    #menu-btn {
        display: inline-block;
        transition: 0.2s linear;
    }
    #menu-btn.fa-times {
        transform: rotate(180deg);
    }
    .header .btn {
        display: none;
    }
    .header .navbar {
        position: absolute;
        top: 99%;
        left: 0;
        right: 0;
        border-top: 1px solid #ddd; /* Replace with your border style */
        background: #fff; /* Replace with your white color */
        display: none;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 0);
        transition: 0.2s linear;
    }
    .header .navbar.active {
        display: block;
        clip-path: polygon(0 0, 100% 0, 100% 100%, 0 100%);
    }
    .header .navbar a {
        display: block;
        margin: 0;
        padding: 1.5rem 2rem;
    }
}

@media (max-width: 450px) {
    html {
        font-size: 50%;
    }
    .heading h1 {
        font-size: 3rem;
    }
}


</style>

</head>



<body style="margin: 50px">
    <br>
    <h1>SparkDent | Completed Appointments</h1>
    <br>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Age</th>
                <th>Dentist</th>
                <th>Phone number</th>
                <th>Date</th>
                <th>Time</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $connection = new mysqli($servername, $username, $password, $database);
            $sql = "SELECT * FROM done_appointments";
            $result = $connection->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['id']}</td>
                            <td>{$row['name']}</td>
                            <td>{$row['age']}</td>
                            <td>{$row['dentist']}</td>
                            <td>{$row['number']}</td>
                            <td>{$row['date']}</td>
                            <td>{$row['time']}</td>
                          </tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No completed appointments.</td></tr>";
            }
            $connection->close();
            ?>
        </tbody>
    </table>
</body>
</html>

