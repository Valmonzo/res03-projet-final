<?php


class TeamController extends AbstractController {

    // Attributs

    private TeamManager $teamManager;

    // Construct

    public function __construct()
    {
        $this->teamManager = new TeamManager();
    }

    // Methodes

    public function renderTeams() : void {

        $teams = $this->teamManager->getAllTeams(); // Je fais une requête pour demander la liste des teams et les stocker dans un tableau

        $this->render('teams/teams', $teams, 'private'); // Je render la page team avec la liste stockée dans $data.
    }


    public function edit(int $id, array $post) : void {


        if (!empty($post['teamName']) && !empty($post['teamP1']) && !empty($post['teamP2']) && !empty($post['teamP3'])
        && !empty($post['teamP4']) && !empty($post['teamPSub']) && !empty($post['coach']) && !empty($post['logo']) // Je vérifie si le formulaire est bien rempli
        && $post['formName'] === 'team-edit') { // Si c'est bien le bon formulaire

            $teamToUpdate = new Team($post['teamName'], $post['teamP1'], $post['teamP2'], $post['teamP3'],
            $post['teamP4'], $post['teamPSub'], $post['coach'], $post['logo']); // Je créer une instance de Team pour utiliser l'update du manager

            $teamToUpdate->setId($id); // Je set son id

            $this->teamManager->editTeam($teamToUpdate); // Et je fais la requête pour le mettre à jour

            header('Location: res03-projet-final/purge_tournament/admin/teams');
        }

        else {
            $team = $this->teamManager->getTeamById($id); // Je fais une requête pour obtenir la team qu'il faut afficher

            $this->render('teams/edit', ["team" => $team], 'private'); // Je render la page pour éditer la team en question
        }

    }

    public function create(array $post) : void {

        if (!empty($post['teamName']) && !empty($post['teamP1']) && !empty($post['teamP2']) && !empty($post['teamP3'])
        && !empty($post['teamP4']) && !empty($post['teamPSub']) && !empty($post['coach']) && !empty($post['logo'])
        && $post['formName'] === 'team-create') {

            // Si le formulaire est bien rempli

            $teamToInsert = new Team($post['teamName'] , $post['teamP1'], $post['teamP2'], $post['teamP3'],
            $post['teamP4'], $post['teamPSub'], $post['coach'], $post['logo']);

            $this->teamManager->insertTeam($teamToInsert); // Je fais une team et je l'insère dans la base de données

            header('Location: /res03-projet-final/purge_tournament/admin/teams'); // Je redirige vers la liste des teams
        }

        else {

            // Si le formulaire n'est pas bien rempli
            $this->render('teams/create', ['error' => 'Merci de bien remplir tous les champs'], 'private'); // Je render la même page avec une erreur

        }
    }

    public function deleteTeam(int $id) {
        // Supprimer une team

        $this->teamManager->deleteTeamById($id);

        header('Location: /res03-projet-final/purge_tournament/admin/teams');


    }

}