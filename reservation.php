<?php
// Database connection parameters
$host = 'your_host';
$dbname = 'mydatabase.cdomewoo8zqw.us-east-1.rds.amazonaws.com';
$username = 'admin';
$password = 'Pavan123';

try {
    // Connect to the database
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Set PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Handle form submission (booking)
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["book"])) {
        // Sanitize and validate input (ensure proper validation and sanitization)
        $passengerName = $_POST["passenger_name"];
        $departureDate = $_POST["departure_date"];
        $returnDate = $_POST["return_date"];
        $destination = $_POST["destination"];

        // Insert data into the database table
        $sql = "INSERT INTO PASSENGER (NAME, DEPARTURE_DATE, RETURN_DATE, DESTINATION) 
                VALUES (:passengerName, :departureDate, :returnDate, :destination)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':passengerName', $passengerName);
        $stmt->bindParam(':departureDate', $departureDate);
        $stmt->bindParam(':returnDate', $returnDate);
        $stmt->bindParam(':destination', $destination);
        $stmt->execute();

        // Optionally, you can provide feedback to the user after the data has been inserted
        echo "Booking successful!";
    }
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
