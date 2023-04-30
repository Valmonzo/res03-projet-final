<?php

class TournamentController extends AbstractController
{
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

    public function create(array $post): void
    {
        // Création de tournoi

        // Vérification du formulaire
        if (
            !empty($post["tournamentName"]) &&
            !empty($post["tournamentDate"]) &&
            !empty($post["gameName"]) &&
            !empty($post["tournamentDescription"]) &&
            count($_SESSION["tournament"]["teams"]) === 32
        ) {
            $tournamentToInsert = new Tournament(
                $post["tournamentName"],
                $post["tournamentDate"],
                $post["tournamentDescription"],
                $post["gameName"],
                ""
            );

            if (!empty($post["streamURL"])) {
                // J'insère l'url du stream si le match est en live
                $tournamentToInsert->setStreamURL($post["streamURL"]);
            }

            // Je transforme mon tableau associatifs en tableau de team avant de les insérer dans mon tournoi
            $tournamentToInsert->setTeams(
                array_map(function (array $team) {
                    $teamAsObject = new Team(
                        $team["name"],
                        $team["playerOne"],
                        $team["playerTwo"],
                        $team["playerThree"],
                        $team["playerFour"],
                        $team["subPlayer"],
                        $team["coach"],
                        $team["logo"]
                    );
                    $teamAsObject->setId($team["id"]);

                    return $teamAsObject;
                }, $_SESSION["tournament"]["teams"])
            );

            //J'insère mon tournoi dans la base de données pour l'avoir avec son id en output
            $this->tournamentManager->insertTournament($tournamentToInsert);

            // Je stock le tableau de teams dans une variable
            $teamsParticipation = $tournamentToInsert->getTeams();

            // Je crée mes Pool
            $last32 = new GameRound("last 32", $tournamentToInsert);

            $last16 = new GameRound("last 16", $tournamentToInsert);

            $last8 = new GameRound("last 8", $tournamentToInsert);

            $last4 = new GameRound("last 4", $tournamentToInsert);

            $last2 = new GameRound("last 2", $tournamentToInsert);

            // Je l'insère dans la base de données
            $this->gameRoundManager->insertGameRound($last32);

            $this->gameRoundManager->insertGameRound($last16);

            $this->gameRoundManager->insertGameRound($last8);

            $this->gameRoundManager->insertGameRound($last4);

            $this->gameRoundManager->insertGameRound($last2);

            // Pour chaque équipe , je crée un match 1 vs 1 et je l'insère dans la base de données

            for ($i = 0; $i < 32; $i += 2) {
                $game = new Game(
                    $teamsParticipation[$i],
                    $teamsParticipation[$i + 1],
                    $last32
                );

                $this->gameManager->insertGame($game);
            }

            for ($i = 0; $i < 16; $i += 2) {
                $game = new Game(null, null, $last16);

                $this->gameManager->insertGame($game);
            }

            for ($i = 0; $i < 8; $i += 2) {
                $game = new Game(null, null, $last8);

                $this->gameManager->insertGame($game);
            }

            for ($i = 0; $i < 4; $i += 2) {
                $game = new Game(null, null, $last4);

                $this->gameManager->insertGame($game);
            }

            for ($i = 0; $i < 2; $i += 2) {
                $game = new Game(null, null, $last2);

                $this->gameManager->insertGame($game);
            }

            header(
                "Location: /res03-projet-final/purge_tournament/admin/tournaments"
            );
        } else {
            $teams = $this->teamManager->getAllTeams();

            $this->render("tournaments/create", ["teams" => $teams], "private");
        }
    }

    public function addTeam(int $id): void
    {
        if (isset($_SESSION["tournament"])) {
            $teamToAdd = $this->teamManager->getTeamById($id);

            $tournament = new Tournament("", "", "", "", "");

            // Je transforme mon tableau associatif en tableau de l'instance Team
            $tournament->setTeams(
                array_map(function (array $team) {
                    $teamAsObject = new Team(
                        $team["name"],
                        $team["playerOne"],
                        $team["playerTwo"],
                        $team["playerThree"],
                        $team["playerFour"],
                        $team["subPlayer"],
                        $team["coach"],
                        $team["logo"]
                    );
                    $teamAsObject->setId($team["id"]);

                    return $teamAsObject;
                }, $_SESSION["tournament"]["teams"])
            );

            $tournament->addTeam($teamToAdd);

            $teamToJson = $teamToAdd->toArray();

            $_SESSION["tournament"] = $tournament->toArrayTeams();

            $this->renderJson($teamToJson);
        } else {
            $newTournament = new Tournament("", "", "", "", "");

            $teamToAdd = $this->teamManager->getTeamById($id);

            $newTournament->addTeam($teamToAdd);

            $teamToJson = $teamToAdd->toArray();

            $_SESSION["tournament"] = $newTournament->toArrayTeams();

            $this->renderJson($teamToJson);
        }
    }

