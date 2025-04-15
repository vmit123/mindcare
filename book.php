<?php
// Get data from form
$name = $_POST['name'];
$email = $_POST['email'];
$date = $_POST['date'];
$time = $_POST['time'];
$therapist = $_POST['therapist'];
$notes = $_POST['notes'];

// Create booking array
$booking = [
  "name" => $name,
  "email" => $email,
  "date" => $date,
  "time" => $time,
  "therapist" => $therapist,
  "notes" => $notes
];

// Load existing bookings or create a new array
$bookingsFile = "bookings.json";
if (file_exists($bookingsFile)) {
  $bookings = json_decode(file_get_contents($bookingsFile), true);
} else {
  $bookings = [];
}

// Add new booking
$bookings[] = $booking;

// Save to JSON file
file_put_contents($bookingsFile, json_encode($bookings, JSON_PRETTY_PRINT));

// Redirect to thank you page
header("Location: bthankyou.html");
exit();
?>
