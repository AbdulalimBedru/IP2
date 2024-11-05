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

        /* Improved file input styling */
        .file-input input[type="file"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
    </style>
</head>
<body>
    <h2>Registration Form</h2>
    <form method="post" enctype="multipart/form-data" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <div class="file-input">
            <label for="file1">File 1 (Optional):</label>
            <input type="file" id="file1" name="file1">
            <?php if (isset($errors['file1'])) : ?>
                <span class="error"><?php echo $errors['file1']; ?></span>
            <?php endif; ?>
        </div>

        <div class="file-input">
            <label for="file2">File 2 (Required):</label>
            <input type="file" id="file2" name="file2" required>
            <?php if (isset($errors['file2'])) : ?>
                <span class="error"><?php echo $errors['file2']; ?></span>
            <?php endif; ?>
        </div>

        <div class="file-input">
            <label for="file3">File 3 (Multiple Files):</label>
            <input type="file" id="file3" name="file3[]" multiple>
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

        // ... (your existing PHP code for file 1 and file 2)

        // File 3 (multiple files)
        if (isset($_FILES['file3'])) {
            $files = $_FILES['file3'];
            for ($i = 0; $i < count($files['name']); $i++) {
                $targetFile = 'uploads/' . basename($files['name'][$i]);
                if (move_uploaded_file($files['tmp_name'][$i], $targetFile)) {
                    echo "File " . ($i + 1) . " uploaded successfully!";
                } else {
                    $errors['file3'] = "Error uploading File " . ($i + 1) . ".";
                    break;
                }
            }
        }
    }
    ?>
</body>
</html>