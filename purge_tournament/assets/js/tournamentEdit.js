function editTournament() {

    let tournament = document.getElementById('nbTournamentSpan');

    let tournamentId = tournament.getAttribute('idTournoi');

    let radioLast32 = document.querySelectorAll('.top32-edit input');

    let submit = document.getElementById('tournament-edit-btn');

    let form32 = document.getElementById('last32');

    let form16 = document.getElementById('last16');

    let form8 = document.getElementById('last8');

    let form4 = document.getElementById('last4');

    let form2 = document.getElementById('last2');


    form32.addEventListener('submit', function(e) {

        e.preventDefault();

        // Je dois d'abord instancier un FormData qui est la représentation en JavaScript d'un formulaire
        let formData = new FormData(form32);
        console.log(formData);

        const options = {
            method: 'POST',
            body: formData
        };

        fetch(`https://valmontpehautpietri.sites.3wa.io/res03-projet-final/purge_tournament/admin/tournaments/${tournamentId}/add-winner`, options)
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });


    })

    form16.addEventListener('submit', function(e) {

        e.preventDefault();

        // Je dois d'abord instancier un FormData qui est la représentation en JavaScript d'un formulaire
        let formData = new FormData(form16);
        console.log(formData);

        const options = {
            method: 'POST',
            body: formData
        };

        fetch(`https://valmontpehautpietri.sites.3wa.io/res03-projet-final/purge_tournament/admin/tournaments/${tournamentId}/add-winner`, options)
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });


    })

    form8.addEventListener('submit', function(e) {

        e.preventDefault();

        // Je dois d'abord instancier un FormData qui est la représentation en JavaScript d'un formulaire
        let formData = new FormData(form8);
        console.log(formData);

        const options = {
            method: 'POST',
            body: formData
        };

        fetch(`https://valmontpehautpietri.sites.3wa.io/res03-projet-final/purge_tournament/admin/tournaments/${tournamentId}/add-winner`, options)
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });


    })

    form4.addEventListener('submit', function(e) {

        e.preventDefault();

        // Je dois d'abord instancier un FormData qui est la représentation en JavaScript d'un formulaire
        let formData = new FormData(form4);
        console.log(formData);

        const options = {
            method: 'POST',
            body: formData
        };

        fetch(`https://valmontpehautpietri.sites.3wa.io/res03-projet-final/purge_tournament/admin/tournaments/${tournamentId}/add-winner`, options)
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });


    })

    form2.addEventListener('submit', function(e) {

        e.preventDefault();

        // Je dois d'abord instancier un FormData qui est la représentation en JavaScript d'un formulaire
        let formData = new FormData(form2);
        console.log(formData);

        const options = {
            method: 'POST',
            body: formData
        };

        fetch(`https://valmontpehautpietri.sites.3wa.io/res03-projet-final/purge_tournament/admin/tournaments/${tournamentId}/add-winner`, options)
            .then(response => response.json())
            .then(data => {
                console.log(data);
            });


    })
}

window.addEventListener('DOMContentLoaded', function() {

    editTournament();

});