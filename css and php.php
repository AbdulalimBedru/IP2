<!DOCTYPE html>
<html>
<head>
    <title>Simple Form Validation</title>
    <style>
        /* Basic styling */
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
        }

        h2 {
            text-align: center;
            color: #333;
        }

        form {
            width: 400px;
            margin: 0 auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #fff;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="tel"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        /* Error handling */
        .error {
            color: red;
            font-size: 12px;
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <h2>Registration Form</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <?php if (!empty($errors)) { ?>
            <div class="error">
                <?php foreach ($errors as $field => $error) { ?>
                    <p><?php echo $field . ': ' . $error; ?></p>
                <?php } ?>
            </div>
        <?php } ?>
    </form>
</body>
</html>