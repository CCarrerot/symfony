# Exemple de projet Symfony 5.1

## Installation

* Clonez ou téléchargez le projet.
* En mode console (cmd), allez dans le dossier et saisissez *composer update* .
* Créez une copie du fichier *.env* en le renommant *.env.local* .
* Créez votre base de données (AutoTest) et définissez un utilisateur qui peut y accéder.
* Mettez à jour le fichier .env.local en modifiant les variables 
     * DATABASE_URL (exemple: *DATABASE_URL=mysql://user:password@127.0.0.1:3306/AutoTest* où *user* est l'utilisateur et *password* son mot de passe qui accède au serveur Mysql ou Mariadb de le base de données *AutoTest* par le port *3306* par défaut)
     * APP_ENV=dev
* Saisissez :
     * *symfony console make:migration*
     * *symfony console doctrine:migrations:migrate*
     * *symfony console doctrine:fixtures:load*
  

## Utilisation
 
* Lancez le serveur symfony : *symfony serve* (si la [cli symfony](https://symfony.com/download) n'est pas installée, saisissez *php -S localhost:8000 -t public*)
* Accédez à la page : [https://127.0.0.1:8000/login](https://127.0.0.1:8000/login)


Il existe deux utilisateur :
- *admin@admin.fr* avec un mot de passe *admin* qui a des droits admin
- *cc@cc.fr* avec comme mot de passe *rascol* qui a des droits simple utilisateur

Le projet a été réalisé avec symfony 5.1 et php 7.3.12
