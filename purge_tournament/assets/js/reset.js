function resetForm() {
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
}

export { resetForm };
