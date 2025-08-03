// Simple JavaScript for Letselschade-Hotline
document.addEventListener("DOMContentLoaded", function () {
    // Add smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
        anchor.addEventListener("click", function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute("href"));
            if (target) {
                target.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }
        });
    });

    // Add active class to current navigation item
    const currentPath = window.location.pathname;
    document.querySelectorAll(".nav-links a").forEach((link) => {
        if (link.getAttribute("href") === currentPath) {
            link.classList.add("active");
        }
    });

    // Form validation and enhancement
    const contactForm = document.querySelector(".contact-form form");
    if (contactForm) {
        contactForm.addEventListener("submit", function (e) {
            const requiredFields = this.querySelectorAll("[required]");
            let isValid = true;

            requiredFields.forEach((field) => {
                if (!field.value.trim()) {
                    isValid = false;
                    field.style.borderColor = "#dc2626";
                } else {
                    field.style.borderColor = "#e5e7eb";
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert("Vul alle verplichte velden in.");
            }
        });
    }

    // Phone number formatting
    const phoneInputs = document.querySelectorAll('input[type="tel"]');
    phoneInputs.forEach((input) => {
        input.addEventListener("input", function (e) {
            let value = e.target.value.replace(/\D/g, "");
            if (value.length > 0) {
                value = value.replace(/(\d{3})(\d{3})(\d{4})/, "$1-$2-$3");
            }
            e.target.value = value;
        });
    });
});
