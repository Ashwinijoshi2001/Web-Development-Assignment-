document.addEventListener('DOMContentLoaded', function () {
    
    var password = document.querySelector('input[name="password"]');
    password.addEventListener('input', function () {
        var strengthText = document.getElementById('password-strength');
        if (this.value.length >= 8) {
            strengthText.innerText = "Strong password";
        } else {
            strengthText.innerText = "Weak password (at least 8 characters)";
        }
    });
});
