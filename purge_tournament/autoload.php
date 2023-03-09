<?php

// Abstract
require 'controllers/AbstractController.php';
require 'managers/AbstractManager.php';


// Controllers
require 'controllers/TournamentController.php';
require 'controllers/MatchController.php';
require 'controllers/MatchRoundController.php';
require 'controllers/UserController.php';
require 'controllers/public-renderer/RendererController.php';
require 'controllers/ContactController.php';
require 'controllers/MediaController.php';
require 'controllers/TeamController.php';


// Managers
require 'managers/UserManager.php';
require 'managers/TournamentManager.php';
require 'managers/MatchManager.php';
require 'managers/MatchRoundManager.php';
require 'managers/ContactManager.php';
require 'managers/MediaManager.php';
require 'managers/TeamManager.php';




//Models
require 'models/User.php';
require 'models/Tournament.php';
require 'models/Match.php';
require 'models/MatchRound.php';
require 'models/Contact.php';
require 'models/Media.php';


// Router
require 'services/Router.php';

