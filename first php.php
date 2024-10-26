<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name = $_POST["name"];
  $address = $_POST["address"];
  $age = $_POST["age"];
  $email = $_POST["email"];
  // Validation
  $errors = array();
  
  // Name
  if (empty($name)) {
    $errors["name"] = "Name is required";
  } else if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
    $errors["name"] = "Name must contain only letters and spaces";
  }

  // Address
  if (empty($address)) {
    $errors["address"] = "Address is required";
  }

  // Age
  if (empty($age)) {
    $errors["age"] = "Age is required";
  } else if (!is_numeric($age) || $age <= 0) {
    $errors["age"] = "Invalid age";
  }
  // Email
  if (empty($email)) {
    $errors["email"] = "Email is required";
  } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    $errors["email"] = "Invalid email format";
  }
  
  if (empty($errors)) {
    echo "Registration successful!";
  } else {
    echo "Please correct the following errors:<br>";
    foreach ($errors as $field => $error) {
      echo "$field: $error<br>";
    }
  }
} else {
  ?>
  
  <?php
}
?>