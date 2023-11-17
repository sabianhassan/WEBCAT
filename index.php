<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home - DBT</title>
    <link rel="stylesheet" href="css/style.css" />
</head>
<body>
    
<h3>Author Details</h3>
<form action="process-form.php" method="POST">
     <!-- AuthorId (PK) - Assuming it's auto-incremented in the database -->
    <label for="authorFullname">Fullname:</label><br>
    <input type="text" name="authorFullname" id="authorFullname" placeholder="Enter the author-Fullname" maxlength="60" required /><br><br>

    <label for="authorEmail"> Email:</label><br>
    <input type="email" name="authorEmail" id="authoremail" placeholder="Enter the author-Email" maxlength="60" /><br><br>

    <label for="authoraddress">Address:</label><br>
    <input type="text" name="authoraddress" id="authoraddress" placeholder="Enter the author-address" maxlength="160" required /><br><br>

    <label for="authorBiography">Biography:</label><br>
    <textarea name="authorBiography" id="authorBiography" placeholder="Enter the Biography" rows="4" required></textarea><br><br>

    <label for="authorDateOfBirth">Date of Birth:</label>
    <input type="date" id="authorDateOfBirth" name="authorDateOfBirth" required><br>

    <label for="authorSuspended">Suspended:</label>
    <input type="checkbox" id="authorSuspended" name="authorSuspended"><br>


    <input type="submit" name="send_message" value="Send Message" />
</form>

    </div>
    

</body>
</html>
