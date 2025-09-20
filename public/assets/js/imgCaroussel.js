document.addEventListener('DOMContentLoaded', function() {
    // Sélectionner tous les éléments avec la classe carousel
    const carousels = document.querySelectorAll('.carousel');

    // Initialiser chaque carousel
    carousels.forEach(carousel => {
        // Créer une instance de carousel Bootstrap pour chaque élément
        new bootstrap.Carousel(carousel, {
            // Options du carousel
            interval: 5000, // Temps entre chaque slide en millisecondes
            touch: true,    // Activer le swipe tactile
            pause: 'hover', // Mettre en pause au survol
            wrap: true      // Permettre la rotation continue
        });

        // Ajouter des gestionnaires d'événements pour les boutons précédent/suivant
        const prevButton = carousel.querySelector('.carousel-control-prev');
        const nextButton = carousel.querySelector('.carousel-control-next');

        if (prevButton && nextButton) {
            // Empêcher la propagation du clic pour éviter les conflits
            prevButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
            });

            nextButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();
            });
        }
    });
});