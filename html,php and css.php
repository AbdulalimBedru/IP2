<!DOCTYPE html>
<html>
<head>
    <title>Registration Form</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h2>Registration Form</h2>
        <?php if ($_SERVER["REQUEST_METHOD"] == "POST") { ?>
            <?php if (empty($errors)) { ?>
                <p class="success">Registration successful!</p>
            <?php } else { ?>
                <p class="error">Please correct the following errors:</p>
                <ul>
                    <?php foreach ($errors as $field => $error) { ?>
                        <li><?php echo "$field: $error"; ?></li>
                    <?php } ?>
                </ul>
            <?php } ?>
        <?php } ?>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
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
            <input type="tel" id="phone_number" name="phone_number" value="<?php echo isset($_POST["phone_number"]) ? $_POST["phone_number"] : ""; ?>">

            <input type="submit" value="Submit">
        </form>
    </div>
</body>
</html>