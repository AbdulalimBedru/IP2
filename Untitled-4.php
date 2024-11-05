<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* ... your existing CSS styles ... */
    </style>
</head>
<body>
    <h2>Registration Form</h2>
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="file1">File 1:</label>
        <input type="file" id="file1" name="file1">

        <label for="file2">File 2:</label>
        <input type="file" id="file2" name="file2">

        <label for="file3">File 3:</label>
        <input type="file" id="file3" name="file3">

        <input type="submit" value="Submit">
    </form>

    </body>
</html>