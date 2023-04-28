function loadTodayTournament() {
    fetch('https://valmontpehautpietri.sites.3wa.io/res03-projet-final/purge_tournament/loadTodayTournaments')
        .then(response => response.json())
        .then(data => {
            // Récupération des données du tournoi du jour
            let tournament = data[0];
            // Je crée des éléments HTML pour afficher mon tournoi
            let h2 = document.createElement('h2');
            h2.textContent = tournament.name;
            let p1 = document.createElement('p');
            p1.textContent = tournament.description;
            let p2 = document.createElement('p');
            p2.textContent = `Jeu : ${tournament.gameName}`;
            let p3 = document.createElement('p');
            p3.textContent = `Date : ${tournament.date}`;
            let a = document.createElement('a');
            a.href = tournament.stream_url;
            a.textContent = 'Regarder le stream';
            // Ajout des éléments de données du tournoi
            const tournamentInfo = document.getElementById('tournament-info');
            tournamentInfo.appendChild(h2);
            tournamentInfo.appendChild(p1);
            tournamentInfo.appendChild(p2);
            tournamentInfo.appendChild(p3);
            tournamentInfo.appendChild(a);
        })
}

// Appel de la fonction loadTodayTournament au chargement de la page
document.addEventListener('DOMContentLoaded', loadTodayTournament);
