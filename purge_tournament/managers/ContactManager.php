<?php

class ContactManager extends AbstractManager {


    public function getAllMessages() {
        $query = $this->db->prepare('SELECT * FROM contact');
        $query->execute();
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);

        $messagesTab = [];

        foreach($messages as $message) {
            $messageToLoad = new Contact($message['name'], $message['email'], $message['message']);
            $messageToLoad->setId($message['id']);
            $messageTab[] = $messageToLoad;
        }

        return $messagesTab;
    }

    public function getMessageById(int $id) : array {
        // Récupérer un message par l'id pour le lire
    }


    public function insertMessage(Contact $contact) : Void  {
        var_dump($contact);
        $query = $this->db->prepare('INSERT INTO contact (`id`, `name`, `email`, `message`) VALUES(NULL, :name, :email, :message)');

        $parameters = [
        'name' => $contact->getName(),
        'email' => $contact->getEmail(),
        'message'=>$contact->getMessage()
        ];
        $query->execute($parameters);
    }

    public function deleteMessage(int $id) : void {
        // Supprimer un message que l'on a lu
    }
}