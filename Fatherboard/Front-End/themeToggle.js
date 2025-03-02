document.addEventListener("DOMContentLoaded", () => {
    const toggleButton = document.getElementById("themeToggle");

    // Check localStorage and apply dark mode if saved
    if (localStorage.getItem("theme") === "dark") {
        document.body.classList.add("dark-mode");
        toggleButton.textContent = "☀️ Light Mode";
    }

    toggleButton.addEventListener("click", () => {
        document.body.classList.toggle("dark-mode");

        if (document.body.classList.contains("dark-mode")) {
            localStorage.setItem("theme", "dark");
            toggleButton.textContent = "☀️ Light Mode";
        } else {
            localStorage.setItem("theme", "light");
            toggleButton.textContent = "🌙 Dark Mode";
        }
    });
});