    public function resetForm(): void
    {
        unset($_SESSION["tournament"]);
        $this->renderJson([]);
    }

    public function edit(int $id, array $post): void
    {
        /*

        Je veux charger un tournoi
        Je veux charger tous les rounds correspondant au tournoi
        Je veux charger toutes les games correspondant aux rounds
        Je veux charger les teams de chaque game
        Je veux remplir un tableau qui contient le tournoi qui lui même contient les rounds qui lui même contient les games qui lui même contient les teams

        */
        // Je fais une requête pour avoir mon tournoi
        $tournament = $this->tournamentManager->getTournamentById($id);

        if (
            isset($post["tournamentName"]) &&
            isset($post["tournamentDate"]) &&
            isset($post["gameName"]) &&
            isset($post["tournamentDescription"]) &&
            isset($post["streamURL"]) &&
            $post["formName"] === "tournament-edit-info"
        ) {
            $tournament->setName($post["tournamentName"]);
            $tournament->setDate($post["tournamentDate"]);
            $tournament->setGameName($post["gameName"]);
            $tournament->setDescription($post["tournamentDescription"]);
            $tournament->setStreamURL($post["streamURL"]);
            $this->tournamentManager->updateTournament($tournament);
        }
        // Je fais une requête pour les rounds correspondant au tournoi
        $gameRounds = $this->gameRoundManager->getGameRoundsByTournament(
            $tournament
        );

        // Pour chaque fois je fais une requête pour avoir les games et je les set dans chaque gameround correspondant
        foreach ($gameRounds as $gameRound) {
            $games = $this->gameManager->getGamesByGameRound($gameRound);
            $gameRound->setGames($games);
        }

        // Je set mes gamerounds déjà remplis par les games au préalable dans mon tournoi
        $tournament->setGameRounds($gameRounds);

        // Je render la page pour éditer la team en question
        $this->render(
            "tournaments/edit/edit",
            ["tournament" => $tournament->toArrayTournament()],
            "private"
        );
    }

