document.addEventListener('DOMContentLoaded', function () {
    var licencieItems = document.querySelectorAll('ul li');

    licencieItems.forEach(function (item) {
        var modifierLink = item.querySelector('.modifier');
        var supprimerLink = item.querySelector('.supprimer');

        modifierLink.addEventListener('click', function (event) {
            event.preventDefault();
            var licencieId = item.getAttribute('data-id');
            // Ajouter du code pour gérer l'action "Modifier"
            // appel de la méthode displayFormUpdate dans la classe LicencieController

           
            console.log('Modifier licencie avec ID', licencieId);
        });

        supprimerLink.addEventListener('click', function (event) {
            var licencieId = item.getAttribute('data-id');
            // Ajouter du code pour gérer l'action "Supprimer"
            if (confirm('Êtes-vous sûr de vouloir supprimer ce licencié ?')) {
                console.log('Supprimer licencie avec ID', licencieId);
                // Ajouter ici une logique pour envoyer une demande de suppression côté serveur si nécessaire
                // appel de la méthode deleteLicencie dans la classe LicencieController
                
            }
        });
    });

    var creerLicencieLink = document.querySelector('.creer-licencie');
    creerLicencieLink.addEventListener('click', function (event) {
        event.preventDefault();
        // Ajouter du code pour gérer l'action "Créer"
        console.log('Créer un nouveau licencié');
    });
});
