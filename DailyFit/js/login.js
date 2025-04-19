document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const themeToggle = document.getElementById('theme-toggle-checkbox');
    const loginForm = document.getElementById('login-form');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const loginError = document.getElementById('login-error');
    const togglePasswordBtn = document.querySelector('.toggle-password');
    const rememberMeCheckbox = document.getElementById('remember-me');
    
    // Theme Toggle
    themeToggle.addEventListener('change', function() {
      document.body.classList.toggle('dark-mode');
      
      // Save theme preference to localStorage
      if (document.body.classList.contains('dark-mode')) {
        localStorage.setItem('theme', 'dark');
      } else {
        localStorage.setItem('theme', 'light');
      }
    });
    
    // Check for saved theme preference
    const savedTheme = localStorage.getItem('theme');
    if (savedTheme === 'dark') {
      document.body.classList.add('dark-mode');
      themeToggle.checked = true;
    }
    
    // Toggle Password Visibility
    togglePasswordBtn.addEventListener('click', function() {
      const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
      passwordInput.setAttribute('type', type);
      
      // Toggle eye icon
      const icon = this.querySelector('i');
      if (type === 'password') {
        icon.classList.remove('fa-eye-slash');
        icon.classList.add('fa-eye');
      } else {
        icon.classList.remove('fa-eye');
        icon.classList.add('fa-eye-slash');
      }
    });
    
    // Check for saved email
    const savedEmail = localStorage.getItem('rememberedEmail');
    if (savedEmail) {
      emailInput.value = savedEmail;
      rememberMeCheckbox.checked = true;
    }
    
    // Login Form Submission
    loginForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      const email = emailInput.value.trim();
      const password = passwordInput.value.trim();
      
      // Simple validation
      if (!email || !password) {
        showLoginError('Please enter both email and password.');
        return;
      }
      
      // Remember email if checkbox is checked
      if (rememberMeCheckbox.checked) {
        localStorage.setItem('rememberedEmail', email);
      } else {
        localStorage.removeItem('rememberedEmail');
      }
      
      // Simulate login (replace with actual authentication)
      simulateLogin(email, password);
    });
    
    // Simulate login process
    function simulateLogin(email, password) {
      // Show loading state
      const loginButton = loginForm.querySelector('button[type="submit"]');
      const originalButtonText = loginButton.innerHTML;
      loginButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing in...';
      loginButton.disabled = true;
      
      // Simulate API call with timeout
      setTimeout(() => {
        // For demo purposes, we'll use a hardcoded credential check
        // In a real application, this would be an API call to your backend
        if (email === 'admin@clothingbrand.com' && password === 'password123') {
          // Successful login
          loginError.style.display = 'none';
          
          // Show success message
          const successAlert = document.createElement('div');
          successAlert.className = 'login-alert success';
          successAlert.innerHTML = '<i class="fas fa-check-circle"></i><span>Login successful! Redirecting...</span>';
          loginForm.prepend(successAlert);
          
          // Redirect to dashboard after a short delay
          setTimeout(() => {
            window.location.href = 'admin-dashboard.html';
          }, 1500);
        } else {
          // Failed login
          showLoginError('Invalid email or password. Please try again.');
          loginButton.innerHTML = originalButtonText;
          loginButton.disabled = false;
          
          // Add shake animation to form
          loginForm.classList.add('shake');
          setTimeout(() => {
            loginForm.classList.remove('shake');
          }, 600);
        }
      }, 1500);
    }
    
    // Show login error
    function showLoginError(message) {
      loginError.querySelector('span').textContent = message;
      loginError.style.display = 'flex';
    }
    
    // Hide login error when inputs change
    emailInput.addEventListener('input', function() {
      loginError.style.display = 'none';
    });
    
    passwordInput.addEventListener('input', function() {
      loginError.style.display = 'none';
    });
  });