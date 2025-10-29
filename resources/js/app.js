import './bootstrap';

console.log('app.js loaded!');

// Application Form Validation and Wizard
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOMContentLoaded fired!');
    // Mobile menu toggle
    const mobileMenuToggle = document.getElementById('mobile-menu-toggle');
    const navLinks = document.getElementById('nav-links');
    
    if (mobileMenuToggle && navLinks) {
        mobileMenuToggle.addEventListener('click', function() {
            navLinks.classList.toggle('mobile-menu');
            
            // Toggle hamburger icon
            const icon = mobileMenuToggle.querySelector('i');
            if (navLinks.classList.contains('mobile-menu')) {
                icon.classList.remove('fa-bars');
                icon.classList.add('fa-times');
            } else {
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            }
        });
        
        // Close mobile menu when clicking on a link
        const navLinkItems = navLinks.querySelectorAll('a');
        navLinkItems.forEach(link => {
            link.addEventListener('click', function() {
                navLinks.classList.remove('mobile-menu');
                const icon = mobileMenuToggle.querySelector('i');
                icon.classList.remove('fa-times');
                icon.classList.add('fa-bars');
            });
        });
    }
    
    const form = document.getElementById('application-form');
    
    if (form) {
        // Initialize Form Wizard
        initFormWizard();
        // Real-time validation for required fields
        const requiredFields = form.querySelectorAll('[required]');
        
        requiredFields.forEach(field => {
            field.addEventListener('blur', function() {
                validateField(this);
            });
            
            field.addEventListener('change', function() {
                validateField(this);
            });
        });
        
        // Email validation
        const emailField = form.querySelector('input[type="email"]');
        if (emailField) {
            emailField.addEventListener('blur', function() {
                validateEmail(this);
            });
        }
        
        // Phone validation
        const phoneField = form.querySelector('input[name="telephone"]');
        if (phoneField) {
            phoneField.addEventListener('blur', function() {
                validatePhone(this);
            });
        }
        
        // Form submission with Axios
        form.addEventListener('submit', function(e) {
            // Always prevent default form submission
            e.preventDefault();
            e.stopPropagation();
            
            if (validateForm()) {
                submitFormWithAxios(this);
            } else {
                // Scroll to first error
                const firstError = form.querySelector('.has-error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
            
            // Extra safety - always return false
            return false;
        });
        
        // Additional safety: also prevent submission on button click
        const submitBtn = form.querySelector('.btn-submit');
        if (submitBtn) {
            submitBtn.addEventListener('click', function(e) {
                e.preventDefault();
                
                // Trigger the form submit event which will handle validation and Axios
                form.dispatchEvent(new Event('submit'));
                return false;
            });
        }
    }
    
    // Initialize Contact Form Validation
    initContactFormValidation();
    
    // Initialize Reviews Slider
    console.log('About to call initReviewsSlider');
    initReviewsSlider();
    console.log('initReviewsSlider called');
});

function validateField(field) {
    const formGroup = field.closest('.form-group');
    clearValidationState(formGroup);
    
    if (field.hasAttribute('required') && !field.value.trim()) {
        showError(formGroup, 'Dit veld is verplicht');
        return false;
    }
    
    if (field.type === 'radio') {
        const radioGroup = field.closest('.radio-group');
        const checked = radioGroup.querySelector('input[type="radio"]:checked');
        if (field.hasAttribute('required') && !checked) {
            showError(formGroup, 'Selecteer alstublieft een optie');
            return false;
        } else if (checked) {
            showSuccess(formGroup);
            return true;
        }
    }
    
    if (field.value.trim()) {
        showSuccess(formGroup);
    }
    
    return true;
}

function validateEmail(field) {
    const formGroup = field.closest('.form-group');
    clearValidationState(formGroup);
    
    if (!field.value.trim()) {
        if (field.hasAttribute('required')) {
            showError(formGroup, 'E-mailadres is verplicht');
            return false;
        }
        return true;
    }
    
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailRegex.test(field.value)) {
        showError(formGroup, 'Voer een geldig e-mailadres in');
        return false;
    }
    
    showSuccess(formGroup);
    return true;
}

function validatePhone(field) {
    const formGroup = field.closest('.form-group');
    clearValidationState(formGroup);
    
    if (!field.value.trim()) {
        if (field.hasAttribute('required')) {
            showError(formGroup, 'Telefoonnummer is verplicht');
            return false;
        }
        return true;
    }
    
    const phoneRegex = /^[\d\s\+\-\(\)]{10,}$/;
    if (!phoneRegex.test(field.value)) {
        showError(formGroup, 'Voer een geldig telefoonnummer in');
        return false;
    }
    
    showSuccess(formGroup);
    return true;
}

