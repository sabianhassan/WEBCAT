<?php 
  require_once "configs/constants.php";

  try {
    // Create connection using PDO
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Return the PDO connection
    return $conn;
  } catch (PDOException $e) {
    // Handle connection errors
    echo "Connection failed: " . $e->getMessage();
    // You might want to log the error or handle it in some way appropriate for your application
  }
?>
