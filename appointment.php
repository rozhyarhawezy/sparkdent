<?php
$conn = mysqli_connect('localhost', 'root', '', 'appointment_db') or die('connection failed');

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $age = (int)$_POST['age'];
    $dentist = mysqli_real_escape_string($conn, $_POST['dentist']);
    $number = mysqli_real_escape_string($conn, $_POST['number']);
    $date = $_POST['date'];
    $time = $_POST['time'];

    // Check if the same dentist has an appointment at the same time and date
    $check_appointment = mysqli_query($conn, "SELECT * FROM `appointments` WHERE dentist = '$dentist' AND date = '$date' AND time = '$time'");

    if (mysqli_num_rows($check_appointment) > 0) {
        $message[] = 'Sorry, this time slot is already booked for ' . $dentist;
    } else {
        // If no appointment exists, insert the new appointment
        $insert = mysqli_query($conn, "INSERT INTO `appointments` (name, age, dentist, number, date, time) 
        VALUES ('$name', '$age', '$dentist', '$number', '$date', '$time')") or die('query failed');

        if ($insert) {
            $message[] = 'Appointment made successfully!';
        } else {
            $message[] = 'Appointment failed';
        }
    }
}

// Handle appointment cancellation
if (isset($_POST['cancel'])) {
    $cancel_number = mysqli_real_escape_string($conn, $_POST['cancel_number']);

    // Check if an appointment exists for this phone number
    $check_cancel = mysqli_query($conn, "SELECT * FROM appointments WHERE number = '$cancel_number'");

    if (mysqli_num_rows($check_cancel) > 0) {
        // Delete the appointment from the database
        $delete_cancel = mysqli_query($conn, "DELETE FROM appointments WHERE number = '$cancel_number'");

        if ($delete_cancel) {
            $message[] = 'Appointment for phone number ' . $cancel_number . ' has been deleted successfully.';
        } else {
            $message[] = 'Failed to delete the appointment. Please try again later.';
        }
    } else {
        $message[] = 'No scheduled appointment found for this phone number.';
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SparkDent | Online Appointment</title>
    <link rel="icon" href="img/logo.png" type="image/png">

    <link  rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">
    <link rel="stylesheet" href="css/appointment.css">
</head>

<body>
<section class="contact" id="contact">
    <h1 class="heading"><i class="fas fa-calendar-check"></i>  <span class="line-down">SparkDent</span> online booking appointment</h1>

    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <?php
        if (isset($message)) {
            foreach ($message as $msg) {
                echo '<p class="message">' . $msg . '</p>';
            }
        }
        ?>
        <span>Your Name: </span>
        <input type="text" name="name" placeholder="Enter your name" class="box" required>
        <span>Your Age: </span>
        <input type="number" name="age" placeholder="Enter your age" class="box" required>
        <span>Select Dentist: </span>
        <select name="dentist" class="box" required>
            <option value="" disabled selected>Select a dentist</option>
            <option value="Dr. Smith">Dr. Smith</option>
            <option value="Dr. Johnson">Dr. Johnson</option>
            <option value="Dr. Brown">Dr. Brown</option>
            <option value="Dr. Davis">Dr. Davis</option>
            <option value="Dr. Miller">Dr. Miller</option>
            <option value="Dr. Wilson">Dr. Wilson</option>
        </select>
        <span>Your Phone Number: </span>
        <input type="text" name="number" placeholder="Enter your phone number" class="box" required>
        <span>Appointment Date: </span>
        <input type="date" name="date" class="box" required>
        <span>Appointment Time: </span>
        <select name="time" class="box" required>
            <option value="" disabled selected>Select a time</option>
            <option value="2:00 PM">2:00 PM</option>
            <option value="3:00 PM">3:00 PM</option>
            <option value="4:00 PM">4:00 PM</option>
            <option value="5:00 PM">5:00 PM</option>
            <option value="6:00 PM">6:00 PM</option>
            <option value="7:00 PM">7:00 PM</option>
        </select>
        <input type="submit" value="Make Appointment" name="submit" class="link-btn">
    </form>
</section>

<!-- Cancellation Form -->

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" 
      style="max-width: 400px; margin: 25px auto; padding: 20px; border-radius: 10px; background-color: #f6e4d5; 
             box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); text-align: center;">
    <span style="display: block; font-size: 1.5rem; color: #555; margin-bottom: 8px;">
       to cancel Appointment: Enter the Phone Number
    </span>
    <input type="text" name="cancel_number" placeholder="filled with the phone number" 
           style="width: 100%; padding: 10px; margin-bottom: 15px; border: 1px solid #ccc; border-radius: 5px; font-size: 1rem;" 
           required>
    <input type="submit" value="Cancel Appointment" name="cancel" 
           style="background-color: #e63946; color: white; padding: 10px 20px; border: none; border-radius: 5px; 
                  font-size: 1.2rem; cursor: pointer; transition: background-color 0.3s ease;"
           onmouseover="this.style.backgroundColor='#d62839';" onmouseout="this.style.backgroundColor='#e63946';">
</form>


</body>
</html>
