<?php
header('Content-Type: application/json');
session_start(); // ← Make sure this is at the top
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once "db_conn.php";

// Define response array
$response = array(
    'success' => false,
    'message' => '',
    'redirect' => ''
);

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Check if email and password are empty
    if(empty(trim($_POST["email"])) || empty(trim($_POST["password"]))) {
        $response['message'] = "Please enter both email and password.";
        echo json_encode($response);
        exit;
    }
    
    // Validate email
    $email = sanitize_input($_POST["email"]);
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['message'] = "Please enter a valid email address.";
        echo json_encode($response);
        exit;
    }
    
    // Prepare a select statement
    $sql = "SELECT id, first_name, last_name, email, password, user_role FROM users WHERE email = ? AND is_active = 1";
    
    if($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("s", $param_email);
        
        // Set parameters
        $param_email = $email;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()) {
            // Store result
            $stmt->store_result();
            
            // Check if email exists, if yes then verify password
            if($stmt->num_rows == 1) {                    
                // Bind result variables
                $stmt->bind_result($id, $first_name, $last_name, $email, $hashed_password, $user_role);
                
                if($stmt->fetch()) {
                    if(password_verify($_POST["password"], $hashed_password)) {
                        // Password is correct, start a new session
                        
                        // Store data in session variables
                        $_SESSION["loggedin"] = true;
                        $_SESSION["user_id"] = $id;
                        $_SESSION["email"] = $email;
                        $_SESSION["first_name"] = $first_name;
                        $_SESSION["last_name"] = $last_name;
                        $_SESSION["user_role"] = $user_role;
                        
                        // Remember me functionality
                        if(isset($_POST["remember_me"]) && $_POST["remember_me"] == "on") {
                            // Generate a token
                            $token = bin2hex(random_bytes(32));
                            
                            // Set expiry date (30 days)
                            $expiry = date('Y-m-d H:i:s', strtotime('+30 days'));
                            
                            // Store token in database
                            $sql = "INSERT INTO user_sessions (user_id, token, expires_at) VALUES (?, ?, ?)";
                            if($stmt_token = $conn->prepare($sql)) {
                                $stmt_token->bind_param("iss", $id, $token, $expiry);
                                $stmt_token->execute();
                                $stmt_token->close();
                                
                                // Set cookie
                                setcookie("remember_me", $token, strtotime('+30 days'), "/", "", true, true);
                            }
                        }
                        
                        // Update last login time
                        $sql = "UPDATE users SET last_login = NOW() WHERE id = ?";
                        if($stmt_update = $conn->prepare($sql)) {
                            $stmt_update->bind_param("i", $id);
                            $stmt_update->execute();
                            $stmt_update->close();
                        }
                        
                        // Set response
                        $response['success'] = true;
                        $response['redirect'] = ($user_role == 'admin') ? 'admin_product.php' : 'admin_product.php';
                    } else {
                        // Password is not valid
                        $response['message'] = "Invalid email or password.";
                    }
                }
            } else {
                // Email doesn't exist
                $response['message'] = "Invalid email or password.";
            }
        } else {
            $response['message'] = "Oops! Something went wrong. Please try again later.";
        }
        
        // Close statement
        $stmt->close();
    } else {
        $response['message'] = "Database query preparation failed.";
    }
    
    // Close connection
    $conn->close();
}

// If nothing else has returned, force an error response
echo json_encode($response);
exit;
?>
