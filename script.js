document.addEventListener("DOMContentLoaded", function() {
    // Multiple text typing effect
    var typed = new Typed(".multiple-text", {
        strings: ["Web Developer", "Graphic Designer", "Digital Marketer"],
        typeSpeed: 100,
        backSpeed: 100,
        loop: true
    });

    // Menu toggle
    const menuIcon = document.getElementById("menu-icon");
    const navbar = document.querySelector(".navbar");

    menuIcon.addEventListener("click", () => {
        navbar.classList.toggle("active");
    });

    // Form submission with AJAX
    const form = document.getElementById('my_form');
    const notification = document.getElementById('notification');

    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Prevent the default form submission

        const formData = new FormData(form);

        fetch('submit.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.text())
        .then(data => {
            // Display success message
            notification.style.display = 'block';
            notification.innerHTML = `<div class="success-message">${data}</div>`;
            
            // Hide notification after 3 seconds
            setTimeout(() => {
                notification.style.display = 'none';
            }, 3000);

            form.reset(); // Reset the form after submission
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
