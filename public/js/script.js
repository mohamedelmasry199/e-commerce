document.addEventListener('DOMContentLoaded', function() {
    const registrationForm = document.getElementById('registration-form');
    
    registrationForm.addEventListener('submit', function(event) {
        event.preventDefault();
        
        const formData = new FormData(registrationForm);
        
        // Perform client-side validation
        if (!validateForm(formData)) {
            return;
        }
        
        // Submit the form data to the server
        fetch('/register', {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                alert('Registration successful! You can now log in.');
                registrationForm.reset();
            } else {
                alert('Registration failed. Please try again.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred. Please try again later.');
        });
    });
    
    function validateForm(formData) {
        function validateForm(formData) {
            const name = formData.get('name');
            const email = formData.get('email');
            const password = formData.get('password');
            const passwordConfirmation = formData.get('password_confirmation');
            const image = formData.get('image');
            const address = formData.get('address');
            
            if (!name || !email || !password || !passwordConfirmation || !image || !address) {
                alert('Please fill in all required fields.');
                return false;
            }
            
            if (!isValidEmail(email)) {
                alert('Please enter a valid email address.');
                return false;
            }
            
            if (password !== passwordConfirmation) {
                alert('Password and password confirmation do not match.');
                return false;
            }
            
            return true; 
        }
        
        function isValidEmail(email) {
            const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            return emailRegex.test(email);
        }
        
    }
});