function validateForm() {
    const form = document.getElementById('application-form');
    let isValid = true;
    
    // Validate all required fields
    const requiredFields = form.querySelectorAll('[required]');
    requiredFields.forEach(field => {
        if (!validateField(field)) {
            isValid = false;
        }
    });
    
    // Validate email specifically
    const emailField = form.querySelector('input[type="email"]');
    if (emailField && !validateEmail(emailField)) {
        isValid = false;
    }
    
    // Validate phone specifically  
    const phoneField = form.querySelector('input[name="telephone"]');
    if (phoneField && !validatePhone(phoneField)) {
        isValid = false;
    }
    
    // Check required radio groups
    const radioGroups = form.querySelectorAll('.radio-group');
    radioGroups.forEach(group => {
        const requiredRadio = group.querySelector('input[required]');
        if (requiredRadio) {
            const checked = group.querySelector('input[type="radio"]:checked');
            const formGroup = group.closest('.form-group');
            
            if (!checked) {
                showError(formGroup, 'Selecteer alstublieft een optie');
                isValid = false;
            } else {
                showSuccess(formGroup);
            }
        }
    });
    
    return isValid;
}

function showError(formGroup, message) {
    formGroup.classList.remove('has-success');
    formGroup.classList.add('has-error');
    
    // Remove existing error message
    const existingError = formGroup.querySelector('.field-error');
    if (existingError) {
        existingError.remove();
    }
    
    // Add error message
    const errorDiv = document.createElement('div');
    errorDiv.className = 'field-error';
    errorDiv.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
    formGroup.appendChild(errorDiv);
}

function showSuccess(formGroup) {
    formGroup.classList.remove('has-error');
    formGroup.classList.add('has-success');
    
    // Remove existing messages
    const existingError = formGroup.querySelector('.field-error');
    const existingSuccess = formGroup.querySelector('.field-success');
    
    if (existingError) existingError.remove();
    if (existingSuccess) existingSuccess.remove();
}

function clearValidationState(formGroup) {
    formGroup.classList.remove('has-error', 'has-success');
    
    const existingError = formGroup.querySelector('.field-error');
    const existingSuccess = formGroup.querySelector('.field-success');
    
    if (existingError) existingError.remove();
    if (existingSuccess) existingSuccess.remove();
}

