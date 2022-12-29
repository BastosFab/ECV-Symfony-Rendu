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
## Lancer en local

Cloner le projet

```bash
  git clone https://link-to-project
```

Aller dans votre projet

```bash
  cd my-project
```

Install dependencies

```bash
  composer install
```

Start server

```bash
  symfony serve:start
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