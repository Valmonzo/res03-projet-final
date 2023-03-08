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
        if(isset($_GET['path'])){
            $route = explode("/", $_GET['path']);

            //Pages publiques

            if ($route[0] === "home") {
                $this->rendererController->visitorHome();
            }

            else if ($route[0] === "about-us") {
                $this->rendererController->visitorAboutUs();
            }

            else if ($route[0] === "schedule") {

                if(isset($route[1])) {
                    $this->rendererController->renderEvent($route[1]);
                }

                else {
                    $this->rendererController->visitorSchedule();
                }

            }


        }

        else {

        }





    }
}