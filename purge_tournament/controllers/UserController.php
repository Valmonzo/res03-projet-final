<?php

class UserController extends AbstractController
{

    // Attributs

    private UserManager $manager;

    // Constructor

    public  function __construct()
    {
	    $this->manager = new UserManager();
    }


    // METHODES

    public function register(array $post) : void
    {

        if (!empty($post['newUsername'])
        && !empty($post['newEmail'])
        && !empty($post['newPassword'])
        && !empty($post['confirm-pwd'])
        ) {

            if ($post['newPassword'] === $post['confirm-pwd']) {
                if($this->manager->getUserByEmail($post['newEmail']) === null) {
                    $hashedPass = password_hash($post['newPassword'], PASSWORD_DEFAULT);
                    $userToAdd = new User($post["newEmail"], $post["newUsername"], $hashedPass);
                    $this->manager->insertUser($userToAdd);
                    $this->render('homepage', []);
                }

                else {
                    $this->render('register', ['error' => 'Cet Utilisateur existe déjà']);
                }

            }

            else {
                $this->render('register', ['error' => 'Les mots de passe ne correspondent pas ']);
            }
        }

        else {
            $this->render('register', ['error' => 'Merci de remplir tous les champs']);
        }


    }

    public function login(array $post) : void
    {

        if (!empty($post['email']) && !empty($post['password'])) {
            $logEmail = $post['email'];
            $passToCheck = $post['password'];


            $userToCheck = $this->manager->getUserByEmail($logEmail);


            $hashedPass = $userToCheck->getPassword();


            if ($userToCheck !== null) {
                if (password_verify($passToCheck, $hashedPass)) {
                    $_SESSION['authentification'] = 'ok';
                    $this->index();
                }

                else {
                    $this->render('authentification', ['error' => 'Identifiants de connexion incorrects 1']);
                }
            }

            else {
                $this->render('authentification', ['error' => 'Identifiants de connexion incorrects 2']);
            }
        }

        else {
            $this->render('authentification', ['error' => 'Merci de remplir tous les champs de connexion']);
        }

    }

}

?>