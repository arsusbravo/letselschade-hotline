// Application Form Validation - Standalone Version
(function() {
    'use strict';
    
    // Wait for DOM to be ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initValidation);
    } else {
        initValidation();
    }
    
    function initValidation() {
        const form = document.getElementById('application-form');
        
        if (!form) {
            console.log('Application form not found');
            return;
        }
        
        console.log('Form validation initialized');
        
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
        const phoneField = form.querySelector('input[name="telefoon"]');
        if (phoneField) {
            phoneField.addEventListener('blur', function() {
                validatePhone(this);
            });
        }
        
        // Date validation
        const dateField = form.querySelector('input[name="datum_ongeval"]');
        if (dateField) {
            dateField.addEventListener('blur', function() {
                validateDate(this);
            });
            
            dateField.addEventListener('change', function() {
                validateDate(this);
            });
        }
        
        // Privacy checkbox validation
        const privacyCheckbox = form.querySelector('input[name="privacy_akkoord"]');
        if (privacyCheckbox) {
            privacyCheckbox.addEventListener('change', function() {
                validatePrivacyCheckbox(this);
            });
        }
        
        // Form submission validation
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            console.log('Form submission attempted');
            
            if (validateForm()) {
                console.log('Form validation passed');
                // Show loading state
                const submitBtn = form.querySelector('.submit-btn');
                if (submitBtn) {
                    submitBtn.classList.add('loading');
                    submitBtn.disabled = true;
                }
                
                // Submit the form
                this.submit();
            } else {
                console.log('Form validation failed');
                // Scroll to first error
                const firstError = form.querySelector('.has-error');
                if (firstError) {
                    firstError.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
        });
    }

    function validateField(field) {
        const formGroup = field.closest('.form-group');
        if (!formGroup) return true;
        
        clearValidationState(formGroup);
        
        if (field.hasAttribute('required') && !field.value.trim()) {
            showError(formGroup, 'Dit veld is verplicht');
            return false;
        }
        
        if (field.type === 'radio') {
            const radioGroup = field.closest('.radio-group');
            if (radioGroup) {
                const checked = radioGroup.querySelector('input[type="radio"]:checked');
                if (field.hasAttribute('required') && !checked) {
                    showError(formGroup, 'Selecteer alstublieft een optie');
                    return false;
                } else if (checked) {
                    showSuccess(formGroup);
                    return true;
                }
            }
        }
        
        if (field.value.trim()) {
            showSuccess(formGroup);
        }
        
        return true;
    }

    function validateEmail(field) {
        const formGroup = field.closest('.form-group');
        if (!formGroup) return true;
        
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
        if (!formGroup) return true;
        
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
        today.setHours(23, 59, 59, 999); // End of today
        
        if (selectedDate > today) {
            showError(formGroup, 'De datum kan niet in de toekomst liggen');
            return false;
        }
        
        // Check if date is too far in the past (optional - e.g., more than 10 years)
        const tenYearsAgo = new Date();
        tenYearsAgo.setFullYear(tenYearsAgo.getFullYear() - 10);
        
        if (selectedDate < tenYearsAgo) {
            showError(formGroup, 'Datum mag niet meer dan 10 jaar geleden zijn');
            return false;
        }
        
        showSuccess(formGroup);
        return true;
    }

    function validatePrivacyCheckbox(field) {
        const formGroup = field.closest('.form-group');
        if (!formGroup) return true;
        
        clearValidationState(formGroup);
        
        if (field.hasAttribute('required') && !field.checked) {
            showError(formGroup, 'U moet akkoord gaan met de privacyverklaring');
            return false;
        }
        
        if (field.checked) {
            showSuccess(formGroup);
        }
        
        return true;
    }

    function validateForm() {
        const form = document.getElementById('application-form');
        if (!form) return false;
        
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
        const phoneField = form.querySelector('input[name="telefoon"]');
        if (phoneField && !validatePhone(phoneField)) {
            isValid = false;
        }
        
        // Validate date specifically
        const dateField = form.querySelector('input[name="datum_ongeval"]');
        if (dateField && !validateDate(dateField)) {
            isValid = false;
        }
        
        // Validate privacy checkbox specifically
        const privacyCheckbox = form.querySelector('input[name="privacy_akkoord"]');
        if (privacyCheckbox && !validatePrivacyCheckbox(privacyCheckbox)) {
            isValid = false;
        }
        
        // Check required radio groups
        const radioGroups = form.querySelectorAll('.radio-group');
        radioGroups.forEach(group => {
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
        errorDiv.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + message;
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
    
})();
