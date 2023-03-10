<?php

class RendererController extends AbstractController {

    private TournamentManager $tournamentManager;
    private MatchManager $matchManager;
    private MatchRoundManager $matchRoundManager;
    private TeamManager $teamManager;
    private ContactManager $contactManager;

    public function __construct() {
        $this->tournamentManager = new TournamentManager();
        $this->matchManager = new MatchManager();
        $this->matchRoundManager = new MatchRoundManager();
        $this->teamManager = new TeamManager();
        $this->contactManager = new ContactManager();
    }


    public function visitorHome() : void {

        $this->render('homepage' , ['page' => 'homepage']);

    }

    public function visitorAboutUs() : void {
        $this->render('about-us', ['page' => 'about-us']);
    }

    public function visitorSchedule() : void  {
        $this->render('schedule', ['page' => 'schedule']);
    }

    public function page404() : void {
        $this->render('404' , []);
    }

    public function adminIndex() : void {
        $this->render('homepage', [], 'private');
    }


}