const toggler = document.getElementById("toggler");
const menu = document.getElementById("menu");

function closeMenu() {
    menu.classList.remove("is-open");
    toggler.classList.remove("fa-xmark");
    toggler.classList.add("fa-bars");
}

toggler.addEventListener("click", () => {
    const isOpen = menu.classList.toggle("menu--is-open");

    toggler.classList.toggle("fa-bars", !isOpen);
    toggler.classList.toggle("fa-xmark", isOpen);
});


document.querySelectorAll(".menu__listing a").forEach(link => {
    link.addEventListener("click", closeMenu);
});