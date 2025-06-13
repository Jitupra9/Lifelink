document.addEventListener('DOMContentLoaded', function() {
  // Set current year in footer
  document.getElementById('current-year').textContent = new Date().getFullYear();

  // Form navigation
  const form = document.getElementById('donor-form');
  const steps = document.querySelectorAll('.form-step');
  const nextBtn = document.getElementById('next-btn');
  const prevBtn = document.getElementById('prev-btn');
  const submitBtn = document.getElementById('submit-btn');
  const stepDots = document.querySelectorAll('.step-dot');
  let currentStep = 1;

  // Tab navigation
  const tabButtons = document.querySelectorAll('.tab-button');
  const tabContents = document.querySelectorAll('.tab-content');

  // Accordion functionality
  const accordionButtons = document.querySelectorAll('.accordion-button');

  // Success message
  const registrationForm = document.getElementById('registration-form');
  const successMessage = document.getElementById('success-message');
  const registerAnotherBtn = document.getElementById('register-another');

  // Form validation
  const formFields = {
    firstName: {
      required: true,
      minLength: 2,
      errorMessage: 'First name must be at least 2 characters.'
    },
    lastName: {
      required: true,
      minLength: 2,
      errorMessage: 'Last name must be at least 2 characters.'
    },
    email: {
      required: true,
      pattern: /^[^\s@]+@[^\s@]+\.[^\s@]+$/,
      errorMessage: 'Please enter a valid email address.'
    },
    phone: {
      required: true,
      minLength: 10,
      errorMessage: 'Please enter a valid phone number.'
    },
    dateOfBirth: {
      required: true,
      validate: function(value) {
        const today = new Date();
        const dob = new Date(value);
        const age = today.getFullYear() - dob.getFullYear();
        return age >= 18;
      },
      errorMessage: 'You must be at least 18 years old.'
    },
    address: {
      required: true,
      minLength: 5,
      errorMessage: 'Please enter your full address.'
    },
    city: {
      required: true,
      minLength: 2,
      errorMessage: 'Please enter your city.'
    },
    state: {
      required: true,
      errorMessage: 'Please select your state.'
    },
    zipCode: {
      required: true,
      minLength: 5,
      errorMessage: 'Please enter a valid zip code.'
    },
    donationType: {
      required: true,
      validate: function() {
        const checkboxes = document.querySelectorAll('input[name="donationType"]:checked');
        return checkboxes.length > 0;
      },
      errorMessage: 'Please select at least one donation type.'
    },
    emergencyContactName: {
      required: true,
      minLength: 2,
      errorMessage: 'Please provide an emergency contact.'
    },
    emergencyContactPhone: {
      required: true,
      minLength: 10,
      errorMessage: 'Please provide a valid emergency contact number.'
    },
    consentOrgan: {
      required: true,
      errorMessage: 'You must consent to organ donation.'
    },
    consentPrivacy: {
      required: true,
      errorMessage: 'You must agree to the privacy policy.'
    }
  };

  // Initialize form
  function initForm() {
    showStep(1);
    updateStepIndicator();
  }

  // Show specific step
  function showStep(step) {
    steps.forEach((stepEl, index) => {
      if (index + 1 === step) {
        stepEl.classList.remove('hidden');
      } else {
        stepEl.classList.add('hidden');
      }
    });

    // Update buttons
    if (step === 1) {
      prevBtn.classList.add('hidden');
    } else {
      prevBtn.classList.remove('hidden');
    }

    if (step === steps.length) {
      nextBtn.classList.add('hidden');
      submitBtn.classList.remove('hidden');
    } else {
      nextBtn.classList.remove('hidden');
      submitBtn.classList.add('hidden');
    }

    currentStep = step;
    updateStepIndicator();
  }

  // Update step indicator
  function updateStepIndicator() {
    stepDots.forEach((dot, index) => {
      const step = index + 1;
      dot.classList.remove('active', 'completed');
      
      if (step === currentStep) {
        dot.classList.add('active');
      } else if (step < currentStep) {
        dot.classList.add('completed');
      }
    });
  }

  // Validate step
  function validateStep(step) {
    let isValid = true;
    const fieldsToValidate = [];

    // Determine which fields to validate based on current step
    if (step === 1) {
      fieldsToValidate.push('firstName', 'lastName', 'email', 'phone', 'dateOfBirth', 'address', 'city', 'state', 'zipCode');
    } else if (step === 2) {
      fieldsToValidate.push('donationType', 'emergencyContactName', 'emergencyContactPhone');
    } else if (step === 3) {
      fieldsToValidate.push('consentOrgan', 'consentPrivacy');
    }

    // Validate each field
    fieldsToValidate.forEach(fieldName => {
      const field = formFields[fieldName];
      const element = document.getElementById(fieldName);
      const errorElement = document.getElementById(`${fieldName}-error`);
      let fieldValid = true;

      // Special case for checkbox groups
      if (fieldName === 'donationType') {
        fieldValid = field.validate();
      } else if (element) {
        // Check if required
        if (field.required && !element.value) {
          fieldValid = false;
        }

        // Check min length
        if (field.minLength && element.value.length < field.minLength) {
          fieldValid = false;
        }

        // Check pattern
        if (field.pattern && !field.pattern.test(element.value)) {
          fieldValid = false;
        }

        // Custom validation
        if (field.validate && !field.validate(element.value)) {
          fieldValid = false;
        }

        // For checkboxes
        if (element.type === 'checkbox' && field.required && !element.checked) {
          fieldValid = false;
        }
      }

      // Update error message
      if (errorElement) {
        errorElement.textContent = fieldValid ? '' : field.errorMessage;
      }

      if (!fieldValid) {
        isValid = false;
      }
    });

    return isValid;
  }

  // Next button click
  nextBtn.addEventListener('click', function() {
    if (validateStep(currentStep)) {
      showStep(currentStep + 1);
      window.scrollTo(0, 0);
    }
  });

  // Previous button click
  prevBtn.addEventListener('click', function() {
    showStep(currentStep - 1);
    window.scrollTo(0, 0);
  });

  // Form submission
  form.addEventListener('submit', function(e) {
    e.preventDefault();
    
    if (validateStep(currentStep)) {
      // Simulate form submission with loading state
      submitBtn.textContent = 'Submitting...';
      submitBtn.disabled = true;
      
      // Simulate API call
      setTimeout(function() {
        registrationForm.classList.add('hidden');
        successMessage.classList.remove('hidden');
        window.scrollTo(0, 0);
      }, 1500);
    }
  });

  // Register another button
  registerAnotherBtn.addEventListener('click', function() {
    form.reset();
    successMessage.classList.add('hidden');
    registrationForm.classList.remove('hidden');
    submitBtn.textContent = 'Complete Registration';
    submitBtn.disabled = false;
    initForm();
  });

  // Tab functionality
  tabButtons.forEach(button => {
    button.addEventListener('click', function() {
      const tabId = this.getAttribute('data-tab');
      
      // Update active tab button
      tabButtons.forEach(btn => btn.classList.remove('active'));
      this.classList.add('active');
      
      // Show active tab content
      tabContents.forEach(content => {
        content.classList.remove('active');
        if (content.id === `${tabId}-tab`) {
          content.classList.add('active');
        }
      });
    });
  });

  // Accordion functionality
  accordionButtons.forEach(button => {
    button.addEventListener('click', function() {
      this.classList.toggle('active');
      const content = this.parentElement.nextElementSibling;
      
      if (this.classList.contains('active')) {
        content.style.maxHeight = content.scrollHeight + 'px';
      } else {
        content.style.maxHeight = '0';
      }
    });
  });

  // Initialize the form
  initForm();
});