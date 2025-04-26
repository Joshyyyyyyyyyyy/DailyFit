document.addEventListener('DOMContentLoaded', function() {
    // DOM Elements
    const themeToggle = document.getElementById('theme-toggle-checkbox');
    const registerForm = document.getElementById('register-form');
    const firstNameInput = document.getElementById('first-name');
    const lastNameInput = document.getElementById('last-name');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');
    const confirmPasswordInput = document.getElementById('confirm-password');
    const termsCheckbox = document.getElementById('terms');
    const registerError = document.getElementById('register-error');
    const togglePasswordBtns = document.querySelectorAll('.toggle-password');
    const strengthMeter = document.querySelector('.strength-meter-fill');
    const strengthText = document.querySelector('.strength-text span');
    const requirements = document.querySelectorAll('.requirement');
    
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
    togglePasswordBtns.forEach(btn => {
      btn.addEventListener('click', function() {
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
    });
    
    // Password Strength Checker
    passwordInput.addEventListener('input', function() {
      const password = this.value;
      checkPasswordStrength(password);
    });
    
    function checkPasswordStrength(password) {
      let strength = 0;
      let status = 'Too weak';
      
      // Check length
      if (password.length >= 8) {
        strength++;
        document.querySelector('[data-requirement="length"]').classList.add('met');
      } else {
        document.querySelector('[data-requirement="length"]').classList.remove('met');
      }
      
      // Check uppercase
      if (/[A-Z]/.test(password)) {
        strength++;
        document.querySelector('[data-requirement="uppercase"]').classList.add('met');
      } else {
        document.querySelector('[data-requirement="uppercase"]').classList.remove('met');
      }
      
      // Check lowercase
      if (/[a-z]/.test(password)) {
        strength++;
        document.querySelector('[data-requirement="lowercase"]').classList.add('met');
      } else {
        document.querySelector('[data-requirement="lowercase"]').classList.remove('met');
      }
      
      // Check number
      if (/[0-9]/.test(password)) {
        strength++;
        document.querySelector('[data-requirement="number"]').classList.add('met');
      } else {
        document.querySelector('[data-requirement="number"]').classList.remove('met');
      }
      
      // Check special character
      if (/[^A-Za-z0-9]/.test(password)) {
        strength++;
        document.querySelector('[data-requirement="special"]').classList.add('met');
      } else {
        document.querySelector('[data-requirement="special"]').classList.remove('met');
      }
      
      // Update strength meter
      strengthMeter.setAttribute('data-strength', strength);
      
      // Update strength text
      switch (strength) {
        case 0:
          status = 'Too weak';
          break;
        case 1:
          status = 'Weak';
          break;
        case 2:
          status = 'Fair';
          break;
        case 3:
          status = 'Good';
          break;
        case 4:
        case 5:
          status = 'Strong';
          break;
      }
      
      strengthText.textContent = status;
      
      return strength;
    }
    
    // Confirm Password Validation
    confirmPasswordInput.addEventListener('input', function() {
      if (this.value !== passwordInput.value) {
        this.setCustomValidity('Passwords do not match');
      } else {
        this.setCustomValidity('');
      }
    });
    
    // Email Validation
    emailInput.addEventListener('input', function() {
      const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      if (!emailRegex.test(this.value)) {
        this.setCustomValidity('Please enter a valid email address');
      } else {
        this.setCustomValidity('');
      }
    });
    
    // Registration Form Submission
    registerForm.addEventListener('submit', function(e) {
      e.preventDefault();
      
      // Get form values
      const firstName = firstNameInput.value.trim();
      const lastName = lastNameInput.value.trim();
      const email = emailInput.value.trim();
      const password = passwordInput.value;
      const confirmPassword = confirmPasswordInput.value;
      
      // Validate form
      if (!firstName || !lastName || !email || !password || !confirmPassword) {
        showError('Please fill in all required fields.');
        return;
      }
      
      // Check password strength
      const passwordStrength = checkPasswordStrength(password);
      if (passwordStrength < 3) {
        showError('Please create a stronger password.');
        return;
      }
      
      // Check passwords match
      if (password !== confirmPassword) {
        showError('Passwords do not match.');
        return;
      }
      
      // Check terms acceptance
      if (!termsCheckbox.checked) {
        showError('Please accept the Terms of Service and Privacy Policy.');
        return;
      }
      
      // Submit the form using fetch API
      const formData = new FormData(registerForm);
      
      // Show loading state
      const registerButton = registerForm.querySelector('button[type="submit"]');
      const originalButtonText = registerButton.innerHTML;
      registerButton.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Creating account...';
      registerButton.disabled = true;
      
      fetch('register.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          // Show success message or redirect
          window.location.href = data.redirect || 'login.html?registered=true';
        } else {
          showError(data.message || 'An error occurred during registration.');
          registerButton.innerHTML = originalButtonText;
          registerButton.disabled = false;
        }
      })
      .catch(error => {
        console.error('Error:', error);
        showError('An error occurred. Please try again later.');
        registerButton.innerHTML = originalButtonText;
        registerButton.disabled = false;
      });
    });
    
    // Show error message
    function showError(message) {
      registerError.querySelector('span').textContent = message;
      registerError.style.display = 'flex';
      
      // Scroll to error message
      registerError.scrollIntoView({ behavior: 'smooth', block: 'center' });
      
      // Add shake animation
      registerForm.classList.add('shake');
      setTimeout(() => {
        registerForm.classList.remove('shake');
      }, 600);
    }
    
    // Hide error when inputs change
    const formInputs = registerForm.querySelectorAll('input');
    formInputs.forEach(input => {
      input.addEventListener('input', function() {
        registerError.style.display = 'none';
      });
    });
  });