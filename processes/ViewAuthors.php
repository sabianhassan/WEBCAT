<?php
// ViewAuthors.php

// Include the file with your database connection details
require_once "../configs/constants.php";

try {
    // Create connection using PDO
    $conn = new PDO("mysql:host=$hostname;dbname=$dbname", $username, $userpass);

    // Set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Prepare the SQL statement to select all authors in ascending order by AuthorFullName
    $stmt = $conn->prepare("SELECT * FROM authorstb ORDER BY authorFullName ASC");

    // Execute the statement
    $stmt->execute();

    // Fetch all rows
    $authors = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Close the connection
    $conn = null;
} catch (PDOException $e) {
    // Handle database errors
    echo "Error: " . $e->getMessage();
    // You might want to log the error or handle it in some way appropriate for your application
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Authors - DBT</title>

    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        h2 {
            color: #333;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:nth-child(even) {
            background-color: #f9f9f9;
        }

        tr:hover {
            background-color: #f5f5f5;
        }

        p {
            color: #555;
        }
    </style>
</head>
<body>

    <h2>View Authors</h2>

        <table>
            <tr>
                <th>Author Fullname</th>
                <th>Email</th>
                <th>Address</th>
                <th>Biography</th>
                <th>Date of Birth</th>
                <th>Suspended</th>
                <!-- Add more columns as needed -->
            </tr>
            <?php foreach ($authors as $author): ?>
                <tr>
                <td><?php echo isset($author['authorFullname']) ? $author['authorFullname'] : 'N/A'; ?></td>
                <td><?php echo isset($author['authorEmail']) ? $author['authorEmail'] : 'N/A'; ?></td>
                <td><?php echo isset($author['authoraddress']) ? $author['authoraddress'] : 'N/A'; ?></td>
                <td><?php echo isset($author['authorBiography']) ? $author['authorBiography'] : 'N/A'; ?></td>
                <td><?php echo isset($author['authorDateofBirth']) ? $author['authorDateofBirth'] : 'N/A'; ?></td>
                <td><?php echo isset($author['authorSuspended']) ? ($author['authorSuspended'] ? 'Yes' : 'No') : 'N/A'; ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    

</body>
</html>

</body>
</html>
