document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const themeToggle = document.getElementById('theme-toggle-checkbox');
    const loginForm = document.getElementById('login-form');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const loginError = document.getElementById('login-error');
    const togglePasswordBtn = document.querySelector('.toggle-password');
    
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
      const input = this.previousElementSibling;
      const type = input.getAttribute('type') === 'password' ? 'text' : 'password';
      input.setAttribute('type', type);
      
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
    
    // Form Validation
    loginForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Get form values
      const email = emailInput.value.trim();
      const password = passwordInput.value;
      
      // Validate form
      if (!email || !password) {
        showError('Please enter both email and password.');
        return;
      }
      
      // Email validation
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(email)) {
        showError('Please enter a valid email address.');
        return;
      }
      
      // Submit the form using fetch API
      const formData = new FormData(loginForm);
      
      // Show loading state
      const loginButton = loginForm.querySelector('button[type="submit"]');
      const originalButtonText = loginButton.innerHTML;
      loginButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Signing in...';
      loginButton.disabled = true;
      
      fetch('login.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          console.log("Redirecting to:", data.redirect);
          window.location.href = data.redirect || 'index.php';
        } else {
          showError(data.message || 'Invalid email or password.');
          loginButton.innerHTML = originalButtonText;
          loginButton.disabled = false;
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showError('An error occurred. Please try again later.');
        loginButton.innerHTML = originalButtonText;
        loginButton.disabled = false;
      });      
    });
    
    // Show error message
    function showError(message) {
      loginError.querySelector('span').textContent = message;
      loginError.style.display = 'flex';
      
      // Add shake animation
      loginForm.classList.add('shake');
      setTimeout(() => {
        loginForm.classList.remove('shake');
      }, 600);
    }
    
    // Hide error when inputs change
    const formInputs = loginForm.querySelectorAll('input');
    formInputs.forEach(input => {
      input.addEventListener('input', function() {
        loginError.style.display = 'none';
      });
    });
  });