import { resetForm } from './reset.js';

function createTournament() {
    let selects = document.getElementsByClassName("top32");


    for (let i = 0; i < selects.length; i++) {

        selects[i].addEventListener('change', function(e) {

            let teamId = e.target.value;

            fetch(`https://valmontpehautpietri.sites.3wa.io/res03-projet-final/purge_tournament/admin/tournaments/create/add-team/${teamId}`)
                .then(response => response.json())
                .then(data => {
                        console.log(`La team ${data.name} est ajoutée`);
                    }

                );

            e.target.setAttribute('disabled', '');

        });

    }
}


window.addEventListener('DOMContentLoaded', function() {


    createTournament();
    resetForm();

});
