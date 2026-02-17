document.addEventListener("DOMContentLoaded", () => {
    const customSelects = document.querySelectorAll(".custom-select");

    customSelects.forEach((customSelect) => {
        const selectButton = customSelect.querySelector(".select-button");
        const dropdown = customSelect.querySelector(".select-dropdown");
        const arrow = selectButton.querySelector(".arrow");
        const options = dropdown.querySelectorAll("li");
        const selectedValue = selectButton.querySelector(".selected-value");
        const hiddenInput = customSelect.querySelector("input[type='hidden']");

        // Set initial selected value if hidden input has a value
        if (hiddenInput && hiddenInput.value) {
            const initialOption = Array.from(options).find(opt => opt.dataset.value == hiddenInput.value);
            if (initialOption) {
                selectedValue.textContent = initialOption.textContent.trim();
                initialOption.classList.add("selected");
                // Add tick to initial option
                const tick = document.createElement("span");
                tick.className = "tick";
                tick.innerHTML = '<i class="ri-check-line"></i>';
                initialOption.appendChild(tick);
            }
        }

        // Add tick icons to all options (hidden by default via CSS)
        options.forEach(option => {
            if (!option.querySelector(".tick")) {
                const tick = document.createElement("span");
                tick.className = "tick";
                tick.innerHTML = '<i class="ri-check-line"></i>';
                option.appendChild(tick);
            }
        });

        // Toggle dropdown visibility
        const toggleDropdown = () => {
            const isHidden = dropdown.classList.contains("hidden");
            dropdown.classList.toggle("hidden", !isHidden);
            selectButton.setAttribute("aria-expanded", isHidden);
            arrow.classList.toggle("rotate", isHidden);
        };

        // Handle option selection
        const handleOptionSelect = (option) => {
            options.forEach((opt) => opt.classList.remove("selected"));
            option.classList.add("selected");
            const text = option.textContent.trim();
            const value = option.dataset.value;

            selectedValue.textContent = text;
            if (hiddenInput) {
                hiddenInput.value = value;
                hiddenInput.dispatchEvent(new Event('change'));
            }
            toggleDropdown(); // Close dropdown after selection
        };

        // Click event for select button
        selectButton.addEventListener("click", (e) => {
            e.stopPropagation();
            // Close other open dropdowns
            customSelects.forEach(otherSelect => {
                if (otherSelect !== customSelect) {
                    const otherDropdown = otherSelect.querySelector(".select-dropdown");
                    if (!otherDropdown.classList.contains("hidden")) {
                        otherDropdown.classList.add("hidden");
                        otherSelect.querySelector(".select-button").setAttribute("aria-expanded", "false");
                        otherSelect.querySelector(".arrow").classList.remove("rotate");
                    }
                }
            });
            toggleDropdown();
        });

        // Click event for each option
        options.forEach((option) => {
            option.addEventListener("click", (e) => {
                e.stopPropagation();
                handleOptionSelect(option);
            });
        });

        // Close dropdown when clicking outside
        document.addEventListener("click", (e) => {
            if (!customSelect.contains(e.target)) {
                if (!dropdown.classList.contains("hidden")) {
                    dropdown.classList.add("hidden");
                    selectButton.setAttribute("aria-expanded", "false");
                    arrow.classList.remove("rotate");
                }
            }
        });
    });
});
