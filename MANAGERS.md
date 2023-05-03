## Managers PURGE TOURNAMENT

ContactManager : Il sera appelé par le ContactController et se chargera de faire les requêtes SQL dans la table contact

UserManager : Appelé par le UserController , il servira uniquement à créer des comptes admin à les éditer ou les effacer depuis la table user

TournamentManager : Appelé par le TournamentController , il servira à 
créer un événements , les éditer ou les supprimer depuis la table tournament.

GameManager : Appelé par le GameController , il servira à éditer , créer et supprimer des rounds du tournoi depuis la table game.

GameRoundManager : Appelé par le GameController pour afficher et le GameRoundController pour l'édition la suppression et la création de round.

MediaManager : Appelé par le MediaController pour ajouter des médias les éditer ou les supprimer.