// Axios form submission function
function submitFormWithAxios(form) {
    const submitBtn = form.querySelector('.btn-submit');
    if (!submitBtn) {
        console.error('Submit button not found');
        return;
    }
    const originalText = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.classList.add('loading');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Bezig met verzenden...';
    
    // Clear any existing alerts
    clearExistingAlerts();
    
    // Prepare form data
    const formData = new FormData(form);
    
            // Handle newsletter checkbox - send boolean values
            const newsletterCheckbox = form.querySelector('input[name="newsletter"]');
            if (newsletterCheckbox && newsletterCheckbox.checked) {
                formData.set('newsletter', 'true');
            } else {
                formData.set('newsletter', 'false');
            }
    
    // Ensure privacy checkbox is properly handled
    const privacyCheckbox = form.querySelector('input[name="privacy_akkoord"]');
    if (privacyCheckbox && privacyCheckbox.checked) {
        formData.set('privacy_akkoord', '1'); // Laravel 'accepted' rule expects '1', 'yes', 'on', 'true'
    } else {
        formData.delete('privacy_akkoord'); // Remove if not checked - this will cause validation to fail as expected
    }
    
    // Convert extra_hulp array to proper format
    const extraHulpElements = form.querySelectorAll('input[name="extra_hulp[]"]:checked');
    formData.delete('extra_hulp[]'); // Remove auto-added values
    extraHulpElements.forEach(checkbox => {
        formData.append('extra_hulp[]', checkbox.value);
    });
    
    // Submit with Axios
    axios.post(form.action, formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(function (response) {
        // Success handling
                if (response.data.success) {
                    // Check if there's a redirect URL
                    if (response.data.redirect) {
                        // Redirect to thank you page
                        window.location.href = response.data.redirect;
                    } else {
                        showSuccessMessage(response.data.message);
                        form.reset(); // Clear the form
                        clearAllValidationStates(); // Clear validation states
                        
                        // Scroll to success message
                        setTimeout(() => {
                            const alertElement = document.querySelector('.alert-success');
                            if (alertElement) {
                                alertElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                        }, 100);
                    }
                } else {
                    showErrorMessage(response.data.message || 'Er is een onbekende fout opgetreden.');
                    
                    // Scroll to error message
                    setTimeout(() => {
                        const alertElement = document.querySelector('.alert-error');
                        if (alertElement) {
                            alertElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        }
                    }, 100);
                }
    })
    .catch(function (error) {
        console.error('Full error object:', error);
        
        if (error.response) {
            console.error('Response data:', error.response.data);
            console.error('Response status:', error.response.status);
            
                    if (error.response.status === 422) {
                        // Validation errors
                        const errors = error.response.data.errors;
                        console.error('Validation errors:', errors);
                        showValidationErrors(errors);
                        
                        // Show general error message
                        showErrorMessage(error.response.data.message || 'Er zijn enkele problemen met uw invoer.');
                        
                        // Scroll to error message
                        setTimeout(() => {
                            const alertElement = document.querySelector('.alert-error');
                            if (alertElement) {
                                alertElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                        }, 100);
                    } else {
                        // Other server errors
                        showErrorMessage(error.response.data.message || 'Er is een serverfout opgetreden. Probeer het opnieuw.');
                        
                        // Scroll to error message
                        setTimeout(() => {
                            const alertElement = document.querySelector('.alert-error');
                            if (alertElement) {
                                alertElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                            }
                        }, 100);
                    }
        } else if (error.request) {
            // Network error
            console.error('Network error:', error.request);
            showErrorMessage('Er is een netwerkfout opgetreden. Controleer uw internetverbinding en probeer het opnieuw.');
            
            // Scroll to error message
            setTimeout(() => {
                const alertElement = document.querySelector('.alert-error');
                if (alertElement) {
                    alertElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }, 100);
        } else {
            // Other error
            console.error('Other error:', error.message);
            showErrorMessage('Er is een onverwachte fout opgetreden. Probeer het opnieuw.');
            
            // Scroll to error message
            setTimeout(() => {
                const alertElement = document.querySelector('.alert-error');
                if (alertElement) {
                    alertElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }, 100);
        }
    })
    .finally(function () {
        // Reset button state
        submitBtn.classList.remove('loading');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
}


function clearExistingAlerts() {
    const existingAlerts = document.querySelectorAll('.alert');
    existingAlerts.forEach(alert => alert.remove());
}

function showSuccessMessage(message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-success';
    alertDiv.innerHTML = `
        <i class="fas fa-check-circle"></i>
        ${message}
    `;
    
    // Try to find application form first, then contact form
    let form = document.getElementById('application-form');
    if (!form) {
        form = document.getElementById('contact-form');
    }
    
    if (form && form.parentNode) {
        form.parentNode.insertBefore(alertDiv, form);
    } else {
        // Fallback: insert at the beginning of the body
        document.body.insertBefore(alertDiv, document.body.firstChild);
    }
}

function showErrorMessage(message) {
    const alertDiv = document.createElement('div');
    alertDiv.className = 'alert alert-error';
    alertDiv.innerHTML = `
        <i class="fas fa-exclamation-triangle"></i>
        ${message}
    `;
    
    // Try to find application form first, then contact form
    let form = document.getElementById('application-form');
    if (!form) {
        form = document.getElementById('contact-form');
    }
    
    if (form && form.parentNode) {
        form.parentNode.insertBefore(alertDiv, form);
    } else {
        // Fallback: insert at the beginning of the body
        document.body.insertBefore(alertDiv, document.body.firstChild);
    }
    
    // Scroll to error message
    alertDiv.scrollIntoView({ behavior: 'smooth', block: 'center' });
}

function showValidationErrors(errors) {
    // Clear existing field errors first
    clearAllValidationStates();
    
    Object.keys(errors).forEach(fieldName => {
        const fieldErrors = errors[fieldName];
        if (fieldErrors && fieldErrors.length > 0) {
            const field = document.querySelector(`[name="${fieldName}"]`);
            
            if (field) {
                const formGroup = field.closest('.form-group');
                if (formGroup) {
                    showError(formGroup, fieldErrors[0]);
                }
            }
        }
    });
    
    // Scroll to first error
    const firstError = document.querySelector('.has-error');
    if (firstError) {
        firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
    }
}

function clearAllValidationStates() {
    const formGroups = document.querySelectorAll('.form-group');
    formGroups.forEach(formGroup => {
        clearValidationState(formGroup);
    });
}

// Form Wizard Functionality
let currentStep = 1;
let maxReachedStep = 1;
const totalSteps = 6;

function initFormWizard() {
    // Hide all steps except the first one
    const steps = document.querySelectorAll('.form-step');
    steps.forEach((step, index) => {
        if (index === 0) {
            step.classList.add('active');
        } else {
            step.classList.remove('active');
        }
    });
    
    // Initialize navigation buttons
    initNavigationButtons();
    
    // Initialize progress step navigation
    initProgressStepNavigation();
    
    // Update progress bar
    updateProgressBar();
}

function initNavigationButtons() {
    // Previous buttons
    const prevButtons = document.querySelectorAll('.btn-previous');
    prevButtons.forEach(button => {
        button.addEventListener('click', function() {
            const prevStep = parseInt(this.getAttribute('data-prev'));
            if (prevStep) {
                goToStep(prevStep);
            }
        });
    });
    
    // Next buttons
    const nextButtons = document.querySelectorAll('.btn-next');
    nextButtons.forEach(button => {
        button.addEventListener('click', function() {
            const nextStep = parseInt(this.getAttribute('data-next'));
            if (nextStep && validateCurrentStep()) {
                goToStep(nextStep);
            }
        });
    });
    
    // Submit button
    const submitButton = document.querySelector('.btn-submit');
}

function initProgressStepNavigation() {
    // Add click handlers to progress step circles
    const progressSteps = document.querySelectorAll('.progress-step');
    
    progressSteps.forEach(progressStep => {
        const stepNumber = parseInt(progressStep.getAttribute('data-step'));
        
        progressStep.style.cursor = 'pointer';
        progressStep.addEventListener('click', function() {
            // Only allow navigation to completed steps or current step
            if (stepNumber <= maxReachedStep) {
                goToStep(stepNumber);
            } else {
                // Add visual feedback for inaccessible steps
                this.style.animation = 'shake 0.5s ease-in-out';
                setTimeout(() => {
                    this.style.animation = '';
                }, 500);
            }
        });
        
        // Add hover effects
        progressStep.addEventListener('mouseenter', function() {
            if (stepNumber <= maxReachedStep) {
                this.style.transform = 'scale(1.05)';
                this.style.transition = 'transform 0.2s ease';
            }
        });
        
        progressStep.addEventListener('mouseleave', function() {
            this.style.transform = '';
        });
    });
}

function goToStep(stepNumber) {
    if (stepNumber < 1 || stepNumber > totalSteps) {
        console.error('Invalid step number:', stepNumber);
        return;
    }
    
    // Get current step element
    const currentStepElement = document.querySelector('.form-step.active');
    const targetStep = document.querySelector(`.form-step[data-step="${stepNumber}"]`);
    
    if (!targetStep) {
        console.error('Target step not found:', stepNumber);
        return;
    }
    
    // Add slide out animation to current step
    if (currentStepElement) {
        currentStepElement.classList.add('slide-out');
        
        // Wait for slide out animation to complete, then switch steps
        setTimeout(() => {
            currentStepElement.classList.remove('active', 'slide-out');
            
            // Show target step
            targetStep.classList.add('active');
            currentStep = stepNumber;
            
            // Update max reached step
            if (stepNumber > maxReachedStep) {
                maxReachedStep = stepNumber;
            }
            
            // Update progress bar
            updateProgressBar();
            
            // Scroll to navigation steps instead of top
            const progressContainer = document.querySelector('.form-wizard-header');
            if (progressContainer) {
                progressContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
            }
        }, 300); // Match the CSS animation duration
    } else {
        // No current step, just show target step
        targetStep.classList.add('active');
        currentStep = stepNumber;
        
        // Update max reached step
        if (stepNumber > maxReachedStep) {
            maxReachedStep = stepNumber;
        }
        
        updateProgressBar();
        
        // Scroll to navigation steps
        const progressContainer = document.querySelector('.form-wizard-header');
        if (progressContainer) {
            progressContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
        }
    }
}

function updateProgressBar() {
    // Update progress line fill
    const progressLineFill = document.getElementById('progress-line-fill');
    if (progressLineFill) {
        const progressPercentage = ((currentStep - 1) / (totalSteps - 1)) * 100;
        progressLineFill.style.width = progressPercentage + '%';
    }
    
    // Update progress steps
    const progressSteps = document.querySelectorAll('.progress-step');
    progressSteps.forEach((step, index) => {
        const stepNumber = index + 1;
        
        step.classList.remove('active', 'completed');
        
        if (stepNumber === currentStep) {
            step.classList.add('active');
        } else if (stepNumber < currentStep) {
            step.classList.add('completed');
        }
    });
}

function validateCurrentStep() {
    const currentStepElement = document.querySelector(`.form-step[data-step="${currentStep}"]`);
    if (!currentStepElement) {
        console.error('Current step element not found');
        return false;
    }
    
    let isValid = true;
    
    // Validate required fields in current step
    const requiredFields = currentStepElement.querySelectorAll('[required]');
    
    requiredFields.forEach(field => {
        if (!validateField(field)) {
            isValid = false;
        }
    });
    
    // Validate email if present in current step
    const emailField = currentStepElement.querySelector('input[type="email"]');
    if (emailField && !validateEmail(emailField)) {
        isValid = false;
    }
    
    // Validate phone if present in current step
    const phoneField = currentStepElement.querySelector('input[name="telephone"]');
    if (phoneField && !validatePhone(phoneField)) {
        isValid = false;
    }
    
    // Validate radio groups in current step
    const radioGroups = currentStepElement.querySelectorAll('.radio-group');
    
    radioGroups.forEach((group, index) => {
        const requiredRadio = group.querySelector('input[required]');
        if (requiredRadio) {
            const checked = group.querySelector('input[type="radio"]:checked');
            const formGroup = group.closest('.form-group');
            
            if (!checked && formGroup) {
                showError(formGroup, 'Selecteer alstublieft een optie');
                isValid = false;
            } else if (checked && formGroup) {
                showSuccess(formGroup);
            }
        }
    });
    
    // Step-specific validation
    switch(currentStep) {
        case 1:
            // Validate accident type selection
            const accidentTypeField = currentStepElement.querySelector('input[name="soort_ongeval"]:checked');
            if (!accidentTypeField) {
                isValid = false;
            }
            break;
            
        case 2:
            // Validate date
            const dateField = currentStepElement.querySelector('input[name="datum_ongeval"]');
            if (dateField && !validateDate(dateField)) {
                isValid = false;
            }
            
            // Validate description
            const letselField = currentStepElement.querySelector('textarea[name="letsel"]');
            if (letselField && !letselField.value.trim()) {
                const formGroup = letselField.closest('.form-group');
                if (formGroup) {
                    showError(formGroup, 'Beschrijving van het letsel is verplicht');
                    isValid = false;
                }
            }
            break;
            
        case 3:
            // Validate damage description
            const damageField = currentStepElement.querySelector('textarea[name="schade_omschrijving"]');
            if (damageField && !damageField.value.trim()) {
                const formGroup = damageField.closest('.form-group');
                if (formGroup) {
                    showError(formGroup, 'Beschrijving van de schade is verplicht');
                    isValid = false;
                }
            }
            break;
            
        case 4:
            // Validate age
            const ageField = currentStepElement.querySelector('input[name="leeftijd"]');
            if (ageField) {
                const age = parseInt(ageField.value);
                if (!age || age < 18 || age > 100) {
                    const formGroup = ageField.closest('.form-group');
                    if (formGroup) {
                        showError(formGroup, 'Voer een geldige leeftijd in (18-100 jaar)');
                        isValid = false;
                    }
                }
            }
            break;
            
        case 6:
            // Validate privacy checkbox
            const privacyCheckbox = currentStepElement.querySelector('input[name="privacy_akkoord"]');
            if (privacyCheckbox && !privacyCheckbox.checked) {
                const formGroup = privacyCheckbox.closest('.form-group');
                if (formGroup) {
                    showError(formGroup, 'U moet akkoord gaan met de privacyverklaring');
                    isValid = false;
                }
            }
            break;
    }
    
    if (!isValid) {
        // Scroll to first error in current step
        const firstError = currentStepElement.querySelector('.has-error');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        
        console.log(`Step ${currentStep} validation failed`);
    } else {
        console.log(`Step ${currentStep} validation passed`);
    }
    
    return isValid;
}

function validateDate(field) {
    const formGroup = field.closest('.form-group');
    if (!formGroup) return true;
    
    clearValidationState(formGroup);
    
    if (!field.value.trim()) {
        if (field.hasAttribute('required')) {
            showError(formGroup, 'Datum van het ongeval is verplicht');
            return false;
        }
        return true;
    }
    
    const selectedDate = new Date(field.value);
    const today = new Date();
    today.setHours(23, 59, 59, 999);
    
    if (selectedDate > today) {
        showError(formGroup, 'De datum kan niet in de toekomst liggen');
        return false;
    }
    
    const tenYearsAgo = new Date();
    tenYearsAgo.setFullYear(tenYearsAgo.getFullYear() - 10);
    
    if (selectedDate < tenYearsAgo) {
        showError(formGroup, 'Datum mag niet meer dan 10 jaar geleden zijn');
        return false;
    }
    
    showSuccess(formGroup);
    return true;
}

function showStepError(message) {
    // Show error message at the top of current step
    const currentStepElement = document.querySelector(`.form-step[data-step="${currentStep}"]`);
    if (currentStepElement) {
        // Remove existing step error
        const existingError = currentStepElement.querySelector('.step-error');
        if (existingError) {
            existingError.remove();
        }
        
        // Create new error message
        const errorDiv = document.createElement('div');
        errorDiv.className = 'alert alert-error step-error';
        errorDiv.innerHTML = `
            <i class="fas fa-exclamation-triangle"></i>
            ${message}
        `;
        
        // Insert at the beginning of the step
        const stepContent = currentStepElement.querySelector('h3');
        if (stepContent) {
            stepContent.parentNode.insertBefore(errorDiv, stepContent);
        }
    }
}

// Contact Form Validation
function initContactFormValidation() {
    const contactForm = document.getElementById('contact-form');
    if (!contactForm) return;
    
    // Add event listeners to all form fields
    const fields = contactForm.querySelectorAll('input, textarea, select');
    fields.forEach(field => {
        field.addEventListener('blur', function() {
            validateContactField(this);
        });
        
        field.addEventListener('input', function() {
            // Clear error on input for better UX
            clearContactFieldError(this);
        });
    });
    
    // Form submission handler
    contactForm.addEventListener('submit', function(e) {
        e.preventDefault();
        submitContactForm(this);
    });
}

function validateContactField(field) {
    const formGroup = field.closest('.form-group');
    const fieldName = field.name;
    const value = field.value.trim();
    
    // Skip validation for hidden fields or fields without form-group
    if (!formGroup || field.type === 'hidden') {
        return true;
    }
    
    // Clear previous errors
    clearContactFieldError(field);
    
    // Required field validation
    if (field.hasAttribute('required') && !value) {
        showContactFieldError(field, getRequiredMessage(fieldName));
        return false;
    }
    
    // Specific field validations
    switch (fieldName) {
        case 'firstname':
        case 'lastname':
            if (value && value.length < 2) {
                showContactFieldError(field, 'Naam moet minimaal 2 karakters bevatten');
                return false;
            }
            break;
            
        case 'email':
            if (value && !isValidEmail(value)) {
                showContactFieldError(field, 'Voer een geldig e-mailadres in');
                return false;
            }
            break;
            
        case 'telephone':
            if (value && !isValidPhone(value)) {
                showContactFieldError(field, 'Voer een geldig telefoonnummer in');
                return false;
            }
            break;
            
        case 'details':
            if (value && value.length < 10) {
                showContactFieldError(field, 'Bericht moet minimaal 10 karakters bevatten');
                return false;
            }
            if (value && value.length > 2000) {
                showContactFieldError(field, 'Bericht mag maximaal 2000 karakters bevatten');
                return false;
            }
            break;
            
        case 'captcha_answer':
            if (value && !isValidCaptchaAnswer(value)) {
                showContactFieldError(field, 'Voer een geldig getal in');
                return false;
            }
            break;
    }
    
    return true;
}

function clearContactFieldError(field) {
    const formGroup = field.closest('.form-group');
    if (formGroup) {
        const errorElement = formGroup.querySelector('.field-error');
        if (errorElement) {
            errorElement.remove();
        }
    }
    field.classList.remove('error');
}

function showContactFieldError(field, message) {
    const formGroup = field.closest('.form-group');
    
    // Only show errors for fields that have a form-group parent
    if (!formGroup) return;
    
    // Remove existing error
    clearContactFieldError(field);
    
    // Add error class
    field.classList.add('error');
    
    // Create error element
    const errorElement = document.createElement('div');
    errorElement.className = 'field-error';
    errorElement.innerHTML = `<i class="fas fa-exclamation-circle"></i> ${message}`;
    
    // Insert after the field
    field.parentNode.insertBefore(errorElement, field.nextSibling);
}

function getRequiredMessage(fieldName) {
    const messages = {
        'firstname': 'Voornaam is verplicht',
        'lastname': 'Achternaam is verplicht',
        'email': 'E-mailadres is verplicht',
        'subject': 'Selecteer een onderwerp',
        'details': 'Bericht is verplicht',
        'captcha_answer': 'Anti-spam verificatie is verplicht',
        'privacy_akkoord': 'U moet akkoord gaan met de privacyverklaring'
    };
    return messages[fieldName] || 'Dit veld is verplicht';
}

function isValidEmail(email) {
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return emailRegex.test(email);
}

function isValidPhone(phone) {
    const phoneRegex = /^[\d\s\+\-\(\)]{10,}$/;
    return phoneRegex.test(phone);
}

function isValidCaptchaAnswer(answer) {
    return !isNaN(answer) && parseInt(answer) >= 0;
}

function submitContactForm(form) {
    // Validate all fields
    const fields = form.querySelectorAll('input, textarea, select');
    let isValid = true;
    
    fields.forEach(field => {
        if (!validateContactField(field)) {
            isValid = false;
        }
    });
    
    // Note: Contact form doesn't have privacy checkbox, so skip this validation
    
    if (!isValid) {
        // Scroll to first error
        const firstError = form.querySelector('.field-error');
        if (firstError) {
            firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
        }
        return;
    }
    
    // Submit the form
    const submitBtn = form.querySelector('.submit-btn');
    const originalText = submitBtn.innerHTML;
    
    // Show loading state
    submitBtn.classList.add('loading');
    submitBtn.disabled = true;
    submitBtn.innerHTML = '<i class="fas fa-spinner fa-spin"></i> Bezig met verzenden...';
    
    // Clear any existing alerts
    clearExistingAlerts();
    
    // Prepare form data
    const formData = new FormData(form);
    
    // Submit with Axios
    axios.post(form.action, formData, {
        headers: {
            'Content-Type': 'multipart/form-data',
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(function (response) {
        if (response.data.success) {
            showSuccessMessage(response.data.message);
            form.reset(); // Clear the form
            
            // Scroll to success message
            setTimeout(() => {
                const alertElement = document.querySelector('.alert-success');
                if (alertElement) {
                    alertElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }, 100);
        } else {
            showErrorMessage(response.data.message || 'Er is een onbekende fout opgetreden.');
        }
    })
    .catch(function (error) {
        console.error('Contact form error:', error);
        
        if (error.response) {
            if (error.response.status === 422) {
                // Validation errors
                const errors = error.response.data.errors;
                showValidationErrors(errors);
                
                // Show general error message
                showErrorMessage(error.response.data.message || 'Er zijn enkele problemen met uw invoer.');
            } else {
                // Other server errors
                showErrorMessage(error.response.data.message || 'Er is een serverfout opgetreden. Probeer het opnieuw.');
            }
        } else if (error.request) {
            // Network error
            showErrorMessage('Er is een netwerkfout opgetreden. Controleer uw internetverbinding en probeer het opnieuw.');
        } else {
            // Other error
            showErrorMessage('Er is een onverwachte fout opgetreden. Probeer het opnieuw.');
        }
        
        // Scroll to error message
        setTimeout(() => {
            const alertElement = document.querySelector('.alert-error');
            if (alertElement) {
                alertElement.scrollIntoView({ behavior: 'smooth', block: 'center' });
            }
        }, 100);
    })
    .finally(function () {
        // Reset button state
        submitBtn.classList.remove('loading');
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalText;
    });
}

// Reviews Slider Functionality
function initReviewsSlider() {
    console.log('initReviewsSlider called');
    
    const sliderTrack = document.querySelector('.reviews-slider-track');
    const prevBtn = document.querySelector('.slider-prev');
    const nextBtn = document.querySelector('.slider-next');
    const dotsContainer = document.querySelector('.slider-dots');
    
    console.log('Slider elements:', { sliderTrack, prevBtn, nextBtn, dotsContainer });
    
    if (!sliderTrack || !prevBtn || !nextBtn) {
        console.log('Slider elements not found - exiting');
        return; // Exit if slider elements don't exist
    }
    
    const reviewCardWrappers = document.querySelectorAll('.review-card-wrapper');
    if (reviewCardWrappers.length === 0) {
        console.log('No review card wrappers found');
        return;
    }
    
    console.log('Found', reviewCardWrappers.length, 'review card wrappers');
    
    let currentIndex = 0;
    const cardsPerView = 2; // Always 2 cards per slide
    let totalSlides = Math.ceil(reviewCardWrappers.length / cardsPerView);
    let updateSliderRetries = 0;
    let cachedWrapperWidth = null; // Cache wrapper width for consistency
    
    // Create dots indicator
    if (dotsContainer && totalSlides > 1) {
        dotsContainer.innerHTML = '';
        for (let i = 0; i < totalSlides; i++) {
            const dot = document.createElement('button');
            dot.className = 'slider-dot' + (i === 0 ? ' active' : '');
            dot.setAttribute('aria-label', `Ga naar slide ${i + 1}`);
            dot.addEventListener('click', () => goToSlide(i));
            dotsContainer.appendChild(dot);
        }
    }
    
    // Update on resize
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            // Clear cached values on resize so they get remeasured
            cachedWrapperWidth = null;
            totalSlides = Math.ceil(reviewCardWrappers.length / cardsPerView);
            updateSlider();
        }, 250);
    });
    
    function updateSlider() {
        if (!reviewCardWrappers || reviewCardWrappers.length === 0) {
            console.log('No review card wrappers available');
            return;
        }
        
        // Get wrapper element fresh each time
        const sliderWrapper = sliderTrack.parentElement;
        if (!sliderWrapper) {
            console.log('Slider wrapper not found');
            return;
        }
        
        // Get wrapper width - ALWAYS measure fresh but consistently
        // Use getBoundingClientRect for accurate measurement regardless of transform state
        const rect = sliderWrapper.getBoundingClientRect();
        let wrapperWidth = rect.width;
        
        // Fallback to offsetWidth if getBoundingClientRect fails
        if (!wrapperWidth || wrapperWidth === 0) {
            wrapperWidth = sliderWrapper.offsetWidth;
        }
        
        // If still no width, retry
        if (!wrapperWidth || wrapperWidth === 0) {
            console.log('Wrapper width not available, retrying...', updateSliderRetries);
            if (updateSliderRetries < 15) {
                updateSliderRetries++;
                setTimeout(updateSlider, 150);
            }
            return;
        }
        
        // Use cached width if it exists and is close (within 5px) - prevents flicker
        // Otherwise update cache
        if (cachedWrapperWidth && Math.abs(wrapperWidth - cachedWrapperWidth) < 5) {
            wrapperWidth = cachedWrapperWidth; // Use cached for consistency
        } else {
            cachedWrapperWidth = wrapperWidth; // Update cache
        }
        
        updateSliderRetries = 0; // Reset on success
        
        // Calculate wrapper width: each wrapper is exactly half of wrapperWidth
        // With box-sizing: border-box, padding is included in the width
        // So wrapper width = wrapperWidth / 2 (padding is already accounted for in box-sizing)
        const wrapperWidthValue = wrapperWidth / cardsPerView;
        
        // Round to avoid sub-pixel issues
        const roundedWrapperWidth = Math.round(wrapperWidthValue * 100) / 100;
        
        // Set all wrappers to the calculated width
        reviewCardWrappers.forEach((wrapper, index) => {
            wrapper.style.width = roundedWrapperWidth + 'px';
            wrapper.style.minWidth = roundedWrapperWidth + 'px';
            wrapper.style.maxWidth = roundedWrapperWidth + 'px';
            wrapper.style.flexShrink = '0';
            wrapper.style.flexGrow = '0';
            wrapper.style.boxSizing = 'border-box';
        });
        
        // Ensure cards inside wrappers take full width (excluding padding)
        const reviewCards = document.querySelectorAll('.review-card');
        reviewCards.forEach((card) => {
            card.style.width = '100%';
            card.style.maxWidth = '100%';
        });
        
        // Force a reflow after setting widths to ensure accurate measurements
        void sliderTrack.offsetWidth;
        void sliderWrapper.offsetWidth;
        
        // The slide width equals wrapperWidth (since wrapperWidth = 2 cards + gap)
        // Use wrapperWidth directly for transform - this ensures perfect alignment
        const translateX = Math.round(-(currentIndex * wrapperWidth));
        
        // Apply transform with precise positioning
        // Make sure transition is enabled for smooth animation
        sliderTrack.style.transition = 'transform 0.5s ease';
        sliderTrack.style.transform = `translateX(${translateX}px)`;
        sliderTrack.style.willChange = 'transform';
        
        console.log('Updating slider:', { 
            currentIndex, 
            wrapperWidth: Math.round(wrapperWidth),
            wrapperWidthValue: roundedWrapperWidth,
            translateX: translateX, 
            totalSlides
        });
        
        // Navigation buttons
        prevBtn.disabled = false;
        nextBtn.disabled = false;
        
        // Update dots
        if (dotsContainer && totalSlides > 0) {
            const dots = dotsContainer.querySelectorAll('.slider-dot');
            const visualIndex = ((currentIndex % totalSlides) + totalSlides) % totalSlides;
            dots.forEach((dot, index) => {
                dot.classList.toggle('active', index === visualIndex);
            });
        }
    }
    
    function goToSlide(index) {
        if (totalSlides === 0) return;
        // For infinite loop, use modulo arithmetic to wrap around
        currentIndex = ((index % totalSlides) + totalSlides) % totalSlides;
        // Force immediate update
        updateSlider();
    }
    
    function nextSlide() {
        if (totalSlides === 0) return;
        // Infinite loop - wrap around
        currentIndex = (currentIndex + 1) % totalSlides;
        // Recalculate immediately - wrapper width might have changed
        updateSlider();
    }
    
    function prevSlide() {
        if (totalSlides === 0) return;
        // Infinite loop - wrap around backwards
        currentIndex = ((currentIndex - 1) % totalSlides + totalSlides) % totalSlides;
        // Recalculate immediately - wrapper width might have changed
        updateSlider();
    }
    
    // Event listeners
    prevBtn.addEventListener('click', prevSlide);
    nextBtn.addEventListener('click', nextSlide);
    
    // Touch/swipe support for mobile
    let touchStartX = 0;
    let touchEndX = 0;
    
    sliderTrack.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });
    
    sliderTrack.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });
    
    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;
        
        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                // Swipe left - next
                nextSlide();
            } else {
                // Swipe right - previous
                prevSlide();
            }
        }
    }
    
    // Keyboard navigation
    document.addEventListener('keydown', (e) => {
        const sliderSection = document.querySelector('.reviews-section');
        if (!sliderSection) return;
        
        const isSliderFocused = sliderSection.contains(document.activeElement) || 
                                sliderTrack.contains(document.activeElement);
        
        if (isSliderFocused || sliderSection.getBoundingClientRect().top < window.innerHeight && 
            sliderSection.getBoundingClientRect().bottom > 0) {
            if (e.key === 'ArrowLeft') {
                e.preventDefault();
                prevSlide();
            } else if (e.key === 'ArrowRight') {
                e.preventDefault();
                nextSlide();
            }
        }
    });
    
    // Initialize slider
    console.log('Initializing slider with', reviewCardWrappers.length, 'wrappers,', totalSlides, 'slides');
    
    // Try immediately
    updateSlider();
    
    // Also try after a short delay in case elements aren't ready
    setTimeout(() => {
        console.log('Retry slider initialization (300ms)');
        updateSlider();
    }, 300);
    
    setTimeout(() => {
        console.log('Retry slider initialization (800ms)');
        updateSlider();
    }, 800);
    
    // Try after window load
    window.addEventListener('load', () => {
        console.log('Window loaded, updating slider');
        setTimeout(() => updateSlider(), 100);
    });
}

