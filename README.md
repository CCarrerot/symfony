# Exemple de projet Symfony 5.1

## Installation
 ```
Clonez ou téléchargez le projet.
Allez dans le dossier et saisissez composer update.
Créez une copie du fichier .env en le renommant .env.local.
Creez votre base de données (AutoTest) et définissez un utilisateur qui peut y accéder.
Mettez à jour le fichier .env.local
    exemple : DATABASE_URL=mysql://root:rascol@127.0.0.1:3306/AutoTest
Saisissez :
    symfony console make:migration
    symfony console doctrine:migrations:migrate
    symfony console doctrine:fixtures:load
  ```
## Utilisation
 
* Lancez le serveur symfony : symfony serve
* Accédez à la page :[https://127.0.0.1:8000/login](https://127.0.0.1:8000/login)

Il existe deux utilisateur :
- *admin@admin.fr* avec un mot de passe *admin* qui a des droits admin
- *cc@cc.fr* avec comme mot de passe *rascol* qui a des droits simple utilisateur

Le projet a été réalisé avec symfony 5.1 et php 7.3.12
