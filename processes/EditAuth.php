<?php
// EditAuth.php

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

// Process form submission for editing author details
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['editAuthor'])) {
    try {
        // Create connection using PDO
        $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);

        // Set the PDO error mode to exception
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Prepare the SQL statement to update author details
        $stmt = $conn->prepare("UPDATE your_table_name SET AuthorFullName = :authorFullname, AuthorEmail = :authoremail, AuthorAddress = :authoraddress, AuthorBiography = :authorBiography, AuthorDateOfBirth = :authorDateOfBirth, AuthorSuspended = :authorSuspended WHERE AuthorId = :authorId");

        // Bind parameters
        $stmt->bindParam(':authorId', $_POST['authorId']);
        $stmt->bindParam(':authorFullname', $_POST['authorFullname']);
        $stmt->bindParam(':authoremail', $_POST['authoremail']);
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

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Author - DBT</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>

    <h2>Edit Author</h2>

    <?php if (isset($author)): ?>
        <form action="EditAuth.php" method="POST">
            <input type="hidden" name="authorId" value="<?php echo $author['AuthorId']; ?>">

            <label for="authorFullname">Fullname:</label>
            <input type="text" name="authorFullname" value="<?php echo $author['AuthorFullName']; ?>" required><br>

            <label for="authoremail">Email:</label>
            <input type="email" name="authoremail" value="<?php echo $author['AuthorEmail']; ?>"><br>

            <label for="authoraddress">Address:</label>
            <input type="text" name="authoraddress" value="<?php echo $author['AuthorAddress']; ?>" required><br>

            <label for="authorBiography">Biography:</label>
            <textarea name="authorBiography" rows="4"><?php echo $author['AuthorBiography']; ?></textarea><br>

            <label for="authorDateOfBirth">Date of Birth:</label>
            <input type="date" name="authorDateOfBirth" value="<?php echo $author['AuthorDateOfBirth']; ?>" required><br>

            <label for="authorSuspended">Suspended:</label>
            <input type="checkbox" name="authorSuspended" <?php echo ($author['AuthorSuspended'] == 1) ? 'checked' : ''; ?>><br>

            <input type="submit" name="editAuthor" value="Save Changes">
        </form>
    <?php else: ?>
        <p>No author selected for editing.</p>
    <?php endif; ?>

</body>
</html>
