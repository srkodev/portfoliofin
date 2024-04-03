// Sélectionnez le menu hamburger et le menu drop
const $menuHamburger = $('.menu-hamburger');
const $menuDrop = $('.menu-drop');

// Ajoutez un écouteur d'événements au clic sur le menu hamburger
$menuHamburger.on('click', function() {
  // Vérifiez si la classe hide est présente sur le menu drop
  if ($menuDrop.hasClass('hide')) {
    // Si oui, retirez la classe hide
    $menuDrop.removeClass('hide');
  } else {
    // Sinon, ajoutez la classe hide
    $menuDrop.addClass('hide');
  }
});



$(document).ready(function(){
    // Ajoutez un sélecteur commun aux liens de votre navigation
    $('.navbar-bouton a, .menu-drop-bouton a').on('click', function(event) {
  
      // Empêche le comportement par défaut du lien
      event.preventDefault();
  
      // Récupère l'identifiant de la section cible
      var hash = this.hash;
  
      // Utilise la méthode animate de jQuery pour créer un défilement fluide
      $('html, body').animate({
        scrollTop: $(hash).offset().top
      }, 800, function(){
  
        // Ajoute l'identifiant de la section cible à l'URL une fois le défilement terminé
        window.location.hash = hash;
      });
    });
  });
  