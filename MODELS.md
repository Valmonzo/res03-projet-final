## Liste des Models 



**User :** il prendra en attribut un id, un username, un email et un password.
Son construct prendra un username , un email et un password.

**Tournament :** Il prendra en attribut un id , un nom , une date , une description , un nom de jeu , et l'url d'un stream, des gameRounds, des teams
Son construct prendra tout sauf l'id le gameRound et les teams

**Team :** Il prendra en attribut un id , un name , 4 x un player , un coach , un sub_player et un logo. 
Son construct prendra tout sauf l'id.

**Game :** Il prendra en attribut un id, l'id des deux teams , un tournoi, un winner , et un gameround
Son construct prendra tout sauf l'id.

**GameRound :** Il prendra en attribut un id , une description, un tournament , et un url.
son construct prendra tout sauf l'id.

**Contact :** Il prendra en attribut un id , un nom , un email et un message.
Son construc prendra tout sauf l'id.
