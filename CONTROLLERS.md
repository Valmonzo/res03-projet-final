## CONTROLLERS

## RendererController

**Routes publiques :**

 - /
 - /about-us
 - /schedule
 - event/id

## ContactController

**Routes publiques**

 - /contact
 
**Routes privées**
 - /admin/messages

## TeamController

**Routes publiques**

 - /event/id

**Routes privées**

 - /admin/event/:id
 - /admin/teams
 - /admin/team/create
 - /admin/team/:id/edit
 - /admin/team/:id/delete
 - /admin/team/:id
 - /admin/brackets
 - /admin/bracket/:id/edit
 - /admin/bracket/create
 
 ## TournamentController
**Routes publiques**

 - /schedule
 - /event/id

**Routes privées**

 - /admin/event/:id
 - /admin/events
 - /admin/event/create
 - /admin/event/:id/edit
 - /admin/event/:id/delete 
 - /admin/brackets
 - /admin/bracket/:id/edit
 - /admin/bracket/create
 - /admin/bracket/:id

## UserController

**Routes privées**

 - /admin (toutes les pages)

## MatchController

**Routes publiques**

 - /event/id

**Routes privées**

 - /admin/bracket/:id
 - /admin/bracket/:id/edit
 - /admin/bracket/:id/delete
 - /admin/bracket/create
 - /admin/event/:id
 - /admin/event/:id/delete
## MatchRoundController

**Routes privées**

 - /admin/bracket/:id/edit
 - /admin/bracket/create
 - /admin/bracket/:id/delete
 - /admin/event/:id/delete

## MediaController

**Routes publiques**

 - /event/:id
 - /schedule

**Routes privées**

 - /admin/event/:id
 - /admin/event/:id/delete
 - /admin/event/:id/edit
 - /admin/teams
 - /admin/team/:id
 - /admin/team/create
 - /admin/team/:id/edit
 - /admin/team/:id/delete
