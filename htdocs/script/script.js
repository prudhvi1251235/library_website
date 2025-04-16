// Function to handle borrow and return button actions
function toggleAction(action, button) {
    // Get the message display element
    const messageElement = document.getElementById('action-message');

    // Checking for  action 'borrow'
if (action === 'borrow') {
        // Changing button to indicate the book is ready to be borrowed
        button.textContent = "Ready to Borrow";
        // prevent multiple clicks
        button.disabled = true;
        // Display a message confirming the borrow action
        messageElement.textContent = "You have clicked 'Borrow' for " + button.previousElementSibling.textContent + ". You can borrow this book now.";

    // Checking for  action  'return'
} else if (action === 'return') {
        // Change button text to indicate the book is ready to be returned
        button.textContent = "Ready to Return";
        // to prevent multiple clicks
        button.disabled = true;
        // for message confirming the return action
        messageElement.textContent = "You have clicked 'Return' for " + button.previousElementSibling.textContent + ". You can return this book now.";
    }
}


// Function to validate the user registration form
function validateRegistration(event) {
    // Prevent the form from submitting normally
    event.preventDefault(); 

    // Get the student ID input value and remove any extra spaces
    let studentId = document.getElementById("student-id").value.trim();
    // Get the email input and remove any extra spaces
    let email = document.getElementById("email").value.trim();
    // Get the password input value and remove any extra spaces
    let password = document.getElementById("password").value.trim();
    // Get the confirm password input value and remove any extra spaces
    let confirmPassword = document.getElementById("confirm-password").value.trim();

    // Check if the password == confirm password 
    if (password !== confirmPassword) {
        // Show an alert message if passwords do not match
        alert("Passwords do not match!");
        return; 
    }

    // Show a message if registration is valid
    alert("Registration successful! You can now login.");
    // Redirecting to the login page
    window.location.href = "login.html"; 
}
