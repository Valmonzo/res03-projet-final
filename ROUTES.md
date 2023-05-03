## Routeur  PURGE TOURNAMENT

**Pages publiques :**

"/" , page d'accueil du site, elle affichera le prochain événements, les derniers résultats du précédent tournoi , le lien discord etc .. 

"/about-us" , présentera l'équipe avec photos, les partenaires , les exemples de client avec qui ils ont travaillé etc.. 

"/contact' , page de contact avec formulaire etc ..

"/schedule" , page qui affichera le calendrier des événements à venir avec des liens vers la page de l'événement en question.. 

"/event/:id" , page qui affichera l'événement sur lequel le client a cliqué , pour afficher les détails comme le bracket etc ... 

page bonus : Page qui affiche le stream de l'event en cours avec son bracket par le biais du API . 

**Pages Admin :**

"/admin" , qui affichera un formulaire de Login pour l'admin s'il n'est pas connecté ou qui affichera l'index admin.

"/admin/tournaments/create" , qui permettra de créer un événement avec un formulaire 

"/admin/tournaments" , qui affichera tous les événements et permettra de les éditer , ou de les supprimer ou de les consulter en détails et pour finir un bouton ajouter. 

"/admin/tournaments/:id/edit" , qui permettra d'éditer l'événement choisi, et de choisir le bracket correspondant. 

"admin/tournaments/:id/delete" , qui permettra de supprimer l'événement choisi , il fera apparaître un window.prompt pour s'assurer que l'user veut supprimer l'event.

"admin/teams" , qui affichera les teams 

"admin/team/:id" , qui affichera la team choisie. 

"admin/teams/create", qui permettra de créer une team avec un formulaire. 

"admin/team/:id/edit" , qui permettra d'éditer une team. 

"admin/team/:id/delete" , qui permettra de supprimer la team en question.
