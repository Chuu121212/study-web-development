<!-- sample8.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Form Submission</title>
</head>
<body>

<?php
if (isset($_POST['name']) && $_POST['name'] !== '') {
    $name = htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8');
    echo "<p>Value sent: $name</p>";
} else {
?>

    <form action="sample8.php" method="post">
        <label for="name">Enter your name:</label>
        <input type="text" id="name" name="name" required>
        <input type="submit" value="Submit">
    </form>

<?php
}
?>

</body>
</html>
