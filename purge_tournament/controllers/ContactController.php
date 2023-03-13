<?php


class ContactController extends AbstractController {

    // Attributs
    private ContactManager $contactManager;

    // Construct
    public function __construct()
    {
       $this->contactManager = new ContactManager();
    }


    // Méthodes

    public function newMessage(array $post) : void {

        if (!empty($post['contactName'])
        && !empty($post['contactEmail'])
        && !empty($post['contactMessage'])
        ) {
            $messageToAdd = new Contact($post['contactName'], $post['contactEmail'], $post['contactMessage']);
            $this->contactManager->insertMessage($messageToAdd);
            header('Location: /res03-projet-final/purge_tournament/contact');
        }

        else {
            $this->render('contact', ['error' => 'Veuillez remplir les champs du formulaire']);
        }

    }


    public function deleteMessage() {
        // Supprimer un message côté admin
    }
}