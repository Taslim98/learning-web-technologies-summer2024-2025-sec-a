document.addEventListener("DOMContentLoaded", () => {
    const navLinks = document.querySelectorAll(".nav-link");
    const sections = document.querySelectorAll(".section");

    navLinks.forEach(link => {
        link.addEventListener("click", e => {
            e.preventDefault();
            navLinks.forEach(l => l.classList.remove("active"));
            sections.forEach(s => s.classList.remove("active"));
            link.classList.add("active");
            const target = document.getElementById(link.dataset.section);
            if (target) target.classList.add("active");
        });
    });

    // Example for Inventory
    const invForm = document.getElementById("inventoryForm");
    const invList = document.getElementById("inventoryList");
    invForm.addEventListener("submit", e => {
        e.preventDefault();
        const name = document.getElementById("itemName").value;
        const qty = document.getElementById("itemQty").value;
        const reorder = document.getElementById("reorderLevel").value;
        const row = `<tr><td>${name}</td><td>${qty}</td><td>${reorder}</td></tr>`;
        invList.innerHTML += row;
        invForm.reset();
    });

    // Profile update
    const profileForm = document.getElementById("profileForm");
    profileForm.addEventListener("submit", e => {
        e.preventDefault();
        const name = document.getElementById("profileName").value;
        document.getElementById("welcomeText").textContent = `Welcome, ${name}`;
        document.getElementById("profileStatus").textContent = "Profile updated successfully!";
    });
});
