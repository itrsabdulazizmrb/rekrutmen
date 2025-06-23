/**
 * SweetAlert2 Initialization
 * This file contains helper functions for SweetAlert2 alerts
 */

// Wait for the DOM to be fully loaded
document.addEventListener('DOMContentLoaded', function() {
  // Initialize SweetAlert2 with default settings
  const Toast = Swal.mixin({
    toast: true,
    position: 'top-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
      toast.addEventListener('mouseenter', Swal.stopTimer)
      toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
  });

  // Display flash messages with SweetAlert2
  displayFlashMessages();

  // Replace confirm delete actions with SweetAlert2
  replaceDeleteConfirmations();

  // Replace other alerts with SweetAlert2
  replaceAlerts();
});

/**
 * Display flash messages using SweetAlert2
 */
function displayFlashMessages() {
  // Check for success flash message
  const successMessage = document.querySelector('.alert-success');
  if (successMessage) {
    const message = successMessage.textContent.trim();
    Swal.fire({
      icon: 'success',
      title: 'Berhasil!',
      text: message,
      timer: 3000,
      timerProgressBar: true,
      showConfirmButton: false
    });
    
    // Remove the original alert
    successMessage.remove();
  }

  // Check for error flash message
  const errorMessage = document.querySelector('.alert-danger');
  if (errorMessage) {
    const message = errorMessage.textContent.trim();
    Swal.fire({
      icon: 'error',
      title: 'Error!',
      text: message,
      timer: 3000,
      timerProgressBar: true,
      showConfirmButton: false
    });
    
    // Remove the original alert
    errorMessage.remove();
  }
}

/**
 * Replace delete confirmations with SweetAlert2
 */
function replaceDeleteConfirmations() {
  const deleteButtons = document.querySelectorAll('.btn-delete');
  deleteButtons.forEach(function(button) {
    button.addEventListener('click', function(e) {
      e.preventDefault();
      
      const href = this.getAttribute('href');
      const confirmMessage = this.getAttribute('data-confirm-message') || 'Apakah Anda yakin ingin menghapus item ini? Tindakan ini tidak dapat dibatalkan.';
      
      Swal.fire({
        title: 'Konfirmasi Hapus',
        text: confirmMessage,
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#d33',
        cancelButtonColor: '#3085d6',
        confirmButtonText: 'Ya, Hapus!',
        cancelButtonText: 'Batal'
      }).then((result) => {
        if (result.isConfirmed) {
          window.location.href = href;
        }
      });
    });
  });
}

/**
 * Replace JavaScript alerts with SweetAlert2
 */
function replaceAlerts() {
  // Override the native alert function
  window.originalAlert = window.alert;
  window.alert = function(message) {
    Swal.fire({
      title: 'Perhatian',
      text: message,
      icon: 'info',
      confirmButtonText: 'OK'
    });
  };

  // Override the native confirm function
  window.originalConfirm = window.confirm;
  window.confirm = function(message) {
    return new Promise((resolve) => {
      Swal.fire({
        title: 'Konfirmasi',
        text: message,
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Ya',
        cancelButtonText: 'Tidak'
      }).then((result) => {
        resolve(result.isConfirmed);
      });
    });
  };

  // Override the native prompt function
  window.originalPrompt = window.prompt;
  window.prompt = function(message, defaultValue) {
    return new Promise((resolve) => {
      Swal.fire({
        title: 'Input',
        text: message,
        input: 'text',
        inputValue: defaultValue || '',
        showCancelButton: true,
        confirmButtonText: 'OK',
        cancelButtonText: 'Batal'
      }).then((result) => {
        resolve(result.isConfirmed ? result.value : null);
      });
    });
  };
}

/**
 * Helper functions for showing different types of alerts
 */

// Success notification
function showSuccessAlert(message, title = 'Berhasil!') {
  Swal.fire({
    icon: 'success',
    title: title,
    text: message,
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false
  });
}

// Error notification
function showErrorAlert(message, title = 'Error!') {
  Swal.fire({
    icon: 'error',
    title: title,
    text: message,
    timer: 3000,
    timerProgressBar: true,
    showConfirmButton: false
  });
}

// Warning notification
function showWarningAlert(message, title = 'Peringatan!') {
  Swal.fire({
    icon: 'warning',
    title: title,
    text: message,
    confirmButtonText: 'OK'
  });
}

// Information notification
function showInfoAlert(message, title = 'Informasi') {
  Swal.fire({
    icon: 'info',
    title: title,
    text: message,
    confirmButtonText: 'OK'
  });
}

// Confirmation dialog
function showConfirmDialog(message, callback, title = 'Konfirmasi') {
  Swal.fire({
    title: title,
    text: message,
    icon: 'question',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    confirmButtonText: 'Ya',
    cancelButtonText: 'Tidak'
  }).then((result) => {
    if (result.isConfirmed && typeof callback === 'function') {
      callback();
    }
  });
}

// Delete confirmation dialog
function showDeleteConfirmDialog(message, callback, title = 'Konfirmasi Hapus') {
  Swal.fire({
    title: title,
    text: message,
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#d33',
    cancelButtonColor: '#3085d6',
    confirmButtonText: 'Ya, Hapus!',
    cancelButtonText: 'Batal'
  }).then((result) => {
    if (result.isConfirmed && typeof callback === 'function') {
      callback();
    }
  });
}

// Input prompt
function showPromptDialog(message, callback, defaultValue = '', title = 'Input') {
  Swal.fire({
    title: title,
    text: message,
    input: 'text',
    inputValue: defaultValue,
    showCancelButton: true,
    confirmButtonText: 'OK',
    cancelButtonText: 'Batal',
    inputValidator: (value) => {
      if (!value) {
        return 'Input tidak boleh kosong!';
      }
    }
  }).then((result) => {
    if (result.isConfirmed && typeof callback === 'function') {
      callback(result.value);
    }
  });
}
