<?php

class ContactManager extends AbstractManager
{
    public function getAllMessages(): array
    {
        $query = $this->db->prepare("SELECT * FROM contact");
        $query->execute();
        $messages = $query->fetchAll(PDO::FETCH_ASSOC);

        $messagesTab = [];

        foreach ($messages as $message) {
            $messageToLoad = new Contact(
                $message["name"],
                $message["email"],
                $message["message"]
            );
            $messageToLoad->setId($message["id"]);
            $messagesTab[] = $messageToLoad;
        }

        return $messagesTab;
    }

    public function getMessageById(int $id): array
    {
        // Récupérer un message par l'id pour le lire
    }

    public function insertMessage(Contact $contact): void
    {
        $query = $this->db->prepare(
            "INSERT INTO contact (`id`, `name`, `email`, `message`) VALUES(NULL, :name, :email, :message)"
        );

        $parameters = [
            "name" => $contact->getName(),
            "email" => $contact->getEmail(),
            "message" => $contact->getMessage(),
        ];
        $query->execute($parameters);
    }

    public function deleteMessage(int $id): void
    {
        $query = $this->db->prepare("DELETE FROM contact WHERE id = :id");

        $parameters = [
            "id" => $id,
        ];
        $query->execute($parameters);
    }
}
