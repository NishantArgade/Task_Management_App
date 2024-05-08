const dropdowns = document.querySelectorAll(".options-dropdown");
const dropdownMenus = document.querySelectorAll(".options-dropdown-menu");

dropdowns.forEach((dropdown, index) => {
    const dropdownMenu = dropdownMenus[index];

    if (dropdown && dropdownMenu) {
        dropdown.addEventListener("click", function (event) {
            event.stopPropagation();

            // Close all other dropdowns
            dropdownMenus.forEach((menu, menuIndex) => {
                if (menuIndex !== index) {
                    menu.style.display = "none";
                }
            });

            // Toggle the current dropdown
            if (dropdownMenu.style.display === "block") {
                dropdownMenu.style.display = "none";
            } else {
                dropdownMenu.style.display = "block";
            }
        });

        // close dropdown menu when clicked outside
        document.addEventListener("click", function () {
            dropdownMenu.style.display = "none";
        });

        // close dropdown change window tab or minimize tab
        window.addEventListener("blur", function () {
            dropdownMenu.style.display = "none";
        });
    }
});