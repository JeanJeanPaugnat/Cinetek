// Sélection de tous les boutons de carrousel
const buttons = document.querySelectorAll("[data-carousel-button]");

buttons.forEach(button => {
  button.addEventListener("click", () => {
    // Détermination de la direction du défilement en fonction du bouton cliqué
    const offset = button.dataset.carouselButton === "next" ? 1 : -1;
    
    // Recherche du conteneur des diapositives à l'intérieur du carrousel
    const carousel = button.closest("[data-carousel]");
    const slides = carousel.querySelector("[data-slides]");
    
    // Vérification si les diapositives existent
    if (slides) {
      // Recherche de la diapositive active
      const activeSlide = slides.querySelector("[data-active]");
      
      // Calcul du nouvel index de la diapositive
      let newIndex = [...slides.children].indexOf(activeSlide) + offset;
      
      // Gestion des limites du carrousel
      if (newIndex < 0) {
        newIndex = slides.children.length - 1;
      }
      if (newIndex >= slides.children.length) {
        newIndex = 0;
      }
      
      // Activation de la nouvelle diapositive et désactivation de l'ancienne
      activeSlide.removeAttribute("data-active");
      slides.children[newIndex].setAttribute("data-active", "");
    }
  });
});
