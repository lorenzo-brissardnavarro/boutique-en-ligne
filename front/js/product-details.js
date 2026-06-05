const mainImage = document.getElementById("mainImage");
const images = document.querySelectorAll(".product-detail__thumb");

images.forEach(image => {
    image.addEventListener("click", () => {

        images.forEach(i => i.classList.remove("product-detail__thumb--active"));
        image.classList.add("product-detail__thumb--active");
        const link = image.src;
        mainImage.src = link;

    });
});