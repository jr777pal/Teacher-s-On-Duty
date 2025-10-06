// Function to validate the registration form
function validateForm() {
    // Get form inputs
    const username = document.getElementById("username").value.trim();
    const email = document.getElementById("email").value.trim();
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirm-password").value;
    const firstName = document.getElementById("first-name").value.trim();
    const lastName = document.getElementById("last-name").value.trim();
    const phoneNo = document.getElementById("phone-no").value.trim();
    const whatsappNo = document.getElementById("whatsapp-no").value.trim();
    const qualifications = document.getElementById("qualifications").value.trim();
    const age = document.getElementById("age").value.trim();
    const terms = document.getElementById("terms").checked;

    // Email regex for basic validation
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

    // Phone number regex for numeric validation
    const phoneRegex = /^\d{10}$/;

    // Username validation
    if (username === "") {
        alert("Username is required.");
        return false;
    }

    // Email validation
    if (!emailRegex.test(email)) {
        alert("Please enter a valid email address.");
        return false;
    }

    // Password validation
    if (password.length < 6) {
        alert("Password must be at least 6 characters long.");
        return false;
    }

    if (password !== confirmPassword) {
        alert("Passwords do not match.");
        return false;
    }

    // First name and last name validation
    if (firstName === "") {
        alert("First name is required.");
        return false;
    }

    if (lastName === "") {
        alert("Last name is required.");
        return false;
    }

    // Phone number validation
    if (!phoneRegex.test(phoneNo)) {
        alert("Please enter a valid 10-digit phone number.");
        return false;
    }

    // WhatsApp number validation
    if (!phoneRegex.test(whatsappNo)) {
        alert("Please enter a valid 10-digit WhatsApp number.");
        return false;
    }

    // Qualifications validation
    if (qualifications === "") {
        alert("Qualifications are required.");
        return false;
    }

    // Age validation
    if (isNaN(age) || age < 16 || age > 100) {
        alert("Please enter a valid age between 16 and 100.");
        return false;
    }

    // Terms and Conditions validation
    if (!terms) {
        alert("You must agree to the terms and conditions.");
        return false;
    }

    // If all validations pass
    return true;
}
