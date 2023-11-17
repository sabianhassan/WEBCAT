<?php
// DelAuth.php

// Include the file with your database connection details

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['authorId'])) {
    require_once "configs/constants.";

    try {
        // Create connection using PDO
        $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to select details of the selected author
        $stmt = $conn->prepare("SELECT * FROM your_table_name WHERE AuthorId = :authorId");

        // Bind parameters
        $stmt->bindParam(':authorId', $_GET['authorId']);

        // Execute the statement
        $stmt->execute();

        // Fetch the author details
        $author = $stmt->fetch(PDO::FETCH_ASSOC);

        // Close the connection
        $conn = null;
    } catch (PDOException $e) {
        // Handle database errors
        echo "Error: " . $e->getMessage();
        // You might want to log the error or handle it in some way appropriate for your application
    }
}

// Process form submission for deleting author
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deleteAuthor'])) {
    try {
        // Create connection using PDO
        $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to delete the selected author
        $stmt = $conn->prepare("DELETE FROM your_table_name WHERE AuthorId = :authorId");

        // Bind parameters
        $stmt->bindParam(':authorId', $_POST['authorId']);

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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delete Author - DBT</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

    <h2>Delete Author</h2>

    <?php if (isset($author)): ?>
        <form action="DelAuth.php" method="POST">
            <input type="hidden" name="authorId" value="<?php echo $author['AuthorId']; ?>">
            <p>Are you sure you want to delete the author "<?php echo $author['AuthorFullName']; ?>"?</p>
            <input type="submit" name="deleteAuthor" value="Delete Author">
        </form>
    <?php else: ?>
        <p>No author selected for deletion.</p>
    <?php endif; ?>

</body>
</html>
