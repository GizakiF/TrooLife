<?php
session_start();
?>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/styles.css" />
    <link rel="stylesheet" href="css/global_styles.css" />
    <link rel="stylesheet" href="css/register.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    
    <title>Create an Account</title>
  </head>
  <body>
    <?php include "header.php" ?>
    <div style="height: 80px;"></div>

    <div class="container py-5 animate__animated animate__fadeIn">
      <div class="registration-card mx-auto">
        <div class="card-header">
          <h2 class="mb-0">Join Our Community</h2>
          <p class="mb-0">Create your account in just a few steps</p>
        </div>
        <div class="card-body p-4">
          <form action="success.php" method="POST" id="RegistrationForm" enctype="multipart/form-data">
            
            <div class="row">
              <div class="col-md-6 mb-3">
                <label for="fname" class="form-label">First Name</label>
                <input type="text" id="fname" placeholder="Enter your first name" name="fname" class="form-control" required />
              </div>
              <div class="col-md-6 mb-3">
                <label for="lname" class="form-label">Last Name</label>
                <input type="text" id="lname" placeholder="Enter your last name" name="lname" class="form-control" required />
              </div>
            </div>
            
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <div class="input-group">
                <span class="input-group-text">@</span>
                <input type="text" id="username" placeholder="Choose a username" name="username" class="form-control" required />
              </div>
            </div>
            
            <div class="mb-3">
              <label for="email" class="form-label">Email Address</label>
              <input type="email" id="email" placeholder="Enter your email" name="email" class="form-control" required />
            </div>
            
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <div class="input-group">
                <input type="password" id="password" placeholder="Create a password" name="password" class="form-control" required />
                <span class="input-group-text password-toggle" id="togglePassword">
                  <i class="bi bi-eye-slash"></i>
                </span>
              </div>
              <div class="password-strength mt-2">
                <div class="password-strength-bar" id="passwordStrength"></div>
              </div>
              <small class="text-muted">Use 8 or more characters with a mix of letters, numbers & symbols</small>
            </div>
            
            <div class="mb-3">
              <label for="birthday" class="form-label">Date of Birth</label>
              <input type="date" id="birthday" name="birthday" class="form-control" required />
            </div>
            
            <div class="mb-3">
              <label class="form-label">Gender</label>
              <div class="gender-options">
                <div class="gender-option form-check">
                  <input class="form-check-input" type="radio" name="gender" id="male" value="male" required />
                  <label class="form-check-label" for="male">Male</label>
                </div>
                <div class="gender-option form-check">
                  <input class="form-check-input" type="radio" name="gender" id="female" value="female" required />
                  <label class="form-check-label" for="female">Female</label>
                </div>
                <div class="gender-option form-check">
                  <input class="form-check-input" type="radio" name="gender" id="other" value="undisclosed" required />
                  <label class="form-check-label" for="other">Prefer not to say</label>
                </div>
              </div>
            </div>
            
            <div class="mb-4">
              <label for="image" class="form-label">Profile Picture</label>
              <img id="profilePreview" class="profile-picture-preview" alt="Profile preview" />
              <!-- FIXME: make sure it only accepts pngs jpgs -->
              <input type="file" class="form-control" id="image" name="image" accept="image/*" required onchange="previewImage(this)" />
              <small class="text-muted">Upload a clear photo of yourself (Max 2MB)</small>
            </div>
            
            <button type="submit" name="submit" class="btn btn-primary w-100 py-3">
              <i class="bi bi-person-plus-fill me-2"></i>Create Account
            </button>
            
            <div class="login-link">
              Already have an account? <a href="login_page.php">Sign in</a>
            </div>
          </form>
        </div>
      </div>
    </div>

    <?php include "footer.php" ?>
    
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
      document.getElementById('togglePassword').addEventListener('click', function() {
        const passwordInput = document.getElementById('password');
        const icon = this.querySelector('i');
        
        if (passwordInput.type === 'password') {
          passwordInput.type = 'text';
          icon.classList.remove('bi-eye-slash');
          icon.classList.add('bi-eye');
        } else {
          passwordInput.type = 'password';
          icon.classList.remove('bi-eye');
          icon.classList.add('bi-eye-slash');
        }
      });
      
      document.getElementById('password').addEventListener('input', function() {
        const strengthBar = document.getElementById('passwordStrength');
        const strength = calculatePasswordStrength(this.value);
        
        strengthBar.style.width = strength.percentage + '%';
        strengthBar.style.backgroundColor = strength.color;
      });
      
      function calculatePasswordStrength(password) {
        let strength = 0;
        
        if (password.length > 7) strength += 25;
        
        if (/[a-z]/.test(password)) strength += 15;
        
        if (/[A-Z]/.test(password)) strength += 15;
        
        if (/[0-9]/.test(password)) strength += 20;
        
        if (/[^a-zA-Z0-9]/.test(password)) strength += 25;
        
        let color;
        if (strength < 30) color = '#dc3545'; 
        else if (strength < 60) color = '#fd7e14'; 
        else if (strength < 80) color = '#ffc107'; 
        else color = '#28a745'; 
        
        return { percentage: strength, color: color };
      }
      
      function previewImage(input) {
        const preview = document.getElementById('profilePreview');
        const file = input.files[0];
        const reader = new FileReader();
        
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.style.display = 'block';
        }
        
        if (file) {
          reader.readAsDataURL(file);
        }
      }
      
      document.getElementById('RegistrationForm').addEventListener('submit', function(e) {
        const password = document.getElementById('password').value;
        const strength = calculatePasswordStrength(password);
        
        if (strength.percentage < 50) {
          e.preventDefault();
          alert('Your password is too weak. Please choose a stronger password.');
        }
        
      });
    </script>
  </body>
</html>
