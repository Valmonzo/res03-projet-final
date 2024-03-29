<?php

class RendererController extends AbstractController
{
    private TournamentManager $tournamentManager;
    private GameManager $gameManager;
    private GameRoundManager $gameRoundManager;
    private TeamManager $teamManager;
    private ContactManager $contactManager;

    public function __construct()
    {
        $this->tournamentManager = new TournamentManager();
        $this->gameManager = new GameManager();
        $this->gameRoundManager = new GameRoundManager();
        $this->teamManager = new TeamManager();
        $this->contactManager = new ContactManager();
    }

    public function visitorHome(): void
    {
        $this->render("homepage/homepage", ["page" => "homepage"]);
    }

    public function visitorAboutUs(): void
    {
        $this->render("about-us/about-us", ["page" => "about-us"]);
    }

    public function visitorSchedule(): void
    {
        $this->render("schedule/schedule", []);
    }

    public function page404(): void
    {
        $this->render("404/404", []);
    }

    public function adminIndex(): void
    {
        $this->render("homepage/homepage", [], "private");
    }

    public function visitorContact(): void
    {
        $this->render("contact/contact", []);
    }

    public function renderEvent(int $id): void
    {
        $tournament = $this->tournamentManager->getTournamentById($id);
        $gamerounds = [];
        if ($tournament !== null) {
            $gamerounds = $this->gameRoundManager->getGameRoundsByTournament($tournament);
            foreach($gamerounds as $gameround) {
                $games = $this->gameManager->getGamesByGameRound($gameround);
                $gameround->setGames($games);
            }
        }


        $this->render("bracket/bracket", $gamerounds);
    }

    public function visitorStream(): void
    {
        $this->render("stream/stream", []);
    }
}
