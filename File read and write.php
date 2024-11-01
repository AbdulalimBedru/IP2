<?php
// Define the uploads directory
$uploadDir = "uploads/";

// Ensure the directory exists
if (!file_exists($uploadDir)) {
    mkdir($uploadDir, 0777, true);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $address = $_POST["address"];
  $age = $_POST["age"];
  $email = $_POST["email"];
  $password = $_POST["password"];
  $confirmPassword = $_POST["confirm_password"];
  $phoneNumber = $_POST["phone_number"];

  $errors = array();

  // Name Validation
  if (empty($name)) {
    $errors["name"] = "Name is required";
  } else if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
    $errors["name"] = "Name must contain only letters and spaces";
  }

  // Address Validation
  if (empty($address)) {
    $errors["address"] = "Address is required";
  }

  // Age Validation
  if (empty($age)) {
    $errors["age"] = "Age is required";
  } else if (!is_numeric($age) || $age <= 0) {
    $errors["age"] = "Invalid age";
  }

  // Email Validation
  if (empty($email)) {
    $errors["email"] = "Email is required";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "Invalid email format";
  }

  // Password Validation
  if (empty($password)) {
    $errors["password"] = "Password is required";
  } else if (strlen($password) < 8) {
    $errors["password"] = "Password must be at least 8 characters long";
  }

  // Confirm Password Validation
  if (empty($confirmPassword)) {
    $errors["confirm_password"] = "Confirm password is required";
  } else if ($password !== $confirmPassword) {
    $errors["confirm_password"] = "Passwords do not match";
  }

  // Phone Number Validation
  if (empty($phoneNumber)) {
    $errors["phone_number"] = "Phone number is required";
  } else if (!preg_match("/^[0-9]+$/", $phoneNumber)) {
    $errors["phone_number"] = "Phone number must contain only digits";
  }

  // File Upload Handling
  if (isset($_FILES["uploaded_file"]) && $_FILES["uploaded_file"]["error"] === UPLOAD_ERR_OK) {
    $fileTmpPath = $_FILES["uploaded_file"]["tmp_name"];
    $fileName = $_FILES["uploaded_file"]["name"];
    $fileSize = $_FILES["uploaded_file"]["size"];
    $fileType = $_FILES["uploaded_file"]["type"];
    $fileNameCmps = explode(".", $fileName);
    $fileExtension = strtolower(end($fileNameCmps));
    
    // Allowed extensions
    $allowedExtensions = array("jpg", "png", "pdf");

    if (in_array($fileExtension, $allowedExtensions)) {
      $dest_path = $uploadDir . $fileName;
      if (move_uploaded_file($fileTmpPath, $dest_path)) {
        $uploadMessage = "File is successfully uploaded.";
      } else {
        $errors["file"] = "There was an error moving the uploaded file.";
      }
    } else {
      $errors["file"] = "Upload failed. Allowed file types: " . implode(", ", $allowedExtensions);
    }
  } else {
    $errors["file"] = "File upload is required";
  }

  if (empty($errors)) {
    echo "Registration successful!<br>$uploadMessage";
  } else {
    echo "Please correct the following errors:<br>";
    foreach ($errors as $field => $error) {
      echo "$field: $error<br>";
    }
  }
}

// File Deletion Handling
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_file"])) {
  $fileToDelete = $uploadDir . basename($_POST["delete_file"]);
  if (file_exists($fileToDelete)) {
    unlink($fileToDelete);
    echo "File deleted successfully.";
  } else {
    echo "File not found.";
  }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Registration Form with File Upload</title>
  <style>
    body { font-family: Arial, sans-serif; }
    form { max-width: 500px; margin: auto; padding: 1em; background: #f4f7f8; border-radius: 8px; }
    label { margin-top: 1em; display: block; color: #333; }
    input[type="text"], input[type="email"], input[type="password"], input[type="file"] {
width: 100%; padding: 8px; margin: 5px 0; box-sizing: border-box;
    }
    input[type="submit"], input[type="button"] {
      background: #007bff; color: #fff; padding: 10px 15px; border: none; border-radius: 4px;
      cursor: pointer;
    }
    .file-list { margin-top: 1em; }
    .file-item { margin: 0.5em 0; }
    .file-item button { background: #dc3545; color: #fff; padding: 5px 10px; border: none; border-radius: 4px; cursor: pointer; }
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
