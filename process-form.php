<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the file with your database connection details
    require_once "configs/constants.php";

    try {
        // Create connection using PDO
        $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to insert data into the database
        $stmt = $conn->prepare("INSERT INTO authorstb (authorFullname, authorEmail, authoraddress, authorBiography, authorDateOfBirth, authorSuspended) VALUES (:authorFullname, :authorEmail, :authoraddress, :authorBiography, :authorDateOfBirth, :authorSuspended)");

        // Bind parameters
        $stmt->bindParam(':authorFullname', $_POST['authorFullname']);
        $stmt->bindParam(':authorEmail', $_POST['authorEmail']);
        $stmt->bindParam(':authoraddress', $_POST['authoraddress']);
        $stmt->bindParam(':authorBiography', $_POST['authorBiography']);
        $stmt->bindParam(':authorDateOfBirth', $_POST['authorDateOfBirth']);
        
        // Check if the checkbox is checked
        $authorSuspended = isset($_POST['authorSuspended']) ? 1 : 0;
        $stmt->bindParam(':authorSuspended', $authorSuspended);

        // Execute the statement
        $stmt->execute();

        // Close the connection
        $conn = null;

        // Redirect to a success page or do something else
        header("Location: success.php");
        exit();
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        // You might want to log the error or handle it in some way appropriate for your application
    }
}
?>
