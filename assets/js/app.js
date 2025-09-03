// This file contains additional JavaScript functionalities for enhancing user interactions and micro-interactions within the application.

// Function to handle form submissions with AJAX
function submitForm(formId, url, successCallback) {
    const form = document.getElementById(formId);
    form.addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(form);
        
        fetch(url, {
            method: 'POST',
            body: formData,
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                successCallback(data);
            } else {
                alert(data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
}

// Example usage for login form
submitForm('loginForm', 'login.php', function(data) {
    window.location.href = 'dashboard_siswa.php'; // Redirect to student dashboard
});

// Example usage for registration form
submitForm('registrationForm', 'register.php', function(data) {
    alert('Registration successful! Please check your email for confirmation.');
});

// Function to toggle visibility of elements
function toggleVisibility(elementId) {
    const element = document.getElementById(elementId);
    if (element.style.display === 'none' || element.style.display === '') {
        element.style.display = 'block';
    } else {
        element.style.display = 'none';
    }
}

// Add event listeners for micro-interactions
document.querySelectorAll('.toggle-button').forEach(button => {
    button.addEventListener('click', function() {
        toggleVisibility(this.dataset.target);
    });
});

// Smooth scrolling for anchor links
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function(e) {
        e.preventDefault();
        document.querySelector(this.getAttribute('href')).scrollIntoView({
            behavior: 'smooth'
        });
    });
});