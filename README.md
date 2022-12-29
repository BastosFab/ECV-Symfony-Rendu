# **Symfony-Rendu-ECV**

## Objectifs du projet project 
```
- Créer un système de Création de compte et de Connexion

- Modification de mot de passe

- Création d'une page utilisateur avec Nom, Prénom, Mail

- Faire en sorte que le routing sois "fonctionnel" avec des redirect lorsque je me connecte...

- Ajout de css pour styliser un minimum
````
---
## Init project
```
git clone
```
---
## Clonner le .env
```
.env.local
```
---
## BDD

```
symfony console make:migration
```
```
php bin/console doctrine:migrations:migrate
````
---
## Start

```
symfony serve:start
```