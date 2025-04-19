<?php
session_start();
include 'db_conn.php';
// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

// Handle login
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = $_POST["email"];
  $pass = $_POST["password"];

  $query = "SELECT * FROM users WHERE email = ? AND password = MD5(?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param("ss", $email, $pass);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows === 1) {
    $_SESSION["email"] = $email;
    header("Location: dashboard.php"); // redirect to a dashboard
    exit();
  } else {
    echo "<script>
      document.getElementById('login-error').style.display = 'block';
    </script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login - Clothing Store Admin</title>
  <link rel="stylesheet" href="css/admin.css">
  <link rel="stylesheet" href="css/login.css">
  <!-- Font Awesome for icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body>
  <div class="login-container">
    <div class="login-card">
      <div class="login-header">
        <div class="logo">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
              <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
              <line x1="3" y1="6" x2="21" y2="6"></line>
              <path d="M16 10a4 4 0 0 1-8 0"></path>
            </svg>
            <span class="logo-text">Daily Fit</span>
          </div>
        
        <div class="theme-toggle">
          <input type="checkbox" id="theme-toggle-checkbox">
          <label for="theme-toggle-checkbox" class="theme-toggle-label">
            <i class="fas fa-sun"></i>
            <i class="fas fa-moon"></i>
            <span class="toggle-ball"></span>
          </label>
        </div>
      </div>
      
      <div class="login-body">
        <h1>Welcome back</h1>
        <p class="login-subtitle">Sign in to your account to continue</p>
        
        <div class="login-alert error" id="login-error" style="display: none;">
          <i class="fas fa-exclamation-circle"></i>
          <span>Invalid email or password. Please try again.</span>
        </div>
        
        <form id="login-form" class="login-form" method="POST" action="login.php">
          <div class="form-group">
            <label for="email">Email</label>
            <div class="input-with-icon">
              <i class="fas fa-envelope"></i>
              <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
          </div>
          
          <div class="form-group">
            <div class="password-label">
              <label for="password">Password</label>
              <a href="#forgot-password" class="forgot-password">Forgot password?</a>
            </div>
            <div class="input-with-icon">
              <i class="fas fa-lock"></i>
              <input type="password" id="password" name="password" placeholder="Enter your password" required>
              <button type="button" class="toggle-password">
                <i class="fas fa-eye"></i>
              </button>
            </div>
          </div>
          
          <div class="form-group remember-me">
            <label class="checkbox-container">
              <input type="checkbox" id="remember-me" name="remember-me">
              <span class="checkmark"></span>
              Remember me
            </label>
          </div>
          
          <button type="submit" class="login-button">
            <span>Sign In</span>
            <i class="fas fa-arrow-right"></i>
          </button>
        </form>
      </div>
      
      <div class="login-footer">
        <p>&copy; 2023 ClothingBrand. All rights reserved.</p>
      </div>
    </div>
  </div>

  <script src="js/login.js"></script>
</body>
</html>