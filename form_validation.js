// form_validation.js
function validateForm() {
    var termsChecked = document.getElementById('terms').checked;
    if (!termsChecked) {
        alert("You must agree to the Terms and Conditions to complete registration.");
        return false; // Prevent form submission
    }
    return true; // Allow form submission
}
