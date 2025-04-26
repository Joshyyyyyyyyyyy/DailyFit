<?php
// Include config file
require_once "db_conn.php";

// Define response array
$response = array(
    'success' => false,
    'message' => '',
    'redirect' => ''
);

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Validate first name
    if(empty(trim($_POST["first_name"]))) {
        $response['message'] = "Please enter your first name.";
        echo json_encode($response);
        exit;
    } else {
        $first_name = sanitize_input($_POST["first_name"]);
    }
    
    // Validate last name
    if(empty(trim($_POST["last_name"]))) {
        $response['message'] = "Please enter your last name.";
        echo json_encode($response);
        exit;
    } else {
        $last_name = sanitize_input($_POST["last_name"]);
    }
    
    // Validate email
    if(empty(trim($_POST["email"]))) {
        $response['message'] = "Please enter an email address.";
        echo json_encode($response);
        exit;
    } else {
        $email = sanitize_input($_POST["email"]);
        
        // Check if email is valid
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $response['message'] = "Please enter a valid email address.";
            echo json_encode($response);
            exit;
        }
        
        // Check if email already exists
        $sql = "SELECT id FROM users WHERE email = ?";
        if($stmt = $conn->prepare($sql)) {
            $stmt->bind_param("s", $param_email);
            $param_email = $email;
            
            if($stmt->execute()) {
                $stmt->store_result();
                
                if($stmt->num_rows > 0) {
                    $response['message'] = "This email is already registered.";
                    echo json_encode($response);
                    exit;
                }
            } else {
                $response['message'] = "Oops! Something went wrong. Please try again later.";
                echo json_encode($response);
                exit;
            }
            
            $stmt->close();
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))) {
        $response['message'] = "Please enter a password.";
        echo json_encode($response);
        exit;
    } elseif(strlen(trim($_POST["password"])) < 8) {
        $response['message'] = "Password must have at least 8 characters.";
        echo json_encode($response);
        exit;
    } else {
        $password = trim($_POST["password"]);
        
        // Check password strength
        $uppercase = preg_match('@[A-Z]@', $password);
        $lowercase = preg_match('@[a-z]@', $password);
        $number    = preg_match('@[0-9]@', $password);
        $specialChars = preg_match('@[^\w]@', $password);
        
        if(!$uppercase || !$lowercase || !$number || !$specialChars) {
            $response['message'] = "Password should include at least one uppercase letter, one lowercase letter, one number, and one special character.";
            echo json_encode($response);
            exit;
        }
    }
    
    // Validate confirm password
    if(empty(trim($_POST["confirm_password"]))) {
        $response['message'] = "Please confirm password.";
        echo json_encode($response);
        exit;
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if($password != $confirm_password) {
            $response['message'] = "Passwords do not match.";
            echo json_encode($response);
            exit;
        }
    }
    
    // Validate terms
    if(!isset($_POST["terms"]) || $_POST["terms"] != "on") {
        $response['message'] = "You must accept the Terms of Service and Privacy Policy.";
        echo json_encode($response);
        exit;
    }
    
    // Get optional fields
    $phone = isset($_POST["phone"]) ? sanitize_input($_POST["phone"]) : "";
    $company = isset($_POST["company"]) ? sanitize_input($_POST["company"]) : "";
    $newsletter = isset($_POST["newsletter"]) && $_POST["newsletter"] == "on" ? 1 : 0;
    
    // Prepare an insert statement
    $sql = "INSERT INTO users (first_name, last_name, email, password, phone, company) VALUES (?, ?, ?, ?, ?, ?)";
    
    if($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssssss", $param_first_name, $param_last_name, $param_email, $param_password, $param_phone, $param_company);
        
        // Set parameters
        $param_first_name = $first_name;
        $param_last_name = $last_name;
        $param_email = $email;
        $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
        $param_phone = $phone;
        $param_company = $company;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()) {
            // Registration successful
            $user_id = $conn->insert_id;
            
            // If newsletter subscription is checked, you can add code here to subscribe the user
            
            // Set response
            $response['success'] = true;
            $response['message'] = "Registration successful! You can now login.";
            $response['redirect'] = "login.html?registered=true";
        } else {
            $response['message'] = "Oops! Something went wrong. Please try again later.";
        }
        
        // Close statement
        $stmt->close();
    }
    
    // Close connection
    $conn->close();
}

// Return JSON response
echo json_encode($response);
?>