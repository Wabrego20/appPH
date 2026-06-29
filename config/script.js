document.addEventListener("DOMContentLoaded", () => {
    const password = document.getElementById("user_password");
    const toggle = document.getElementById("togglePassword");

    if (toggle && password) { // Validación de seguridad
        toggle.addEventListener("click", () => {
            if (password.type === "password") {
                password.type = "text";
                toggle.classList.remove("bi-eye");
                toggle.classList.add("bi-eye-slash");
            } else {
                password.type = "password";
                toggle.classList.remove("bi-eye-slash");
                toggle.classList.add("bi-eye");
            }
        });
    }
});