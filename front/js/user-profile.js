const buttons = document.querySelectorAll(".profile-sidebar__nav button");
const sections = document.querySelectorAll(".profile-content");

buttons.forEach(button => {
    button.addEventListener("click", () => {
        const tab = button.dataset.tab;
        buttons.forEach(btn => btn.classList.remove("active"));
        button.classList.add("active");

        sections.forEach(section => {
            section.classList.remove("visible");
        });

        document.getElementById(tab).classList.add("visible");
    });
});