    public function addWinner(int $id, array $post): void
    {
        // Je récupère toutes les infos dont j'ai besoin dans ma base de données

        $tournament = $this->tournamentManager->getTournamentById($id);

        $formName = $post["formName"];

        $gameRounds = $this->gameRoundManager->getGameRoundsByTournament(
            $tournament
        );

        $gameRound16 = $this->gameRoundManager->getGameRoundByTournamentAndGameRoundName(
            $tournament,
            "last 16"
        );

        $games16 = $this->gameManager->getGamesByGameRound($gameRound16);

        $gameRound8 = $this->gameRoundManager->getGameRoundByTournamentAndGameRoundName(
            $tournament,
            "last 8"
        );

        $games8 = $this->gameManager->getGamesByGameRound($gameRound8);

        $gameRound4 = $this->gameRoundManager->getGameRoundByTournamentAndGameRoundName(
            $tournament,
            "last 4"
        );

        $games4 = $this->gameManager->getGamesByGameRound($gameRound4);

        $gameRound2 = $this->gameRoundManager->getGameRoundByTournamentAndGameRoundName(
            $tournament,
            "last 2"
        );

        $game2 = $this->gameManager->getGamesByGameRound($gameRound2);

        // Si mes winners concernent le formulaire du top 32

        if ($formName === "tournament-edit-32") {
            $gameRound32 = $this->gameRoundManager->getGameRoundByTournamentAndGameRoundName(
                $tournament,
                "last 32"
            );

            $games32 = $this->gameManager->getGamesByGameRound($gameRound32);

            foreach ($games32 as $game) {
                // Je récupère chaque team dans chaque game du gameRound et je compare avec la valeur de la radio pour déterminer le vainqueur

                $teamA = $game->getTeamA();

                $teamB = $game->getTeamB();

                foreach ($post as $key => $winner) {
                    if ($key !== "formName") {
                        if (
                            $teamA->getId() === intval($winner) ||
                            $teamB->getId() === intval($winner)
                        ) {
                            // Si résultat positif, j'ajoute le winner à la game

                            $game->setWinner(intval($winner));

                            $this->gameManager->editGame($game);
                        }
                    }
                }
            }

            // Je récupère mes games du top d'après et je set les team dans chaque match

            $i = 1;

            foreach ($games16 as $game) {
                $game->setTeamA($this->teamManager->getTeamById($post[$i]));

                $game->setTeamB($this->teamManager->getTeamById($post[$i + 1]));

                $this->gameManager->editGame($game);

                $i += 2;
            }

            $this->renderJson([]);
        } elseif ($formName === "tournament-edit-16") {
            // Même chose pour le round d'après

            foreach ($games16 as $game) {
                $teamA = $game->getTeamA();

                $teamB = $game->getTeamB();

                foreach ($post as $key => $winner) {
                    if ($key !== "formName") {
                        if (
                            $teamA->getId() === intval($winner) ||
                            $teamB->getId() === intval($winner)
                        ) {
                            $game->setWinner(intval($winner));

                            $this->gameManager->editGame($game);
                        }
                    }
                }
            }

            $i = 17;

            foreach ($games8 as $game) {
                $game->setTeamA($this->teamManager->getTeamById($post[$i]));

                $game->setTeamB($this->teamManager->getTeamById($post[$i + 1]));

                $this->gameManager->editGame($game);

                $i += 2;
            }

            $this->renderJson([]);
        } elseif ($formName === "tournament-edit-8") {
            foreach ($games8 as $game) {
                $teamA = $game->getTeamA();

                $teamB = $game->getTeamB();

                foreach ($post as $key => $winner) {
                    if ($key !== "formName") {
                        if (
                            $teamA->getId() === intval($winner) ||
                            $teamB->getId() === intval($winner)
                        ) {
                            $game->setWinner(intval($winner));

                            $this->gameManager->editGame($game);
                        }
                    }
                }
            }

            $i = 25;

            foreach ($games4 as $game) {
                $game->setTeamA($this->teamManager->getTeamById($post[$i]));

                $game->setTeamB($this->teamManager->getTeamById($post[$i + 1]));

                $this->gameManager->editGame($game);

                $i += 2;
            }

            $this->renderJson([]);
        } elseif ($formName === "tournament-edit-4") {
            foreach ($games4 as $game) {
                $teamA = $game->getTeamA();

                $teamB = $game->getTeamB();

                foreach ($post as $key => $winner) {
                    if ($key !== "formName") {
                        if (
                            $teamA->getId() === intval($winner) ||
                            $teamB->getId() === intval($winner)
                        ) {
                            $game->setWinner(intval($winner));

                            $this->gameManager->editGame($game);
                        }
                    }
                }
            }

            $i = 29;

            foreach ($game2 as $game) {
                $game->setTeamA($this->teamManager->getTeamById($post[$i]));

                $game->setTeamB($this->teamManager->getTeamById($post[$i + 1]));

                $this->gameManager->editGame($game);

                $i += 2;
            }

            $this->renderJson([]);
        } elseif ($formName === "tournament-edit-2") {
            $game2[0]->setWinner($post[31]);
            $this->gameManager->editGame($game2[0]);
            $winner = $this->teamManager->getTeamById($post[31]);
            $winnerToJson = $winner->toArray();
            $this->renderJson([$winnerToJson]);
        }
    }

    public function deleteTournament(int $id): void
    {
        // Supprimer un tournoi, le but est aussi de supprimer tout ce qui est en rapport avec le tournoi donc les games et les gameRounds
        $tournamentToDelete = $this->tournamentManager->getTournamentById($id);
        $gameRoundsToDelete = $this->gameRoundManager->getGameRoundsByTournament(
            $tournamentToDelete
        );

        // Pour chaque gameRound présent dans le tournoi , je vais supprimer les games
        foreach ($gameRoundsToDelete as $gameRound) {
            $this->gameManager->deleteGamesByGameRoundId($gameRound->getId());
        }

        $this->gameRoundManager->deleteGameRoundByTournamentId($id);
        $this->tournamentManager->deleteTournamentById($id);
        header(
            "Location: /res03-projet-final/purge_tournament/admin/tournaments"
        );
    }

    public function renderTournaments(): void
    {
        unset($_SESSION["tournament"]);
        $tournaments = $this->tournamentManager->getAllTournaments(); // Je fais une requête pour demander la liste des tournois et les stocker dans un tableau

        $this->render("tournaments/tournaments", $tournaments, "private"); // Je render la page tournaments avec la liste stockée dans $data.
    }

    public function renderTournamentsOfTheDay(): void
    {
        $tournamentsToJson = [];
        $tournaments = $this->tournamentManager->getTournamentsToday();
        foreach ($tournaments as $tournament) {
            $tournamentToArray = $tournament->toArray();
            $tournamentsToJson[] = $tournamentToArray;
        }
        $this->renderJson($tournamentsToJson);
    }
}
