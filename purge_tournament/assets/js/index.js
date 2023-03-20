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
});
