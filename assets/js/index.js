document.addEventListener("DOMContentLoaded", () => {
    const password = document.getElementById("user_password");
    const toggle = document.getElementById("togglePassword");

    if (toggle && password) { // Validación de seguridad
        toggle.addEventListener("click", () => {
            if (password.type === "password") {
                password.type = "text";
                toggle.classList.remove("fi-rr-eye");
                toggle.classList.add("fi-rr-eye-crossed");
            } else {
                password.type = "password";
                toggle.classList.remove("fi-rr-eye-crossed");
                toggle.classList.add("fi-rr-eye");
            }
        });
    }
});