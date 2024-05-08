function toggleDropdown() {
    document.getElementById("multiSelectDropdown").classList.toggle("hidden");
}

function updateSelectedCount() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    let selectedCount = 0;
    checkboxes.forEach((checkbox) => {
        if (
            checkbox.checked &&
            checkbox !== document.getElementById("selectAll")
        ) {
            selectedCount++;
        }
    });

    // check if all checkboxes are checked then check the select all checkbox otherwise uncheck it
    if (selectedCount === checkboxes.length - 1) {
        document.getElementById("selectAll").checked = true;
    } else {
        document.getElementById("selectAll").checked = false;
    }

    document.getElementById(
        "selectedCountInput"
    ).value = `${selectedCount} selected`;
    // document.getElementById("selectedCountLabel").innerText = `${selectedCount} selected`;

    // get all selected input value who is checked and set it to hidden input field

    let selectedValues = [];
    checkboxes.forEach((checkbox) => {
        if (
            checkbox.checked &&
            checkbox !== document.getElementById("selectAll")
        ) {
            selectedValues.push(
                checkbox.nextElementSibling.getAttribute("value")
            );
        }
    });

    console.log(selectedValues);
    document.getElementById("selectedInputsData").value = selectedValues;
}

function selectAllCheckbox() {
    const checkboxes = document.querySelectorAll('input[type="checkbox"]');
    const selectAllCheckbox = document.getElementById("selectAll");
    let allChecked = true;
    // if user check the select all checkbox then check all other checkboxes
    if (selectAllCheckbox.checked) {
        checkboxes.forEach((checkbox) => {
            if (checkbox !== selectAllCheckbox) {
                checkbox.checked = true;
            }
        });
    } else {
        // if user uncheck the select all checkbox then uncheck all other checkboxes
        checkboxes.forEach((checkbox) => {
            if (checkbox !== selectAllCheckbox) {
                checkbox.checked = false;
            }
        });
    }
    updateSelectedCount();
}

function filterOptions() {
    document.getElementById("multiSelectDropdown").classList.remove("hidden");

    const searchInput = document.getElementById("searchInput");
    const filter = searchInput.value.toUpperCase();
    const labels = document.querySelectorAll("#multiSelectDropdown label");

    let noResultFound = true;
    for (let i = 0; i < labels.length; i++) {
        const label = labels[i];
        const textValue = label.textContent || label.innerText;
        if (textValue.toUpperCase().includes(filter)) {
            label.style.display = "";
            noResultFound = false;
        } else {
            label.style.display = "none";
        }
    }

    if (noResultFound) {
        document.getElementById("noResultFound").classList.remove("hidden");
    } else {
        document.getElementById("noResultFound").classList.add("hidden");
    }

    updateSelectedCount();
}

//   close dropdown menu when clicked outside of select input field and dropdown menus
document.addEventListener("click", function (e) {
    if (
        !document.getElementById("selectedCountInput").contains(e.target) &&
        !document.getElementById("multiSelectDropdown").contains(e.target)
    ) {
        document.getElementById("multiSelectDropdown").classList.add("hidden");
    }
});
