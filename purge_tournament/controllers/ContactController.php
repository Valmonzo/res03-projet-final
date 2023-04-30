<?php

class ContactController extends AbstractController
{
    // Attributs
    private ContactManager $contactManager;

    // Construct
    public function __construct()
    {
        $this->contactManager = new ContactManager();
    }

    // Méthodes
    public function newMessage(array $post): void
    {
        if (
            !empty($post["contactName"]) &&
            !empty($post["contactEmail"]) &&
            !empty($post["contactMessage"])
        ) {
            $contactName = filter_var(
                $post["contactName"],
                FILTER_SANITIZE_STRING
            );
            $contactEmail = filter_var(
                $post["contactEmail"],
                FILTER_SANITIZE_EMAIL
            );
            $contactMessage = filter_var(
                $post["contactMessage"],
                FILTER_SANITIZE_STRING
            );
            $messageToAdd = new Contact(
                $contactName,
                $contactEmail,
                $contactMessage
            );
            $this->contactManager->insertMessage($messageToAdd);
            header("Location: /res03-projet-final/purge_tournament/contact");
        } else {
            $this->render("contact", [
                "error" => "Veuillez remplir les champs du formulaire",
            ]);
        }
    }

    public function renderMessages(): void
    {
        $messages = $this->contactManager->getAllMessages();
        $messagesToJson = [];
        foreach ($messages as $message) {
            $messagesToJson[] = $message->toArray();
        }
        $this->renderJson($messagesToJson);
    }

    public function deleteMessage(int $id): void
    {
        $this->contactManager->deleteMessage($id);
        header("Location: /res03-projet-final/purge_tournament/admin");
    }
}
