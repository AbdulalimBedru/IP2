<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Form</title>
    <style>
        /* ... your existing CSS styles ... */

        /* Additional CSS for file input and error handling */
        .file-input {
            margin-bottom: 10px;
        }

        .error {
            color: red;
            font-size: 12px;
            margin-top: 5px;
        }
    </style>
</head>
<body>
    <h2>Registration Form</h2>
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="file-input">
            <label for="file1">File 1:</label>
            <input type="file" id="file1" name="file1">
            <?php if (isset($errors['file1'])) : ?>
                <span class="error"><?php echo $errors['file1']; ?></span>
            <?php endif; ?>
        </div>

        <div class="file-input">
            <label for="file2">File 2:</label>
            <input type="file" id="file2" name="file2">
            <?php if (isset($errors['file2'])) : ?>
                <span class="error"><?php echo $errors['file2']; ?></span>
            <?php endif; ?>
        </div>

        <div class="file-input">
            <label for="file3">File 3:</label>
            <input type="file" id="file3" name="file3">
            <?php if (isset($errors['file3'])) : ?>
                <span class="error"><?php echo $errors['file3']; ?></span>
            <?php endif; ?>
        </div>

        <input type="submit" value="Submit">
    </form>

    <?php
    // PHP code to handle file uploads and error handling

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $errors = [];

        // File 1
        if ($_FILES['file1']['error'] === UPLOAD_ERR_OK) {
            $targetFile1 = 'uploads/' . basename($_FILES['file1']['name']);
            if (move_uploaded_file($_FILES['file1']['tmp_name'], $targetFile1)) {
                echo "File 1 uploaded successfully!";
            } else {
                $errors['file1'] = "Error uploading File 1.";
            }
        } else {
            $errors['file1'] = "Error uploading File 1.";
        }

        // File 2 and File 3 (similar to File 1)
        // ...

    }
    ?>
</body>
</html>