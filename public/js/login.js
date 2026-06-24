// Toggle password visibility
function togglePassword() {
    const input = document.getElementById("password");
    const icon = document.getElementById("togglePasswordIcon");

    const isPassword = input.type === "password";
    input.type = isPassword ? "text" : "password";

    icon.classList.toggle("fa-eye");
    icon.classList.toggle("fa-eye-slash");
}

// Loading state on form submit
document.getElementById("loginForm")?.addEventListener("submit", function (e) {
    const submitBtn = document.getElementById("submitBtn");
    if (submitBtn) {
        submitBtn.classList.add("btn-loading");
        submitBtn.innerHTML =
            '<i class="fa-solid fa-spinner mr-2"></i> Memproses...';
        submitBtn.disabled = true;
    }
});

// Auto-focus on first input
document.querySelector('input[name="username"]')?.focus();
