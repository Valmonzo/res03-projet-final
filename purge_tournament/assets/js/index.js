window.addEventListener('DOMContentLoaded', function() {

    let selects = document.getElementsByClassName("top32");


    for (let i = 0; i < selects.length; i++) {

        selects[i].addEventListener('change', function(e) {

            let teamId = e.target.value;

            console.log(teamId);

            fetch(`https://valmontpehautpietri.sites.3wa.io/res03-projet-final/purge_tournament/admin/tournaments/create/add-team/${teamId}`)
                .then(response => response.json())
                .then(data => {
                        console.log(`La team ${data.name} est ajoutée`);
                    }

                );

            e.target.setAttribute('disabled', '');
            //e.target.option.setAttribute('disabled', '');

        });

    }

    let reset = document.getElementById('reset-tournament');

    reset.addEventListener('click', function(e) {
        fetch(`https://valmontpehautpietri.sites.3wa.io/res03-projet-final/purge_tournament/admin/tournaments/create/reset`)
            .then(response => response.json())
            .then(data => {
                    console.log(`C'est reset`);
                }

            );

        let selects = document.getElementsByTagName('select');
        for (let i = 0; i < selects.length; i++) {
            selects[i].removeAttribute('disabled');
        }

    })

    let tournament = document.getElementById('nbTournamentSpan');

    let tournamentId = tournament.getAttribute('idTournoi');

    let radioLast32 = document.querySelectorAll('.top32-edit input');

    let submit = document.getElementById('tournament-edit-btn');

    let form32 = document.getElementById('last32');


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


    //let radioLast16 = document.querySelectorAll('.top16-edit input');

    //let radioLast8 = document.querySelectorAll('.top8-edit input');

    //let radioLast4 = document.querySelectorAll('.top4-edit input');

    //let radioLast2 = document.querySelectorAll('.top2-edit input');

    /*for (let i = 0; i < radioLast32.length; i++) {

        radioLast32[i].addEventListener('change', function(e) {
            console.log(radioLast32[i].value);

            fetch(`https://valmontpehautpietri.sites.3wa.io/res03-projet-final/purge_tournament/admin/${tournamentId}//`)
                .then(response => response.json())
                .then(data => {
                        console.log(`Winner ajouté`);
                    }

                );

        });

    } */





});
