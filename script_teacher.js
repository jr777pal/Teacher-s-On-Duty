// scripts_teacher.js

// Function to validate if passwords match
function validatePassword() {
    const password = document.getElementById("reg-password");
    const confirmPassword = document.getElementById("confirm-password");
    const message = document.getElementById("password-match-message");

    if (password.value !== confirmPassword.value) {
        confirmPassword.setCustomValidity("Passwords do not match");
        message.style.color = "red";
        message.textContent = "Passwords do not match!";
    } else {
        confirmPassword.setCustomValidity(""); // Reset the error
        message.style.color = "green";
        message.textContent = "Passwords match!";
    }
}
