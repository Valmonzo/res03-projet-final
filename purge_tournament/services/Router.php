<?php

class Router {

    private RendererController $rendererController;
    private ContactController $contactController;
    private TeamController $teamController;
    private TournamentController $tournamentController;
    private UserController $userController;
    private MatchController $matchController;
    private MatchRoundController $matchRoundController;
    private MediaController $mediaController;


    public function __construct()
    {
        $this->rendererController = new RendererController();
        $this->contactController = new ContactController();
        $this->teamController = new TeamController();
        $this->tournamentController = new TournamentController();
        $this->userController = new UserController();
        $this->matchController = new MatchController();
        $this->matchRoundController = new MatchRoundController();
        $this->mediaController = new MediaController(); 
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

                    $this->rendererController->renderEvent($route[1]); // Si je veux afficher un évent en particulier , je prend son id et j'appelle renderEvent
                }

                else {

                    $this->rendererController->visitorSchedule(); // J'affiche la page du Schedule
                }
            }

            else if($route[0] === "contact") {

                if(isset($route[1]) && $route[1] === "new") {

                    $this->contactController->newContact($post); // J'appelle le contactController pour recevoir le formulaire et traiter la données puis Render avec un msg
                }

                else {

                    $this->rendererController->visitorContact(); // J'affiche la page de contact
                }

            }
            
            else if($route[0] === "register") {
                $this->userController->register($post); // J'appelle la page du formulaire de registration 
            }


            // Pages admin

            else if($route[0] === "admin") {

                if(isset($_SESSION['admin']) && $_SESSION['admin'] === "ok") {
                    // Je suis connecté

                    if (!isset($route[1])) {
                        // /admin
                        $this->rendererController->adminHome(); // J'affiche l'index admin
                    }

                    else {

                        if(!isset($route[2])) {

                                //  admin/un-truc

                            match ($route[1]) {
                            'events' => $this->tournamentController->renderEvents(), // J'affiche tous les events /admin/events
                            'brackets' =>$this->matchController->renderBrackets(), // J'affiche tous les brackets par tournoi /admin/brackets
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
                                        'events' => $this->tournamentController->createEvents(), // J'affiche  /admin/event/create
                                        'brackets' =>$this->matchController->createBrackets(), // J'affiche  /admin/bracket/create
                                        'teams' => $this->teamController->createTeams(), // J'affiche  /admin/team/create
                                        default => $this->rendererController->page404(), // Si le chemin est mauvais je redirige sur 404 /page404
                                    };
                                }

                                else {
                                    match ($route[1]) {
                                        'events' => $this->tournamentController->showEvent($route[2]), // J'affiche  /admin/event/:id
                                        'brackets' =>$this->matchController->showBracket($route[2]), // J'affiche  /admin/bracket/:id
                                        'teams' => $this->teamController->showTeam($route[2]), // J'affiche  /admin/team/:id
                                        default => $this->rendererController->page404(), // Si le chemin est mauvais je redirige sur 404 /page404
                                    };
                                }
                            }

                            else {

                                if(!isset($route[4])) {

                                    if($route[3] === "edit") {
                                        match ($route[1]) {
                                        'events' => $this->tournamentController->editEvent($route[2]), // J'affiche  /admin/event/:id/edit
                                        'brackets' =>$this->matchController->editBracket($route[2]), // J'affiche  /admin/bracket/:id/edit
                                        'teams' => $this->teamController->editTeam($route[2]), // J'affiche  /admin/team/:id/edit
                                        default => $this->rendererController->page404(), // Si le chemin est mauvais je redirige sur 404 /page404
                                        };
                                    }

                                    else if ($route[3] === "delete") {
                                        match ($route[1]) {
                                        'events' => $this->tournamentController->deleteEvent($route[2]), // J'affiche  /admin/event/:id/delete
                                        'brackets' =>$this->matchController->deleteBracket($route[2]), // J'affiche  /admin/bracket/:id/delete
                                        'teams' => $this->teamController->deleteTeam($route[2]), // J'affiche  /admin/team/:id/delete
                                        default => $this->rendererController->page404(), // Si le chemin est mauvais je redirige sur 404 /page404
                                        };
                                    }

                                    else {
                                        $this->rendererController->page404(); // Si le chemin est mauvais je redirige sur 404 /page404
                                    }
                                }

                                else {
                                    $this->rendererController->page404(); // Si le chemin est mauvais je redirige sur 404 /page404
                                }
                            }
                        }


                    }
                }
            }

            // Si rien ne rentre dans les conditions

            else {

                $this->rendererController->page404(); // J'affiche une page 404
            }


        }

    }
}