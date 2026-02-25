<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SparkDent | Admin </title>

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


<div class="container my-5">
<h1>SparkDent | List of Patience</h1>
<a class="btn btn-primary" href="../appointment.php" target="_blank" role="button">Add Patience</a>
<br>
</div>


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
                <th>Action</th>
            </tr>
        </thead>

       <tbody>

       
        <?php

        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "appointment_db";

        // connecting database

        $connection = new mysqli($servername, $username, $password, $database);

        // checking if connected or not
    if ($connection->connect_error){
        die("connection failed: " . $connection->connect_error);
    }

    // read all row from database table
    $sql = "SELECT * FROM appointments";
    $result = $connection->query($sql);

    if(!$result){
        die ("Invalid query: " .$connection->error);
    }

    // read data from each row
    while($row = $result->fetch_assoc()) 
    {
        echo "<tr>
        <td>" . $row["id"] ."</td>
        <td>". $row["name"] ."</td>
        <td>". $row["age"] ."</td>
        <td>". $row["dentist"] ."</td>
        <td>". $row["number"] ."</td>
        <td>". $row["date"] ."</td>
         <td>". $row["time"] ."</td>

         <td>
       <a class='btn btn-primary btn-sm'  style='background-color:rgb(10, 183, 120); border-color: #F0FFF0; color: #F0FFF0;' 
       href='done.php?id={$row["id"]}'>Done</a>

        </td>
        </tr>";

    }   
        ?>
         
      </tbody>
    </table>
 
    <a class='btn btn-primary btn-sm' href="done.php" target="_blank">look for done appointments</a>
    
</body>
</html>