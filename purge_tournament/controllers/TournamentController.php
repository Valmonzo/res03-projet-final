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
        if(!isset($_SESSION['tournament'])) {
            $teams = $this->teamManager->getAllTeams();
            $this->render('tournaments/create',['teams'=> $teams], 'private' );
        }
      //  $tournamentToInsert = new Tournament();
     //  $this->tournamentManager->insertTournament($tournamentToInsert);

     //$this->render('tournaments/create', [], 'private');
    }


    public function addTeam(int $id) : void {

        if(isset($_SESSION['tournament'])) {
            $tournament = $_SESSION['tournament'];
            $teamToAdd =  $this->teamManager->getTeamById($id);
            $tournament->addTeam($teamToAdd);
        }

        else {

            $newTournament = new Tournament("", "", "", "", "");
            $teamToAdd =  $this->teamManager->getTeamById($id);
            $newTournament->addTeam($teamToAdd);
            $_SESSION['tournament'] = $newTournament;
        }


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