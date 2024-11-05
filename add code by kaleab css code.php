<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        /* General Form Style */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        form {
            width: 50%;
            margin: 20px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #007bff;
        }

        label {
            display: block;
            margin-top: 15px;
            color: #555;
        }

        input[type="text"], input[type="email"], input[type="password"], input[type="file"] {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        input[type="submit"], input[type="button"] {
            background: #007bff;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
        }

        /* Hover effect for buttons */
        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #0056b3;
        }

        .file-list {
            margin-top: 2em;
            text-align: center;
        }

        .file-item {
            margin: 10px 0;
        }

        .file-item button {
            background: #dc3545;
            color: #fff;
            padding: 5px 10px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .file-item button:hover {
            background-color: #a71d2a;
        }

        /* Flexbox for aligning items */
        form {
            display: flex;
            flex-direction: column;
        }

        label, input, button {
            align-self: center;
            max-width: 80%;
        }

        .file-list h3 {
            color: #28a745;
        }

        /* Customize file input style */
        input[type="file"] {
            color: #007bff;
        }

        /* Additional CSS for improved user experience */

        /* Responsive design */
        @media (max-width: 768px) {
            form {
                width: 90%;
            }
        }

        /* Clearer input labels */
        label {
            font-weight: bold;
        }

        /* Improved button styling */
        input[type="submit"] {
            padding: 15px 30px;
            font-size: 16px;
        }

        /* Error handling styles */
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
        <label for="name">Name:</label>
        <input type="text" id="name" name="name" value="<?php echo isset($_POST["name"]) ? $_POST["name"] : ""; ?>">

        <label for="address">Address:</label>
        <input type="text" id="address" name="address" value="<?php echo isset($_POST["address"]) ? $_POST["address"] : ""; ?>">

        <label for="age">Age:</label>
        <input type="text" id="age" name="age" value="<?php echo isset($_POST["age"]) ? $_POST["age"] : ""; ?>">

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ""; ?>">

        <label for="password">Password:</label>
        <input type="password" id="password" name="password">

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password">

        <label for="phone_number">Phone Number:</label>
        <input type="text" id="phone_number" name="phone_number" value="<?php echo isset($_POST["phone_number"]) ? $_POST["phone_number"] : ""; ?>">

        <label for="uploaded_file">Upload File:</label>
        <input type="file" id="uploaded_file" name="uploaded_file">

        <input type="submit" value="Submit">
    </form>

    <div class="file-list">
        <h3>Uploaded Files:</h3>
        <?php
        // Display the list of uploaded files
        $files = array_diff(scandir($uploadDir), array('.', '..'));
        foreach ($files as $file) {
            echo "<div class='file-item'>$file ";
            echo "<form style='display:inline;' method='post' action='" . htmlspecialchars($_SERVER["PHP_SELF"]) . "'>";
            echo "<input type='hidden' name='delete_file' value='$file'>";
            echo "<button type='submit'>Delete</button>";
            echo "</form></div>";
        }
        ?>
    </div>
</body>
</html>