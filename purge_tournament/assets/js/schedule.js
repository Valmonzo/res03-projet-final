function loadTodayTournament() {
    fetch('https://valmontpehautpietri.sites.3wa.io/res03-projet-final/purge_tournament/loadTodayTournaments')
        .then(response => response.json())
        .then(data => {
            if (data.length > 0) {
                for (let i = 0; i < data.length; i++) {
                    // Récupération des données du tournoi du jour
                    let tournament = data[i];
                    // Je crée des éléments HTML pour afficher mon tournoi
                    let section = document.createElement('section');
                    let h3 = document.createElement('h3');
                    h3.textContent = tournament.name;
                    let p1 = document.createElement('p');
                    p1.textContent = tournament.description;
                    let p2 = document.createElement('p');
                    p2.textContent = `Jeu : ${tournament.gameName}`;
                    let p3 = document.createElement('p');
                    p3.textContent = `Date : ${tournament.date}`;
                    let a = document.createElement('a');
                    a.href = tournament.stream_url;
                    a.textContent = 'Regarder le stream';
                    let bracket = document.createElement('a');
                    bracket.href = `/res03-projet-final/purge_tournament/schedule/${tournament.id}`;
                    bracket.textContent = 'Voir le bracket';
                    // Ajout des éléments de données du tournoi
                    let tournamentInfo = document.getElementById('tournament-info');
                    section.appendChild(h3);
                    section.appendChild(p1);
                    section.appendChild(p2);
                    section.appendChild(p3);
                    section.appendChild(a);
                    section.appendChild(bracket);
                    tournamentInfo.appendChild(section);
                }
            }
            else {
                let section = document.createElement('section');
                let h2 = document.createElement('h3');
                h2.textContent = "Il n'y a pas de tournoi aujourd'hui !";
                section.appendChild(h2);
                let tournamentInfo = document.getElementById('tournament-info');
                tournamentInfo.appendChild(section);
            }
        })
}

// Appel de la fonction loadTodayTournament au chargement de la page
document.addEventListener('DOMContentLoaded', loadTodayTournament);
