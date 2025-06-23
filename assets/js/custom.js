// Custom JavaScript for SIREK Recruitment System

// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {

  // Fix for sidebar navigation links
  const sidenavLinks = document.querySelectorAll('.sidenav .nav-link');
  sidenavLinks.forEach(function(link) {
    link.addEventListener('click', function(e) {
      // Prevent any default event handling that might be interfering
      // with normal link navigation
      if (this.getAttribute('href') && this.getAttribute('href') !== '#') {
        window.location.href = this.getAttribute('href');
      }
    });
  });

  // Auto-hide alerts after 5 seconds
  const alerts = document.querySelectorAll('.alert');
  alerts.forEach(function(alert) {
    setTimeout(function() {
      const bsAlert = new bootstrap.Alert(alert);
      bsAlert.close();
    }, 5000);
  });

  // Initialize tooltips
  const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Initialize popovers
  const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
  popoverTriggerList.map(function(popoverTriggerEl) {
    return new bootstrap.Popover(popoverTriggerEl);
  });

  // Multiple choice selection in assessments
  const optionItems = document.querySelectorAll('.option-item');
  optionItems.forEach(function(item) {
    item.addEventListener('click', function() {
      const questionId = this.getAttribute('data-question-id');
      const optionId = this.getAttribute('data-option-id');
      const radioInput = document.querySelector('input[name="question_' + questionId + '"][value="' + optionId + '"]');

      // Remove selected class from all options in this question
      const questionOptions = document.querySelectorAll('.option-item[data-question-id="' + questionId + '"]');
      questionOptions.forEach(function(option) {
        option.classList.remove('selected');
      });

      // Add selected class to clicked option
      this.classList.add('selected');

      // Check the radio input
      if (radioInput) {
        radioInput.checked = true;
      }
    });
  });

  // File input preview
  const fileInputs = document.querySelectorAll('input[type="file"]');
  fileInputs.forEach(function(input) {
    input.addEventListener('change', function() {
      const fileNameDisplay = document.querySelector('#' + this.id + '_filename');
      if (fileNameDisplay) {
        if (this.files.length > 0) {
          fileNameDisplay.textContent = this.files[0].name;
        } else {
          fileNameDisplay.textContent = 'No file chosen';
        }
      }

      // Image preview
      const previewId = this.getAttribute('data-preview');
      if (previewId && this.files.length > 0) {
        const preview = document.getElementById(previewId);
        const file = this.files[0];
        const reader = new FileReader();

        reader.onload = function(e) {
          preview.src = e.target.result;
        };

        reader.readAsDataURL(file);
      }
    });
  });

  // Confirm delete actions handled in sweetalert-init.js

  // Job search filter
  const jobFilterForm = document.getElementById('job-filter-form');
  if (jobFilterForm) {
    jobFilterForm.addEventListener('submit', function(e) {
      e.preventDefault();

      const category = document.getElementById('filter-category').value;
      const location = document.getElementById('filter-location').value;
      const jobType = document.getElementById('filter-job-type').value;

      // Build query string
      let queryParams = [];
      if (category) queryParams.push('category=' + category);
      if (location) queryParams.push('location=' + location);
      if (jobType) queryParams.push('job_type=' + jobType);

      // Redirect to filtered results
      window.location.href = baseUrl + 'lowongan?' + queryParams.join('&');
    });
  }

  // Assessment timer
  const assessmentTimer = document.getElementById('assessment-timer');
  if (assessmentTimer) {
    const timeLimit = parseInt(assessmentTimer.getAttribute('data-time-limit')) * 60; // Convert to seconds
    let timeRemaining = timeLimit;

    const timerInterval = setInterval(function() {
      timeRemaining--;

      const minutes = Math.floor(timeRemaining / 60);
      const seconds = timeRemaining % 60;

      assessmentTimer.textContent = minutes.toString().padStart(2, '0') + ':' + seconds.toString().padStart(2, '0');

      if (timeRemaining <= 300) { // 5 minutes remaining
        assessmentTimer.classList.add('text-danger');
      }

      if (timeRemaining <= 0) {
        clearInterval(timerInterval);
        Swal.fire({
          icon: 'warning',
          title: 'Waktu Habis!',
          text: 'Penilaian Anda akan dikirimkan secara otomatis.',
          showConfirmButton: false,
          timer: 2000,
          timerProgressBar: true
        }).then(() => {
          document.getElementById('assessment-form').submit();
        });
      }
    }, 1000);
  }

  // Character counter for text areas
  const textAreas = document.querySelectorAll('textarea[maxlength]');
  textAreas.forEach(function(textarea) {
    const maxLength = textarea.getAttribute('maxlength');
    const counterElement = document.createElement('small');
    counterElement.classList.add('text-muted', 'character-counter');
    counterElement.textContent = '0/' + maxLength + ' characters';

    textarea.parentNode.insertBefore(counterElement, textarea.nextSibling);

    textarea.addEventListener('input', function() {
      const currentLength = this.value.length;
      counterElement.textContent = currentLength + '/' + maxLength + ' characters';

      if (currentLength > maxLength * 0.9) {
        counterElement.classList.add('text-danger');
      } else {
        counterElement.classList.remove('text-danger');
      }
    });
  });

  // Password strength meter
  const passwordInputs = document.querySelectorAll('input[type="password"][data-password-strength]');
  passwordInputs.forEach(function(input) {
    const strengthMeter = document.createElement('div');
    strengthMeter.classList.add('progress', 'mt-2');
    strengthMeter.style.height = '5px';

    const strengthBar = document.createElement('div');
    strengthBar.classList.add('progress-bar');
    strengthBar.style.width = '0%';

    strengthMeter.appendChild(strengthBar);

    const strengthText = document.createElement('small');
    strengthText.classList.add('text-muted', 'mt-1', 'd-block');

    input.parentNode.insertBefore(strengthMeter, input.nextSibling);
    input.parentNode.insertBefore(strengthText, strengthMeter.nextSibling);

    input.addEventListener('input', function() {
      const password = this.value;
      let strength = 0;

      // Length check
      if (password.length >= 8) strength += 25;

      // Uppercase check
      if (/[A-Z]/.test(password)) strength += 25;

      // Lowercase check
      if (/[a-z]/.test(password)) strength += 25;

      // Number/special char check
      if (/[0-9!@#$%^&*]/.test(password)) strength += 25;

      // Update UI
      strengthBar.style.width = strength + '%';

      if (strength < 25) {
        strengthBar.className = 'progress-bar bg-danger';
        strengthText.textContent = 'Very Weak';
      } else if (strength < 50) {
        strengthBar.className = 'progress-bar bg-warning';
        strengthText.textContent = 'Weak';
      } else if (strength < 75) {
        strengthBar.className = 'progress-bar bg-info';
        strengthText.textContent = 'Medium';
      } else {
        strengthBar.className = 'progress-bar bg-success';
        strengthText.textContent = 'Strong';
      }
    });
  });
});
