// Consultation Form Handler - Using FormSpree
document.addEventListener('DOMContentLoaded', function() {
  const consultationForm = document.getElementById('consultationForm');
  
  if (!consultationForm) return;

  // FormSpree endpoint - Update this with your FormSpree form ID
  // Get your form ID from https://formspree.io/
  const FORMSPREE_ID = 'myzgndov'; // Replace with your actual FormSpree ID

  // Form field references
  const formFields = {
    name: document.getElementById('consName'),
    email: document.getElementById('consEmail'),
    message: document.getElementById('consMessage')
  };

  // Error message references
  const errorFields = {
    name: document.getElementById('consNameError'),
    email: document.getElementById('consEmailError'),
    message: document.getElementById('consMessageError')
  };

  // Form message container
  const formMessage = document.getElementById('consFormMessage');
  const submitBtn = consultationForm.querySelector('.submit-btn');

  /**
   * Clear error message for a field
   */
  function clearError(fieldName) {
    if (errorFields[fieldName]) {
      errorFields[fieldName].textContent = '';
      errorFields[fieldName].style.display = 'none';
    }
  }

  /**
   * Display error message for a field
   */
  function showError(fieldName, message) {
    if (errorFields[fieldName]) {
      errorFields[fieldName].textContent = message;
      errorFields[fieldName].style.display = 'block';
    }
  }

  /**
   * Validate email format
   */
  function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
  }

  /**
   * Validate phone number (basic validation)
   */
  function isValidPhone(phone) {
    const phoneRegex = /^[\d\s\-\+\(\)]{7,}$/;
    return phoneRegex.test(phone.replace(/\s/g, ''));
  }

  /**
   * Validate form fields
   */
  function validateForm() {
    let isValid = true;

    // Clear all errors first
    Object.keys(errorFields).forEach(field => clearError(field));

    // Name validation
    const name = formFields.name.value.trim();
    if (!name) {
      showError('name', 'Name is required');
      isValid = false;
    } else if (name.length < 2) {
      showError('name', 'Name must be at least 2 characters');
      isValid = false;
    }

    // Email validation
    const email = formFields.email.value.trim();
    if (!email) {
      showError('email', 'Email is required');
      isValid = false;
    } else if (!isValidEmail(email)) {
      showError('email', 'Please enter a valid email address');
      isValid = false;
    }

    // Message validation
    const message = formFields.message.value.trim();
    if (!message) {
      showError('message', 'Message is required');
      isValid = false;
    } else if (message.length < 10) {
      showError('message', 'Message must be at least 10 characters');
      isValid = false;
    }

    return isValid;
  }

  /**
   * Show form message (success or error)
   */
  function showFormMessage(message, type = 'success') {
    if (!formMessage) return;

    formMessage.textContent = message;
    formMessage.className = `form-message ${type}`;
    formMessage.style.display = 'block';

    // Auto-hide success message after 5 seconds
    if (type === 'success') {
      setTimeout(() => {
        formMessage.style.display = 'none';
      }, 5000);
    }
  }

  /**
   * Reset form to initial state
   */
  function resetForm() {
    consultationForm.reset();
    Object.keys(errorFields).forEach(field => clearError(field));
  }

  /**
   * Handle form submission
   */
  consultationForm.addEventListener('submit', async function(e) {
    e.preventDefault();

    // Clear previous messages
    if (formMessage) {
      formMessage.style.display = 'none';
    }

    // Validate form
    if (!validateForm()) {
      showFormMessage('Please fix the errors above', 'error');
      return;
    }

    // Set loading state
    if (submitBtn) {
      submitBtn.disabled = true;
      submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Sending...';
    }

    console.log('Consultation form submission started');

    try {
      // Prepare form data for FormSpree
      const formData = new FormData();
      formData.append('name', formFields.name.value.trim());
      formData.append('email', formFields.email.value.trim());
      formData.append('message', formFields.message.value.trim());

      console.log('Sending consultation request via FormSpree to:', `https://formspree.io/f/${FORMSPREE_ID}`);

      // Send form data to FormSpree
      const response = await fetch(`https://formspree.io/f/xrepjawy`, {
        method: 'POST',
        body: formData,
        headers: {
          'Accept': 'application/json'
        }
      });

      console.log('Response status:', response.status);
      console.log('Response ok:', response.ok);

      if (response.ok) {
        console.log('Consultation request sent successfully!');
        showFormMessage('✓ Thank you! Your message has been sent successfully.', 'success');
        resetForm();
      } else {
        try {
          const errorData = await response.json();
          console.error('FormSpree Error:', errorData);
        } catch (e) {
          console.error('FormSpree Error (response not JSON):', response.statusText);
        }
        showFormMessage('Error sending message. Please try again or contact directly.', 'error');
      }
    } catch (error) {
      console.error('Form Submission Error:', error.message);
      console.error('Error stack:', error);
      showFormMessage('Error sending message. Please try again or contact directly.', 'error');
    } finally {
      // Reset button state
      if (submitBtn) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = '<i class="fas fa-arrow-right"></i> Send Request';
      }
    }
  });

  /**
   * Real-time validation on field blur
   */
  Object.keys(formFields).forEach(fieldName => {
    const field = formFields[fieldName];
    
    field.addEventListener('blur', function() {
      // Only validate if field has a value (don't show error on empty blur)
      if (this.value.trim()) {
        switch(fieldName) {
          case 'name':
            if (this.value.trim().length < 2) {
              showError('name', 'Name must be at least 2 characters');
            } else {
              clearError('name');
            }
            break;
          
          case 'email':
            if (!isValidEmail(this.value.trim())) {
              showError('email', 'Please enter a valid email address');
            } else {
              clearError('email');
            }
            break;
          
          case 'message':
            if (this.value.trim().length < 10) {
              showError('message', 'Message must be at least 10 characters');
            } else {
              clearError('message');
            }
            break;
        }
      }
    });

    // Clear error on focus
    field.addEventListener('focus', function() {
      clearError(fieldName);
    });
  });

  /**
   * Validate topic selection on change
   */

  /**
   * Real-time character count for message
   */
  const messageField = formFields.message;
  if (messageField) {
    messageField.addEventListener('input', function() {
      const charCount = this.value.length;
      
      if (charCount < 10) {
        showError('message', `Message must be at least 10 characters (${charCount}/10)`);
      } else {
        clearError('message');
      }
    });
  }
});
