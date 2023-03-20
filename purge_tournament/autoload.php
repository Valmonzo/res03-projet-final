<?php

//Models
require 'models/User.php';
require 'models/Tournament.php';
require 'models/Game.php';
require 'models/GameRound.php';
require 'models/Contact.php';
require 'models/Media.php';
require 'models/Team.php';

// Abstract
require 'controllers/AbstractController.php';
require 'managers/AbstractManager.php';


// Controllers
require 'controllers/TournamentController.php';
require 'controllers/GameController.php';
require 'controllers/GameRoundController.php';
require 'controllers/UserController.php';
require 'controllers/renderer-only/RendererController.php';
require 'controllers/ContactController.php';
require 'controllers/MediaController.php';
require 'controllers/TeamController.php';


// Managers
require 'managers/UserManager.php';
require 'managers/TournamentManager.php';
require 'managers/GameManager.php';
require 'managers/GameRoundManager.php';
require 'managers/ContactManager.php';
require 'managers/MediaManager.php';
require 'managers/TeamManager.php';



// Services
require 'services/Router.php';
require 'services/FilesUploader.php';

