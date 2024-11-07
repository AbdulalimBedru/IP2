<!DOCTYPE html>
<html>
<head>
  <title>Register and Login</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-color: #f4f4f4;
      margin: 0;
      padding: 20px;
    }

    .container {
      background-color: #fff;
      padding: 20px;
      border-radius: 5px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      max-width: 500px;
      margin: auto;
    }

    h1, h2, h3 {
      text-align: center;
    }

    .form-group {
      margin-bottom: 15px;
    }

    label {
      display: block;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="password"],
    input[type="email"],
    input[type="file"] {
      width: 100%;
      padding: 8px;
      margin: 5px 0;
      border: 1px solid #ccc;
      border-radius: 3px;
    }

    input[type="submit"] {
      background-color: #28a745;
      color: white;
      padding: 10px 15px;
      border: none;
      border-radius: 3px;
      cursor: pointer;
    }

    input[type="submit"]:hover {
      background-color: #218838;
    }

    .error {
      color: red;
      text-align: center;
    }

    .file-list {
      list-style: none;
      padding: 0;
    }

    .file-list li {
      margin-bottom: 5px;
    }

    .nav-links {
      text-align: center;
      margin-bottom: 20px;
    }

    .nav-links a {
      margin: 0 10px;
      text-decoration: none;
      color: #333;
    }
  </style>
</head>
<body>

<?php
session_start();

$users = [
    'user' => 'pass',
    'admin' => 'admin'
];

// Login handling
if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $users[$username] = $password; 
    echo '<div class="container"><h2>Logged in Successful</h2></div>';

}

// Registration handling
if (isset($_POST['register'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $users[$username] = $password; 
    echo '<div class="container"><h2>Registration Successful</h2><p>You can now log in.</p></div>';
}

// Logout handling
if (isset($_POST['logout'])) {
    session_destroy();
    header('Location: ' . $_SERVER['PHP_SELF']);
}

?>

<?php if (!isset($_SESSION['loggedin'])): ?>

  <div class="nav-links">
    <a href="#login-form">Login</a> |
    <a href="#register-form">Register</a>
  </div>

  <div class="container" id="login-form">
    <h2>Login</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <input type="submit" value="Login" name="login">
      <?php if (isset($outp)): ?>
        <p class="correct"><?php echo $outp; ?></p>
      <?php endif; ?>
    </form>
  </div>

  <div class="container" id="register-form">
    <h2>Register</h2>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <div class="form-group">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>
      </div>
      <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
      </div>
      <input type="submit" value="Register" name="register">
    </form>
  </div>

<?php else: ?>

  <div class="container">
    <h2>File Management</h2>
    <?php if (isset($_SESSION['username'])): ?>
      <p>Welcome, <?php echo $_SESSION['username']; ?>!</p>
    <?php endif; ?>

    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
      <input type="submit" value="Logout" name="logout">
    </form>
  </div>

<?php endif; ?>

</body>
</html>
