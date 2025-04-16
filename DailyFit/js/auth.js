document.addEventListener('DOMContentLoaded', function() {
    // Toggle password visibility
    const togglePasswordButtons = document.querySelectorAll('.toggle-password');
    
    togglePasswordButtons.forEach(button => {
      button.addEventListener('click', function() {
        const passwordInput = this.parentElement.querySelector('input');
        const eyeIcon = this.querySelector('.eye');
        const eyeOffIcon = this.querySelector('.eye-off');
        
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          eyeIcon.classList.add('hidden');
          eyeOffIcon.classList.remove('hidden');
        } else {
          passwordInput.type = 'password';
          eyeIcon.classList.remove('hidden');
          eyeOffIcon.classList.add('hidden');
        }
      });
    });
    
    // Login form validation
    const loginForm = document.getElementById('login-form');
    if (loginForm) {
      loginForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        
        // Email validation
        const email = document.getElementById('email');
        const emailError = document.getElementById('email-error');
        
        if (!email.value) {
          emailError.textContent = 'Email is required';
          isValid = false;
        } else if (!isValidEmail(email.value)) {
          emailError.textContent = 'Please enter a valid email address';
          isValid = false;
        } else {
          emailError.textContent = '';
        }
        
        // Password validation
        const password = document.getElementById('password');
        const passwordError = document.getElementById('password-error');
        
        if (!password.value) {
          passwordError.textContent = 'Password is required';
          isValid = false;
        } else if (password.value.length < 6) {
          passwordError.textContent = 'Password must be at least 6 characters';
          isValid = false;
        } else {
          passwordError.textContent = '';
        }
        
        if (isValid) {
          // Simulate login success
          alert('Login successful! Redirecting to dashboard...');
          // In a real application, you would send the data to a server
          // and handle the response accordingly
          window.location.href = 'index.html';
        }
      });
    }
    
    // Registration form validation
    const registerForm = document.getElementById('register-form');
    if (registerForm) {
      const registerPassword = document.getElementById('register-password');
      const strengthBar = document.getElementById('strength-bar');
      const strengthText = document.getElementById('strength-text');
      
      // Password strength meter
      if (registerPassword) {
        registerPassword.addEventListener('input', function() {
          updatePasswordStrength(this.value);
        });
      }
      
      registerForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        
        // First name validation
        const firstName = document.getElementById('first-name');
        const firstNameError = document.getElementById('first-name-error');
        
        if (!firstName.value) {
          firstNameError.textContent = 'First name is required';
          isValid = false;
        } else {
          firstNameError.textContent = '';
        }
        
        // Last name validation
        const lastName = document.getElementById('last-name');
        const lastNameError = document.getElementById('last-name-error');
        
        if (!lastName.value) {
          lastNameError.textContent = 'Last name is required';
          isValid = false;
        } else {
          lastNameError.textContent = '';
        }
        
        // Email validation
        const email = document.getElementById('register-email');
        const emailError = document.getElementById('register-email-error');
        
        if (!email.value) {
          emailError.textContent = 'Email is required';
          isValid = false;
        } else if (!isValidEmail(email.value)) {
          emailError.textContent = 'Please enter a valid email address';
          isValid = false;
        } else {
          emailError.textContent = '';
        }
        
        // Password validation
        const password = document.getElementById('register-password');
        const passwordError = document.getElementById('register-password-error');
        
        if (!password.value) {
          passwordError.textContent = 'Password is required';
          isValid = false;
        } else if (password.value.length < 8) {
          passwordError.textContent = 'Password must be at least 8 characters';
          isValid = false;
        } else if (!isStrongPassword(password.value)) {
          passwordError.textContent = 'Password must include uppercase, lowercase, number, and special character';
          isValid = false;
        } else {
          passwordError.textContent = '';
        }
        
        // Confirm password validation
        const confirmPassword = document.getElementById('confirm-password');
        const confirmPasswordError = document.getElementById('confirm-password-error');
        
        if (!confirmPassword.value) {
          confirmPasswordError.textContent = 'Please confirm your password';
          isValid = false;
        } else if (confirmPassword.value !== password.value) {
          confirmPasswordError.textContent = 'Passwords do not match';
          isValid = false;
        } else {
          confirmPasswordError.textContent = '';
        }
        
        // Terms checkbox validation
        const terms = document.getElementById('terms');
        const termsError = document.getElementById('terms-error');
        
        if (!terms.checked) {
          termsError.textContent = 'You must agree to the Terms of Service';
          isValid = false;
        } else {
          termsError.textContent = '';
        }
        
        if (isValid) {
          // Simulate registration success
          alert('Registration successful! Redirecting to login...');
          // In a real application, you would send the data to a server
          // and handle the response accordingly
          window.location.href = 'login.html';
        }
      });
    }
    
    // Helper functions
    function isValidEmail(email) {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return emailRegex.test(email);
    }
    
    function isStrongPassword(password) {
      // Password should have at least one uppercase, one lowercase, one number, and one special character
      const hasUppercase = /[A-Z]/.test(password);
      const hasLowercase = /[a-z]/.test(password);
      const hasNumber = /[0-9]/.test(password);
      const hasSpecial = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/.test(password);
      
      return hasUppercase && hasLowercase && hasNumber && hasSpecial;
    }
    
    function updatePasswordStrength(password) {
      const strengthBar = document.getElementById('strength-bar');
      const strengthText = document.getElementById('strength-text');
      
      if (!password) {
        strengthBar.style.width = '0%';
        strengthBar.style.backgroundColor = '#e5e7eb';
        strengthText.textContent = 'Password strength';
        strengthText.style.color = '#6b7280';
        return;
      }
      
      // Calculate password strength
      let strength = 0;
      
      // Length check
      if (password.length >= 8) strength += 25;
      
      // Character type checks
      if (/[A-Z]/.test(password)) strength += 25;
      if (/[a-z]/.test(password)) strength += 25;
      if (/[0-9]/.test(password)) strength += 12.5;
      if (/[^A-Za-z0-9]/.test(password)) strength += 12.5;
      
      // Update UI
      strengthBar.style.width = `${strength}%`;
      
      if (strength < 50) {
        strengthBar.style.backgroundColor = '#ef4444'; // Red
        strengthText.textContent = 'Weak';
        strengthText.style.color = '#ef4444';
      } else if (strength < 75) {
        strengthBar.style.backgroundColor = '#f59e0b'; // Yellow
        strengthText.textContent = 'Moderate';
        strengthText.style.color = '#f59e0b';
      } else {
        strengthBar.style.backgroundColor = '#10b981'; // Green
        strengthText.textContent = 'Strong';
        strengthText.style.color = '#10b981';
      }
    }
  });