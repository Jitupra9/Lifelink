document.addEventListener('DOMContentLoaded', function() {
    // Main tabs functionality
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');
  
    tabButtons.forEach(button => {
      button.addEventListener('click', () => {
        const tabId = button.getAttribute('data-tab');
        
        // Remove active class from all buttons and contents
        tabButtons.forEach(btn => btn.classList.remove('active'));
        tabContents.forEach(content => content.classList.remove('active'));
        
        // Add active class to clicked button and corresponding content
        button.classList.add('active');
        document.getElementById(tabId).classList.add('active');
      });
    });
  
    // Subtabs functionality (for donation history)
    const subtabButtons = document.querySelectorAll('.subtab-button');
    const subtabContents = document.querySelectorAll('.subtab-content');
  
    subtabButtons.forEach(button => {
      button.addEventListener('click', () => {
        const subtabId = button.getAttribute('data-subtab');
        
        // Remove active class from all buttons and contents
        subtabButtons.forEach(btn => btn.classList.remove('active'));
        subtabContents.forEach(content => content.classList.remove('active'));
        
        // Add active class to clicked button and corresponding content
        button.classList.add('active');
        document.getElementById(subtabId).classList.add('active');
      });
    });
  
    // Resource tabs functionality
    const resourceTabButtons = document.querySelectorAll('.resource-tab-button');
    const resourceTabContents = document.querySelectorAll('.resource-tab-content');
  
    resourceTabButtons.forEach(button => {
      button.addEventListener('click', () => {
        const resourceTabId = button.getAttribute('data-resource-tab');
        
        // Remove active class from all buttons and contents
        resourceTabButtons.forEach(btn => btn.classList.remove('active'));
        resourceTabContents.forEach(content => content.classList.remove('active'));
        
        // Add active class to clicked button and corresponding content
        button.classList.add('active');
        document.getElementById(resourceTabId).classList.add('active');
      });
    });
  
    // Accordion functionality
    const accordionButtons = document.querySelectorAll('.accordion-button');
    
    accordionButtons.forEach(button => {
      button.addEventListener('click', () => {
        const accordionContent = button.nextElementSibling;
        
        // Toggle active class on button and content
        button.classList.toggle('active');
        
        if (accordionContent.classList.contains('active')) {
          accordionContent.classList.remove('active');
        } else {
          accordionContent.classList.add('active');
        }
      });
    });
  
    // Form validation
    const personalInfoForm = document.getElementById('personal-info-form');
    
    if (personalInfoForm) {
      personalInfoForm.addEventListener('submit', function(e) {
        e.preventDefault();
        
        let isValid = true;
        const formData = {};
        
        // Basic validation
        const requiredFields = [
          'firstName', 'lastName', 'email', 'phone', 
          'address', 'city', 'state', 'zipCode', 
          'bloodType', 'emergencyContactName', 'emergencyContactPhone'
        ];
        
        requiredFields.forEach(field => {
          const input = document.getElementById(field);
          const errorElement = document.getElementById(`${field}-error`);
          
          if (!input.value.trim()) {
            isValid = false;
            errorElement.textContent = 'This field is required';
          } else {
            errorElement.textContent = '';
            formData[field] = input.value.trim();
          }
        });
        
        // Email validation
        const emailInput = document.getElementById('email');
        const emailError = document.getElementById('email-error');
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        
        if (emailInput.value.trim() && !emailRegex.test(emailInput.value.trim())) {
          isValid = false;
          emailError.textContent = 'Please enter a valid email address';
        }
        
        // Get checkbox value
        formData.isOrganDonor = document.getElementById('isOrganDonor').checked;
        
        // Get textarea value
        formData.medicalConditions = document.getElementById('medicalConditions').value.trim();
        
        if (isValid) {
          // Simulate form submission
          const submitButton = personalInfoForm.querySelector('button[type="submit"]');
          const originalText = submitButton.textContent;
          
          submitButton.textContent = 'Saving...';
          submitButton.disabled = true;
          
          // Simulate API call with timeout
          setTimeout(() => {
            console.log('Form data:', formData);
            
            // Show success message
            alert('Profile updated successfully!');
            
            // Reset button
            submitButton.textContent = originalText;
            submitButton.disabled = false;
          }, 1000);
        }
      });
    }
  
    // Search functionality for donation centers
    const centerSearchInput = document.getElementById('center-search');
    const centerCards = document.querySelectorAll('.center-card');
    
    if (centerSearchInput) {
      centerSearchInput.addEventListener('input', function() {
        const searchTerm = this.value.toLowerCase().trim();
        
        centerCards.forEach(card => {
          const centerName = card.querySelector('h3').textContent.toLowerCase();
          const centerAddress = card.querySelector('.center-address span').textContent.toLowerCase();
          
          if (centerName.includes(searchTerm) || centerAddress.includes(searchTerm)) {
            card.style.display = 'block';
          } else {
            card.style.display = 'none';
          }
        });
      });
    }
  
    // Use my location button
    const locationButton = document.querySelector('.search-container .btn-outline');
    
    if (locationButton) {
      locationButton.addEventListener('click', function() {
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(
            (position) => {
              // In a real app, you would use these coordinates to fetch nearby centers
              const latitude = position.coords.latitude;
              const longitude = position.coords.longitude;
              
              console.log(`Location: ${latitude}, ${longitude}`);
              alert('Location accessed! In a real application, this would show donation centers near your current location.');
            },
            (error) => {
              console.error('Error getting location:', error);
              alert('Unable to access your location. Please check your browser settings.');
            }
          );
        } else {
          alert('Geolocation is not supported by your browser.');
        }
      });
    }
  });