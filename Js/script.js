const backgrounds = ["img1.png", "img.png", "img2.png"];
let currentIndex = 0;

document.body.addEventListener("click", () => {
const backgroundContainer = document.querySelector(".background-container");

// Cambiar la imagen de fondo
backgroundContainer.style.backgroundImage = `url(${backgrounds[currentIndex]})`;

// Incrementar el índice o volver al primero si alcanzamos el último
currentIndex = (currentIndex + 1) % backgrounds.length;

// Mostrar el fondo
backgroundContainer.style.opacity = 1;
});