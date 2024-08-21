let currentSlide = 0; // Inicializa el índice del slide actual a 0
const slideInterval = 3000; // Define el intervalo de tiempo entre cambios de slide (3000 ms = 3 segundos)

function showSlide(index) {
    const slides = document.querySelectorAll('.carousel-item'); // Selecciona todos los elementos con la clase 'carousel-item'
    const totalSlides = slides.length; // Obtiene el número total de slides
    if (index >= totalSlides) {
        currentSlide = 0; // Si el índice es mayor o igual al número total de slides, reinicia al primer slide
    } else if (index < 0) {
        currentSlide = totalSlides - 1; // Si el índice es menor que 0, cambia al último slide
    } else {
        currentSlide = index; // Si el índice es válido, actualiza el índice del slide actual
    }

    const offset = -currentSlide * 100; // Calcula el desplazamiento en porcentaje para mostrar el slide actual
    document.querySelector('.carousel-inner').style.transform = `translateX(${offset}%)`; // Aplica el desplazamiento mediante una transformación CSS
}

function nextSlide() {
    showSlide(currentSlide + 1); // Muestra el siguiente slide incrementando el índice actual
}

function prevSlide() {
    showSlide(currentSlide - 1); // Muestra el slide anterior decrementando el índice actual
}

document.addEventListener('DOMContentLoaded', () => { // Espera a que el contenido del DOM se haya cargado completamente
    showSlide(currentSlide); // Muestra el slide inicial
    setInterval(nextSlide, slideInterval); // Configura el intervalo para cambiar automáticamente al siguiente slide cada 'slideInterval' milisegundos
});