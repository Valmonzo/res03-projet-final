<?php


class TournamentController extends AbstractController {

    // Attributs

    private TournamentManager $tournamentManager;
    private GameManager $gameManager;
    private GameRoundManager $gameRoundManager;
    private TeamManager $teamManager;


    // Construct

    public function __construct()
    {
        $this->tournamentManager = new TournamentManager();
        $this->gameManager = new GameManager();
        $this->gameRoundManager = new GameRoundManager();
        $this->teamManager = new TeamManager();
    }


    // Methodes


    public function create(array $post) : void {

        // Création de tournoi

        // Vérification du formulaire
        if(!empty($post['tournamentName']) && !empty($post['tournamentDate']) && !empty($post['gameName'])
        && !empty($post['tournamentDescription']) && count($_SESSION['tournament']['teams']) === 32) {

            $tournamentToInsert = new Tournament($post['tournamentName'], $post['tournamentDate'], $post['tournamentDescription'], $post['gameName'], '');


            if (!empty($post['streamURL'])) {

                // J'insère l'url du stream si le match est en live
                $tournamentToInsert->setStreamURL($post['streamURL']);
            }

            // Je transforme mon tableau associatifs en tableau de team avant de les insérer dans mon tournoi
            $tournamentToInsert->setTeams(array_map(
                function (array $team) {
                    $teamAsObject = new Team($team['name'], $team['playerOne'], $team['playerTwo'], $team['playerThree'], $team['playerFour'], $team['subPlayer'], $team['coach'], $team['logo']);
                    $teamAsObject->setId($team['id']
                );

                    return $teamAsObject;

                },
                $_SESSION['tournament']['teams']
            ));

            // Je stock le tableau de teams dans une variable
            $teamsParticipation = $tournamentToInsert->getTeams();

            // Je crée mes seizième de finales
            $last32 = new GameRound('last 32', $tournamentToInsert);

            // Je l'insère dans la base de données
            $last32->insertGameRound($last32);

            // Pour chaque équipe , je crée un match 1 vs 1 et je l'insère dans la base de données
            foreach ($i = 0; $i < count($teamsParticipation); $i + 2) {

               $game =  new Game($teamsParticipation[$i],$teamsParticipation[$i++], $last32);

               $this->gameManager->insertGame($game);
            }

            header('Location : /res03-projet-final/purge_tournament/admin/tournaments');



        }

        else {

            $teams = $this->teamManager->getAllTeams();

            $this->render('tournaments/create',['teams'=> $teams], 'private' );
        }

      //  $tournamentToInsert = new Tournament();
     //  $this->tournamentManager->insertTournament($tournamentToInsert);

     //$this->render('tournaments/create', [], 'private');
    }


    public function addTeam(int $id) : void {

        if(isset($_SESSION['tournament'])) {
            $teamToAdd =  $this->teamManager->getTeamById($id);

            $tournament = new Tournament("","","","","");

            // Je transforme mon tableau associatif en tableau de l'instance Team
            $tournament->setTeams(array_map(
                function (array $team) {
                    $teamAsObject = new Team($team['name'], $team['playerOne'], $team['playerTwo'], $team['playerThree'], $team['playerFour'], $team['subPlayer'], $team['coach'], $team['logo']);
                    $teamAsObject->setId($team['id']
                );

                    return $teamAsObject;

                },
                $_SESSION['tournament']['teams']
            ));

            $tournament->addTeam($teamToAdd);

            $teamToJson = $teamToAdd->toArray();

            $_SESSION['tournament'] = $tournament->toArray();

            $this->renderJson($teamToJson);
        }

        else {

            $newTournament = new Tournament("", "", "", "", "");

            $teamToAdd =  $this->teamManager->getTeamById($id);

            $newTournament->addTeam($teamToAdd);

            $teamToJson = $teamToAdd->toArray();

            $_SESSION['tournament'] = $newTournament->toArray();

            $this->renderJson($teamToJson);
        }


    }

    public function resetForm() : void {
        unset($_SESSION['tournament']);
        $this->renderJson([]);
    }

    public function edit(int $id, array $post) : void {
        // Edition de tournoi
    }

    public function renderTournaments() : void {
        // Affiche tous les tournois
    }

    public function deleteTournament(int $id) : void {
        // Supprimer un tournoi
    }
}