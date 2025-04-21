const sidebarcustom = document.querySelector(".sidebarcustom");
    const sidebarcustomToggler = document.querySelector(
        ".sidebarcustom-toggler"
    );
    const menuToggler = document.querySelector(".menu-toggler");

    // Ensure these heights match the CSS sidebarcustom height values
    let collapsedSidebarcustomHeight = "56px"; // Height in mobile view (collapsed)
    let fullSidebarcustomHeight = "calc(85vh - 32px)"; // Height in larger screen

    // Toggle sidebarcustom's collapsed state
    sidebarcustomToggler.addEventListener("click", () => {
        sidebarcustom.classList.toggle("collapsed");
    });

    // Update sidebarcustom height and menu toggle text
    const toggleMenu = (isMenuActive) => {
        sidebarcustom.style.height = isMenuActive ?
            `${sidebarcustom.scrollHeight}px` :
            collapsedSidebarcustomHeight;
        menuToggler.querySelector("span").innerText = isMenuActive ?
            "close" :
            "menu";
    };

    // Toggle menu-active class and adjust height
    menuToggler.addEventListener("click", () => {
        toggleMenu(sidebarcustom.classList.toggle("menu-active"));
    });

    // (Optional code): Adjust sidebarcustom height on window resize
    window.addEventListener("resize", () => {
        if (window.innerWidth >= 1024) {
            sidebarcustom.style.height = fullSidebarcustomHeight;
        } else {
            sidebarcustom.classList.remove("collapsed");
            sidebarcustom.style.height = "auto";
            toggleMenu(sidebarcustom.classList.contains("menu-active"));
        }
    });