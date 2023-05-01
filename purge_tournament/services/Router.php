<?php

class Router {

    private RendererController $rendererController;
    private ContactController $contactController;
    private TeamController $teamController;
    private TournamentController $tournamentController;
    private UserController $userController;
    private GameController $gameController;
    private GameRoundController $gameRoundController;
    private MediaController $mediaController;


    public function __construct()
    {
        $this->rendererController = new RendererController();
        $this->contactController = new ContactController();
        $this->teamController = new TeamController();
        $this->tournamentController = new TournamentController();
        $this->userController = new UserController();
    }

    function checkRoute() : void
    {
        $post = $_POST;

        if (!isset($_GET['path'])) {

            $this->rendererController->visitorHome(); // Si pas de route , je redirige sur la homepage
        }

        else {

            $route = explode("/", $_GET['path']); // Je sépare tout ce qui se trouve entre les "/" pour les différentes routes


            //Pages publiques

            if ($route[0] === "about-us") {

                $this->rendererController->visitorAboutUs(); // Qui affichera la page about-us
            }

            else if ($route[0] === "schedule") {

                if(isset($route[1])) {

                    $this->rendererController->renderEvent(intval($route[1])); // Si je veux afficher un évent en particulier , je prend son id et j'appelle renderEvent
                }

                else {

                    $this->rendererController->visitorSchedule(); // J'affiche la page du Schedule
                }
            }

            else if($route[0] === "loadTodayTournaments") {
                $this->tournamentController->renderTournamentsOfTheDay();
            }

            else if($route[0] === "contact") {

                if(!empty($post) && $post['formName'] === 'contact') {

                    $this->contactController->newMessage($post); // J'appelle le contactController pour recevoir le formulaire et traiter la données puis Render avec un msg
                }

                else {

                    $this->rendererController->visitorContact(); // J'affiche la page de contact
                }

            }

            /* else if($route[0] === "register") {
                $this->userController->register($post); // J'appelle la page du formulaire de registration
            } */


            // Pages admin


            else if($route[0] === "admin") {

                if(isset($_SESSION['admin']) && $_SESSION['admin'] === "ok") {
                    // Je suis connecté

                    if (!isset($route[1])) {
                        // /admin
                        $this->rendererController->adminIndex(); // J'affiche l'index admin
                    }

                    else {

                        if(!isset($route[2])) {

                                //  admin/un-truc

                            match ($route[1]) {
                            'tournaments' => $this->tournamentController->renderTournaments(), // J'affiche tous les events /admin/events
                            'teams' => $this->teamController->renderTeams(), // J'affiche toutes les teams /admin/teams
                            'contacts' => $this->contactController->renderMessages(), // J'affiche toutes les demandes de contact /admin/contacts
                            default => $this->rendererController->page404() // Si le chemin est mauvais je redirige sur 404 /page404
                            };
                        }

                        else {

                            if(!isset($route[3])) {
                                // admin/un-truc/un-autre

                                if($route[2] === "create" ) {
                                    match ($route[1]) {
                                        'tournaments' => $this->tournamentController->create($post), // J'affiche  /admin/event/create
                                        'teams' => $this->teamController->create($post), // J'affiche  /admin/team/create
                                        default => $this->rendererController->page404(), // Si le chemin est mauvais je redirige sur 404 /page404
                                    };
                                }

                                else {
                                    match ($route[1]) {
                                        'tournaments' => $this->tournamentController->edit(intval($route[2]), $post), // J'affiche  /admin/event/:id
                                        'teams' => $this->teamController->show($route[2]), // J'affiche  /admin/team/:id
                                        default => $this->rendererController->page404(), // Si le chemin est mauvais je redirige sur 404 /page404
                                    };
                                }
                            }

                            else {

                                if(!isset($route[4])) {

                                    if($route[3] === "edit") {
                                        match ($route[1]) {
                                        'tournaments' => $this->tournamentController->edit(intval($route[2]), $post), // J'affiche  /admin/event/:id/edit
                                        'teams' => $this->teamController->edit($route[2], $post), // J'affiche  /admin/team/:id/edit
                                        default => $this->rendererController->page404(), // Si le chemin est mauvais je redirige sur 404 /page404
                                        };
                                    }

                                    else if ($route[3] === "delete") {
                                        match ($route[1]) {
                                        'tournaments' => $this->tournamentController->deleteTournament(intval($route[2])),// J'affiche  /admin/event/:id/delete
                                        'teams' => $this->teamController->deleteTeam($route[2]), // J'affiche  /admin/team/:id/delete
                                        'messages' => $this->contactController->deleteMessage($route[2]), // Je supprime un message
                                        default => $this->rendererController->page404(), // Si le chemin est mauvais je redirige sur 404 /page404
                                        };
                                    }

                                     else if($route[3] === "reset") {
                                        $this->tournamentController->resetForm();  // J'appelle mon controller pour reset la varibla $_SESSION['tournament']
                                    }

                                    else if($route[3] === "add-winner") {
                                        $this->tournamentController->addWinner(intval($route[2]), $post); // J'appelle la méthode de mon controller qui va récupere le tournoi par l'id, récuperer son round et ajouter les winners pour les setup au prochain round
                                    }

                                    else {
                                            $this->rendererController->page404(); // Si le chemin est mauvais je redirige sur 404 /page404
                                    }
                                }





                                else {

                                    if($route[3] === "add-team") {

                                            $this->tournamentController->addTeam(intval($route[4]));
                                    }

                                    else {
                                        $this->rendererController->page404(); // Si le chemin est mauvais je redirige sur 404 /page404
                                    }


                                }
                            }
                        }


                    }
                }

                else {
                    // Je ne suis pas connecté
                    $this->userController->login($post); // Je render la page de login

                }
            }

            // Deconnexion

            else if ($route[0] === "logout") {
                $this->userController->logout(); // Je déconnecte l'admin
            }

            // Si rien ne rentre dans les conditions

            else {

                $this->rendererController->page404(); // J'affiche une page 404
            }


        }

    }
}